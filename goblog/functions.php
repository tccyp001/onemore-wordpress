<?php
// Load Localization Files
$lang_dir = get_template_directory() . '/lang';
load_theme_textdomain('bloompixel', $lang_dir);

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/inc/options/ReduxCore/framework.php' ) ) {
	require_once( dirname( __FILE__ ) . '/inc/options/ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/inc/options/settings/settings-config.php' ) ) {
	require_once( dirname( __FILE__ ) . '/inc/options/settings/settings-config.php' );
}

require_once( dirname( __FILE__ ) . '/inc/plugins/class-tgm-plugin-activation.php' );
require_once( dirname( __FILE__ ) . '/inc/plugins/required-class.php' );

/*-----------------------------------------------------------------------------------*/
/* Sets up the content width value based on the theme's design and stylesheet.
/*-----------------------------------------------------------------------------------*/
if ( ! isset( $content_width ) )
	$content_width = 768;

/*-----------------------------------------------------------------------------------*/
/* Sets up theme defaults and registers the various WordPress features that
/* GoBlog supports.
/*-----------------------------------------------------------------------------------*/
function bpxl_theme_setup() {
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
	
	// This theme supports the following post formats.
	add_theme_support( 'post-formats', array( 'gallery', 'link', 'quote', 'video', 'image', 'status', 'audio' ) );
	
	// Register WordPress Custom Menus
	add_theme_support( 'menus' );
	register_nav_menu( 'main-menu', __( 'Main Menu', 'bloompixel' ) );
	
	// Register Post Thumbnails
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true );
	add_image_size( 'featured', 770, 360, true ); //featured
	add_image_size( 'featured570', 570, 365, true ); //featured570
	add_image_size( 'featured370', 370, 250, true ); //featured370
	add_image_size( 'related', 240, 185, true ); //related
	add_image_size( 'featuredthumb', 330, 160, true ); //related
	add_image_size( 'widgetthumb', 55, 55, true ); //widgetthumb
    
    /*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );
}
add_action( 'after_setup_theme', 'bpxl_theme_setup' );

/*-----------------------------------------------------------------------------------*/
/*	Post Meta Boxes
/*-----------------------------------------------------------------------------------*/
define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/inc/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/inc/meta-box' ) );
require_once ( RWMB_DIR . 'meta-box.php' );
include_once(get_template_directory() . '/inc/meta-box/meta-boxes.php');

get_template_part('inc/category-meta/Tax-meta-class/class-usage');

get_template_part('inc/theme-functions');

/*-----------------------------------------------------------------------------------*/
/*	Add Stylesheets
/*-----------------------------------------------------------------------------------*/
function bpxl_stylesheets() {
	global $bpxl_goblog_options;
	wp_enqueue_style( 'goblog-style', get_stylesheet_uri() );
	
	// Color Scheme
	if (is_single()) {
	   if (is_attachment()) {
           $category_ID = '';
       } else {
            $category = get_the_category();
            $category_ID =  $category[0]->cat_ID;
       }
	} elseif (is_category()) {
		$category_ID = get_query_var('cat');
	}
	if (is_single() || is_category()) {
		$bpxl_cat_color_1 = get_tax_meta($category_ID,'bpxl_color_field_id');
		$cat_bg = get_tax_meta($category_ID,'bpxl_bg_field_id');
		$cat_repeat = get_tax_meta($category_ID,'bpxl_category_repeat_id');
		$cat_attachment = get_tax_meta($category_ID,'bpxl_background_attachment_id');
		$cat_position = get_tax_meta($category_ID,'bpxl_background_position_id');
	}
	
	// Color Scheme 1
	$color_scheme_1 = "";
	if (is_single() || is_category()) {
		if (strlen($bpxl_cat_color_1) > 2 ) {
			$color_scheme_1 = $bpxl_cat_color_1;
		} else { $color_scheme_1 = $bpxl_goblog_options['bpxl_color_one']; }
	} elseif ($bpxl_goblog_options['bpxl_color_one'] != '') {
		$color_scheme_1 = $bpxl_goblog_options['bpxl_color_one'];
	}
	
	// Navigation
	$bpxl_nav_link_color = "";
	$bpxl_nav_link_hover_color = "";
	$bpxl_nav_dropdown_bg_color = "";
	$bpxl_nav_drop_link_color = "";
	$bpxl_nav_drop_link_hover_color = "";
	if ($bpxl_goblog_options['bpxl_nav_link_color']['regular'] != '') {
		$bpxl_nav_link_color = $bpxl_goblog_options['bpxl_nav_link_color']['regular'];
	}
	if ($bpxl_goblog_options['bpxl_nav_link_color']['hover'] != '') {
		$bpxl_nav_link_hover_color = $bpxl_goblog_options['bpxl_nav_link_color']['hover'];
	}
	if ($bpxl_goblog_options['bpxl_nav_drop_bg_color'] != '') {
		$bpxl_nav_dropdown_bg_color = $bpxl_goblog_options['bpxl_nav_drop_bg_color'];
	}
	if ($bpxl_goblog_options['bpxl_nav_drop_link_color']['regular'] != '') {
		$bpxl_nav_drop_link_color = $bpxl_goblog_options['bpxl_nav_drop_link_color']['regular'];
	}
	if ($bpxl_goblog_options['bpxl_nav_drop_link_color']['hover'] != '') {
		$bpxl_nav_drop_link_hover_color = $bpxl_goblog_options['bpxl_nav_drop_link_color']['hover'];
	}
	
	// Background Color
	if (!empty($bpxl_goblog_options['bpxl_body_bg']['background-color'])) { $background_color = $bpxl_goblog_options['bpxl_body_bg']['background-color']; } else { $background_color = '#f2f2f2'; }
	
	// Background Pattern
	$background_img = get_template_directory_uri(). "/images/bg.png";
	$bg_repeat = 'repeat';
	$bg_attachment = 'scroll';
	$bg_position = '0 0';
	$bg_size = 'auto';
	if (is_category()) {
		if ($cat_bg != '') { // Category Background Pattern
			$background_img = $cat_bg['src'];
			$bg_repeat = $cat_repeat;
			$bg_attachment = $cat_attachment;
			$bg_position = $cat_position;
		}
		elseif (!empty($bpxl_goblog_options['bpxl_body_bg']['background-image'])) { // Body Custom Background Pattern
			$background_img = $bpxl_goblog_options['bpxl_body_bg']['background-image'];
			$bg_repeat = $bpxl_goblog_options['bpxl_body_bg']['background-repeat'];
			$bg_attachment = $bpxl_goblog_options['bpxl_body_bg']['background-attachment'];
			$bg_size = $bpxl_goblog_options['bpxl_body_bg']['background-size'];
			$bg_position = $bpxl_goblog_options['bpxl_body_bg']['background-position'];
		} elseif ($bpxl_goblog_options['bpxl_bg_pattern'] != 'nopattern') { // Body Default Background Pattern
			$background_img = get_template_directory_uri(). "/images/".$bpxl_goblog_options['bpxl_bg_pattern'].".png";
			$bg_repeat = 'repeat';
			$bg_attachment = 'scroll';
			$bg_position = '0 0';
		}
	} elseif (!empty($bpxl_goblog_options['bpxl_body_bg']['background-image'])) { // Body Custom Background Pattern
		$background_img = $bpxl_goblog_options['bpxl_body_bg']['background-image'];
		$bg_repeat = $bpxl_goblog_options['bpxl_body_bg']['background-repeat'];
		$bg_attachment = $bpxl_goblog_options['bpxl_body_bg']['background-attachment'];
		$bg_size = $bpxl_goblog_options['bpxl_body_bg']['background-size'];
		$bg_position = $bpxl_goblog_options['bpxl_body_bg']['background-position'];
	} elseif ($bpxl_goblog_options['bpxl_bg_pattern'] != 'nopattern') { // Body Default Background Pattern
		$background_img = get_template_directory_uri(). "/images/".$bpxl_goblog_options['bpxl_bg_pattern'].".png";
		$bg_repeat = 'repeat';
		$bg_attachment = 'scroll';
		$bg_position = '0 0';
		$bg_size = 'auto';
	}
	
	// Layout Options
	$bpxl_custom_css = '';
	$bpxl_single_layout = '';
	if( is_single() || is_page() ) {
		$sidebar_positions = rwmb_meta( 'bpxl_layout', $args = array('type' => 'image_select'), get_the_ID() );
		
		if( !empty($sidebar_positions) ){
			$sidebar_position = $sidebar_positions;
			
			if( $sidebar_position == 'left' ) $bpxl_single_layout = '.single .content-area, .page .content-area { float:right; margin-left:2.4%; margin-right:0 }';
			elseif( $sidebar_position == 'right' ) $bpxl_single_layout = '.single .content-area, .page .content-area { float:left; margin-right:2.4%; margin-left:0 }';
			elseif( $sidebar_position == 'none' ) $bpxl_single_layout = '.single .content-area, .page .content-area { margin:0; width:100% } .relatedPosts ul li { width:21.6% }';
		}
	}
	
	// Post Meta
	$bpxl_meta_css = '';
	$bpxl_meta_date_css = '';
	$bpxl_meta_author_css = '';
	$bpxl_single_meta_css = '';
	$bpxl_single_meta_date_css = '';
	$bpxl_single_meta_author_css = '';
	if($bpxl_goblog_options['bpxl_post_meta'] != '1') {
		$bpxl_meta_css = '.content-home .title-wrap, .content-archive .title-wrap { border:0; min-height:20px; padding-bottom:10px; }';
	}
	if($bpxl_goblog_options['bpxl_post_meta_options']['2'] != '1') {
		$bpxl_meta_date_css = '.content-home .title-wrap, .content-archive .title-wrap { border:0; min-height:20px; padding-bottom:15px; }';
	}
	if($bpxl_goblog_options['bpxl_post_meta_options']['6'] != '1') {
		$bpxl_meta_author_css = '.content-home .title-wrap { padding-right:20px }';
	}
	if($bpxl_goblog_options['bpxl_single_post_meta'] != '1') {
		$bpxl_single_meta_css = '.single-content .post header { border:0; } .single-content .title-wrap { border:0; min-height:20px; padding-bottom:15px; }';
	}
	if ($bpxl_goblog_options['bpxl_single_post_meta_options']['2'] != '1') {
		$bpxl_single_meta_date_css = '.single-content { border:0; } .content-single .title-wrap { border:0; min-height:20px; padding-bottom:15px; }';
	}
	if($bpxl_goblog_options['bpxl_single_post_meta_options']['6'] != '1') {
		$bpxl_single_meta_author_css = '.single-content .title-wrap { padding-right:20px }';
	}
	
	// Hex to RGB
	$bpxl_hex = $color_scheme_1;
	list($bpxl_r, $bpxl_g, $bpxl_b) = sscanf($bpxl_hex, "#%02x%02x%02x");
	
	// Custom CSS
	if ($bpxl_goblog_options['bpxl_custom_css'] != '') {
		$bpxl_custom_css = $bpxl_goblog_options['bpxl_custom_css'];
	}
	
	$custom_css = "
	body, .menu-pusher { background-color:{$background_color}; background-image:url({$background_img}); background-repeat:{$bg_repeat}; background-attachment:{$bg_attachment}; background-position:{$bg_position} }
	.widgetslider .post-cats span, .tagcloud a:hover, .main-navigation ul li ul li a:hover, .menu ul .current-menu-item > a, .pagination span.current, .pagination a:hover, .read-more a, .featuredslider .flex-control-nav .flex-active, #subscribe-widget input[type='submit'], #wp-calendar caption, #wp-calendar td#today, #commentform #submit, .wpcf7-submit, .off-canvas-search .search-button { background-color:{$color_scheme_1}; }
	a, a:hover, .title a:hover, .sidebar a:hover, .sidebar-small-widget a:hover, .breadcrumbs a:hover, .meta a:hover, .post-meta a:hover, .reply:hover i, .reply:hover a, .edit-post a, .error-text, #comments .fn a:hover { color:{$color_scheme_1}; }
	.main-navigation a:hover, .current-menu-item a, .sfHover a, .tagcloud a:hover, .main-navigation .menu ul li:first-child, .current-menu-parent a { border-color:{$color_scheme_1}; }
	.main-navigation .menu > li > ul:before { border-bottom-color:{$color_scheme_1}; }
	.main-navigation a { color:{$bpxl_nav_link_color};} .main-navigation a:hover, .current-menu-item a, .current-menu-parent a, #navigation .menu > .sfHover > a.sf-with-ul { color:{$bpxl_nav_link_hover_color};}
	.sf-arrows .sf-with-ul:after { border-top-color:{$bpxl_nav_link_color};} .sf-arrows .sf-with-ul:hover:after { border-top-color:{$bpxl_nav_link_hover_color};} .main-navigation ul li ul li a { background:{$bpxl_nav_dropdown_bg_color}; color:{$bpxl_nav_drop_link_color};}
	.main-navigation ul li ul li a:hover { color:{$bpxl_nav_drop_link_hover_color};} .sf-arrows ul .sf-with-ul:after { border-left-color:{$bpxl_nav_drop_link_color};}
	#wp-calendar th { background: rgba({$bpxl_r},{$bpxl_g},{$bpxl_b}, 0.6) } .header-slider img { opacity:{$bpxl_goblog_options['bpxl_header_slider_opacity']};} {$bpxl_single_layout} {$bpxl_custom_css} {$bpxl_meta_date_css} {$bpxl_single_meta_date_css} {$bpxl_meta_author_css} {$bpxl_single_meta_author_css} {$bpxl_meta_css} {$bpxl_single_meta_css}
	";
	wp_add_inline_style( 'goblog-style', $custom_css );
	
	// Font-Awesome CSS
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css' );
	wp_enqueue_style( 'font-awesome' );
	
	// Magnific Popup CSS
	if($bpxl_goblog_options['bpxl_lightbox'] == '1') {
		wp_register_style( 'magnific-popup', get_template_directory_uri() . '/css/magnific-popup.css' );
		wp_enqueue_style( 'magnific-popup' );
	}
	
	if ($bpxl_goblog_options['bpxl_responsive_layout'] == '1') {
		// Responsive
		wp_register_style( 'responsive', get_template_directory_uri() . '/css/responsive.css' );
		wp_enqueue_style( 'responsive' );
	}
	
	if ($bpxl_goblog_options['bpxl_rtl'] == '1') {
		// Responsive
		wp_register_style( 'rtl', get_template_directory_uri() . '/css/rtl.css' );
		wp_enqueue_style( 'rtl' );
	}
}
add_action( 'wp_enqueue_scripts', 'bpxl_stylesheets' );

/*-----------------------------------------------------------------------------------*/
/*	Add JavaScripts
/*-----------------------------------------------------------------------------------*/
function bpxl_scripts() {
	global $bpxl_goblog_options;
    wp_enqueue_script( 'jquery' );
	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
	
	// Sticky Menu
	if ($bpxl_goblog_options['bpxl_sticky_menu'] == '1') {
		wp_register_script( 'stickymenu', get_template_directory_uri() . '/js/stickymenu.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'stickymenu' );
	}
	
	// Masonry
	$bpxl_masonry_array = array(
		'clayout',
		'gslayout',
		'sglayout',
		'glayout',
	);
	if(in_array($bpxl_goblog_options['bpxl_layout'],$bpxl_masonry_array) || in_array($bpxl_goblog_options['bpxl_archive_layout'],$bpxl_masonry_array)) {
		wp_register_script( 'imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array( 'jquery' ), '3.1.4', true );
		wp_enqueue_script( 'imagesloaded' );
		
		wp_register_script( 'masonry', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array( 'jquery' ), '3.1.5', true );
		wp_enqueue_script( 'masonry' );
	}
	
	// Magnific Popup
	if($bpxl_goblog_options['bpxl_lightbox'] == '1') {
		wp_register_script( 'magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array( 'jquery' ), '0.9.9', true );
		wp_enqueue_script( 'magnific-popup' );
	}
	
	// Theme Specific Scripts
    wp_register_script( 'theme-scripts', get_template_directory_uri() . '/js/theme-scripts.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'theme-scripts' );
}
add_action( 'wp_enqueue_scripts', 'bpxl_scripts' );

/*-----------------------------------------------------------------------------------*/
/*	Add Admin Scripts
/*-----------------------------------------------------------------------------------*/
function bpxl_admin_scripts() {
    wp_register_script( 'admin-scripts', get_template_directory_uri() . '/js/admin-scripts.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'admin-scripts' );
	
    wp_register_script( 'select2js', get_template_directory_uri() . '/js/select2js.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'select2js' );
	
	wp_register_style( 'select2css', get_template_directory_uri() . '/css/select2css.css' );
	wp_enqueue_style( 'select2css' );
	
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css' );
	wp_enqueue_style( 'font-awesome' );
    
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script('wp-color-picker');
}
add_action( 'admin_enqueue_scripts', 'bpxl_admin_scripts' );

// Header Code
function bpxl_header_code_fn() {
	global $bpxl_goblog_options;
	if (!empty($bpxl_goblog_options['bpxl_header_code'])) {
		echo $bpxl_goblog_options['bpxl_header_code'];
	}
}
add_action('wp_head','bpxl_header_code_fn');

// Footer Code
function bpxl_footer_code_fn() {
	global $bpxl_goblog_options;
	if (!empty($bpxl_goblog_options['bpxl_footer_code'])) {
		echo $bpxl_goblog_options['bpxl_footer_code'];
	}
	// Masonry
	$bpxl_masonry_array = array(
		'clayout',
		'gslayout',
		'sglayout',
		'glayout',
	);
	if(in_array($bpxl_goblog_options['bpxl_layout'],$bpxl_masonry_array) || in_array($bpxl_goblog_options['bpxl_archive_layout'],$bpxl_masonry_array)) { ?>
		<script>
		/*---[ Masonry ]---*/
		jQuery(document).ready(function() {
			var container = jQuery('.masonry').imagesLoaded(function() {
				container.masonry({
					itemSelector : '.masonry .post',
					columnWidth : '.masonry .post',
					isAnimated : true,
					gutter: 20
				});
			});
		});
		</script>
	<?php }
}
add_action('wp_footer','bpxl_footer_code_fn');

/*-----------------------------------------------------------------------------------*/
/*	Load Widgets
/*-----------------------------------------------------------------------------------*/
include("inc/widgets/widget-ad125.php"); // 125x125 Ad Widget
include("inc/widgets/widget-ad160.php"); // 160x600 Ad Widget
include("inc/widgets/widget-ad300.php"); // 300x250 Ad Widget
include("inc/widgets/widget-fblikebox.php"); // Facebook Like Box
include("inc/widgets/widget-flickr.php"); // Flickr Widget
include("inc/widgets/widget-popular-posts.php"); // Popular Posts
include("inc/widgets/widget-cat-posts.php"); // Category Posts
include("inc/widgets/widget-random-posts.php"); // Random Posts
include("inc/widgets/widget-recent-posts.php"); // Recent Posts
include("inc/widgets/widget-social.php"); // Social Widget
include("inc/widgets/widget-subscribe.php"); // Subscribe Widget
include("inc/widgets/widget-tabs.php"); // Tabs Widget
include("inc/widgets/widget-tweets.php"); // Tweets Widget
include("inc/widgets/widget-video.php"); // Video Widget
include("inc/widgets/widget-slider.php"); // Slider Widget
include("inc/nav-walker.php"); // Nav Walker
	
/*-----------------------------------------------------------------------------------*/
/*	Exceprt Length
/*-----------------------------------------------------------------------------------*/
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}
add_filter( 'get_the_excerpt', 'do_shortcode');

/*-----------------------------------------------------------------------------------*/
/*	Register Theme Widgets
/*-----------------------------------------------------------------------------------*/
function bpxl_widgets_init() {
	register_sidebar(array(
		'name'          => __( 'Primary Sidebar', 'bloompixel' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar of the theme.', 'bloompixel' ),
		'before_widget' => '<div class="widget sidebar-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title uppercase">',
		'after_title'   => '</h3>',
	));
	register_sidebar(array(
		'name'          => __( 'Secondary Sidebar', 'bloompixel' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Only displayed when 3 column layout is enabled.', 'bloompixel' ),
		'before_widget' => '<div class="widget sidebar-widget sidebar-small-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title uppercase">',
		'after_title'   => '</h3>',
	));
	$sidebars = array(1, 2, 3, 4);
	foreach($sidebars as $number) {
	register_sidebar(array(
		'name'          => __( 'Footer', 'bloompixel' ) . ' ' . $number,
		'id'            => 'footer-' . $number,
		'description'   => __( 'This widget area appears on footer of theme.', 'bloompixel' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title uppercase">',
		'after_title'   => '</h3>'
	));
	}
}
add_action( 'widgets_init', 'bpxl_widgets_init' );

/*-----------------------------------------------------------------------------------*/
/*	Breadcrumb
/*-----------------------------------------------------------------------------------*/
function bpxl_breadcrumb() {
	if (!is_home()) {
		echo '<a href="';
		echo home_url();
		echo '"> <i class="fa fa-home"></i>';
		echo __('Home','bloompixel');
		echo "</a>";
		if (is_category() || is_single()) {
			echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
			the_category(' &bull; ');
			if (is_single()) {
				echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
				the_title();
			}
		} elseif (is_page()) {
			echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
			echo the_title();
		}
	}
	elseif (is_tag()) {
		echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
		single_tag_title();
		}
	elseif (is_day()) {
		echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
		echo"Archive for "; the_time('F jS, Y');
		}
	elseif (is_month()) {
		echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
		echo"Archive for "; the_time('F, Y');
		}
	elseif (is_year()) {
		echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
		echo"Archive for "; the_time('Y');
		}
	elseif (is_author()) {
		echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
		echo"Author Archive";
		}
	elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
		echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
		echo "Blog Archives";
		}
	elseif (is_search()) {
		echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
		echo"Search Results"; 
		}
}

/*-----------------------------------------------------------------------------------*/
/* Filter the page title
/*-----------------------------------------------------------------------------------*/
function bpxl_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'bpxl_wp_title', 10, 2 );

/*-----------------------------------------------------------------------------------*/
/*	Comments Callback
/*-----------------------------------------------------------------------------------*/
function bpxl_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);
?>
		<li <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>
		<div class="comment-author vcard">
			<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment->comment_author_email, 60 ); ?>
			<?php printf(__('<cite class="fn uppercase">%s</cite>'), get_comment_author_link()) ?>

			<span class="reply uppercase">
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __('Reply')))) ?>
			</span>
		</div>
		<?php if ($comment->comment_approved == '0') : ?>
				<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.','bloompixel') ?></em>
				<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __('%1$s at %2$s','bloompixel'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)','bloompixel'),'  ','' );
			?>
		</div>

		<div class="commentBody">
			<?php comment_text() ?>
		</div>
		</div>
<?php
        }

/*
 * Change the comment reply link to use 'Reply to <Author First Name>'
 */
function add_comment_author_to_reply_link($link, $args, $comment){

    $comment = get_comment( $comment );

    // If no comment author is blank, use 'Anonymous'
    if ( empty($comment->comment_author) ) {
        if (!empty($comment->user_id)){
            $user=get_userdata($comment->user_id);
            $author=$user->user_login;
        } else {
            $author = __('Anonymous','bloompixel');
        }
    } else {
        $author = $comment->comment_author;
    }

    // If the user provided more than a first name, use only first name
    if(strpos($author, ' ')){
        $author = substr($author, 0, strpos($author, ' '));
    }

    // Replace Reply Link with "Reply to &lt;Author First Name>"
    $reply_link_text = $args['reply_text'];
    $link = str_replace($reply_link_text, '<i class="fa fa-reply"></i> '. __("Reply to ") . $author, $link);

    return $link;
}
add_filter('comment_reply_link', 'add_comment_author_to_reply_link', 10, 3);

/*-----------------------------------------------------------------------------------*/
/*	Pagination
/*-----------------------------------------------------------------------------------*/
function bpxl_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;
     if($pages == '') {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages) { $pages = 1; }
     }

     if(1 != $pages) {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}

/*-----------------------------------------------------------------------------------*/
/*	Exclude Pages from Search
/*-----------------------------------------------------------------------------------*/
if ( is_search() ) {
    function bpxl_searchFilter($query) {
        if ($query->is_search) {
        $query->set('post_type', 'post');
        }
        return $query;
    }
    add_filter('pre_get_posts','bpxl_searchFilter');
}

/*-----------------------------------------------------------------------------------*/
/*	Insert ads after 'X' paragraph of single post content.
/*-----------------------------------------------------------------------------------*/
add_filter( 'the_content', 'prefix_insert_post_ads' );

function prefix_insert_post_ads( $content ) {
	global $bpxl_goblog_options;
	$bpxl_ad_code = '';
	$bpxl_num_para = '';
	if ($bpxl_goblog_options['bpxl_para_ad'] != '') {
		$bpxl_ad_code = $bpxl_goblog_options['bpxl_para_ad_code'];
		$bpxl_num_para = $bpxl_goblog_options['bpxl_para_ad'];
	}
	
	//$bpxl_ad_code = '<div>Ads code goes here</div>';

	if ( is_single() && ! is_admin() ) {
		return prefix_insert_after_paragraph( $bpxl_ad_code, $bpxl_num_para, $content );
	}
	
	return $content;
}
 
function prefix_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
	$closing_p = '</p>';
	$paragraphs = explode( $closing_p, $content );
	foreach ($paragraphs as $index => $paragraph) {

		if ( trim( $paragraph ) ) {
			$paragraphs[$index] .= $closing_p;
		}

		if ( $paragraph_id == $index + 1 ) {
			$paragraphs[$index] .= $insertion;
		}
	}
	
	return implode( '', $paragraphs );
}

/*-----------------------------------------------------------------------------------*/
/*	Facebook Open Graph Data
/*-----------------------------------------------------------------------------------*/
if ($bpxl_goblog_options['bpxl_fb_og'] == '1') {
	//Adding the Open Graph in the Language Attributes
	function add_opengraph_doctype( $output ) {
		return $output . ' prefix="og: http://ogp.me/ns#"';
	}
	add_filter('language_attributes', 'add_opengraph_doctype');

	// Add Facebook Open Graph Tags
	function fb_og_tags() {
		global $post;
		
		if ( have_posts() ):while(have_posts()):the_post(); endwhile; endif;
			
		if ( is_single() || is_page() ){
			
			if(get_the_post_thumbnail($post->ID, 'thumbnail')) {
				$thumbnail_id = get_post_thumbnail_id($post->ID);
				$thumbnail_object = get_post($thumbnail_id);
				$image = $thumbnail_object->guid;
			} else {	
				$image = ''; // Change this to the URL of the logo you want beside your links shown on Facebook
			}
			
			echo '<meta property="og:title" content="' . get_the_title() . '"/>';
			echo '<meta property="og:url" content="' . get_permalink() . '"/>';
			echo '<meta property="og:type" content="article" />';
			echo '<meta property="og:description" content="' . strip_tags(get_the_excerpt()) . '" />';
			if (!empty($image)) {
				echo '<meta property="og:image" content="' . $image . '" />';
			}
			
		} elseif( is_home() ){
			if (!empty($bpxl_goblog_options['bpxl_logo']['url'])) {
				$image = $bpxl_goblog_options['bpxl_logo']['url'];
			} else {	
				$image = ''; // Change this to the URL of the logo you want beside your links shown on Facebook
			}
			echo '<meta property="og:title" content="' . get_bloginfo('name') . ' - ' . get_bloginfo('description') . '"/>';
			echo '<meta property="og:url" content="' . home_url() . '"/>';
			if (!empty($image)) {
				echo '<meta property="og:image" content="' . $image . '" />';
			}
			echo '<meta property="og:type" content="website" />';
		}
		
		echo '<meta property="og:site_name" content="' . get_bloginfo('name') . '" />';
	}
	add_action( 'wp_head', 'fb_og_tags', 5 );
}

/*-----------------------------------------------------------------------------------*/
/*	Add Extra Fields to User Profiles
/*-----------------------------------------------------------------------------------*/
add_action( 'show_user_profile', 'bpxl_user_profile_fields' );
add_action( 'edit_user_profile', 'bpxl_user_profile_fields' );

function bpxl_user_profile_fields( $user ) { ?>
<h3><?php _e("Social Profiles", "bloompixel"); ?></h3>

<table class="form-table">
	<tr>
		<th><label for="facebook"><?php _e("Facebook","bloompixel"); ?></label></th>
		<td>
		<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
		<span class="description"><?php _e("Enter your facebook profile URL.","bloompixel"); ?></span>
		</td>
	</tr>
	<tr>
		<th><label for="twitter"><?php _e("Twitter","bloompixel"); ?></label></th>
		<td>
		<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
		<span class="description"><?php _e("Enter your twitter profile URL.","bloompixel"); ?></span>
		</td>
	</tr>
	<tr>
		<th><label for="googleplus"><?php _e("Google+","bloompixel"); ?></label></th>
		<td>
		<input type="text" name="googleplus" id="googleplus" value="<?php echo esc_attr( get_the_author_meta( 'googleplus', $user->ID ) ); ?>" class="regular-text" /><br />
		<span class="description"><?php _e("Enter your Google+ profile URL.","bloompixel"); ?></span>
		</td>
	</tr>
	<tr>
		<th><label for="linkedin"><?php _e("LinkedIn","bloompixel"); ?></label></th>
		<td>
		<input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
		<span class="description"><?php _e("Enter your LinkedIn profile URL.","bloompixel"); ?></span>
		</td>
	</tr>
	<tr>
		<th><label for="pinterest"><?php _e("Pinterest","bloompixel"); ?></label></th>
		<td>
		<input type="text" name="pinterest" id="pinterest" value="<?php echo esc_attr( get_the_author_meta( 'pinterest', $user->ID ) ); ?>" class="regular-text" /><br />
		<span class="description"><?php _e("Enter your Pinterest profile URL.","bloompixel"); ?></span>
		</td>
	</tr>
	<tr>
		<th><label for="dribbble"><?php _e("Dribbble","bloompixel"); ?></label></th>
		<td>
		<input type="text" name="dribbble" id="dribbble" value="<?php echo esc_attr( get_the_author_meta( 'dribbble', $user->ID ) ); ?>" class="regular-text" /><br />
		<span class="description"><?php _e("Enter your Dribbble profile URL.","bloompixel"); ?></span>
		</td>
	</tr>
</table>
<?php }

add_action( 'personal_options_update', 'save_bpxl_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_bpxl_user_profile_fields' );

function save_bpxl_user_profile_fields( $user_id ) {

if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }

update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
update_user_meta( $user_id, 'googleplus', $_POST['googleplus'] );
update_user_meta( $user_id, 'linkedin', $_POST['linkedin'] );
update_user_meta( $user_id, 'pinterest', $_POST['pinterest'] );
update_user_meta( $user_id, 'dribbble', $_POST['dribbble'] );
}

/*-----------------------------------------------------------------------------------*/
/*	Custom wp_link_pages
/*-----------------------------------------------------------------------------------*/
function bpxl_wp_link_pages( $args = '' ) {
	$defaults = array(
		'before' => '<div class="pagination" id="post-pagination">' . __( '<p class="page-links-title">Pages:</p>' ), 
		'after' => '</div>',
		'text_before' => '',
		'text_after' => '',
		'next_or_number' => 'number', 
		'nextpagelink' => __( 'Next page','bloompixel' ),
		'previouspagelink' => __( 'Previous page','bloompixel' ),
		'pagelink' => '%',
		'echo' => 1
	);

	$r = wp_parse_args( $args, $defaults );
	$r = apply_filters( 'wp_link_pages_args', $r );
	extract( $r, EXTR_SKIP );

	global $page, $numpages, $multipage, $more, $pagenow;

	$output = '';
	if ( $multipage ) {
		if ( 'number' == $next_or_number ) {
			$output .= $before;
			for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
				$j = str_replace( '%', $i, $pagelink );
				$output .= ' ';
				if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
					$output .= _wp_link_page( $i );
				else
					$output .= '<span class="current current-post-page">';

				$output .= $text_before . $j . $text_after;
				if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
					$output .= '</a>';
				else
					$output .= '</span>';
			}
			$output .= $after;
		} else {
			if ( $more ) {
				$output .= $before;
				$i = $page - 1;
				if ( $i && $more ) {
					$output .= _wp_link_page( $i );
					$output .= $text_before . $previouspagelink . $text_after . '</a>';
				}
				$i = $page + 1;
				if ( $i <= $numpages && $more ) {
					$output .= _wp_link_page( $i );
					$output .= $text_before . $nextpagelink . $text_after . '</a>';
				}
				$output .= $after;
			}
		}
	}

	if ( $echo )
		echo $output;

	return $output;
}

/*-----------------------------------------------------------------------------------*/
/*	Automatic Theme Updates
/*-----------------------------------------------------------------------------------*/
global $bpxl_goblog_options;
$username = $bpxl_goblog_options['bpxl_envato_user_name'];
$apikey = $bpxl_goblog_options['bpxl_envato_api_key'];
$author = 'Simrandeep Singh';

load_template( trailingslashit( get_template_directory() ) . 'inc/wp-theme-upgrader/envato-wp-theme-updater.php' );
Envato_WP_Theme_Updater::init( $username, $apikey, $author );
?>