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
if ($zoo_main_footer) :
    if (is_active_sidebar('main-footer-1-style-6')) : ?>
        <div id="main-footer" class="footer-block">
            <div class="container">
                <div class="wrap-main-footer row">
                    <div class="col-xs-12 col-sm-12 main-footer-block">
                        <?php dynamic_sidebar('main-footer-1-style-6'); ?>
                    </div>
                </div>
            </div>
        </div>
<?php endif;endif;