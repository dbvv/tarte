<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
  $the_theme = wp_get_theme();
  wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.css', array(), $the_theme->get( 'Version' ) );
  wp_enqueue_script( 'jquery');
  wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.js', array(), $the_theme->get( 'Version' ), true );
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}

function add_child_theme_textdomain() {
    load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
    
    // register nav menu
    register_nav_menu('footer-links', __('Footer'));
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );

require get_stylesheet_directory() . '/inc/options.php';
require get_stylesheet_directory() . '/inc/woocommerce/loop.php';
require get_stylesheet_directory() . '/inc/woocommerce/cart.php';
require get_stylesheet_directory() . '/inc/woocommerce/single.php';
require get_stylesheet_directory() . '/inc/woocommerce/checkout.php';
require get_stylesheet_directory() . '/inc/wp-cli.php';
require get_stylesheet_directory() . '/inc/subscription.php';
require get_stylesheet_directory() . '/inc/search.php';
require get_stylesheet_directory() . '/inc/checkout.php';
