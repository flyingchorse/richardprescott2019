<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
    
    $query_args = array(
		'family' => 'Open+Sans|Oswald|Dosis|Roboto+Slab|Roboto:100|Raleway|Biryani:200|Work+Sans:200|Rajdhani:400|Exo:100',
		'subset' => 'latin,latin-ext',
	);
	
	
	wp_enqueue_style( 'google_fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
	wp_enqueue_style( 'fontscom',  "//fast.fonts.net/cssapi/7760cce4-0d5b-4061-a848-9f8dbcc81165.css" ,array(), null); 
}

function add_child_theme_textdomain() {
    load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );


// Use ACF to create video slide text box to enter in video ID
// Vimeo embed code: <iframe src="https://player.vimeo.com/video/86035157" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>

	
/* Adding in Digidol Custom functions areas	 */
// 

function child_theme_setup() {

add_image_size( 'grid-image', 352,229, true );
add_image_size( 'grid-aspect', 352, false );
add_image_size( 'grid-height', 99999, 640, false );
add_image_size( 'grid-journal', 352,352, true );


}

add_action( 'after_setup_theme', 'child_theme_setup', 11 );



function digidol_hero() {
    do_action('digidol_hero');
} // end digidol_hero
// my gallery function, add options to turn on or off caption. // add option to turn on cover text page fed from the post_content.
function digidol_gallery_carousel() {
	global $post;
	$the_content =  $post->post_content;
	$the_content = preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', $the_content);  # strip shortcodes, keep shortcode content
	//remove_shortcode( 'gallery' );
	$new_content = apply_filters('the_content',$the_content);
	echo $new_content;  

	
	
	
	preg_match('/\[gallery.*ids=.(.*).\]/', $post->post_content, $ids);
	if ($ids) {
	$attachments = explode(",", $ids[1]);
	$thumbnailelement = "";
	?>
	
<!-- 	Start Wrapper -->
	<div class="wrapper collapse" id="wrapper-hero">
<!-- Hero Slides -->
		
		<div class="container-fluid" id="hero-slides">
			
			<div id="carouselExampleControls" class="carousel slide" data-interval="false">

				<div class="carousel-inner" role="listbox">	
			
							<?php
								
						$loopcount = 0;		
					if ($attachments) {
						foreach ( $attachments as $attachment ) {
					
						$imagethumbnail = wp_get_attachment_image_src($attachment, 'full');
						$imag_alt = get_post_meta($attachment, '_wp_attachment_image_alt', true);
						
						?>
					
								
									<div class="carousel-item <?php if ($loopcount == 0) { echo 'active'; }; ?>">			
										<div class="carousel-image-holder">
											<img class ="d-block mx-auto"src="<?php echo $imagethumbnail[0]; ?>" alt="<?php echo $imag_alt;?>" />
											<div class="caption-container clearfix" id="slide-post-<?php echo $attachment; ?>">
												<div class="image-caption " id="slide-caption-<?php echo get_post_field('post_content', $attachment);?>"><a class="btn btn-primary info-button" data-toggle="collapse" href="#collapse<?php echo $loopcount ?>" aria-expanded="false" aria-controls="collapseExample"></a></div>
												<div id="collapse<?php echo $loopcount ?>" class="collapse image-caption-text"><?php echo get_post_field('post_content', $attachment);?></div>
											</div> 
										</div>
									</div>		
									<?php 
								$thumbnailelement .= "<div class='col-md-4 col-xl-4 thumb-card thumb-tooltip' data-toggle='tooltip' data-placement='bottom' title=''><span class='helper'></span><a class='thumbnail-image align-bottom' href='#' change-slide-to='" . $loopcount ."' >" .  wp_get_attachment_image($attachment, 'grid-aspect',"", array( "class" => " align-bottom" )) . "</a></div>";
						$loopcount++;
						}
					}
						?>
				</div><!-- carousel-inner -->
			</div><!-- carouselExampleControls  -->
		</div>
<!-- End Hero Slides -->
	</div>
<!-- 	End Wrapper -->
	<?php
	
	// this is where the output for the thumbnails goes
	
		?>
		<div class="collapse show container-fluid thumb-grid" id="multic-2">
		<div class="row thumb-collapse"><?php
	echo $thumbnailelement;
	?></div></div>
	<?php
	
	//End of Thumbnails
	}
}

add_action('digidol_hero','digidol_gallery_carousel');

// function to list the feed on the home page which will list the items and then link to their relevant pages.


function digidol_build_homepage_feed() {
	global $post;
	$the_content =  $post->post_content;
	$the_content = preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', $the_content);  # strip shortcodes, keep shortcode content
	//remove_shortcode( 'gallery' );
	//$new_content = apply_filters('the_content',$the_content);
	//echo $new_content;  

	
	
	
	preg_match('/\[gallery.*ids=.(.*).\]/', $post->post_content, $ids);
	if ($ids) {
	$attachments = explode(",", $ids[1]);
	$thumbnailelement = "";
	?>
	
<!-- 	Start Wrapper -->
	<div class="wrapper collapse" id="wrapper-hero">
<!-- Hero Slides -->
		
		<div class="container-fluid" id="hero-slides">
			
			<div id="carouselExampleControls" class="carousel slide" data-interval="false">

				<div class="carousel-inner" role="listbox">	
			
							<?php
								
						$loopcount = 0;		
					if ($attachments) {
						foreach ( $attachments as $attachment ) {
					
						$imagethumbnail = wp_get_attachment_image_src($attachment, 'full');
						$imag_alt = get_post_meta($attachment, '_wp_attachment_image_alt', true);
						
						?>
					
								
									<div class="carousel-item <?php if ($loopcount == 0) { echo 'active'; }; ?>">			
										<div class="carousel-image-holder align-middle"><span class="helper"></span>
											<img src="<?php echo $imagethumbnail[0]; ?>" alt="<?php echo $imag_alt;?>" />
											<div class="caption-container clearfix" id="slide-post-<?php echo $attachment; ?>">
												<div class="image-caption " id="slide-caption-<?php echo get_post_field('post_content', $attachment);?>"><a class="btn btn-primary info-button" data-toggle="collapse" href="#collapse<?php echo $loopcount ?>" aria-expanded="false" aria-controls="collapseExample"></a></div>
												<div id="collapse<?php echo $loopcount ?>" class="collapse image-caption-text"><?php echo get_post_field('post_content', $attachment);?></div>
											</div> 
										</div>
									</div>		
									<?php 
								$thumbnailelement .= "<div class='col-md-4 col-xl-4 thumb-card thumb-tooltip' data-toggle='tooltip' data-placement='bottom' title=''><span class='helper'></span><a class='thumbnail-image align-bottom' href='#' change-slide-to='" . $loopcount ."' >" .  wp_get_attachment_image($attachment, 'grid-aspect',"", array( "class" => " align-bottom" )) . "</a></div>";
						$loopcount++;
						}
					}
						?>
				</div><!-- carousel-inner -->
			</div><!-- carouselExampleControls  -->
		</div>
<!-- End Hero Slides -->
	</div>
<!-- 	End Wrapper -->
	<?php
	
	// this is where the output for the thumbnails goes
	
		?>
		<div class="collapse show container-fluid thumb-grid" id="multic-2">
		<div class="row thumb-collapse"><?php
	echo $thumbnailelement;
	?></div></div>
	<?php
	
	//End of Thumbnails
	}
}

function digidol_homefeed() {
    do_action('digidol_homefeed');
} // end digidol_hero


add_action('digidol_homefeed','digidol_build_homepage_feed');
// End of homepage feed

function digidol_hero_home() {
    do_action('digidol_hero_home');
} // end digidol_hero
// my gallery function, add options to turn on or off caption. // add option to turn on cover text page fed from the post_content.
function digidol_gallery_carousel_home() {
	global $post;
	$the_content =  $post->post_content;
	$the_content = preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', $the_content);  # strip shortcodes, keep shortcode content
	//remove_shortcode( 'gallery' );
	//$new_content = apply_filters('the_content',$the_content);
	//echo $new_content;  

	
	
	
	preg_match('/\[gallery.*ids=.(.*).\]/', $post->post_content, $ids);
	if ($ids) {
	$attachments = explode(",", $ids[1]);
	$thumbnailelement = "";
	?>
	
<!-- 	Start Wrapper -->
	<div class="wrapper" id="wrapper-hero">
<!-- Hero Slides -->
		
		<div class="container-fluid" id="hero-slides">
			
			<div id="carouselExampleControls" class="carousel slide" data-interval="false">

				<div class="carousel-inner" role="listbox">	
			
							<?php
								
						$loopcount = 0;		
					if ($attachments) {
						foreach ( $attachments as $attachment ) {
					
						$imagethumbnail = wp_get_attachment_image_src($attachment, 'full');
						$imag_alt = get_post_meta($attachment, '_wp_attachment_image_alt', true);
						
						?>
					
								
									<div class="carousel-item <?php if ($loopcount == 0) { echo 'active'; }; ?>">			
										<div class="carousel-image-holder ">
											<img class="d-block mx-auto" src="<?php echo $imagethumbnail[0]; ?>" alt="<?php echo $imag_alt;?>" />
											<div class="caption-container clearfix" id="slide-post-<?php echo $attachment; ?>">
												<div class="image-caption " id="slide-caption-<?php echo get_post_field('post_content', $attachment);?>"><a class="btn btn-primary info-button" data-toggle="collapse" href="#collapse<?php echo $loopcount ?>" aria-expanded="false" aria-controls="collapseExample"></a></div>
												<div id="collapse<?php echo $loopcount ?>" class="collapse image-caption-text"><?php echo get_post_field('post_content', $attachment);?></div>
											</div> 
										</div>
									</div>		
									<?php 
														$loopcount++;
						}
					}
						?>
				</div><!-- carousel-inner -->
			</div><!-- carouselExampleControls  -->
		</div>
<!-- End Hero Slides -->
	</div>
<!-- 	End Wrapper -->
	<?php
	
	// this is where the output for the thumbnails goes
	
		?>
		
	<?php
	
	//End of Thumbnails
	}
}

add_action('digidol_hero_home','digidol_gallery_carousel_home');

function digidol_editions() {
    do_action('digidol_editions');
} // end digidol_hero

function digidol_gallery_editions() {
	global $post;
	$the_content =  $post->post_content;
	$the_content = preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', $the_content);  # strip shortcodes, keep shortcode content
	//remove_shortcode( 'gallery' );
	//$new_content = apply_filters('the_content',$the_content);
	//echo $new_content;  

	
	
	
	preg_match('/\[gallery.*ids=.(.*).\]/', $post->post_content, $ids);
	if ($ids) {
	$attachments = explode(",", $ids[1]);
	?>
	
	
	<div class="wrapper" id="wrapper-hero">
	<div class="container-fluid" id="hero-slides">
		<div id="carouselExampleControls" class="carousel slide" data-interval="false">

		<div class="carousel-inner" role="listbox">	
			
			
		
		<div class="carousel-item active">			
						<div class="carousel-image-holder editions align-middle">
						 	<div class="container text-center"><?php $new_content = apply_filters('the_content',$the_content); echo $new_content; ?></div>
														
						</div>
		</div>	
		<?php			
		$loopcount = 1;		
	if ($attachments) {
		foreach ( $attachments as $attachment ) {
	
		$imagethumbnail = wp_get_attachment_image_src($attachment, 'full');
		$imag_alt = get_post_meta($attachment, '_wp_attachment_image_alt', true);
		
		?>
	
				
	
					
						<div class="carousel-item">			
						<div class="carousel-image-holder align-middle"><span class="helper"></span>
						 	<img src="<?php echo $imagethumbnail[0]; ?>" alt="<?php echo $imag_alt;?>" />
							<div class="caption-container clearfix" id="slide-post-<?php echo $attachment; ?>">
								<div class="image-caption " id="slide-caption-<?php echo get_post_field('post_content', $attachment);?>"><a class="btn btn-primary info-button" data-toggle="collapse" href="#collapse<?php echo $loopcount ?>" aria-expanded="false" aria-controls="collapseExample"></a></div>
								<div id="collapse<?php echo $loopcount ?>" class="collapse image-caption-text"><?php echo get_post_field('post_content', $attachment);?></div>
							</div> 
							
						</div>
					</div>			
						<?php $loopcount++;
		}
	}
						?>
										</div>


			</div>
		</div>
		
	</div>
						<?php
	
	}
}

add_action('digidol_editions','digidol_gallery_editions');

//add_action('digidol_hero','digi_test');

function digi_test() {
	global $post;
	$the_content =  $post->post_content;
	echo $the_content;
	preg_match('/\[gallery.*ids=.(.*).\]/', $the_content, $ids);
	
	$attachments = explode(",", $ids[1]);
	print $ids[1];
}

function register_my_menu() {
  register_nav_menu('project-menu',__( 'Project Menu' ));
  register_nav_menu('moving-menu',__( 'Moving Menu' ));
  
}
add_action( 'init', 'register_my_menu' );


class BS_Page_Walker extends Walker_Page {
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class='dropdown-menu' role='menu'>\n";
    }

    public function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {
        if ( $depth ) {
            $indent = str_repeat( "\t", $depth );
        } else {
            $indent = '';
        }

        $css_class = array( 'nav-item', 'page_item', 'page-item-' . $page->ID );

        if ( isset( $args['pages_with_children'][ $page->ID ] ) ) {
            $css_class[] = 'page_item_has_children';
        }

        if ( ! empty( $current_page ) ) {
            $_current_page = get_post( $current_page );
            if ( in_array( $page->ID, $_current_page->ancestors ) ) {
                $css_class[] = 'current_page_ancestor';
            }
            if ( $page->ID == $current_page ) {
                $css_class[] = 'current_page_item active';
            } elseif ( $_current_page && $page->ID == $_current_page->post_parent ) {
                $css_class[] = 'current_page_parent';
            }
        } elseif ( $page->ID == get_option('page_for_posts') ) {
            $css_class[] = 'current_page_parent';
        }

        /**
         * Filter the list of CSS classes to include with each page item in the list.
         *
         * @since 2.8.0
         *
         * @see wp_list_pages()
         *
         * @param array   $css_class    An array of CSS classes to be applied
         *                             to each list item.
         * @param WP_Post $page         Page data object.
         * @param int     $depth        Depth of page, used for padding.
         * @param array   $args         An array of arguments.
         * @param int     $current_page ID of the current page.
         */
        $css_classes = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );

        if ( '' === $page->post_title ) {
            $page->post_title = sprintf( __( '#%d (no title)' ), $page->ID );
        }

        $args['link_before'] = empty( $args['link_before'] ) ? '' : $args['link_before'];
        $args['link_after'] = empty( $args['link_after'] ) ? '' : $args['link_after'];

        /** This filter is documented in wp-includes/post-template.php */
        if ( isset( $args['pages_with_children'][ $page->ID ] ) ) {
            $output .= $indent . sprintf(
                    '<li class="%s"><a href="%s" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">%s%s%s <span class="caret"></span></a>',
                    $css_classes,
                    get_permalink( $page->ID ),
                    $args['link_before'],
                    apply_filters( 'the_title', $page->post_title, $page->ID ),
                    $args['link_after']
                );
        } else {
            $output .= $indent . sprintf(
                    '<li class="%s"><a class ="nav-link" href="%s">%s%s%s</a>',
                    $css_classes,
                    get_permalink( $page->ID ),
                    $args['link_before'],
                    apply_filters( 'the_title', $page->post_title, $page->ID ),
                    $args['link_after']
                );
        }


        if ( ! empty( $args['show_date'] ) ) {
            if ( 'modified' == $args['show_date'] ) {
                $time = $page->post_modified;
            } else {
                $time = $page->post_date;
            }

            $date_format = empty( $args['date_format'] ) ? '' : $args['date_format'];
            $output .= ' ' . mysql2date( $date_format, $time );
        }
    }
}


function digi_get_childposts($digi_parent)
{

// Get all the posts related to the thumbnail month and assign to an array
// which we will then iterate through to get the postID's we can then
// use the funstion to retrieve the attachments using the parent ID.
// also need to do a test to see how many articles to decide how many attachments to pull



$digi_child_posts = array();

	$args = array('numberposts' => -1 ,'post_type' => 'projects', 'post_parent' => $digi_parent, 'order' => 'ASC' , 'orderby' => 'menu_order'); 
	
	$digi_children = get_posts($args);
	$loopcount = 0;
	if ($digi_children) {
	$nochildren = "Yesy";

	foreach ( $digi_children as $digi_kid ) {
				// echo apply_filters( 'the_title' , $attachment->post_title );
			$digi_child_posts[$loopcount] = array("postID"=>$digi_kid->ID,
												  "title"=>$digi_kid->post_title,
												  "postContent"=>$digi_kid->post_content);
			$loopcount = $loopcount + 1;
				}
			}
			else
			{
			$nochildren = "Nochilderen";
			}



if (!$digi_child_posts){
	$theoutput = "Fail";
$digi_child_posts[0]= "failed";
$digi_child_posts[1] = $digi_parent;
$digi_child_posts[2] = $nochildren;
}
else
{
	$theoutput = "Success";

}


return $digi_child_posts;



}

function thumbnail_overview($theparent)
{

	$childpost = digi_get_childposts($theparent);
		//echo $childpost[1];
	//echo $childpost[2];
		$i = 0;
		$counter = 1;
		$slidecounter = 0;
	?>
	<div class="container-fluid thumb-grid">
		
	<div class="row">
	 <?php
	
	foreach ( $childpost as $child){
		
		$post_content = $childpost[$i]['postContent'];
		if ($post_content) {
				
				// echo apply_filters( 'the_title' , $attachment->post_title );wp_get_attachment_image_src($array_ids, 'feature_thumb');
				
				
				?>
				<div class="col-md-4 col-xl-4 thumb-card thumb-tooltip" data-toggle="tooltip" data-placement="bottom" title="<?php  echo $childpost[$i]['title'];  ?>" >
					<span class="helper"></span>
					<a class="align-bottom thumbnail-image" href="<?php $gallery_url =  get_permalink($childpost[$i]['postID']); echo $gallery_url ; ?>" ><?php echo get_the_post_thumbnail($childpost[$i]['postID'], 'grid-aspect', array( "class" => " align-bottom")); ?></a>
					
				</div>
				<?php
				$slidecounter++;
					
				}				

		$i++;
		$slidecounter = 0;
		
	}

		?>
	</div>
	</div>

		 <?php
}	 
		
function thumbnail_feed($theparent)
{

	global $post;
	$the_content =  $post->post_content;
	$the_content = preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', $the_content);  # strip shortcodes, keep shortcode content
	//remove_shortcode( 'gallery' );
	//$new_content = apply_filters('the_content',$the_content);
	//echo $new_content;  

	
	
	
	preg_match('/\[gallery.*ids=.(.*).\]/', $post->post_content, $ids);
	if ($ids) {
	$attachments = explode(",", $ids[1]);
	$thumbnailelement = "";
	?>

	
	<div class="container-fluid thumb-grid">
		
	<div class="row">
	 <?php
	if ($attachments) {
	foreach ( $attachments as $attachment){
		
		
		
				
				// echo apply_filters( 'the_title' , $attachment->post_title );wp_get_attachment_image_src($array_ids, 'feature_thumb');
				$thegallerylinkid = get_field( 'targetgallery', $attachment );
				$thevimeoid =  get_field( 'vimeoid', $attachment );
				
				?>
				<div class="col-md-4 col-xl-4 thumb-card thumb-tooltip" data-toggle="tooltip" data-placement="bottom" title="<?php  	  ?>" >
					
					<?php if (!$thevimeoid) { ?>
					<a class="align-bottom thumbnail-image" href="<?php $gallery_url =  get_permalink($thegallerylinkid); echo $gallery_url ; ?>" ><?php echo wp_get_attachment_image($attachment, 'grid-height', array( "class" => " align-bottom")); ?></a> <?php } else {
						?>
						<a class='align-bottom thumbnail-image' href='#'><div class='embed-container'><iframe src='https://player.vimeo.com/video/<?php echo $thevimeoid; ?>?background=1' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></a>
						<?php
						
					} ?>
					
					
				</div>
				<?php
				
					
								

		
		
									}
					}

		?>
	</div>
	</div>

		 <?php
		 }
	}	
	
function journal_feed($columns,$numposts)
{
	
	
						
						$latest_blog_posts = new WP_Query(array( 'post_type' => 'post', 'posts_per_page' => $numposts ));
						
						
						
						
						
					if ( $latest_blog_posts->have_posts() ) :
						
						
						
						
						
						?>
						<div class="container-fluid">
		
							<div class="row"><?php
						
						while ($latest_blog_posts->have_posts()) : $latest_blog_posts->the_post(); 
							
								
				
							?>
				<div class="col-md-<?php echo $columns;?> col-xl-<?php echo $columns;?> thumb-card thumb-tooltip" data-toggle="tooltip" data-placement="bottom" title="<?php  	  ?>" >
					
					<a class="align-bottom thumbnail-image" href="<?php the_permalink();?>" ><?php the_post_thumbnail( 'grid-journal' , array( "class" => " align-bottom") ) /* echo wp_get_attachment_image($post->ID, 'large', array( "class" => " align-bottom"));  */?></a>
					<div class="feed-title d-flex">#<?php the_title();$post_tags = get_the_tags();
 
if ( $post_tags ) {
    foreach( $post_tags as $tag ) {
    echo $tag->name . ', '; 
    }
}?></div>
				</div>
				<?php								
					
					
						endwhile;
						endif;
					?>
							</div>
						</div>
					<?php
				
	
	
} 

 
function show_tags()
{
    $post_tags = get_the_tags();
    $separator = ' | ';
    if (!empty($post_tags)) {
        foreach ($post_tags as $tag) {
            $output .= '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>' . $separator;
        }
        return trim($output, $separator);
    }
}

