<?php
/**
 * Grid layout for post
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2017 Zootemplate
 * @license     GPL v2
 */
wp_enqueue_script('isotope');
$class = 'zoo-blog-item layout-item grid-layout-item ';
switch (get_theme_mod('zoo_blog_col','3')) {
    case '2':
        $class .= "col-xs-12 col-sm-6";
        break;
    case '3':
        $class .= "col-xs-12 col-sm-4";
        break;
    case '4':
        $class .= "col-xs-12 col-sm-3";
        break;
    case '5':
        $class .= "col-xs-12 col-sm-1-5";
        break;
    case '6':
        $class .= "col-xs-12 col-sm-2";
        break;
    default:
        $class .= "col-xs-12 col-sm-12";
        break;
}
if(get_post_thumbnail_id()!=''){
    $class.=' post-has-thumbnail';
}else{
    $class.=' post-without-thumbnail';
}
?>
<article <?php echo post_class($class) ?>>
    <div class="zoo-post-inner">
        <?php get_template_part('inc/templates/posts/archive/media');?>
        <div class="wrap-content">
            <?php if(!has_post_format('quote')) : ?>
            <?php get_template_part('inc/templates/posts/archive/post','info');
                the_title(sprintf('<h3 class="title-post"><a href="%s" rel="' . esc_html__('bookmark', 'doma') . '">', esc_url(get_permalink())), '</a></h3>'); ?>
                <?php if(get_theme_mod('zoo_blog_show_excerpt',1)==1){?>
            <div class="entry-content">
                    <?php
                    the_excerpt();
                    ?>
                </div>
            <?php }?>
            <?php if (get_the_title() == '' || get_theme_mod('zoo_blog_show_readmore', true)) { ?>
                <a href="<?php echo esc_url(the_permalink()); ?>"
                   class="readmore"><?php echo esc_html__('Continue Reading', 'doma'); ?>
                    <span class="cs-font clever-icon-arrow-bold"></span></a>
            <?php } ?>
        <?php endif; ?>
        </div>
    </div>
</article>