<?php global $bpxl_goblog_options; ?>
<article <?php post_class(); ?>>
	<div id="post-<?php the_ID(); ?>">
		<div class="post-inner">
			<?php
				$bpxl_sourcename = rwmb_meta( 'bpxl_sourcename', $args = array('type' => 'text'), $post->ID );
				$bpxl_sourceurl = rwmb_meta( 'bpxl_sourceurl', $args = array('type' => 'text'), $post->ID );
				$bpxl_quote_bg_color = rwmb_meta( 'bpxl_quote_background_color', $args = array('type' => 'color'), $post->ID );
			?>
			<div class="post-content post-format-quote"<?php if (strlen($bpxl_quote_bg_color) > 2 ) { echo 'style="background:' . $bpxl_quote_bg_color . '"'; } ?>>
				<i class="fa fa-quote-left post-format-icon"></i>
				<div class="post-format-quote-content">
					<?php the_content(); ?>
					<div class="quote-source">
					<?php
						if ($bpxl_sourceurl != '') {
							echo '- <a href="' . $bpxl_sourceurl . '">' . $bpxl_sourcename . '</a>';
						} else if ($bpxl_sourcename != '') {
							echo '- ' . $bpxl_sourcename;
						}
					?>
					</div>
				</div>
			</div>
		</div><!--.post-inner-->
	</div><!--.post excerpt-->
</article><!--.post-box-->