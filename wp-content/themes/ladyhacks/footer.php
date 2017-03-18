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
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&sensor=true"></script> -->

	<!-- HELLO -->
		<?php 
			$location = get_field('location', 'option');
			$form = get_field('contact_form', 'option');
			// print_r($location);
	
			$lat = $location['lat'];
			$lng = $location['lng'];
	
			echo $form;
			if( !empty($location) ) {
				echo "<div class='acf-map'>";
					echo "<div class='marker' data-lat='$lat' data-lng='$lng'></div>";
				echo "</div>";
			} 
	
		?>
		<div class="site-info">
			
		</div><!-- .site-info --><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

