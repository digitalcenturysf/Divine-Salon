<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Divine_Salon
 */ 
get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="blog-area-content saloncer-area">
			  <div class="container">
			    <div class="row"> 
			      <div class="col-lg-8 col-md-8 latest-blog-area">
			        <div class="blog-box"> 
						<?php
						if ( have_posts() ) :  
							/* Start the Loop */
							while ( have_posts() ) : the_post();  
									/*
									 * Include the Post-Format-specific template for the content.
									 * If you want to override this in a child theme, then include a file
									 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
									 */
									get_template_part( 'template-parts/content'); 
							endwhile; 
							
						else : 
							get_template_part( 'template-parts/content', 'none' ); 
						endif; ?> 
			        </div>
			        <div class="clearfix"></div>
			        <?php divine_salon_pagination(); ?> 
			      </div> 
				   <div class="col-lg-4 col-md-4 sidebar-area">
				       <?php get_sidebar(); ?>
				   </div> 
			    </div>
			  </div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer();