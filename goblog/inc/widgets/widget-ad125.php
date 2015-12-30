<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: 125 Ad Widget
	Plugin URI: http://www.bloompixel.com
	Description: A widget that displays 125x125px ad.
	Version: 1.0
	Author: Simrandeep Singh
	Author URI: http://www.simrandeep.com

-----------------------------------------------------------------------------------*/

// Widget Class
class bp_125_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of your widget
        'bp_125_widget', 

        // Widget name will appear in UI
        __('(GoBlog) 125x125 Ad Widget', 'bloompixel'), 

        // Widget description
        array( 'description' => __( 'A widget that displays 125x125 ad', 'bloompixel' ), ) 
        );
    }
	
    // Creating widget front-end
    // This is where the action happens
	public function widget( $args, $instance ) {
		
		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$social_target = (int) $instance['social_target'];
		$banner1 = $instance['banner1'];
		$banner2 = $instance['banner2'];
		$banner3 = $instance['banner3'];
		$banner4 = $instance['banner4'];
		$link1 = $instance['link1'];
		$link2 = $instance['link2'];
		$link3 = $instance['link3'];
		$link4 = $instance['link4'];
		
		// Before Widget
		echo $args['before_widget'];
		
		// Display the widget title  
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
		?>
		<!-- START WIDGET -->
		<div class="widget ad-125-widget">
			<ul>
			<?php
				// Ad1
				if ( $link1 ) { ?>
					<li class="adleft"><a href="<?php echo esc_url( $link1 ); ?>" <?php if ( $social_target == 1 ) { echo 'target="_blank"'; } ?>><img src="<?php echo esc_url( $banner1 ); ?>" width="125" height="125" alt="" /></a></li>
					
				<?php } elseif ( $banner1 )
					echo '<li class="adleft"><img src="' . esc_url( $banner1 ) . '" width="125" height="125" alt="" /></li>';
					
				// Ad2
				if ( $link2 ) { ?>
					<li class="adleft"><a href="<?php echo esc_url( $link2 ); ?>" <?php if ( $social_target == 1 ) { echo 'target="_blank"'; } ?>><img src="<?php echo esc_url( $banner2 ); ?>" width="125" height="125" alt="" /></a></li>
					
				<?php } elseif ( $banner2 )
					echo '<li class="adright"><img src="' . esc_url( $banner2 ) . '" width="125" height="125" alt="" /></li>';
					
				// Ad3
				if ( $link3 ) { ?>
					<li class="adleft"><a href="<?php echo esc_url( $link3 ); ?>" <?php if ( $social_target == 1 ) { echo 'target="_blank"'; } ?>><img src="<?php echo esc_url( $banner3 ); ?>" width="125" height="125" alt="" /></a></li>
					
				<?php } elseif ( $banner3 )
					echo '<li class="adleft"><img src="' . esc_url( $banner3 ) . '" width="125" height="125" alt="" /></li>';
					
				// Ad4
				if ( $link4 ) { ?>
					<li class="adleft"><a href="<?php echo esc_url( $link4 ); ?>" <?php if ( $social_target == 1 ) { echo 'target="_blank"'; } ?>><img src="<?php echo esc_url( $banner4 ); ?>" width="125" height="125" alt="" /></a></li>
					
				<?php } elseif ( $banner4 )
					echo '<li class="adright"><img src="' . esc_url( $banner4 ) . '" width="125" height="125" alt="" /></li>';
			?>
			</ul>
		</div>
		<!-- END WIDGET -->
		<?php
		
		// After Widget
		echo $args['after_widget'];
	}
	
	// Update the widget
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['social_target'] = intval( $new_instance['social_target'] );
		$instance['link1'] = $new_instance['link1'];
		$instance['link2'] = $new_instance['link2'];
		$instance['link3'] = $new_instance['link3'];
		$instance['link4'] = $new_instance['link4'];
		$instance['banner1'] = $new_instance['banner1'];
		$instance['banner2'] = $new_instance['banner2'];
		$instance['banner3'] = $new_instance['banner3'];
		$instance['banner4'] = $new_instance['banner4'];
		return $instance;
	}


	//Widget Settings
	public function form( $instance ) {
		//Set up some default widget settings.
		$defaults = array( 
			'title' => '',
			'social_target' => 1,
			'link1' => 'http://bloompixel.com/',
			'banner1' => get_template_directory_uri()."/images/125x125.png",
			'link2' => 'http://bloompixel.com/',
			'banner2' => get_template_directory_uri()."/images/125x125.png",
			'link3' => 'http://bloompixel.com/',
			'banner3' => get_template_directory_uri()."/images/125x125.png",
			'link4' => 'http://bloompixel.com/',
			'banner4' => get_template_directory_uri()."/images/125x125.png",
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$social_target = isset( $instance[ 'social_target' ] ) ? esc_attr( $instance[ 'social_target' ] ) : 1;

		// Widget Title: Text Input
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'bloompixel'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if(!empty($instance['title'])) { echo $instance['title']; } ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id("social_target"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("social_target"); ?>" name="<?php echo $this->get_field_name("social_target"); ?>" value="1" <?php if (isset($instance['social_target'])) { checked( 1, $instance['social_target'], true ); } ?> />
				<?php _e( 'Open Links in New Window', 'bloompixel'); ?>
			</label>
		</p>

		<!-- Ad1 Link URL -->
		<p>
			<label for="<?php echo $this->get_field_id( 'link1' ); ?>"><?php _e('Ad1 Link URL:', 'bloompixel') ?></label>
			<input id="<?php echo $this->get_field_id( 'link1' ); ?>" name="<?php echo $this->get_field_name( 'link1' ); ?>" value="<?php echo esc_url( $instance['link1'] ); ?>" style="width:100%;" type="text" />
		</p>
		<!-- Ad1 Banner URL -->
		<p>
			<label for="<?php echo $this->get_field_id( 'banner1' ); ?>"><?php _e('Ad1 Banner URL:', 'bloompixel') ?></label>
			<input id="<?php echo $this->get_field_id( 'banner1' ); ?>" name="<?php echo $this->get_field_name( 'banner1' ); ?>" value="<?php echo esc_url( $instance['banner1'] ); ?>" style="width:100%;" type="text" />
		</p>
		
		<!-- Ad2 Link URL -->
		<p>
			<label for="<?php echo $this->get_field_id( 'link2' ); ?>"><?php _e('Ad2 Link URL:', 'bloompixel') ?></label>
			<input id="<?php echo $this->get_field_id( 'link2' ); ?>" name="<?php echo $this->get_field_name( 'link2' ); ?>" value="<?php echo esc_url( $instance['link2'] ); ?>" style="width:100%;" type="text" />
		</p>
		<!-- Ad2 Banner URL -->
		<p>
			<label for="<?php echo $this->get_field_id( 'banner2' ); ?>"><?php _e('Ad2 Banner URL:', 'bloompixel') ?></label>
			<input id="<?php echo $this->get_field_id( 'banner2' ); ?>" name="<?php echo $this->get_field_name( 'banner2' ); ?>" value="<?php echo esc_url( $instance['banner2'] ); ?>" style="width:100%;" type="text" />
		</p>
		
		<!-- Ad3 Link URL -->
		<p>
			<label for="<?php echo $this->get_field_id( 'link3' ); ?>"><?php _e('Ad3 Link URL:', 'bloompixel') ?></label>
			<input id="<?php echo $this->get_field_id( 'link3' ); ?>" name="<?php echo $this->get_field_name( 'link3' ); ?>" value="<?php echo esc_url( $instance['link3'] ); ?>" style="width:100%;" type="text" />
		</p>
		<!-- Ad3 Banner URL -->
		<p>
			<label for="<?php echo $this->get_field_id( 'banner3' ); ?>"><?php _e('Ad3 Banner URL:', 'bloompixel') ?></label>
			<input id="<?php echo $this->get_field_id( 'banner3' ); ?>" name="<?php echo $this->get_field_name( 'banner3' ); ?>" value="<?php echo esc_url( $instance['banner3'] ); ?>" style="width:100%;" type="text" />
		</p>
		
		<!-- Ad4 Link URL -->
		<p>
			<label for="<?php echo $this->get_field_id( 'link4' ); ?>"><?php _e('Ad4 Link URL:', 'bloompixel') ?></label>
			<input id="<?php echo $this->get_field_id( 'link4' ); ?>" name="<?php echo $this->get_field_name( 'link4' ); ?>" value="<?php echo esc_url( $instance['link4'] ); ?>" style="width:100%;" type="text" />
		</p>
		<!-- Ad4 Banner URL -->
		<p>
			<label for="<?php echo $this->get_field_id( 'banner4' ); ?>"><?php _e('Ad4 Banner URL:', 'bloompixel') ?></label>
			<input id="<?php echo $this->get_field_id( 'banner4' ); ?>" name="<?php echo $this->get_field_name( 'banner4' ); ?>" value="<?php echo esc_url( $instance['banner4'] ); ?>" style="width:100%;" type="text" />
		</p>
		<?php
	}
}

// Register Widget
function bp_125_ad_widget() {
    register_widget( 'bp_125_widget' );
}
add_action( 'widgets_init', 'bp_125_ad_widget' );
?>