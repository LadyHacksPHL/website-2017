<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = 'MA8';
	update_option('optionsframework', $optionsframework_settings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'MA8'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	$slides_number = array(
		'1' => __('1', 'MA8'),
		'2' => __('2', 'MA8'),
		'3' => __('3', 'MA8'),
		'4' => __('4', 'MA8'),
		'5' => __('5', 'MA8')
	);

	// Typography Defaults
	$typography_defaults = array(
		'size' => '18px',
		'face' => 'Lato',
		'style' => 'normal',
		'color' => '#2c3e50' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '10','11','12','13','14','15','16','17','18','19','20','21','22','23','24' ),
		'faces' => array( 'Lato' => 'Lato'),
		'styles' => array( 'normal' => 'Normal' ),
		'color' => '#2c3e50'
	);

	$options[] = array(
		'name' => __('Basic Styles', 'MA8'),
		'type' => 'heading');

	$options[] = array( 'name' => __('Typography', 'options_framework_theme'),
		'desc' => __('Adjust body font-size and color. Default values being "18px" and "#2c3e50" for size and color respectively.','options_framework_theme'),
		'id' => "example_typography",
		'std' => $typography_defaults,
		'type' => 'typography',
		'options' => $typography_options
		 );

	$options[] = array(
		'name' => __('Logo Uploader', 'MA8'),
		'desc' => __('Upload your logo. This will overide the site title and description.', 'MA8'),
		'id' => 'logo',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Link Color', 'MA8'),
		'desc' => __('Choose a color for a link. #e26666 color selected by default.', 'MA8'),
		'id' => 'link_colorpicker',
		'std' => '#e26666',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Link Hover Color', 'MA8'),
		'desc' => __('Choose a color for a link hover. #9e4342 color selected by default.', 'MA8'),
		'id' => 'link_hover_colorpicker',
		'std' => '#9e4342',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Header Background Color', 'MA8'),
		'desc' => __('Choose a color for header background. #e26666 color selected by default.', 'MA8'),
		'id' => 'header_bg_colorpicker',
		'std' => '#e26666',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Menu Dropdown Background Color', 'MA8'),
		'desc' => __('Choose a color for menu dropdown background. #9e4342 color selected by default.', 'MA8'),
		'id' => 'menu_bg_colorpicker',
		'std' => '#9e4342',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Footer Social Icon Color', 'MA8'),
		'desc' => __('Choose a color for footer social icons. #e26666 color selected by default.', 'MA8'),
		'id' => 'footer_icon_colorpicker',
		'std' => '#e26666',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Favicon Uploader', 'MA8'),
		'desc' => __('Upload your favicon.', 'MA8'),
		'id' => 'favicon',
		'type' => 'upload');




	$options[] = array(
		'name' => __('Social', 'MA8'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Enable Social Links', 'MA8'),
		'desc' => __('Switch social links ON or OFF. Switch it ON by selecting this checkbox.', 'MA8'),
		'id' => 'social_switch',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Facebook Url', 'MA8'),
		'desc' => __('Enter your facebook page/profile url', 'MA8'),
		'id' => 'wpg_social_facebook',
		'std' => '#',
		'type' => 'text',
		'class' => 'hidden'
		);

	$options[] = array(
		'name' => __('Twitter Username', 'MA8'),
		'desc' => __('Enter Twitter username without @', 'MA8'),
		'id' => 'wpg_social_twitter',
		'std' => '#',
		'type' => 'text',
		'class' => 'hidden'
		);

	$options[] = array(
		'name' => __('Google+ Url', 'MA8'),
		'desc' => __('Enter your Google+ page/profile url', 'MA8'),
		'id' => 'wpg_social_googleplus',
		'std' => '#',
		'type' => 'text',
		'class' => 'hidden'
		);




	$options[] = array(
		'name' => __('Slider', 'MA8'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Enable Slider', 'MA8'),
		'desc' => __('Switch slider ON or OFF. Switch it ON by selecting this checkbox.', 'MA8'),
		'id' => 'slider_switch',
		'type' => 'checkbox');

	if ( $options_categories ) {
	$options[] = array(
		'name' => __('Select a Category', 'MA8'),
		'desc' => __('Select a category for the slider. Three random posts from the selected category will be displayed on the front page as slides. The selected category will automatically be excluded from latest posts on the front page.', 'MA8'),
		'id' => 'slider_category',
		'type' => 'select',
		'class' => 'hidden',
		'options' => $options_categories);
	}

	$options[] = array(
		'name' => __('Slides Quantity', 'MA8'),
		'desc' => __('Select the amount of slides to display on homepage. Default is set to three.', 'MA8'),
		'id' => 'slides_quantity',
		'std' => '3',
		'type' => 'radio',
		'class' => 'hidden',
		'options' => $slides_number);




	$options[] = array(
		'name' => __('Front Page', 'MA8'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Enable Latest Posts', 'MA8'),
		'desc' => __('Check here to enable latest posts box.', 'MA8'),
		'id' => 'latest_posts_switch',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Title', 'MA8'),
		'desc' => __('Enter title to replace the default "Latest Posts".', 'MA8'),
		'id' => 'latest_posts_title',
		'std' => __('Latest Posts','MA8'),
		'type' => 'text',
		'class' => 'hidden'
		);

	$options[] = array(
		'name' => __('Number of Posts under Latest Posts', 'MA8'),
		'desc' => __('Select the number of posts you want to display under latest posts on the front-page.', 'MA8'),
		'id' => 'latest_posts_onfront',
		'type' => 'select',
		'std' => '3',
		'options' => array( '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20')
		);

	if ( $options_pages ) {
	$options[] = array(
		'name' => __('Select Blog Posts Page', 'MA8'),
		'desc' => __('This page will be linked to the "all posts" button on the front page.', 'MA8'),
		'id' => 'blog_posts_page',
		'type' => 'select',
		'class' => 'hidden',
		'options' => $options_pages);
	}

	$options[] = array(
		'name' => __('Posts Button Text', 'MA8'),
		'desc' => __('Enter text to replace the default "All Posts".', 'MA8'),
		'id' => 'latest_posts_button_text',
		'std' => __('All Posts','MA8'),
		'type' => 'text',
		'class' => 'hidden'
		);

	$options[] = array(
		'name' => __('Enable Top Authors', 'MA8'),
		'desc' => __('Check here to enable top authors box.', 'MA8'),
		'id' => 'author_box_switch',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Title', 'MA8'),
		'desc' => __('Enter title to replace the default "Top Authors"', 'MA8'),
		'id' => 'top_authors_title',
		'std' => __('Top Authors','MA8'),
		'type' => 'text',
		'class' => 'hidden'
		);

	$options[] = array(
		'name' => __('Number of Authors under Top Authors', 'MA8'),
		'desc' => __('Select the number of authors you want to display under top authors on the front-page.', 'MA8'),
		'id' => 'top_authors_onfront',
		'type' => 'select',
		'std' => '3',
		'options' => array( '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20')
		);

	if ( $options_pages ) {
	$options[] = array(
		'name' => __('Select Authors List Page', 'MA8'),
		'desc' => __('This page will be linked to the "more info" button on the front page.', 'MA8'),
		'id' => 'author_list_page',
		'type' => 'select',
		'class' => 'hidden',
		'options' => $options_pages);
	}

	$options[] = array(
		'name' => __('Authors Button Text', 'MA8'),
		'desc' => __('Enter text to replace the default "More Info".', 'MA8'),
		'id' => 'top_authors_button_text',
		'std' => __('More Info','MA8'),
		'type' => 'text',
		'class' => 'hidden'
		);
	
	$options[] = array(
		'name' => __('Enable Footer Widgets', 'MA8'),
		'desc' => __('Check here to enable footer widgets box.', 'MA8'),
		'id' => 'footer_widgets',
		'std' => '0',
		'type' => 'checkbox');




	$options[] = array(
		'name' => __('Extras', 'MA8'),
		'type' => 'heading');

	
	$options[] = array(
		'name' => __('Enable Meta boxes - Single Post Page', 'MA8'),
		'desc' => __('Check here to enable meta boxes on single post view.', 'MA8'),
		'id' => 'single_post_meta_switch',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Enable Meta boxes - Archive Pages', 'MA8'),
		'desc' => __('Check here to enable meta boxes on archive pages.', 'MA8'),
		'id' => 'archive_meta_switch',
		'std' => '1',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => __('Enable Author Info Box on Single Posts', 'MA8'),
		'desc' => __('Check here to enable author info box on single posts.', 'MA8'),
		'id' => 'author_info_box_switch',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Enable Editor Style', 'MA8'),
		'desc' => __('Check here to enable editor style. It includes the front-end styles into the post editor screen.', 'MA8'),
		'id' => 'editor_style_switch',
		'std' => '0',
		'type' => 'checkbox');

	// $options[] = array(
	// 	'name' => __('Number of Posts on Author Archive', 'MA8'),
	// 	'desc' => __('Select the number of posts to display per page for an author archive.', 'MA8'),
	// 	'id' => 'author_archive_posts',
	// 	'type' => 'select',
	// 	'std' => '10',
	// 	'options' => array( '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20')
	// 	);
	

	return $options;
}