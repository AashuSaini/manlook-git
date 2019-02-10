<?php
/**
 * The template for displaying archive pages.
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2017 Zootemplate
 * @license     GPL v2
 */

$col = 12;
$zoo_block_layout = get_theme_mod('zoo_blog_layout', 'list');
$main_class = 'main-content ';
if (zoo_get_sidebar() != 'none') {
    $col = $col - 3;
    $main_class .= 'has-left-sidebar ';
}
if (zoo_get_sidebar('right') != 'none') {
    $col = $col - 3;
    $main_class .= ' has-right-sidebar';
}
$main_class .= ' col-xs-12 col-sm-' . $col . ' ' . $zoo_block_layout . '-layout';
get_header(); ?>
    <main id="main" class="wrap-site-main archive-page block-page">
        <div class="container">
            <div class="row">
                <?php get_sidebar(); ?>
                <div class="<?php echo esc_attr($main_class) ?>">
                    <div class="row">
                        <?php if (have_posts()) :
                            // Start the Loop.
                            while (have_posts()) : the_post();
                                // Get layout.
                                get_template_part('inc/templates/posts/archive/' . $zoo_block_layout, 'layout');
                            endwhile;
                        else :
                            // If no content, include the "No posts found" template.
                            get_template_part('content', 'none');
                        endif; ?>
                        <?php get_template_part('inc/templates/posts/post', 'pagination'); ?>
                    </div>
                </div> <!-- #primary -->
                <?php get_sidebar('right'); ?>
            </div>
        </div>
    </main> <!-- #main -->
<?php
get_footer();

