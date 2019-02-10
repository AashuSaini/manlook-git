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
wp_enqueue_script('parally');
$zoo_post_label = true;
$media_class = $media_url = null;
if(has_post_thumbnail()) :
	$media_url = get_the_post_thumbnail_url(get_the_ID(),'full');
    $media_class = 'post-image single-image parallax-window';
else :
	$media_url = get_template_directory_uri().'/assets/images/blog-default-img.jpg';
    $media_class = 'post-image single-image single-default  parallax-window';
endif;
$overlay_color = get_theme_mod('zoo_single_post_overlay_of_featured','');
if(get_post_meta(get_the_ID(),'zoo_single_post_overlay_of_featured',true) != null){
    $overlay_color = get_post_meta(get_the_ID(),'zoo_single_post_overlay_of_featured',true);
}
$overlay_opcity = get_theme_mod('zoo_single_post_opcity_of_featured','');
if(get_post_meta(get_the_ID(),'zoo_single_post_opcity_of_featured',true) != null){
    $overlay_opcity = get_post_meta(get_the_ID(),'zoo_single_post_opcity_of_featured',true);
}
$overlay = '';
if($overlay_color){
    $overlay = 'style="background: '.$overlay_color.';opacity: '.$overlay_opcity.'"';
}
$media_attr = 'data-parallax="scroll" data-image-src="'.$media_url.'"';
?>
<?php
if (has_post_format('gallery')) : ?>
    <div class="<?php echo esc_attr($media_class) ?>" <?php echo ent2ncr($media_attr) ?>>
        <div class="overlay-featured-image" <?php if($overlay){ echo ent2ncr($overlay);} ?>></div>
        <div class="header-post">
            <?php
            echo get_the_term_list(get_the_ID(), 'category', '<p class="list-cat text-center">', ' ', '</p>');
            the_title('<h1 class="title-detail">', '</h1>');
            if($zoo_post_label)get_template_part('inc/templates/posts/archive/post','label');
            get_template_part('inc/templates/posts/single/post-info');
            ?>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php $zoo_images = get_post_meta(get_the_ID(), '_format_gallery_images', true); ?>
            <?php if ($zoo_images) :
                wp_enqueue_style('slick');
                wp_enqueue_style('slick-theme');
                wp_enqueue_script('slick');
                ?>
                <div class="post-media col-xs-12 col-sm-12 col-md-9">
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
        </div>
    </div>
<?php elseif (has_post_format('video')) : ?>
    <div class="<?php echo esc_attr($media_class) ?>" <?php echo ent2ncr($media_attr) ?>>
        <div class="overlay-featured-image" <?php if($overlay){ echo ent2ncr($overlay);} ?>></div>
        <div class="header-post">
            <?php
            echo get_the_term_list(get_the_ID(), 'category', '<p class="list-cat text-center">', ' ', '</p>');
            the_title('<h1 class="title-detail">', '</h1>');
            if($zoo_post_label)get_template_part('inc/templates/posts/archive/post','label');
            get_template_part('inc/templates/posts/single/post-info');
            ?>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="post-media col-xs-12 col-sm-12 col-md-9">
                <?php $zoo_video = get_post_meta(get_the_ID(), '_format_video_embed', true); ?>
                <?php if (wp_oembed_get($zoo_video)) : ?>
                    <?php echo wp_oembed_get($zoo_video); ?>
                <?php else : ?>
                    <?php echo ent2ncr($zoo_video); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php elseif (has_post_format('audio')) : ?>
    <div class="<?php echo esc_attr($media_class) ?>" <?php echo ent2ncr($media_attr) ?>>
        <div class="overlay-featured-image" <?php if($overlay){ echo ent2ncr($overlay);} ?>></div>
        <div class="header-post">
            <?php
            echo get_the_term_list(get_the_ID(), 'category', '<p class="list-cat text-center">', ' ', '</p>');
            the_title('<h1 class="title-detail">', '</h1>');
            if($zoo_post_label)get_template_part('inc/templates/posts/archive/post','label');
            get_template_part('inc/templates/posts/single/post-info');
            ?>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="post-media col-xs-12 col-sm-12 col-md-9">
                <?php $zoo_audio = get_post_meta(get_the_ID(), '_format_audio_embed', true); ?>
                <?php if (wp_oembed_get($zoo_audio)) : ?>
                    <?php echo wp_oembed_get($zoo_audio); ?>
                <?php else : ?>
                    <?php echo ent2ncr($zoo_audio); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php elseif (has_post_format('quote')) : ?>
    <div class="<?php echo esc_attr($media_class) ?>" <?php echo ent2ncr($media_attr) ?>>
        <div class="overlay-featured-image" <?php if($overlay){ echo ent2ncr($overlay);} ?>></div>
        <div class="header-post">
            <?php
            echo get_the_term_list(get_the_ID(), 'category', '<p class="list-cat text-center">', ' ', '</p>');
            the_title('<h1 class="title-detail">', '</h1>');
            if($zoo_post_label)get_template_part('inc/templates/posts/archive/post','label');
            get_template_part('inc/templates/posts/single/post-info');
            ?>
        </div>
    </div>
    <?php if(get_post_meta(get_the_ID(),'_format_quote_source_content',true) != null) : ?>
    <div class="container">
        <div class="row">
            <div class="post-media col-xs-12 col-sm-12 col-md-9">
                <div class="format-quote-inner">
                    <h3 class="quote-content">
                        <?php echo esc_attr(get_post_meta(get_the_ID(),'_format_quote_source_content',true)); ?>
                    </h3>
                    <p class="quote-info">
                        <a href="<?php echo esc_url(get_post_meta(get_the_ID(),'_format_quote_source_url',true)); ?>" target="_blank"><?php echo esc_attr(get_post_meta(get_the_ID(),'_format_quote_source_name',true)); ?></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
<?php else : ?>
    <div class="<?php echo esc_attr($media_class) ?>" <?php echo ent2ncr($media_attr) ?>>
        <div class="overlay-featured-image" <?php if($overlay){ echo ent2ncr($overlay);} ?>></div>
        <div class="header-post">
            <?php
            echo get_the_term_list(get_the_ID(), 'category', '<p class="list-cat text-center">', ' ', '</p>');
            the_title('<h1 class="title-detail">', '</h1>');
            if($zoo_post_label)get_template_part('inc/templates/posts/archive/post','label');
            get_template_part('inc/templates/posts/single/post-info');
            ?>
        </div>
    </div>
<?php endif; ?>