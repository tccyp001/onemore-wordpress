<?php global $bpxl_goblog_options; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-box">
		<?php
			if($bpxl_goblog_options['bpxl_single_featured'] == '1') {
				$bpxl_image_single = rwmb_meta( 'bpxl_image_single_hide', $args = array('type' => 'checkbox'), $post->ID );
				if(empty($bpxl_image_single)) {
					if ( has_post_thumbnail() ) {
						echo '<div class="single-post-type">';
							the_post_thumbnail('featured', array('title' => ''));
						echo '</div>';
					}
				}
			}
			
			// Post Header
			get_template_part('template-parts/post-header');
		
			if($bpxl_goblog_options['bpxl_single_post_meta'] == '1') {
				// Post Meta
				get_template_part('template-parts/post-meta');
			}

			if ( $bpxl_goblog_options['bpxl_share_buttons_pos'] == 'top' ) {
				// Post Share Buttons
				bpxl_share_buttons_fn();
			}
		?>
		<div class="single-post-content">			
			<?php if($bpxl_goblog_options['bpxl_below_title_ad'] != '') { ?>
				<div class="single-post-ad">
					<?php echo $bpxl_goblog_options['bpxl_below_title_ad']; ?>
				</div>
			<?php } ?>
			
			<?php the_content(); ?>
		
			<?php if($bpxl_goblog_options['bpxl_below_content_ad'] != '') { ?>
				<div class="single-post-ad">
					<?php echo $bpxl_goblog_options['bpxl_below_content_ad']; ?>
				</div>
			<?php } ?>
		</div><!--.single-post-content-->

		<?php
			bpxl_wp_link_pages();
			
			if ( $bpxl_goblog_options['bpxl_share_buttons_pos'] == 'bottom' ) {
				// Post Share Buttons
				bpxl_share_buttons_fn();
			}
		?>
	</div><!--.post-box-->
</article><!--.blog post-->