<?php
/**
 * The template for displaying Author archive pages
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
			<div class="author-desc-box">
				<h4 class="author-box-title widget-title uppercase"><?php _e('Author Description','bloompixel'); ?></h4>
				<div class="author-box-content">
					<div class="author-box-avtar">
						<?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '95' );  } ?>
					</div>
					<div class="author-info-container">
						<div class="author-info">
							<div class="author-head">
								<h5><?php the_author_meta('display_name'); ?></h5>
								<div class="author-social">
									<?php if(get_the_author_meta('facebook')) { ?><span class="author-fb"><a class="fa fa-facebook" href="<?php echo get_the_author_meta('facebook'); ?>"></a></span><?php } ?>
									<?php if(get_the_author_meta('twitter')) { ?><span class="author-twitter"><a class="fa fa-twitter" href="<?php echo get_the_author_meta('twitter'); ?>"></a></span><?php } ?>
									<?php if(get_the_author_meta('googleplus')) { ?><span class="author-gp"><a class="fa fa-google-plus" href="<?php echo get_the_author_meta('googleplus'); ?>"></a></span><?php } ?>
									<?php if(get_the_author_meta('linkedin')) { ?><span class="author-linkedin"><a class="fa fa-linkedin" href="<?php echo get_the_author_meta('linkedin'); ?>"></a></span><?php } ?>
									<?php if(get_the_author_meta('pinterest')) { ?><span class="author-pinterest"><a class="fa fa-pinterest" href="<?php echo get_the_author_meta('pinterest'); ?>"></a></span><?php } ?>
									<?php if(get_the_author_meta('dribbble')) { ?><span class="author-dribbble"><a class="fa fa-dribbble" href="<?php echo get_the_author_meta('dribble'); ?>"></a></span><?php } ?>
								</div>
							</div>
							<p><?php the_author_meta('description') ?></p>
						</div>
					</div>
				</div>
			</div><!--.author-desc-box-->
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
		</div><!--content-archive-->
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