<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */


add_filter( 'rwmb_meta_boxes', 'bpxl_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */
function bpxl_register_meta_boxes( $meta_boxes )
{
	/**
	 * Prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	$prefix = 'bpxl_';
	
	// Standard meta box
	$meta_boxes[] = array(
		'id' => 'standardbox',
		'title' => __( 'Standard Post Options', 'bloompixel' ),
		'pages' => array( 'post', 'page' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			// CHECKBOX
			array(
				'name' => __( 'Hide Post Excerpt on Homepage', 'bloompixel' ),
				'id'   => "{$prefix}standard_excerpt_home",
				'type' => 'checkbox',
				'desc'  => __( 'Check this option to hide post excerpt on homepage.', 'bloompixel' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
			// CHECKBOX
			array(
				'name' => __( 'Hide Featured Image?', 'bloompixel' ),
				'id'   => "{$prefix}standard_single_hide",
				'type' => 'checkbox',
				'desc'  => __( 'Check this option to hide featured image on this post.', 'bloompixel' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
		),
	);
	
	// Image meta box
	$meta_boxes[] = array(
		'id' => 'imagebox',
		'title' => __( 'Image Post Options', 'bloompixel' ),
		'pages' => array( 'post', 'page' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			// CHECKBOX
			array(
				'name' => __( 'Hide Post Excerpt on Homepage', 'bloompixel' ),
				'id'   => "{$prefix}image_excerpt_home",
				'type' => 'checkbox',
				'desc'  => __( 'Check this option to hide post excerpt on homepage.', 'bloompixel' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
			// CHECKBOX
			array(
				'name' => __( 'Hide Featured Image?', 'bloompixel' ),
				'id'   => "{$prefix}image_single_hide",
				'type' => 'checkbox',
				'desc'  => __( 'Check this option to hide featured image on this post.', 'bloompixel' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
		),
	);
	
	// Audio meta box
	$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id' => 'audiobox',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Audio Post Options', 'bloompixel' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post', 'page' ),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			// SELECT BOX
			array(
				'name'     => __( 'Audio File Host', 'bloompixel' ),
				'desc' => __( 'Select host of your audio file. <br> <strong>Note:</strong> If you couldn\'t find host of your audio file in the dropdown list, you can paste the embed code of file in the "Audio Embed Code" box.', 'bloompixel' ),
				'id'       => "{$prefix}audiohost",
				'type'     => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => array(
					'soundcloud' => __( 'SoundCloud', 'bloompixel' ),
					'mixcloud' => __( 'MixCloud', 'bloompixel' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => '',
				'placeholder' => __( 'Select an Item', 'bloompixel' ),
			),
			// TEXT
			array(
				'name'  => __( 'Audio File URL (Soundcloud, Mixcloud etc) ', 'bloompixel' ),
				'id'    => "{$prefix}audiourl",
				'desc'  => __( 'Paste URL of your audio file here.', 'bloompixel' ),
				'type'  => 'text',
				'std'   => __( '', 'bloompixel' ),
				// CLONES: Add to make the field cloneable (i.e. have multiple value)
				'clone' => false,
			),
			// TEXTAREA
			array(
				'name' => __( 'Audio Embed Code', 'bloompixel' ),
				'desc' => __( 'Paste embed code of your audio file here.', 'bloompixel' ),
				'id'   => "{$prefix}audiocode",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
			),
			// CHECKBOX
			array(
				'name' => __( 'Hide Post Excerpt on Homepage', 'bloompixel' ),
				'id'   => "{$prefix}audio_excerpt_home",
				'type' => 'checkbox',
				'desc'  => __( 'Check this option to hide post excerpt on homepage.', 'bloompixel' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
			// CHECKBOX
			array(
				'name' => __( 'Hide Audio?', 'bloompixel' ),
				'id'   => "{$prefix}audio_single_hide",
				'type' => 'checkbox',
				'desc'  => __( 'Check this option to hide audio on this post.', 'bloompixel' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
		),
	);
	
	// Video meta box
	$meta_boxes[] = array(
		'id' => 'videobox',
		'title' => __( 'Video Post Options', 'bloompixel' ),
		'pages' => array( 'post', 'page' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			// SELECT BOX
			array(
				'name'     => __( 'Video File Host', 'bloompixel' ),
				'id'       => "{$prefix}videohost",
				'desc' => __( 'Select host of your video file. <br> <strong>Note:</strong> If you couldn\'t find host of your video file in the dropdown list, you can paste the embed code of file in the "Video Embed Code" box.', 'bloompixel' ),
				'type'     => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => array(
					'youtube' => __( 'YouTube', 'bloompixel' ),
					'vimeo' => __( 'Vimeo', 'bloompixel' ),
					'dailymotion' => __( 'Dailymotion', 'bloompixel' ),
					'metacafe' => __( 'Metacafe', 'bloompixel' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => '',
				'placeholder' => __( 'Select an Item', 'bloompixel' ),
			),
			// TEXT
			array(
				'name'  => __( 'Video ID ', 'bloompixel' ),
				'id'    => "{$prefix}videourl",
				'desc'  => __( 'Paste ID of your YouTube or Vimeo video here (For example: http://www.youtube.com/watch?v=<strong>dQw4w9WgXcQ</strong>).', 'bloompixel' ),
				'type'  => 'text',
				'std'   => __( '', 'bloompixel' ),
				// CLONES: Add to make the field cloneable (i.e. have multiple value)
				'clone' => false,
			),
			// TEXTAREA
			array(
				'name' => __( 'Video Embed Code (YouTube, Vimeo etc) ', 'bloompixel' ),
				'desc' => __( 'Paste your YouTube or Vimeo embed code here.', 'bloompixel' ),
				'id'   => "{$prefix}videocode",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
			),
			// CHECKBOX
			array(
				'name' => __( 'Hide Post Excerpt on Homepage', 'bloompixel' ),
				'id'   => "{$prefix}video_excerpt_home",
				'type' => 'checkbox',
				'desc'  => __( 'Check this option to hide post excerpt on homepage.', 'bloompixel' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
			// CHECKBOX
			array(
				'name' => __( 'Hide Video?', 'bloompixel' ),
				'id'   => "{$prefix}video_single_hide",
				'type' => 'checkbox',
				'desc'  => __( 'Check this option to hide featured video on this post.', 'bloompixel' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
		),
	);
	
	// Link Post meta box
	$meta_boxes[] = array(
		'id' => 'linkbox',
		'title' => __( 'Link Post Options', 'bloompixel' ),
		'pages' => array( 'post', 'page' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			// TEXT
			array(
				'name'  => __( 'URL', 'bloompixel' ),
				'id'    => "{$prefix}linkurl",
				'desc'  => __( 'Paste URL here.', 'bloompixel' ),
				'type'  => 'text',
				'std'   => __( '', 'bloompixel' ),
				'clone' => false,
			),
			// COLOR
			array(
				'name' => __( 'Link Background Color', 'bloompixel' ),
				'id'   => "{$prefix}link_background",
				'type' => 'color',
			),
			// CHECKBOX
			array(
				'name' => __( 'Hide Post Excerpt on Homepage', 'bloompixel' ),
				'id'   => "{$prefix}link_excerpt_home",
				'type' => 'checkbox',
				'desc'  => __( 'Check this option to hide post excerpt on homepage.', 'bloompixel' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
			// CHECKBOX
			array(
				'name' => __( 'Hide Link Box?', 'bloompixel' ),
				'id'   => "{$prefix}link_single_hide",
				'type' => 'checkbox',
				'desc'  => __( 'Check this option to hide link box on this post.', 'bloompixel' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
		),
	);
	
	// Gallery meta box
	$meta_boxes[] = array(
		'id' => 'gallerybox',
		'title' => __( 'Gallery Post Options', 'bloompixel' ),
		'pages' => array( 'post', 'page' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				'name'             => __( 'Upload Images for Gallery', 'bloompixel' ),
				'id'               => "{$prefix}galleryimg",
				'type'             => 'image_advanced',
				'max_file_uploads' => 40,
			),
			// SELECT BOX
			array(
				'name'     => __( 'Gallery Type', 'bloompixel' ),
				'id'       => "{$prefix}gallerytype",
				'desc' => __( 'Select the type of gallery you want to show.', 'bloompixel' ),
				'type'     => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => array(
					'slider' => __( 'Slider', 'bloompixel' ),
					'tiled' => __( 'Tiled', 'bloompixel' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => '',
				'placeholder' => __( 'Select an Item', 'bloompixel' ),
			),
			// CHECKBOX
			array(
				'name' => __( 'Hide Post Excerpt on Homepage', 'bloompixel' ),
				'id'   => "{$prefix}gallery_excerpt_home",
				'type' => 'checkbox',
				'desc'  => __( 'Check this option to hide post excerpt on homepage.', 'bloompixel' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
			// CHECKBOX
			array(
				'name' => __( 'Hide Gallery?', 'bloompixel' ),
				'id'   => "{$prefix}gallery_single_hide",
				'type' => 'checkbox',
				'desc'  => __( 'Check this option to hide gallery on this post.', 'bloompixel' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
		),
	);
	
	// Status Post Meta Box
	$meta_boxes[] = array(
		'id' => 'statusbox',
		'title' => __( 'Status Post Options', 'bloompixel' ),
		'pages' => array( 'post', 'page' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			// SELECT BOX
			array(
				'name'     => __( 'Status Type', 'bloompixel' ),
				'id'       => "{$prefix}statustype",
				'desc' => __( 'Select the type of status you want to publish.', 'bloompixel' ),
				'type'     => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => array(
					'twitter' => __( 'Twitter', 'bloompixel' ),
					'facebook' => __( 'Facebook', 'bloompixel' )
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => '',
				'placeholder' => __( 'Select an Item', 'bloompixel' ),
			),
			// TEXT
			array(
				'name'  => __( 'Status Link', 'bloompixel' ),
				'id'    => "{$prefix}statuslink",
				'desc'  => __( 'Paste source name of the quote here.', 'bloompixel' ),
				'type'  => 'text',
				'std'   => __( '', 'bloompixel' ),
				'clone' => false,
			),
			// CHECKBOX
			array(
				'name' => __( 'Hide Post Excerpt on Homepage', 'bloompixel' ),
				'id'   => "{$prefix}status_excerpt_home",
				'type' => 'checkbox',
				'desc'  => __( 'Check this option to hide post excerpt on homepage.', 'bloompixel' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
			// CHECKBOX
			array(
				'name' => __( 'Hide Status?', 'bloompixel' ),
				'id'   => "{$prefix}status_single_hide",
				'type' => 'checkbox',
				'desc'  => __( 'Check this option to hide status on this post.', 'bloompixel' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
		),
	);
	
	// Quote Post Meta Box
	$meta_boxes[] = array(
		'id' => 'quotebox',
		'title' => __( 'Quote Post Options', 'bloompixel' ),
		'pages' => array( 'post', 'page' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			// TEXT
			array(
				'name'  => __( 'Source Name', 'bloompixel' ),
				'id'    => "{$prefix}sourcename",
				'desc'  => __( 'Paste source name of the quote here.', 'bloompixel' ),
				'type'  => 'text',
				'std'   => __( '', 'bloompixel' ),
				'clone' => false,
			),
			// TEXT
			array(
				'name'  => __( 'Source URL', 'bloompixel' ),
				'id'    => "{$prefix}sourceurl",
				'desc'  => __( 'Paste source URL of quote here.', 'bloompixel' ),
				'type'  => 'text',
				'std'   => __( '', 'bloompixel' ),
				'clone' => false,
			),
			// COLOR
			array(
				'name' => __( 'Quote Background Color', 'bloompixel' ),
				'id'   => "{$prefix}quote_background_color",
				'type' => 'color',
			),
		),
	);
	
	$meta_boxes[] = array(
		'title' => __( 'Layout Options', 'bloompixel' ),
		'pages' => array( 'post', 'page' ),
		'fields' => array(
			array(
				'id'       => "{$prefix}layout",
				'name'     => __( 'Layout', 'bloompixel' ),
				'type'     => 'image_select',

				// Array of 'value' => 'Image Source' pairs
				'options'  => array(
					'default'  => get_template_directory_uri() . '/inc/meta-box/img/default.png',
					'left'  => get_template_directory_uri() . '/inc/meta-box/img/left.png',
					'right' => get_template_directory_uri() . '/inc/meta-box/img/right.png',
					'none'  => get_template_directory_uri() . '/inc/meta-box/img/none.png',
				),

				// Allow to select multiple values? Default is false
				// 'multiple' => true,
			),
			// CHECKBOX
			array(
				'name' => __( 'Hide Related Posts for this Post?', 'bloompixel' ),
				'id'   => "{$prefix}singlerelated",
				'desc'  => __( 'Check this option to hide related posts for this post.', 'bloompixel' ),
				'type' => 'checkbox',
				// Value can be 0 or 1
				'std'  => 0,
			),
		),
	);
	
	$meta_boxes[] = array(
		'title' => __( 'Page Options', 'bloompixel' ),
		'pages' => array( 'page' ),
		'context'  => 'side',
		'fields' => array(
			// CHECKBOX
			array(
				'name' => __( 'Hide Page Title', 'bloompixel' ),
				'id'   => "{$prefix}hide_page_title",
				'desc'  => __( 'Check this option to hide title of this page.', 'bloompixel' ),
				'type' => 'checkbox',
				// Value can be 0 or 1
				'std'  => 0,
			),
		),
	);

	return $meta_boxes;
}


