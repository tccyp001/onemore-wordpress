<?php global $bpxl_goblog_options; ?>
		</div><!--#page-->
	</div><!--.main-wrapper-->
	<footer class="footer">
		<div class="container">
			<div class="footer-widgets">
				<div class="footer-widget footer-widget-1">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 1') ) : ?>
					<?php endif; ?>
				</div>
				<div class="footer-widget footer-widget-2">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 2') ) : ?>
					<?php endif; ?>
				</div>
				<div class="footer-widget footer-widget-3">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 3') ) : ?>
					<?php endif; ?>
				</div>
				<div class="footer-widget footer-widget-4 last">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 4') ) : ?>
					<?php endif; ?>
				</div>
			</div><!-- .footer-widgets -->
		</div><!-- .container -->
	</footer>
	<div class="copyright">
		<div class="copyright-inner">
			<?php if($bpxl_goblog_options['bpxl_footer_text'] != '') { ?><div class="copyright-text"><?php echo $bpxl_goblog_options['bpxl_footer_text']; ?></div><?php } ?>
		</div>
	</div><!-- .copyright -->
    </div><!-- .menu-pusher -->
</div><!-- .main-container -->
<?php if ($bpxl_goblog_options['bpxl_scroll_btn'] == '1') { ?>
	<div class="back-to-top"><i class="fa fa-arrow-up"></i></div>
<?php } ?>
</div>
<?php wp_footer(); ?>
</body>
</html>