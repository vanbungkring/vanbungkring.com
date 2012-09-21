<?php 

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');
	
if (post_password_required() ) { ?>
	<p class="nocomments">This post is password protected. Enter pass to view comments.</p>
<?php
        return;
        }
    ?>


<?php if (have_comments() ) : ?>

<ol id="comments" class="clearfix">
<h4><?php comments_number('No Comments', '1 Comment', '% Comments')?></h4>
<div class="comments-separator"></div>
<!-- START #comments -->
		
				<?php wp_list_comments('type=comment&avatar_size=48&callback=styling_comment'); ?>
								
<!-- END #comments -->
<?php endif; ?>
</ol>

<?php if (comments_open()) : ?>

<?php
$comments_args = array(
// change the title of send button
'title_reply' => '<h4>Leave a comment</h4><div class="comment-form-separator"></div>', 'title_reply_to' => '<h4>Leave a Reply to %s</h4><div class="comment-form-separator"></div>', );
?>

<?php comment_form($comments_args); ?>

<?php endif; ?>
