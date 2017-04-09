<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package LadyHacks
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ladyhacks' ); ?></a>
	<div class="header-container">
		<header id="masthead" class="site-header" role="banner">
			<div class="site-branding">
			<?php
				$home_url = esc_url(home_url('/'));
				$site_title = get_bloginfo( 'name' );
				$logo = file_get_contents('SVGs/inline-logo.svg', true);

				echo "<h1 class='site-logo'><a href='$home_url' rel='home'>$logo</a></h1>";
			?>
			</div><!-- .site-branding -->
			<?php 
				$registration_url = '"'.get_field('register_link', 'option').'"';

				echo "<button class='registration_link' onclick='location.href=$registration_url' type='button'>";
					echo "Register";
				echo "</button>";
			?><!-- register button -->

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php 
					$hamburger_icon = file_get_contents('SVGs/hamburger.svg', true);
					echo "$hamburger_icon";
					// esc_html_e( 'Menu', 'ladyhacks' ); 
				?></button>

				<?php wp_nav_menu( 
					array( 
						'theme_location' => 'menu-1', 
						'menu_id' => 'primary-menu' ) 
					); 
				?>
			</nav><!-- #site-navigation -->
		</header>
		
		<?php 
			$intro_text = get_field('intro_text', 'option');
			$intro_image = get_field('intro_image', 'option');
			$intro_image_url = $intro_image['url'];
			$intro_image_width = $intro_image['width'];
			$intro_image_height = $intro_image['height'];
			$intro_image_caption = $intro_image['caption'];

			if ( is_home() || is_front_page() ) {
				echo "<div class='site-intro'>$intro_text</div>";
			}
			else {
				echo "<p class='site-title'><a href='$home_url' rel='home'>$site_title</a></p>";
			}
		?>
	</div>	<!-- .header-container -->

	<div id="content" class="site-content">
