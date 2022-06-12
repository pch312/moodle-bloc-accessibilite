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
 * Corps du bloc
 *
 * @package     block_accessibilite
 * @copyright   2022 Philippe CHATAIGNER
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 defined('MOODLE_INTERNAL') || die();
require_once('accessibilite_form.php');
class block_accessibilite extends block_base {
    public function init() {
        $this->title = get_string('accessibilite', 'block_accessibilite');
    }
    public function get_content() {
        if ($this->content !== null) {
            return $this->content;
        }
        global $USER, $CFG, $DB;
        require_once($CFG->dirroot . '/user/profile/lib.php');
        $myuser = $DB->get_record('user', array('id' => $USER->id));
        profile_load_data($myuser);
        $this->content         = new stdClass;
        $this->title = get_string('accessibilite', 'block_accessibilite');
        $this->content->text  = '<table>';
        $this->content->text  .= '<tr>';
        $this->content->text  .= '<td>';
        $this->content->text .= '    <label for="couleur_de_fond">'.get_string('backgroundcolor', 'block_accessibilite').'</label>';
        $this->content->text  .= '</td>';
        $this->content->text  .= '<td>';
        $this->content->text  .= '    <button class="btn btn-primary" name="couleur_de_fond" ';
        $this->content->text  .= 'data-jscolor="{preset:\'large\', position:\'right\',closeButton:\'true\', closeText:\'Fermer\',';
        $this->content->text  .= '            onChange:\'updateBackground(this)\'}"></button>';
        $this->content->text  .= '</td>';
        $this->content->text  .= '</tr>';
        $this->content->text  .= '<tr>';
        $this->content->text  .= '<td>';
        $this->content->text  .= '    <label for="couleur_du_texte">'.get_string('textcolor', 'block_accessibilite').'</label>';
        $this->content->text  .= '</td>';
        $this->content->text  .= '<td>';
        $this->content->text  .= '<button class="btn btn-primary" name="couleur_du_texte" ';
        $this->content->text  .= 'data-jscolor="{preset:\'large\',';
        $this->content->text  .= 'position:\'right\',closeButton:\'true\', closeText:\'Fermer\',';
        $this->content->text  .= '            onChange:\'updateTextColor(this)\',value:\'#000000\'}"></button>';
        $this->content->text  .= '';
        $this->content->text  .= '</td>';
        $this->content->text  .= '</tr>';
        $this->content->text  .= '<tr>';
        $this->content->text  .= '<td>';
        $this->content->text  .= '    <label for="taille_du_texte">'.get_string('textsize', 'block_accessibilite').'</label>';
        $this->content->text  .= '</td>';
        $this->content->text  .= '<td>';
        $this->content->text  .= '    <button class="btn btn-primary" name="taille_du_texte" ';
        $this->content->text  .= 'onclick="changerTaille(+1)">+</button>';
        $this->content->text  .= '    <button class="btn btn-primary" name="taille_du_texte" ';
        $this->content->text  .= 'onclick="changerTaille(-1)">-</button>';
        $this->content->text  .= '';
        $this->content->text  .= '</td>';
        $this->content->text  .= '</tr>';
        $this->content->text  .= '<tr>';
        $this->content->text  .= '<td>';
        $this->content->text  .= '    <label for="Interligne">'.get_string('linespacing', 'block_accessibilite').'</label>';
        $this->content->text  .= '</td>';
        $this->content->text  .= '<td>';
        $this->content->text  .= '    <button class="btn btn-primary" name="Interligne"';
        $this->content->text  .= ' onclick="changerInterligne(+1)">+</button>';
        $this->content->text  .= '    <button class="btn btn-primary" name="Interligne"';
        $this->content->text  .= ' onclick="changerInterligne(-1)">-</button>';
        $this->content->text  .= '</td>';
        $this->content->text  .= '</tr>';
        $this->content->text  .= '<tr>';
        $this->content->text  .= '<td>';
        $this->content->text  .= '    <label for="EspaceCaractere">'.get_string('spacecharacter', 'block_accessibilite').'</label>';
        $this->content->text  .= '</td>';
        $this->content->text  .= '<td>';
        $this->content->text  .= '    <button class="btn btn-primary" name="EspaceCaractere"';
        $this->content->text  .= ' onclick="changerEspaceCaractere(+1)">+</button>';
        $this->content->text  .= '    <button class="btn btn-primary" name="EspaceCaractere"';
        $this->content->text  .= ' onclick="changerEspaceCaractere(-1)">-</button>';
        $this->content->text  .= '</td>';
        $this->content->text  .= '</tr>';
        $this->content->text  .= '<tr>';
        $this->content->text  .= '<td>';
        $this->content->text  .= '    <label for="EspaceMot">'.get_string('spaceword', 'block_accessibilite').'</label>';
        $this->content->text  .= '</td>';
        $this->content->text  .= '<td>';
        $this->content->text  .= '    <button class="btn btn-primary" name="EspaceMot" onclick="changerEspaceMot(+1)">+</button>';
        $this->content->text  .= '    <button class="btn btn-primary" name="EspaceMot" onclick="changerEspaceMot(-1)">-</button>';
        $this->content->text  .= '</td>';
        $this->content->text  .= '</tr>';
        $this->content->text  .= '<tr>';
        $this->content->text  .= '<td rowspan="2" valign="center">';
        $this->content->text  .= '    <label for="police_du_texte">'.get_string('font', 'block_accessibilite').'</label>';
        $this->content->text  .= '</td>';
        $this->content->text  .= '<td>';
        $this->content->text  .= '    <select class="custom-select" name="police_du_texte" onchange="changerPolice(this.value)">';
        $this->content->text  .= '<option value="default">Défaut</option>';
        $this->content->text  .= '<option value="helvetica">Helvetica</option>';
        $this->content->text  .= '<option value="verdana">Verdana</option>';
        $this->content->text  .= '<option value="comic sans ms">Comic</option>';
        $this->content->text  .= '<option value="opendyslexic">Dyslexic</option>';
        $this->content->text  .= '</select>';
        $this->content->text  .= '</td>';
        $this->content->text  .= '</tr>';
        $this->content->text  .= '<tr>';
        $this->content->text  .= '<td>';
        $this->content->text  .= '    <button class="btn btn-primary" name="EspaceMot" ';
        $this->content->text  .= 'onclick="changerBold()">'.get_string('bold', 'block_accessibilite').'</button>';
        $this->content->text  .= '    <button class="btn btn-primary" name="EspaceMot" ';
        $this->content->text  .= 'onclick="changerItalic()">'.get_string('italic', 'block_accessibilite').'</button>';
        $this->content->text  .= '';
        $this->content->text  .= '</td>';
        $this->content->text  .= '</tr>';
        $this->content->text  .= '</table>';
        $this->content->footer = '';
        $simplehtml = new accessibilite_form("/blocks/accessibilite/view.php");
        $this->content->text .= $simplehtml->render();
        if ($this->content !== null) {
            return $this->content;
        }

    }
    public function hide_header() {
        return false;
    }
    protected function specific_definition($mform) {

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // A sample string variable with a default value.
        $mform->addElement('text', 'config_text', get_string('blockstring', 'block_accessibilite'));
        $mform->setDefault('config_text', 'default value');
        $mform->setType('config_text', PARAM_RAW);
    }

    public function specialization() {
        if (isset($this->config)) {
            if (empty($this->config->title)) {
                $this->title = get_string('defaulttitle', 'block_accessibilite');
            } else {
                $this->title = $this->config->title;
            }

            if (empty($this->config->text)) {
                $this->config->text = get_string('defaulttext', 'block_accessibilite');
            }
        }
    }
}
