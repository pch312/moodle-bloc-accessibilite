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
namespace block_accessibilite\privacy;
use core_privacy\local\metadata\collection;

class provider implements \core_privacy\local\metadata\provider {

    public static function get_metadata(collection $collection) : collection {
        $collection->add_user_preference( 'block_accessibilite_change_presentation' ,
           'privacy:metadata:preference:block_accessibilite_change_presentation' );
        return $collection;
    }
}
