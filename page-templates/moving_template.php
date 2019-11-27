<?php
/**
 * Template Name: Moving Image Page Template
 * Template Post Type: post, page, event, projects
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

get_header('automotive');

$container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
// On WooCommerce pages there is no need for sidebars as they leave
// too little space for WooCommerce itself. We check if WooCommerce
// is active and the current page is a WooCommerce page and we do
?>

<?php 
	
		
	preg_match_all('/([0-9])\w+/', $post->post_content, $ids);
	$thumbnailelement = "";
	if ($ids) {
	//$attachments = explode(",", $ids[1]);
	?>
	
	
	<div class="wrapper collapse" id="wrapper-hero">
	<div class="container-fluid" id="hero-slides">
		<div id="carouselExampleControls" class="carousel slide" data-interval="false">

		<div class="carousel-inner" role="listbox">	
			
			<?php
				
		$loopcount = 0;		
	if ($ids) {
		foreach ( $ids[0] as $id ) {
	
				
		?>
	
				
					<div class="carousel-item <?php if ($loopcount == 1) { echo 'active'; }; ?>">			
						<div class="container carousel-image-holder align-middle">
						
							
						<div class='embed-container '><iframe src='https://player.vimeo.com/video/<?php echo $id ?>' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
							
													
						</div>
					</div>		
					
							
						<?php 
							$thumbnailelement .= "<div class='col-md-4 col-xl-4 thumb-video-card' title='' ><a class='thumbnail-image' href='#' data-target='#carouselExampleControls' change-slide-to='" . $loopcount ."' ><div class='blocker'></div><div class='embed-container'><iframe src='https://player.vimeo.com/video/" . $id . "?background=1' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></a></div>";
							$loopcount++;
		}
	}
						?>
										</div>


			</div>
		</div>
		
	</div>
						<?php
	// this is where the output for the thumbnails goes
	
		?>
		<div class="collapse show container-fluid video-thumb-grid " id="multic-2">
		<div class="row thumb-collapse"><?php
	echo $thumbnailelement;
	?></div></div>
	<?php
	//End of Thumbnails	

	}
	
	
?>

<?php get_footer(); ?>