<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php if(of_get_option('favicon')) :?>
		<link rel="shortcut icon" href="<?php echo esc_url(of_get_option('favicon')); ?>">
		<?php endif; ?>
		<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
		<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<![endif]-->
	      <?php wp_head(); ?>
	</head>
	  <body <?php body_class(); ?>>

		<!--[if lt IE 7]>
		    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="<?php esc_url('http://browsehappy.com/') ?>">upgrade your browser</a> or <a href="<?php esc_url('http://www.google.com/chromeframe/?redirect=true') ?>">activate Google Chrome Frame</a> to improve your experience.</p>
		    <![endif]-->

		    <div class="header-container">
		    	<header class="header-wrapper">
		    		<div class="title-wrapper">
		    			<?php if(of_get_option('logo')) : ?>
		    				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( bloginfo( 'name' ) ); ?>"><img src="<?php echo of_get_option('logo'); ?>" alt="<?php bloginfo( 'name' ); ?>"></a>
		    			<?php elseif( is_page('Home') ) : ?>
		    			<h1 class="title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( bloginfo( 'name' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		    			<p id="desc"><?php bloginfo( 'description' ); ?></p>
		    		<?php else : ?>
		    		<div class="title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( bloginfo( 'name' ) ); ?>"><?php bloginfo( 'name' ); ?></a></div>
		    		<p id="desc"><?php bloginfo( 'description' ); ?></p>
		    	<?php endif; ?>
		    </div>
		    <div class="nav-wrapper">
		    	<nav class="main-nav">
		    		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '' ) ); ?>
		    	</nav>
		    	<?php if(of_get_option('social_switch') == 1) { ?>
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
		    	<?php } ?>
		    </div>
		    <div style="clear: both;"></div>
		</header><!-- /header -->
	</div>
		<?php if(!is_front_page()) : ?>

		<?php if ( function_exists('yoast_breadcrumb') ) { ?>
		<div class="breadcrumbs">
			<?php yoast_breadcrumb('<div class="breadcrumbs-wrapper">','</div>'); ?>
		</div>
		<?php } ?>

	<?php endif; ?>