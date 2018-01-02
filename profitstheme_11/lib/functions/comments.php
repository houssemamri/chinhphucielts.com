<?php

function pt_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; 
	global $pt_comments_date_disable;
?>

<li class="comment clearfix" id="li-comment-<?php comment_ID() ?>">
    
        <div id="comment-<?php comment_ID(); ?>" class="clearfix">
        	<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 72 ); ?>
		</div>
            	

		<div class="comment-text clearfix">
                
                	<div class="clearfix">
				<div class="reply alignright">
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>
                    		<h3 class="alignleft"><?php echo get_comment_author_link(); ?> <?php if ( $pt_comments_date_disable != 'true' ) { ?>on <?php echo get_comment_date(); ?><?php } ?></h3>
                	</div>
                
                    
                	<?php if ($comment->comment_approved == '0') : ?>
                    		<p><em><?php _e('Your comment is awaiting moderation.') ?></em></p>
                	<?php endif; ?>

			<?php comment_text() ?>

    		</div>
        </div>

<?php
}
?>