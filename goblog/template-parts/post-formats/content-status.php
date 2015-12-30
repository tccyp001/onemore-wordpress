<?php global $bpxl_goblog_options; ?>
<article <?php post_class(); ?>>
	<div id="post-<?php the_ID(); ?>" class="post-box">
		<?php
			// Post Header
			get_template_part('template-parts/post-header');
			
			/** If Status Post **/
			if ( has_post_format( 'status' )) {
				$bpxl_status_type = rwmb_meta( 'bpxl_statustype', $args = array('type' => 'text'), $post->ID );
				$bpxl_status = rwmb_meta( 'bpxl_statuslink', $args = array('type' => 'text'), $post->ID );
				
				if ($bpxl_status_type == 'twitter') { ?>
					<div class="status-box home-status-box twitter-status">
						<blockquote class="twitter-tweet" lang="en" width="750"><p><a href="<?php if ($bpxl_status != '') { echo $bpxl_status; } ?>"></a></blockquote>
						<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
					</div>
				<?php } else if ($bpxl_status_type == 'facebook') { ?>
					<div class="status-box home-status-box fb-status">
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
				<?php } ?>
		<?php } ?>
		<?php $bpxl_status_excerpt_home = rwmb_meta( 'bpxl_status_excerpt_home', $args = array('type' => 'checkbox'), $post->ID );
		if(empty($bpxl_status_excerpt_home)) { ?>
			<div class="post-inner">
				<div class="post-content">
					<?php
						$excerpt_length = $bpxl_goblog_options['bpxl_excerpt_length'];
						if($bpxl_goblog_options['bpxl_home_content'] == '2') {
							the_content( __('Read More','bloompixel') );
						} else {
							echo excerpt($excerpt_length); ?>
								<div class="read-more">
									<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php _e('Read More','bloompixel'); ?></a>
								</div>		
						<?php }
					?>
				</div>	
			</div><!--.post-inner-->
		<?php } ?>
		<?php if($bpxl_goblog_options['bpxl_post_meta'] == '1') {
			// Post Meta
			get_template_part('template-parts/post-meta'); 
		} ?>
	</div><!--.post excerpt-->
</article><!--.post-box-->