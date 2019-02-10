<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2017 Zootemplate
 * @license     GPL v2
 */
$zoo_block_layout = get_theme_mod('zoo_blog_layout', 'list');
$zoo_get_sidebar = zoo_get_sidebar_config();
$main_class = 'main-content ';
$main_class .= $zoo_get_sidebar['col'] .'  '. $zoo_get_sidebar['has-sidebar'] . ' '.$zoo_block_layout . '-layout';
get_header();
?>
<main id="main" class="wrap-site-main index-page">
    <div class="container">
        <div class="row">
            <?php get_sidebar(); ?>
            <div class="<?php echo esc_attr($main_class)?>">
                <div class="row">
                    <div class="zoo-container">
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
                    </div><!-- .zoo-container -->
                    <?php
                    if (have_posts()) :
                        get_template_part('inc/templates/posts/post', 'pagination');
                    endif;
                    ?>
                </div>
            </div>
            <?php get_sidebar('right'); ?>
        </div>
    </div>
</main> <!-- #main -->
<?php
get_footer();