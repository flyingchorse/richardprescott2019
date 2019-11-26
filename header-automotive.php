<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">

	<!-- ******************* The Navbar Area ******************* -->
	<div id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">

		<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>

		

		<?php if ( 'container' == $container ) : ?>
			<div class="container">
		<?php endif; ?>

					<!-- Your site title as branding in the menu -->
					<?php if ( ! has_custom_logo() ) { ?>

						<?php if ( is_front_page() && is_home() ) : ?>

							<h1 class="navbar-brand d-flex justify-content-center mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

						<?php else : ?>

							<a class="navbar-brand d-flex justify-content-center" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

						<?php endif; ?>


					<?php } else {
						the_custom_logo();
					} ?><!-- end custom logo -->
			</div>
			<nav class="navbar navbar-expand-md navbar-light justify-content-center">
					
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
					<span class="navbar-toggler-icon"></span>
				</button>

				<!-- The WordPress Menu goes here -->
				<?php wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'container_class' => 'collapse navbar-collapse justify-content-center',
						'container_id'    => 'navbarNavDropdown',
						'menu_class'      => 'navbar-nav automotive',
						'fallback_cb'     => '',
						'menu_id'         => 'main-menu',
						'depth'           => 2,
						'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
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

				
			<?php if ( 'container' == $container ) : ?>
		<!-- .container -->
			<?php endif; ?>

		</nav><!-- .site-navigation -->
<nav class="navbar navbar-expand-md navbar-light justify-content-center">
	<div id="navbarNavDropdown" class="collapse navbar-collapse justify-content-center" style="">
    <ul class="navbar-nav this is where it is">
	    <?php if (!isset($grandparent)) {} else { echo $grandparent;} ?>
	    <?php echo $parent; ?>
        <?php if (!isset($children)) { } else { echo $children;}?>
    </ul>


				
<div class="slide-buttons-cont hidden-md-down">
	<div class="thumb-button">
					<?php
						        if (!isset($children)) { } else { ?>
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#multic-2" >THUMBNAILS</a>
    <?php } ?></div>
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
	</div><!-- #wrapper-navbar end -->
