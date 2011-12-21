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
 * Defines the capabilities for the Quick Course List block
 *
 * Defines block/papercut:view, which allows users to see the block
 *
 * @package     block_papercut
 * @author      Mark Johnson <mark.johnson@tauntons.ac.uk>
 * @author      Ian Tasker
 * @copyright   2010 onwards Tauntons College, UK
 * @copyright   Original version Copyright (C) 2009 onwards Ian Tasker www.schoolsict.com
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$capabilities = array(

    'block/papercut:view' => array(

        'captype' => 'view',
        'contextlevel' => CONTEXT_BLOCK,
        'archetypes' => array(
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'coursecreator' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        )
    )

);
