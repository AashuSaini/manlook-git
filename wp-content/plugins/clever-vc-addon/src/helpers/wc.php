<?php
/**
 * Visual Composer Woocommerce helpers
 */
if(!function_exists('cvca_ajax_product_filter')){

    function cvca_ajax_product_filter(){

        $product_ids = $asset_type = $filter_categories = $posts_per_page = $orderby = $order = null;
        if(isset($_POST['product_ids'])){
            $product_ids = $_POST['product_ids'];
        }
        if(isset($_POST['asset_type'])){
            $asset_type = $_POST['asset_type'];
        }
        if(isset($_POST['filter_categories'])){
            $filter_categories = $_POST['filter_categories'];
        }
        if(isset($_POST['posts_per_page'])){
            $posts_per_page = $_POST['posts_per_page'];
        }
        if(isset($_POST['orderby'])){
            $orderby = $_POST['orderby'];
        }
        if(isset($_POST['order'])){
            $order = $_POST['order'];
        }
        
        if ( is_front_page() ) {
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;   
        } else {
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
        }
        $wc_attr = array(
            'post_type' => 'product',
            'product_cat' =>  $filter_categories,
            'posts_per_page' => $posts_per_page,
            'paged' => $paged,
            'orderby' => $orderby,
            'order' => $order,
            'post__not_in'=> $product_ids,
            
        );


        if($asset_type){
            switch ($asset_type) {
                case 'featured':
                    $meta_query[] = array(
                        array(
                            'taxonomy' => 'product_visibility',
                            'field'    => 'name',
                            'terms'    => 'featured',
                            'operator' => 'IN'
                        ),
                    );
                    $wc_attr['tax_query'] = $meta_query;
                    break;
                case 'onsale':
                    $product_ids_on_sale = wc_get_product_ids_on_sale();
                    $wc_attr['post__in'] = $product_ids_on_sale;
                    break;
                case 'best-selling':
                    $wc_attr['meta_key'] = 'total_sales';
                    $wc_attr['orderby']  = 'meta_value_num';
                    break;
                case 'latest':
                    $wc_attr['orderby'] = 'date';
                    break;
                case 'toprate':
                    add_filter('posts_clauses', array('WC_Shortcode_Products', 'order_by_rating_post_clauses'));
                    break;
                case 'deal':
                    $product_ids_on_sale = wc_get_product_ids_on_sale();
                    $wc_attr['post__in'] = $product_ids_on_sale;
                    $wc_attr['meta_query'] = array(
                        'relation' => 'AND',
                        array(
                            'key' => '_sale_price_dates_to',
                            'value' => time(),
                            'compare' => '>'
                        )
                    );
                    break;
                default:
                    break;
            }
        }


        if(isset($_POST['product_attribute']) && isset($_POST['attribute_value'])){
            if(is_array($_POST['product_attribute'])){
                foreach ($_POST['product_attribute'] as $key => $value) {
                    $tax_query[] = array(
                        'taxonomy' => $value,
                        'terms' => $_POST['attribute_value'][$key],
                        'field'         => 'slug',
                        'operator'      => 'IN'
                    );
                }
            }else {
                $tax_query[] = array(
                    'taxonomy' => $_POST['product_attribute'],
                    'terms' => $_POST['attribute_value'],
                    'field'         => 'slug',
                    'operator'      => 'IN'
                );

            }
        }

        if(isset($_POST['product_tag'])){
            $wc_attr['product_tag'] = $_POST['product_tag'];
        }

        if(isset($_POST['price_filter']) && $_POST['price_filter'] > 0 ){

            $min = (intval($_POST['price_filter']) - 1)*intval($_POST['price_filter_range']);
            $max = intval($_POST['price_filter'])*intval($_POST['price_filter_range']);
            $meta_query[] = array(
                'key' => '_price',
                'value' => array($min, $max),
                'compare' => 'BETWEEN',
                'type' => 'NUMERIC'
            );
        }

        if(isset($_POST['s']) && $_POST['s'] != '' ){
            $wc_attr['s'] = $_POST['s'];
        }

        $product_query = new WP_Query(apply_filters('woocommerce_shortcode_products_query', $wc_attr));
        ob_start();?>
        <ul class="products">
            <?php while ($product_query->have_posts()) {
                $product_query->the_post();
                wc_get_template_part( 'content', 'product' );
            }
            ?>
        </ul>
        <?php
        $output = ob_get_contents();
        ob_end_clean();
        wp_reset_postdata();
        echo ent2ncr($output);

    }

    add_action('wp_ajax_cvca_ajax_product_filter', 'cvca_ajax_product_filter');
    add_action( 'wp_ajax_nopriv_cvca_ajax_product_filter', 'cvca_ajax_product_filter' );
}
if(!function_exists('cvca_ajax_product_search')){
    function cvca_ajax_product_search(){
        if(isset($_POST['cvca_search'])){
            echo cvca_get_shortcode_view( 'product', '','' );
        }
    }
    add_action('wp_ajax_cvca_ajax_product_search', 'cvca_ajax_product_search');
    add_action( 'wp_ajax_nopriv_cvca_ajax_product_search', 'cvca_ajax_product_search' );
}

// hook into wp pre_get_posts
add_action('pre_get_posts', 'cvca_woo_search_pre_get_posts');

if(!function_exists('cvca_woo_search_pre_get_posts')) {
    function cvca_woo_search_pre_get_posts($q)
    {

        if (is_search()) {
            add_filter('posts_join', 'cvca_search_post_join');
            add_filter('posts_where', 'cvca_search_post_excerpt');
        }
    }
}

if(!function_exists('cvca_search_post_join')) {
    function cvca_search_post_join($join = '')
    {

        global $wp_the_query;

        // escape if not woocommerce searcg query
        if (empty($wp_the_query->query_vars['wc_query']) || empty($wp_the_query->query_vars['cvca_search']))
            return $join;

        $join .= "INNER JOIN wp_postmeta AS ritmeta ON (wp_posts.ID = ritmeta.post_id)";
        return $join;
    }
}

if(!function_exists('cvca_search_post_excerpt')) {
    function cvca_search_post_excerpt($where = ''){

        global $wp_the_query;

        // escape if not woocommerce search query
        if (empty($wp_the_query->query_vars['wc_query']) || empty($wp_the_query->query_vars['cvca_search']))
            return $where;

        $where = preg_replace("/post_title LIKE ('%[^%]+%')/", "post_title LIKE $1)
                    OR (ritmeta.meta_key = '_sku' AND CAST(ritmeta.meta_value AS CHAR) LIKE $1)
                    OR  (ritmeta.meta_key = '_author' AND CAST(ritmeta.meta_value AS CHAR) LIKE $1)
                    OR  (ritmeta.meta_key = '_publisher' AND CAST(ritmeta.meta_value AS CHAR) LIKE $1)
                    OR  (ritmeta.meta_key = '_format' AND CAST(ritmeta.meta_value AS CHAR) LIKE $1 ", $where);

        return $where;
    }
}
if (!function_exists('cvca_current_url')) {
    function cvca_current_url()
    {
        $s = $_SERVER;
        $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on');
        $sp = strtolower($s['SERVER_PROTOCOL']);
        $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
        $port = $s['SERVER_PORT'];
        $port = ((!$ssl && $port == '80') || ($ssl && $port == '443')) ? '' : ':' . $port;
        $host = (false && isset($s['HTTP_X_FORWARDED_HOST'])) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
        $host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
        return $protocol . '://' . $host . $s['REQUEST_URI'];
    }
}
/* Single product */
// Sold/Stock
if(!function_exists('zoo_sold_bar')) {
    function zoo_sold_bar() {          
        global $product;       
        $result = array();     
        $result['sold'] = (int)get_post_meta( get_the_ID(), 'total_sales', true );   
        $result['stock'] = (int)get_post_meta( get_the_ID(), '_stock', true );
        if($result['stock']){
            $percent = $result['sold'] != 0 ? ($result['stock']/($result['sold'] + $result['stock']))*100 : 100;
            $parse_class = '';
            if ($percent < 40) {
               $parse_class = 'first-parse';
            } elseif ($percent >= 40 && $percent < 80) {
               $parse_class = 'second-parse';
            } else {
               $parse_class = 'final-parse';
            }
        ?>
        <div class="sold-bar <?php echo esc_attr($parse_class); ?>">
            <?php if($result['sold'] != 0): ?>
            <h4 class="sold-label">
                <?php echo esc_html__('Only','torano'); ?> 
                <span><?php echo esc_attr($result['stock']); ?></span>
                <?php echo esc_attr($result['stock']) > 1 ? esc_html__('items ','torano') : esc_html__('item ','torano');?>
                <?php echo esc_html__('left in stock!','torano'); ?>
            </h4>
            <?php else: ?>
            <h4 class="sold-label">
                <?php echo esc_html__('Buy','torano'); ?> 
                <span><?php echo esc_attr($result['stock']); ?></span>
                <?php echo esc_attr($result['stock']) > 1 ? esc_html__('items ','torano') : esc_html__('item ','torano');?>
                <?php echo esc_html__(' in stock!','torano'); ?>
            </h4>
            <?php endif; ?>
            <div class="sold-percent">
                <span style="width:<?php echo esc_attr($percent);?>%"></span>
            </div>
            <?php if( !is_product()): ?>
            <div class="sold-bar-count">
                <span><?php echo esc_html__('In Stock: ','torano'); ?><label><?php  echo esc_attr($result['stock']); ?></label></span>
                <span><?php echo esc_html__('Sold: ','torano'); ?><label><?php  echo esc_attr($result['sold']); ?></label></span>
            </div>
            <?php endif; ?>
        </div>
        <?php  
        }  
    }
}