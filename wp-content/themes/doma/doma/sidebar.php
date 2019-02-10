<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2017 Zootemplate
 * @license     GPL v2
 */
$sidebar = zoo_get_sidebar_config();
if ($sidebar['left'] != 'none')  { ?>
    <aside id="sidebar-left" class="sidebar widget-area col-xs-12 col-sm-3 col-md-3">
        <?php dynamic_sidebar($sidebar['left']); ?>
    </aside>
<?php } ?>