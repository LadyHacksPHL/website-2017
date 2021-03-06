<?php
/**
 * Description: BuddyPress Page
 * @package Voyage
 * @subpackage Voyage
 * @since 1.3.0
 */
get_header(); ?>
<div id="content" role="main" class="<?php echo voyage_bbp_class(); ?>">
<?php
	while ( have_posts() ) {
		the_post();
		get_template_part( 'content', 'page' );
	}
?>
</div>
<?php get_sidebar('bbpress'); ?>	
<?php get_footer(); ?>
