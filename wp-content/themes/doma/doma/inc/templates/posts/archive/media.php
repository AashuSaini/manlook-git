<?php
/**
 * Media block for post
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2017 Zootemplate
 * @license     GPL v2
 */
$zoo_block_layout = get_theme_mod('zoo_blog_layout', 'list');
if (has_post_format('gallery')) : ?>
            <?php $zoo_images = get_post_meta(get_the_ID(), '_format_gallery_images', true); ?>
            <?php if ($zoo_images) :
                wp_enqueue_style('slick');
                wp_enqueue_style('slick-theme');
                wp_enqueue_script('slick');
                ?>
                <div class="post-media">
                    <ul class="post-slider">
                        <?php foreach ($zoo_images as $zoo_image) : ?>
                            <?php $zoo_the_image = wp_get_attachment_image_src($zoo_image, 'full-thumb'); ?>
                            <?php $zoo_the_caption = get_post_field('post_excerpt', $zoo_image); ?>
                            <li><img src="<?php echo esc_url($zoo_the_image[0]); ?>"
                                     <?php if ($zoo_the_caption) : ?>title="<?php echo esc_attr($zoo_the_caption); ?>"<?php endif; ?> />
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
<?php elseif (has_post_format('video')) : ?>
    
            <div class="post-media">
                <?php $zoo_video = get_post_meta(get_the_ID(), '_format_video_embed', true); ?>
                <?php if (wp_oembed_get($zoo_video)) : ?>
                    <?php echo wp_oembed_get($zoo_video); ?>
                <?php else : ?>
                    <?php echo ent2ncr($zoo_video); ?>
                <?php endif; ?>
            </div>
<?php elseif (has_post_format('audio')) : ?>
            <div class="post-media">
                <?php $zoo_audio = get_post_meta(get_the_ID(), '_format_audio_embed', true); ?>
                <?php if (wp_oembed_get($zoo_audio)) : ?>
                    <?php echo wp_oembed_get($zoo_audio); ?>
                <?php else : ?>
                    <?php echo ent2ncr($zoo_audio); ?>
                <?php endif; ?>
            </div>
     
<?php elseif(has_post_format('quote') && get_post_meta(get_the_ID(),'_format_quote_source_content',true) != null) :  ?>
    <div class="format-quote-inner page" style ="background : url('<?php if(has_post_thumbnail()) the_post_thumbnail_url();else echo get_template_directory_uri().'/assets/images/blog-default-img.jpg'; ?>') center center fixed">
        <h3 class="quote-content">
            <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_attr(get_post_meta(get_the_ID(),'_format_quote_source_content',true)); ?></a>
        </h3>
        <p class="quote-info">
            <a href="<?php echo esc_url(get_post_meta(get_the_ID(),'_format_quote_source_url',true)); ?>" target="_blank"><?php echo esc_attr(get_post_meta(get_the_ID(),'_format_quote_source_name',true)); ?></a>
        </p>
    </div>
<?php elseif (has_post_thumbnail()) : ?>
    <div class="wrap-media">
        <?php
        if($zoo_block_layout!='list') {
            get_template_part('inc/templates/posts/archive/post', 'label');
        }
        ?>
        <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo get_the_title() ?>">
            <?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) ); ?>
        </a>
    </div>
<?php else: ?>
    <?php if($zoo_block_layout == 'list') :
        get_template_part('inc/templates/posts/archive/post', 'label');?>
    <?php endif; ?>
<?php endif; ?>