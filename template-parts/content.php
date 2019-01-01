<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Divine_Salon
 */
?>
<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="blog-description"> 
        <h2>
            <?php if(is_sticky()): ?>
                <i class="dashicons dashicons-admin-post"></i>
            <?php endif; ?> 
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>  
    	<p class="info"><i class="fa fa-calendar"></i><?php the_time(get_option('date_format')); ?> | <?php esc_html_e('by','divine-salon'); ?>  <?php the_author(); ?></p>         
        <?php if(has_post_thumbnail()){ the_post_thumbnail('divine-salon-thumb'); $divine_salon_post_cls = ""; } ?>
	    <p class="short-content"><?php echo wp_kses_post(wp_trim_words(get_the_content(),42,'...')); ?></p> 
    </div> 
</section>
