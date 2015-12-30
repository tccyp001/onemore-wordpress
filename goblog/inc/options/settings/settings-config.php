<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('Redux_Framework_sample_config')) {

    class Redux_Framework_sample_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);
            
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            
            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.

         * */
        function compiler_action($options, $css, $changed_values) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r($changed_values); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             */
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'bloompixel'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'bloompixel'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'bloompixel'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'bloompixel'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'bloompixel'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'bloompixel') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'bloompixel'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                Redux_Functions::initWpFilesystem();
                
                global $wp_filesystem;

                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }

            // ACTUAL DECLARATION OF SECTIONS
            $this->sections[] = array(
				'icon' => 'el-icon-cogs',
				'icon_class' => 'icon-large',
				'title' => __('General Settings', 'bloompixel'),
				'fields' => array(
					array(
						'id'=>'bpxl_logo',
						'type' => 'media', 
						'url'=> true,
						'title' => __('Regular Logo', 'bloompixel'),
						'subtitle' => __('Upload a regular logo for your site.', 'bloompixel'),
						),	
					array(
						'id'=>'bpxl_retina_logo',
						'type' => 'media', 
						'url'=> true,
						'title' => __('Retina Logo', 'bloompixel'),
						'subtitle' => __('Upload a retina logo for your site.', 'bloompixel'),
						),
					array(
						'id'=>'bpxl_favicon',
						'type' => 'media', 
						'url'=> true,
						'title' => __('Custom Favicon', 'bloompixel'),
						'subtitle' => __('Upload a custom favicon for your site.', 'bloompixel'),
						),	
					array(
						'id'=>'bpxl_pagination_type',
						'type' => 'button_set',
						'title' => __('Pagination Type', 'bloompixel'), 
						'subtitle' => __('Select the type of pagination for your site. Choose between Wide and Boxed.', 'bloompixel'),
						'options' => array('1' => 'Numbered','2' => 'Next/Prev'),//Must provide key => value pairs for radio options
						'default' => '1'
						),
					array(
						'id'=>'bpxl_responsive_layout',
						'type' => 'switch', 
						'title' => __('Enable Responsive Layout?', 'bloompixel'),
						'subtitle'=> __('This theme can adopt to different screen resolutions automatically when rsponsive layout is enabled. You can enable or disable the responsive layout.', 'bloompixel'),
						"default" 		=> 1,
						'on' => 'Enabled',
						'off' => 'Disabled',
						),	
					array(
						'id'=>'bpxl_scroll_btn',
						'type' => 'switch', 
						'title' => __('Scroll to Top Button', 'bloompixel'),
						'subtitle'=> __('Choose this option to show or hide scroll to top button.', 'bloompixel'),
						"default" 		=> 1,
						'on' => 'Show',
						'off' => 'Hide',
						),	
                    array(
                        'id'=>'bpxl_rtl',
                        'type' => 'switch', 
                        'title' => __('RTL (Right-to-Left) Language', 'bloompixel'), 
                        'subtitle' => __('Choose this option if your blog\'s language is rtl.', 'bloompixel'),
                        "default"       => 0,
                        'on' => 'Yes',
                        'off' => 'No',
                        ),
                    array(
                        'id'=>'bpxl_fb_og',
                        'type' => 'switch', 
                        'title' => __('Facebook Open Graph Tags', 'bloompixel'), 
                        'subtitle' => __('Choose this option if you want to enable Facebook Open Graph tags.', 'bloompixel'),
                        "default"       => 0,
                        'on' => 'Yes',
                        'off' => 'No',
                        ),
                    array(
                        'id'=>'bpxl_img_hover',
                        'type' => 'switch', 
                        'title' => __('Image Hover Effect', 'bloompixel'), 
                        'subtitle' => __('You can enable or disable the hover effect (Plus or Zoom icon) for images.', 'bloompixel'),
                        "default"       => 1,
                        'on' => 'Enable',
                        'off' => 'Disable',
                        ),
                    array(
                        'id'=>'bpxl_lightbox',
                        'type' => 'switch', 
                        'title' => __('Lightbox', 'bloompixel'), 
                        'subtitle' => __('You can enable this option if you want to enable lightbox effect for gallery images.', 'bloompixel'),
                        "default"       => 1,
                        'on' => 'Enable',
                        'off' => 'Disable',
                        ),
					array(
						'id'=>'bpxl_header_code',
						'type' => 'textarea',
						'title' => __('Header Code', 'bloompixel'), 
						'subtitle' => __('Paste any code here that you want to add into the header section.', 'bloompixel'),
						),	
					array(
						'id'=>'bpxl_footer_code',
						'type' => 'textarea',
						'title' => __('Footer Code', 'bloompixel'), 
						'subtitle' => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer section of your theme.', 'bloompixel'),
						)
				)
            );
			
            $this->sections[] = array(
				'icon' => 'el-icon-website',
				'icon_class' => 'icon-large',
				'title' => __('Layout Settings', 'bloompixel'),
				'fields' => array(
					array(
						'id'=>'bpxl_layout_type',
						'type' => 'button_set',
						'title' => __('Layout Type', 'bloompixel'), 
						'subtitle' => __('Select the main layout for your site. Choose between Wide and Boxed.', 'bloompixel'),
						'options' => array('1' => 'Full Width','2' => 'Boxed'),//Must provide key => value pairs for radio options
						'default' => '1'
						),
					array(
						'id'=>'bpxl_layout',
						'type' => 'image_select',
						'compiler'=>true,
						'title' => __('Main Layout', 'bloompixel'), 
						'subtitle' => __('Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout. <br><br><strong>Note:</strong> These layouts are applied to homepage and search results.', 'bloompixel'),
						'options' => array(
								'cblayout' => array('alt' => '2 Column', 'img' => get_template_directory_uri() .'/inc/options/settings/img/layouts/cb.png'),
								'bclayout' => array('alt' => '2 Column', 'img' => get_template_directory_uri() .'/inc/options/settings/img/layouts/bc.png'),
								'scblayout' => array('alt' => '3 Column', 'img' => get_template_directory_uri() .'/inc/options/settings/img/layouts/scb.png'),
								'clayout' => array('alt' => '3 Column Grid', 'img' => get_template_directory_uri() .'/inc/options/settings/img/layouts/c.png'),
								'gslayout' => array('alt' => '2 Column Grid', 'img' => get_template_directory_uri() .'/inc/options/settings/img/layouts/gs.png'),
								'sglayout' => array('alt' => '2 Column Grid', 'img' => get_template_directory_uri() .'/inc/options/settings/img/layouts/sg.png'),
								'glayout' => array('alt' => '2 Column Grid', 'img' => get_template_directory_uri() .'/inc/options/settings/img/layouts/g.png'),
								'thumbright' => array('alt' => 'Right Thumbnail Right Sidebar', 'img' => get_template_directory_uri() .'/inc/options/settings/img/layouts/tr.png'),
								'thumbleft' => array('alt' => 'Right Thumbnail Left Sidebar', 'img' => get_template_directory_uri() .'/inc/options/settings/img/layouts/tl.png'),
							),
						'default' => 'cblayout'
						),
					array(
						'id'=>'bpxl_archive_layout',
						'type' => 'image_select',
						'compiler'=>true,
						'title' => __('Archives Layout', 'bloompixel'), 
						'subtitle' => __('Select layout style for archives. Choose between 1, 2 or 3 column layout. <br><br><strong>Note:</strong> These layouts are applied to archives (Category, tags etc).', 'bloompixel'),
						'options' => array(
                                'cblayout' => array('alt' => '2 Column', 'img' => get_template_directory_uri() .'/inc/options/settings/img/layouts/cb.png'),
                                'bclayout' => array('alt' => '2 Column', 'img' => get_template_directory_uri() .'/inc/options/settings/img/layouts/bc.png'),
                                'scblayout' => array('alt' => '3 Column', 'img' => get_template_directory_uri() .'/inc/options/settings/img/layouts/scb.png'),
                                'clayout' => array('alt' => '3 Column Grid', 'img' => get_template_directory_uri() .'/inc/options/settings/img/layouts/c.png'),
                                'gslayout' => array('alt' => '2 Column Grid', 'img' => get_template_directory_uri() .'/inc/options/settings/img/layouts/gs.png'),
                                'sglayout' => array('alt' => '2 Column Grid', 'img' => get_template_directory_uri() .'/inc/options/settings/img/layouts/sg.png'),
                                'glayout' => array('alt' => '2 Column Grid', 'img' => get_template_directory_uri() .'/inc/options/settings/img/layouts/g.png'),
								'thumbright' => array('alt' => 'Right Thumbnail Right Sidebar', 'img' => get_template_directory_uri() .'/inc/options/settings/img/layouts/tr.png'),
								'thumbleft' => array('alt' => 'Right Thumbnail Left Sidebar', 'img' => get_template_directory_uri() .'/inc/options/settings/img/layouts/tl.png'),
							),
						'default' => 'cblayout'
						),
					array(
						'id'=>'bpxl_single_layout',
						'type' => 'image_select',
						'compiler'=>true,
						'title' => __('Single Layout', 'bloompixel'), 
						'subtitle' => __('Select layout style for single pages. Choose between 1, 2 or 3 column layout. <br><br><strong>Note:</strong> These layouts are applied to single posts and pages.', 'bloompixel'),
						'options' => array(
								'cblayout' => array('alt' => '2 Column', 'img' => get_template_directory_uri() .'/inc/options/settings/img/layouts/cb.png'),
								'bclayout' => array('alt' => '2 Column', 'img' => get_template_directory_uri() .'/inc/options/settings/img/layouts/bc.png'),
								'scblayout' => array('alt' => '3 Column', 'img' => get_template_directory_uri() .'/inc/options/settings/img/layouts/scb.png'),
							),
						'default' => 'cblayout'
						),
				)
            );
			
            $this->sections[] = array(
				'icon' => 'el-icon-brush',
				'title' => __('Styling Options', 'bloompixel'),
				'fields' => array(
					array(
						'id'=>'bpxl_color_one',
						'type' => 'color',
						'title' => __('Primary Color', 'bloompixel'), 
						'subtitle' => __('Pick primary color scheme for the theme.', 'bloompixel'),
						'default' => '#ff8800',
						'validate' => 'color',
						'transparent' => false,
						),
					array(
						'id'=>'bpxl_nav_break',
						'type' => 'info',
						'desc' => __('Navigation Menu', 'bloompixel')
						),
					array(
						'id'=>'bpxl_nav_link_color',
						'type' => 'link_color',
						'title' => __('Navigation Link Color', 'bloompixel'), 
						'subtitle' => __('Pick a link color for the navigation.', 'bloompixel'),
						'default'  => array(
							'regular'  => '#8B8B8B', // 8B8B8B
							'hover'    => '#FFFFFF', // White
						),
						'validate' => 'color',
						'transparent' => false,
						'active' => false,
						),
					array(
						'id'=>'bpxl_nav_drop_bg_color',
						'type' => 'color',
						'title' => __('Navigation Dropdown Background Color', 'bloompixel'), 
						'subtitle' => __('Pick a dropdown background color for the navigation.', 'bloompixel'),
						'default' => '#353535',
						'validate' => 'color',
						'transparent' => false,
						),
					array(
						'id'=>'bpxl_nav_drop_link_color',
						'type' => 'link_color',
						'title' => __('Navigation Dropdown Link Color', 'bloompixel'), 
						'subtitle' => __('Pick a link color for the navigation.', 'bloompixel'),
						'default'  => array(
							'regular'  => '#FFFFFF', // 8B8B8B
							'hover'    => '#FFFFFF', // White
						),
						'validate' => 'color',
						'transparent' => false,
						'active' => false,
						),
					array(
						'id'=>'bpxl_nav_button_color',
						'type' => 'color',
						'title' => __('Mobile Navigation Button Color', 'bloompixel'), 
						'subtitle' => __('Pick a color for buttons that appears on mobile navigation.', 'bloompixel'),
						'default' => '#ffffff',
						'validate' => 'color',
                        'output'         => array('.menu-btn'),
						'transparent' => false,
						),
                    array(
                        'id'             => 'bpxl_nav_margin',
                        'type'           => 'spacing',
                        'output'         => array('.main-nav'),
                        'mode'           => 'margin',
                        'units'          => array('px'),
                        'units_extended' => 'false',
                        'left' => 'false',
                        'right' => 'false',
                        'title'          => __('Navigation Menu Margin', 'bloompixel'),
                        'subtitle'       => __('Change top and bottom margin of main navigation menu.', 'bloompixel'),
                        'default'            => array(
                            'margin-top'     => '0px',
                            'margin-bottom'  => '0px',
                            'units'          => 'px',
                            )
                        ),
					array(
						'id'=>'bpxl_nav_break',
						'type' => 'info',
						'desc' => __('Header', 'bloompixel')
						),
					array( 
						'id'=>'bpxl_header_bg_color',
						'type'     => 'background',
						'output' => array('.main-header'),
						'title' => __('Header Background Color', 'bloompixel'), 
						'subtitle' => __('Pick a background color for header of the theme.', 'bloompixel'),
						'preview_media' => true,
						'preview' => false,
						'default' => array(
								'background-color'  => '#000000', 
							),
						),
					array(
						'id'=>'bpxl_header_slider_color',
						'type' => 'color',
						'output' => array('.header-slider, .header-slider li h3'),
						'title' => __('Header Slider Text Color', 'bloompixel'), 
						'subtitle' => __('Pick a color for heading and description of header slider.', 'bloompixel'),
						'default' => '#ffffff',
						'validate' => 'color',
						'transparent' => false,
						),
					array(
						'id'             => 'bpxl_header_spacing',
						'type'           => 'spacing',
						'output'         => array('.main-header .header'),
						'mode'           => 'padding',
						'units'          => array('px'),
						'units_extended' => 'false',
						'left' => 'false',
						'right' => 'false',
						'title'          => __('Header Padding', 'bloompixel'),
						'subtitle'       => __('Change top and bottom padding of header.', 'bloompixel'),
						'default'            => array(
							'padding-top'     => '20px',
							'padding-bottom'  => '20px',
							'units'          => 'px',
							)
						),
					array(
						'id'             => 'bpxl_logo_margin',
						'type'           => 'spacing',
						'output'         => array('.header #logo'),
						'mode'           => 'margin',
						'units'          => array('px'),
						'units_extended' => 'false',
						'left' => 'false',
						'right' => 'false',
						'title'          => __('Logo Margin', 'bloompixel'),
						'subtitle'       => __('Change top and bottom margin of logo.', 'bloompixel'),
						'default'            => array(
							'margin-top'     => '0px',
							'margin-bottom'  => '0px',
							'units'          => 'px',
							)
						),
					array(
						'id'=>'bpxl_nav_break',
						'type' => 'info',
						'desc' => __('Body', 'bloompixel')
						),
					array(
						'id'=>'bpxl_body_text_color',
						'type' => 'color',
						'title' => __('Body Text Color', 'bloompixel'), 
						'subtitle' => __('Pick a color for body text.', 'bloompixel'),
						'output'   => array('body'),
						'default' => '#555555',
						'validate' => 'color',
						'transparent' => false,
						),
					array( 
						'id'       => 'bpxl_body_bg',
						'type'     => 'background',
						'title'    => __('Body Background', 'bloompixel'),
						'subtitle' => __('Background options for body.', 'bloompixel'),
						'preview_media' => true,
						'preview' => false,
						'default' => array(
								'background-color'  => '#eeeded', 
							),
						),
					array(
						'id'=>'bpxl_bg_pattern',
						'type' => 'image_select',
						'title' => __('Background Pattern', 'bloompixel'), 
						'subtitle' => __('Choose a background pattern for the theme.', 'bloompixel'),
						'options' => array(
										'nopattern' => array('alt' => 'nopattern', 'img' => get_template_directory_uri() .'/inc/options/settings/img/patterns/nopattern.png'),
										'pattern0' => array('alt' => 'pattern0', 'img' => get_template_directory_uri() .'/inc/options/settings/img/patterns/pattern0.png'),
										'pattern1' => array('alt' => 'pattern1', 'img' => get_template_directory_uri() .'/inc/options/settings/img/patterns/pattern1.png'),
										'pattern2' => array('alt' => 'pattern2', 'img' => get_template_directory_uri() .'/inc/options/settings/img/patterns/pattern2.png'),
										'pattern3' => array('alt' => 'pattern3', 'img' => get_template_directory_uri() .'/inc/options/settings/img/patterns/pattern3.png'),
										'pattern4' => array('alt' => 'pattern4', 'img' => get_template_directory_uri() .'/inc/options/settings/img/patterns/pattern4.png'),
										'pattern5' => array('alt' => 'pattern5', 'img' => get_template_directory_uri() .'/inc/options/settings/img/patterns/pattern5.png'),
										'pattern6' => array('alt' => 'pattern6', 'img' => get_template_directory_uri() .'/inc/options/settings/img/patterns/pattern6.png'),
										'pattern7' => array('alt' => 'pattern7', 'img' => get_template_directory_uri() .'/inc/options/settings/img/patterns/pattern7.png'),
										'pattern8' => array('alt' => 'pattern8', 'img' => get_template_directory_uri() .'/inc/options/settings/img/patterns/pattern8.png'),
										'pattern9' => array('alt' => 'pattern9', 'img' => get_template_directory_uri() .'/inc/options/settings/img/patterns/pattern9.png'),
										'pattern10' => array('alt' => 'pattern10', 'img' => get_template_directory_uri() .'/inc/options/settings/img/patterns/pattern10.png'),
										'pattern11' => array('alt' => 'pattern11', 'img' => get_template_directory_uri() .'/inc/options/settings/img/patterns/pattern11.png'),
										'pattern12' => array('alt' => 'pattern12', 'img' => get_template_directory_uri() .'/inc/options/settings/img/patterns/pattern12.png'),
										'pattern13' => array('alt' => 'pattern13', 'img' => get_template_directory_uri() .'/inc/options/settings/img/patterns/pattern13.png'),
										'pattern14' => array('alt' => 'pattern14', 'img' => get_template_directory_uri() .'/inc/options/settings/img/patterns/pattern14.png'),
										'pattern15' => array('alt' => 'pattern15', 'img' => get_template_directory_uri() .'/inc/options/settings/img/patterns/pattern15.png'),
										'pattern16' => array('alt' => 'pattern16', 'img' => get_template_directory_uri() .'/inc/options/settings/img/patterns/pattern16.png'),
										'pattern17' => array('alt' => 'pattern17', 'img' => get_template_directory_uri() .'/inc/options/settings/img/patterns/pattern17.png'),
										'pattern18' => array('alt' => 'pattern18', 'img' => get_template_directory_uri() .'/inc/options/settings/img/patterns/pattern18.png')
											),//Must provide key => value(array:title|img) pairs for radio options
						'default' => 'nopattern'
						),
					array(
						'id'=>'bpxl_nav_break',
						'type' => 'info',
						'desc' => __('Posts Box', 'bloompixel')
						),
					array( 
						'id'=>'bpxl_post_box_bg',
						'type'     => 'background',
						'output' => array('.post-box, .breadcrumbs, .author-box, .author-desc-box, .post-navigation .post-nav-links, .relatedPosts, #comments, #respond, .pagination, .norm-pagination, #disqus_thread'),
						'title' => __('Post Box Background', 'bloompixel'), 
						'subtitle' => __('Pick a background color for post box of the theme.', 'bloompixel'),
						'preview_media' => true,
						'preview' => false,
						'default' => array(
								'background-color'  => '#FFFFFF', 
							),
						),
					array(
						'id'       => 'bpxl_post_box_outer_border',
						'type'     => 'border',
						'title'    => __('Post Box Border', 'bloompixel'),
						'subtitle' => __('Apply the border to post boxes', 'bloompixel'),
						'output'   => array('.post-box, .breadcrumbs, .author-box, .author-desc-box, .relatedPosts, #respond, .pagination, .norm-pagination, #disqus_thread'),
						'default'  => array(
								'border-color'  => '#e3e3e3', 
								'border-style'  => 'solid', 
								'border-top'    => '1px', 
								'border-right'  => '1px', 
								'border-bottom' => '1px', 
								'border-left'   => '1px'
							),
						),
					array(
						'id'       => 'bpxl_post_box_color',
						'type'     => 'color',
						'title'    => __('Posts Main Text Color', 'bloompixel'), 
						'subtitle' => __('Pick a color for main text of post boxes.', 'bloompixel'),
						'output'   => array('.post-box, .breadcrumbs, .author-box, .author-desc-box, .relatedPosts, #comments, #respond, .pagination, .norm-pagination'),
						'default'  => '#555555',
						'validate' => 'color',
						'transparent' => false,
						),
					array(
						'id'       => 'bpxl_post_box_meta_color',
						'type'     => 'color',
						'title'    => __('Posts Meta Color', 'bloompixel'), 
						'subtitle' => __('Pick a color for meta of post boxes.', 'bloompixel'),
						'output'   => array('.post-author, .post-meta, .post-meta a, .breadcrumbs a'),
						'default'  => '#777777',
						'validate' => 'color',
						'transparent' => false,
						),
					array(
						'id'       => 'bpxl_post_box_title_color',
						'type'     => 'color',
						'title'    => __('Posts Title Color', 'bloompixel'), 
						'subtitle' => __('Pick a color for title of post boxes.', 'bloompixel'),
						'output'   => array('.title, .title a, .post header .post-date, .section-heading, .author-box h5, #comments .fn'),
						'default'  => '#000000',
						'validate' => 'color',
						'transparent' => false,
						),
					array(
						'id'=>'bpxl_nav_break',
						'type' => 'info',
						'desc' => __('Sidebar Widgets', 'bloompixel')
						),
					array( 
						'id'=>'bpxl_sidebar_widget_bg',
						'type'     => 'background',
						'output' => array('.sidebar-widget, #tabs-widget, #tabs li.active a'),
						'title' => __('Sidebar Widgets Background', 'bloompixel'), 
						'subtitle' => __('Pick a background color for sidebar widgets.', 'bloompixel'),
						'preview_media' => true,
						'preview' => false,
						'default' => array(
								'background-color'  => '#FFFFFF', 
							),
						),
					array(
						'id'       => 'bpxl_sidebar_widget_border',
						'type'     => 'border',
						'title'    => __('Sidebar Widgets Border', 'bloompixel'),
						'subtitle' => __('Apply the border to sidebar widgets.', 'bloompixel'),
						'output'   => array('.sidebar-widget, #tabs-widget'),
						'default'  => array(
								'border-color'  => '#e3e3e3', 
								'border-style'  => 'solid', 
								'border-top'    => '1px', 
								'border-right'  => '1px', 
								'border-bottom' => '1px', 
								'border-left'   => '1px'
							),
						),
					array(
						'id'       => 'bpxl_sidebar_widget_title_color',
						'type'     => 'color',
						'title'    => __('Sidebar Widgets Title Color', 'bloompixel'), 
						'subtitle' => __('Pick a color for titles of sidebar widgets.', 'bloompixel'),
						'output'   => array('.widget-title, #tabs li a'),
						'default'  => '#000000',
						'validate' => 'color',
						'transparent' => false,
						),
					array(
						'id'       => 'bpxl_sidebar_widget_color',
						'type'     => 'color',
						'title'    => __('Sidebar Widgets Text Color', 'bloompixel'), 
						'subtitle' => __('Pick a color for text of sidebar widgets.', 'bloompixel'),
						'output'   => array('.sidebar-widget'),
						'default'  => '#555555',
						'validate' => 'color',
						'transparent' => false,
						),
					array(
						'id'       => 'bpxl_sidebar_widget_link_color',
						'type'     => 'color',
						'title'    => __('Sidebar Widgets Link Color', 'bloompixel'), 
						'subtitle' => __('Pick a color for links of sidebar widgets.', 'bloompixel'),
						'output'   => array('.sidebar a, .sidebar-small-widget a'),
						'default'  => '#333333',
						'validate' => 'color',
						'transparent' => false,
						),
					array(
						'id'       => 'bpxl_sidebar_widget_meta_color',
						'type'     => 'color',
						'title'    => __('Sidebar Widgets Meta Color', 'bloompixel'), 
						'subtitle' => __('Pick a color for meta of sidebar widgets.', 'bloompixel'),
						'output'   => array('.meta, .meta a'),
						'default'  => '#999999',
						'validate' => 'color',
						'transparent' => false,
						),
					array(
						'id'=>'bpxl_nav_break',
						'type' => 'info',
						'desc' => __('Footer', 'bloompixel')
						),
					array( 
						'id'       => 'bpxl_footer_color',
						'type'     => 'background',
						'title'    => __('Footer Background Color', 'bloompixel'),
						'subtitle' => __('Pick a background color for the footer.', 'bloompixel'),
						'output'   => array('.footer'),
						'preview_media' => true,
						'preview' => false,
						'default' => array(
								'background-color'  => '#101010', 
							),
						),
					array(
						'id'=>'bpxl_footer_link_color',
						'type' => 'link_color',
						'title' => __('Footer Link Color', 'bloompixel'), 
						'subtitle' => __('Pick a link color for the footer.', 'bloompixel'),
						'output'   => array('.footer a'),
						'default'  => array(
							'regular'  => '#777777', // 8B8B8B
							'hover'    => '#FFFFFF', // White
						),
						'validate' => 'color',
						'transparent' => false,
						'active' => false,
						),
					array(
						'id'       => 'bpxl_footer_widget_title_color',
						'type'     => 'color',
						'title'    => __('Footer Widget Title Color', 'bloompixel'), 
						'subtitle' => __('Pick a color for title of footer widgets.', 'bloompixel'),
						'output'   => array('.footer-widget .widget-title'),
						'default'  => '#FFFFFF',
						'validate' => 'color',
						'transparent' => false,
						),
					array( 
						'id'       => 'bpxl_copyright_bg_color',
						'type'     => 'background',
						'title'    => __('Copyright Background Color', 'bloompixel'),
						'subtitle' => __('Pick a background color for the copyright section.', 'bloompixel'),
						'output'   => array('.copyright'),
						'preview_media' => true,
						'preview' => false,
						'transparent' => false,
						'background-image' => false,
						'background-position' => false,
						'background-repeat' => false,
						'background-attachment' => false,
						'background-size' => false,
						'default' => array(
								'background-color'  => '#000000', 
							),
						),
					array(
						'id'=>'bpxl_copyright_color',
						'type' => 'color',
						'output'   => array('.copyright'),
						'title' => __('Copyright Text Color', 'bloompixel'), 
						'subtitle' => __('Pick color for text of copyright section.', 'bloompixel'),
						'default' => '#ffffff',
						'validate' => 'color',
						'transparent' => false,
						),
					array(
						'id'=>'bpxl_nav_break',
						'type' => 'info',
						'desc' => __('Custom CSS', 'bloompixel')
						),
					array(
						'id'=>'bpxl_custom_css',
						'type' => 'ace_editor',
						'title' => __('Custom CSS', 'bloompixel'), 
						'subtitle' => __('Quickly add some CSS to your theme by adding it to this block.', 'bloompixel'),
						'mode' => 'css',
						'theme' => 'monokai',
						'default' => ""
						)
				)
            );
			
            $this->sections[] = array(
				'icon' => 'el-icon-font',
				'icon_class' => 'icon-large',
				'title' => __('Typography', 'bloompixel'),
				'fields' => array(										
					array(
						'id'=>'bpxl_body_font',
						'type' => 'typography',
						'output' => array('body'),
						'title' => __('Body Font', 'bloompixel'),
						'subtitle' => __('Select the main body font for your theme.', 'bloompixel'),
						'google'=>true,
						'text-align'=>false,
						'color'=>false,
						'font-size'=>false,
						'line-height'=>false,
						'default' => array(
							'font-family'=>'Noto Sans',
							'font-weight'=>'400',
							),
						),
					array(
						'id'=>'bpxl_logo_font',
						'type' => 'typography',
						'output' => array('.header #logo a'),
						'title' => __('Logo Font', 'bloompixel'),
						'subtitle' => __('Select the font for logo for your theme.', 'bloompixel'),
						'google'=>true,
						'text-align'=>false,
						'color'=>true,
						'font-size'=>true,
						'line-height'=>true,
						'default' => array(
							'font-family'=>'Montserrat',
							'font-size'=>'26px',
							'font-weight'=>'400',
							'line-height'=>'32px',
							'color'=>'#ffffff',
							),
						),
					array(
						'id'=>'bpxl_headings_font',
						'type' => 'typography',
						'output' => array('h1,h2,h3,h4,h5,h6, .header, .main-navigation a, .read-more, .article-heading, .slidertitle, .carousel, #tabs li a, .social-widget a, .post-navigation, #wp-calendar caption, .comment-reply-link, #comments .fn, #commentform input, #commentform textarea, input[type="submit"], .pagination, .footer-subscribe'),
						'title' => __('Headings Font', 'bloompixel'),
						'subtitle' => __('Select the font for headings for your theme.', 'bloompixel'),
						'google'=>true,
						'text-align'=>false,
						'color'=>false,
						'font-size'=>false,
						'line-height'=>false,
						'default' => array(
							'font-family'=>'Open Sans',
							'font-weight'=>'700',
							),
						),
					array(
						'id'=>'bpxl_home_title_font',
						'type' => 'typography',
						'output' => array('.home-post-title'),
						'title' => __('Home Post Title Font', 'bloompixel'),
						'subtitle' => __('Select the font for titles of posts on homepage for your theme.', 'bloompixel'),
						'google'=>true,
						'text-align'=>false,
						'color'=>false,
						'default' => array(
							'font-family'=>'Open Sans',
							'font-size'=>'24px',
							'font-weight'=>'600',
							'line-height'=>'30px',
							),
						),
					array(
						'id'=>'bpxl_title_font',
						'type' => 'typography',
						'output' => array('.single-title, .page-title, .widgettitle'),
						'title' => __('Single Post Title Font', 'bloompixel'),
						'subtitle' => __('Select the font for titles of posts for your theme.', 'bloompixel'),
						'google'=>true,
						'text-align'=>false,
						'color'=>false,
						'default' => array(
							'font-family'=>'Open Sans',
							'font-size'=>'24px',
							'font-weight'=>'600',
							'line-height'=>'30px',
							),
						),
					array(
						'id'=>'bpxl_post_content_font',
						'type' => 'typography',
						'output' => array('.post-content, .single-post-content, .single-page-content'),
						'title' => __('Post Content Font', 'bloompixel'),
						'subtitle' => __('Select the font for content of posts for your theme.', 'bloompixel'),
						'google'=>true,
						'text-align'=>false,
						'color'=>false,
						'font-size'=>true,
						'line-height'=>true,
						'default' => array(
							'font-family'=>'Noto Sans',
							'font-size'=>'16px',
							'font-weight'=>'400',
							'line-height'=>'28px',
							),
						),
					array(
						'id'=>'bpxl_widget_title_font',
						'type' => 'typography',
						'output' => array('.widget-title'),
						'title' => __('Widget Title Font', 'bloompixel'),
						'subtitle' => __('Select the font for title of widgets.', 'bloompixel'),
						'google'=>true,
						'text-align'=>false,
						'color'=>false,
						'font-size'=>true,
						'line-height'=>true,
						'default' => array(
							'font-family'=>'Open Sans',
							'font-size'=>'13px',
							'font-weight'=>'700',
							'line-height'=>'20px',
							),
						),
				)
            );
			
            $this->sections[] = array(
				'icon' => 'el-icon-home',
				'icon_class' => 'icon-large',
				'title' => __('Homepage', 'bloompixel'),
				'fields' => array(
                    array(
                        'id'=>'bpxl_home_slider_break',
                        'type' => 'info',
                        'desc' => __('Home Slider', 'bloompixel')
                        ),
					array(
						'id'=>'bpxl_home_slider',
						'type' => 'switch', 
						'title' => __('Homepage Slider', 'bloompixel'),
						'subtitle'=> __('Choose the option to show or hide slider on homepage.', 'bloompixel'),
						"default" 		=> 0,
						'on' => 'Show',
						'off' => 'Hide',
						),	
					array(
						'id'		=> 'bpxl_home_slider_cat',
						'type'     => 'select',
						'multi'    => true,
						'data' => 'categories',
						'title'    => __('Slider Category', 'bloompixel'), 
						'required' => array('bpxl_home_slider','=','1'),
						'subtitle' => __('Select category/categories for slider on homepage.', 'bloompixel'),
						),
                    array(
                        'id'=>'bpxl_slider_posts_count',
                        'type' => 'slider', 
                        'title' => __('Number of Slides', 'bloompixel'), 
                        'required' => array('bpxl_home_slider','=','1'),
                        'subtitle' => __('Use the slider to choose number of posts to be shown in slider on homepage.', 'bloompixel'),
                        "default"   => "4",
                        "min"       => "0",
                        "step"      => "1",
                        "max"       => "20",
                        ),  
                    array(
                        'id'=>'bpxl_home_content_break',
                        'type' => 'info',
                        'desc' => __('Home Content', 'bloompixel')
                        ),
					array(
						'id'=>'bpxl_home_latest_posts',
						'type' => 'switch', 
						'title' => __('Show Latest Posts by Category', 'bloompixel'),
						'subtitle'=> __('Choose this option to show latest posts by category on homepage.', 'bloompixel'),
						"default" 		=> 0,
						'on' => 'Yes',
						'off' => 'No',
						),	
					array(
						'id'		=> 'bpxl_home_latest_cat',
						'type'     => 'select',
						'multi'    => true,
						'data' => 'categories',
						'title'    => __('Latest Posts Category', 'bloompixel'), 
						'required' => array('bpxl_home_latest_posts','=','1'),
						'subtitle' => __('Select category/categories for latest posts on homepage. Use Ctrl key to select more than one category.', 'bloompixel'),
						),
					array(
						'id'=>'bpxl_home_content',
						'type' => 'radio',
						'title' => __('Home Content', 'bloompixel'), 
						'subtitle' => __('Select content type for home.', 'bloompixel'),
						'options' => array('1' => 'Excerpt', '2' => 'Full Content'),//Must provide key => value pairs for radio options
						'default' => '1'
						),	
					array(
						'id'=>'bpxl_excerpt_length',
						'type' => 'slider', 
						'title' => __('Excerpt Length', 'bloompixel'), 
						'required' => array('bpxl_home_content','=','1'),
						'subtitle' => __('Paste the length of post excerpt to be shown on homepage.', 'bloompixel'),
						"default" 	=> "40",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "55",
						),	
                    array(
                        'id'=>'bpxl_home_meta_break',
                        'type' => 'info',
                        'desc' => __('Home Post Meta', 'bloompixel')
                        ),
					array(
						'id'=>'bpxl_post_meta',
						'type' => 'switch', 
						'title' => __('Post Meta (Homepage)', 'bloompixel'),
						'subtitle'=> __('Choose the option to show or hide post meta on homepage/blog pages.', 'bloompixel'),
						"default" 		=> 1,
						'on' => 'Show',
						'off' => 'Hide',
						),
					array(
						'id'=>'bpxl_post_meta_options',
						'type' => 'checkbox',
						'title' => __('Post Meta Info Options', 'bloompixel'), 
						'required' => array('bpxl_post_meta','=','1'),
						'subtitle' => __('Select which items to show for post meta.', 'bloompixel'),
						'options' => array('1' => 'Post Author','2' => 'Date in Post Header','3' => 'Post Category','4' => 'Post Tags','5' => 'Post Comments','6' => 'Author Avatar','7' => 'Post Icon','8' => 'Date in Post Footer (Format of this date position can be chanegd from Settings -> General)'),//Must provide key => value pairs for multi checkbox options
						'default' => array('1' => '1', '2' => '1', '3' => '1', '4' => '1', '5' => '1', '6' => '1', '7' => '1', '8' => '0')//See how std has changed? you also don't need to specify opts that are 0.
						),
				)
            );
			
            $this->sections[] = array(
				'icon' => 'el-icon-check-empty',
				'icon_class' => 'icon-large',
				'title' => __('Header', 'bloompixel'),
				'fields' => array(	
					array(
						'id'=>'bpxl_header_style',
						'type' => 'image_select',
						'compiler'=>true,
						'title' => __('Header Style', 'bloompixel'), 
						'subtitle' => __('Select the style for header. Choose between left or center logo.', 'bloompixel'),
						'options' => array(
								'header_one' => array('alt' => '2 Column', 'img' => get_template_directory_uri() .'/inc/options/settings/img/layouts/header-1.png'),
								'header_two' => array('alt' => '2 Column', 'img' => get_template_directory_uri() .'/inc/options/settings/img/layouts/header-2.png'),
							),
						'default' => 'header_one'
						),	
					array(
						'id'=>'bpxl_sticky_menu',
						'type' => 'switch', 
						'title' => __('Sticky Header', 'bloompixel'),
						'subtitle'=> __('Choose the option to enable or disable the sticky header.', 'bloompixel'),
						"default" 		=> 0,
						'on' => 'Enabled',
						'off' => 'Disabled',
						),	 
					array(
						'id'=>'bpxl_tagline',
						'type' => 'switch', 
						'title' => __('Show Tagline', 'bloompixel'),
						'subtitle'=> __('Choose the option to show or hide tagline below logo.', 'bloompixel'),
						"default" 		=> 0,
						'on' => 'Show',
						'off' => 'Hide',
						),
					array(
						'id'=>'bpxl_header_slider_break',
						'type' => 'info',
						'desc' => __('Slider below Header', 'bloompixel')
						),
					array(
						'id'=>'bpxl_header_slider',
						'type' => 'switch', 
						'title' => __('Slider below Header', 'bloompixel'),
						'subtitle'=> __('Choose the option to show or hide slider below header.', 'bloompixel'),
						"default" 		=> 0,
						'on' => 'Show',
						'off' => 'Hide',
						),
					array(
						'id'       => 'bpxl_header_slider_pages',
						'type'     => 'radio',
						'required' => array('bpxl_header_slider','=','1'),
						'title'    => __('Show Header Slider on Pages', 'bloompixel'),
						'subtitle' => __('Select whether to show header slider on homepage only or on all pages including homepage', 'bloompixel'),
						//Must provide key => value pairs for radio options
						'options'  => array(
							'1' => 'Homepage Only',
							'2' => 'All Pages including Homepage',
						),
						'default' => '1',
						'customizer' => false
						),
					array(
						'id'=>'bpxl_header_slidess',
						'type' => 'slides',
						'required' => array('bpxl_header_slider','=','1'),
						'title' => __('Slides Options', 'bloompixel'),
						'subtitle'=> __('Select maximum of 4 slides. If you choose just 1 slide then it will become a static banner.', 'bloompixel'),
						'placeholder' => array(
							'title' => __('This is a title', 'bloompixel'),
							'description' => __('Description Here', 'bloompixel'),
							'url' => __('Give us a link!', 'bloompixel'),
							),							
						),
					array(
						'id'=>'bpxl_header_slider_opacity',
						'type' => 'slider',
						'required' => array('bpxl_header_slider','=','1'),
						'title' => __('Slides Opacity', 'bloompixel'),
						'subtitle'=> __('Opacity for background images of slider.', 'bloompixel'),
						"default" => .6,
						"min" => 0,
						"step" => .1,
						"max" => 1,
						'resolution' => 0.1,
						'display_value' => 'text'
					),
				)
            );
			
            $this->sections[] = array(
				'icon' => 'el-icon-minus',
				'icon_class' => 'icon-large',
				'title' => __('Footer', 'bloompixel'),
				'fields' => array(
					array(
						'id'=>'bpxl_footer_text',
						'type' => 'editor',
						'title' => __('Copyright Text', 'bloompixel'), 
						'subtitle' => __('Enter copyright text to be shown on footer or you can keep it blank to show nothing.', 'bloompixel'),
						'default' => '&copy; Copyright 2014. Theme by <a href="http://themeforest.net/user/BloomPixel/portfolio?ref=bloompixel">BloomPixel</a>.',
						'editor_options'   => array(
								'media_buttons'    => false,
								'textarea_rows'    => 5
							)
						),
				)
            );
			
            $this->sections[] = array(
				'icon' => 'el-icon-folder-open',
				'icon_class' => 'icon-large',
				'title' => __('Single Post Options', 'bloompixel'),
				'fields' => array(
					array(
						'id'=>'bpxl_breadcrumbs',
						'type' => 'switch', 
						'title' => __('Breadcrumbs', 'bloompixel'),
						'subtitle'=> __('Choose the option to show or hide breadcrumbs on single posts.', 'bloompixel'),
						"default" 		=> 1,
						'on' => 'Show',
						'off' => 'Hide',
						),
					array(
						'id'=>'bpxl_single_featured',
						'type' => 'switch', 
						'title' => __('Show Featured Content', 'bloompixel'),
						'subtitle'=> __('Choose the option to show or hide featured thumbnails, gallery, audio or video on single posts.', 'bloompixel'),
						"default" 		=> 1,
						'on' => 'Show',
						'off' => 'Hide',
						),
					array(
						'id'=>'bpxl_author_box',
						'type' => 'switch', 
						'title' => __('Author Info Box', 'bloompixel'),
						'subtitle'=> __('Choose the option to show or hide author info box on single posts.', 'bloompixel'),
						"default" 		=> 1,
						'on' => 'Show',
						'off' => 'Hide',
						),	
					array(
						'id'=>'bpxl_next_prev_article',
						'type' => 'switch', 
						'title' => __('Next/Prev Article Links', 'bloompixel'),
						'subtitle'=> __('Choose the option to show or hide links to Next/Prev articles on single posts.', 'bloompixel'),
						"default" 		=> 1,
						'on' => 'Show',
						'off' => 'Hide',
						),
					array(
						'id'=>'bpxl_single_meta_break',
						'type' => 'info',
						'desc' => __('Post Meta', 'bloompixel')
						),
					array(
						'id'=>'bpxl_single_post_meta',
						'type' => 'switch', 
						'title' => __('Single Post Meta', 'bloompixel'),
						'subtitle'=> __('Choose the option to show or hide post meta on single posts.', 'bloompixel'),
						"default" 		=> 1,
						'on' => 'Show',
						'off' => 'Hide',
						),
					array(
						'id'=>'bpxl_single_post_meta_options',
						'type' => 'checkbox',
						'title' => __('Post Meta Info Options', 'bloompixel'), 
						'required' => array('bpxl_single_post_meta','=','1'),
						'subtitle' => __('Select which items to show for post meta.', 'bloompixel'),
						'options' => array('1' => 'Post Author','2' => 'Date in Post Header','3' => 'Post Category','4' => 'Post Tags','5' => 'Post Comments','6' => 'Author Avatar','7' => 'Post Icon','8' => 'Date in Post Footer (Format of this date position can be chanegd from Settings -> General)'),//Must provide key => value pairs for multi checkbox options
						'default' => array('1' => '1', '2' => '1', '3' => '1', '4' => '1', '5' => '1', '6' => '1', '7' => '1', '8' => '0')//See how std has changed? you also don't need to specify opts that are 0.
						),
					array(
						'id'=>'bpxl_related_break',
						'type' => 'info',
						'desc' => __('Related Posts', 'bloompixel')
						),
					array(
						'id'=>'bpxl_related_posts',
						'type' => 'switch', 
						'title' => __('Related Posts', 'bloompixel'),
						'subtitle'=> __('Choose the option to show or hide related posts on single posts.', 'bloompixel'),
						"default" 		=> 1,
						'on' => 'Show',
						'off' => 'Hide',
						),	
					array(
						'id'=>'bpxl_related_posts_count',
						'type' => 'slider', 
						'title' => __('Number of Related Posts', 'bloompixel'),
						'required' => array('bpxl_related_posts','=','1'),
						'subtitle'=> __('Choose the number of related posts you want to show.', 'bloompixel'),
						"default" 	=> "3",
						"min" 		=> "3",
						"step"		=> "1",
						"max" 		=> "20",
						),	
					array(
						'id'=>'bpxl_related_posts_by',
						'type' => 'radio',
						'title' => __('Filter Related Posts By', 'bloompixel'), 
                        'required' => array('bpxl_related_posts','=','1'),
						'subtitle' => __('Choose whether to show related posts by categories or tags.', 'bloompixel'),
						'options' => array('1' => 'Categories', '2' => 'Tags'),//Must provide key => value pairs for radio options
						'default' => '1',
						),
					array(
						'id'=>'bpxl_single_share_break',
						'type' => 'info',
						'desc' => __('Share Buttons', 'bloompixel')
						),
					array(
						'id'=>'bpxl_show_share_buttons',
						'type' => 'switch', 
						'title' => __('Social Media Share Buttons', 'bloompixel'),
						'subtitle'=> __('Choose the option to show or hide social media share buttons on single pages.', 'bloompixel'),
						"default" 		=> 0,
						'on' => 'Show',
						'off' => 'Hide',
						),
                    array(
                        'id'=>'bpxl_share_buttons',
                        'type'     => 'sortable',
                        'title' => __('Select Share Buttons', 'bloompixel'), 
                        'required' => array('bpxl_show_share_buttons','=','1'),    
                        'subtitle' => __('Select which buttons you want to show. You can drag and drop the buttons to change the position.', 'bloompixel'),
                        'mode'     => 'checkbox',
                        'options'  => array(
                            'fb'     => 'Facebook',
                            'twitter'    => 'Twitter',
                            'gplus'  => 'Google+',
                            'linkedin'  => 'LinkedIn',
                            'pinterest'  => 'Pinterest',
                            'stumbleupon'  => 'StumbleUpon',
                            'reddit'  => 'Reddit',
                            'tumblr'  => 'Tumblr',
                            'delicious'  => 'Delicious',
                            'vkontakte'  => 'Vkontakte',
                        ),
                        // For checkbox mode
                        'default' => array(
                            'fb' => true,
                            'twitter' => true,
                            'gplus' => true,
                            'linkedin' => false,
                            'pinterest' => false,
                            'stumbleupon' => false,
                            'reddit' => false,
                            'tumblr' => false,
                            'delicious' => false,
                            'vkontakte' => false,
                        ),
                    ),
                    array(
                        'id'=>'bpxl_share_buttons_pos',
                        'type' => 'radio',
                        'title' => __('Share Buttons Position', 'bloompixel'), 
                        'required' => array('bpxl_show_share_buttons','=','1'),
                        'subtitle' => __('Choose the position for share buttons.', 'bloompixel'),
                        'options' => array('top' => 'Above Content', 'bottom' => 'Below Content'),//Must provide key => value pairs for radio options
                        'default' => 'bottom',
                        ),
                    array(
                        'id'=>'bpxl_share_text',
                        'type' => 'text',
                        'required' => array('bpxl_show_share_buttons','=','1'),
                        'title' => __('Share Text', 'bloompixel'), 
                        'subtitle' => __('Enter text for share buttons here.', 'bloompixel'),
                        'default' => "Share On"
                        ),
				)
            );
			
            $this->sections[] = array(
				'icon' => 'el-icon-asterisk',
				'icon_class' => 'icon-large',
				'title' => __('Post Format Options', 'bloompixel'),
				'fields' => array(
					array(
						'id'=>'bpxl_standard_icon_color',
						'type' => 'color',
						'title' => __('Standard Post Format Icon Color', 'bloompixel'), 
						'subtitle' => __('Choose color for the icon.', 'bloompixel'),
						'default' => '#ff8800',
						'validate' => 'color',
						'transparent' => false,
						'output'    => array(
								'color'            => '.post-meta .post-type-standard i',
								'border-color' => '.post-meta .post-type-standard i',
							)
						),
					array(
						'id'=>'bpxl_audio_icon_color',
						'type' => 'color',
						'title' => __('Audio Post Format Icon Color', 'bloompixel'), 
						'subtitle' => __('Choose color for the icon.', 'bloompixel'),
						'default' => '#0b8fe8',
						'validate' => 'color',
						'transparent' => false,
						'output'    => array(
								'color'            => '.post-meta .post-type-audio i',
								'border-color' => '.post-meta .post-type-audio i',
							)
						),
					array(
						'id'=>'bpxl_video_icon_color',
						'type' => 'color',
						'title' => __('Video Post Format Icon Color', 'bloompixel'), 
						'subtitle' => __('Choose color for the icon.', 'bloompixel'),
						'default' => '#27ae60',
						'validate' => 'color',
						'transparent' => false,
						'output'    => array(
								'color'            => '.post-meta .post-type-video i',
								'border-color' => '.post-meta .post-type-video i',
							)
						),
					array(
						'id'=>'bpxl_image_icon_color',
						'type' => 'color',
						'title' => __('Image Post Format Icon Color', 'bloompixel'), 
						'subtitle' => __('Choose color for the icon.', 'bloompixel'),
						'default' => '#9933cc',
						'validate' => 'color',
						'transparent' => false,
						'output'    => array(
								'color'            => '.post-meta .post-type-image i',
								'border-color' => '.post-meta .post-type-image i',
							)
						),
					array(
						'id'=>'bpxl_quote_icon_color',
						'type' => 'color',
						'title' => __('Quote Post Format Icon Color', 'bloompixel'), 
						'subtitle' => __('Choose color for the icon.', 'bloompixel'),
						'default' => '#ff4444',
						'validate' => 'color',
						'transparent' => false,
						'output'    => array(
								'color'            => '.post-meta .post-type-quote i',
								'border-color' => '.post-meta .post-type-quote i',
							)
						),
					array(
						'id'=>'bpxl_gallery_icon_color',
						'type' => 'color',
						'title' => __('Gallery Post Format Icon Color', 'bloompixel'), 
						'subtitle' => __('Choose color for the icon.', 'bloompixel'),
						'default' => '#99cc00',
						'validate' => 'color',
						'transparent' => false,
						'output'    => array(
								'color'            => '.post-meta .post-type-gallery i',
								'border-color' => '.post-meta .post-type-gallery i',
							)
						),
					array(
						'id'=>'bpxl_link_icon_color',
						'type' => 'color',
						'title' => __('Link Post Format Icon Color', 'bloompixel'), 
						'subtitle' => __('Choose color for the icon.', 'bloompixel'),
						'default' => '#2980b9',
						'validate' => 'color',
						'transparent' => false,
						'output'    => array(
								'color'            => '.post-meta .post-type-link i',
								'border-color' => '.post-meta .post-type-link i',
							)
						),
				)            
            );
			
            $this->sections[] = array(
				'icon' => 'el-icon-eur',
				'icon_class' => 'icon-large',
				'title' => __('Ad Management', 'bloompixel'),
				'fields' => array(	
                    array(
                        'id'=>'bpxl_above_post_ad',
                        'type' => 'textarea',
                        'title' => __('Above Post Ad', 'bloompixel'), 
                        'subtitle' => __('Paste your ad code here. </br><br/>This ad will appear above first post on homepage or above post on single page.', 'bloompixel'),
                        'default' => ''
                        ),
					array(
						'id'=>'bpxl_below_title_ad',
						'type' => 'textarea',
						'title' => __('Below Post Title Ad', 'bloompixel'), 
						'subtitle' => __('Paste your ad code here.</br><br/>This ad will appear below post title on single post page.', 'bloompixel'),
						'default' => ''
						),
					array(
						'id'=>'bpxl_below_content_ad',
						'type' => 'textarea',
						'title' => __('Below Post Content Ad', 'bloompixel'), 
						'subtitle' => __('Paste your ad code here.</br><br/>This ad will appear below post content on single post pages.', 'bloompixel'),
						'default' => ''
						),
					array(
						'id'=>'bpxl_para_ad',
						'type' => 'text',
						'title' => __('Show Ad after "X" paragraphs', 'bloompixel'),
						'subtitle' => __('Enter number of paragraphs here.', 'bloompixel'),
						'default' => '',
						'customizer' => false
						),
					array(
						'id'=>'bpxl_para_ad_code',
						'type' => 'textarea',
						'title' => __('Ad Code', 'bloompixel'), 
						'subtitle' => __('Paste your ad code here.</br><br/>This ad will appear after "x" number of paragraphs as defined above.', 'bloompixel'),
						'default' => ''
						),
				)
            );

            $this->sections[] = array(
				'icon' => 'el-icon-check',
				'icon_class' => 'icon-large',
				'title' => __('Updates', 'bloompixel'),
				'fields' => array(
					array(
						'id'=>'bpxl_envato_user_name',
						'type' => 'text',
						'title' => __('Envato Username', 'bloompixel'), 
						'subtitle' => __('Enter your Envato (ThemeForest) username here.', 'bloompixel'),
						'default' => ""
						),
					array(
						'id'=>'bpxl_envato_api_key',
						'type' => 'text',
						'title' => __('Envato API Key', 'bloompixel'), 
						'subtitle' => __('Enter your Envato API key here.', 'bloompixel'),
						'default' => ""
						),
				)
			);         
            
            $this->sections[] = array(
                'title'     => __('Import / Export', 'bloompixel'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'bloompixel'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );

            if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
                $tabs['docs'] = array(
                    'icon'      => 'el-icon-book',
                    'title'     => __('Documentation', 'bloompixel'),
                    'content'   => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
                );
            }
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', 'bloompixel'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'bloompixel')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', 'bloompixel'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'bloompixel')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'bloompixel');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'bpxl_goblog_options',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => __('Theme Options', 'bloompixel'),
                'page_title'        => __('Theme Options', 'bloompixel'),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => true,                    // Use a asynchronous font on the front end or font string
                //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                'admin_bar'         => true,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => true,                    // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => '_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'           => false, // REMOVE

                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );

            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
                //$this->args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'bloompixel'), $v);
            } else {
                //$this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'bloompixel');
            }

            // Add content after the form.
            //$this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'bloompixel');
        }

    }
    
    global $reduxConfig;
    $reduxConfig = new Redux_Framework_sample_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
