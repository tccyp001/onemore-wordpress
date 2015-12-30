<?php global $bpxl_goblog_options; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-box">
		<?php
			if($bpxl_goblog_options['bpxl_single_featured'] == '1') {
				$bpxl_link_single = rwmb_meta( 'bpxl_link_single_hide', $args = array('type' => 'checkbox'), $post->ID );				
				$bpxl_link_url = rwmb_meta( 'bpxl_linkurl', $args = array('type' => 'text'), $post->ID );
				$bpxl_link_bg = rwmb_meta( 'bpxl_link_background', $args = array('type' => 'color'), $post->ID );
				if(empty($bpxl_link_single)) {
					?>
					<a href="<?php echo $bpxl_link_url; ?>">
					<div class="post-content post-format-link"<?php if (strlen($bpxl_link_bg) > 2 ) { echo 'style="background:' . $bpxl_link_bg . '"'; } ?>>
						<i class="fa fa-link post-format-icon"></i>
						<div class="post-format-link-content">
							<?php echo $bpxl_link_url; ?>
						</div>
					</div>
					</a> <?php
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
			<?php }

			the_content();

			if($bpxl_goblog_options['bpxl_below_content_ad'] != '') { ?>
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