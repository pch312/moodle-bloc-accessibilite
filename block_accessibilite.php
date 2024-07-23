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

/**
 * Class bloc accessibilite
 * @author philippe
 *
 */
class block_accessibilite extends block_base {

    /**
     * Init bloc
     */
    public function init() {
        $this->title = get_string('accessibilite', 'block_accessibilite');
    }

    /**
     *
     * {@inheritDoc}
     * @see block_base::has_config()
     */
    public function has_config() {
        return true;
    }

    /**
     * Content of the bloc
     * {@inheritDoc}
     * @see block_base::get_content()
     */
    public function get_content() {
        if ($this->content !== null) {
            return $this->content;
        }
        global $USER, $CFG, $DB;

        require_once($CFG->dirroot . '/user/profile/lib.php');

        $myuser = $DB->get_record('user', ['id' => $USER->id]);
        if ( ! $myuser) {
            return;
        }
        profile_load_data($myuser);
        $this->content         = new stdClass;
        $this->title = get_config('block_accessibilite', 'name');
        if ( ! $this->title) {
            $this->title = get_string('accessibilite', 'block_accessibilite');
        }

        $this->content->text  = '<div class="container">';
        $this->content->text  .= '  <style>';
        $this->content->text  .= '    .container {';
        $this->content->text  .= '      display: flex;';
        $this->content->text  .= '      flex-direction: column;';
        $this->content->text  .= '      gap: 8px;';
        $this->content->text  .= '      width: 250px;';
        $this->content->text  .= '      align-items: center;';
        $this->content->text  .= '    }';
        $this->content->text  .= '    .element {';
        $this->content->text  .= '      display: flex;';
        $this->content->text  .= '      align-self: stretch;';
        $this->content->text  .= '      justify-content: space-between;';
        $this->content->text  .= '      align-items: center;';
        $this->content->text  .= '    }';
        $this->content->text  .= '    .fontGrid {';
        $this->content->text  .= '      display: grid;';
        $this->content->text  .= '      gap: 2px;';
        $this->content->text  .= '      grid-template-columns: 1fr 1fr;';
        $this->content->text  .= '    }';
        $this->content->text  .= '    .grid-column-2 {';
        $this->content->text  .= '      grid-column: span 2;';
        $this->content->text  .= '    }';
        $this->content->text  .= '  </style>';
        $this->content->text  .= '  <div class="element">';
        $this->content->text  .= '    <label for="couleur_de_fond">Couleur du fond</label>';
        $this->content->text  .= '    <button';
        $this->content->text  .= '      class="btn btn-primary jscolor"';
        $this->content->text  .= '      name="couleur_de_fond"';
        $this->content->text  .= '      data-jscolor="{preset:\'large\', position:\'right\',closeButton:\'true\','.
            'closeText:\'Fermer\', onChange:\'block_accessibilite_updateBackground(this)\'}"';
        $this->content->text  .= '      type="button"';
        $this->content->text  .= '      style="';
        $this->content->text  .= '        min-width: 32px !important;';
        $this->content->text  .= '        background-image: linear-gradient(';
        $this->content->text  .= '            to right,';
        $this->content->text  .= '            rgb(255, 255, 255) 0%,';
        $this->content->text  .= '            rgb(255, 255, 255) 100%';
        $this->content->text  .= '          ),';
        $this->content->text  .= '          url(\'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAMElE'.
            'QVQ4T2OcOXPmfwY84OzZs/ikGRhHDRgWYZCWloY3HRgbG+NPB6MGMDAO/TAAAN6LP+lFacGZAAAAAElFTkSuQmCC\') !important;';
        $this->content->text  .= '        background-position: left top, left top !important;';
        $this->content->text  .= '        background-size: auto, 16px 16px !important;';
        $this->content->text  .= '        background-repeat: repeat, repeat !important;';
        $this->content->text  .= '        background-origin: padding-box, padding-box !important;';
        $this->content->text  .= '      "';
        $this->content->text  .= '      data-current-color="#FFFFFF"';
        $this->content->text  .= '    >';
        $this->content->text  .= '      &nbsp;';
        $this->content->text  .= '    </button>';
        $this->content->text  .= '  </div>';
        $this->content->text  .= '  <div class="element">';
        $this->content->text  .= '    <label for="couleur_du_texte">Couleur du texte</label>';
        $this->content->text  .= '    <button';
        $this->content->text  .= '      class="btn btn-primary jscolor"';
        $this->content->text  .= '      name="couleur_du_texte"';
        $this->content->text  .= '      data-jscolor="{preset:\'large\',position:\'right\',closeButton:\'true\', '.
            'closeText:\'Fermer\', onChange:\'block_accessibilite_updateTextColor(this)\',value:\'#000000\'}"';
        $this->content->text  .= '      type="button"';
        $this->content->text  .= '      style="';
        $this->content->text  .= '        min-width: 32px !important;';
        $this->content->text  .= '        background-image: linear-gradient(';
        $this->content->text  .= '            to right,';
        $this->content->text  .= '            rgb(0, 0, 0) 0%,';
        $this->content->text  .= '            rgb(0, 0, 0) 100%';
        $this->content->text  .= '          ),';
        $this->content->text  .= '          url(\'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAMElEQVQ4T'.
            '2OcOXPmfwY84OzZs/ikGRhHDRgWYZCWloY3HRgbG+NPB6MGMDAO/TAAAN6LP+lFacGZAAAAAElFTkSuQmCC\') !important;';
        $this->content->text  .= '        background-position: left top, left top !important;';
        $this->content->text  .= '        background-size: auto, 16px 16px !important;';
        $this->content->text  .= '        background-repeat: repeat, repeat !important;';
        $this->content->text  .= '        background-origin: padding-box, padding-box !important;';
        $this->content->text  .= '      "';
        $this->content->text  .= '      data-current-color="#000000"';
        $this->content->text  .= '    >';
        $this->content->text  .= '      &nbsp;';
        $this->content->text  .= '    </button>';
        $this->content->text  .= '  </div>';
        $this->content->text  .= '  <div class="element">';
        $this->content->text  .= '    <label for="altern_text">Mots alternés</label>';
        $this->content->text  .= '    <div class="element">';
        $this->content->text  .= '      <button';
        $this->content->text  .= '        class="btn btn-primary jscolor"';
        $this->content->text  .= '        name="couleur_mot1"';
        $this->content->text  .= '        data-jscolor="{preset:\'large\', position:\'right\',closeButton:\'true\', '.
            'closeText:\'Fermer\', onChange:\'block_accessibilite_updateColor1(this)\'}"';
        $this->content->text  .= '        type="button"';
        $this->content->text  .= '        style="';
        $this->content->text  .= '          min-width: 32px !important;';
        $this->content->text  .= '          background-image: linear-gradient(';
        $this->content->text  .= '              to right,';
        $this->content->text  .= '              rgb(255, 255, 255) 0%,';
        $this->content->text  .= '              rgb(255, 255, 255) 100%';
        $this->content->text  .= '            ),';
        $this->content->text  .= '            url(\'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAMElEQVQ'.
            '4T2OcOXPmfwY84OzZs/ikGRhHDRgWYZCWloY3HRgbG+NPB6MGMDAO/TAAAN6LP+lFacGZAAAAAElFTkSuQmCC\') !important;';
        $this->content->text  .= '          background-position: left top, left top !important;';
        $this->content->text  .= '          background-size: auto, 16px 16px !important;';
        $this->content->text  .= '          background-repeat: repeat, repeat !important;';
        $this->content->text  .= '          background-origin: padding-box, padding-box !important;';
        $this->content->text  .= '        "';
        $this->content->text  .= '        data-current-color="#FFFFFF"';
        $this->content->text  .= '      >';
        $this->content->text  .= '        &nbsp;';
        $this->content->text  .= '      </button>';
        $this->content->text  .= '      <button';
        $this->content->text  .= '        class="btn btn-primary jscolor"';
        $this->content->text  .= '        name="couleur_mot2"';
        $this->content->text  .= '        data-jscolor="{preset:\'large\', position:\'right\',closeButton:\'true\', '.
            'closeText:\'Fermer\', onChange:\'block_accessibilite_updateColor2(this)\'}"';
        $this->content->text  .= '        type="button"';
        $this->content->text  .= '        style="';
        $this->content->text  .= '          min-width: 32px !important;';
        $this->content->text  .= '          background-image: linear-gradient(';
        $this->content->text  .= '              to right,';
        $this->content->text  .= '              rgb(255, 255, 255) 0%,';
        $this->content->text  .= '              rgb(255, 255, 255) 100%';
        $this->content->text  .= '            ),';
        $this->content->text  .= '            url(\'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAMElEQVQ'.
            '4T2OcOXPmfwY84OzZs/ikGRhHDRgWYZCWloY3HRgbG+NPB6MGMDAO/TAAAN6LP+lFacGZAAAAAElFTkSuQmCC\') !important;';
        $this->content->text  .= '          background-position: left top, left top !important;';
        $this->content->text  .= '          background-size: auto, 16px 16px !important;';
        $this->content->text  .= '          background-repeat: repeat, repeat !important;';
        $this->content->text  .= '          background-origin: padding-box, padding-box !important;';
        $this->content->text  .= '        "';
        $this->content->text  .= '        data-current-color="#FFFFFF"';
        $this->content->text  .= '      >';
        $this->content->text  .= '        &nbsp;';
        $this->content->text  .= '      </button>';
        $this->content->text  .= '      <button';
        $this->content->text  .= '        class="btn btn-primary"';
        $this->content->text  .= '        name="couleur_altern"';
        $this->content->text  .= '        onclick="block_accessibilite_alterncolor()"';
        $this->content->text  .= '      >';
        $this->content->text  .= '        OK';
        $this->content->text  .= '      </button>';
        $this->content->text  .= '    </div>';
        $this->content->text  .= '  </div>';
        $this->content->text  .= '  <button';
        $this->content->text  .= '    class="btn btn-primary"';
        $this->content->text  .= '    name="monochrome"';
        $this->content->text  .= '    onclick="block_accessibilite_monochrome()"';
        $this->content->text  .= '  >';
        $this->content->text  .= '    Monochrome';
        $this->content->text  .= '  </button>';
        $this->content->text  .= '  <div class="element">';
        $this->content->text  .= '    <label for="taille_du_texte">Taille du texte</label>';
        $this->content->text  .= '    <div class="element">';
        $this->content->text  .= '      <button';
        $this->content->text  .= '        class="btn btn-primary"';
        $this->content->text  .= '        name="taille_du_texte"';
        $this->content->text  .= '        onclick="block_accessibilite_changerTaille(+1)"';
        $this->content->text  .= '      >';
        $this->content->text  .= '        +';
        $this->content->text  .= '      </button>&nbsp;';
        $this->content->text  .= '      <button';
        $this->content->text  .= '        class="btn btn-primary"';
        $this->content->text  .= '        name="taille_du_texte"';
        $this->content->text  .= '        onclick="block_accessibilite_changerTaille(-1)"';
        $this->content->text  .= '      >';
        $this->content->text  .= '        -';
        $this->content->text  .= '      </button>';
        $this->content->text  .= '    </div>';
        $this->content->text  .= '  </div>';
        $this->content->text  .= '  <div class="element">';
        $this->content->text  .= '    <label for="Interligne">Interligne</label>';
        $this->content->text  .= '    <div class="element">';
        $this->content->text  .= '      <button';
        $this->content->text  .= '        class="btn btn-primary"';
        $this->content->text  .= '        name="Interligne"';
        $this->content->text  .= '        onclick="block_accessibilite_changerInterligne(+1)"';
        $this->content->text  .= '      >';
        $this->content->text  .= '        +';
        $this->content->text  .= '      </button>&nbsp;';
        $this->content->text  .= '      <button';
        $this->content->text  .= '        class="btn btn-primary"';
        $this->content->text  .= '        name="Interligne"';
        $this->content->text  .= '        onclick="block_accessibilite_changerInterligne(-1)"';
        $this->content->text  .= '      >';
        $this->content->text  .= '        -';
        $this->content->text  .= '      </button>';
        $this->content->text  .= '    </div>';
        $this->content->text  .= '  </div>';
        $this->content->text  .= '  <div class="element">';
        $this->content->text  .= '    <label for="EspaceCaractere">Espace entre les caractères</label>';
        $this->content->text  .= '    <div class="element">';
        $this->content->text  .= '      <button';
        $this->content->text  .= '        class="btn btn-primary"';
        $this->content->text  .= '        name="EspaceCaractere"';
        $this->content->text  .= '        onclick="block_accessibilite_changerEspaceCaractere(+1)"';
        $this->content->text  .= '      >';
        $this->content->text  .= '        +';
        $this->content->text  .= '      </button>&nbsp;';
        $this->content->text  .= '      <button';
        $this->content->text  .= '        class="btn btn-primary"';
        $this->content->text  .= '        name="EspaceCaractere"';
        $this->content->text  .= '        onclick="block_accessibilite_changerEspaceCaractere(-1)"';
        $this->content->text  .= '      >';
        $this->content->text  .= '        -';
        $this->content->text  .= '      </button>';
        $this->content->text  .= '    </div>';
        $this->content->text  .= '  </div>';
        $this->content->text  .= '  <div class="element">';
        $this->content->text  .= '    <label for="EspaceMot">Espace entre les mots</label>';
        $this->content->text  .= '    <div class="element">';
        $this->content->text  .= '      <button';
        $this->content->text  .= '        class="btn btn-primary"';
        $this->content->text  .= '        name="EspaceMot"';
        $this->content->text  .= '        onclick="block_accessibilite_changerEspaceMot(+1)"';
        $this->content->text  .= '      >';
        $this->content->text  .= '        +';
        $this->content->text  .= '      </button>&nbsp;';
        $this->content->text  .= '      <button';
        $this->content->text  .= '        class="btn btn-primary"';
        $this->content->text  .= '        name="EspaceMot"';
        $this->content->text  .= '        onclick="block_accessibilite_changerEspaceMot(-1)"';
        $this->content->text  .= '      >';
        $this->content->text  .= '        -';
        $this->content->text  .= '      </button>';
        $this->content->text  .= '    </div>';
        $this->content->text  .= '  </div>';
        $this->content->text  .= '  <div class="element">';
        $this->content->text  .= '    <label for="police_du_texte">Police de caractères</label>';
        $this->content->text  .= '    <div class="fontGrid">';
        $this->content->text  .= '      <select';
        $this->content->text  .= '        class="custom-select grid-column-2"';
        $this->content->text  .= '        name="police_du_texte"';
        $this->content->text  .= '        onchange="block_accessibilite_changerPolice(this.value)"';
        $this->content->text  .= '      >';
        $this->content->text  .= '        <option value="default">Défaut</option>';
        $this->content->text  .= '        <option value="helvetica">Helvetica</option>';
        $this->content->text  .= '        <option value="verdana">Verdana</option>';
        $this->content->text  .= '        <option value="comic sans ms">Comic</option>';
        $this->content->text  .= '        <option value="opendyslexic">Dyslexic</option>';
        $this->content->text  .= '      </select>';
        $this->content->text  .= '      <button';
        $this->content->text  .= '        class="btn btn-primary"';
        $this->content->text  .= '        name="EspaceMot"';
        $this->content->text  .= '        onclick="block_accessibilite_changerBold()"';
        $this->content->text  .= '      >';
        $this->content->text  .= '        Gras';
        $this->content->text  .= '      </button>';
        $this->content->text  .= '      <button';
        $this->content->text  .= '        class="btn btn-primary"';
        $this->content->text  .= '        name="EspaceMot"';
        $this->content->text  .= '        onclick="block_accessibilite_changerItalic()"';
        $this->content->text  .= '      >';
        $this->content->text  .= '        Italique';
        $this->content->text  .= '      </button>';
        $this->content->text  .= '    </div>';
        $this->content->text  .= '  </div>';
        $this->content->text  .= '  <div></div>';
        $this->content->text  .= '  <button';
        $this->content->text  .= '    class="btn btn-primary"';
        $this->content->text  .= '    name="Curseur"';
        $this->content->text  .= '    onclick="block_accessibilite_changeCursor()"';
        $this->content->text  .= '  >';
        $this->content->text  .= '    Curseur';
        $this->content->text  .= '  </button>';
        $this->content->text  .= '</div>';

        $toform = ['url' => $this->page->url];
        $simplehtml = new accessibilite_form("/blocks/accessibilite/view.php", $toform, 'post', '', null, true, null);

        $this->content->text .= $simplehtml->render();

        if ($this->content !== null) {
            return $this->content;
        }

    }

    /**
     * hide header
     * {@inheritDoc}
     * @see block_base::hide_header()
     */
    public function hide_header() {
        return false;
    }

    /**
     * Specific défintion
     * @param moodleform $mform
     */
    protected function specific_definition($mform) {

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // A sample string variable with a default value.
        $mform->addElement('text', 'config_text', get_string('blockstring', 'block_accessibilite'));
        $mform->setDefault('config_text', 'default value');
        $mform->setType('config_text', PARAM_RAW);
    }

    /**
     * specialization
     * {@inheritDoc}
     * @see block_base::specialization()
     */
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
