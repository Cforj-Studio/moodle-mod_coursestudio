<?php
/**
 * Plugin admin settings
 *
 * @package    mod_coursestudio
 * @copyright  2026 cforj.studio
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    $settings->add(new admin_setting_configtext(
        'mod_coursestudio/apiurl',
        get_string('apiurl', 'coursestudio'),
        get_string('apiurl_desc', 'coursestudio'),
        'https://app.cforj.studio',
        PARAM_URL
    ));

    $settings->add(new admin_setting_configpasswordunmask(
        'mod_coursestudio/apikey',
        get_string('apikey', 'coursestudio'),
        get_string('apikey_desc', 'coursestudio'),
        ''
    ));

    $settings->add(new admin_setting_configtext(
        'mod_coursestudio/defaultheight',
        get_string('defaultheight', 'coursestudio'),
        get_string('defaultheight_desc', 'coursestudio'),
        '700',
        PARAM_INT
    ));
}
