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
 * English language strings for mod_coursestudio.
 *
 * @package    mod_coursestudio
 * @copyright  2026 cforj.studio
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['modulename']        = 'Course Studio';
$string['modulenameplural']  = 'Course Studio activities';
$string['modulename_help']   = 'Embed interactive Course Studio courses directly in Moodle. Supports auto-resize, grading, and completion tracking.';
$string['pluginname']        = 'Course Studio';
$string['pluginadministration'] = 'Course Studio administration';

// Form fields.
$string['name']           = 'Activity name';
$string['coursesettings'] = 'Course Studio settings';
$string['courseid']       = 'Course ID';
$string['courseid_help']  = 'The UUID of the course in Course Studio. Find it in Studio Settings or in the course URL.';
$string['iframeheight']   = 'Player height (px)';
$string['gradeenabled']   = 'Enable grading';
$string['grademax']       = 'Maximum grade';
$string['grademaxerror']  = 'Maximum grade must be at least 1';

// Admin settings.
$string['apiurl']              = 'Course Studio URL';
$string['apiurl_desc']         = 'Base URL of your Course Studio instance (e.g. https://app.cforj.studio)';
$string['apikey']              = 'API Key';
$string['apikey_desc']         = 'API key for server-to-server communication (optional, used for grade callbacks)';
$string['defaultheight']       = 'Default player height';
$string['defaultheight_desc']  = 'Default iframe height in pixels for new activities';

// Capabilities.
$string['coursestudio:addinstance'] = 'Add a new Course Studio activity';
$string['coursestudio:view']        = 'View Course Studio activity';
$string['coursestudio:grade']       = 'Grade Course Studio activity';

// Events.
$string['eventcoursemoduleviewed'] = 'Course module viewed';

// External services.
$string['submitgrade']             = 'Submit grade';
$string['submitgrade_description'] = 'Submit a grade from the Course Studio player to the Moodle gradebook';

// Privacy API.
$string['privacy:metadata']                  = 'The Course Studio plugin stores no personal data in its own tables.';
$string['privacy:metadata:core_grades']      = 'Grade data is stored in the Moodle gradebook via the core grades subsystem.';
$string['privacy:metadata:core_completion']  = 'Activity completion data is managed by the Moodle completion subsystem.';
