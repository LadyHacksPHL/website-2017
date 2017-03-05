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
			echo "<ul class='sponsors'>";
			while( have_rows('sponsor_group') ): the_row();
				$type = get_sub_field('sponsor_category');
				$displayTitle = get_sub_field('sponsor');
				// $link = get_sub_field('link');
				if ($type=='signature') $header = "Signature sponsors";
				if ($type=='gold') $header = "Gold sponsors";
				if ($type=='silver') $header = "Silver sponsors";
				if ($type=='other') $header = "Other sponsors";

				echo "<li class='sponsor-group sponsor-group--$type'>";
					echo "<h2 class='social-media-link' href='$link' target='_blank' title='$displayTitle'>$header</h2>";
				echo "</li>";
			endwhile;
		echo "</ul>";
	} 
?>
</div><!-- .entry-content -->
