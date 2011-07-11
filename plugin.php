<?php
/*
Plugin Name: RSS Note
Plugin URI: http://github.com/tommcfarlin/rss-note
Description: Adds a short note in each post viewed in an RSS reader linking readers back to your blog.
Version: 1.0
Author: Tom McFarlin
Author URI: http://tommcfarlin.com
License:

    Copyright 2011 Tom McFarlin (tom@tommcfarlin.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
    
*/

class RSS_Note {
	 
	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/
	
	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	function __construct() {
	
    // Define constnats used throughout the plugin
    $this->init_plugin_constants();
  
		load_plugin_textdomain(PLUGIN_LOCALE, false, dirname(plugin_basename(__FILE__)) . '/lang');
		
    // add the note to both the excerpt and the main feed
    add_filter('the_content', array($this, 'display_rss_note'));
    add_filter('the_excerpt_rss', array($this, 'display_rss_note'));

	} // end constructor
	
	/*--------------------------------------------*
	 * Core Functions
	 *---------------------------------------------*/
	
  /**
   * Appends a short message at the footer of each post viewed in an RSS reader
   * reminding users to visit your site.
   */
  public function display_rss_note($content) {
    
    if(is_feed()) {
    
			$content .= '<div class="rss-note">';
				$content .= '<p>';
          $content .= __('Thanks for reading! Be sure to catch up on the rest of my posts at ', PLUGIN_LOCALE);
          $content .= '<a href="' . get_bloginfo('url') . '">';
            $content .= get_bloginfo('name');
          $content .= '</a>!';
        $content .= '</p>';
			$content .= '</div>';
			
		} // end if
		
		return $content;
    
	} // end filter_method_name
  
	/*--------------------------------------------*
	 * Private Functions
	 *---------------------------------------------*/
   
  /**
   * Initializes constants used for convenience throughout 
   * the plugin.
   */
  private function init_plugin_constants() {
  
    if(!defined('PLUGIN_LOCALE')) {
      define('PLUGIN_LOCALE', 'rss-note-locale');
    } // end if
    
    if(!defined('PLUGIN_NAME')) {
      define('PLUGIN_NAME', 'RSS Note');
    } // end if

    if(!defined('PLUGIN_SLUG')) {
      define('PLUGIN_SLUG', 'rss-note-slug');
    } // end if
  
  } // end init_plugin_constants
  
} // end class
new RSS_Note();
?>