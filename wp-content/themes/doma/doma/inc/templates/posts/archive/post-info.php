<?php
/**
 * Block information for post
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2017 Zootemplate
 * @license     GPL v2
 */
?>
<div class="post-info">
	<span class="author-post"><?php echo esc_html__('By ','doma'); ?><?php the_author_posts_link(); ?></span>
	&nbsp; - &nbsp;
    <span class="date-post"><?php echo esc_html__('On ','doma'); ?><?php echo esc_html(get_the_date()); ?></span>
    &nbsp; - &nbsp;
    <?php echo esc_html__('In ','doma'); ?>
    <?php echo get_the_term_list(get_the_ID(), 'category', '<span class="list-cat">', ', ', '</span>'); ?>
</div>

