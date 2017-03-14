<?php
/**
 * Template part for displaying People repeating fields in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package LadyHacks
 */

	if( have_rows('group') ) {
		// echo "<div class='sponsor-group'>";
		while( have_rows('group') ): the_row();
			$cat = get_sub_field('type_of_group')[value];
			$catFriendly = get_sub_field('type_of_group')[label];
			// $catCustom = get_sub_field('custom_sponsor_category');
			$person = get_sub_field('sponsor');

			if ($cat=='other' AND $catCustom!=NULL) $header = $catCustom;
			elseif ($cat=='other' AND $catCustom==NULL) $header = "Other folks";
			else $header = $catFriendly;

			echo "<h3>$header</h2>";

			if( have_rows('person') ) {
				while( have_rows('person') ): the_row();
					$person = get_sub_field('name');
					$headshot = get_sub_field('headshot');
					$headshotURL = ( $headshot == NULL ? "hello!" : $headshot[url] );
					$about = get_sub_field('bio');
					$headshotAlt = $headshot[alt];

					// print_r();


					echo "<ul class='sponsor-group sponsor-group--$cat'>";
						echo "<li class='sponsor'>";
							echo ( $headshot == NULL ? "No Pic!" : "<img src='$headshotURL' alt='$headshotAlt' />" );
							echo "<h4>$person</h4>";
							echo "<p>$about</p>";
							// echo "<a href='$website'>Visit $sponsor's website</a>";
						echo "</li>";
				echo "</ul>";
				endwhile;
			} // Check to see if there are Individual rows
		endwhile;
} // Check to see if there are Group rows