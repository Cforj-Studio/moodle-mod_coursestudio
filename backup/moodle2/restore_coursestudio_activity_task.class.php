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
 * Restore task for mod_coursestudio.
 *
 * @package    mod_coursestudio
 * @copyright  2026 cforj.studio
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/mod/coursestudio/backup/moodle2/restore_coursestudio_stepslib.php');

/**
 * Restore activity task for mod_coursestudio.
 */
class restore_coursestudio_activity_task extends restore_activity_task {
    /**
     * Define the task settings.
     */
    protected function define_my_settings() {
        // No custom settings needed.
    }

    /**
     * Define the task steps.
     */
    protected function define_my_steps() {
        $this->add_step(new restore_coursestudio_activity_structure_step('coursestudio_structure', 'coursestudio.xml'));
    }

    /**
     * Define the contents that should be decoded.
     *
     * @return array List of restore_decode_content objects.
     */
    public static function define_decode_contents() {
        return [];
    }

    /**
     * Define the decode rules.
     *
     * @return array List of restore_decode_rule objects.
     */
    public static function define_decode_rules() {
        return [];
    }

    /**
     * Define the restore log rules.
     *
     * @return array List of restore_log_rule objects.
     */
    public static function define_restore_log_rules() {
        return [];
    }

    /**
     * Define the restore log rules to be applied to course level.
     *
     * @return array List of restore_log_rule objects.
     */
    public static function define_restore_log_rules_for_course() {
        return [];
    }
}
