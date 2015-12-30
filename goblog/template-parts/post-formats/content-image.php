<?php global $bpxl_goblog_options; ?>
<article <?php post_class(); ?>>
	<div id="post-<?php the_ID(); ?>" class="post-box">
		<?php
			// Post Header
			get_template_part('template-parts/post-header');
			
			$bpxl_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
		<a href="<?php echo $bpxl_url; ?>" title="<?php the_title_attribute(); ?>" <?php if ( $bpxl_goblog_options['bpxl_img_hover'] == '1') { echo 'class="featured-thumbnail featured-thumbnail-big"'; } ?>>
			<?php
				if ( has_post_thumbnail() ) {
					if( $bpxl_goblog_options['bpxl_layout'] == 'thumbright' || $bpxl_goblog_options['bpxl_layout'] == 'thumbleft' || $bpxl_goblog_options['bpxl_archive_layout'] == 'thumbright' || $bpxl_goblog_options['bpxl_archive_layout'] == 'thumbleft' ) {
                        $bpxl_thumb_class = 'featured570';
                    } else {
                        $bpxl_thumb_class = 'featured';
                    }
					the_post_thumbnail( $bpxl_thumb_class );
				} else {
					echo '<img width="770" height="360" src="' . get_stylesheet_directory_uri() . '/images/770x360.png" />';
				}
			?>
		</a>
		<?php $bpxl_image_excerpt_home = rwmb_meta( 'bpxl_image_excerpt_home', $args = array('type' => 'checkbox'), $post->ID );
		if(empty($bpxl_image_excerpt_home)) { ?>
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