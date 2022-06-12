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


function block_accessibilite_before_footer() {
    global $PAGE;
    $PAGE->requires->js('/blocks/accessibilite/js/jscolor.js');
    $PAGE->requires->js('/blocks/accessibilite/js/accessibilite.js');
}

function block_accessibilite_before_standard_top_of_body_html() {
}

function block_accessibilite_render_navbar_output() {
    global $USER;
    return '<span id="accessibilite-code" data-code="'.block_accessibilite_read().'"></span>';
}

function block_accessibilite_read() {
    global $USER;
    return get_user_preferences('block_accessibilite_code');
}

function block_accessibilite_store($pcode) {
    global $USER;
    set_user_preference('block_accessibilite_code', $pcode);
}

