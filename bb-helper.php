<?php
/**
 *
 * Plugin Name: Beaver Helper
 * Plugin URI: https://wpbeaveraddons.com/
 * Description: This plugin adds useful admin links and resources for the Beaver Builder plugin to the WordPress Toolbar / Admin Bar.
 * Version: 1.0.0
 * Author: Puneet Sahalot
 * Author URI: https://wpbeaveraddons.com/
 * License: GPL-2.0+
 * License URI: http://www.opensource.org/licenses/gpl-license.php
 * Text Domain: ps-bb-helper
 * Domain Path: /languages/
 *
 * Copyright (c) 2016 Puneet Sahalot
 *
 *     This file is part of Beaver Helper,
 *     a plugin for WordPress.
 *
 *     Beaver Helper is free software:
 *     You can redistribute it and/or modify it under the terms of the
 *     GNU General Public License as published by the Free Software
 *     Foundation, either version 2 of the License, or (at your option)
 *     any later version.
 *
 *     Beaver Helper is distributed in the hope that
 *     it will be useful, but WITHOUT ANY WARRANTY; without even the
 *     implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR
 *     PURPOSE. See the GNU General Public License for more details.
 *
 *     You should have received a copy of the GNU General Public License
 *     along with WordPress. If not, see <http://www.gnu.org/licenses/>.
 */
/**
 * Main plugin file.
 * This plugin adds useful admin links and resources for the Beaver Builder plugin to the WordPress Toolbar / Admin Bar.
 *
 * @package   Beaver Helper
 * @author    Puneet Sahalot
 * @link      https://wpbeaveraddons.com
 * @copyright Copyright (c) 2016, Puneet Sahalot - IdeaBox Creations
 */

 if(!class_exists('PS_Beaver_Helper'))
 {
     class PS_Beaver_Helper
     {
         /**
          * Construct the plugin object
          */
         public function __construct() {
             // register actions
             add_action('admin_bar_menu', array(&$this, 'ps_bb_helper_menu'), 98);
         } // END public function __construct

         /**
          * Adds admin bar items for easy access to the theme creator and editor
          */
         public function ps_bb_helper_menu() {
             /**
         	 * Required WordPress cabability to display new toolbar / admin bar entry
         	 * Only showing items if toolbar / admin bar is activated and user is logged in!
         	 *
         	 * @since 1.0.0
         	 */
         	if ( ! is_user_logged_in() || ! is_admin_bar_showing() ) {
         		return;
         	}

            /** Show these items only if Beaver Builder plugin is actually installed */
	        if ( ( function_exists( 'is_plugin_active' ) && ( is_plugin_active( 'beaver-builder-lite-version/fl-builder.php' ) || is_plugin_active ('bb-plugin/fl-builder.php') ) ) ) {
                global $wp_admin_bar;
                // set BB active variable for later use.
                $bb_active = 'bb_is_active';

                if ( current_user_can('manage_options') ) {

                        // Add top level link
                        $args = array(
                    		'id'          => 'beaver-helper',
                    		'title'       => __('Beaver Helper', 'ps-bb-helper'),
                    		'href'        => '#'
                    	);
                    	$wp_admin_bar->add_node($args);

                        // Add first child link
                        $args = array(
                            'id'        => 'beaver-facebook-group',
                            'title'     => __('Facebook Group', 'ps-bb-helper'),
                            'href'      => 'https://www.facebook.com/groups/beaverbuilders/',
                            'parent'    => 'beaver-helper',
                            'meta'      => array (
                                        'class'     => 'beaver-helper-facebook',
                                        'title'     => 'Visit BB Facebook Group'
                            )
                        );
                        $wp_admin_bar->add_node($args);

                        // Add second child link
                        $args = array(
                            'id'        => 'beaver-slack-channel',
                            'title'     => __('Slack Channel', 'ps-bb-helper'),
                            'href'      => 'https://beaverbuilders.herokuapp.com/',
                            'parent'    => 'beaver-helper',
                            'meta'      => array (
                                        'class'     => 'beaver-helper-slack',
                                        'title'     => 'Join BB Slack Channel'
                            )
                        );
                        $wp_admin_bar->add_node($args);

                        // Add third child link
                        $args = array(
                            'id'        => 'beaver-kb',
                            'title'     => __('Knowledge Base', 'ps-bb-helper'),
                            'href'      => 'https://www.wpbeaverbuilder.com/knowledge-base/',
                            'parent'    => 'beaver-helper',
                            'meta'      => array (
                                        'class'     => 'beaver-kb',
                                        'title'     => 'Visit Knowledge Base'
                            )
                        );
                        $wp_admin_bar->add_node($args);

                        // Add fourth child link
                        $args = array(
                            'id'        => 'beaver-official-support',
                            'title'     => __('Official Support', 'ps-bb-helper'),
                            'href'      => 'https://www.wpbeaverbuilder.com/beaver-builder-support/',
                            'parent'    => 'beaver-helper',
                            'meta'      => array (
                                        'class'     => 'beaver-support',
                                        'title'     => 'Sumbit a Support Ticket'
                            )
                        );
                        $wp_admin_bar->add_node($args);
                }
            }


         }



         /*
            * add a group of links under a parent link
            */

            // Add a parent shortcut link

            public function custom_toolbar_link($wp_admin_bar) {
            	$args = array(
            		'id' => 'wpbeginner',
            		'title' => 'WPBeginner',
            		'href' => 'https://www.wpbeginner.com',
            		'meta' => array(
            			'class' => 'wpbeginner',
            			'title' => 'Visit WPBeginner'
            			)
            	);
            	$wp_admin_bar->add_node($args);

            // Add the first child link

            	$args = array(
            		'id' => 'wpbeginner-guides',
            		'title' => 'WPBeginner Guides',
            		'href' => 'http://www.wpbeginner.com/category/beginners-guide/',
            		'parent' => 'wpbeginner',
            		'meta' => array(
            			'class' => 'wpbeginner-guides',
            			'title' => 'Visit WordPress Beginner Guides'
            			)
            	);
            	$wp_admin_bar->add_node($args);

            // Add another child link
            $args = array(
            		'id' => 'wpbeginner-tutorials',
            		'title' => 'WPBeginner Tutorials',
            		'href' => 'http://www.wpbeginner.com/category/wp-tutorials/',
            		'parent' => 'wpbeginner',
            		'meta' => array(
            			'class' => 'wpbeginner-tutorials',
            			'title' => 'Visit WPBeginner Tutorials'
            			)
            	);
            	$wp_admin_bar->add_node($args);

            // Add a child link to the child link

            $args = array(
            		'id' => 'wpbeginner-themes',
            		'title' => 'WPBeginner Themes',
            		'href' => 'http://www.wpbeginner.com/category/wp-themes/',
            		'parent' => 'wpbeginner-tutorials',
            		'meta' => array(
            			'class' => 'wpbeginner-themes',
            			'title' => 'Visit WordPress Themes Tutorials on WPBeginner'
            			)
            	);
            	$wp_admin_bar->add_node($args);

            }


     } // END class PS_Beaver_Helper
 } // END if(!class_exists('PS_Beaver_Helper'))

if( class_exists( 'PS_Beaver_Helper' ) ) {

    // instantiate the plugin class
    $ps_beaver_helper = new PS_Beaver_Helper();
}
