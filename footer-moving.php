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
						'theme_location'  => 'moving-menu',
						'container_class' => 'collapse navbar-collapse',
						'container_id'    => 'navbarNavDropdown',
						'menu_class'      => 'navbar-nav',
						'fallback_cb'     => '',
						'menu_id'         => 'moving-menu',
						'depth'			=> 2,
						'walker'          => new WP_Bootstrap_Navwalker(),
					)
				);		
				

				
if ( $post->post_parent ) {
	
		$args = array(
	'post_type' => 'page',
	'meta_query' => array(
		array(
			'key' => 'linked_project',
			'value' => $post->post_parent,
		)
	)
 );
$postslist = get_posts( $args );
	
	
	$grandparentID = $postslist[0]->ID;
	
	if ( $postslist[0]->ID ) {
    $grandparent = wp_list_pages( array(
        'title_li' => '',
        'depth' => 0,
        'css_class' => 'nav-item',
        'post_type' => 'page',
        'include' => $grandparentID,
        'echo'     => 0,
        'walker'	=> new BS_Page_Walker()
    ) );
}
	
    $parent = wp_list_pages( array(
        'title_li' => '',
        'depth' => 0,
        'css_class' => 'nav-item',
        'post_type' => 'projects',
        'include' => $post->post_parent,
        'echo'     => 0,
        'walker'	=> new BS_Page_Walker()
    ) );
} else {
	
			$args = array(
	'post_type' => 'page',
	'meta_query' => array(
		array(
			'key' => 'linked_project',
			'value' => $post->ID,
		)
	)
 );
$postslist = get_posts( $args );

	
	
	if ( $postslist) {
		$grandparentID = $postslist[0]->ID;
    $grandparent = wp_list_pages( array(
        'title_li' => '',
        'depth' => 0,
        'css_class' => 'nav-item',
        'post_type' => 'page',
        'include' => $grandparentID,
        'echo'     => 0,
        'walker'	=> new BS_Page_Walker()
    ) );
}
    $parent = wp_list_pages( array(
        'title_li' => '',
        'css_class' => 'nav-item',
        'depth' => 1,
        'post_type' => 'projects',
        'include' => $post->ID,
        'echo'     => 0,
        'walker'	=> new BS_Page_Walker()
        
    ) );
}
		
if ( $post->post_parent ) {
    $children = wp_list_pages( array(
        'title_li' => '',
        'depth' => 0,
        'css_class' => 'nav-item',
        'post_type' => 'projects',
        'include' => $post->ID,
        'echo'     => 0,
        'walker'	=> new BS_Page_Walker()
    ) );
} 

?>
<div>
    <ul class="navbar-nav">
	   
	    <?php echo $parent; ?>
        <?php if (!isset($children)) { } else { echo $children;}?>
    </ul>
</div>

				
				<div class="slide-buttons-cont hidden-md-down">
			
        <div class="thumb-button"><a class="nav-link" href="#" data-toggle="collapse" data-target="#multic-2" >THUMBNAILS</a></div>
    
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
