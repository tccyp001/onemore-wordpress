<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage goblog
 * @since GoBlog 1.0
 */

get_header();

global $bpxl_goblog_options; ?>

<div class="detail-page <?php bpxl_layout_class(); ?>">
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
		<div id="content" class="content content-single">
		<?php if($bpxl_goblog_options['bpxl_above_post_ad'] != '') { ?>
			<div class="single-post-ad">
				<?php echo $bpxl_goblog_options['bpxl_above_post_ad']; ?>
			</div>
		<?php }

		// Main Loop
		
		if (have_posts()) : while (have_posts()) : the_post();

            if ( !current_user_can( 'edit_post' , get_the_ID() ) ) { setPostViews(get_the_ID()); }

			if($bpxl_goblog_options['bpxl_breadcrumbs'] == '1') { ?>
				<div class="breadcrumbs">
					<?php bpxl_breadcrumb(); ?>
				</div>
			<?php } ?>
			<div class="single-content">
				<?php get_template_part( 'template-parts/post-formats/single', get_post_format() ); ?>
			</div><!--.single-content-->

			<?php if($bpxl_goblog_options['bpxl_author_box'] == '1') { ?>
				<div class="author-box">
					<div class="author-box-avtar">
						<?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '140' );  } ?>
					</div>
					<div class="author-info-container">
						<div class="author-info">
							<div class="author-head">
								<h5 class="uppercase"><?php the_author_meta('display_name'); ?></h5>
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
					</div><!--.author-info-container-->
				</div><!--.author-box-->
			<?php }

			if($bpxl_goblog_options['bpxl_next_prev_article'] == '1') {
				// Previous/next post navigation.
				bpxl_post_nav();
			}

			// Related Posts
			bpxl_related_posts();

			// Load Comments
			comments_template();

			endwhile;
						
			else :
				// If no content, include the "No posts found" template.
				get_template_part( 'template-parts/post-formats/content', 'none' );
				
			endif; ?>
		</div>
	</div>
	<?php 
		$sidebar_position = rwmb_meta( 'bpxl_layout', $args = array('type' => 'image_select'), get_the_ID() );
		if ($sidebar_position != 'none') { get_sidebar(); }
	?>
</div><!--.detail-page-->
<?php get_footer();?>