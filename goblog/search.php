<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage goblog
 * @since GoBlog 1.0
 */

global $bpxl_goblog_options;

get_header(); ?>

<div class="main-content <?php bpxl_layout_class(); ?>">
<?php if($bpxl_goblog_options['bpxl_layout'] == 'scb_layout') { ?>
	<div class="sidebar-small">
		<div class="small-sidebar">
			<?php
				if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Secondary Sidebar') );
			?>
		</div><!--End .small-sidebar-->
	</div><!--End .sidebar-small-->
<?php } ?>
<div class="content-area home-content-area">
	<div class="content-home">
        <h1 class="section-heading uppercase"><?php printf( __( 'Search Results for: %s', 'bloompixel' ), get_search_query() ); ?></h1>
        
		<div id="content" class="content <?php bpxl_masonry_class(); ?>">
			<?php
				if (have_posts()) : while (have_posts()) : the_post();
				
				get_template_part( 'template-parts/post-formats/content', get_post_format() );

				endwhile;
								
				else:
					// If no content, include the "No posts found" template.
					get_template_part( 'template-parts/post-formats/content', 'none' );

				endif;
			?>
		</div><!--content-->
		<?php 
			// Previous/next page navigation.
			bpxl_paging_nav();
		?>
	</div><!--content-page-->
</div><!--content-area-->
<?php
	$bpxl_layout_array = array(
		'c_layout',
		'g_layout'
	);

	if(!in_array($bpxl_goblog_options['bpxl_layout'],$bpxl_layout_array)) {
		get_sidebar();
	} ?>
</div><!--.main-->
<?php get_footer(); ?>