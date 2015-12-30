<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage goblog
 * @since GoBlog 1.0
 */

get_header();

global $bpxl_goblog_options; ?>

<div class="detail-page <?php bpxl_layout_class(); ?>">
	<div class="main-content">
	<?php if($bpxl_goblog_options['bpxl_single_layout'] == 'scblayout') { ?>
		<div class="sidebar-small">
			<div class="small-sidebar">
				<?php
					if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Secondary Sidebar') );
				?>
			</div><!--End .small-sidebar-->
		</div><!--End .sidebar-small-->
	<?php } ?>
		<div class="content-area single-content-area">
			<div id="content" class="content content-page">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>					
					<?php if($bpxl_goblog_options['bpxl_breadcrumbs'] == '1') { ?>
						<div class="breadcrumbs">
							<?php bpxl_breadcrumb(); ?>
						</div>
					<?php }?>
					<div class="page-content">
						<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
							<div class="post-box">
								<?php 
									$page_title = rwmb_meta( 'bpxl_hide_page_title', $args = array('type' => 'checkbox'), get_the_ID() );
									if ($page_title != '1') {
								?>
								<header>
									<h1 class="title page-title"><?php the_title(); ?></h1>
								</header>
								<?php } ?>
								<div class="single-page-content">
									<?php the_content(); ?>
									<?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?>
								</div>
							</div>	
						</article><!--blog post-->
					</div>	
					<?php
						comments_template();
						
						endwhile;
						
						else :
							// If no content, include the "No posts found" template.
							get_template_part( 'template-parts/post-formats/content', 'none' );
						endif;
					?>
			</div><!--.content-page-->
		</div><!--.content-area-->
	<?php 
		$sidebar_position = rwmb_meta( 'bpxl_layout', $args = array('type' => 'image_select'), get_the_ID() );
		if ($sidebar_position != 'none') { get_sidebar(); }
	?>
	</div><!--.main-content-->
</div><!--.detail-page-->
<?php get_footer();?>