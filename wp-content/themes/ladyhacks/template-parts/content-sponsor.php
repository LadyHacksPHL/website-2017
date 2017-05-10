<?php
/**
 * Template part for displaying Sponsor repeating fields in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package LadyHacks
 */

	if( have_rows('sponsor_group') ) {
		echo "<section class='current-sponsors'>";
			echo "<ul class='sponsor-group sponsor-group--$cat gallery gallery-columns-1'>";
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
								echo "<div class='sponsor-content'>";
									echo "<div class='logo-container'>";
										echo "<img src='$logoURL' alt='$sponsor Logo' />";
									echo "</div>";
										echo "<h4>$sponsor</h4>";
										echo "<h5>$header</h5>";
									echo "$about";
									echo "<p><a class='sponsor-website' href='$website'>Visit $sponsor's website</a></p>";
								echo "</div>";
							echo "</li>";
					endwhile;
				} // Check to see if there are Sponsor rows
			endwhile;
		echo "</ul>";
	echo "</section>";
} // Check to see if there are Sponsor Group rows


// Custom Stuff
if( have_rows('custom_page_content') ) get_template_part( 'template-parts/content', 'page_builder' );

// Past Sponsors
if( have_rows('sponsor_list') ) get_template_part( 'template-parts/content', 'past_sponsors' );