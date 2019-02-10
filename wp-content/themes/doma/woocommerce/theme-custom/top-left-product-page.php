<?php
/**
 * Display layout control of product page
 * @since: zoo-theme 1.0
 * @version: 1.0
 */
?>
<?php if(get_theme_mod('zoo_show_products_layout') || (zoo_woo_sidebar() == 'canvas-sidebar' || zoo_woo_sidebar() == 'horizontal-sidebar') ): ?>
<div class="left-top-product-page">
	<ul class="layout-control-block">
		<?php if(zoo_woo_sidebar() == 'canvas-sidebar' || zoo_woo_sidebar() == 'horizontal-sidebar'): ?>
	    <li class="control-item sidebar-control">
	        <a href="#" class="<?php echo esc_attr(zoo_woo_sidebar_status()) ?>"
	           title="<?php echo esc_attr__('Show/Hide Sidebar', 'doma'); ?>">
	            <i class="cs-font clever-icon-funnel-o" aria-hidden="true"></i>
	            <span><?php echo esc_html__('Filter','doma');?></span>
	        </a>
	    </li>
		<?php endif; ?>
		<?php if(get_theme_mod('zoo_show_products_layout')): ?>
		<li class="control-item layout">
        <a href="#" title="<?php echo esc_attr__('Switch to Grid Layout','doma');?>" class="layout-control grid-layout <?php echo esc_attr(zoo_woo_layout()=='grid-layout'?'active':'')?>">
            <i class="cs-font clever-icon-grid"></i>
        </a>
	    </li>
	    <li class="control-item layout">
	        <a href="#" title="<?php echo esc_attr__('Switch to List Layout','doma');?>"  class="layout-control list-layout  <?php echo esc_attr(zoo_woo_layout()=='list-layout'?'active':'')?>">
	            <i class="cs-font clever-icon-list"></i>
	        </a>
	    </li>
		<?php endif; ?>
	</ul>
</div>
<?php endif; ?>
<div class="left-top-product-page mb-filter-button">
	<ul class="layout-control-block">
	    <li class="control-item sidebar-control">
	        <a href="#" class="<?php echo esc_attr(zoo_woo_sidebar_status()) ?>"
	           title="<?php echo esc_attr__('Show/Hide Sidebar', 'doma'); ?>">
	            <i class="cs-font clever-icon-funnel-o" aria-hidden="true"></i>
	            <span><?php echo esc_html__('Filter','doma');?></span>
	        </a>
	    </li>
		
	</ul>
</div>