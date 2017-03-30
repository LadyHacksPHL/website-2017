<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package LadyHacks
 */

?>


</body>
</html>

	</div><!-- #content -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>

	<!-- HELLO -->
		<?php 
			$location = get_field('location', 'option');
			$form = get_field('contact_form', 'option');
	
			$lat = $location['lat'];
			$lng = $location['lng'];
	
			echo $form;
			if( !empty($location) ) {
				echo "<div class='acf-map'>";
					echo "<div class='marker' data-lat='$lat' data-lng='$lng'></div>";
				echo "</div>";
			} 
	
		?>
		<footer class="site-footer">
			<div class="site-branding">
			<?php
				$home_url = esc_url(home_url('/'));
				$site_title = get_bloginfo( 'name' );
				$logo = get_field('logo', 'option');
				$logo_url = $logo[url];

				echo "<h1 class='site-logo'><a href='$home_url' rel='home'><img src='$logo_url' alt='$site_title' /></a></h1>";

				// $description = get_bloginfo( 'description', 'display' );
				// if ( $description || is_customize_preview() ) {
				// 	echo "<p class='site-description'>$description</p>";
				// }
			?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'ladyhacks' ); ?></button>
				<?php wp_nav_menu( 
					array( 
						'theme_location' => 'menu-1', 
						'menu_id' => 'primary-menu' ) 
					); 
				?>
			</nav><!-- #site-navigation -->

			<?php 
				$registration_url = '"'.get_field('register_link', 'option').'"';

				echo "<button class='registration_link' onclick='location.href=$registration_url' type='button'>";
					echo "Register";
				echo "</button>";
			?><!-- register button -->
			
		</footer><!-- .site-info --><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

