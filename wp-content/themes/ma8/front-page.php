<?php get_header(); ?>

<?php if(get_option('page_on_front')) {

	get_template_part( 'template','front' );

} else {

	get_template_part( 'template','blog' );

} ?>

<?php get_footer(); ?>