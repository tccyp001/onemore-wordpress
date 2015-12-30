<?php global $bpxl_goblog_options; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-box">
		<?php
			if($bpxl_goblog_options['bpxl_single_featured'] == '1') {
				$bpxl_gallery_single = rwmb_meta( 'bpxl_gallery_single_hide', $args = array('type' => 'checkbox'), $post->ID );
				if(empty($bpxl_gallery_single)) {
					$bpxl_gallery_images = rwmb_meta( 'bpxl_galleryimg', $args = array('type' => 'image'), $post->ID );
					$bpxl_gallery_type = rwmb_meta( 'bpxl_gallerytype', $args = array('type' => 'select'), $post->ID );
					
					if ($bpxl_gallery_images != NULL) {
						if ($bpxl_gallery_type == 'slider') { ?>
							<div class="galleryslider flexslider loading">
								<ul class="slides">
									<?php foreach ($bpxl_gallery_images as $bpxl_image_id) {
										$bpxl_image = wp_get_attachment_image_src($bpxl_image_id['ID'],'featured');
										echo "<li><img src='" . $bpxl_image[0] . "'></li>";
									} ?>
								</ul>
							</div>
						<?php } else { ?>
							<div class="gallerytiled">
								<ul>
									<?php foreach ($bpxl_gallery_images as $bpxl_image_id) {
										$bpxl_image_thumb = wp_get_attachment_image_src($bpxl_image_id['ID'],'thumbnail');
										$bpxl_image_large = wp_get_attachment_image_src($bpxl_image_id['ID'],'large');
										echo "<li><a class='featured-thumb-gallery' href='" . $bpxl_image_large[0] . "'><img src='" . $bpxl_image_thumb[0] . "'></a></li>";
									} ?>
								</ul>
							</div>
						<?php }
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