<?php global $bpxl_goblog_options; ?>
<article <?php post_class(); ?>>
	<div id="post-<?php the_ID(); ?>" class="post-box">
		<?php
			// Post Header
			get_template_part('template-parts/post-header');
			
			$bpxl_gallery_images = rwmb_meta( 'bpxl_galleryimg', $args = array('type' => 'image'), $post->ID );
			$bpxl_gallery_type = rwmb_meta( 'bpxl_gallerytype', $args = array('type' => 'select'), $post->ID );
			
			if ($bpxl_gallery_images != NULL) {
				if ($bpxl_gallery_type == 'slider') { ?>
					<div class="galleryslider flexslider loading">
						<ul class="slides">
							<?php foreach ($bpxl_gallery_images as $bpxl_image_id) {
								$bpxl_image = wp_get_attachment_image_src($bpxl_image_id['ID'],'featured');
								echo "<li><img width='770' height='360' src='" . $bpxl_image[0] . "'></li>";
							} ?>
						</ul>
					</div>
				<?php } else { ?>
					<div class="gallerytiled">
						<ul>
							<?php foreach ($bpxl_gallery_images as $bpxl_image_id) {
								$bpxl_image_thumb = wp_get_attachment_image_src($bpxl_image_id['ID'],'thumbnail');
								$bpxl_image_large = wp_get_attachment_image_src($bpxl_image_id['ID'],'large'); ?>
								<li><a <?php if ( $bpxl_goblog_options['bpxl_img_hover'] == '1') { echo 'class="featured-thumb-gallery"'; } ?> href='<?php echo $bpxl_image_large[0]; ?>'><img width='150' height='150' src='<?php echo $bpxl_image_thumb[0]; ?>'></a></li>
							<?php } ?>
						</ul>
					</div>
				<?php }
			}
			
		?>
		<?php $bpxl_gallery_excerpt_home = rwmb_meta( 'bpxl_gallery_excerpt_home', $args = array('type' => 'checkbox'), $post->ID );
		if(empty($bpxl_gallery_excerpt_home)) { ?>
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