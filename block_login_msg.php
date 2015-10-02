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
 * @package   block_login_info
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('login_msg_lib.php');

class block_login_msg extends block_base {
    public function init() {
        $this->title = 'Login Message';
    }

    public function get_content() {
        global $CFG;
        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass;

        $obj = new login_msg_lib();

        $baseurl = $obj->get_base();
        $welcomepage = $obj->get_welcome();
        $jquerycdn = 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'; 
        $databaseobj = core_useragent::instance();
        $device = $databaseobj->get_device_type();
        $jquery = <<<JQ
    <script type="text/javascript" src="{$jquerycdn}"></script>
JQ;
        if ( ($device == 'mobile') || ($device == 'tablet') ) {
            $jquery = '';
        }

        if ( empty($welcomepage) ) {
            $popupjs = <<<HTML
        {$jquery}
HTML;
        } else {
            $popupjs = <<<HTML
        {$jquery}
        <!--ThickBox 3-->
        <script>
        // Add popup fade?
        function welcome() {
            var win_width = 600;
            var win_height = 400;
            var left = screen.width / 2 - win_width/2;
            var top = screen.height /2 - win_height/2;
            var winoptions = "width="+win_width+", height="+win_height+", top="+top+", left="+left;
            var popup = window.open("${welcomepage}", "Welcome", winoptions );
        }
        setTimeout( function(){welcome();}, 3000); 
        </script>
HTML;
        }

        $this->content->text = <<<HTML
        {$popupjs}
        <script type="text/javascript" src="{$baseurl}js/thickbox/thickbox.js"></script>
        <link rel="stylesheet" href="{$baseurl}js/thickbox/thickbox.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="{$baseurl}style.css" type="text/css" media="all" />
    <!-- /ThickBox 3 -->
        <div id="log_meg_small">
            <!-- link to reopen message --!>
                <p> <a href="{$welcomepage}" target="_blank">Welcome</a> </p>
        </div>
HTML;

        $this->content->footer = '';
        return $this->content;
    }
}
