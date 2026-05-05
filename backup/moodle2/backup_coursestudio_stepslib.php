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
 * Backup structure step for mod_coursestudio.
 *
 * @package    mod_coursestudio
 * @copyright  2026 cforj.studio
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Defines the backup structure for a coursestudio activity.
 */
class backup_coursestudio_activity_structure_step extends backup_activity_structure_step {
    /**
     * Define the backup structure tree for this activity.
     *
     * @return backup_nested_element The root element wrapped in activity structure.
     */
    protected function define_structure() {
        $coursestudio = new backup_nested_element('coursestudio', ['id'], [
            'name', 'intro', 'introformat', 'courseid',
            'iframeheight', 'gradeenabled', 'grademax',
            'timecreated', 'timemodified',
        ]);

        $coursestudio->set_source_table('coursestudio', ['id' => backup::VAR_ACTIVITYID]);

        return $this->prepare_activity_structure($coursestudio);
    }
}
