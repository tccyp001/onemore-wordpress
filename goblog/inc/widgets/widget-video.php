<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Video Widget
	Plugin URI: http://www.bloompixel.com
	Description: A widget that displays video.
	Version: 1.0
	Author: Simrandeep Singh
	Author URI: http://www.simrandeep.com

-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'bpxl_videos_widget' );  

// Register Widget
function bpxl_videos_widget() {
    register_widget( 'bpxl_video_widget' );
}

// Widget Class
class bpxl_video_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of your widget
        'bpxl_video_widget', 

        // Widget name will appear in UI
        __('(GoBlog) Video Widget', 'bloompixel'), 

        // Widget description
        array( 'description' => __( 'A widget that displays the video', 'bloompixel' ), ) 
        );
    }
	
	public function widget( $args, $instance ) {
		extract( $args );
		
		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$id = $instance['id'];
		$width = $instance['width'];
		$height = $instance['height'];
		$host = $instance['host'];
		
		// Before Widget
		echo $before_widget;
		
		?>
		<!-- START WIDGET -->
		<div id="video-widget">
			<?php		
				// Display the widget title  
				if ( $title )
					echo $before_title . $title . $after_title;
			?>
			<?php $src = 'http://www.youtube-nocookie.com/embed/'.$id; ?>
			<?php 
				if($id) :
					if ( $host == "youtube" ) { 
						$src = 'http://www.youtube-nocookie.com/embed/'.$id;
					}
					if ( $host == "vimeo" ) { 
						$src = 'http://player.vimeo.com/video/'.$id;;
					}
					if ( $host == "dailymotion" ) { 
						$src = 'http://www.dailymotion.com/embed/video/'.$id;
					}
					if ( $host == "metacafe" ) { 
						$src = 'http://www.metacafe.com/embed/11333715/'.$id;
					}
					if ( $host == "veoh" ) { 
						$src = 'http://www.veoh.com/static/swf/veoh/SPL.swf?videoAutoPlay=0&permalinkId='.$id;;
					}
					if ( $host == "bliptv" ) { 
						$src = 'http://a.blip.tv/scripts/shoggplayer.html#file=http://blip.tv/rss/flash/'.$id;;
					}
					if ( $id != '' ) {
						echo '<iframe width="'. $width .'" height="'. $height .'" src="'. $src .'" class="vid iframe-'. $host .'"></iframe>';
					}
				endif;
			?>
		</div>
		<!-- END WIDGET -->
		<?php
		
		// After Widget
		echo $after_widget;
	}
	
	// Update the widget
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['width'] = stripslashes( $new_instance['width']);
		$instance['height'] = stripslashes( $new_instance['height']);
		$instance['id'] = stripslashes( $new_instance['id']);
		$instance['host'] = strip_tags( $new_instance['host'] );
		return $instance;
	}


	//Widget Settings
	public function form( $instance ) {
		//Set up some default widget settings.
		$defaults = array(
			'title' => __('Latest Video', 'bloompixel'),
			'width' => '325',
			'height' => '195',
			'id' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$host = isset( $instance['host'] ) ? esc_attr( $instance['host'] ) : '';

		// Widget Title: Text Input
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:','bloompixel'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e('Width:','bloompixel'); ?></label>
			<input id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php echo $instance['width']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e('Height:','bloompixel'); ?></label>
			<input id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo $instance['height']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'id' ); ?>"><?php _e('Video ID:','bloompixel'); ?></label>
			<input id="<?php echo $this->get_field_id( 'id' ); ?>" name="<?php echo $this->get_field_name( 'id' ); ?>" value="<?php echo $instance['id']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'host' ); ?>"><?php _e( 'Video Host:','bloompixel' ); ?></label> 
			<select id="<?php echo $this->get_field_id( 'host' ); ?>" name="<?php echo $this->get_field_name( 'host' ); ?>" style="width:100%;" >
				<option value="youtube" <?php if ($host == 'youtube') echo 'selected="selected"'; ?>><?php _e( 'YouTube','bloompixel' ); ?></option>
				<option value="vimeo" <?php if ($host == 'vimeo') echo 'selected="selected"'; ?>><?php _e( 'Vimeo','bloompixel' ); ?></option>
				<option value="dailymotion" <?php if ($host == 'dailymotion') echo 'selected="selected"'; ?>><?php _e( 'Dailymotion','bloompixel' ); ?></option>
				<option value="metacafe" <?php if ($host == 'metacafe') echo 'selected="selected"'; ?>><?php _e( 'Metacafe','bloompixel' ); ?></option>
				<option value="veoh" <?php if ($host == 'veoh') echo 'selected="selected"'; ?>><?php _e( 'Veoh','bloompixel' ); ?></option>
				<option value="bliptv" <?php if ($host == 'bliptv') echo 'selected="selected"'; ?>><?php _e( 'Blip.tv','bloompixel' ); ?></option>
			</select>
		</p>
		<?php
	}
}
?>