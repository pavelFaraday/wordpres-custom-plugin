<?php

class GE_Testimonials_Widget extends WP_Widget{
    //get basic info & register widget in constructor     
    public function __construct(){
        $widget_options = array(
            'description'   => __( 'Your most beloved testimonials', 'ge-testimonials' )
        );

        // Call parent class constructor
        parent::__construct(
            'ge-testimonials',
            'GE Testimonials',
            $widget_options
        );

        // Access the widget with "widgets_init" hook
        add_action(
            'widgets_init', function(){
                register_widget(
                    'GE_Testimonials_Widget'
                );
            }
        );

        /* Trigger assets/CSS only if Widget is being displayed on frontend
         - is_active_widget() - Determines whether a given widget is displayed on the front end.
        only returns true if widget is being shown on frontend!
        */
        if( is_active_widget( false, false, $this->id_base ) ){
            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
        }
    }


    public function enqueue(){
        wp_enqueue_style(
            'ge-testimonials-style-css',
            GE_TESTIMONIALS_URL . 'assets/css/frontend.css',
            array(),
            GE_TESTIMONIALS_VERSION,
            'all'
        );
    }

    // Create form in Widget Manager
    // $instance - array with form fields stored in DB
    public function form( $instance ){
        // Define Form Fields
        $title = isset( $instance['title'] ) ? $instance['title'] : '';
        $number = isset( $instance['number'] ) ? (int) $instance['number'] : 5;
        $image = isset( $instance['image'] ) ? (bool) $instance['image'] : false;
        $testimonials_text = isset( $instance['textual_content'] ) ? (bool) $instance['textual_content'] : false;
        $date = isset( $instance['company'] ) ? (bool) $instance['company'] : false;
        ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'ge-testimonials' ); ?>:</label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>">
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of testimonials to show', 'ge-testimonials' ); ?>:</label>
                <input type="number" class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" step="1" min="1" size="3" value="<?php echo esc_attr( $number ); ?>">
            </p>

            <p>
                <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'textual_content' ); ?>" name="<?php echo $this->get_field_name( 'textual_content' ); ?>" <?php checked( $testimonials_text ); ?>>
                <label for="<?php echo $this->get_field_id( 'textual_content' ); ?>"><?php esc_html_e( 'Display Testimonial Text?', 'ge-testimonials' ); ?></label>
            </p>

            <p>
                <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'company' ); ?>" name="<?php echo $this->get_field_name( 'company' ); ?>" <?php checked( $date ); ?>>
                <label for="<?php echo $this->get_field_id( 'company' ); ?>"><?php esc_html_e( 'Display Date?', 'ge-testimonials' ); ?></label>
            </p>

        <?php
    }

    // Display widgets content in the FrontEnd
    // $args - array containing Widget Markup HTML
    public function widget( $args, $instance ){
        $default_title = 'GE Testimonials';
        $title = ! empty( $instance['title'] ) ? $instance['title'] : $default_title;
        $number = ! empty( $instance['number'] ) ? $instance['number'] : 5;
        $testimonials_text = isset( $instance['textual_content'] ) ? $instance['textual_content'] : false;
        $date = isset( $instance['company'] ) ? $instance['company'] : false;

        echo $args['before_widget'];
        echo $args['before_title'] . $title . $args['after_title'];
        
        require( GE_TESTIMONIALS_PATH . 'views/ge-testimonials_widget.php' );
        
        echo $args['after_widget'];
    }

    // Update Widget Information in DB
    // We get information value [array] from $new_instance & overwrite value of $old_instance
    public function update( $new_instance, $old_instance ){
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );  // clean up a text field input by removing any potentially harmful characters or code
        $instance['number'] = (int) $new_instance['number'];
        $instance['image'] = ! empty ( $new_instance['image'] ) ? 1 : 0;
        $instance['textual_content'] = ! empty ( $new_instance['textual_content'] ) ? 1 : 0;
        $instance['company'] = ! empty ( $new_instance['company'] ) ? 1 : 0;
        return $instance;
    }
}