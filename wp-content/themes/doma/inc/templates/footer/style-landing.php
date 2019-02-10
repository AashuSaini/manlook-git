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
$zoo_copyright_text = get_theme_mod('zoo_footer_copyright', 'Copyright &#169; 2018 <a href="#"> ZooTemplate</a>. All rights reserved');
$pays = get_theme_mod( 'zoo_footer_bottom_right', '' );
if ($zoo_copyright_text != '' || $pays != '') { ?>
    <div id="bottom-footer" class="footer-block">
        <div class="container">
            <div class="row">
                <div id="copyright" class="col-xs-12 col-sm-6 col-md-6">
                    <?php
                    echo ent2ncr($zoo_copyright_text);
                    ?>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 bottom-footer-block">
                    <?php
                    if (has_nav_menu('landing')) {
                        wp_nav_menu(array('container_class' => 'main-menu', 'theme_location' => 'landing', 'container' => 'nav'));
                    } else {
                        wp_nav_menu(array('container_class' => 'main-menu', 'container' => 'nav'));
                    }?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
