<?php
/**
 * Backup task for mod_coursestudio
 *
 * @package    mod_coursestudio
 * @copyright  2026 cforj.studio
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once($CFG->dirroot . '/mod/coursestudio/backup/moodle2/backup_coursestudio_stepslib.php');

class backup_coursestudio_activity_task extends backup_activity_task {

    protected function define_my_settings() {}

    protected function define_my_steps() {
        $this->add_step(new backup_coursestudio_activity_structure_step(
            'coursestudio_structure', 'coursestudio.xml'));
    }

    static public function encode_content_links($content) {
        return $content;
    }
}
