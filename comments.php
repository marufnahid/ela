<?php

if ( post_password_required() ) {
	return;
}

$is_website = false;

if ( class_exists( 'CSF' ) ) {
	$opt        = get_option( 'ela_option_data' );
	$is_website = $opt['comment_website'];
}

?>

<div id="comments" class="comments-area">

	<?php

	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );

	$fields = array();

	// enable checkbox if cookies checkbox enabled.
	if ( has_action( 'set_comment_cookies', 'wp_set_comment_cookies' ) && get_option( 'show_comments_cookies_opt_in' ) ) {
		$consent           = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
		$fields['cookies'] = '<div class="comment-form-cookies-consent col12"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
		                     '<label for="wp-comment-cookies-consent">' . esc_attr__( 'Save my name and email in this browser for the next time I comment.', 'ela' ) . '</label></div>';
		// Ensure that the passed fields include cookies consent.
		if ( isset( $args['fields'] ) && ! isset( $args['fields']['cookies'] ) ) {
			$args['fields']['cookies'] = $fields['cookies'];
		}
	}

	if ( $is_website && ! is_user_logged_in() ) {
		$fields['author'] = '<div class="comment_details_wrapper col8"><div class="row"><div class="col4"><input id="author" placeholder="' . esc_attr__( 'Name', 'ela' ) .
		                    ( $req ? '*' : '' ) . '" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
		                    '" size="30"' . $aria_req . ' /></div>';

		$fields['email'] = '<div class="col4"><input id="email" placeholder="' . esc_attr__( 'Email', 'ela' ) .
		                   ( $req ? '*' : '' ) . '" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) .
		                   '" size="30"' . $aria_req . ' /></div>';

		$fields['url'] = '<div class="col4"><input id="url" placeholder="' . esc_attr__( 'Website', 'ela' ) .
		                 ( $req ? '*' : '' ) . '" name="url" type="url" value="' . esc_attr( $commenter['comment_author_website'] ) .
		                 '" size="30"' . $aria_req . ' /></div></div></div>';
	} else {
		$fields['author'] = '<div class="comment_details_wrapper col8"><div class="row"><div class="col6"><input id="author" placeholder="' . esc_attr__( 'Name', 'ela' ) .
		                    ( $req ? '*' : '' ) . '" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
		                    '" size="30"' . $aria_req . ' /></div>';

		$fields['email'] = '<div class="col6"><input id="email" placeholder="' . esc_attr__( 'Email', 'ela' ) .
		                   ( $req ? '*' : '' ) . '" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) .
		                   '" size="30"' . $aria_req . ' /></div></div></div>';
	}

	$user_avatar = ela_filter_lazyload_images( get_avatar( "", 45 ) );

	if ( is_user_logged_in() ):

		$current_user = wp_get_current_user();

		if ( ( $current_user instanceof WP_User ) ) {
			$user_avatar = ela_filter_lazyload_images( get_avatar( $current_user->user_email, 45 ) );
		}
	endif;

	$args = array(
		'id_form'           => 'commentform',
		'class_form'        => 'comment-form',
		'id_submit'         => 'submit',
		'class_submit'      => 'submit',
		'name_submit'       => 'submit',
		'cancel_reply_link' => esc_attr__( 'Cancel Reply', 'ela' ),
		'label_submit'      => esc_attr__( 'Post Comment', 'ela' ),
		'format'            => 'xhtml',

		'comment_field' => '<div class="comment_textarea_wrapper col12">' . $user_avatar . '<textarea placeholder="' . esc_attr__( 'Write your comment', 'ela' ) .
		                   '" id="comment" name="comment" cols="3" rows="8" aria-required="true">' .
		                   '</textarea></div>',

		'comment_notes_before' => '<div class="comment-notes col12">' .
		                          sprintf(
			                          esc_attr__( 'Comment as a guest.', 'ela' )
		                          ) . '</div>',

		'fields' => apply_filters( 'comment_form_default_fields', $fields ),
	);

	?>

	<?php
	comment_form( $args );
	?>

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>

        <ol class="comment-list">
			<?php
			echo ela_filter_lazyload_images( wp_list_comments( array(
				'avatar_size' => 45,
				'style'       => 'ol',
				'short_ping'  => true,
				'reply_text'  => sprintf( '<span class="comments_reply_icon"><i class="fas fa-reply"></i></span>%s', esc_attr__( 'Reply', 'ela' ) ),
				'echo'        => false
			) ) );
			?>
        </ol>

		<?php the_comments_pagination( array(
			'prev_text' => '<span class="screen-reader-text">' . esc_attr__( 'Previous', 'ela' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . esc_attr__( 'Next', 'ela' ) . '</span>',
		) );

	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
        <p class="no-comments"><?php esc_html__( 'Comments are closed.', 'ela' ); ?></p>
	<?php
	endif;
	?>

</div><!-- #comments -->
