<?php
/**
 * Receive grade from Course Studio player via AJAX
 *
 * @package    mod_coursestudio
 * @copyright  2026 cforj.studio
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/gradelib.php');

$cmid  = required_param('cmid', PARAM_INT);
$score = optional_param('score', '', PARAM_RAW);

require_sesskey();

$cm = get_coursemodule_from_id('coursestudio', $cmid, 0, false, MUST_EXIST);
$course = $DB->get_record('course', ['id' => $cm->course], '*', MUST_EXIST);
$instance = $DB->get_record('coursestudio', ['id' => $cm->instance], '*', MUST_EXIST);

require_login($course, true, $cm);
$context = context_module::instance($cm->id);

if (empty($instance->gradeenabled)) {
    http_response_code(200);
    echo json_encode(['ok' => true, 'grading' => false]);
    die();
}

// Normalize score to 0-grademax range.
$rawscore = is_numeric($score) ? floatval($score) : 0;
$grademax = max(1, (int)$instance->grademax);

// If score is 0-1 range (percentage), scale up.
if ($rawscore > 0 && $rawscore <= 1) {
    $rawscore = $rawscore * $grademax;
}
$rawscore = min($grademax, max(0, $rawscore));

$grade = new stdClass();
$grade->userid = $USER->id;
$grade->rawgrade = $rawscore;

grade_update('mod/coursestudio', $course->id, 'mod', 'coursestudio', $instance->id, 0, $grade);

// Mark activity complete.
$completion = new completion_info($course);
if ($completion->is_enabled($cm)) {
    $completion->update_state($cm, COMPLETION_COMPLETE);
}

header('Content-Type: application/json');
echo json_encode(['ok' => true, 'score' => $rawscore, 'max' => $grademax]);
