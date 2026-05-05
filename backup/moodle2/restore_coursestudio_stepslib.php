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
 * Restore structure step for mod_coursestudio.
 *
 * @package    mod_coursestudio
 * @copyright  2026 cforj.studio
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Defines the restore structure for a coursestudio activity.
 */
class restore_coursestudio_activity_structure_step extends restore_activity_structure_step {
    /**
     * Define the restore structure.
     *
     * @return array List of restore_path_element objects.
     */
    protected function define_structure() {
        $paths = [];
        $paths[] = new restore_path_element('coursestudio', '/activity/coursestudio');
        return $this->prepare_activity_structure($paths);
    }

    /**
     * Process restored coursestudio data.
     *
     * @param array|object $data Restored data for this activity instance.
     */
    protected function process_coursestudio($data) {
        global $DB;

        $data = (object) $data;
        $data->course = $this->get_courseid();
        $data->timecreated = time();
        $data->timemodified = time();

        $newid = $DB->insert_record('coursestudio', $data);
        $this->apply_activity_instance($newid);
    }

    /**
     * Actions to run after the restore is executed.
     */
    protected function after_execute() {
        $this->add_related_files('mod_coursestudio', 'intro', null);
    }
}
