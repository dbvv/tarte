<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon">

					<div class="site-info">

            <div class="row">
              <div class="col-sm-3 footer-menu">
                <?php wp_nav_menu([
                    'theme_location' => 'footer-links',
                    'fallback_cb' => '',
                    'depth' => 1,
                ]); ?>
                
              </div>
              <div class="col-sm-4 about-info">
                <?php echo carbon_get_theme_option('about_info'); ?>
                <div class="footer-socials">
                    <?php
                        $socials = ['facebook', 'pinterest', 'instagram', 'vk'];
                        foreach ($socials as $social) {
                          if ($link = carbon_get_theme_option('social_' . $social)) {
                                echo '<a href="' . $link . '"><i class="fa fa-' . $social . '"></i></a>';
                          }
                        }
                    ?>  
                </div>
              </div>
              <div class="col-sm-5">
                <ul class="widgets footer-right">
                    <?php dynamic_sidebar('footer-right'); ?>
                </ul>
              </div>
            </div>
					</div><!-- .site-info -->
          
          <div class="container mt-3">
            <?php echo carbon_get_theme_option('footer_text'); ?>
          </div>
    
          <div class="container mt-5" >
            <div class="row justify-content-between">
              <div class="col-md-4"><?php echo carbon_get_theme_option('copyright_text'); ?></div>
              <div class="col-md-4 text-right">
                <?php 
                    $privacy_id = carbon_get_theme_option('privacy_policy_page');
                    $privacy = get_post($privacy_id);
                    echo '<a href="' . get_permalink($privacy_id) . '">' . $privacy->post_title . '</a>'; 
                ?>
            </div>
            </div>
          </div>

				</footer><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

