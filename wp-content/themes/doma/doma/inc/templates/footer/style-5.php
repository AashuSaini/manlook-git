<?php
/**
 * Default Footer Layout
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2017 Zootemplate
 * @license     GPL v2
 */
$zoo_main_footer = zoo_main_footer();
$zoo_copyright_text = get_theme_mod('zoo_footer_copyright', 'Copyright &#169; 2018 <a href="#"> ZooTemplate</a>. All rights reserved');
$pays = get_theme_mod( 'zoo_footer_bottom_right', '' );
if ($zoo_main_footer) :
    if (is_active_sidebar('main-footer-1-style-5') || is_active_sidebar('main-footer-2-style-5')) : ?>
        <div id="main-footer" class="footer-block">
            <div class="container">
                <div class="wrap-main-footer row">
                    <div class="col-xs-12 col-sm-6 main-footer-block">
                        <?php dynamic_sidebar('main-footer-1-style-5'); ?>
                        <div id="copyright">
                            <?php echo ent2ncr($zoo_copyright_text);?>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 main-footer-block">
                        <?php dynamic_sidebar('main-footer-2-style-5'); ?>
                    </div>
                </div>
            </div>
        </div>
<?php endif;endif;