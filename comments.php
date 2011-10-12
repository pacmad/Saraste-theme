<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to boilerplate_comment which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */
?>

<?php if ( post_password_required() ) : ?>
				<p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'boilerplate' ); ?></p>
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() ) : ?>
			<!-- STARKERS NOTE: The following h3 id is left intact so that comments can be referenced on the page -->
			<h3 id="comments-title"><?php
				if(get_comments_number() > 0){
					echo 'Kommentit';
				}
			?></h3>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
				<?php previous_comments_link( __( '&larr; Vanhemmat kommentit', 'boilerplate' ) ); ?>
				<?php next_comments_link( __( 'Uudemmat kommentit &rarr;', 'boilerplate' ) ); ?>
<?php endif; // check for comment navigation ?>

				<?php
					/* Loop through and list the comments. Tell wp_list_comments()
					 * to use boilerplate_comment() to format the comments.
					 * If you want to overload this in a child theme then you can
					 * define boilerplate_comment() and that will be used instead.
					 * See boilerplate_comment() in boilerplate/functions.php for more.
					 */
					wp_list_comments( array( 'callback' => 'boilerplate_comment' ) );
				?>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
				<?php previous_comments_link( __( '&larr; Vanhemmat kommentit', 'boilerplate' ) ); ?>
				<?php next_comments_link( __( 'Uudemmat kommentit &rarr;', 'boilerplate' ) ); ?>
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php

$fields =  array(
	'author' => '<p class="comment-form-author"><label for="author">Nimi</label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />' . ( $req ? '<span class="required">(pakollinen)</span>' : '' ) . '</p>',
	'email'  => '<p class="comment-form-email"><label for="email">Sähköposti</label><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />' . ( $req ? '<span class="required">(pakollinen, ei näytetä)</span>' : '' ) . '</p>',
	'url'    => '<p class="comment-form-url"><label for="url">Kotisivu</label><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />' . ( $req ? '<span class="required">(pakollinen)</span>' : '' ) . '</p>',
);

$args = array('title-reply' => 'Kommentoi', 'fields' => $fields);

comment_form($args);

?>