<?php
/**
 * Top Header Template
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2017 Zootemplate
 * @license     GPL v2
 */
?>
<?php if(is_active_sidebar('topbar-2')): ?>
	<div id="top-header-2" class="top-header">
		<?php dynamic_sidebar('topbar-2'); ?>
		<span class="close-topbar"><i class="cs-font clever-icon-close"></i></span>
	</div>
<?php endif; ?>