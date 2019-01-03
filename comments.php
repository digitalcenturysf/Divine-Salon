<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Divine_Salon
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?> 
<?php
// You can start editing here -- including this comment!
if ( have_comments() ) : ?>

	<div class="blog-author-bx blog-recent-bx">
		<h3><?php esc_html_e('Recent Comments','divine-salon'); ?></h3>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<div class="nav-links"> 
			<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'divine-salon' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'divine-salon' ) ); ?></div> 
		</div><!-- .nav-links --> 
		<?php endif; // Check for comment navigation. ?>
		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ul',
					'callback'   => 'divine_salon_comments'
				) );
			?>
		</ol><!-- .comment-list -->
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="nav-links"> 
				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'divine-salon' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'divine-salon' ) ); ?></div> 
			</div><!-- .nav-links --> 
		<?php
		endif; // Check for comment navigation.
		?>

	</div>
<?php
	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?> 
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'divine-salon' ); ?></p>
	<?php
	endif;  
	?> 
	<?php comment_form(); ?>

