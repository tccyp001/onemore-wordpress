<?php global $bpxl_goblog_options; ?>
<article <?php post_class(); ?>>
	<div id="post-<?php the_ID(); ?>" class="post-box">
		<header>
			<?php if($bpxl_goblog_options['bpxl_post_meta'] == '1') { ?>
				<?php if($bpxl_goblog_options['bpxl_post_meta_options']['2'] == '1') { ?>
					<time class="updated" datetime="<?php the_time('Y-m-j'); ?>" title="<?php the_time('F j, Y'); ?>">
						<span class="post-date"><?php the_time('d'); ?></span>
						<span class="post-month uppercase"><?php the_time('F'); ?></span>
						<span class="post-year uppercase"><?php the_time('Y'); ?></span>
					</time>
				<?php } ?>
			<?php } ?>
			<?php
				$bpxl_link_url = rwmb_meta( 'bpxl_linkurl', $args = array('type' => 'text'), $post->ID );
				$bpxl_link_bg = rwmb_meta( 'bpxl_link_background', $args = array('type' => 'color'), $post->ID );
			?>
			<div class="title-wrap">
				<h2 class="title home-post-title entry-title">
					<a href="<?php echo $bpxl_link_url; ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h2>
				<?php if($bpxl_goblog_options['bpxl_post_meta'] == '1') { ?>
					<?php if($bpxl_goblog_options['bpxl_post_meta_options']['1'] == '1') { ?>
						<span class="post-author vcard author"><?php _e('Written by ','bloompixel'); ?> <span class="fn"><?php the_author_posts_link(); ?></span></span>
					<?php } ?>
				<?php } ?>
			</div>
			<?php if($bpxl_goblog_options['bpxl_post_meta'] == '1') { ?>
				<?php if($bpxl_goblog_options['bpxl_post_meta_options']['6'] == '1') { ?>
					<div class="post-avtar">
						<?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '70' );  } ?>
					</div>
				<?php } ?>
			<?php } ?>
		</header><!--.header-->
		<div class="post-inner">
			<a href="<?php echo $bpxl_link_url; ?>">
				<div class="post-content post-format-link"<?php if (strlen($bpxl_link_bg) > 2 ) { echo 'style="background:' . $bpxl_link_bg . '"'; } ?>>
					<i class="fa fa-link post-format-icon"></i>
					<div class="post-format-link-content">
						<?php echo $bpxl_link_url; ?>
					</div>
				</div>
			</a>
			<?php $bpxl_link_excerpt_home = rwmb_meta( 'bpxl_link_excerpt_home', $args = array('type' => 'checkbox'), $post->ID );
			if(empty($bpxl_link_excerpt_home)) { ?>
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
			<?php } ?>
		</div><!--.post-inner-->
		<?php if($bpxl_goblog_options['bpxl_post_meta'] == '1') {
			// Post Meta
			get_template_part('template-parts/post-meta'); 
		} ?>
	</div><!--.post excerpt-->
</article><!--.post-box-->