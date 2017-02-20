		<footer class="main">
			<div class="footer-wrapper">
				<div class="copyright">
					<p><?php _e('Copyright','MA8'); ?> &copy; <?php echo date( 'Y' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e('copyright','MA8'); ?>"><?php bloginfo('name'); ?></a>. <?php _e('All rights reserved.','MA8'); ?></p>
				</div>
				<?php if(of_get_option('social_switch') == 1) :?>
				<div class="social">
	                <ul>
	                    <?php if( of_get_option('wpg_social_facebook') != '') : ?>
			    		<li><a href="<?php echo of_get_option('wpg_social_facebook'); ?>" title="<?php bloginfo( 'name' ); ?> <?php _e('on Facebook','MA8'); ?>"><i class="fui-facebook"></i></a></li>
			    		<?php endif; ?>
			    		<?php if( of_get_option('wpg_social_twitter') != '') : ?>
			    		<li><a href="https://twitter.com/<?php echo of_get_option('wpg_social_twitter'); ?>" title="<?php bloginfo( 'name' ); ?> <?php _e('on Twitter','MA8'); ?>"><i class="fui-twitter"></i></a></li>
			    		<?php endif; ?>
			    		<?php if( of_get_option('wpg_social_googleplus') != '') : ?>
			    		<li><a href="<?php echo of_get_option('wpg_social_googleplus'); ?>" title="<?php bloginfo( 'name' ); ?> <?php _e('on Googleplus','MA8'); ?>"><i class="fui-googleplus"></i></a></li>
			    		<?php endif; ?>
	                </ul>
	            </div>
	        	<?php endif; ?>
			</div>
		</footer>
	<?php wp_footer(); ?>
	</body>
</html>