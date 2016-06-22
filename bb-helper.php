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
             add_action('wp_before_admin_bar_render', array(&$this, 'ps_bb_helper_admin_bar_render'), 100);
         } // END public function __construct

         /**
          * Activate the plugin
          */
         public static function activate() {
             // Do nothing
         } // END public static function activate

         /**
          * Deactivate the plugin
          */
         public static function deactivate() {
             // Do nothing
         } // END public static function deactivate


         /**
          * Adds admin bar items for easy access to the theme creator and editor
          */
         public function ps_bb_helper_admin_bar_render() {
             $this->ps_bb_helper_admin_bar_render_item('Beaver Helepr'); // Parent item
             $this->ps_bb_helper_admin_bar_render_item('Clear Cache', 'some_link_to_the_settings', 'Beaver Helepr');
             $this->ps_bb_helper_admin_bar_render_item('BAW Sub2', 'some_link_to_the_settings', 'Beaver Helepr');
         }

         /**
          * Adds menu parent or submenu item.
          * @param string $name the label of the menu item
          * @param string $href the link to the item (settings page or ext site)
          * @param string $parent Parent label (if creating a submenu item)
          *
          * @return void
          * */
         public function ps_bb_helper_admin_bar_render_item( $name, $href = '', $parent = '', $custom_meta = array() ) {
             global $wp_admin_bar;

         	if ( ! is_super_admin()
         		 || ! is_object( $wp_admin_bar )
         		 || ! function_exists( 'is_admin_bar_showing' )
         		 || ! is_admin_bar_showing() ) {
         		return;
         	}

             // Generate ID based on the current filename and the name supplied.
             $id = sanitize_key( basename(__FILE__, '.php' ) . '-' . $name );

             // Generate the ID of the parent.
             $parent = sanitize_key( basename(__FILE__, '.php' ) . '-' . $parent );

             // links from the current host will open in the current window

             $meta = strpos( $href, site_url() ) !== false ? array() : array( 'target' => '_blank' ); // external links open in new tab/window
             $meta = array_merge( $meta, $custom_meta );

             $wp_admin_bar->add_node( array(
                 'parent' => $parent,
                 'id' => $id,
                 'title' => $name,
                 'href' => $href,
                 'meta' => $meta,
             ) );
         }

     } // END class PS_Beaver_Helper
 } // END if(!class_exists('PS_Beaver_Helper'))

if( class_exists( 'PS_Beaver_Helper' ) ) {
    // Installation and uninstallation hooks
    register_activation_hook(__FILE__, array('PS_Beaver_Helper', 'activate'));
    register_deactivation_hook(__FILE__, array('PS_Beaver_Helper', 'deactivate'));

    // instantiate the plugin class
    $ps_beaver_helper = new PS_Beaver_Helper();
}
