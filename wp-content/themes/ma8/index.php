<?php get_header(); ?>
<div class="content-container">
			<div class="content-wrapper">
				<section class="articles">
<?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php get_template_part('content', 'post'); ?>
<?php endwhile; else: ?>
	<p><?php _e('There are no posts or pages to display','MA8'); ?>.</p>
<?php endif; ?>
	<div class="post-nav">
		<?php MA8_pagination(); ?>
	</div>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>