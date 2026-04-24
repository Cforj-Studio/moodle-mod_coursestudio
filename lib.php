<?php
/**
 * Library functions for mod_coursestudio
 *
 * @package    mod_coursestudio
 * @copyright  2026 cforj.studio
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Add a Course Studio instance
 */
function coursestudio_add_instance($data, $mform = null) {
    global $DB;
    $data->timecreated = time();
    $data->timemodified = time();
    return $DB->insert_record('coursestudio', $data);
}

/**
 * Update a Course Studio instance
 */
function coursestudio_update_instance($data, $mform = null) {
    global $DB;
    $data->timemodified = time();
    $data->id = $data->instance;
    return $DB->update_record('coursestudio', $data);
}

/**
 * Delete a Course Studio instance
 */
function coursestudio_delete_instance($id) {
    global $DB;
    if (!$DB->get_record('coursestudio', ['id' => $id])) {
        return false;
    }
    $DB->delete_records('coursestudio', ['id' => $id]);
    return true;
}

/**
 * Supported features
 */
function coursestudio_supports($feature) {
    switch ($feature) {
        case FEATURE_MOD_INTRO:           return true;
        case FEATURE_SHOW_DESCRIPTION:    return true;
        case FEATURE_GRADE_HAS_GRADE:     return true;
        case FEATURE_BACKUP_MOODLE2:      return true;
        case FEATURE_COMPLETION_TRACKS_VIEWS: return true;
        default: return null;
    }
}

/**
 * Create grade item for given instance
 */
function coursestudio_grade_item_update($instance, $grades = null) {
    global $CFG;
    require_once($CFG->libdir . '/gradelib.php');

    if (empty($instance->gradeenabled)) {
        return grade_update('mod/coursestudio', $instance->course, 'mod', 'coursestudio',
            $instance->id, 0, null, ['deleted' => 1]);
    }

    $item = [
        'itemname' => $instance->name,
        'grademax'  => (int)$instance->grademax,
        'grademin'  => 0,
        'gradetype' => GRADE_TYPE_VALUE,
    ];

    return grade_update('mod/coursestudio', $instance->course, 'mod', 'coursestudio',
        $instance->id, 0, $grades, $item);
}

/**
 * Update grades in the gradebook
 */
function coursestudio_update_grades($instance, $userid = 0, $nullifnone = true) {
    coursestudio_grade_item_update($instance);
}
