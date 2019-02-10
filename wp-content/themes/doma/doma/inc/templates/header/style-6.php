<?php
/**
 * Stack menu left
 * Template of Zoo Theme
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2017 Zootemplate
 * @license     GPL v2
 */
$zoo_sticky = zoo_header_stick();
?>
<div id="main-header" class="wrap-header-block <?php echo esc_attr($zoo_sticky) ?>">
    <div class="main-header-inner">
        
        
        
        <!--------- Custom header---------->
        
        <div class="container-fluid">
		<div class="block-left">
			<?php get_template_part('inc/templates/logo'); ?>
            <?php get_template_part('inc/templates/sticky','logo'); ?>
		</div>
		<div class="block-right">
			<div class="toggle-menu">
				<i class="fa fa-bars" aria-hidden="true"></i>
			</div>
			<div class="header-menu-list">
				<div class="toggle-menu close-btn">
					<i class="fa fa-times" aria-hidden="true"></i>
				</div>				
				<div class="main-nav-bar">
				    
				<?php wp_nav_menu(array('menu' => 'Home-Menu' , 'container_class' => '', 'theme_location' => ' ', 'container' => '')); ?>

				</div>
				<div class="social-icon-list">
				    <?php dynamic_sidebar('main-footer-1-style-1'); ?>
				</div>
			</div>
		</div>
	<div></div></div><!---- header----->
        
    </div>
</div>