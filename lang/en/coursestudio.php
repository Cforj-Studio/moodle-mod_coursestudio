<?php
/**
 * English language strings for mod_coursestudio
 *
 * @package    mod_coursestudio
 * @copyright  2026 cforj.studio
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['modulename'] = 'Course Studio';
$string['modulenameplural'] = 'Course Studio activities';
$string['modulename_help'] = 'Embed interactive Course Studio courses directly in Moodle. Supports auto-resize, grading, and completion tracking.';
$string['pluginname'] = 'Course Studio';
$string['pluginadministration'] = 'Course Studio administration';

// Form fields.
$string['name'] = 'Activity name';
$string['coursesettings'] = 'Course Studio settings';
$string['courseid'] = 'Course ID';
$string['courseid_help'] = 'The UUID of the course in Course Studio. Find it in Studio Settings or in the course URL.';
$string['iframeheight'] = 'Player height (px)';
$string['gradeenabled'] = 'Enable grading';
$string['grademax'] = 'Maximum grade';
$string['grademaxerror'] = 'Maximum grade must be at least 1';

// Admin settings.
$string['apiurl'] = 'Course Studio URL';
$string['apiurl_desc'] = 'Base URL of your Course Studio instance (e.g. https://app.cforj.studio)';
$string['apikey'] = 'API Key';
$string['apikey_desc'] = 'API key for server-to-server communication (optional, used for grade callbacks)';
$string['defaultheight'] = 'Default player height';
$string['defaultheight_desc'] = 'Default iframe height in pixels for new activities';

// Capabilities.
$string['coursestudio:addinstance'] = 'Add a new Course Studio activity';
$string['coursestudio:view'] = 'View Course Studio activity';
$string['coursestudio:grade'] = 'Grade Course Studio activity';

// Privacy.
$string['privacy:metadata'] = 'The Course Studio plugin does not store personal data locally. Completion and grade data is managed by Moodle core.';
