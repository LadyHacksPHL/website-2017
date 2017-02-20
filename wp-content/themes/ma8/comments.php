<?php if ( post_password_required() ) : ?>
	<div style="clear: both;"></div>
	<div id="comments" class="comments">
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments', 'MA8' ); ?>.</p>
	</div>
<?php return; endif; ?>

<?php if ( have_comments() ) : ?>
	<div style="clear: both;"></div>
	<div id="comments" class="comments">
		<h5 id="comments-title">
			<?php
				printf( _n( 'One Comment', '%1$s Comments', get_comments_number(), 'MA8' ),
					number_format_i18n( get_comments_number() ) );
			?>
		</h5>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		
		<?php endif; ?>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'MA8_comment' ) ); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-below">
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'MA8' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'MA8' ) ); ?></div>
		</nav>
		<?php endif; ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.' , 'MA8' ); ?></p>
		<?php endif; ?>
	</div>
	<?php endif; ?>

	<?php 

	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$custom_args = array(

		'id_form'           => 'commentform',
		'id_submit'         => 'submit',
		'title_reply'       => __( 'Leave a Reply' , 'MA8' ),
		'title_reply_to'    => __( 'Leave a Reply to %s' , 'MA8' ),
		'cancel_reply_link' => __( 'Cancel Reply' , 'MA8' ),
		'label_submit'      => __( 'Submit' , 'MA8' ),

		'comment_field' =>  '<p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="Have your say.." cols="45" rows="8" aria-required="true">' .
		'</textarea></p>',

		'must_log_in' => '<p class="must-log-in">' .
		sprintf(
		  __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
		  wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
		) . '</p>',

		'logged_in_as' => '<p class="logged-in-as">' .
		sprintf(
		__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
		  admin_url( 'profile.php' ),
		  $user_identity,
		  wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
		) . '</p>',

		'comment_notes_before' => '',

		'comment_notes_after' => '',

		'fields' => apply_filters( 'comment_form_default_fields', array(

		'author' =>
		  '<p class="comment-form-author">' .
		  '<input id="author" name="author" placeholder="Your Name *" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
		  '" size="30"' . $aria_req . ' /></p>',

		'email' =>
		  '<p class="comment-form-email">' .
		  '<input id="email" name="email" placeholder="Your Email *" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
		  '" size="30"' . $aria_req . ' /></p>',

		'url' =>
		  '<p class="comment-form-url">' .
		  '<input id="url" name="url" type="text" placeholder="Your Website" value="' . esc_attr( $commenter['comment_author_url'] ) .
		  '" size="30" /></p>'
		)
		),

	);

		echo '<div id="comments" class="comments">';
		comment_form( $custom_args ); 
		echo '</div>';

	?>