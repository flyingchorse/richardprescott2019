<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">


	<?php // echo get_the_post_thumbnail( $post->ID, 'folio-image', array( 'class' => 'pb-3 carousel-image-holder' ));
		
		$thepostimage =  get_the_post_thumbnail_url($post->ID, 'full' );
		if (has_category('instagram',$post->ID)) { }
		 
		 else {
		 
		 ?>
		
	
	<div class="wrapper" id="wrapper-hero">

	<div class="container-fluid" id="hero-slides">
		<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
		
				<div class="carousel-inner" role="listbox">
									<div class="carousel-item active">			
						<div class="carousel-image-holder align-middle"><span class="helper"></span><img class="img-fluid" src="<?php echo $thepostimage; ?>"></div>
					</div>
			
				</div>
				

		</div>
	</div>

</div> 

	<header class="entry-header mb-5">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header --><?php } ?>

	<div class="entry-content <?php if (has_category('instagram',$post->ID)) { echo 'insta-block' ;}  ?>">

		<?php the_content(); ?>

		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
			'after'  => '</div>',
		) );
		?>
		<div class="entry-meta">

			<?php //  understrap_posted_on(); 
				$posted_on_date = get_the_date();
				echo "Posted on " . $posted_on_date;
			?>

		</div><!-- .entry-meta -->
	</div><!-- .entry-content -->

	<footer class="entry-footer mb-5">
		
		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
