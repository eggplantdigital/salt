<?php
/**
 * Salt functions and definitions
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Salt
 * @since Salt 1.0.0
 */

/**
 * If it is not set already, we should set the content width.
 *
 * @link http://codex.wordpress.org/Content_Width
 */
if ( ! isset( $content_width ) ) {
	$content_width = 960;
}

/*
 * Load Customizer Support
 */
require_once get_template_directory() . '/core/customizer/init.php';

/*
 * Load Front-end helpers
 */
require_once get_template_directory() . '/core/helpers/post.php';
require_once get_template_directory() . '/core/helpers/layout.php';

if (!function_exists('salt_theme_setup')) :
/**
 * Adding theme features via 'after_setup_theme'
 *
 * @link https://codex.wordpress.org/Function_Reference/add_theme_support
 * @since 1.0.3
 */
 function salt_theme_setup(){

	/**
	 * Adds theme support for a few useful things.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/add_theme_support
	 * @since 1.0
	 */
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );
	
	/**
	 * This theme uses wp_nav_menu() for the main menu.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/wp_nav_menu
	 */
	register_nav_menus( array(
		'primary-menu' => __('Primary Menu', 'salt'),
	) );	
}
endif;
add_action( 'after_setup_theme', 'salt_theme_setup');

if (!function_exists('salt_register_styles')) :
/**
 * What's a WordPress theme without stylesheets.
 *
 * @link http://codex.wordpress.org/Function_Reference/wp_enqueue_style
 */
function salt_register_styles() {

	wp_enqueue_style( 'bootstrap' 	, get_template_directory_uri() . '/css/bootstrap.min.css', false, '3.2.0');
	wp_enqueue_style( 'fontawesome'	, get_template_directory_uri() . '/css/font-awesome.min.css', false, '4.2.0');
	wp_enqueue_style( 'main'	 	, get_template_directory_uri() . '/css/main.css', 'false', '1.0');
}
endif;
add_action( 'wp_enqueue_scripts', 'salt_register_styles' );

if (!function_exists('salt_register_scripts')) :
/**
 * Most sites these days have some jQuery including this theme.
 *
 * @link http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 */
function salt_register_scripts() {
	
	wp_enqueue_script( 'salt_respond', get_template_directory_uri() . '/js/respond.min.js', array('jquery'), '1.4.2', true );
	wp_enqueue_script( 'salt_global', get_template_directory_uri() . '/js/global.js', array('jquery'), '1.0.1', true );

	if ( is_singular() ) 
		wp_enqueue_script( 'comment-reply' );		
}
endif;
add_action( 'wp_enqueue_scripts', 'salt_register_scripts' );

if (!function_exists('salt_register_sidebars')) :
/**
 * Register primary and secondary sidebars on the site
 * 
 * @since Salt 1.0.0
 */
function salt_register_sidebars() {

	register_sidebar( array (
		'name' => 'Primary Sidebar',
		'id' => 'primary-widget-area',
		'description' => __( 'The primary sidebar', 'salt' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array (
		'name' => 'Secondary Sidebar',
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary sidebar', 'salt' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	$total = get_theme_mod('salt_footer_sidebars');	
	
	if ($total && $total != '0') {

		$i=0; while ($i < $total) {
			
			$i++;
			register_sidebar( array (
				'name' => 'Footer '.$i,
				'id' => 'footer-'.$i, 
				'description' => __( 'Footer Widget Area', 'salt' ), 
				'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>'
			));
		}
	}		
	
}
endif;
add_action( 'widgets_init', 'salt_register_sidebars' );

/**
 * These are the main classes used throughout theme on key elements.
 */
global $_salt_registered_classes;
$_salt_registered_classes = array(
	//Add extra classes to the main ID's - leave blank for none
	'wrapper' 						=> '',
	'header' 						=> '',
	'container' 					=> 'container',
	'main' 							=> 'row',
	'footer' 						=> 'container',
	'footer-widgets'       			=> '',
	'article' 						=> '',
	//Add the classes for the main column, depending on the layout options
	'main-one-col' 					=> 'col-sm-12',
	'main-two-col-left' 			=> 'col-sm-8',
	'main-two-col-right'    		=> 'col-sm-8 col-sm-push-4',
	'main-three-col-middle' 		=> 'col-sm-6 col-sm-push-3',
	//Add the classes for the primary sidebar, depending on the layout options
	'primary-two-col-left'  		=> 'widget-area col-sm-4',
	'primary-two-col-right'     	=> 'widget-area col-sm-4 col-sm-pull-8',
	'primary-three-col-middle'  	=> 'widget-area col-sm-3 col-sm-pull-6',
	//Add the classes for the secondary sidebar, depending on the layout options
	'secondary-three-col-middle'	=> 'widget-area col-sm-3'
);