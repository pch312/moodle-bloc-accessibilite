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
 * Fichier libraire
 *
 * @package     block_accessibilite
 * @copyright   2022 Philippe CHATAIGNER
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * ajout du javascript avant l entete
 */
function block_accessibilite_before_footer() {
    global $PAGE;
    $PAGE->requires->js('/blocks/accessibilite/js/jscolor.js');
    $PAGE->requires->js('/blocks/accessibilite/js/accessibilite.js');
}
/**
 * block_accessibilite_render_navbar_output
 * @return string
 */
function block_accessibilite_render_navbar_output() {
    $retour = '<span id="accessibilite-code" data-code="'.block_accessibilite_read().'"></span>';
    return $retour;
}

/**
 * block_accessibilite_read
 * @return string|mixed|NULL
 */
function block_accessibilite_read() {
    return get_user_preferences('block_accessibilite_code');
}

/**
 * block_accessibilite_store
 * @param string $pcode
 */
function block_accessibilite_store($pcode) {
    set_user_preference('block_accessibilite_code', $pcode);
}

