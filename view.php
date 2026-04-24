<?php
/**
 * View Course Studio activity
 *
 * @package    mod_coursestudio
 * @copyright  2026 cforj.studio
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/mod/coursestudio/lib.php');

$id = required_param('id', PARAM_INT); // Course Module ID

$cm = get_coursemodule_from_id('coursestudio', $id, 0, false, MUST_EXIST);
$course = $DB->get_record('course', ['id' => $cm->course], '*', MUST_EXIST);
$instance = $DB->get_record('coursestudio', ['id' => $cm->instance], '*', MUST_EXIST);

require_login($course, true, $cm);
$context = context_module::instance($cm->id);
require_capability('mod/coursestudio:view', $context);

// Completion
$completion = new completion_info($course);
$completion->set_module_viewed($cm);

$PAGE->set_url('/mod/coursestudio/view.php', ['id' => $id]);
$PAGE->set_title($instance->name);
$PAGE->set_heading($course->fullname);

$api_url = get_config('mod_coursestudio', 'apiurl') ?: 'https://app.cforj.studio';
$course_id = $instance->courseid;
$height = (int)($instance->iframeheight ?: 700);

echo $OUTPUT->header();
echo $OUTPUT->heading($instance->name);

if (!empty($instance->intro)) {
    echo $OUTPUT->box(format_module_intro('coursestudio', $instance, $cm->id), 'generalbox', 'intro');
}

// Render course iframe
echo <<<HTML
<div id="cs-embed" style="width:100%;border-radius:12px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.08);">
  <iframe
    src="{$api_url}/embed/{$course_id}"
    style="width:100%;height:{$height}px;border:none;"
    allow="fullscreen"
    id="cs-iframe"
  ></iframe>
</div>
<script>
window.addEventListener('message', function(e) {
  if (e.data && e.data.type === 'CS_COMPLETE') {
    // Send grade to Moodle via AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', M.cfg.wwwroot + '/mod/coursestudio/grade.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('cmid={$cm->id}&score=' + encodeURIComponent(e.data.score || '') + '&sesskey=' + M.cfg.sesskey);
  }
  // Auto-resize iframe
  if (e.data && e.data.type === 'CS_RESIZE' && e.data.height) {
    document.getElementById('cs-iframe').style.height = e.data.height + 'px';
  }
});
</script>
HTML;

echo $OUTPUT->footer();
