<?php
/**
 * The template for displaying all single posts.
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2017 Zootemplate
 * @license     GPL v2
 */
get_header();
$main_class = 'main-content content-single ';
?>
<main id="main" class="wrap-site-main single-post <?php echo esc_attr(single_post_format_class()); ?>">
    <div class="<?php echo esc_attr($main_class) ?>">
        <?php if (have_posts()) :
            // Start the Loop.
            while (have_posts()) : the_post();
                get_template_part('content', 'single');
            endwhile;
        endif; ?>
    </div> <!-- #primary -->  
</main> <!-- #main -->
<?php
get_footer();