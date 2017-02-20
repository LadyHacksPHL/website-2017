<?php
/*
Template Name: Author List
*/
get_header(); ?>

<div class="author-container author-list-page">
	<div class="author-wrapper">
		<h1 class="head"><?php _e('We have ','MA8'); ?>
			<span class="author-number">
				<?php
				$result = count( get_users(array( 'role' => 'author' ) ));
				echo $result;
				?>
			</span>
			<?php _e('awesome authors','MA8'); ?>
		</h1>
		<section class="authors">
			<ol>
				<?php
				$args = array(
					'role'		=>	'author',
					'orderby'	=>	'post_count',
					'order'		=>	'DESC',
					);
							// The Query
				$user_query = new WP_User_Query( $args );
							// User Loop
				if ( ! empty( $user_query->results ) ) {
					foreach ( $user_query->results as $user ) {						echo '<li><a href="' . get_author_posts_url($user->ID) . '"><figure>' . get_avatar( $user->ID , 200 , '', $user->display_name ) . '</figure></a><div class="author-info">';
						echo '<div class="author-name"><h2><a href="' . get_author_posts_url($user->ID) . '">' . ucfirst($user->display_name) . '</a></h2></div>';
						if($user->user_description==true){
						echo '<div class="author-desc"><p>' . $user->user_description . '</p></div>';
						}
						echo '<div class="author-post-count"><a href="' . get_author_posts_url($user->ID) . '" title="' . count_user_posts($user->ID) . __(" Posts","MA8") .'"><p>'.__('Posts:','MA8') . count_user_posts($user->ID) . '</p></a>
						</div>
						<div class="author-social-links">
										<ul>';
										if($user->facebook==true){
											echo '<li><a target="_blank" href="' . esc_url($user->facebook) . '" title="' . esc_attr($user->facebook) . '"><i class="fui-facebook"></i></a></li>';
										}
										if($user->twitter==true){
										echo '<li><a target="_blank" href="' . esc_url($user->twitter) . '" title="' . esc_attr($user->twitter) . '"><i class="fui-twitter"></i></a></li>';
										}
										if($user->googleplus==true){
						                echo '<li><a target="_blank" href="' . esc_url($user->googleplus) . '" title="' . esc_attr($user->googleplus) . '"><i class="fui-googleplus"></i></a></li>';
						            	}
						                echo '</ul>
					                </div>
						</div>
						</li>';
					}	
				} else {
					echo '<li><h3>'.__('No one found.','MA8').'</h3></li>';
				}
				?>
			</ol>
		</section>
	</div>
</div>

<?php get_footer(); ?>