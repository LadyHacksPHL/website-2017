<?php get_header(); ?>
<div class="content-container">
			<div class="content-wrapper">
				<section class="articles">
<?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<article>
	<h2><?php the_title(); ?></h2>
	<?php the_content(); ?>
	<?php wp_link_pages(); ?>
	<div style="clear: both;"></div>
	<?php comments_template(); ?>
<?php endwhile; else: ?>
	<p><?php _e('There are no posts or pages to display','MA8'); ?>.</p>
</article>
<?php endif; ?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>