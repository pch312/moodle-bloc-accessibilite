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
 * Access
 *
 * @package     block_accessibilite
 * @copyright   2022 Philippe CHATAIGNER
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Upgrade
 * @param unknown $oldversion
 * @return boolean
 */
function xmldb_block_accessibilite_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager();
    if ($oldversion < 2022062100) {

        // Define table block_accessibilite to be dropped.
        $table = new xmldb_table('block_accessibilite');

        // Conditionally launch drop table for block_accessibilite.
        if ($dbman->table_exists($table)) {
            $dbman->drop_table($table);
        }

        // Accessibilite savepoint reached.
        upgrade_block_savepoint(true, 2022062100, 'accessibilite');
    }
    return true;
}
