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
if ($zoo_main_footer) {
    if (is_active_sidebar('main-footer-1') || is_active_sidebar('main-footer-2') || is_active_sidebar('main-footer-3') || is_active_sidebar('main-footer-4')) { ?>
        <div id="main-footer" class="footer-block">
            <div class="container">
                <div class="wrap-main-footer row">
                    <div class="col-xs-12 col-sm-4 main-footer-block">
                        <?php dynamic_sidebar('main-footer-1'); ?>
                    </div>
                    <div class="col-xs-12 col-sm-4 main-footer-block two-cols">
                        <?php dynamic_sidebar('main-footer-2'); ?>
                        <?php dynamic_sidebar('main-footer-3'); ?>
                    </div>
                    <div class="col-xs-12 col-sm-4 main-footer-block">
                        <?php dynamic_sidebar('main-footer-4'); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if(get_post_meta(get_the_ID(),'zoo_enable_separator_fullwidth',true) == true) : ?>
    <div class="separator">
        <hr>
    </div>
    <?php else : ?>
        <div class="container separator">
            <hr class="row">
        </div>
    <?php endif; ?>
<?php }
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
                    <ul class="pay-list">
                        <?php 
                            if($pays):
                            foreach( $pays as $pay ) :
                                $image_url = wp_get_attachment_image($pay['image'],'full');
                                $image_url = wp_get_attachment_image( $pay['image'], array( 57, 58 ), false, array( "class" => "svg-icon" ) );
                                $url = $pay['link_url'];?>
                                <li class="payment-icon">
                                    <a href="<?php echo esc_url($url); ?>">
                                        <?php echo ent2ncr($image_url); ?>
                                    </a>
                                </li>
                            <?php endforeach; endif;
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
