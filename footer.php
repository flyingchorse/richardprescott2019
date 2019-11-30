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
	<div class="container">
	<div class="row">
		<div class="col-md-4 mb-4">RICHARD PRESCOTT PHOTOGRAPHER</div>
		<div class="col-md-4">
		  <?php wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'container_class' => 'footer-nav',
						'container_id'    => 'footerNav',
						'menu_class'      => 'navbar-nav footer-nav-menu',
						'fallback_cb'     => '',
						'menu_id'         => 'main-menu',
						'depth'           => 3,
						'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
					)
				); ?>		</div>
		 <div class="col-md-2"><a class="d-inline-flex" href="https://www.instagram.com/richard_prescott/"><img  src="<?php echo get_stylesheet_directory_uri(  ); ?>/src/img/IG_Glyph_Fill.png" alt="Instagram" width="70" height="70" /></a>
		 <a class="d-inline-flex" href="https://vimeo.com/user17645474"><img class="d-inline-flex" src="<?php echo get_stylesheet_directory_uri(  ); ?>/src/img/vimeo_icon_dark.png" alt="vimeo_icon_dark" width="70" height="70" /></a></div>
	</div> <!-- End of Row -->
	</div>
	

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

