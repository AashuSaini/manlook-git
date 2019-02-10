<?php
/**
 * List layout for post
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2017 Zootemplate
 * @license     GPL v2
 */
$class = 'zoo-blog-item layout-item list-layout col-xs-12';
if(get_post_thumbnail_id()!=''){
    $class.=' post-has-thumbnail';
}else{
    $class.=' post-without-thumbnail';
}
?>
<article <?php echo post_class($class) ?>>
    <div class="zoo-post-inner">
        <?php get_template_part('inc/templates/posts/archive/media'); ?>
        <?php if(!has_post_format('quote') || get_post_meta(get_the_ID(),'_format_quote_source_content',true) == null) : ?>
            <?php
            get_template_part('inc/templates/posts/archive/post', 'info');
            the_title(sprintf('<h3 class="entry-title title-post"><a href="%s" rel="' . esc_html__('bookmark', 'doma') . '">', esc_url(get_permalink())), '</a></h3>');
            ?>
            <div class="wrap-main-post">
                <?php if (get_theme_mod('zoo_blog_show_excerpt', 1) == 1) { ?>
                    <div class="entry-content">
                        <?php
                        the_excerpt();
                        ?>
                    </div>
                <?php } ?>
                <?php if (get_the_title() == '' || get_theme_mod('zoo_blog_show_readmore', true)) { ?>
                    <a href="<?php echo esc_url(the_permalink()); ?>"
                       class="readmore"><?php echo esc_html__('Continue Reading', 'doma'); ?> 
                       <span class="cs-font clever-icon-arrow-bold"></span>
                        </a>
                <?php } ?>
            </div>
        <?php endif; ?>
    </div>
</article>