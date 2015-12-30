<?php global $bpxl_goblog_options; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-box">
		<?php
			if($bpxl_goblog_options['bpxl_single_featured'] == '1') {
				$bpxl_video_single = rwmb_meta( 'bpxl_video_single_hide', $args = array('type' => 'checkbox'), $post->ID );
				if(empty($bpxl_video_single)) {
					$bpxl_videourl = rwmb_meta( 'bpxl_videourl', $args = array('type' => 'text'), $post->ID );
					$bpxl_videohost = rwmb_meta( 'bpxl_videohost', $args = array('type' => 'text'), $post->ID );
					$bpxl_videocode = rwmb_meta( 'bpxl_videocode', $args = array('type' => 'textarea'), $post->ID );
					
					if ($bpxl_videocode != '') {
						echo $bpxl_videocode;
					} else if($bpxl_videohost != '') {
						if($bpxl_videohost == 'youtube') {
							$src = 'https://www.youtube-nocookie.com/embed/'.$bpxl_videourl;
						} else if ($bpxl_videohost == 'vimeo') {
							$src = 'http://player.vimeo.com/video/'.$bpxl_videourl;
						} else if ($bpxl_videohost == 'dailymotion') {
							$src = 'http://www.dailymotion.com/embed/video/'.$bpxl_videourl;
						} else if ($bpxl_videohost == 'metacafe') {
							$src = 'http://www.metacafe.com/embed/'.$bpxl_videourl;
						} ?>
							<iframe src="<?php echo $src; ?>" class="vid iframe-<?php echo $bpxl_videohost; ?>"></iframe>
						<?php
					} else {
						if ( has_post_thumbnail() ) {
							the_post_thumbnail('featured');
						} else {
							echo '<img width="770" height="360" src="' . get_stylesheet_directory_uri() . '/images/770x360.png" />';
						}
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