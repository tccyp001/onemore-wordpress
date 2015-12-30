<?php global $bpxl_goblog_options; ?>
<div class="post-meta">
	<?php // Post Format Icons
		if ( is_single() ) {
			if($bpxl_goblog_options['bpxl_single_post_meta_options']['7'] == '1') {
				get_template_part('template-parts/post-format-icons');
			}
			if ($bpxl_goblog_options['bpxl_single_post_meta_options']['8'] == '1') { ?>
				<span class="post-time">
					<time datetime="<?php the_time('Y-m-j'); ?>">
						<i class="fa fa-clock-o"></i> <?php the_time(get_option( 'date_format' )); ?>
					</time>
				</span> <?php
			}
			if($bpxl_goblog_options['bpxl_single_post_meta_options']['3'] == '1') { ?>
				<span class="post-cats"><i class="fa fa-tag"></i> <?php the_category(', '); ?></span><?php
			}
			if($bpxl_goblog_options['bpxl_single_post_meta_options']['4'] == '1') {
				the_tags('<span class="post-tags"><i class="fa fa-tag"></i> ', ', ', '</span>');
			}
			if($bpxl_goblog_options['bpxl_single_post_meta_options']['5'] == '1') { ?>
				<span class="post-comments"><i class="fa fa-comments-o"></i> <?php comments_popup_link( __( 'Leave a Comment', 'bloompixel' ), __( '1 Comment', 'bloompixel' ), __( '% Comments', 'bloompixel' ), 'comments-link', __( 'Comments are off', 'bloompixel' )); ?></span><?php
			} ?>
	<?php } else {
		if ($bpxl_goblog_options['bpxl_post_meta_options']['7'] == '1') {
			get_template_part('template-parts/post-format-icons'); 
		}
		if ($bpxl_goblog_options['bpxl_post_meta_options']['8'] == '1') { ?>
			<span class="post-time">
				<time datetime="<?php the_time('Y-m-j'); ?>">
					<i class="fa fa-clock-o"></i> <?php the_time(get_option( 'date_format' )); ?>
				</time>
			</span> <?php
		}
		if ($bpxl_goblog_options['bpxl_post_meta_options']['3'] == '1') { ?>
			<span class="post-cats"><i class="fa fa-folder-o"></i> <?php the_category(', '); ?></span><?php
		}
		if ($bpxl_goblog_options['bpxl_post_meta_options']['4'] == '1') {
			the_tags('<span class="post-tags"><i class="fa fa-tag"></i> ', ', ', '</span>');
		}
		if ($bpxl_goblog_options['bpxl_post_meta_options']['5'] == '1') { ?>
			<span class="post-comments"><i class="fa fa-comments-o"></i> <?php comments_popup_link( __( 'Leave a Comment', 'bloompixel' ), __( '1 Comment', 'bloompixel' ), __( '% Comments', 'bloompixel' ), 'comments-link', __( 'Comments are off', 'bloompixel' )); ?></span><?php
		} ?>
	<?php } ?>
	<span class="edit-post"><?php edit_post_link('Edit'); ?></span>
</div><!--.post-meta-->