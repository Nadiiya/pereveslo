<?php

$args = array(
    'post_id' => $post->ID,
    'status'  => 'approve',
    'orderby' => 'comment_date_gmt',
    'order'   => 'ASC',
);

$comments_query = new WP_Comment_Query;
$comments       = $comments_query->query($args);
?>
<?php if ($comments): ?>
<section class="comments">

    <h2 class="comments__title">
        Коментарі до публікації: "<?php the_title(); ?>
    </h2>
    <ul class="comments__list comment-list">
        <?php
        foreach ($comments as $comment): ; ?>
            <li class="comment-list__item <?php echo ($comment->comment_parent) ? 'comment-list__item--child' : '' ?>"
                id="comment-<?php echo $comment->comment_ID ?>">
                <?php echo get_avatar($comment, 45, '', 'Аватар користувача', array(
                    'class' => 'comment__avatar'
                )); ?>
                <cite class="comment-list__author">
                    <?php echo $comment->comment_author ?>
                </cite>
                <time class="comment-list__date" datetime="<?php echo $comment->comment_date_gmt ?>">
                    <?php echo $comment->comment_date_gmt ?>
                </time>
                <blockquote class="comment-list__comment">
                    <?php echo $comment->comment_content ?>
                </blockquote>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    <?php
    $commenter = wp_get_current_commenter();
    $fields    = array(
        'author' => '<p class="comment-form__field"><label for="author">' . __('Name') . ($req ? '<span class="required">*</span>' : '') . '</label><input type="text" id="author" name="author" class="comment-form__input comment-form__input--author" value="' . esc_attr($commenter['comment_author']) . '" placeholder="" " maxlength="30" autocomplete="on" tabindex="1" required' . $req . '></p>',
        'email'  => '<p class="comment-form__field"><label for="email">' . __('Email') . ($req ? '<span class="required">*</span>' : '') . '</label><input type="email" id="email" name="email" class="comment-form__input comment-form__input--email" value="' . esc_attr($commenter['comment_author_email']) . '" placeholder="name@example.com" maxlength="30" autocomplete="on" tabindex="2" required' . $req . '></p>',
    );
    comment_form(array(
        'fields'              => apply_filters('comment_form_default_fields', $fields),
        'class_container'     => 'comments__respond comment-form',
        'title_reply_before'  => '<h3 id="reply-title" class="comment-form__title">',
        'class_form'          => 'comment-form__form',
        'comment_notes_after' => '',
        'comment_field'       => '<p class="comment-form__field"><textarea id="comment" name="comment" class="comment-form__input comment-form__input--textarea" rows="8" aria-required="true" placeholder="Коментар..."></textarea></p>',
        'submit_field'        => '<p class="comment-form__field">%1$s %2$s</p>',
        'label_submit'        => 'Відправити',
        'class_submit'        => 'comment-form__input--submit',
        'title_reply'         => 'Коментувати',
    ));
    ?>
</section>
