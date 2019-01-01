<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Divine_Salon
 */ 
get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="blog-single-area saloncer-area">
			  <div class="container">
			    <div class="row"> 
			      <div class="col-lg-9 col-md-9">
					<?php
					while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/content', 'single' );
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					endwhile; // End of the loop.
					?>
			      </div> 
				   <div class="col-lg-3 col-md-3 sidebar-area">
				       <?php get_sidebar(); ?>
				   </div> 
			    </div>
			  </div>
			</div> 
		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer();
