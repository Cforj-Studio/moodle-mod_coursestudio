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
 * Backup task for mod_coursestudio.
 *
 * @package    mod_coursestudio
 * @copyright  2026 cforj.studio
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/mod/coursestudio/backup/moodle2/backup_coursestudio_stepslib.php');

/**
 * Backup activity task for mod_coursestudio.
 */
class backup_coursestudio_activity_task extends backup_activity_task {
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
        $this->add_step(new backup_coursestudio_activity_structure_step('coursestudio_structure', 'coursestudio.xml'));
    }

    /**
     * Encode content links for backup.
     *
     * @param string $content Content to encode.
     * @return string Encoded content.
     */
    public static function encode_content_links($content) {
        return $content;
    }
}
