<?php
/**
 * Afrin functions and definitions
 *
 * @package Afrin
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 600; /* pixels */
}

if ( ! function_exists( 'afrin_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function afrin_setup() {
        // This theme styles the visual editor to resemble the theme style.
        $font_url = 'https://fonts.googleapis.com/css?family=Lato:400,100,400italic,700,900,900italic|PT+Serif:400,400italic,700,700italic';
        add_editor_style( array( 'inc/editor-style.css', str_replace( ',', '%2C', $font_url ) ) );
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Afrin, use a find and replace
	 * to change 'afrin' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'afrin', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
    add_image_size('large-thumb', 1060, 650, true);
    add_image_size('index-thumb', 780, 250, true);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'afrin' )            
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', 
	array(
		'search-form', 
		'comment-form', 
		'comment-list', 
		'gallery', 
		'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'afrin_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // afrin_setup
add_action( 'after_setup_theme', 'afrin_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function afrin_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'afrin' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
        
        
register_sidebar( array(
    'name'          => __( 'Footer Widgets', 'afrin' ),
    'description'   => __( 'Footer widgets area appears in the footer of the site.', 'afrin' ),
    'id'            => 'sidebar-2',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h1 class="widget-title">',
    'after_title'   => '</h1>',
) );

}
add_action( 'widgets_init', 'afrin_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function afrin_scripts() {
	     wp_enqueue_style( 'afrin-style', get_stylesheet_uri() );
             
        
        if (is_page_template('page-templates/page-nosidebar.php')) {
            wp_enqueue_style( 'afrin-layout-style' , get_template_directory_uri() . '/layouts/no-sidebar.css');
        } else {
            wp_enqueue_style( 'afrin-layout-style' , get_template_directory_uri() . '/layouts/content-sidebar.css');
        }

        wp_enqueue_style('afrin-google-fonts', 'https://fonts.googleapis.com/css?family=Lato:400,100,400italic,700,900,900italic|PT+Serif:400,400italic,700,700italic');

        wp_enqueue_style('afrin-fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
	        
        wp_enqueue_script( 'afrin-superfish', get_template_directory_uri() . '/js/superfish.min.js', array('jquery'), '20151230', true );
         
        
        wp_enqueue_script( 'afrin-superfish-settings', get_template_directory_uri() . '/js/superfish-settings.js', array('afrin-superfish'), '20151230', true );
                
                
        wp_enqueue_script( 'afrin-hide-search', get_template_directory_uri() . '/js/hide-search.js', array(), '20151230', true );
                
        wp_enqueue_script( 'afrin-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151230', true );

	wp_enqueue_script( 'afrin-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151230', true );
	
	wp_enqueue_script( 'afrin-masonry', get_template_directory_uri() . '/js/masonry-settings.js', array('masonry'), '20151230', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'afrin_scripts' );

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
