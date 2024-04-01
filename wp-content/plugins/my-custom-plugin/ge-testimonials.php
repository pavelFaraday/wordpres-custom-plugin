<?php

/**
* Plugin Name: My Custom Plugin
* Plugin URI: https://www.wordpress.org/my-custom-plugin
* Description: My plugin's description
* Version: 1.0
* Requires at least: 5.6
* Requires PHP: 7.0
* Author: Giorgi Epitashvili
* Author URI: https://www.linkedin.com/in/giorgi-epitashvili/
* License: GPL v2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: my-custom-plugin
* Domain Path: /languages
*/
/*
My Custom Plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
My Custom Plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with My Custom Plugin. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( !class_exists( 'GE_Testimonials' ) ){

    class GE_Testimonials{   

        public function __construct() {

            // Define constants used througout the plugin
            $this->define_constants(); 
            
            
            require_once(GE_TESTIMONIALS_PATH . 'post-types/class.ge-testimonials-cpt.php');
            // instantiate class
            $GETestimonialsPostType = new GE_Testimonials_Post_type();



            require_once( GE_TESTIMONIALS_PATH . 'widgets/class.ge-testimonials-widget.php' );
            // instantiate class
            $GETestimonialsWidget = new GE_Testimonials_Widget();

        }

         /**
         * Define Constants
         */
        public function define_constants(){
            // Path/URL to root of this plugin, with trailing slash.
            define ( 'GE_TESTIMONIALS_PATH', plugin_dir_path( __FILE__ ) );
            define ( 'GE_TESTIMONIALS_URL', plugin_dir_url( __FILE__ ) );
            define ( 'GE_TESTIMONIALS_VERSION', '1.0.0' );     
        }

        /**
         * Activate the plugin
         */
        public static function activate(){
            update_option('rewrite_rules', '' );
        }

        /**
         * Deactivate the plugin
         */
        public static function deactivate(){
            // unregister CPT when plugin is deactivated
            unregister_post_type('ge-testimonials');
            flush_rewrite_rules();
        }

        /**
         * Uninstall the plugin
         * Remove Entries from wp_options table
         * Remove data from widget_ge-testimonials
         */
        public static function uninstall(){
            delete_option( 'widget_ge-testimonials' );
            $posts = get_posts(
                array(
                    'post_type' => 'ge-testimonials',
                    'number_posts'  => -1,
                    'post_status'   => 'any'
                )
            );
            foreach( $posts as $post ){
                wp_delete_post( $post->ID, true );
            }
        }

    }
}

if( class_exists( 'GE_Testimonials' ) ){
    // Installation and uninstallation hooks
    register_activation_hook( __FILE__, array( 'GE_Testimonials', 'activate'));
    register_deactivation_hook( __FILE__, array( 'GE_Testimonials', 'deactivate'));
    register_uninstall_hook( __FILE__, array( 'GE_Testimonials', 'uninstall' ) );

    $GE_testimonials = new GE_Testimonials();
}