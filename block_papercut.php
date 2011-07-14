<?php
/********************************************************************************************************************
*
*	NOTICE OF COPYRIGHT
*
*	This file is part of PaperCut Block for Moodle.
*
*    	Papercut Block for Moodle.
*    	Original version Copyright (C) 2009 onwards Ian Tasker www.schoolsict.com
*    	Moodle 2.x updates by Mark Johnson, Copyright 2011 onwards Taunton's College, UK
*
*    	This program is free software; you can redistribute it and/or modify it under the terms of the
*    	GNU General Public License as published by the Free Software Foundation; either version 3 of the License,
*    	or (at your option) any later version.
*
*    	This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
*    	without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*    	See the GNU General Public License for more details.
*
*    	You should have received a copy of the GNU General Public License along with this program.
*      If not, see <http://www.gnu.org/licenses/>
*
********************************************************************************************************************/

class block_papercut extends block_base {

    function init() {
        $this->title = get_string('blockname', 'block_papercut');
    }

    function specialization() {
        global $CFG;

        if (!empty($this->config) && !empty($this->config->title)) {
            // There is a customized block title, display it
            $this->title = $this->config->title;
        } else {
             $this->title = $CFG->block_papercut_title;
        }
    }

    function format_title($title, $max = 64) {

        $textlib = textlib_get_instance();

        if ($textlib->strlen($title) <= $max) {
            return s($title);
        } else {
            return s($textlib->substr($title,0,$max-3).'...');
        }
    }

    function get_content()  {
        global $CFG, $USER, $OUTPUT;

        if(has_capability('block/papercut:view', $this->context)) {
            $this->content = new stdClass;
            $this->content->footer = '';
            $this->content->items = array();
            $this->content->icons = array();

            $serverip = explode('.',$_SERVER['SERVER_ADDR']);
            $internal = address_in_subnet(getremoteaddr(),$serverip[0].'.'.$serverip[1]);

            $strnobalance = get_string('nobalance', 'block_papercut');
            $image = $OUTPUT->pix_icon('balance_not_available', $strnobalance, 'block_papercut');
            $http = $CFG->block_papercut_https ? 'https://' : 'http://';
            $serverurl = $http.$CFG->block_papercut_server_url.':'.$CFG->block_papercut_server_port;
            $scriptattrs = array('type' => 'text/javascript');
            $wisgetsattrs = $scriptattrs;
            $widgetsattrs['src'] = $serverurl.'/content/widgets/widgets.js';

            $script1 = "var pcUsername = '$USER->username';
                var pcServerURL = '$serverurl'; pcGetUserDetails();";
            $script2 = "pcInitUserEnvironmentalImpactWidget('widgetEnvironment');
                    pcInitUserBalanceWidget('widgetBalance');";

            if($internal) {
                $this->content->text .= html_writer::tag('script', '', $widgetsattrs);
            }
            $this->content->text .= html_writer::tag('script', $script1, $scriptattrs);

            $this->content->text .= html_writer::tag('div', $image, array('id' => 'widgetBalance'));
            $this->content->text .= html_writer::empty_tag('div', array('id' => 'widgetEnvironment'));

            if ($internal)  {
                $this->content->text .= html_writer::tag('script', $script2, $scriptattrs);
            }

            return $this->content;
        }
    }

    function instance_allow_config() {
         return true;
    }

    function has_config() {return true;}

}
?>
