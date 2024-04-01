<?php 
    // create variables to get values with get_post_meta() func
    $testimonials_text = get_post_meta( $post->ID, 'testimonials_text', true );
    $date = get_post_meta( $post->ID, 'ge_testimonials_date', true );
?>

<table class="form-table ge-testimonials-metabox">
<input type="hidden" name="ge_testimonials_nonce" value="<?php echo wp_create_nonce( "ge_testimonials_nonce" ); ?>">
    <tr>
        <th>
            <label for="testimonials_text"><?php esc_html_e( 'User Testimonial', 'ge-testimonials' ); ?></label>
        </th>
        <td>
            
            <input 
                type="text" 
                name="testimonials_text" 
                id="testimonials_text" 
                class="regular-text textual_content"
                value="<?php echo (isset($testimonials_text)) ? esc_html($testimonials_text) : ''; ?>" 
            >
            <!-- Display Field Value if it exists in DB, otherwise show empty string -->
        </td>
    </tr>
    <tr>
        <th>
            <label for="ge_testimonials_date"><?php esc_html_e( 'Date', 'ge-testimonials' ); ?></label>
        </th>
        <td>
            <input 
                type="date" 
                name="ge_testimonials_date" 
                id="ge_testimonials_date" 
                class="regular-text"
                value="<?php echo (isset($date)) ? esc_html($date) : ''; ?>"
            >
        </td>
    </tr>

    <tr>
        <th>
            <label for="testimonial_image"><?php esc_html_e('Testimonial Image', 'ge-testimonials'); ?></label>
        </th>
        <td>
            <input type="file" id="testimonial_image" name="testimonial_image" accept="image/*">
        </td>
    </tr>

</table>