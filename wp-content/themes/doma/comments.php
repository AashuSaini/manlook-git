<?php
/**
 * Comments
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2017 Zootemplate
 * @license     GPL v2
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
/* DISPLAY THE COMMENTS
================================================== */
?>
<?php if (have_comments()) : ?>
<div class="comment-block-list">
    <div class="container">
        <div class="row">
            <div class="comment-block-inner col-xs-12 col-sm-12 col-md-9">
                <div id="comments-list" class="comments">
                    
                        <h4 class="title-block">
                            <span><?php comments_number(esc_html__('0 Thought', 'doma'), esc_html__('1 Thought On', 'doma'), esc_html__('% Thoughts On', 'doma')); ?>
                            </span>
                            <span>"<?php the_title(); ?>"</span>
                        </h4>
                        <?php
                        $ping_count = $comment_count = 0;
                        foreach ($comments as $comment)
                            get_comment_type() == "comment" ? ++$comment_count : ++$ping_count;
                        if (!empty($comments_by_type['comment'])) : ?>
                            <ol class="wrap-comments">
                                <?php
                                wp_list_comments(array(
                                    'type' => 'pings',
                                    'short_ping' => true,
                                    'callback' => 'zoo_custom_pings',
                                ));
                                wp_list_comments(array(
                                    'type' => 'comment',
                                    'callback' => 'zoo_custom_comments',
                                )); ?>
                            </ol>
                            <?php $total_pages = get_comment_pages_count();
                            if ($total_pages > 1) : ?>
                                <div id="comments-nav-below" class="comments-navigation">
                                    <div class="wrap-pagination clearfix">
                                        <?php paginate_comments_links(array('type' => 'list', 'prev_text' => '<i class="cs-font clever-icon-prev-arrow-1"></i>',
                                            'next_text' => '<i class="cs-font clever-icon-next-arrow-1"></i>')); ?></div>
                                </div>
                            <?php endif; ?>
                        <?php endif; /* if ( $comment_count ) */ ?>
                    
                </div><!-- #comments-list .comments -->
            </div>
        </div>
    </div>
</div>
<?php endif /* if ( $comments ) */ ?>
<?php
/* COMMENT ENTRY FORM
================================================== */
if (comments_open()) : ?>
<div class="comment-block-form">
    <div class="container">
        <div class="row">
            <div class="comment-block-inner col-xs-12 col-sm-12 col-md-9">
                <?php
                $req = get_option('require_name_email');
                $aria_req = ($req ? " aria-required='true'" : '');
                $zoo_comment_args = array(
                    'fields' => apply_filters('comment_form_default_fields', array(
                        'author' => '<label><span>' . esc_attr__('Your name', 'doma') . '<i class="required">&nbsp;*</i></span><input id="author"  class="ipt text-field" name="author" aria-required="true" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></label>',
                        'email' => '<label><span>' . esc_attr__('Email', 'doma') . '<i class="required">&nbsp;*</i></span><input id="email"  class="ipt text-field" name="email" aria-required="true" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" ' . $aria_req . ' /></label>',
                        'url' => '<label><span>' . esc_attr__('Website', 'doma') . '</span><input id="url"  class="ipt text-field" name="url"  type="text" value="' . esc_attr($commenter['comment_author_url']) . '"/></label>',
                    )),
                    'comment_field' => '<label class="input-comment"><span>' . esc_attr__('Comment', 'doma') . '<i class="required">&nbsp;*</i></span><textarea id="comment" class="textarea text-field"  name="comment" cols="45" rows="8"  aria-required="true"></textarea></label>',
                    'class_submit' => 'btn btn-submit',
                    'label_submit' => esc_attr__('Post Comment', 'doma'),
                    'comment_notes_after'=>'<div class="wrap-text-field gdpr-consent">'.zoo_gdpr_consent().'</div>'

                );
                comment_form($zoo_comment_args);
                ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>