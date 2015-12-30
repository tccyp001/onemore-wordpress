<?php
/**
 * The template for displaying attachments
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
		<?php

		// Main Loop
		
		if (have_posts()) : while (have_posts()) : the_post(); ?>
            
			<div class="single-content">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="post-box">
                         <div class="entry-attachment">
                            <?php
                            
                            // Post Header
                            get_template_part('template-parts/post-header');

                            if ( $bpxl_goblog_options['bpxl_share_buttons_pos'] == 'top' ) {
                                // Post Share Buttons
                                bpxl_share_buttons_fn();
                            }

                            if ( wp_attachment_is_image( $post->id ) ) : $att_image = wp_get_attachment_image_src( $post->id, "full"); ?>
                                <div class="attachment"><a href="<?php echo wp_get_attachment_url($post->id); ?>" title="<?php the_title(); ?>" rel="attachment"><img src="<?php echo $att_image[0];?>" width="<?php echo $att_image[1];?>" height="<?php echo $att_image[2];?>"  class="attachment-medium" alt="<?php $post->post_excerpt; ?>" /></a>
                                </div>
                            <?php else : ?>
                            <a href="<?php echo wp_get_attachment_url($post->ID) ?>" title="<?php echo wp_specialchars( get_the_title($post->ID), 1 ) ?>" rel="attachment"><?php echo basename($post->guid) ?></a>
                            <?php endif; ?>
                            <?php
                                if ( $bpxl_goblog_options['bpxl_share_buttons_pos'] == 'bottom' ) {
                                    // Post Share Buttons
                                    bpxl_share_buttons_fn();
                                }
                            ?>
                        </div>
                    </div><!--.post-box-->
                </article><!--.blog post-->
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