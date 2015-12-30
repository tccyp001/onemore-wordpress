<?php global $bpxl_goblog_options; ?>
<header>
	<div class="post-title clearfix">
		<?php if ( is_single() ) { ?>
			<?php if($bpxl_goblog_options['bpxl_single_post_meta'] == '1') { ?>
				<?php if($bpxl_goblog_options['bpxl_single_post_meta_options']['2'] == '1') { ?>
					<time datetime="<?php the_time('Y-m-j'); ?>" title="<?php the_time('F j, Y'); ?>">
						<span class="post-date"><?php the_time('d'); ?></span>
						<span class="post-month uppercase"><?php the_time('F'); ?></span>
						<span class="post-year uppercase"><?php the_time('Y'); ?></span>
					</time>
				<?php } ?>
			<?php } ?>
			<div class="title-wrap">
				<h2 class="title single-title title20">
					<?php the_title(); ?>
				</h2>
				<?php if($bpxl_goblog_options['bpxl_single_post_meta'] == '1') { ?>
					<?php if($bpxl_goblog_options['bpxl_single_post_meta_options']['1'] == '1') { ?>
						<span class="post-author"><?php _e('Written by ','bloompixel'); the_author_posts_link(); ?></span>
					<?php } ?>
				<?php } ?>
			</div>
			<?php if($bpxl_goblog_options['bpxl_single_post_meta'] == '1') { ?>
				<?php if($bpxl_goblog_options['bpxl_single_post_meta_options']['6'] == '1') { ?>
					<div class="post-avtar">
						<?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '70' );  } ?>
					</div>
				<?php } ?>
			<?php } ?>
		<?php } else { ?>
			<?php if($bpxl_goblog_options['bpxl_post_meta'] == '1') { ?>
				<?php if($bpxl_goblog_options['bpxl_post_meta_options']['2'] == '1') { ?>
					<time class="updated" datetime="<?php the_time('Y-m-j'); ?>" title="<?php the_time('F j, Y'); ?>">
						<span class="post-date"><?php the_time('d'); ?></span>
						<span class="post-month uppercase"><?php the_time('F'); ?></span>
						<span class="post-year uppercase"><?php the_time('Y'); ?></span>
					</time>
				<?php } ?>
			<?php } ?>
			<div class="title-wrap">
				<h2 class="title home-post-title entry-title">
					<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h2>
				<?php if($bpxl_goblog_options['bpxl_post_meta'] == '1') { ?>
					<?php if($bpxl_goblog_options['bpxl_post_meta_options']['1'] == '1') { ?>
						<span class="post-author vcard author"><?php _e('Written by','bloompixel'); ?> <span class="fn"><?php the_author_posts_link(); ?></span></span>
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
		<?php } ?>
	</div>
</header><!--.header-->