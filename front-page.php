<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper front-page" id="page-wrapper">

	<div class="container-fluid" id="content" tabindex="-1">

      <main class="site-main" id="front-page-main">
        
        <div class="hero-section">
          <div class="row">
            <div class="col hero-section-block hero-section-block-girl">
                <img class="img-resposive" style="width: 100%; height: 100%;" src="<?php echo get_stylesheet_directory_uri(); ?>/img/girl-face.png" alt="">
            </div>
            <div class="col hero-section-block hero-section-block-with-g ">
                <div class="img-wrapper">
                    <img style="" class="img-responsive " src="<?php echo get_stylesheet_directory_uri(); ?>/img/home-page-stick.png" alt="">

                </div>
            </div>
            <div class="col hero-section-block">
                <div class="hero-section-text">
                    <h3><?php echo carbon_get_theme_option('front_page_first_screen_header'); ?></h3>
                    <img class="hero-section-mobile-image" src="<?php echo carbon_get_theme_option('front_page_first_screen_mobile_image'); ?>" alt="">
                    <p> <?php echo carbon_get_theme_option('front_page_first_screen_text'); ?></p>
                    <a class="btn btn-primary btn-lg" href="<?php echo carbon_get_theme_option('front_page_first_screen_link'); ?>">Купить сейчас</a>
                </div>
            </div>
          </div>
        </div>

        <?php
            echo get_template_part('template-parts/frontpage-categories');
            echo get_template_part('template-parts/frontpage-image');
            echo get_template_part('template-parts/frontpage-bestsellers');
        ?>
        

			</main><!-- #main -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php get_footer(); ?>
