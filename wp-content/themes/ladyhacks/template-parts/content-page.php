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
	<header class="entry-header">
		<?php 
			the_title( '<h2 class="entry-title">', '</h2>' ); 
			the_content(); 
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			// Sponsors Repeater Field Group
			if( have_rows('sponsor_group') ) get_template_part( 'template-parts/content', 'sponsor' );

			// People Repeater Field Group
			if( have_rows('group') ) get_template_part( 'template-parts/content', 'people' );

			// wp_link_pages( array(
			// 	'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ladyhacks' ),
			// 	'after'  => '</div>',
			// ) );
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
