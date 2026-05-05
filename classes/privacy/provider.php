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
 * Privacy API implementation for mod_coursestudio.
 *
 * This plugin does not store personal data in its own tables.
 * Grade and completion data are managed by Moodle core subsystems.
 *
 * @package    mod_coursestudio
 * @copyright  2026 cforj.studio
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_coursestudio\privacy;

use core_privacy\local\metadata\collection;
use core_privacy\local\request\contextlist;
use core_privacy\local\request\approved_contextlist;

defined('MOODLE_INTERNAL') || die();

class provider implements
    \core_privacy\local\metadata\provider,
    \core_privacy\local\request\plugin\provider {

    public static function get_metadata(collection $collection): collection {
        $collection->add_subsystem_link('core_grades', [], 'privacy:metadata:core_grades');
        $collection->add_subsystem_link('core_completion', [], 'privacy:metadata:core_completion');
        return $collection;
    }

    public static function get_contexts_for_userid(int $userid): contextlist {
        // Grade and completion data are handled by their respective subsystems.
        return new contextlist();
    }

    public static function export_user_data(approved_contextlist $contextlist): void {
        // No personal data is stored in plugin-specific tables.
    }

    public static function delete_data_for_all_users_in_context(\context $context): void {
        // No personal data is stored in plugin-specific tables.
    }

    public static function delete_data_for_user(approved_contextlist $contextlist): void {
        // No personal data is stored in plugin-specific tables.
    }
}
