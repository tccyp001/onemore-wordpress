<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: 300 Ad Widget
	Plugin URI: http://www.bloompixel.com
	Description: A widget that displays 300x250px ad.
	Version: 1.0
	Author: Simrandeep Singh
	Author URI: http://www.simrandeep.com

-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'bp_300_ad_widget' );  

// Register Widget
function bp_300_ad_widget() {
    register_widget( 'bp_300_widget' );
}

// Widget Class
class bp_300_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of your widget
        'bp_300_widget', 

        // Widget name will appear in UI
        __('(GoBlog) 300x250 Ad Widget', 'bloompixel'), 

        // Widget description
        array( 'description' => __( 'A widget that displays 300x250 ad', 'bloompixel' ), ) 
        );
    }
	
	public function widget( $args, $instance ) {
		extract( $args );
		
		//Our variables from the widget settings.
		/* $title = apply_filters('widget_title', $instance['title'] ); */
		$social_target = (int) $instance['social_target'];
		$banner = $instance['banner'];
		$link = $instance['link'];
		$ad_code = $instance['ad_code'];
		
		?>
		<!-- START WIDGET -->
		<div class="ad-300-widget">
			<?php
				if ( $ad_code )
					echo '<div class="ad-block ad-block-300">' . do_shortcode($ad_code) . '</div>';
					
				elseif ( $link ) { ?>
					<a href="<?php echo esc_url( $link ); ?>" <?php if ( $social_target == 1 ) { echo 'target="_blank"'; } ?>><img src="<?php echo esc_url( $banner ); ?>" width="300" height="250" alt="" /></a>
					
				<?php } elseif ( $banner )
					echo '<img src="' . esc_url( $banner ) . '" width="300" height="250" alt="" />';
			?>
		</div>
		<!-- END WIDGET -->
		<?php
		
		// After Widget
		//echo $after_widget;
	}
	
	// Update the widget
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		/* $instance['title'] = strip_tags( $new_instance['title'] ); */
		$instance['social_target'] = intval( $new_instance['social_target'] );
		$instance['link'] = $new_instance['link'];
		$instance['banner'] = $new_instance['banner'];
		$instance['ad_code'] = $new_instance['ad_code'];
		return $instance;
	}


	//Widget Settings
	public function form( $instance ) {
		//Set up some default widget settings.
		$defaults = array(
			'social_target' => 1,
			'link' => 'http://bloompixel.com/',
			'banner' => get_template_directory_uri()."/images/300x250.png",
			'ad_code' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$social_target = isset( $instance[ 'social_target' ] ) ? esc_attr( $instance[ 'social_target' ] ) : 1;

		// Widget Title: Text Input
		?>
		<p>
			<label for="<?php echo $this->get_field_id("social_target"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("social_target"); ?>" name="<?php echo $this->get_field_name("social_target"); ?>" value="1" <?php if (isset($instance['social_target'])) { checked( 1, $instance['social_target'], true ); } ?> />
				<?php _e( 'Open Links in New Window', 'bloompixel'); ?>
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e('Ad Link URL:', 'bloompixel') ?></label>
			<input id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo esc_url($instance['link']); ?>" style="width:100%;" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'banner' ); ?>"><?php _e('Ad Banner URL:', 'bloompixel') ?></label>
			<input id="<?php echo $this->get_field_id( 'banner' ); ?>" name="<?php echo $this->get_field_name( 'banner' ); ?>" value="<?php echo esc_url($instance['banner']); ?>" style="width:100%;" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ad_code' ); ?>"><?php _e('Ad Code (Google Adsense):', 'bloompixel') ?></label>
			<textarea id="<?php echo $this->get_field_id( 'ad_code' ); ?>" name="<?php echo $this->get_field_name( 'ad_code' ); ?>" cols="20" rows="10" class="widefat"><?php echo esc_html($instance['ad_code']); ?></textarea>
		</p>
		<?php
	}
}
?>