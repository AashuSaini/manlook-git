<?php
/**
 */

$apply_ajax = isset($data['apply_ajax']) ? strval($data['apply_ajax']) : 0;
$custom_js_before_filter = isset($data['custom_js_before_filter']) ? wp_unslash($data['custom_js_before_filter']) : '';
$custom_js_after_filter = isset($data['custom_js_after_filter']) ? wp_unslash($data['custom_js_after_filter']) : '';
$jquery_selector_products = isset($data['jquery_selector_products']) ? strval($data['jquery_selector_products']) : 'ul.products';
$filter_logic_operator = isset($data['filter_logic_operator']) ? $data['filter_logic_operator'] : 'AND';
$jquery_selector_products_count = isset($data['jquery_selector_products_count']) ? strval($data['jquery_selector_products_count']) : '.woocommerce-result-count';
$jquery_selector_paging = isset($data['jquery_selector_paging']) ? strval($data['jquery_selector_paging']) : '.woocommerce-pagination';
?>

<form action="" method="post">
    <table class="form-table zoo-ln-table">
        <tbody>
        <tr>
            <th class=""><?php esc_html_e('Enable Ajax','clever-layered-navigation');?></th>
            <td class="">
                <fieldset>
                    <input name="apply_ajax" id="apply_ajax" class="" value="1" type="checkbox" <?php checked($apply_ajax, 1);?>>
                    <label for="apply_ajax">
                        <?php esc_html_e('If checked, products will be loaded syncronously. No page reload.','clever-layered-navigation');?>
                    </label>
                </fieldset>
            </td>
        </tr>
        <tr>
            <th class=""><?php esc_html_e( 'Logic Operator', 'clever-layered-navigation' )?></th>
            <td class="">
                <fieldset>
                    <select name="filter_logic_operator" id="filter_logic_operator">
                        <option value="AND" <?php selected($filter_logic_operator, 'AND'); ?>><?php esc_html_e( 'AND', 'clever-layered-navigation' )?></option>
                        <option value="OR" <?php selected($filter_logic_operator, 'OR'); ?>><?php esc_html_e( 'OR', 'clever-layered-navigation' )?></option>
                    </select>
                    <label for="filter_view_style">
                        <?php esc_html_e( '`AND` shows products that satisfy all active filters. `OR` shows products that satisfy one of active filters', 'clever-layered-navigation' )?>
                    </label>
                </fieldset>
            </td>
        </tr>        
        <tr>
            <th class=""><?php esc_html_e('Jquery Selector Products','clever-layered-navigation');?></th>
            <td class="">
                <fieldset>
                    <input name="jquery_selector_products" id="jquery_selector_products" class="" value="<?php echo($jquery_selector_products);?>" type="text">
                    <label for="jquery_selector_products">
                        <?php esc_html_e('Use for append content after filter.','clever-layered-navigation');?>
                    </label>
                </fieldset>
            </td>
        </tr>
        <tr>
            <th class=""><?php esc_html_e('Jquery Selector Products Count','clever-layered-navigation');?></th>
            <td class="">
                <fieldset>
                    <input name="jquery_selector_products_count" id="jquery_selector_products_count" class="" value="<?php echo($jquery_selector_products_count);?>" type="text">
                    <label for="jquery_selector_products_count">
                        <?php esc_html_e('Use for append products counts content after filter.','clever-layered-navigation');?>
                    </label>
                </fieldset>
            </td>
        </tr>
        <tr>
            <th class=""><?php esc_html_e('Jquery Selector Paging','clever-layered-navigation');?></th>
            <td class="">
                <fieldset>
                    <input name="jquery_selector_paging" id="jquery_selector_paging" class="" value="<?php echo($jquery_selector_paging);?>" type="text">
                    <label for="jquery_selector_paging">
                        <?php esc_html_e('Use for append paging content after filter.','clever-layered-navigation');?>
                    </label>
                </fieldset>
            </td>
        </tr>
        <tr>
            <th class=""><?php esc_html_e('Custom JS Before Filtering','clever-layered-navigation');?></th>
            <td class="">
                <fieldset>
                    <textarea name="custom_js_before_filter" rows="6" cols="60"><?php echo $custom_js_before_filter ?></textarea>
                    <label for="custom_js_before_filter">
                        <?php esc_html_e('Add your custom JavaScript code here. This code will run before filter(s) get triggered.','clever-layered-navigation');?>
                    </label>
                </fieldset>
            </td>
        </tr>
        <tr>
            <th class=""><?php esc_html_e('Custom JS After Filtering','clever-layered-navigation');?></th>
            <td class="">
                <fieldset>
                    <textarea name="custom_js_after_filter" rows="6" cols="60"><?php echo $custom_js_after_filter ?></textarea>
                    <label for="custom_js_after_filter">
                        <?php esc_html_e('Add your custom JavaScript code here. This code will run after filter(s) get triggered.','clever-layered-navigation');?>
                    </label>
                </fieldset>
            </td>
        </tr>
        </tbody>
    </table>
    <input type="submit" class="zoo-ln-button" value="<?php esc_attr_e( 'Save Changes', 'clever-layered-navigation' )?>">
    <?php wp_nonce_field( 'advanced_setting', 'zoo_ln_nonce_setting' ); ?>
</form>
