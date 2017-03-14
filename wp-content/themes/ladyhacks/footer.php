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

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php 
			$map = get_field('map', 'option');
			$form = get_field('contact_form', 'option');
			echo $form;
			print_r($location);

			$lat = $map['lat'];
			$lng = $map['lng'];

			if( !empty($location) ) {
				echo "<div class='acf-map'>";
					echo "<div class='marker' data-lat='$lat' data-lng='$lng'></div>";
				echo "</div>";
			} 

		?>
		<div class="site-info">
			
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

