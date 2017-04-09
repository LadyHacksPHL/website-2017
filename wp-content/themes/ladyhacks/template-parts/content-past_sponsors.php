<?php
/**
 * Template part for displaying Past Sponsor content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Alex Lash Design
 */

?>

<?php
	echo "<section class='past-sponsors'>";
		echo "<h2>Past Sponsors</h2>";
		
		if( have_rows('sponsor_list') ) {
			while( have_rows('sponsor_list') ): the_row();
			$year = get_sub_field('year');
			$list = get_sub_field('list');

			echo "<div class='sponsors-$year'>";
				echo "<h3>Thank you to our $year sponsors:</h3>";
				echo $list;
			echo "</div>";
			endwhile;
		}
	echo "</section>";
?>