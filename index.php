<?php
/**
 * List all Course Studio instances in a course
 *
 * @package    mod_coursestudio
 * @copyright  2026 cforj.studio
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');

$id = required_param('id', PARAM_INT); // Course ID

$course = $DB->get_record('course', ['id' => $id], '*', MUST_EXIST);
require_login($course);

$PAGE->set_url('/mod/coursestudio/index.php', ['id' => $id]);
$PAGE->set_title(get_string('modulenameplural', 'coursestudio'));
$PAGE->set_heading($course->fullname);

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('modulenameplural', 'coursestudio'));

$instances = get_all_instances_in_course('coursestudio', $course);

if (empty($instances)) {
    notice(get_string('thereareno', 'moodle', get_string('modulenameplural', 'coursestudio')),
        new moodle_url('/course/view.php', ['id' => $course->id]));
}

$table = new html_table();
$table->attributes['class'] = 'generaltable mod_index';

$table->head  = [get_string('name'), get_string('courseid', 'coursestudio')];
$table->align = ['left', 'left'];

foreach ($instances as $instance) {
    $link = html_writer::link(
        new moodle_url('/mod/coursestudio/view.php', ['id' => $instance->coursemodule]),
        format_string($instance->name)
    );
    $table->data[] = [$link, s($instance->courseid)];
}

echo html_writer::table($table);
echo $OUTPUT->footer();
