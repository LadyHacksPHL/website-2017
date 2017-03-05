<?php
/**
 * Template part for displaying Sponsor repeating fields in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package LadyHacks
 */

?>

<div class="entry-content">
	<?php 
		if( have_rows('sponsor_group') ) {
			// echo "<div class='sponsor-group'>";
			while( have_rows('sponsor_group') ): the_row();
				$cat = get_sub_field('sponsor_category')[value];
				$catFriendly = get_sub_field('sponsor_category')[label];
				$catCustom = get_sub_field('custom_sponsor_category');
				$sponsor = get_sub_field('sponsor');

				if ($cat=='other' AND $catCustom!=NULL) $header = $catCustom;
				elseif ($cat=='other' AND $catCustom==NULL) $header = "Other folks";
				else $header = $catFriendly;

				echo "<h3>$header Sponsors</h2>";

				if( have_rows('sponsor') ) {
					while( have_rows('sponsor') ): the_row();
						$sponsor = get_sub_field('name');
						$logo = get_sub_field('logo');
						$logoURL = $logo[url];
						$website = get_sub_field('website');
						$about = get_sub_field('about');

						echo "<ul class='sponsor-group sponsor-group--$cat'>";
							echo "<li class='sponsor'>";
								echo "<img src='$logoURL' alt='$sponsor Logo' />";
								echo "<h4>$sponsor</h4>";
								echo "<p>$about</p>";
								echo "<a href='$website'>Visit $sponsor's website</a>";
							echo "</li>";
					echo "</ul>";
					endwhile;
				} // Check to see if there are Sponsor rows
			endwhile;
	} // Check to see if there are Sponsor Group rows
?>
</div><!-- .entry-content
 -->