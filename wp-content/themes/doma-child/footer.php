<?php
/**
 * Default site footer
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2017 Zootemplate
 * @license     GPL v2
 */
$zoo_footer_fullwidth = zoo_footer_fullwidth();
$zoo_top_footer = zoo_top_footer();
$zoo_footer_layout = zoo_footer_layout();
$zoo_footer_class = 'wrap-' . $zoo_footer_layout . '-layout';
if(zoo_enable_footer_sticky() == '1'){
	$zoo_footer_class .= ' sticky ';
}
$zoo_footer_class .= ' '.$zoo_footer_fullwidth;
if ($zoo_top_footer) {
    $zoo_footer_class .= ' top-footer-active';
}
?>
<?php if(zoo_enable_footer_sticky() == '1') : ?>
<div class="sticky-footer"></div>
<?php endif; ?>
<footer id="zoo-footer" class="<?php echo esc_attr($zoo_footer_class) ?>">
    <?php
    if ($zoo_top_footer) {
        get_template_part('/inc/templates/footer/top', 'footer');
    }
    get_template_part('/inc/templates/footer/' . $zoo_footer_layout, 'layout');
    ?>
</footer>
<?php
if (zoo_boxes()) : ?>
    </div>
<?php endif;
wp_footer();
?>

<script>
    jQuery(".toggle-menu").click(function(e) {
        jQuery(".header-menu-list").toggleClass("toggled");
    });
	
	
	jQuery(document).ready(function(){
	 jQuery("#menu-home-menu .menu-item-has-children > a").addClass("fa-plus");
	 jQuery("#menu-home-menu .menu-item-has-children > a") .click(function(){
     jQuery(this).toggleClass("fa-minus show") .toggleClass("fa-plus");
   //  jQuery(".main-nav-bar").css({ top: '350px' });
	 })
	})
    </script>
</body>
</html>