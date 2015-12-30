<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Subscribe Widget
	Plugin URI: http://www.bloompixel.com
	Description: A widget that displays subscription box.
	Version: 1.0
	Author: Simrandeep Singh
	Author URI: http://www.simrandeep.com

-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'bpxl_subscription_widget' );  

// Register Widget
function bpxl_subscription_widget() {
    register_widget( 'bpxl_subscribe_widget' );
}

// Widget Class
class bpxl_subscribe_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of your widget
        'bpxl_subscribe_widget', 

        // Widget name will appear in UI
        __('(GoBlog) Subscribe Widget', 'bloompixel'), 

        // Widget description
        array( 'description' => __( 'A widget that displays the subscribe box', 'bloompixel' ), ) 
        );
    }
	
	public function widget( $args, $instance ) {
		extract( $args );
		
		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$id = $instance['id'];
		$desc = $instance['desc'];
		
		// Before Widget
		echo $before_widget;
		
		?>
		<!-- START WIDGET -->
		<div id="subscribe-widget">
			<?php		
				// Display the widget title  
				if ( $title )
					echo $before_title . $title . $after_title;
			?>
			<p><?php echo $desc; ?></p>
            <div id="mc_embed_signup" class="subscribe-widget">
                <form action="<?php echo $id; ?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" novalidate>
                    <div class="input-group">
                        <input type="email" value="" name="EMAIL" class=" email" id="mce-EMAIL" placeholder="Enter your email...">
                    </div>
                    <div class="input-group">
                        <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-primary">
                    </div>
                </form>
            </div>
            <div class="subscribe-result"></div>
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
		$instance['id'] = stripslashes( $new_instance['id']);
		$instance['desc'] = $new_instance['desc'];
		return $instance;
	}


	//Widget Settings
	public function form( $instance ) {
		//Set up some default widget settings.
		$defaults = array( 'title' => __('Subscribe', 'bloompixel'), 'id' => '', 'desc' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults );

		// Widget Title: Text Input
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title','bloompixel'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'id' ); ?>"><?php _e('MailChimp Form URL', 'bloompixel'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'id' ); ?>" name="<?php echo $this->get_field_name( 'id' ); ?>" value="<?php echo $instance['id']; ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e('Subscribe Text','bloompixel'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" value="<?php echo $instance['desc']; ?>" class="widefat" type="text" />
		</p>
		<?php
	}
}
?>