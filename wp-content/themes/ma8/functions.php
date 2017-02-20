<?php

/* 
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */
 
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}

// MA8 Content Width
if ( ! isset( $content_width ) ) $content_width = 820;


// MA8 Styles
function MA8_theme_styles() {

	wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Lato:400,700,700italic,900,400italic,300' );

	wp_enqueue_style( 'main', get_template_directory_uri() . '/css/style.css' );

	wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/custom-style.css' );
		$typography = of_get_option('example_typography');
        $header_bg_color = of_get_option('header_bg_colorpicker');
        $menu_bg_color = of_get_option('menu_bg_colorpicker');
        $footer_icon_color = of_get_option('footer_icon_colorpicker');
        $link_color = of_get_option('link_colorpicker');
        $link_hover_color = of_get_option('link_hover_colorpicker');
        $custom_css = "
		        body{
		        	font-size:".$typography['size'].";
		        	color:".$typography['color'].";
		        }
                .header-container{
                        background-color:{$header_bg_color};
                }
                .header-container .header-wrapper .nav-wrapper nav ul ul{
                	background-color:{$menu_bg_color};
                }
                .header-container .header-wrapper .nav-wrapper nav > ul > li > ul:before{
                	border-color: transparent transparent {$menu_bg_color} transparent;
                }
                .header-container .header-wrapper .nav-wrapper nav > ul > li:last-child > ul:before{
                	border-color: transparent transparent {$menu_bg_color} transparent;
                }
                .main .footer-wrapper .social ul li a {
					color:{$footer_icon_color};
				}
				a{
					color:{$link_color};
				}
				a:hover{
					color:{$link_hover_color};
				}
				.author-container .author-wrapper .authors ul li a:hover, .author-container .author-wrapper .authors ol li a:hover{
					color:{$link_color};
				}
				h1 a:hover, .h1 a:hover, h2 a:hover, .h2 a:hover, h3 a:hover, .h3 a:hover, h4 a:hover, .h4 a:hover, h5 a:hover, .h5 a:hover, h6 a:hover, .h6 a:hover{
					color:{$link_color};
				}
				.search-query:focus {
					border: 2px solid {$link_color};
				}
				.comments #respond form .form-submit input {
					background-color: {$link_color};
				}
				.author-list-page .author-wrapper .head .author-number {
					color: {$link_color};
				}
				input[type=submit],.btn.btn-danger{
					background-color: {$link_color};
				}
				input[type=submit]:hover,.btn.btn-danger:hover, .btn.btn-danger:focus, .btn-group:focus .btn.btn-danger.dropdown-toggle {
						background-color: {$link_hover_color};
				}
				.comments #respond form .form-submit input:hover {
					background-color: {$link_hover_color};
				}
				.content-container .content-wrapper .articles .post-nav ul li .current, .content-container .content-wrapper .articles .comment-nav ul li .current {
					background-color: {$link_color};
				}
				.content-container .content-wrapper .articles .sticky:before {
					background-color: {$link_color};
				}
				.bypostauthor img {
					border: 6px solid {$link_color};
				}
                ";
    wp_add_inline_style( 'custom-style', $custom_css );

	wp_enqueue_style( 'normalize', get_template_directory_uri() . '/css/normalize.css' );
	
	wp_register_style( 'flexslider', get_template_directory_uri() . '/css/flexslider.css' );
	if(is_front_page()) {
		wp_enqueue_style( 'flexslider' );
	}
	
}


function MA8_theme_js() {
	wp_register_script( 'flexslider', get_template_directory_uri() . '/js/flexslider.js', array('jquery'), '', true );
	if ( is_front_page()) {
		wp_enqueue_script( 'flexslider' );
		wp_enqueue_script( 'flex', get_template_directory_uri() . '/js/flex.js', array('jquery'), '', true );
	}
	wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array('jquery'), '', true );
	wp_enqueue_script( 'comment-reply', 'comment-reply.js', array('jquery'), '', false );
}

add_action( 'wp_enqueue_scripts', 'MA8_theme_js' );
add_action( 'wp_enqueue_scripts', 'MA8_theme_styles' );

add_action( 'after_setup_theme', 'MA8_setup' );
function MA8_setup() {

	// Enable theme translations
	load_theme_textdomain( 'MA8', get_template_directory() . '/lang' );

	// MA8 Custom Menus
	add_theme_support( 'menus' );
	register_nav_menu( 'primary', __('Primary Menu','MA8') );

	// MA8 Feed links
	add_theme_support( 'automatic-feed-links' );

	if(of_get_option('editor_style_switch') == 1){
		add_editor_style( 'custom-editor-style.css' );
	}

	//MA8 Post Formats
	// add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'  ) );

	//MA8 Thumbnails
	add_theme_support( 'post-thumbnails' ); 
	add_image_size( 'front-page-thumb', 350, 250, true ); // 350 pixels wide by 250 pixels tall, crop mode
	add_image_size( 'single-page-thumb', 820, 380, true ); // 820 pixels wide by 380 pixels tall, crop mode
	add_image_size( 'slider-image', 1500, 550 ); // unlimited wide by 550 pixels tall, crop mode
}


function MA8_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'MA8' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'MA8_wp_title', 10, 2 );



// MA8 Sidebars
function MA8_widgets_init() {
	
	register_sidebar( array(
			'name'				=>	__( 'Sidebar', 'MA8' ),
			'id'				=>	'main_sidebar',
			'description'		=>	__( 'Displays on the side of single post and page.', 'MA8' ),
			'before_widget'		=>	'<div id="%1$s" class="widget %2$s">',
			'after_widget'		=>	'</div>',
			'before_title'		=>	'<h4 class="widget-title">',
			'after_title'		=>	'</h4>'
		) );

	register_sidebar( array(
			'name'				=>	__( 'Left Footer', 'MA8' ),
			'id'				=>	'footer_left',
			'description'		=>	__( 'Displays in the bottom left of footer.', 'MA8' ),
			'before_widget'		=>	'<li id="%1$s" class="widget %2$s">',
			'after_widget'		=>	'</li>',
			'before_title'		=>	'<h2 class="widget-title">',
			'after_title'		=>	'</h2>'
		) );

	register_sidebar( array(
			'name'				=>	__( 'Middle Footer', 'MA8' ),
			'id'				=>	'footer_middle',
			'description'		=>	__( 'Displays in the middle of footer.', 'MA8' ),
			'before_widget'		=>	'<li id="%1$s" class="widget %2$s">',
			'after_widget'		=>	'</li>',
			'before_title'		=>	'<h2 class="widget-title">',
			'after_title'		=>	'</h2>'
		) );

	register_sidebar( array(
			'name'				=>	__( 'Right Footer', 'MA8' ),
			'id'				=>	'footer_right',
			'description'		=>	__( 'Displays in the bottom right of footer.', 'MA8' ),
			'before_widget'		=>	'<li id="%1$s" class="widget %2$s">',
			'after_widget'		=>	'</li>',
			'before_title'		=>	'<h2 class="widget-title">',
			'after_title'		=>	'</h2>'
		) );
		
}
add_action( 'widgets_init', 'MA8_widgets_init' );



if ( ! function_exists( 'MA8_comment' ) ) :
function MA8_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'MA8' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'MA8' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-body">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 120;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 120;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s%2$s', 'MA8' ),
							sprintf( '<cite class="fn">%s</cite></div>', get_comment_author_link() ),
							sprintf( '<div class="comment-meta commentmetadata"><a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'MA8' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'MA8' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'MA8' ); ?></em>
					<br />
				<?php endif; ?>


			<div class="comment-content"><?php comment_text(); ?></div>

			<?php if ( !$comment->comment_approved == '0' ) : ?>
			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'MA8' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
			<?php endif; ?>

		</div><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for MA8_comment()


function MA8_pagination() {

		global $wp_query;
		
		$big = 999999999;
		
		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'prev_text'    => __('&larr;','MA8'),
			'next_text'    => __('&rarr;','MA8'),
			'type'	=>	'list',
			'total' => $wp_query->max_num_pages
		) );
}


function MA8_search_form( $form ) {
    $form = '<form class="form-search" role="search" method="get" id="searchform" action="' . esc_url( home_url( '/' ) ) . '" >
    <div>
    <input type="text" class="search-query" placeholder="Search..." value="' . get_search_query() . '" name="s" id="s" style="
    	"/>
    <input type="submit" style="display:none;" id="searchsubmit" value="'. esc_attr__( 'Search' ) .'" />
    </div>
    </form>';

    return $form;
}
add_filter( 'get_search_form', 'MA8_search_form' );


function MA8_Social_links( $contactmethods ) {
	
	$contactmethods['twitter'] = __('Twitter Profile URL','MA8');
	$contactmethods['facebook'] = __('Facebook Profile URL','MA8');
	$contactmethods['googleplus'] = __('Google Profile URL','MA8');
	
	return $contactmethods;
}
add_filter( 'user_contactmethods', 'MA8_social_links', 10, 1);


add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');
function optionsframework_custom_scripts() { ?>
<script type="text/javascript">
jQuery(document).ready(function() {

    jQuery('#slider_switch').click(function() {
        jQuery('#section-slides_quantity').fadeToggle(200);
        jQuery('#section-slider_category').fadeToggle(200);
    });

    if (jQuery('#slider_switch:checked').val() !== undefined) {
        jQuery('#section-slides_quantity').show();
        jQuery('#section-slider_category').show();
    }

    jQuery('#latest_posts_switch').click(function() {
        jQuery('#section-blog_posts_page').fadeToggle(200);
        jQuery('#section-latest_posts_title').fadeToggle(200);
        jQuery('#section-latest_posts_button_text').fadeToggle(200);
    });

    if (jQuery('#latest_posts_switch:checked').val() !== undefined) {
        jQuery('#section-blog_posts_page').show();
        jQuery('#section-latest_posts_title').show();
        jQuery('#section-latest_posts_button_text').show();
    }

    jQuery('#author_box_switch').click(function() {
        jQuery('#section-author_list_page').fadeToggle(200);
        jQuery('#section-top_authors_title').fadeToggle(200);
        jQuery('#section-top_authors_button_text').fadeToggle(200);
    });

    if (jQuery('#author_box_switch:checked').val() !== undefined) {
        jQuery('#section-author_list_page').show();
        jQuery('#section-top_authors_title').show();
        jQuery('#section-top_authors_button_text').show();
    }

    jQuery('#social_switch').click(function() {
        jQuery('#section-wpg_social_facebook').fadeToggle(200);
        jQuery('#section-wpg_social_twitter').fadeToggle(200);
        jQuery('#section-wpg_social_googleplus').fadeToggle(200);
    });

    if (jQuery('#social_switch:checked').val() !== undefined) {
        jQuery('#section-wpg_social_facebook').show();
        jQuery('#section-wpg_social_twitter').show();
        jQuery('#section-wpg_social_googleplus').show();
    }

});
</script>
<?php }


// Theme Options sidebar
add_action( 'optionsframework_after','MA8_support_sidebar' );
function MA8_support_sidebar() { ?>
	<div id="optionsframework-sidebar">
		<div class="metabox-holder">
			<div class="postbox">
				<h3><?php _e('Support','MA8') ?></h3>
					<div class="inside">
                        <p><?php _e('"<strong>readme.txt</strong>" file is helpful','MA8'); ?>.</p>
                        <p><?php _e('For support and bug reports:','MA8') ?></p>
                        <ul>
                        	<li><a href="<?php esc_url( home_url() ); ?>/ma8/" title=""><?php _e('MA8 Support Page','MA8') ?></a></li>
                        	<li><a href="http://wordpress.org/support/theme/ma8"><?php _e('WordPress support forum','MA8') ?></a>.</li>
                    	</ul>
                        <p><?php _e('If you like this theme, I will appreciate if you can rate / review it on WordPress','MA8') ?>.</p>
                        <ul>
                            <li><a href="hhttp://wordpress.org/support/view/theme-reviews/ma8"><?php _e('Rate MA8 at WordPress.org','MA8') ?></a></li>
                        </ul>
                         <p><?php _e('I will be more than happy to help you. So please let me know about any problem you face by using the support links above','MA8') ?>.</p>
                         <p><?php _e('Before leaving bad rating or review please make sure you use one of the above methods for reporting issues and give me some time to fix those','MA8') ?>.</p>
					</div>
			</div>
		</div>
	</div>
<?php }


function MA8_latest_posts() { ?>

	<section class="posts">
		<div class="article-wrapper">
		
			<?php 

			$lpof = of_get_option('latest_posts_onfront');

			$args = array(
				'post_type' => 'post',
				'posts_per_page' => $lpof,
				'post__not_in' => get_option( 'sticky_posts' )
			);
			$the_query = new WP_Query( $args );
			?>
			
			<?php if ( $the_query->have_posts() ) : while ($the_query->have_posts() ) : $the_query->the_post(); ?>

				<article>
					<figure>
						<a href="<?php the_permalink(); ?>">
						<?php 
							if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'front-page-thumb' );
							} 
						 ?>
						</a>
					</figure>
					<h2><a href="<?php the_permalink(); ?>" title="<?php esc_attr(the_title()); ?>"><?php the_title(); ?></a></h2>
				</article>
			<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php else: ?>

				<p><?php _e('There are no posts to display','MA8'); ?>.</p>

			<?php endif; ?>
		</div>
	</section>
	<?php 

			$count_posts = wp_count_posts();
			$published_posts = $count_posts->publish;
			$result = $published_posts;

			if( $result > 3 ) {
	 ?>
	<div class="nav-button">

		<?php 
		$blog_page_id = of_get_option('blog_posts_page');
		$blog_page_name = get_post($blog_page_id)->post_name; 
		$blog_page_url = get_permalink($blog_page_id);
		?>

		<a href="<?php echo $blog_page_url; ?>" title="<?php echo $blog_page_name; ?>" class="btn btn-huge btn-embossed btn-block btn-danger"><?php $text_latest_posts_button = of_get_option('latest_posts_button_text');
	echo $text_latest_posts_button;
	 ?></a>
	</div>
	<?php }}


function MA8_latest_posts_slider() {
?>
	<section class="posts">
		<div class="article-wrapper">
		
			<?php 
			$slider_cat_ex = '-' . of_get_option('slider_category');
			$lpof = of_get_option('latest_posts_onfront');
			$args = array(
				'post_type' => 'post',
				'cat'	=> $slider_cat_ex,
				'posts_per_page' => $lpof,
				'post__not_in' => get_option( 'sticky_posts' )
			);
			$the_query = new WP_Query( $args );
			
			?>
			
			<?php if ( $the_query->have_posts() ) : while ($the_query->have_posts() ) : $the_query->the_post(); ?>
				<article>
					<figure>
						<a href="<?php the_permalink(); ?>">
						<?php 
							if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'front-page-thumb' );
							} 
						 ?>
						</a>
					</figure>
					<h2><a href="<?php the_permalink(); ?>" title="<?php esc_attr(the_title()); ?>"><?php the_title(); ?></a></h2>
				</article>
			<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php else: ?>

			<p><?php _e('There are no posts to display','MA8'); ?>.</p>

			<?php endif; ?>
		</div>
	</section>
	<?php 

		if(of_get_option('slider_category')){
			$id = of_get_option('slider_category');
			$category = get_category($id);
			$count = $category->category_count;
			$count_posts = wp_count_posts();
			$published_posts = $count_posts->publish;
			$result = $published_posts - $count;

			if( $result > 3 || $count > 3 ) {
	 ?>
	<div class="nav-button">

		<?php 
		$blog_page_id = of_get_option('blog_posts_page');
		$blog_page_name = get_post($blog_page_id)->post_name; 
		$blog_page_url = get_permalink($blog_page_id);
		?>

		<a href="<?php echo $blog_page_url; ?>" title="<?php echo $blog_page_name; ?>" class="btn btn-huge btn-embossed btn-block btn-danger"><?php $text_latest_posts_button = of_get_option('latest_posts_button_text');
	echo $text_latest_posts_button;
	 ?></a>
	</div>
	<?php
}}} ?>