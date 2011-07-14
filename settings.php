<?php
/********************************************************************************************************************
*
*	NOTICE OF COPYRIGHT    
*	
*	This file is part of PaperCut Block for Moodle.
*
*    	PaperCut Block for Moodle.
*    	Copyright (C) 2009 onwards Ian Tasker www.schoolsict.com
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

$settings->add(new admin_setting_configtext('block_papercut_title', get_string('title', 'block_papercut'),
                   get_string('clienttitle', 'block_papercut'), "Printing Quota", PARAM_RAW));

$settings->add(new admin_setting_configtext('block_papercut_server_url', get_string('serverurl', 'block_papercut'),
                   get_string('clientserverurl', 'block_papercut'), "", PARAM_RAW));
				   
$settings->add(new admin_setting_configtext('block_papercut_server_port', get_string('serverport', 'block_papercut'),
                   get_string('clientserverport', 'block_papercut'), "9191", PARAM_RAW));

?>