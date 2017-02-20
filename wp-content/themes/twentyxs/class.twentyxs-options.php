<?php class TwentyXS_Options {

	private $sections;
	private $checkboxes;
	private $settings;

	public function __construct() {

		// This will keep track of the checkbox options for the validate_settings function.
		$this->checkboxes = array();
		$this->settings = array();
		$this->get_option();

		$this->sections['general']      = 'Basic Style';
		$this->sections['advanced']      = 'Advanced Style';
		$this->sections['additional']      = 'Additional';
		$this->sections['reset']        = 'Reset All Settings';
//		$this->sections['about']        = 'About';

		add_action( 'admin_menu', array( &$this, 'add_pages' ) );
		add_action( 'admin_init', array( &$this, 'register_settings' ) );

		if ( ! get_option( 'TwentyXS_options' ) )
			$this->initialize_settings();

	}

	public function add_pages() {

		$admin_page = add_theme_page( 'TwentyXS Settings', 'TwentyXS Settings', 'edit_theme_options', 'TwentyXS-options', array( &$this, 'display_page' ) );

		add_action( 'admin_print_scripts-' . $admin_page, array( &$this, 'scripts' ) );
		add_action( 'admin_print_styles-' . $admin_page, array( &$this, 'styles' ) );

	}

	public function create_setting( $args = array() ) {

		$defaults = array(
			'id'      => 'default_field',
			'title'   => 'Default Field',
			'desc'    => 'This is a default description.',
			'std'     => '',
			'type'    => 'text',
			'section' => 'general',
			'choices' => array(),
			'class'   => ''
		);
	
		extract( wp_parse_args( $args, $defaults ) );

		$field_args = array(
			'type'      => $type,
			'id'        => $id,
			'desc'      => $desc,
			'std'       => $std,
			'choices'   => $choices,
			'label_for' => $id,
			'class'     => $class
		);

		if ( $type == 'checkbox' )
			$this->checkboxes[] = $id;

		add_settings_field( $id, $title, array( $this, 'display_setting' ), 'TwentyXS-options', $section, $field_args );
	}

	public function display_page() {

		echo '<div class="wrap">
	<div class="icon32" id="icon-options-general"></div>
	<h2>' . 'TwentyXS Settings' . '</h2>';

		if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] == true )
			echo '<div class="updated fade"><p>' . 'Settings updated.' . '</p></div>';
		
		echo '<div id="content"><form action="options.php" method="post">';

		settings_fields( 'TwentyXS_options' );
		echo '<div class="ui-tabs">
			<ul class="ui-tabs-nav">';
		foreach ( $this->sections as $section_slug => $section )
			echo '<li><a href="#' . $section_slug . '">' . $section . '</a></li>';

		echo '</ul>';
		do_settings_sections( $_GET['page'] );

		echo '</div>
		<p class="submit"><input name="Submit" type="submit" class="button-primary" value="' . 'Save Changes' . '" /></p>

	</form>';
	echo '<div id="floatleft">';
/*	echo '<div id="informations"><div id="titel">Have a second?</div><div id="text"><img style="width:160px;height:135px;" src="http://i39.tinypic.com/a30186.png">I don&rsquo;t drink coffee. But a hot chocolate would be great! It costs you only a few seconds with PayPal. <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=4YGBD2F4PXJSJ">Invest</a> 2 Euro (2.6 $) meaningfully. And I can <b>keep up the good work</b>.<br/>&hellip;because it tastes so awesome!<!-- <br/><br/><a href="http://flattr.com/thing/298774/WordPress-Theme-TwentyXS" target="_blank"><img src="http://api.flattr.com/button/flattr-badge-large.png" alt="Flattr this" title="Flattr this" border="0" /></a> --></div></div>'; */
	echo '<div id="informations"><div id="titel"><a href="http://kevinw.de/txs" target="_blank">Kevin Weber</a> &ndash; that\'s me.</div><div id="text"><a href="http://kevinw.de/txs" target="_blank"><img src="http://www.gravatar.com/avatar/9d876cfd1fed468f71c84d26ca0e9e33?d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536&s=100" style="-webkit-border-radius:50%;-moz-border-radius:50%;border-radius:50%;"></a><br/>I\'m the developer of this theme. I hope you enjoy it!</div></div>';
	echo '<div id="informations"><div id="titel">Plugins you must have</div><div id="text">
			<p><a href="http://wordpress.org/plugins/wordpress-seo/" title="Plugin bei WordPress.org" target="_blank">1. SEO by Yoast</a></p>
			<p><a href="http://wordpress.org/plugins/broken-link-checker/" title="Plugin bei WordPress.org" target="_blank">2. Broken Link Checker</a></p>
			<p><a href="http://wordpress.org/plugins/lazy-load-for-videos/" title="Plugin bei WordPress.org" target="_blank">3. Lazy Load for Videos</a></p>
			<p><a href="http://wordpress.org/plugins/jetpack/" title="Plugin bei WordPress.org" target="_blank">4. Jetpack</a></p>
	</div></div>';
	echo '<div id="informations"><div id="titel">Infographic</div><div id="text" style="padding:5px 5px 0;"><a href="http://kevinw.de/twentyxs_features.php" target="_blank"><img style="width:160px;height:160px;" src="http://i42.tinypic.com/2e58e91.jpg"></a></div></div>';
	echo '<div id="informations"><div id="titel">Wishes?</div><div id="text">Any problems, suggestions or questions about TwentyXS?<br/><a href="http://kevinw.de/kontakt.php" target="_blank">Contact me</a>.</div></div>';
	echo '<div id="informations"><div id="titel">It&rsquo;s <b>free</b>!</div><div id="text">Support me with <a href="http://kevinw.de/donate/TwentyXS/" title="Pay him something to eat" target="_blank">a delicious lunch</a> and give this theme a 5 star rating <a href="http://wordpress.org/support/view/theme-reviews/twentyxs?filter=5" title="Vote for TwentyXS" target="_blank">on WordPress.org</a>.</div></div>';
/*	echo '<div id="informations"><div id="titel">List of Contributors</div><div id="text"><ul><li class="center">steorrah.com made the running!</li></ul>Will you be the next? :-)</div></div>'; */

	echo '</div></div>';

	echo '<script type="text/javascript">
		jQuery(document).ready(function($) {
			var sections = [];';

			foreach ( $this->sections as $section_slug => $section )
				echo "sections['$section'] = '$section_slug';";

			echo 'var wrapped = $(".wrap h3").wrap("<div class=\"ui-tabs-panel\">");
			wrapped.each(function() {
				$(this).parent().append($(this).parent().nextUntil("div.ui-tabs-panel"));
			});
			$(".ui-tabs-panel").each(function(index) {
				$(this).attr("id", sections[$(this).children("h3").text()]);
				if (index > 0)
					$(this).addClass("ui-tabs-hide");
			});
			$(".ui-tabs").tabs({
				fx: { opacity: "toggle", duration: "fast" }
			});
			
			$("input[type=text], textarea").each(function() {
				if ($(this).val() == $(this).attr("placeholder") || $(this).val() == "")
					$(this).css("color", "#999");
			});

			$("input[type=text], textarea").focus(function() {
				if ($(this).val() == $(this).attr("placeholder") || $(this).val() == "") {
					$(this).val("");
					$(this).css("color", "#000");
				}
			}).blur(function() {
				if ($(this).val() == "" || $(this).val() == $(this).attr("placeholder")) {
					$(this).val($(this).attr("placeholder"));
					$(this).css("color", "#999");
				}
			});

			$(".wrap h3, .wrap table").show();
			
			// This will make the "warning" checkbox class really stand out when checked.
			// I use it here for the Reset checkbox.
			$(".warning").change(function() {
				if ($(this).is(":checked"))
					$(this).parent().css("background", "#c00").css("color", "#fff").css("fontWeight", "bold");
				else
					$(this).parent().css("background", "none").css("color", "").css("fontWeight", "normal");
			});

			// Browser compatibility
			if ($.browser.mozilla) 
			         $("form").attr("autocomplete", "off");
		});

	</script>
</div>';

/** COLOR PICKER /// START **/
echo '<script type="text/javascript">';
echo "		jQuery(document).ready(function($){
			$('#color_picker_color1').farbtastic('#xs_picker_linkcolour');
			$('#color_picker_color2').farbtastic('#xs_picker_background_gradient');
			$('#color_picker_color3').farbtastic('#xs_picker_background_gradient_2');
		});
    </script>";
/** COLOR PICKER /// END **/

	}

	public function display_section() {
		// code
	}

	public function display_about_section() {

		// Use this to display an "About" tab. Echo regular HTML here, like so:
		// echo '<p>Copyright 2011 me@example.com</p>';

	}

	public function display_setting( $args = array() ) {

		extract( $args );

		$options = get_option( 'TwentyXS_options' );

		if ( ! isset( $options[$id] ) && $type != 'checkbox' )
			$options[$id] = $std;
		elseif ( ! isset( $options[$id] ) )
			$options[$id] = 0;

		$field_class = '';
		if ( $class != '' )
			$field_class = ' ' . $class;

		switch ( $type ) {

/** COLOR PICKER /// START **/
			case 'picker':

	echo '<input class="picker-text' . $field_class . '" type="text" id="' . $id . '" name="TwentyXS_options[' . $id . ']" placeholder="' . $std . '" value="' . esc_attr( $options[$id] ) . '" />';

			if ( $id == 'xs_picker_linkcolour' )
					echo	'<div id="color_picker_color1" class="pickerstyle"></div>';

			if ( $id == 'xs_picker_background_gradient' )
					echo	'<div id="color_picker_color2" class="pickerstyle"></div>';

			if ( $id == 'xs_picker_background_gradient_2' )
					echo	'<div id="color_picker_color3" class="pickerstyle"></div>';

				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';

	break;
/** COLOR PICKER /// END **/

			case 'heading':
				echo '</td></tr><tr valign="top"><td colspan="2"><h4>' . $desc . '</h4>';
				break;

			case 'infotext':
				echo '<span class="description">' . $desc . '</span>';
	break;

			case 'checkbox':

				echo '<input class="checkbox' . $field_class . '" type="checkbox" id="' . $id . '" name="TwentyXS_options[' . $id . ']" value="1" ' . checked( $options[$id], 1, false ) . ' /> <label for="' . $id . '">' . $desc . '</label>';

				break;

			case 'select':
				echo '<select class="select' . $field_class . '" name="TwentyXS_options[' . $id . ']">';

				foreach ( $choices as $value => $label )
					echo '<option value="' . esc_attr( $value ) . '"' . selected( $options[$id], $value, false ) . '>' . $label . '</option>';

				echo '</select>';

				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';

				break;

			case 'radio':
				$i = 0;
				foreach ( $choices as $value => $label ) {
					echo '<input class="radio' . $field_class . '" type="radio" name="TwentyXS_options[' . $id . ']" id="' . $id . $i . '" value="' . esc_attr( $value ) . '" ' . checked( $options[$id], $value, false ) . '> <label for="' . $id . $i . '">' . $label . '</label>';
					if ( $i < count( $options ) - 1 )
						echo '<br />';
					$i++;
				}

				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';

				break;

			case 'textarea':
				echo '<textarea class="' . $field_class . '" id="' . $id . '" name="TwentyXS_options[' . $id . ']" placeholder="' . $std . '" rows="5" cols="30">' . wp_htmledit_pre( $options[$id] ) . '</textarea>';

				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';

				break;

			case 'password':
				echo '<input class="regular-text' . $field_class . '" type="password" id="' . $id . '" name="TwentyXS_options[' . $id . ']" value="' . esc_attr( $options[$id] ) . '" />';

				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';

				break;

			case 'text':
			default:
		 		echo '<input class="regular-text' . $field_class . '" type="text" id="' . $id . '" name="TwentyXS_options[' . $id . ']" placeholder="' . $std . '" value="' . esc_attr( $options[$id] ) . '" />';

				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';

		 		break;

		}

	}
	
	public function get_option() {

		/* Basic (General) Style Settings
		=========================================*/

		$this->settings['xs_customize_live'] = array(
			'section' => 'general',
			'title'   => '',
			'desc'    => '<p><a id="customize-current-theme-link" target="_blank" href="' . wp_customize_url() . '" class="customize-txs" title="Customize TwentyXS">Click here</a> to customize site title, header and background image/colour.</p>',
			'type'    => 'infotext'
		);

		$this->settings['xs_responsive'] = array(
			'section' => 'general',
			'title'   => 'Responsive Mode <div id="newred">New!</div>',
			'desc'    => 'Make TwentyXS responsive. The theme reacts to the user\'s screen. The additional left and right sidebars will not be visible on smaller screens. (So you should move/copy content from your sidebars to footer areas - or simply get rid of it.)',
			'type'    => 'checkbox',
			'std'     => 1
		);

		$this->settings['xs_custom_css'] = array(
			'title'   => 'Custom CSS<br/><span class="description thin">Add additional CSS. This should override any other stylesheets.</span>',
			'desc'    => 'For example:<br />#sidewidthl, #sidewidthr {opacity: 1;} // non-transparent sidebars<br />#access .menu > li {margin:0 -3px;} // close Headmost Navigation&rsquo;s gaps',
			'std'     => 'selector { property: value; }',
			'type'    => 'textarea',
			'section' => 'general',
			'class'   => 'code'
		);

/** COLOR PICKER /// START **/
		$this->settings['xs_picker_linkcolour'] = array(
			'section' => 'general',
			'title'   => 'Link Colour <br/><span class="description thin">Select the colour of the theme&rsquo;s links. For example&hellip;<br/><font color="#024292">Blue #024292</font> (Standard)<br/><font color="#f66">Light Red #f66</font><br/><font color="#009000">Green #009000</font><br/><font color="#f90">Orange #f90</font><br/><font color="#ff1cae">Pink #ff1cae</font><br/><font color="#cd853f">Brown #cd853f</font><br/><font color="#000">Black #000</font></span>',
			'type'    => 'picker',
			'std'     => '#024292',
			'desc'    => ''
		);

/*  Background Gradients - using Color Picker - coming soon, I hope
		$this->settings['xs_picker_background_gradient'] = array(
			'section' => 'general',
			'title'   => 'Background Gradient Colour 1 <div id="newred">New!</div><br/><span class="description thin">Beschreibung...</span>',
			'type'    => 'picker',
			'std'     => '#024292',
			'desc'    => ''
		);

		$this->settings['xs_picker_background_gradient_2'] = array(
			'section' => 'general',
			'title'   => 'Background Gradient Colour 2 <div id="newred">New!</div><br/><span class="description thin">...</span>',
			'type'    => 'picker',
			'std'     => '#024292',
			'desc'    => ''
		);
*/
/** COLOR PICKER /// END **/

			$this->settings['xs_background_gradient'] = array(
			'section' => 'general',
			'title'   => 'Background Gradient <br/><span class="description thin">Instead of a single background colour: Make your background run from one colour to another.</span>',
			'desc'    => 'You can use Custom CSS alike. Get exemplary <a href="http://pastebin.com/BwTT3H4a" target="_blank">custom code from pastebin</a>.',
			'type'    => 'select',
			'std'     => 'xs_background_gradient_1',
			'choices' => array(
				'xs_background_gradient_1' => 'No Gradient',
				'xs_background_gradient_2' => 'From Orange to White (top, #ff8000 10%, #fff 90%)',
				'xs_background_gradient_3' => 'From Light Grey to Black (top, #f3f3f3 10%, #000 100%)',
				'xs_background_gradient_4' => 'From White to Green (top, #fff 10%, #009000 100%)',
				'xs_background_gradient_5' => 'From Lightblue to Blue (top, lightblue 10%, #2B647F 100%)'
			)
		);

/******** EXEMPLARY OPTIONS *********
			$this->settings['example_text'] = array(
			'title'   => 'Example Text Input',
			'desc'    => 'This is a description for the text input.',
			'std'     => 'Default value',
			'type'    => 'text',
			'section' => 'general'
		);

			$this->settings['example_textarea'] = array(
			'title'   => 'Example Textarea Input',
			'desc'    => 'This is a description for the textarea input.',
			'std'     => 'Default value',
			'type'    => 'textarea',
			'section' => 'general'
		);

			$this->settings['example_heading'] = array(
			'section' => 'general',
			'title'   => '', // Not used for headings.
			'desc'    => 'Example Heading',
			'type'    => 'heading'
		);

			$this->settings['info_text'] = array(
			'section' => 'general',
			'title'   => 'Test',
			'desc'    => 'Any problems, suggestions, questions about TwentyXS or wishes for the next official update of the theme?<br/>Just <a href="http://kevinw.de/kontakt.php" target="_blank">contact me</a>, please.',
			'type'    => 'infotext'
		);

			$this->settings['example_radio'] = array(
			'section' => 'general',
			'title'   => 'Example Radio',
			'desc'    => 'This is a description for the radio buttons.',
			'type'    => 'radio',
			'std'     => '',
			'choices' => array(
				'choice1' => 'Choice 1',
				'choice2' => 'Choice 2',
				'choice3' => 'Choice 3'
			)
		);
*******************/

			$this->settings['xs_layout'] = array(
			'section' => 'general',
			'title'   => 'Theme Layout',
			'desc'    => "Change the theme&rsquo;s layout.",
			'type'    => 'select',
			'std'     => '',
			'choices' => array(
				'xs_layout_1' => 'Layout 1 (Standard)',
				'xs_layout_2' => 'Layout 2 (Widened Main Column, Sidebars With Gap)'
			)
		);

			$this->settings['xs_choose_font'] = array(
			'section' => 'general',
			'title'   => 'Choose Font',
			'desc'    => 'Choose from several fontsets.',
			'type'    => 'select',
			'std'     => 'xs_choose_font_1',
			'choices' => array(
				'xs_choose_font_1' => 'Fontset 1 (Standard: Georgia, serif)',
				'xs_choose_font_2' => 'Fontset 2 (Verdana, sans-serif)',
				'xs_choose_font_3' => 'Fontset 3 (Lucida Grande, sans-serif)',
				'xs_choose_font_4' => 'Fontset 4 (Segoe UI, sans-serif)',
				'xs_choose_font_5' => 'Fontset 5 (Andale Mono WT, monospace)'
			)
		);

			$this->settings['xs_navi_orientation'] = array(
			'section' => 'general',
			'title'   => 'Navigation Alignment<br/><span class="description thin">Orientation of the headmost navigation below your logo.</span>',
			'desc'    => '',
			'type'    => 'radio',
			'std'     => 'center',
			'choices' => array(
				'left' => 'Left',
				'center' => 'Center',
				'right' => 'Right'
			)
		);

		$this->settings['xs_fetching_rss'] = array(
			'section' => 'general',
			'title'   => 'Fetching RSS Badge',
			'desc'    => 'The topmost RSS badge.',
			'type'    => 'checkbox',
			'std'     => 1
		);

		/* Advanced Style
		=========================================*/

		$this->settings['xs_favicon'] = array(
			'section' => 'advanced',
			'title'   => 'Custom Favicon<br/><span class="description thin">Current: <img src="' . stripslashes(TwentyXS_option('xs_favicon')) . '" style="position:relative;top:3px;"></span>',
			'desc'    => 'Enter the URL to your custom favicon. It should be 16x16 pixels in size. For example, ' . get_template_directory_uri() . '/images/favicon.ico',
			'type'    => 'text',
			'std'     => ''
		);

/***** Not working for now
		$this->settings['xs_default_avatar'] = array(
			'section' => 'advanced',
			'title'   => 'Default Avatar<br/><span class="description thin">Current: <img src="' . stripslashes(TwentyXS_option('xs_default_avatar')) . '" style="position:relative;top:3px;"></span>',
			'desc'    => 'You see it on the login page: <b>/wp-admin/</b> respectively <b>/wp-login.php</b><br/>It should be 274x63 pixels in size.',
			'type'    => 'text',
			'std'     => get_template_directory_uri() . '/images/favicon.ico'
		);
*****/

	$this->settings['xs_expand_header_image'] = array(
			'section' => 'advanced',
			'title'   => 'Widened Header Image',
			'desc'    => 'Make the header image as wide as your main column.',
			'type'    => 'checkbox',
			'std'     => 0
		);

		$this->settings['xs_show_excerpt'] = array(
			'section' => 'advanced',
			'title'   => 'Show Excerpt',
			'desc'    => 'Show excerpt (length: 40 words) instead of the hole article on home page.',
			'type'    => 'checkbox',
			'std'     => 0
		);

		$this->settings['xs_post_meta'] = array(
			'section' => 'advanced',
			'title'   => 'Post Meta',
			'desc'    => 'Show &ldquo;posted on&rdquo; and &ldquo;posted in&rdquo; lines at the top and bottom of each post.',
			'type'    => 'checkbox',
			'std'     => 1 // Set to 1 to be checked by default, 0 to be unchecked by default.
		);

		$this->settings['xs_article_enjoy_rss'] = array(
			'section' => 'advanced',
			'title'   => 'Enjoy Article Feature',
			'desc'    => 'Display the &ldquo;Enjoy this article?&rdquo; box that recommends to subscribe to rss feed.',
			'type'    => 'checkbox',
			'std'     => 1
		);

		$this->settings['xs_article_comments_bubble'] = array(
			'section' => 'advanced',
			'title'   => 'Comments Bubble',
			'desc'    => 'Show a speech bubble including the current count of comments per post.',
			'type'    => 'checkbox',
			'std'     => 1
		);

		$this->settings['xs_no_comments'] = array(
			'section' => 'advanced',
			'title'   => 'Do not display comments',
			'desc'    => 'Check this box if you do not want to show any comments.',
			'type'    => 'checkbox',
			'std'     => 0
		);

		$this->settings['xs_random_posts_box'] = array(
			'section' => 'advanced',
			'title'   => 'Random Posts Box',
			'desc'    => 'Show a random posts box in footer area.',
			'type'    => 'checkbox',
			'std'     => 1
		);

		$this->settings['xs_search_form'] = array(
			'section' => 'advanced',
			'title'   => 'Search Field',
			'desc'    => 'Show a search field in footer area.',
			'type'    => 'checkbox',
			'std'     => 1
		);

		$this->settings['xs_jumptotop'] = array(
			'section' => 'advanced',
			'title'   => '&ldquo;Back to top&rdquo;-Button',
			'desc'    => 'Show a &ldquo;Back to top&rdquo;-link in footer area.',
			'type'    => 'checkbox',
			'std'     => 1
		);

		$this->settings['xs_siteinfo'] = array(
			'section' => 'advanced',
			'title'   => 'Site Info and Generator',
			'class'   => 'warning',
			'desc'    => "Don&rsquo;t show the theme author&rsquo;s website and WordPress link at the bottom of your blog.<br /><b>I invested countless hours of work</b> in this great theme. It would be very kind of you if you at least link to <a href='http://kevinw.de' target='_blank'>kevinw.de</a> on your about page referring to the theme author.",
			'type'    => 'checkbox',
			'std'     => 0
		);

		$this->settings['xs_slider_home'] = array(
			'section' => 'advanced',
			'title'   => 'jQuery Slider',
			'desc'    => 'Display a slider that includes an excerpt of every post that has been <b>marked as sticky</b>.',
			'type'    => 'checkbox',
			'std'     => 1
		);

		/* Additional
		=========================================*/

		$this->settings['xs_header_content'] = array(
			'title'   => 'Header Content<br/><span class="description thin">Everything you paste in this box will be added before the closing &lt;/head&gt;-tag.</span>',
			'desc'    => '',
			'std'     => '',
			'type'    => 'textarea',
			'section' => 'additional',
			'class'   => 'code'
		);

		$this->settings['xs_adsense_code_home'] = array(
			'title'   => 'Ads / Content (home page)<br/><span class="description thin">	
Paste your AdSense code or any other code here. It will be inserted <b>between the third and fourth post</b> within the loop on your home page. Recommended max-width of your output code: 500px.</span>',
			'desc'    => '',
			'std'     => '',
			'type'    => 'textarea',
			'section' => 'additional',
			'class'   => 'code'
		);

		$this->settings['xs_adsense_code_post_top'] = array(
			'title'   => 'Ads (single post)<br/><span class="description thin">	
Paste your AdSense code or any other ad code here. It will be displayed above your articles. Recommended max-width of your advertisement: 500px. In general you can use any ad format you want.</span>',
			'desc'    => '',
			'std'     => '',
			'type'    => 'textarea',
			'section' => 'additional',
			'class'   => 'code'
		);

		$this->settings['xs_footer_content'] = array(
			'title'   => 'Footer Content<br/><span class="description thin">Everything you paste in this box will be added before the closing &lt;/body&gt;-tag.</span>',
			'desc'    => '',
			'std'     => '',
			'type'    => 'textarea',
			'section' => 'additional',
			'class'   => 'code'
		);

		$this->settings['xs_scroll_script'] = array(
			'section' => 'additional',
			'title'   => 'Scroll Script',
			'desc'    => 'Use this script and whenever you click on &quot;Back to top&quot; or &quot;Reply&quot; (reply on comments) the scrolling will look very cool.',
			'type'    => 'checkbox',
			'std'     => 0
		);

		$this->settings['xs_admin_bar_button'] = array(
			'section' => 'additional',
			'title'   => 'Admin-Bar-Button',
			'desc'    => 'Add a button to link from your admin bar to the TwentyXS Settings page',
			'type'    => 'checkbox',
			'std'     => 1
		);

		$this->settings['xs_snow_script'] = array(
			'section' => 'additional',
			'title'   => 'Snowfall Script <div id="newred" class="grey">X-Mas Special</div>',
			'desc'    => 'Let it snow on your website ;-)',
			'type'    => 'checkbox',
			'std'     => 0
		);

/******** Appearance
		=========================================

		$this->settings['header_logo'] = array(
			'section' => 'appearance',
			'title'   => 'Header Logo',
			'desc'    => 'Enter the URL to your logo for the theme header.',
			'type'    => 'text',
			'std'     => ''
		);

		$this->settings['favicon'] = array(
			'section' => 'appearance',
			'title'   => __( 'Favicon' ),
			'desc'    => __( 'Enter the URL to your custom favicon. It should be 16x16 pixels in size.' ),
			'type'    => 'text',
			'std'     => ''
		);
************/

		/* Reset
		=========================================*/

		$this->settings['reset_theme'] = array(
			'section' => 'reset',
			'title'   => 'Reset All Settings',
			'type'    => 'checkbox',
			'std'     => 0,
			'class'   => 'warning', // Custom class for CSS
			'desc'    => 'Check this box and click &ldquo;Save Changes&rdquo; below to reset theme settings to their defaults.'
		);

	}

	public function initialize_settings() {

		$default_settings = array();
		foreach ( $this->settings as $id => $setting ) {
			if ( $setting['type'] != 'heading' && $setting['type'] != 'infotext' )
				$default_settings[$id] = $setting['std'];
		}

		update_option( 'TwentyXS_options', $default_settings );

	}

	public function register_settings() {

		register_setting( 'TwentyXS_options', 'TwentyXS_options', array ( &$this, 'validate_settings' ) );

		foreach ( $this->sections as $slug => $title ) {
			if ( $slug == 'about' )
				add_settings_section( $slug, $title, array( &$this, 'display_about_section' ), 'TwentyXS-options' );
			else
				add_settings_section( $slug, $title, array( &$this, 'display_section' ), 'TwentyXS-options' );
		}

		$this->get_option();

		foreach ( $this->settings as $id => $setting ) {
			$setting['id'] = $id;
			$this->create_setting( $setting );
		}

	}

	public function scripts() {

		wp_print_scripts( 'jquery-ui-tabs' );
/** COLOR PICKER /// START **/
   		wp_enqueue_style( 'farbtastic' );
    		wp_enqueue_script( 'farbtastic' );
/** COLOR PICKER /// END **/

	}
	
	public function styles() {

		wp_register_style( 'TwentyXS-admin', get_stylesheet_directory_uri() . '/twentyxs-options.css' );
		wp_enqueue_style( 'TwentyXS-admin' );		

	}

	public function validate_settings( $input ) {

		if ( ! isset( $input['reset_theme'] ) ) {
			$options = get_option( 'TwentyXS_options' );

			foreach ( $this->checkboxes as $id ) {
				if ( isset( $options[$id] ) && ! isset( $input[$id] ) )
					unset( $options[$id] );
			}

			return $input;
		}
		return false;

	}

}

$theme_options = new TwentyXS_Options();

function TwentyXS_option( $option ) {
	$options = get_option( 'TwentyXS_options' );
	if ( isset( $options[$option] ) )
		return $options[$option];
	else
		return false;
}

function txs_admin_footer() {
		$donate_url = 'http://kevinw.de/donate/TwentyXS/';
		$colour = '#ff' . dechex(mt_rand(0, 255)) . '00';
		echo 'Hope you enjoy using the theme TwentyXS &ndash; <a href="' . $donate_url . '" style="font-weight: bold;color: '.$colour.';" rel="nofollow" title="If you like TwentyXS, why not make a tiny/small/large donation towards its upkeep">pay me a lunch!</a><br/>';
	}
	add_action('in_admin_footer', 'txs_admin_footer');
?>