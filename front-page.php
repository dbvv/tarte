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

	<div class="" id="content" tabindex="-1">

      <main class="site-main" id="front-page-main">

        <?php
          $blocks = [
            'jumbotron',
          ];
          foreach ($blocks as $block) {
            echo get_template_part('template-parts/frontpage', $block);

          }

        ?>
        
                

			</main><!-- #main -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php get_footer(); ?>
