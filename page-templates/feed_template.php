<?php
/**
 * Template Name: Feed Template for Homepage
 * Template Post Type: post, page, event, homepagefeed
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

<?php
	
	// this template is pulling in the thumbnails from the underlying galleries.
	
	 thumbnail_feed($post->ID);?>
	 
	 
<div class="wrapper" id="index-wrapper">
	
	<div class="divider"><span></span><span>Insta</span><span></span></div>

		
	
	<div class="container-fluid thumb-grid journal-grid">
		
	<div class="row">
		<div class="col-sm-12"><?php journal_feed('2dot4',5); ?></div>
		
	
	</div>
	</div>
	<div class="divider"><span></span><span>Journal</span><span></span></div>
	<div class="container-fluid thumb-grid journal-grid">
	
	<div class="row">
		<div class="col-sm-12"><?php journal_feed('2dot4',5); ?></div>
	</div>
</div>
</div><!-- #index-wrapper -->
	 
	 
	 

<?php get_footer(); ?>