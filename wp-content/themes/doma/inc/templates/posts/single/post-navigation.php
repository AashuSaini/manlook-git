<?php
/**
 * Post navigation of single post
 *
 * @package     Doma
 * @version     1.0.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2017 Zootemplate
 * @license     GPL v2
 *
 **/
$zoo_next_post = get_next_post();
$zoo_prev_post = get_previous_post();
if(get_theme_mod('zoo_blog_single_nav','1') == 1){

?>
<div class="zoo-single-post-nav">
    <?php if (!empty($zoo_next_post)): ?>
        <div class="next-post zoo-single-post-nav-item">
            <a href="<?php echo get_permalink($zoo_next_post->ID); ?>"
               title="<?php echo esc_attr($zoo_next_post->post_title); ?>">
                <i class="cs-font clever-icon-prev-arrow-1"></i>
                <h4>
                    <span><?php echo esc_html__('Newer Post','doma');?></span>
                    <?php echo ent2ncr($zoo_next_post->post_title); ?>
                </h4>
            </a>
        </div>
    <?php endif; ?>
    <?php if (!empty($zoo_prev_post)): ?>
        <div class="prev-post zoo-single-post-nav-item pull-right">
            <a href="<?php echo get_permalink($zoo_prev_post->ID); ?>"
               title="<?php echo esc_attr($zoo_prev_post->post_title); ?>">
                <h4>
                    <span><?php echo esc_html__('Older Post','doma');?></span>
                    <?php echo ent2ncr($zoo_prev_post->post_title); ?>
                </h4>
                <i class="cs-font clever-icon-next-arrow-1"></i>
            </a>
        </div>
    <?php endif; ?>
</div>
<?php }?>