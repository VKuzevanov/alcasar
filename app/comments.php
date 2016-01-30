<? $args = array(
  'size' =>'40',
  'reply_text'=> 'Ответить',
); ?>
<?
$fields =  array(
  'author' => '<div class="author-data">
			   <input class="site__author" name="author" type="text" value="" size="30" placeholder="* Имя" />',
  'email'  => '<input class="site__email" name="email" type="text" value="" size="30" placeholder="* e-mail"  /></div>',
); ?>
<?
$comments_args = array(
  'fields' => $fields,
  'comment_notes_after' => '',
  'comment_field' => '<div class="comment-form-comment"><textarea class="site__comment" name="comment" cols="" placeholder="Комментарий"  aria-required="true"></textarea></div>',
  'label_submit' => 'Отправить',
  'title_reply'  =>  'Комментировать'
); ?>

<?php
function mytheme_comment($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
?>
	   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
			<div id="comment-<?php comment_ID(); ?>">
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment->comment_author_email, $args['avatar_size']); ?>
				    <?php printf(__('<span class="author__name">%s</span>'), get_comment_author()) ?>
					<?php edit_comment_link( __( 'Редактировать' ), ' ' ); ?>
					
						<a rel="nofollow" class="comment__date-time" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a>

				</div>
				
<?php if ($comment->comment_approved == '0') : ?>
				<div class="comment-awaiting-verification"><?php _e('Your comment is awaiting moderation.') ?></div>
			 <br />
<?php endif; ?>
            <div class="comment_text">
				    <?php comment_text() ?>		
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					
				</div>
			</div>

<?php
		break;
		case 'pingback'  :
		case 'trackback' :
?>
			<li class="post pingback">
				<?php comment_author_link(); ?>
				<?php edit_comment_link( __( 'Редактировать' ), ' ' ); ?>
<?php
		break;
	endswitch;
}
?>
<?php $args = array(
	 'avatar_size'       => 45,
	 'reply_text'       => 'Ответить',
	 'callback'          => 'mytheme_comment',
    ); ?>
<?comment_form($comments_args) ?>
  </br>
  <div class="comment-warp">
<h4>Ваши комментарии:</h4>
<div class="main-list-comments">
	<ul>
		<?php wp_list_comments($args); ?>
		  	</ul>
  </div>
  </div>