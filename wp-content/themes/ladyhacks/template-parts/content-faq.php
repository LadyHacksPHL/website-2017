<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package LadyHacks
 */

?>
<?php
if( have_rows('question_and_answer') ) {
	echo "<section class='qa-list-container'>";
		echo "<dl class='qa-list'>";
			while( have_rows('question_and_answer') ): the_row();
				$question = get_sub_field('question');
				$answer = get_sub_field('answer');

				echo "<dt class='question qa-item'>$question</dt>";
				echo "<dd class='answer qa-item'>$answer</dd>";
			endwhile;
		echo "</dl>";
	echo "</section>";
} // Check to see if there are Group rows
?>