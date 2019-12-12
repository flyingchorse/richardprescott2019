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
			<div class="row	justify-content-center pb-4 footer-brandnamestyle">RICHARD PRESCOTT PHOTOGRAPHER</div>
		<div class="row  justify-content-center">
			
		<nav class="navbar navbar-expand-md navbar-light justify-content-center pb-4">	
				 <?php wp_nav_menu(
						array(
							'theme_location'	 => 'primary',
							'container_class' => 'navbar justify-content-center',
							'container_id'	 => 'navbarNavFooter',
							'menu_class'		 => 'navbar-nav',
							'fallback_cb'	 => '',
							'menu_id'		 => 'main-menu',
							'depth'			 => 3,
							'walker'			 => new Understrap_WP_Bootstrap_Navwalker(),
						)
					); ?>		
		</nav>		 
		</div><!-- End of Row -->
		<div class="row  justify-content-center pb-2"><a class="d-inline-flex social-icons" href="https://www.instagram.com/richard_prescott/"><img  src="<?php echo get_stylesheet_directory_uri(	 ); ?>/src/img/IG_Glyph_Fill.png" alt="Instagram" width="70" height="70" /></a><a class="d-inline-flex" href="https://vimeo.com/user17645474"><img class="d-inline-flex social-icons" src="<?php echo get_stylesheet_directory_uri(	); ?>/src/img/vimeo_icon_dark.png" alt="vimeo_icon_dark" width="70" height="70" /></a></div>
		
		<div class="container text-center pt-4 pb-4 copyrightinfo">PLEASE NOTE THAT THE IMAGES AND CONTENTS OF THIS WEB SITE ARE THE PROPERTY OF RICHARD PRESCOTT AND ARE PROTECTED UNDER INTERNATIONAL COPYRIGHT LAWS.
ALL RIGHTS RESERVED. NO USE OR COPYING BY ANY MEANS, TRANSFERENCE OR ANY REUSE OF ANY OF THE IMAGES ON THIS WEBSITE CAN BE MADE WHAT SO EVER WITHOUT THE WRITTEN PERMISSION OF RICHARD PRESCOTT. © 2017 RICHARD PRESCOTT</div>
	</div>
	

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

