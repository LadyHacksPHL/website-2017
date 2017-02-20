<?php get_header(); ?>
<div class="content-container">
	<div class="content-wrapper">
		<section class="error404">
			<h1><?php _e('OOPS!!!','MA8'); ?></h1>
			<p><?php _e('Looks like what you are looking for does not exist.','MA8'); ?></p>
			<p><?php _e('You can either go back to the homepage','MA8'); ?></p>
			<div class="back-home">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e('Back Home','MA8'); ?>" class="btn btn-huge btn-embossed btn-block btn-danger"><?php _e('Back Home','MA8'); ?></a>
			</div>
			<p><strong><?php _e('OR','MA8'); ?></strong></p>
			<p><?php _e('Perform another search below.','MA8'); ?></p>
			<div class="error-search">
			<?php get_search_form(); ?>
			</div>
		</section>
	</div>
</div>
<?php get_footer(); ?>