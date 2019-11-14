<?php
/**
 * Template Name: Home Page Template
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
// On WooCommerce pages there is no need for sidebars as they leave
// too little space for WooCommerce itself. We check if WooCommerce
// is active and the current page is a WooCommerce page and we do
?>

<div class="wrapper" id="wrapper-hero">

	<div class="container-fluid" id="hero-slides">
		<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
		
				<div class="carousel-inner" role="listbox">
									<div class="carousel-item active">			
						<div class="carousel-image-holder align-middle"><span class="helper"></span><img class="img-fluid" src="http://davids-imac/rjp/wp-content/uploads/2017/02/RANGE-ROVER-16MY-PRESS-AD_CAP-FERRAT-HOTEL.jpg"></div>
					</div>
					
					<div class="carousel-item ">			
						<div class="carousel-image-holder align-middle"><span class="helper"></span><img class="img-fluid" src="http://davids-imac/rjp/wp-content/uploads/2017/02/HORSES-PATAGONIA_WEB-INTERIM.jpg"></div>
					</div>
			
				</div>
				

		</div>
	</div>

</div>


<?php get_footer(); ?>