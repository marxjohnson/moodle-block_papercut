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
 * Defines settings for the Papercut block
 *
 * Allows configuration of the block title and the URL of the Papercut server.
 *
 * @package     block_papercut
 * @author      Mark Johnson <mark.johnson@tauntons.ac.uk>
 * @author      Ian Tasker
 * @copyright   2010 onwards Tauntons College, UK
 * @copyright   Original version Copyright (C) 2009 onwards Ian Tasker www.schoolsict.com
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$settings->add(new admin_setting_configtext(
    'block_papercut/title',
    get_string('title', 'block_papercut'),
    get_string('clienttitle', 'block_papercut'),
    "Printing Quota",
    PARAM_RAW
));

$settings->add(new admin_setting_configtext(
    'block_papercut/server_url',
    get_string('serverurl', 'block_papercut'),
    get_string('clientserverurl', 'block_papercut'),
    "",
    PARAM_RAW
));

$settings->add(new admin_setting_configtext(
    'block_papercut/server_port',
    get_string('serverport', 'block_papercut'),
    get_string('clientserverport', 'block_papercut'),
    "9191",
    PARAM_RAW
));

$settings->add(new admin_setting_configcheckbox(
    'block_papercut/https',
    get_string('usehttps', 'block_papercut'),
    get_string('clientusehttps', 'block_papercut'),
    0,
    PARAM_BOOL
));
