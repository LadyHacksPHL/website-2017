<?php
/**
 * Template part for displaying Sponsor repeating fields in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package LadyHacks
 */

	if( have_rows('sponsor_group') ) {
		echo "<ul class='sponsor-group sponsor-group--$cat gallery gallery-columns-2'>";
		// echo "<div class='sponsor-group'>";
		while( have_rows('sponsor_group') ): the_row();
			$cat = get_sub_field('sponsor_category')[value];
			$catFriendly = get_sub_field('sponsor_category')[label];
			$catCustom = get_sub_field('custom_sponsor_category');
			$sponsor = get_sub_field('sponsor');

			if ($cat=='other' AND $catCustom!=NULL) $header = $catCustom;
			elseif ($cat=='other' AND $catCustom==NULL) $header = "Sponsor";
			else $header = $catFriendly;

			if( have_rows('sponsor') ) {
				while( have_rows('sponsor') ): the_row();
					$sponsor = get_sub_field('name');
					$logo = get_sub_field('logo');
					$logoURL = $logo[url];
					$website = get_sub_field('website');
					$about = get_sub_field('about');

						echo "<li class='sponsor gallery-item'>";
							echo "<img src='$logoURL' alt='$sponsor Logo' />";
							echo "<h4>$sponsor</h4>";
							echo "<h5>$header</h5>";
							echo "<p>$about</p>";
							echo "<a href='$website'>Visit $sponsor's website</a>";
						echo "</li>";
				endwhile;
			} // Check to see if there are Sponsor rows
		endwhile;
	echo "</ul>";
} // Check to see if there are Sponsor Group rows