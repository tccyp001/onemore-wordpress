<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Fourteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage goblog
 * @since GoBlog 1.0
 */

get_header();

global $bpxl_goblog_options; ?>

<div class="archive-page <?php bpxl_layout_class(); ?>">
	<?php if($bpxl_goblog_options['bpxl_archive_layout'] == 'scblayout') { ?>
		<div class="sidebar-small">
			<div class="small-sidebar">
				<?php
					if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Secondary Sidebar') );
				?>
			</div><!--End .small-sidebar-->
		</div><!--End .sidebar-small-->
	<?php } ?>
	<div class="content-area archive-content-area">
		<div class="content-archive">
            
            <?php the_archive_title( '<h1 class="section-heading widget-title uppercase">', '</h1>' ); ?>
            
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
			</div><!--.content-->
			<?php 
				// Previous/next page navigation.
				bpxl_paging_nav();
			?>
		</div><!--.content-archive-->
	</div><!--content-area-->
	<?php
		$bpxl_layout_array = array(
			'clayout',
			'glayout'
		);
		if(!in_array($bpxl_goblog_options['bpxl_archive_layout'],$bpxl_layout_array)) { get_sidebar(); }
	?>
</div><!--.archive-page-->
<?php get_footer(); ?>