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
		<div class="col-md-4">RICHARD PRESCOTT PHOTOGRAPHER</div>
		<div class="col-md-2">
		  <ul class="navbar-nav">
		  <li>HOME</li>
		  <li>AUTOMOTIVE</li>
		  <li>CGI</li>
		  <li>LANDSCAPE</li>
		  <li>MARINE</li>
		  </ul>
		</div>
		<div class="col-md-2">
		  <ul class="navbar-nav">
		  <li>PORTRAIT</li>
		  <li>MOVING IMAGE</li>
		  <li>EDITIONS</li>
		  <li>INFORMATION</li>
		  <li></li>
		  </ul>
		 </div>
		 <div class="col-md-2">Social</div>
	</div> <!-- End of Row -->
	</div>
	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon">

					<div class="site-info">

						Site built by Digidolmedia

					</div><!-- .site-info -->

				</footer><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

