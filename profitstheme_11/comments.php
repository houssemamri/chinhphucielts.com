<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>


<?php if (have_comments()) : ?>
	<!-- comments -->
	<h3 id="comments"><?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h3>    
    
    <?php paginate_comments_links(); // Add pagination comments. Revised by Ahmad Dec 06, 2011.?>
    
	<ul id="commentlist">
		<?php wp_list_comments( 'callback=pt_comments' ); ?>
	</ul>
    
    <?php paginate_comments_links(); // Add pagination comments. Revised by Ahmad Dec 06, 2011.?>

<?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->
		<p class="nocomments">No comments yet... Be the first to leave a reply!</p>

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments">Comments are closed.</p>

	<?php endif; ?>

<?php endif; ?>

<?php
$comment_fields  = '<p><input type="text" name="author" id="author" value="' . $comment_author . '" class="input" size="22" tabindex="1" aria-required="true" />'
		  .'<label for="author"><small>Name (required)</small></label></p>'
		  .'<p><input type="text" name="email" id="email" value="' . $comment_author_email . '" class="input" size="22" tabindex="2" aria-required="true" />'
		  .'<label for="email"><small>Mail (will not be published) (required)</small></label></p>'
		  .'<p><input type="text" name="url" id="url" value="' . $comment_author_url . '" class="input" size="22" tabindex="3" />'
		  .'<label for="url"><small>Website</small></label></p>';

$new_defaults = array(
	'fields' => $comment_fields,
	'comment_field' => '<p><textarea name="comment" id="comment" cols="" rows="10" tabindex="4" class="textarea"></textarea></p>',
	'comment_notes_after' => ''
);

if ( is_page() ) {
	$post_id = get_the_ID();
	$tmpl_meta = get_post_meta($post_id, '_wp_page_template', true);

	if ( $tmpl_meta == 'page-sales.php' ) {
		comment_form($new_defaults, $post_id);
	} else {
		comment_form($new_defaults);
	}
} else {
	comment_form($new_defaults);
}


