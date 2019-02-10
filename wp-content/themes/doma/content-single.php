<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2017 Zootemplate
 * @license     GPL v2
 */
$zoo_post_class = 'post-item';
if(get_post_thumbnail_id() !='' ){
    $zoo_post_class .= ' post-has-thumbnail';
}
else{
    $zoo_post_class .= ' post-without-thumbnail';
}
$zoo_post_label = true;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($zoo_post_class); ?>>
    <?php get_template_part('inc/templates/posts/single/media');?> 
    <div class="container">
        <div class="row">
            <div class="post-content col-xs-12 col-sm-12 col-md-9">
                <?php
                the_content();
                edit_post_link(__('Edit', 'doma'), '<span class="edit-link">', '</span>');
                ?>
                <?php
                //do not remove
                get_template_part('inc/templates/inpost', 'pagination');
                //Allow custom below
                ?>
                <div class="bottom-post">
                    <?php
                    get_template_part('inc/templates/posts/single/tag');
                    get_template_part('inc/templates/posts/single/share', 'post');
                    ?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <?php
                get_template_part('inc/templates/posts/single/post', 'navigation');
                if(get_theme_mod('zoo_blog_single_author')==true){
                    get_template_part('inc/templates/posts/single/about', 'author');
                }
                get_template_part('inc/templates/posts/single/related', 'posts');
                ?>
            </div>
        </div>
    </div>
    <?php
        if (comments_open() || get_comments_number()) :
            comments_template('', true);
        endif;
    ?>
</article>