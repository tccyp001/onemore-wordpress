<div class="sg-wp-editor-container">
<?php
	$content = @$sgPopupDataFblike;
	$editorId = 'sg_popup_fblike';
	$settings = array(
		'wpautop' => false,
		'tinymce' => array(
			'width' => '100%',
		),
		'textarea_rows' => '6',
		'media_buttons' => true
	);
	wp_editor($content, $editorId, $settings);
?>
</div>