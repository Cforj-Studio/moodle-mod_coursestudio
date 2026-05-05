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
 * External service: submit a grade from the Course Studio player.
 *
 * @package    mod_coursestudio
 * @copyright  2026 cforj.studio
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_coursestudio\external;

use core_external\external_api;
use core_external\external_function_parameters;
use core_external\external_single_structure;
use core_external\external_value;

/**
 * External function for submitting a player grade to the Moodle gradebook.
 */
class submit_grade extends external_api {
    /**
     * Describe the parameters accepted by execute().
     *
     * @return external_function_parameters Parameter description.
     */
    public static function execute_parameters(): external_function_parameters {
        return new external_function_parameters([
            'cmid' => new external_value(PARAM_INT, 'Course module ID'),
            'score' => new external_value(PARAM_FLOAT, 'Raw score (0-1 fraction or absolute value)'),
        ]);
    }

    /**
     * Submit a grade from the Course Studio player.
     *
     * @param int $cmid Course module ID.
     * @param float $score Raw score from the player.
     * @return array Result data including success flag and recorded score.
     */
    public static function execute(int $cmid, float $score): array {
        global $DB, $USER, $CFG;

        require_once($CFG->libdir . '/gradelib.php');
        require_once($CFG->libdir . '/completionlib.php');

        $params = self::validate_parameters(self::execute_parameters(), [
            'cmid' => $cmid,
            'score' => $score,
        ]);

        $cm = get_coursemodule_from_id('coursestudio', $params['cmid'], 0, false, MUST_EXIST);
        $context = \context_module::instance($cm->id);
        self::validate_context($context);
        require_capability('mod/coursestudio:view', $context);

        $course = $DB->get_record('course', ['id' => $cm->course], '*', MUST_EXIST);
        $instance = $DB->get_record('coursestudio', ['id' => $cm->instance], '*', MUST_EXIST);

        if (empty($instance->gradeenabled)) {
            return ['ok' => true, 'grading' => false, 'score' => 0.0, 'max' => 0];
        }

        $rawscore = is_numeric($params['score']) ? (float) $params['score'] : 0.0;
        $grademax = max(1, (int) $instance->grademax);

        if ($rawscore > 0 && $rawscore <= 1) {
            $rawscore = $rawscore * $grademax;
        }
        $rawscore = min($grademax, max(0.0, $rawscore));

        $grade = new \stdClass();
        $grade->userid = $USER->id;
        $grade->rawgrade = $rawscore;
        grade_update('mod/coursestudio', $course->id, 'mod', 'coursestudio', $instance->id, 0, $grade);

        $completion = new \completion_info($course);
        if ($completion->is_enabled($cm)) {
            $completion->update_state($cm, COMPLETION_COMPLETE);
        }

        return ['ok' => true, 'grading' => true, 'score' => $rawscore, 'max' => $grademax];
    }

    /**
     * Describe the return value of execute().
     *
     * @return external_single_structure Return value description.
     */
    public static function execute_returns(): external_single_structure {
        return new external_single_structure([
            'ok' => new external_value(PARAM_BOOL, 'Success flag'),
            'grading' => new external_value(PARAM_BOOL, 'Whether grading is enabled for this activity'),
            'score' => new external_value(PARAM_FLOAT, 'Recorded score'),
            'max' => new external_value(PARAM_INT, 'Maximum grade'),
        ]);
    }
}
