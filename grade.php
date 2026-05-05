<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Legacy AJAX grade endpoint for mod_coursestudio.
 *
 * New integrations should use the External Service mod_coursestudio_submit_grade instead.
 *
 * @package    mod_coursestudio
 * @copyright  2026 cforj.studio
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/gradelib.php');

$cmid  = required_param('cmid', PARAM_INT);
$score = optional_param('score', 0, PARAM_FLOAT);

require_sesskey();

$cm       = get_coursemodule_from_id('coursestudio', $cmid, 0, false, MUST_EXIST);
$course   = $DB->get_record('course', ['id' => $cm->course], '*', MUST_EXIST);
$instance = $DB->get_record('coursestudio', ['id' => $cm->instance], '*', MUST_EXIST);

require_login($course, true, $cm);
$context = context_module::instance($cm->id);
require_capability('mod/coursestudio:view', $context);

if (empty($instance->gradeenabled)) {
    header('Content-Type: application/json');
    echo json_encode(['ok' => true, 'grading' => false]);
    die();
}

// Normalize score to 0-grademax range.
$rawscore = is_numeric($score) ? (float) $score : 0.0;
$grademax = max(1, (int) $instance->grademax);

// If score is a 0-1 fraction, scale to grade max.
if ($rawscore > 0 && $rawscore <= 1) {
    $rawscore = $rawscore * $grademax;
}
$rawscore = min($grademax, max(0.0, $rawscore));

$grade           = new stdClass();
$grade->userid   = $USER->id;
$grade->rawgrade = $rawscore;

grade_update('mod/coursestudio', $course->id, 'mod', 'coursestudio', $instance->id, 0, $grade);

// Mark activity complete.
$completion = new completion_info($course);
if ($completion->is_enabled($cm)) {
    $completion->update_state($cm, COMPLETION_COMPLETE);
}

header('Content-Type: application/json');
echo json_encode(['ok' => true, 'score' => $rawscore, 'max' => $grademax]);
