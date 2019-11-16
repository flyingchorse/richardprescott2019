<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

$the_theme = wp_get_theme();
$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_sidebar( 'footerfull' ); ?>

<div class="wrapper pt-3 mt-3" id="wrapper-footer">

	<div class="<?php echo esc_html( $container ); ?>">

		<div class="row">

		

				<footer class="site-footer fixed-bottom container" id="colophon">
								<div class="slide-buttons-cont hidden-lg-up">
				<div class="slide-buttons"><a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
					  	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					  	<span class="sr-only">Previous</span>
  					</a></div>
  					
  					<div class="slide-buttons"><a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
  						<span class="carousel-control-next-icon" aria-hidden="true"></span>
  						<span class="sr-only">Next</span>
  					</a></div>
				</div>
				<nav class="navbar navbar-toggleable-md navbar-light">

		

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>	

				<!-- The WordPress Menu goes here -->
				<?php wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'container_class' => 'collapse navbar-collapse',
						'container_id'    => 'navbarNavDropdown',
						'menu_class'      => 'navbar-nav',
						'fallback_cb'     => '',
						'menu_id'         => 'main-menu',
						'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
					)
				); ?>
				<div class="slide-buttons-cont hidden-md-down">
				<div class="slide-buttons"><a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
					  	-
					  	<span class="sr-only">Previous</span>
  					</a></div>
  					
  					<div class="slide-buttons"><a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
  						+
  						<span class="sr-only">Next</span>
  					</a></div>
				</div>

		</nav>
						

				</footer><!-- #colophon -->

			

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>


</html>
