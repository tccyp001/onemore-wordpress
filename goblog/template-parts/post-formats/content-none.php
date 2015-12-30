<?php global $bpxl_goblog_options; ?>
<article <?php post_class(); ?>>
	<div id="post-<?php the_ID(); ?>" class="post-box">
		<div class="post-inner">
			<div class="post-content">
				<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

				<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'bloompixel' ), admin_url( 'post-new.php' ) ); ?></p>

				<?php elseif ( is_search() ) : ?>

				<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'bloompixel' ); ?></p>
				
				<?php get_search_form(); ?>

				<?php else : ?>

				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'bloompixel' ); ?></p>

				<?php get_search_form(); ?>

				<?php endif; ?>
			</div><!--.post-content-->
		</div><!--.post-inner-->
	</div><!--.post-box-->
</article>