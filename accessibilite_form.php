<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.
/**
 * Formulaire d'enregistrement de la configuration
 *
 * @package     block_accessibilite
 * @copyright   2022 Philippe CHATAIGNER
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once("{$CFG->libdir}/formslib.php");

/**
 * form accessiblite
 *
 * @author philippe
 *
 */
class accessibilite_form extends moodleform {

    /**
     * Definition
     *
     * {@inheritDoc}
     * @see moodleform::definition()
     */
    public function definition() {

        $mform =& $this->_form;
        $url = $this->_customdata['url'];
        $mform->setType('block_accessibilite', PARAM_NOTAGS); // Set type of element.
        $mform->addElement('hidden', 'block_accessibilite_code', '');
        $mform->addElement('hidden', 'block_accessibilite_url', $url);
        $buttonarray = array();
        $buttonarray[] = $mform->createElement('submit', 'submitbutton', get_string('store', 'block_accessibilite'));
        $buttonarray[] = $mform->createElement('submit', 'raz', get_string('reset', 'block_accessibilite'));
        $mform->addGroup($buttonarray, 'buttonar', '', ' ', false);
    }
}
