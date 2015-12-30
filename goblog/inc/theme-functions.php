<?php
/**
 * Custom template tags for GoBlog
 *
 * @package WordPress
 * @subpackage goblog
 * @since GoBlog 1.0
 */

/*-----------------------------------------------------------------------------------*/
/*	Post and Header Classes
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'bpxl_masonry_class' ) ) :
	function bpxl_masonry_class() {
		global $bpxl_goblog_options;
		
		$bpxl_class_mason = '';
		
		if(is_home() || is_front_page() || is_search()) {
			if($bpxl_goblog_options['bpxl_layout'] == 'clayout' || $bpxl_goblog_options['bpxl_layout'] == 'gslayout' || $bpxl_goblog_options['bpxl_layout'] == 'sglayout' || $bpxl_goblog_options['bpxl_layout'] == 'glayout') {
				$bpxl_class_mason = 'masonry';
			}
		}
		elseif(is_archive() || is_author()) {
			if($bpxl_goblog_options['bpxl_archive_layout'] == 'clayout' || $bpxl_goblog_options['bpxl_archive_layout'] == 'gslayout' || $bpxl_goblog_options['bpxl_archive_layout'] == 'sglayout' || $bpxl_goblog_options['bpxl_archive_layout'] == 'glayout') {
				$bpxl_class_mason = 'masonry';
			}
		}
		elseif( is_single() || is_page() ) {

		}
		
		echo $bpxl_class_mason;
	}
endif;

if ( ! function_exists( 'bpxl_layout_class' ) ) :
	function bpxl_layout_class() {
		global $bpxl_goblog_options;
		
		$bpxl_class = '';
		
		if(is_home() || is_front_page() || is_search()) {
			if($bpxl_goblog_options['bpxl_layout'] == 'clayout' || $bpxl_goblog_options['bpxl_layout'] == 'gslayout' || $bpxl_goblog_options['bpxl_layout'] == 'sglayout' || $bpxl_goblog_options['bpxl_layout'] == 'glayout') {
				$bpxl_class = 'masonry-home ' . $bpxl_goblog_options['bpxl_layout'];
			} else {
				$bpxl_class = $bpxl_goblog_options['bpxl_layout'];
			}
		}
		elseif(is_archive() || is_author()) {
			if($bpxl_goblog_options['bpxl_archive_layout'] == 'clayout' || $bpxl_goblog_options['bpxl_archive_layout'] == 'gslayout' || $bpxl_goblog_options['bpxl_archive_layout'] == 'sglayout' || $bpxl_goblog_options['bpxl_archive_layout'] == 'glayout') {
				$bpxl_class = 'masonry-archive ' . $bpxl_goblog_options['bpxl_archive_layout'];
			} else {
				$bpxl_class = $bpxl_goblog_options['bpxl_archive_layout'];
			}
		}
		elseif( is_single() || is_page() ) {
			$bpxl_class = $bpxl_goblog_options['bpxl_single_layout'];
		}
		
		echo $bpxl_class;
	}
endif;

if ( ! function_exists( 'bpxl_header_class' ) ) :
	function bpxl_header_class() {
		global $bpxl_goblog_options;
		
		$bpxl_header_class = '';
		
		if ($bpxl_goblog_options['bpxl_header_style'] == 'header_two') { $bpxl_header_class = 'header-two'; }
		
		echo $bpxl_header_class;
	}
endif;

/*-----------------------------------------------------------------------------------*/
/*	Pagination
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'bpxl_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function bpxl_paging_nav() {
	global $bpxl_goblog_options;
	
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Previous', 'bloompixel' ),
		'next_text' => __( 'Next &rarr;', 'bloompixel' ),
	) );
	if ($bpxl_goblog_options['bpxl_pagination_type'] == '1') :
		if ( $links ) :

		?>
		<nav class="navigation paging-navigation" role="navigation">
			<div class="pagination loop-pagination">
				<?php echo $links; ?>
			</div><!-- .pagination -->
		</nav><!-- .navigation -->
		<?php
		endif;
	else:
	?>
		<nav class="norm-pagination" role="navigation">
			<div class="nav-previous"><?php next_posts_link( '&larr; ' . __( 'Older posts', 'bloompixel' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'bloompixel' ).' &rarr;' ); ?></div>
		</nav>
	<?php
	endif;
}
endif;

/*-----------------------------------------------------------------------------------*/
/*	Post Navigation
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'bpxl_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function bpxl_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}

	?>
	<nav class="navigation post-navigation textcenter clearfix" role="navigation">
		<?php
		if ( is_attachment() ) :
			next_post_link('<div class="alignleft post-nav-links prev-link-wrapper"><div class="next-link"><span class="uppercase">'. __("Published In","bloompixel") .'</span> %link'."</div></div>");
		else :

			$prev_post_bg = '';
			$next_post_bg = '';

			$prev_post = get_previous_post();
			if (!empty( $prev_post )):
				$prev_post_bg = get_the_post_thumbnail( $prev_post->ID, 'featured370' );
			endif;
			
			$next_post = get_next_post();
			if (!empty( $next_post )):
				$next_post_bg = get_the_post_thumbnail( $next_post->ID, 'featured370' );
			endif;

			previous_post_link('<div class="alignleft post-nav-links prev-link-wrapper"><div class="post-nav-link-bg">'. $prev_post_bg .'</div><div class="prev-link"><span class="uppercase"><i class="fa fa-long-arrow-left"></i> &nbsp;'. __("Previous Article","bloompixel").'</span> %link'."</div></div>");
			next_post_link('<div class="alignright post-nav-links next-link-wrapper"><div class="post-nav-link-bg">'. $next_post_bg .'</div><div class="next-link"><span class="uppercase">'. __("Next Article","bloompixel") .' &nbsp;<i class="fa fa-long-arrow-right"></i></span> %link'."</div></div>");
		endif;
		?>
	</nav><!-- .navigation -->
	<?php
}
endif;

/*-----------------------------------------------------------------------------------*/
/*	Track Post Views
/*-----------------------------------------------------------------------------------*/
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return __('0 View','bloompixel');
    }
    return $count.' '.__('Views','bloompixel');
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

/*-----------------------------------------------------------------------------------*/
/*	Related Posts
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'bpxl_related_posts' ) ) :
	function bpxl_related_posts() {
		global $bpxl_goblog_options;
		$related = rwmb_meta( 'bpxl_singlerelated', $args = array('type' => 'checkbox'), get_the_ID() );

		if($related == '1') {

		} else if($bpxl_goblog_options['bpxl_related_posts'] == '1') {

			global $post;
			$orig_post = $post;

			$categories = '';
			$tags = '';
			
			//Related Posts By Categories
			if ($bpxl_goblog_options['bpxl_related_posts_by'] == '1') {
				$categories = get_the_category( get_the_ID() );
				if ($categories) {
					$category_ids = array();
					foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
					$args=array(
						'category__in' => $category_ids,
						'post__not_in' => array($post->ID),
						'posts_per_page'=> $bpxl_goblog_options['bpxl_related_posts_count'], // Number of related posts that will be shown.
						'ignore_sticky_posts'=>1
					);
				}
			}
			//Related Posts By Tags
			else {
				$tags = wp_get_post_tags( get_the_ID() );
				if ($tags) {
					$tag_ids = array();  
					foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;  
					$args=array(
						'tag__in' => $tag_ids,  
						'post__not_in' => array($post->ID),  
						'posts_per_page'=> $bpxl_goblog_options['bpxl_related_posts_count'], // Number of related posts to display.  
						'ignore_sticky_posts'=>1 
					); 
				}
			}
			if ($categories || $tags) {
				$my_query = new wp_query( $args );
				if( $my_query->have_posts() ) {
					echo '<div class="relatedPosts"><h3 class="section-heading uppercase"><span>'.__("Related Posts","bloompixel").'</span></h3><ul class="slides">';
					while( $my_query->have_posts() ) {
						$my_query->the_post();?>
						<li>
							<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="nofollow">
								<?php if ( has_post_thumbnail() ) { ?> 
									<div class="relatedthumb"><?php the_post_thumbnail('related'); ?></div>
								<?php } else { ?>
									<div class="relatedthumb"><img width="240" height="185" src="<?php echo get_template_directory_uri(); ?>/images/240x185.png" class="attachment-featured wp-post-image" alt="<?php the_title(); ?>"></div>
								<?php } ?>
							</a>
							<?php
								$post_title = the_title('','',false);
								$short_title = substr($post_title,0,38);
								
								if ( $short_title != $post_title ) {
									$short_title .= "...";
								} else {
									$short_title = $post_title;
								}
							?>
							<div class="related-content">
								<header>
									<h2 class="title title18">
										<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
									</h2>
								</header><!--.header-->		
								<div class="meta">
									<?php if(isset($bpxl_goblog_options['bpxl_single_post_meta_options']['2']) == '1') { ?>
										<time datetime="<?php the_time('Y-m-j'); ?>"><?php the_time(get_option( 'date_format' )); ?></time>
									<?php } ?>
								</div>
							</div>
						</li>
						<?php
					}
					echo '</ul></div>';
				}
				$post = $orig_post;
				wp_reset_query();
			}
		}
	}
endif;

/*-----------------------------------------------------------------------------------*/
/*	Share Buttons
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'bpxl_share_buttons_fn' ) ) :
	function bpxl_share_buttons_fn() {
		global $post;
		global $bpxl_goblog_options;

		if($bpxl_goblog_options['bpxl_show_share_buttons'] == '1') { ?>
			<div class="share-buttons">
				<?php if($bpxl_goblog_options['bpxl_share_text'] != '') { ?>
					<div class="social-btn-title"><?php echo $bpxl_goblog_options['bpxl_share_text']; ?></div>
				<?php } ?>
				<div class="social-buttons clearfix">
					<?php
						$bpxl_social_array = $bpxl_goblog_options['bpxl_share_buttons'];
						
						foreach ($bpxl_social_array as $key=>$value) {
							if($key == "twitter" && $value == "1") { ?>
								<!-- Twitter -->
								<div class="social-btn social-twitter">
									<a rel="nofollow" class="fa fa-twitter" href="http://twitter.com/home?status=<?php echo urlencode(get_the_title()); ?>+<?php the_permalink() ?>" target="_blank" title="<?php _e('Share on Twitter','bloompixel'); ?>"></a>
								</div>
							<?php }
							elseif($key == "fb" && $value == "1") { ?>
								<!-- Facebook -->
								<div class="social-btn social-fb">
									<a rel="nofollow" class="fa fa-facebook" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>" target="_blank" title="<?php _e('Share on Facebook','bloompixel'); ?>"></a>
								</div>
							<?php }
							elseif($key == "gplus" && $value == "1") { ?>
								<!-- Google+ -->
								<div class="social-btn social-gplus">
									<a rel="nofollow" class="fa fa-google-plus" href="https://plus.google.com/share?url=<?php the_permalink() ?>" target="_blank" title="<?php _e('Share on Google+','bloompixel'); ?>"></a>
								</div>
							<?php }
							elseif($key == "linkedin" && $value == "1") { ?>
								<!-- LinkedIn -->
								<div class="social-btn social-linkedin">
									<a rel="nofollow" class="fa fa-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink() ?>&amp;title=<?php echo urlencode(get_the_title()); ?>&amp;source=<?php echo esc_url( home_url() ); ?>" target="_blank" title="<?php _e('Share on LinkedIn','bloompixel'); ?>"></a>
								</div>
							<?php }
							elseif($key == "pinterest" && $value == "1") { ?>
								<!-- Pinterest -->
								<?php $pin_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID) ); $pin_url = $pin_thumb['0']; ?>
								<div class="social-btn social-pinterest">
									<a rel="nofollow" class="fa fa-pinterest" href="http://pinterest.com/pin/create/bookmarklet/?media=<?php echo $pin_url; ?>&amp;url=<?php the_permalink() ?>&amp;is_video=false&amp;description=<?php echo urlencode(get_the_title()); ?>" target="_blank" title="<?php _e('Share on Pinterest','bloompixel'); ?>"></a>
								</div>
							<?php }
							elseif($key == "stumbleupon" && $value == "1") { ?>
								<!-- StumbleUpon -->
								<div class="social-btn social-stumbleupon">
									<a rel="nofollow" class="fa fa-stumbleupon" href="http://www.stumbleupon.com/submit?url=<?php the_permalink() ?>&amp;title=<?php _e(urlencode(the_title('','',false))); ?>" target="_blank" title="<?php _e('Share on StumbleUpon','bloompixel'); ?>"></a>
								</div>
							<?php }
							elseif($key == "reddit" && $value == "1") { ?>
								<!-- Reddit -->
								<div class="social-btn social-reddit">
									<a rel="nofollow" class="fa fa-reddit" href="http://www.reddit.com/submit?url=<?php the_permalink() ?>&amp;title=<?php _e(urlencode(the_title('','',false))); ?>" target="_blank" title="<?php _e('Share on Reddit','bloompixel'); ?>"></a>
								</div>
							<?php }
							elseif($key == "tumblr" && $value == "1") { ?>
								<!-- Tumblr -->
								<div class="social-btn social-tumblr">
									<a rel="nofollow" class="fa fa-tumblr" href="http://www.tumblr.com/share?v=3&amp;u=<?php the_permalink() ?>&amp;t=<?php echo urlencode(get_the_title()); ?>" target="_blank" title="<?php _e('Share on Tumblr','bloompixel'); ?>"></a>
								</div>
							<?php }
							elseif($key == "delicious" && $value == "1") { ?>
								<!-- Delicious -->
								<div class="social-btn social-delicious">
									<a rel="nofollow" class="fa fa-delicious" href="http://del.icio.us/post?url=<?php the_permalink() ?>&amp;title=<?php echo urlencode(get_the_title()); ?>&amp;notes=<?php echo urlencode(get_the_title()); ?>" target="_blank" title="<?php _e('Share on Delicious','bloompixel'); ?>"></a>
								</div>
							<?php }
                            elseif($key == "vkontakte" && $value == "1") { ?>
								<!-- Delicious -->
								<div class="social-btn social-vkontakte">
                                    <a class="fa fa-vk" href="http://vk.com/share.php?url=<?php the_permalink(); ?>" target="_blank"></a>
								</div>
							<?php }
							else {
								echo "";
							}
						}
					?>
				</div>
			</div><!--.share-buttons--><?php
		}
	}
endif;
