<?php global $bpxl_goblog_options; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-box">
		<?php
			if($bpxl_goblog_options['bpxl_single_featured'] == '1') {
				$bpxl_audio_single = rwmb_meta( 'bpxl_audio_single_hide', $args = array('type' => 'checkbox'), $post->ID );
				if(empty($bpxl_audio_single)) {
					$bpxl_audio_url = rwmb_meta( 'bpxl_audiourl', $args = array('type' => 'text'), $post->ID );
					$bpxl_audio_host = rwmb_meta( 'bpxl_audiohost', $args = array('type' => 'text'), $post->ID );
					$bpxl_audio_embed_code = rwmb_meta( 'bpxl_audiocode', $args = array('type' => 'textarea'), $post->ID );
					?>
					<div class="audio-box">
						<?php if ($bpxl_audio_embed_code != '') {
							echo $bpxl_audio_embed_code;
						} else if($bpxl_audio_host == 'soundcloud') { ?>
							<iframe border="no" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=<?php if($bpxl_audio_url != '') { echo $bpxl_audio_url; } ?>&auto_play=false&hide_related=false&visual=true"></iframe>
						<?php } else if ($bpxl_audio_host == 'mixcloud') { ?>
							<iframe src="//www.mixcloud.com/widget/iframe/?feed=<?php if($bpxl_audio_url != '') { echo $bpxl_audio_url; } ?>&embed_type=widget_standard&embed_uuid=43f53ec5-65c0-4d1f-8b55-b26e0e7c2288&hide_tracklist=1&hide_cover=0" frameborder="0"></iframe>
						<?php } ?>
					</div>
					<?php
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