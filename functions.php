<?php
/**
 * DCSF Divine functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Divine_Salon
 */
define("DIVINE_SALON_CSS", get_template_directory_uri() . "/css/" );
define("DIVINE_SALON_INC", get_template_directory_uri() . "/inc/" );
define("DIVINE_SALON_DURI", get_template_directory_uri() ."/" );
define("DIVINE_SALON_JS", get_template_directory_uri() . "/js/" );

if ( ! function_exists( 'divine_salon_setup' ) ) :

function divine_salon_setup() {
	
	load_theme_textdomain( 'divine-salon', get_template_directory() . '/languages' );
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' ); 
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
 
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'divine-salon-thumb', 680,390,true ); 

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'mainmenu' => esc_html__( 'Main Menu', 'divine-salon' ),
	) );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/**
	 * Custom Logo
	 */ 
  	add_theme_support( 'custom-logo', array(
	   'height'      => 39,
	   'width'       => 139,
	   'flex-width'  => true,
       'flex-height' => true,'header-text' => array( 'logo-area' ),
	) );

	/**
	 * Custom Header
	 */ 
	add_theme_support( 'custom-header', array(
		'flex-width'    => true, 
		'flex-height'    => true, 
		'default-image' => '',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', divine_salon_fonts_url() ) );

}
endif;
add_action( 'after_setup_theme', 'divine_salon_setup' );

/**
 *	Register Fonts
 */
function divine_salon_fonts_url() {
    $divine_salon_font = '';
     
	$raleway = _x( 'on', 'Raleway font: on or off', 'divine-salon' );
	$open_sans = _x( 'on', 'Open Sans font: on or off', 'divine-salon' );
	$dancing = _x( 'on', 'Dancing Script font: on or off', 'divine-salon' );
	 
	if ( 'off' !== $open_sans || 'off' !== $raleway || 'off' !== $dancing ) {
		$font_families = array();
 
		if ( 'off' !== $raleway ) {
		$font_families[] = 'Raleway:400,100,200,300,500,600,700,800,900';
		}
		 
		if ( 'off' !== $open_sans ) {
		$font_families[] = 'Open Sans:400,300,600,700,800';
		}
		 
		if ( 'off' !== $dancing ) {
		$font_families[] = 'Dancing Script:400,700';
		}
		 
		$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( 'latin,latin-ext' ),
		);
		$divine_salon_font = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}
    return esc_url_raw( $divine_salon_font );
}
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function divine_salon_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'divine_salon_content_width', 640 );
}
add_action( 'after_setup_theme', 'divine_salon_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function divine_salon_scripts() {
	global $post; 
 	// LOAD FONTS
	 wp_enqueue_style( 'divine-salon-fonts', divine_salon_fonts_url(), array(), '1.0.0' );

	wp_enqueue_style( 'bootstrap', DIVINE_SALON_CSS . 'bootstrap.min.css' ); 
	wp_enqueue_style( 'font-awesome', DIVINE_SALON_CSS . 'font-awesome.min.css' ); 
	wp_enqueue_style( 'divine-salon-style', get_stylesheet_uri() );
	wp_enqueue_style( 'divine-salon-responsive', DIVINE_SALON_CSS . 'responsive.css' ); 

	wp_enqueue_script( 'modernizr', DIVINE_SALON_JS . 'modernizr.js', array('jQuery'), '2.8.3', false ); 
	wp_enqueue_script( 'bootstrap', DIVINE_SALON_JS . 'bootstrap.js', array('jquery','jquery-masonry'), '3.3.5', true );
	wp_enqueue_script( 'meanmenu', DIVINE_SALON_JS . 'jquery.meanmenu.js', array(), '2.0.8', true );  
	wp_enqueue_script( 'divine-salon-main', DIVINE_SALON_JS . 'main.js', array(), '1.0', true );
	wp_enqueue_script( 'divine-salon-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'divine-salon-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	// inline style css
	$divine_salon_custom_css = "";  

    $divine_salon_text_color = get_theme_mod( 'header_textcolor' );
    if(isset($divine_salon_text_color) && !empty($divine_salon_text_color)){ 
        $divine_salon_custom_css .= "
            .heading-cmn-area h2{
                color:#{$divine_salon_text_color};
            }
        ";
    } 
    if(is_page()){ 
    	$divine_salon_hdr_img_id = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full',true); 
    	if(has_post_thumbnail()){
    		$divine_salon_hdr_img = $divine_salon_hdr_img_id[0];
    	}else{
    		$divine_salon_hdr_img = get_header_image();	
    	}
    }else{
    	$divine_salon_hdr_img = get_header_image();	
    }
    
    if(isset($divine_salon_hdr_img) && !empty($divine_salon_hdr_img)){ 
        $divine_salon_custom_css .= "
			.about-banner-area{
                background-image: url({$divine_salon_hdr_img}); 
			}
        ";
    }  
 
    wp_add_inline_style( 'divine-salon-style', $divine_salon_custom_css );
 

}
add_action( 'wp_enqueue_scripts', 'divine_salon_scripts' );
 
/**
 * divine_salon nav menu
 */ 
function divine_salon_main_menu(){
	wp_nav_menu( array(
		'theme_location'    => 'mainmenu',
		'depth'             => 3,
		'container'         => false,
		'menu_id'        	=> '',
		'menu_class'        => '',
		'fallback_cb'       => 'divine_salon_default_menu'
	));
}

/**
 * menu fallback
 */ 
if(is_user_logged_in()):
	function divine_salon_default_menu() {
		?>
	    <ul>                  
	    	<li><a href="<?php echo esc_url(admin_url('nav-menus.php')); ?>"><?php esc_html_e( 'Add Menu', 'divine-salon' ); ?></a></li>
		</ul>
		<?php
	}
endif;

/**
 * Divine Salon Pagination.
 */
if ( ! function_exists( 'divine_salon_pagination' ) ){
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 * Based on paging nav function from Twenty Fourteen
	 */ 
	function divine_salon_pagination() {
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}
		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );
		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}
		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';
		$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';
		// Set up paginated links.
		$links = paginate_links( array(
			'base'     => $pagenum_link,
			'format'   => $format,
			'total'    => $GLOBALS['wp_query']->max_num_pages,
			'current'  => $paged,
			'mid_size' => 3,
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
			'next_text' => '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
			'type'      => 'list',
		) );
		if ( $links ) :
		?>  
		<div class="pagination-area">
		    <?php echo wp_kses_post($links); ?> 
		</div> 
		<?php
		endif;
	}
}

/**
 * DCSF Divine comment list modify
 */ 
function divine_salon_comments($comment, $args, $depth) { ?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>"> 
      <section class="clearfix">
        <figure><?php echo get_avatar( $comment, 120 ); ?></figure>
        <div class="cbox">
          <h4><?php comment_author_link() ?></h4>
          <span><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>
          <h6><?php 
          	/* translators: comment date and time */
          	printf( esc_html__( '%1$s @ %2$s','divine-salon' ), get_comment_date( '', $comment ), get_comment_time() ); ?></h6>
			<?php if ($comment->comment_approved == '0') : ?>
				<p><em><?php esc_html_e('Your comment is awaiting moderation.','divine-salon'); ?></em></p>
			<?php endif; ?>
	    	<?php comment_text(); ?>
        </div>
      </section>    
<?php } 

/**
 * Comment box title change
 */   
add_filter( 'comment_form_defaults', 'divine_salon_comment_form_allowed_tags' );
function divine_salon_comment_form_allowed_tags( $defaults ) { 
	$defaults['title_reply'] =  esc_html__( 'Leave Your Comment','divine-salon' );
	$defaults['comment_notes_before'] =  '';
	$defaults['title_reply_before'] =  '<h3>';
	$defaults['title_reply_after'] =  '</h3>';
    $defaults['comment_field'] = '';
	$defaults['label_submit'] =  esc_html__( 'Submit','divine-salon' ); 
	return $defaults;
}
/**
 * Comment form field order
 */   
add_action( 'comment_form_after_fields', 'divine_salon_add_textarea' );
add_action( 'comment_form_logged_in_after', 'divine_salon_add_textarea' );
function divine_salon_add_textarea()
{ 
   	echo '<p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="'.esc_attr('Your Comment*','divine-salon').'" cols="45" rows="8" maxlength="65525"  required="required"></textarea></p>';
}
/**
 * remove comment fields
 */  
function divine_salon_remove_comment_fields($fields) {
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
    unset($fields['url']);
    $fields['author'] = '<p class="comment-form-author"> <input id="author" placeholder="'.esc_attr('Name*','divine-salon').'" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
    '" size="30"' . $aria_req . ' /></p>';
    $fields['email'] = '<p class="comment-form-email"><input id="email" placeholder="'.esc_attr('Email*','divine-salon').'" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' /></p>';
    return $fields;
}
add_filter('comment_form_default_fields','divine_salon_remove_comment_fields');
 
   
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function divine_salon_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'divine-salon' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'divine-salon' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget', 'divine-salon' ),
		'id'            => 'sidebar-f',
		'description'   => esc_html__( 'Add widgets here.', 'divine-salon' ),
		'before_widget' => '<div id="%1$s" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 %2$s"><div class="single-footer">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'divine_salon_widgets_init' );


/**
 *  Divine Salon BreadCrumb
 */ 
function divine_salon_breadcrumb(){
	global $post,$dcsf_divine;	
	$dcsf_divine_blog_title=  esc_html__('Blog','divine-salon');
	if(is_front_page() && is_home()){ 
		echo esc_html($dcsf_divine_blog_title); 

	}elseif(is_home() || is_page()){ 
	    if( is_page()){
	        $dcsf_divine_ptitle = get_the_title();
		}else{
			$dcsf_divine_ptitle =  get_the_title( get_option('page_for_posts', true) );
		}
	  echo esc_html($dcsf_divine_ptitle);
	}elseif(is_single()){
		the_title();
	}elseif(is_search()){    
		echo '<span>'.get_search_query().'</span>'; 
	}elseif(is_category() || is_tag()) {
		single_cat_title("", true);
	}elseif(is_archive()){ 
		if ( class_exists('WooCommerce' ) ){
			if(is_shop() || is_product_category() || is_product_tag() ){
				woocommerce_page_title(); 
			}else{ 
				echo get_the_date('F Y'); 
			} 
		}else{ 
			echo get_the_date('F Y'); 
		}
	}elseif(is_404()){ 
		esc_html_e('404 Error','divine-salon');
	}else{ 
		the_title();
	}
}

/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'divine_salon_loop_columns');
if (!function_exists('divine_salon_loop_columns')) {
	function divine_salon_loop_columns() {
		return 3;  
	}
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
require get_template_directory() . '/inc/divine-framework-options.php'; 
  