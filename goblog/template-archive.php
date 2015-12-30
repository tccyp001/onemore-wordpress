<?php
/*
Template Name: Archives
*/
?>
<?php global $bpxl_goblog_options; ?>
<?php get_header(); ?>

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
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>		
					<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
						<div class="post-box">
							<header>
								<h1 class="title page-title"><?php the_title(); ?></h1>
							</header>
							<div class="single-page-content">
								<?php the_content(); ?>
							</div>
							<div class="archive-template-content">
								<div class="archive-col">
									<h3 class="widget-title uppercase"><?php _e('Recent Posts','bloompixel'); ?></h3>
									<ul>
										<?php wp_get_archives( array( 'type' => 'postbypost', 'limit' => 20, 'format' => 'html' ) ); ?>
									</ul>
								</div>
								<div class="archive-col">
									<h3 class="widget-title uppercase"><?php _e('Archives by Categories','bloompixel'); ?></h3>
									<ul>
										<?php wp_list_categories('title_li='); ?>
									</ul>
								</div>
								<div class="archive-col">
									<h3 class="widget-title uppercase"><?php _e('Archives by Month','bloompixel'); ?></h3>
									<ul>
										<?php wp_get_archives( array( 'type' => 'monthly', 'limit' => 12 ) ); ?>
									</ul>
								</div>
								<div class="archive-col">
									<h3 class="widget-title uppercase"><?php _e('Archives by Year','bloompixel'); ?></h3>
									<ul>
										<?php wp_get_archives( array( 'type' => 'yearly', 'limit' => 12 ) ); ?>
									</ul>
								</div>
								<div class="archive-col">
									<h3 class="widget-title uppercase"><?php _e('Archives by Tags','bloompixel'); ?></h3>
									<ul>
									<?php
										$tags = get_tags( array('orderby' => 'count', 'order' => 'DESC') );
										foreach ( (array) $tags as $tag ) {
										echo '<li><a href="' . get_tag_link ($tag->term_id) . '" rel="tag">' . $tag->name . '</a></li>';
										}
									?>
									</ul>
								</div>
								<div class="archive-col">
									<h3 class="widget-title uppercase"><?php _e('Authors','bloompixel'); ?></h3>
									<ul>
										<?php wp_list_authors(); ?>
									</ul>
								</div>
							</div><!--.archive-template-content-->
						</div><!--.post-box-->
					</article>
					<?php endwhile; ?>
					<?php else : ?>
						<div class="post">
							<div class="single-page-content error-page-content">
								<p><strong><?php _e('Nothing Found', 'bloompixel'); ?></strong></p>
								<?php get_search_form(); ?>
							</div><!--noResults-->
						</div>
					<?php endif; ?>
			</div><!--.page-content-->
		</div>
	</div><!--content-area-->
	<?php get_sidebar(); ?>
</div><!--.main-->
<?php get_footer(); ?>