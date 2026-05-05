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
 * Library functions for mod_coursestudio.
 *
 * @package    mod_coursestudio
 * @copyright  2026 cforj.studio
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Add a new Course Studio instance to the database.
 *
 * @param stdClass $data Form data.
 * @param moodleform|null $mform The mod form.
 * @return int New instance ID.
 */
function coursestudio_add_instance($data, $mform = null) {
    global $DB;
    $data->timecreated  = time();
    $data->timemodified = time();
    $id = $DB->insert_record('coursestudio', $data);
    coursestudio_grade_item_update($data);
    return $id;
}

/**
 * Update an existing Course Studio instance.
 *
 * @param stdClass $data Form data.
 * @param moodleform|null $mform The mod form.
 * @return bool True on success.
 */
function coursestudio_update_instance($data, $mform = null) {
    global $DB;
    $data->timemodified = time();
    $data->id           = $data->instance;
    $result = $DB->update_record('coursestudio', $data);
    coursestudio_grade_item_update($data);
    return $result;
}

/**
 * Delete a Course Studio instance.
 *
 * @param int $id Instance ID.
 * @return bool True on success.
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
 * Return supported Moodle features.
 *
 * @param string $feature Feature constant.
 * @return bool|null True if supported, null if unknown.
 */
function coursestudio_supports($feature) {
    switch ($feature) {
        case FEATURE_MOD_INTRO:
            return true;
        case FEATURE_SHOW_DESCRIPTION:
            return true;
        case FEATURE_GRADE_HAS_GRADE:
            return true;
        case FEATURE_BACKUP_MOODLE2:
            return true;
        case FEATURE_COMPLETION_TRACKS_VIEWS:
            return true;
        default:
            return null;
    }
}

/**
 * Create or update the grade item for a Course Studio instance.
 *
 * @param stdClass $instance The instance record.
 * @param mixed $grades Optional grade data.
 * @return int Grade update result code.
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
        'grademax' => (int) $instance->grademax,
        'grademin' => 0,
        'gradetype' => GRADE_TYPE_VALUE,
    ];

    return grade_update('mod/coursestudio', $instance->course, 'mod', 'coursestudio',
        $instance->id, 0, $grades, $item);
}

/**
 * Update grades in the gradebook.
 *
 * @param stdClass $instance The instance record.
 * @param int $userid Optional user ID (0 = all users).
 * @param bool $nullifnone If true, set null grades if none exist.
 */
function coursestudio_update_grades($instance, $userid = 0, $nullifnone = true) {
    coursestudio_grade_item_update($instance);
}
