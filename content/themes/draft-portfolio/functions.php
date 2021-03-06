<?php
/**
 * draft portfolio functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package draft_portfolio
 */

if ( ! function_exists( 'draft_portfolio_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function draft_portfolio_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on draft portfolio, use a find and replace
	 * to change 'draft-portfolio' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'draft-portfolio', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	add_theme_support( 'align-wide');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
    //add_image_size( 'draft-portfolio-thumbnail', 400, 320, TRUE );
    add_image_size( 'draft-portfolio-thumbnail', 800, 640, TRUE );
    add_image_size( 'portfolio-thumbnail', 500);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'draft-portfolio' ),
		'social' => esc_html__( 'Social', 'draft-portfolio' )
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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'draft_portfolio_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
        add_theme_support( 'custom-logo' );

         // Custom Site Logo
         add_theme_support( 'site-logo', array(
        'header-text' => array(
            'site-title',
            'tagline',
        ),
        'size' => 'medium',
    ) );
	// Add Jetpack Infinite Scroll support
	add_theme_support( 'infinite-scroll', array(
		'type'           => 'click',
		'footer'		 => false,
		'footer_widgets' => false,
		'container'      => 'posts',
		'render'         => false,
		'posts_per_page' => false,
	) );
endif;
add_action( 'after_setup_theme', 'draft_portfolio_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function draft_portfolio_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'draft_portfolio_content_width', 780 );
}
add_action( 'after_setup_theme', 'draft_portfolio_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function draft_portfolio_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'draft-portfolio' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'draft-portfolio' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'draft_portfolio_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function draft_portfolio_scripts() {
	wp_enqueue_style( 'draft-portfolio-grid', get_template_directory_uri() . '/css/grid.css');

	wp_enqueue_style( 'draft-portfolio-style', get_stylesheet_uri() );

	wp_enqueue_script('jquery');
	wp_enqueue_script('masonry');

	wp_enqueue_script( 'draft-portfolio-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20151215', true );
	wp_enqueue_script( 'draft-portfolio-smooth', get_template_directory_uri() . '/js/smooth.js', array( 'jquery' ), '20001218', true );
	wp_enqueue_script( 'draft-portfolio-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '20151218', true );

	wp_enqueue_script( 'draft-portfolio-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'draft_portfolio_scripts' );

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

require get_template_directory() . '/pt-pro/class-customize.php';


if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}
