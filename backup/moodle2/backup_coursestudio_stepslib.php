<?php
/**
 * Backup steps for mod_coursestudio
 *
 * @package    mod_coursestudio
 * @copyright  2026 cforj.studio
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class backup_coursestudio_activity_structure_step extends backup_activity_structure_step {

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
