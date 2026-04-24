<?php
/**
 * Restore task for mod_coursestudio
 *
 * @package    mod_coursestudio
 * @copyright  2026 cforj.studio
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once($CFG->dirroot . '/mod/coursestudio/backup/moodle2/restore_coursestudio_stepslib.php');

class restore_coursestudio_activity_task extends restore_activity_task {

    protected function define_my_settings() {}

    protected function define_my_steps() {
        $this->add_step(new restore_coursestudio_activity_structure_step(
            'coursestudio_structure', 'coursestudio.xml'));
    }

    static public function define_decode_contents() {
        return [];
    }

    static public function define_decode_rules() {
        return [];
    }

    static public function define_restore_log_rules() {
        return [];
    }

    static public function define_restore_log_rules_for_course() {
        return [];
    }
}
