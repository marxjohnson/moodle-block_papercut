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
 * Defines the class for the Papercut block
 *
 * @package     block_papercut
 * @author      Mark Johnson <mark.johnson@tauntons.ac.uk>
 * @author      Ian Tasker
 * @copyright   2010 onwards Tauntons College, UK
 * @copyright   Original version Copyright (C) 2009 onwards Ian Tasker www.schoolsict.com
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class block_papercut extends block_base {

    public function init() {
        $this->title = get_string('blockname', 'block_papercut');
    }

    public function specialization() {
        global $CFG;

        if (!empty($this->config) && !empty($this->config->title)) {
            // There is a customized block title, display it
            $this->title = $this->config->title;
        } else {
             $this->title = get_config('block_papercut', 'title');
        }
    }

    public function format_title($title, $max = 64) {

        $textlib = textlib_get_instance();

        if ($textlib->strlen($title) <= $max) {
            return s($title);
        } else {
            return s($textlib->substr($title, 0, $max-3).'...');
        }
    }

    public function get_content() {
        global $CFG, $USER, $OUTPUT;

        if (has_capability('block/papercut:view', $this->context)) {
            $this->content = new stdClass;
            $this->content->footer = '';
            $this->content->items = array();
            $this->content->icons = array();
            $cfg = get_config('block_papercut');

            $strnobalance = get_string('nobalance', 'block_papercut');
            $image = $OUTPUT->pix_icon('balance_not_available', $strnobalance, 'block_papercut');
            $http = $cfg->https ? 'https://' : 'http://';
            $serverurl = $http.$cfg->server_url.':'.$cfg->server_port;

            $this->content->text .= html_writer::tag('div', $image, array('id' => 'widgetBalance'));
            $this->content->text .= html_writer::tag('div', '', array('id' => 'widgetEnvironment'));

            $jsmodule = array(
                'name'  =>  'block_papercut',
                'fullpath'  =>  '/blocks/papercut/module.js',
                'requires'  =>  array('base', 'node')
            );

            $jsdata = array(
                'serverurl' => $serverurl,
                'username' => $USER->username
            );

            $this->page->requires->js_init_call('M.block_papercut.init',
                                                $jsdata,
                                                false,
                                                $jsmodule);

            return $this->content;
        }
    }

    public function instance_allow_config() {
         return true;
    }

    public function has_config() {
        return true;
    }

}
