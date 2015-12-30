<?php
/**
 * The template for displaying Sitemap
 *
 * @package WordPress
 * @subpackage goblog
 * @since GoBlog 1.0
 */

global $bpxl_goblog_options;

get_header(); ?>

<div class="main-content <?php bpxl_layout_class(); ?>">
	<?php if($bpxl_goblog_options['bpxl_single_layout'] == 'scblayout') { ?>
		<div class="sidebar-small">
			<div class="small-sidebar">
				<?php
					if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Secondary Sidebar') );
				?>
			</div><!--End .small-sidebar-->
		</div><!--End .sidebar-small-->
	<?php } ?>
	<div class="content-area">
		<div class="content-page">
			<div class="page-content">
				<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					<div class="post-box">
						<header>
							<h1 class="title page-title"><?php _e('Sitemap','bloompixel'); ?></h1>
						</header>
						<div class="single-page-content">
							<div class="sitemap-col">
								<h3 class="widget-title uppercase"><?php _e('Categories','bloompixel'); ?></h3>
								<ul>
									<?php wp_list_categories('title_li='); ?>
								</ul>
							</div>
							<div class="sitemap-col">
								<h3 class="widget-title uppercase"><?php _e('Pages','bloompixel'); ?></h3>
								<ul>
									<?php wp_list_pages('title_li='); ?>
								</ul>
							</div>
							<div class="sitemap-col">
								<h3 class="widget-title uppercase"><?php _e('Tags','bloompixel'); ?></h3>
								<ul>
								<?php
									$tags = get_tags( array('orderby' => 'count', 'order' => 'DESC') );
									foreach ( (array) $tags as $tag ) {
									echo '<li><a href="' . get_tag_link ($tag->term_id) . '" rel="tag">' . $tag->name . '</a></li>';
									}
								?>
								</ul>
							</div>
							<div class="sitemap-col">
								<h3 class="widget-title uppercase"><?php _e('Authors','bloompixel'); ?></h3>
								<ul>
									<?php wp_list_authors(); ?>
								</ul>
							</div>
							<div class="sitemap-col">
								<h3 class="widget-title uppercase"><?php _e('Authors','bloompixel'); ?></h3>
								<ul>
									<?php wp_list_authors(); ?>
								</ul>
							</div>
						</div>
					</div><!--.post-box-->
				</article>
			</div>
		</div>
	</div><!--content-area-->
	<?php get_sidebar(); ?>
</div><!--.main-->
<?php get_footer(); ?>