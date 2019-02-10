<?php
/**
 * Post Label block
 *
 * @package     Doma
 * @version     1.0.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2017 Zootemplate
 * @license     GPL v2
 */
?>

<?php if (is_sticky()) {
    ?>
    <ul class="post-label">
        <li class="sticky-post-label"><?php echo esc_html__('Featured', 'doma') ?></li>
    </ul>
    <?php
}
    //$zoo_categories = get_the_category(get_the_ID());
if (!empty($zoo_categories)) {
    foreach ($zoo_categories as $zoo_category) {
        ?>
        <ul class="post-label">
            <li class="cat-post-label">
                <a href="<?php echo get_category_link( $zoo_category->term_id );?>" title="<?php echo esc_attr( $zoo_category->name);?>">
                    <?php echo esc_html( $zoo_category->name);?>
                </a>
            </li>
        </ul>
<?php
    }
}
?>