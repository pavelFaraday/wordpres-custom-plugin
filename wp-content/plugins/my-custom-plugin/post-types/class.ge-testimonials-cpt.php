<?php
// Create Post Type class 
if(!class_exists('GE_Testimonials_Post_type')) {
    class GE_Testimonials_Post_type {
        public function __construct(){
            // firing post_type func inside "init" action hook
            add_action('init', array($this, 'create_post_type'));
            // firing metabox in "add_meta_boxes hook
            add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
            // save post
            add_action('save_post', array($this, 'save_post'));
        }

        public function create_post_type()  {
            register_post_type(
                'ge-testimonials',
                array(
                    'label' => esc_html__( 'Testimonials', 'ge-testimonials' ),
                    'description'   => esc_html__( 'Testimonials', 'ge-testimonials' ),
                    'labels' => array(
                        'name'  => esc_html__( 'Testimonials', 'ge-testimonials' ),
                        'singular_name' => esc_html__( 'Testimonial', 'ge-testimonials' ),
                    ),
                    'public'    => true,
                    'supports'  => array( 'title', 'editor' ), // Remove 'thumbnail'
                    'hierarchical'  => false,
                    'show_ui'   => true,
                    'show_in_menu'  => true,
                    'menu_position' => 5,
                    'show_in_admin_bar' => true,
                    'show_in_nav_menus' => true,
                    'can_export'    => true,
                    'has_archive'   => true,
                    'exclude_from_search'   => false,
                    'publicly_queryable'    => true,
                    'show_in_rest'  => true,
                    'menu_icon' => 'dashicons-testimonial',
                )
            );
        }
        
        public function add_meta_boxes(){
            add_meta_box(
                'ge_testimonials_meta_box', 
                esc_html__('Testimonials Options', 'ge-testimonials'),
                array($this, 'add_inner_meta_boxes'),
                'ge-testimonials',
                'normal',
                'high'
            );
        }
        public function add_inner_meta_boxes($post) {
            require_once(GE_TESTIMONIALS_PATH . 'views/ge-testimonials_metabox.php');
        }
        

        public function save_post($post_id) {
            if( isset( $_POST['ge_testimonials_nonce'] ) ){
                if( ! wp_verify_nonce( $_POST['ge_testimonials_nonce'], 'ge_testimonials_nonce' ) ){
                    return;
                }
            }
            if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
                return;
            }
            if( isset( $_POST['post_type'] ) && $_POST['post_type'] === 'ge-testimonials' ){
                if( ! current_user_can( 'edit_page', $post_id ) ){
                    return;
                }elseif( ! current_user_can( 'edit_post', $post_id ) ){
                    return;
                }
            }

            if (!empty($_FILES['testimonial_image']['name'])) {
                $upload_overrides = array('test_form' => false);
                $movefile = wp_handle_upload($_FILES['testimonial_image'], $upload_overrides);

                if ($movefile && !isset($movefile['error'])) {
                    update_post_meta($post_id, 'testimonial_image', $movefile['url']);
                } else {
                    // Handle error
                }
            }


            // Save data if comming from Metabox
            if (isset($_POST['action']) && $_POST['action'] == 'editpost') {
                /* 
                Variable pairs for each Metabox field:
                1. Field Values that are already saved in DB - params: (post ID, Key of the field, return value as a simple string)
                2. Field Values comming through the form 
                */
                $old_testimonial = get_post_meta( $post_id, 'testimonials_text', true ); 
                $new_testimonial = $_POST['testimonials_text'];
                $old_date    = get_post_meta( $post_id, 'ge_testimonials_date', true ); 
                $new_date    = $_POST['ge_testimonials_date'];
            
                /* 
                Update Metabox Fields Values in DB
                sanitize_text_field() - compares values, if they really changed.
                esc_url_raw() - Sanitizes a URL for database or redirect usage.
                */
                update_post_meta( $post_id, 'testimonials_text', sanitize_text_field( $new_testimonial ), $old_testimonial );
                update_post_meta( $post_id, 'ge_testimonials_date', sanitize_text_field( $new_date ), $old_date );
            }
            
            $testimonials_text = get_post_meta( $post->ID, 'testimonials_text', true );
            $date = get_post_meta( $post->ID, 'ge_testimonials_date', true );
        }
    }
}


