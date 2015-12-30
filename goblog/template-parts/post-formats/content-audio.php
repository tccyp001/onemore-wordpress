<?php global $bpxl_goblog_options; ?>
<article <?php post_class(); ?>>
	<div id="post-<?php the_ID(); ?>" class="post-box">
		<?php
			// Post Header
			get_template_part('template-parts/post-header');
			
			/** If Audio Post **/
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
                <?php } else {
                if ( has_post_thumbnail() ) {
                    if( $bpxl_goblog_options['bpxl_layout'] == 'thumbright' || $bpxl_goblog_options['bpxl_layout'] == 'thumbleft' || $bpxl_goblog_options['bpxl_archive_layout'] == 'thumbright' || $bpxl_goblog_options['bpxl_archive_layout'] == 'thumbleft' ) {
                        $bpxl_thumb_class = 'featured570';
                    } else {
                        $bpxl_thumb_class = 'featured';
                    } ?>
                <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" <?php if ( $bpxl_goblog_options['bpxl_img_hover'] == '1') { echo 'class="featured-thumbnail"'; } ?>><?php the_post_thumbnail( $bpxl_thumb_class ); ?></a>
				<?php }
                } ?>
            </div>
		<?php $bpxl_audio_excerpt_home = rwmb_meta( 'bpxl_audio_excerpt_home', $args = array('type' => 'checkbox'), $post->ID );
		if(empty($bpxl_audio_excerpt_home)) { ?>
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