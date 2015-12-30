<?php
/**
 * Template Name: Full Width Template
 */
?>
<?php get_header(); ?>
<?php global $bpxl_goblog_options; ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<article class="full-width">
			<?php if($bpxl_goblog_options['bpxl_breadcrumbs'] == '1') { ?>
				<div class="breadcrumbs">
					<?php bpxl_breadcrumb(); ?>
				</div>
			<?php }?>
			<div class="post-box">
				<div class="content clearfix">
					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
						
						<header>
							<h1 class="title page-title"><?php the_title(); ?></h1>
						</header>
						
						<div class="post-content single-page-content">
							<?php the_content(); ?>
							<?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?>
						</div>	
					</div><!--blog post-->
				</div>
			</div><!--.post-box-->
		</article>
		<div id="fullwidth-comments" class="comments-area clearfix">
			<?php comments_template(); ?>
		</div><!-- #comments -->	
		<?php
			endwhile;
			
			else :
				// If no content, include the "No posts found" template.
				get_template_part( 'template-parts/post-formats/content', 'none' );
			endif;
		?>
<?php get_footer();?>