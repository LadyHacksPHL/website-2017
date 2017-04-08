<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package LadyHacks
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php 
			$size = 'full';
			$featuredImage = get_the_post_thumbnail(null, $size );

			if ( has_post_thumbnail() ) {
				echo "<div class='featured-image-container'>";
					echo "<div class='featured-image'>$featuredImage</div>";
				echo "</div>";
			}
		?>
	<header class="entry-header">
	<?php 
	$page_title = get_the_title(); 
	$page_classname = str_replace(' ', '-', strtolower($page_title));
	if ( !is_front_page() ) {
		echo "<h2>$page_title</h2>";
	}
	echo "</header>"; // .entry-header

	echo "<div class='entry-content page-$page_classname'>";
		// Wordpress Main Content
		echo wpautop( $post->post_content );

		// Sponsors Repeater Field Group
		if( have_rows('sponsor_group') ) get_template_part( 'template-parts/content', 'sponsor' );

		// People Repeater Field Group
		if( have_rows('group') ) get_template_part( 'template-parts/content', 'people' );

		// FAQs Repeater Field Group
		if( have_rows('question_and_answer') ) get_template_part( 'template-parts/content', 'faq' );
	?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'ladyhacks' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
