<?php
/**
 * Activity creation / editing form
 *
 * @package    mod_coursestudio
 * @copyright  2026 cforj.studio
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/course/moodleform_mod.php');

class mod_coursestudio_mod_form extends moodleform_mod {

    public function definition() {
        $mform = $this->_form;

        // General section.
        $mform->addElement('header', 'general', get_string('general', 'form'));

        // Activity name.
        $mform->addElement('text', 'name', get_string('name', 'coursestudio'), ['size' => '64']);
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');

        // Description (intro).
        $this->standard_intro_elements();

        // Course Studio section.
        $mform->addElement('header', 'coursestudiohdr', get_string('coursesettings', 'coursestudio'));

        // Course ID from Course Studio.
        $mform->addElement('text', 'courseid', get_string('courseid', 'coursestudio'), ['size' => '48']);
        $mform->setType('courseid', PARAM_TEXT);
        $mform->addRule('courseid', null, 'required', null, 'client');
        $mform->addHelpButton('courseid', 'courseid', 'coursestudio');

        // Iframe height.
        $mform->addElement('text', 'iframeheight', get_string('iframeheight', 'coursestudio'), ['size' => '6']);
        $mform->setType('iframeheight', PARAM_INT);
        $mform->setDefault('iframeheight', 700);

        // Grade section.
        $mform->addElement('header', 'gradehdr', get_string('grade'));

        $mform->addElement('select', 'gradeenabled', get_string('gradeenabled', 'coursestudio'), [
            0 => get_string('no'),
            1 => get_string('yes'),
        ]);
        $mform->setDefault('gradeenabled', 1);

        $mform->addElement('text', 'grademax', get_string('grademax', 'coursestudio'), ['size' => '6']);
        $mform->setType('grademax', PARAM_INT);
        $mform->setDefault('grademax', 100);
        $mform->disabledIf('grademax', 'gradeenabled', 'eq', 0);

        // Standard elements.
        $this->standard_coursemodule_elements();
        $this->add_action_buttons();
    }

    public function validation($data, $files) {
        $errors = parent::validation($data, $files);

        if (empty(trim($data['courseid']))) {
            $errors['courseid'] = get_string('required');
        }

        if (!empty($data['gradeenabled']) && (int)$data['grademax'] < 1) {
            $errors['grademax'] = get_string('grademaxerror', 'coursestudio');
        }

        return $errors;
    }
}
