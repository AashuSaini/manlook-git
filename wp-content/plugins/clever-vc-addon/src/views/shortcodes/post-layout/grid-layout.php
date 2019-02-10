<?php
/**
 * Grid layout for post
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @core        3.0.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2018 Zootemplate
 * @license     GPL v2
 */
$class = 'zoo-blog-item layout-item grid-layout-item ';
?>
<article <?php echo post_class($class) ?>>
    <div class="zoo-post-inner">
        <?php
        if (is_sticky()) :
            ?>
            <span class="sticky-post-label"><?php echo esc_html__('Featured', 'cvca') ?></span>
            <?php
        endif;
        echo cvca_get_shortcode_view('post-layout/media', $atts);;

        if($atts['post_info'] == 'yes'):
            get_template_part('inc/templates/posts/loop/post', 'info');
            endif;
        the_title(sprintf('<h3 class="entry-title title-post"><a href="%s" rel="' . esc_html__('bookmark', 'cvca') . '">', esc_url(get_permalink())), '</a></h3>'); ?>
        <?php 
        if ($atts['output_type'] != 'no') : ?>
            <div class="entry-content">
                <?php
                if ($atts['output_type'] == 'excerpt') {
                    echo cvca_get_excerpt($atts['excerpt_length']);
                } else {
                    the_content();
                }
                ?>
            </div>
        <?php endif;
        if ($atts['view_more'] == 'yes' || get_the_title() == '') :
            ?>
            <a href="<?php echo esc_url(the_permalink()); ?>"
               class="readmore"><?php echo esc_attr($atts['text_view_more']); ?></a>
            <?php
        endif;
        ?>
    </div>
</article>