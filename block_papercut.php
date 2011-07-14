<?php
/********************************************************************************************************************
*
*	NOTICE OF COPYRIGHT
*
*	This file is part of PaperCut Block for Moodle.
*
*    	Papercut Block for Moodle.
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

    class block_papercut extends block_base
	{

		function init()
		{
			$this->title = get_string('blockname', 'block_papercut');
			$this->version = 2009070500;
		}

		function specialization()
		{
			global $CFG;

			if (!empty($this->config) && !empty($this->config->title))
			{
		            // There is a customized block title, display it
		            $this->title = $this->config->title;
		       }
			else
			{
			     $this->title = $CFG->block_papercut_title;
		    }
		}


    	function format_title($title,$max=64)
		{

			$textlib = textlib_get_instance();

        	if ($textlib->strlen($title) <= $max)
			{
		    	return s($title);
		    }
			else
			{
            	return s($textlib->substr($title,0,$max-3).'...');
        	}
    	}

		function get_content()
		{
			global $CFG,$USER;

			if(!isguest($USER->id) && $USER->username<>"admin")
			{
				$this->content = new stdClass;
        		$this->content->footer = '';
			    $this->content->items = array();
			    $this->content->icons = array();

				$serverip =  explode('.',$_SERVER['SERVER_ADDR']);
				$internal = address_in_subnet(getremoteaddr(),$serverip[0].'.'.$serverip[1]);

				if (strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 6')>0)
				{
					if($internal)
					{
						$this->content->text .= require_js($CFG->wwwroot .'/blocks/papercut/lib/supersleight.js');
						$this->content->text .= require_js($CFG->wwwroot .'/blocks/papercut/lib/supersleight-min.js');
						$this->content->text .= '<script type="text/javascript">  $(function() { $(\'body\').supersleight({shim: \'http://'.$CFG->block_papercut_server_url.':'.$CFG->block_papercut_server_port.'/css/pngHack/transparent.gif\' }); </script>';
						if(!file_exists($CFG->wwwroot .'/x.gif'))
						{
							copy($CFG->wwwroot .'/blocks/papercut/pix/x.gif',$CFG->wwwroot .'/x.gif');
						}
					}
				}
				if($internal)
				{
					$this->content->text .= '<script type="text/javascript" src="http://'.$CFG->block_papercut_server_url.':'.$CFG->block_papercut_server_port.'/content/widgets/widgets.js"></script>';
				}
				$this->content->text .= '<script type="text/javascript"> var pcUsername = "'. $USER->username .'"; var pcServerURL = \'http://'. $CFG->block_papercut_server_url.':'.$CFG->block_papercut_server_port.'\'; pcGetUserDetails(); </script>';

				$this->content->text .= '<div id="widgetBalance" style="padding-left: 1.5em;"><img src="'.$CFG->wwwroot .'/blocks/papercut/pix/balance_not_avaliable.png" /><!-- User Balance widget will be rendered here --></div>';
				$this->content->text .= '<div id="widgetEnvironment" style="padding-left: 1.5em;"><!-- Environmental Impact widget will be rendered here --></div>';

				if ($internal)
				{
					$this->content->text .= '<script type="text/javascript"> pcInitUserEnvironmentalImpactWidget(\'widgetEnvironment\');</script>';
					$this->content->text .= '<script type="text/javascript"> pcInitUserBalanceWidget(\'widgetBalance\'); </script>';
				}

				return $this->content;
			}
		}

		function instance_allow_config()
		{
		     return true;
		}

		function has_config() {return true;}


}
?>