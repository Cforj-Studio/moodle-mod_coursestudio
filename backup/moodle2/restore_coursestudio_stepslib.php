<?php
/**
 * Restore steps for mod_coursestudio
 *
 * @package    mod_coursestudio
 * @copyright  2026 cforj.studio
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class restore_coursestudio_activity_structure_step extends restore_activity_structure_step {

    protected function define_structure() {
        $paths = [];
        $paths[] = new restore_path_element('coursestudio', '/activity/coursestudio');
        return $this->prepare_activity_structure($paths);
    }

    protected function process_coursestudio($data) {
        global $DB;

        $data = (object)$data;
        $data->course = $this->get_courseid();
        $data->timecreated = time();
        $data->timemodified = time();

        $newid = $DB->insert_record('coursestudio', $data);
        $this->apply_activity_instance($newid);
    }

    protected function after_execute() {
        $this->add_related_files('mod_coursestudio', 'intro', null);
    }
}
