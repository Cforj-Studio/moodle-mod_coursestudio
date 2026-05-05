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
 * Course Studio player AMD module.
 *
 * Listens for postMessage events from the embedded Course Studio iframe
 * and submits grades via the Moodle External Services API.
 *
 * @module     mod_coursestudio/player
 * @copyright  2026 cforj.studio
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import Ajax from 'core/ajax';
import Notification from 'core/notification';

/**
 * Initialise the player listener for a given course module.
 *
 * @param {number} cmid Course module ID
 * @returns {void}
 */
const init = (cmid) => {
    window.addEventListener('message', (e) => {
        if (!e.data || typeof e.data !== 'object') {
            return;
        }

        const data = e.data;

        if (data.type === 'CS_COMPLETE') {
            Ajax.call([{
                methodname: 'mod_coursestudio_submit_grade',
                args: {
                    cmid,
                    score: parseFloat(data.score) || 0
                },
                fail: Notification.exception
            }]);
        }

        if (data.type === 'CS_RESIZE' && data.height) {
            const iframe = document.getElementById('cs-iframe-' + cmid);
            if (iframe) {
                iframe.style.height = data.height + 'px';
            }
        }
    });
};

export default {
    init,
};
