<?php
    // Loop Settings
    $testimonials = new WP_Query(
        array(
            'post_type' => 'ge-testimonials',
            'posts_per_page'    => $number,
            'post_status'   => 'publish'
        )
    );

    // Loop Widget Content
    if( $testimonials->have_posts() ):
        while( $testimonials->have_posts() ):
            $testimonials->the_post();
            $testimonial_meta = get_post_meta( get_the_ID(), 'testimonials_text', true );
            $date_meta = get_post_meta( get_the_ID(), 'ge_testimonials_date', true );
            $image_url = get_post_meta(get_the_ID(), 'testimonial_image', true);
?>
    <!-- HTML Template for widget Content -->
    <div class="testimonial-item">
        <div class="content">
            <?php if (!empty($image_url)) : ?>
                <div class="thumb">
                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php esc_attr_e('Testimonial Image', 'ge-testimonials'); ?>">
                </div>
            <?php endif; ?>
            <?php if ($testimonials_text) : ?>
                <span class="text"><?php echo esc_html($testimonial_meta); ?></span>
            <?php endif; ?>
        </div>
        <div class="meta">
            <?php if ($date) : ?>
                <span class="date"> Created in <a href="<?php echo esc_attr($url_meta) ?>"><?php echo esc_html($date_meta); ?></a></span>
            <?php endif; ?>
        </div>
</div>
<?php 
        endwhile;
    wp_reset_postdata(); 
endif;
?>