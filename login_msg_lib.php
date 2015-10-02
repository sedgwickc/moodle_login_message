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
 *
 * @package   block_login_msg
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class login_msg_lib{

    public function get_base() {
        global $CFG;
        return $CFG->wwwroot.'/blocks/login_msg/';
    }

    protected function get_last_login_time() {
        global $USER, $DB;

        $ret = $DB->get_record('user', array('id' => $USER->id));
        return $ret;
    }

    public function get_welcome() {
        global $USER;

        if ( !isset($USER) ) {
            return get_string('nologin', 'block_login_msg');
        }

        $ret = $this->get_last_login_time();
        if ( $ret === false ) {
            return get_string('nologin', 'block_login_msg');
        }

        if ( $ret->lastaccess == $ret->currentlogin ) {
            $period = ($ret->lastlogin == 0) ? 0 : $ret->lastaccess - $ret->lastlogin;

            if ( $period < 0 ) {
                return "error";
            }

            // First access.
            if ( $period == 0 ) {
                return $this->get_base().'welcome/firstaccess.php';
            }

            // 1day.
            if ( $period < 604800 ) {
                return $this->get_base().'welcome/dayaccess.php';
            }
 
            // 1week.
            if ( $period >= 604800 && $period < 2592000 ) {
                return $this->get_base().'welcome/weekaccess.php';
            }

            // 1month.
            if ( $period >= 2592000 ) {
                return $this->get_base().'welcome/monthaccess.php';
            }

            // Other.
            return $this->get_base().'welcome/dummyaccess.php';
        }
        return null;
    }
}
