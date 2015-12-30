<?php global $bpxl_goblog_options; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-box">
		<?php
			if($bpxl_goblog_options['bpxl_single_featured'] == '1') {
				$bpxl_status_type = rwmb_meta( 'bpxl_statustype', $args = array('type' => 'text'), $post->ID );
				$bpxl_status = rwmb_meta( 'bpxl_statuslink', $args = array('type' => 'text'), $post->ID );						
				$bpxl_status_single = rwmb_meta( 'bpxl_status_single_hide', $args = array('type' => 'checkbox'), $post->ID );
				if(empty($bpxl_status_single)) {
					if ($bpxl_status_type == 'twitter') { ?>
						<div class="status-box">
							<blockquote class="twitter-tweet" lang="en" width="750"><p><a href="<?php if ($bpxl_status != '') { echo $bpxl_status; } ?>"></a></blockquote>
							<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
						</div>
					<?php } else if ($bpxl_status_type == 'facebook') { ?>
						<div class="status-box fb-status">
							<div id="fb-root"></div>
							<script>(function(d, s, id) {
							  var js, fjs = d.getElementsByTagName(s)[0];
							  if (d.getElementById(id)) return;
							  js = d.createElement(s); js.id = id;
							  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
							  fjs.parentNode.insertBefore(js, fjs);
							}(document, 'script', 'facebook-jssdk'));</script>
							<div class="fb-post" data-href="<?php if ($bpxl_status != '') { echo $bpxl_status; } ?>" data-width="735"></div>
						</div>
					<?php }
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