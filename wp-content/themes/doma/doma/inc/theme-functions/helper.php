<?php
//Sticky footer
if (!function_exists('zoo_enable_footer_sticky')) {
    function zoo_enable_footer_sticky()
    {
        $zoo_enable_footer_sticky = get_theme_mod('zoo_enable_footer_sticky', '0');

        if (get_post_meta(get_the_ID(), 'zoo_enable_footer_sticky', true) != '' && get_post_meta(get_the_ID(), 'zoo_enable_footer_sticky', true) != '0') {
            $zoo_enable_footer_sticky = get_post_meta(get_the_ID(), 'zoo_enable_footer_sticky', true);
        }
        return $zoo_enable_footer_sticky;
    }
}
//header layout
if (!function_exists('zoo_header_layout')) {
    function zoo_header_layout()
    {
        $zoo_header_layout = get_theme_mod('zoo_header_layout', 'style-2');

        if (get_post_meta(get_the_ID(), 'zoo_header_layout', true) != '' && get_post_meta(get_the_ID(), 'zoo_header_layout', true) != 'inherit') {
            $zoo_header_layout = get_post_meta(get_the_ID(), 'zoo_header_layout', true);
        }
        return $zoo_header_layout;
    }
}
//Header stick
if (!function_exists('zoo_header_stick')) {
    function zoo_header_stick()
    {
        $zoo_sticky = '';
        if (get_theme_mod('zoo_header_sticky', '1') == 1) {
            $zoo_sticky = 'sticker';
        }
        if (is_page() || is_single()) {
            if (get_post_meta(get_the_ID(), 'zoo_header_sticky', true) == '1') {
                $zoo_sticky = 'sticker';
            }
        }
        return $zoo_sticky;
    }
}
//Header transparent
if (!function_exists('zoo_header_transparent')) {
    function zoo_header_transparent()
    {
        $zoo_header_transparent = '';
        if (get_theme_mod('zoo_enable_header_transparent', '')) {
            $zoo_header_transparent = 'header-transparent';
        }
        if (is_page()) {
            if (get_post_meta(get_the_ID(), 'zoo_enable_header_transparent', true) == '1') {
                $zoo_header_transparent = 'header-transparent';
            }
        }
        return $zoo_header_transparent;
    }
}
//Header fullwidth
if (!function_exists('zoo_header_fullwidth')) {
    function zoo_header_fullwidth()
    {
        $zoo_header_fullwidth = '';
        if (get_theme_mod('zoo_enable_header_fullwidth', '0')) {
            $zoo_header_fullwidth = 'full-width';
        }
        if (is_page() || is_single()) {
            if (get_post_meta(get_the_ID(), 'zoo_enable_header_fullwidth', true) == '1') {
                $zoo_header_fullwidth = 'full-width';
            }
        }
        return $zoo_header_fullwidth;
    }
}
//Header canvas
if (!function_exists('zoo_header_canvas_sidebar')) {
    function zoo_header_canvas_sidebar()
    {
        $zoo_header_canvas_sidebar = get_theme_mod('zoo_header_canvas_sidebar', '0');
        if (is_page() || is_single()) {
            if (get_post_meta(get_the_ID(), 'zoo_header_canvas_sidebar', true) == '1') {
                $zoo_header_canvas_sidebar = true;
            }
        }
        if(wp_is_mobile()){
            $zoo_header_canvas_sidebar = true;
        }
        return $zoo_header_canvas_sidebar;
    }
}
//Header fullwidth
if (!function_exists('zoo_enable_header_top')) {
    function zoo_enable_header_top()
    {
        $zoo_header_top = get_theme_mod('zoo_enable_top_header', '1');
        if (get_post_meta(get_the_ID(), 'zoo_top_header', true) != 'inherit' && get_post_meta(get_the_ID(), 'zoo_top_header', true) != '') {
            $zoo_header_top = get_post_meta(get_the_ID(), 'zoo_top_header', true);
        }
        return $zoo_header_top;
    }
}
if (!function_exists('zoo_enable_top_header_slogun')) {
    function zoo_enable_top_header_slogun()
    {
        $zoo_enable_top_header_slogun = get_theme_mod('zoo_enable_top_header_slogun', '1');
        if (get_post_meta(get_the_ID(), 'zoo_enable_top_header_slogun', true) == '1' ) {
            $zoo_enable_top_header_slogun = '0';
        }
        return $zoo_enable_top_header_slogun;
    }
}
//Body full width
if (!function_exists('zoo_full_width')) {
    function zoo_full_width()
    {
        $zoo_fullwidth = get_theme_mod('zoo_enable_page_full_width') == 1 ? true : false;
        if (is_page() || is_single()) {
            $zoo_page_layout = get_post_meta(get_the_ID(), 'zoo_page_layout', true);
            if ($zoo_page_layout == 'full-width') {
                $zoo_fullwidth = true;
            } else if ($zoo_page_layout == 'boxed') {
                $zoo_fullwidth = false;
            }
        }
        return $zoo_fullwidth;
    }
}
//Boxed layout
if (!function_exists('zoo_boxes')) {
    function zoo_boxes()
    {
        $zoo_boxed = get_theme_mod('zoo_site_layout', '') == 'boxed' ? true : false;
        if (is_page() || is_single()) {
            $zoo_page_layout = get_post_meta(get_the_ID(), 'zoo_page_layout', true);
            if ($zoo_page_layout == 'full-width') {
                $zoo_boxed = false;
            } else if ($zoo_page_layout == 'boxes') {
                $zoo_boxed = true;
            }
        }
        return $zoo_boxed;
    }
}
//End functions control header layout
//header layout
if (!function_exists('zoo_footer_layout')) {
    function zoo_footer_layout()
    {
        $zoo_footer_layout = 'style-1';
        if (get_theme_mod('zoo_footer_layout', 'style-1') != '') {
            $zoo_footer_layout = get_theme_mod('zoo_footer_layout', 'style-1');
        }
        if (is_page() || is_single()) {
            if (get_post_meta(get_the_ID(), 'zoo_footer_layout', true) != '' && get_post_meta(get_the_ID(), 'zoo_footer_layout', true) != 'inherit') {
                $zoo_footer_layout = get_post_meta(get_the_ID(), 'zoo_footer_layout', true);
            }
        }
        return $zoo_footer_layout;
    }
}
//Function control Footer
if (!function_exists('zoo_top_footer')) {
    function zoo_top_footer()
    {
        $zoo_top_footer = false;
        if (get_theme_mod('zoo_top_footer', '0') == 1) {
            $zoo_top_footer = true;
        }
        if (is_page() || is_single()) {
            if (get_post_meta(get_the_ID(), 'zoo_top_footer', true) == '1') {
                $zoo_top_footer = true;
            }
        }
        return $zoo_top_footer;
    }
}
//End Function control Footer
if (!function_exists('zoo_main_footer')) {
    function zoo_main_footer()
    {
        $zoo_main_footer = false;
        if (get_theme_mod('zoo_main_footer', '1') == '1') {
            $zoo_main_footer = true;
        }
        if (is_page() || is_single()) {
            if (get_post_meta(get_the_ID(), 'zoo_main_footer', true) == '1') {
                $zoo_main_footer = true;
            }
        }
        return $zoo_main_footer;
    }
}
//Footer fullwidth
if (!function_exists('zoo_footer_fullwidth')) {
    function zoo_footer_fullwidth()
    {
        $zoo_footer_fullwidth = '';
        if (get_theme_mod('zoo_enable_footer_fullwidth', '0')) {
            $zoo_footer_fullwidth = 'full-width';
        }
        if (is_page() || is_single()) {
            if (get_post_meta(get_the_ID(), 'zoo_enable_footer_fullwidth', true) == '1') {
                $zoo_footer_fullwidth = 'full-width';
            }
        }
        return $zoo_footer_fullwidth;
    }
}

// Check sidebar layout use on post/archive/category
if (!function_exists('zoo_get_sidebar')) {
    function zoo_get_sidebar($sidebar = 'left')
    {
        $sidebar_option =is_single()? get_post_meta(get_the_ID(), 'zoo_sidebar_options', true):'';
        if($sidebar_option=='no-sidebar'){
            $sidebar_config='none';
        }else {
            if ($sidebar == 'left') {
                $sidebar = 'zoo_blog_sidebar_left';
                $sidebar_config = get_theme_mod($sidebar) != '' ? get_theme_mod($sidebar) : 'none';
                if ($sidebar_option == 'left-sidebar') {
                    $sidebar_config = get_post_meta(get_the_ID(), 'zoo_left_sidebar', true);
                }elseif ($sidebar_option == 'right-sidebar') {
                    $sidebar_config = 'none';
                }
            } else {
                $sidebar = 'zoo_blog_sidebar_right';
                $sidebar_config = get_theme_mod($sidebar, 'sidebar-1') != '' ? get_theme_mod($sidebar, 'sidebar-1') : 'none';
                if ($sidebar_option == 'right-sidebar') {
                    $sidebar_config = get_post_meta(get_the_ID(), 'zoo_right_sidebar', true);
                }elseif ($sidebar_option == 'left-sidebar') {
                    $sidebar_config = 'none';
                }
            }
        }
        return $sidebar_config;
    }
}

if (!function_exists('zoo_get_sidebar_config')) {
    function zoo_get_sidebar_config(){
        $zoo_get_sidebar = array();
        $zoo_get_sidebar['right'] = 'sidebar-1';
        $zoo_get_sidebar['left'] = 'none';
        $zoo_get_sidebar['has-sidebar'] = 'has-right-sidebar';
        $zoo_get_sidebar['col'] = 'col-xs-12 col-sm-9 col-md-9';

        get_theme_mod('zoo_blog_sidebar_left', 'none') == ''?$left_cus ='none' : $left_cus = get_theme_mod('zoo_blog_sidebar_left', 'none');
        get_theme_mod('zoo_blog_sidebar_right', 'sidebar-1') == ''?$right_cus = 'sidebar-1' : $right_cus = get_theme_mod('zoo_blog_sidebar_right', 'sidebar-1');
        if($left_cus != 'none' && $right_cus != 'none'){
            $zoo_get_sidebar['left'] = $left_cus;
            $zoo_get_sidebar['right'] = $right_cus;
            $zoo_get_sidebar['col'] = 'col-xs-12 col-sm-6 col-md-6';
            $zoo_get_sidebar['has-sidebar'] = 'has-left-sidebar has-right-sidebar';
        }
        if($left_cus == 'none' && $right_cus != 'none'){
            $zoo_get_sidebar['left'] = 'none';
            $zoo_get_sidebar['right'] = $right_cus;
            $zoo_get_sidebar['col'] = 'col-xs-12 col-sm-9 col-md-9';
            $zoo_get_sidebar['has-sidebar'] = 'has-right-sidebar';
        }
        if($left_cus != 'none' && $right_cus == 'none'){
            $zoo_get_sidebar['left'] = $left_cus;
            $zoo_get_sidebar['right'] = 'none';
            $zoo_get_sidebar['col'] = 'col-xs-12 col-sm-9 col-md-9';
            $zoo_get_sidebar['has-sidebar'] = 'has-left-sidebar';
        }
        if($left_cus == 'none' && $right_cus == 'none'){
            $zoo_get_sidebar['left'] = 'none';
            $zoo_get_sidebar['right'] = 'none';
            $zoo_get_sidebar['col'] = 'col-xs-12 col-sm-12 col-md-12';
            $zoo_get_sidebar['has-sidebar'] = '';
        }

        
        $sidebar_meta = get_post_meta(get_the_ID(), 'zoo_sidebar_options', true);
        switch ($sidebar_meta) {
            case 'inherit':
                break;
            case 'no-sidebar':
                $zoo_get_sidebar['left'] = 'none';
                $zoo_get_sidebar['right'] = 'none';
                $zoo_get_sidebar['col'] = 'col-xs-12 col-sm-12 col-md-12';
                break;
            case 'left-sidebar':
                $zoo_get_sidebar['left'] = get_post_meta(get_the_ID(), 'zoo_left_sidebar', true);
                $zoo_get_sidebar['right'] = 'none';
                $zoo_get_sidebar['col'] = 'col-xs-12 col-sm-9 col-md-9';
                $zoo_get_sidebar['has-sidebar'] = 'has-left-sidebar';
                break;
            case 'right-sidebar':
                $zoo_get_sidebar['right'] = get_post_meta(get_the_ID(), 'zoo_right_sidebar', true);
                $zoo_get_sidebar['left'] = 'none';
                $zoo_get_sidebar['col'] = 'col-xs-12 col-sm-9 col-md-9';
                $zoo_get_sidebar['has-sidebar'] = 'has-right-sidebar';
                break;
            case 'both-sidebar':
                $zoo_get_sidebar['right'] = get_post_meta(get_the_ID(), 'zoo_right_sidebar', true);
                $zoo_get_sidebar['left'] = get_post_meta(get_the_ID(), 'zoo_left_sidebar', true);
                $zoo_get_sidebar['col'] = 'col-xs-12 col-sm-6 col-md-6';
                $zoo_get_sidebar['has-sidebar'] = 'has-left-sidebar has-right-sidebar';
                break;
            default:
                break;
        }    
        return $zoo_get_sidebar;
    }
}
//Edit password form
if (!function_exists('zoo_password_form')) {
    function zoo_password_form()
    {
        global $post;
        $zoo_id = 'pwbox-' . (empty($post->ID) ? rand() : $post->ID);
        $zoo_form = '<div class="zoo-form-login"><form action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" method="post"><h4>
    ' . esc_html__('To view this protected post, enter the password below:', 'doma') . '</h4>
    <input name="post_password" id="' . $zoo_id . '" type="password" size="20" maxlength="20" placeholder="' . esc_attr__('Enter Password', 'doma') . ' " /><br><input type="submit" name="Submit" value="' . esc_attr__('Submit', 'doma') . '" />
    </form></div>
    ';
        return $zoo_form;
    }
}
add_filter('the_password_form', 'zoo_password_form');
//Convert to rgba
if (!function_exists('zoo_hex2rgba')) {
    /* Convert hexdec color string to rgb(a) string */
    function zoo_hex2rgba($hex, $opacity = 1)
    {
        $hex = str_replace("#", "", $hex);
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgba = 'rgba(' . $r . ',' . $g . ',' . $b . ',' . $opacity . ')';
        
        return $rgba; // returns an array with the rgb values
    }
}
// Blog single post format
if(!function_exists('single_post_format_class')){
    function single_post_format_class(){
        $post_format = get_post_format( get_the_ID() );
        if(has_post_thumbnail()){
            $post_format = 'post-standard';
        }
        return $post_format;
    }
}
/* Body class*/
add_filter('body_class', 'zoo_body_custom_class');
if (!function_exists('zoo_body_custom_class')) {
   function zoo_body_custom_class($classes)
   {
        if (zoo_boxes()) {
            $classes[] = 'boxes-page';
        }
        $zoo_header_layout = zoo_header_layout();
        $zoo_header_layout == 'style-8'?$vertical = 'header-vertical': $vertical ='';
        $classes[] = zoo_header_transparent().' '.$vertical;

       return $classes;
   }
}
if(!function_exists('zoo_columns')){
    function zoo_columns($col_xs = 1,$col_sm = 2,$col_md = 3){
        switch ($col_xs) {
            case 1:
                $class ="col-xs-12";
                break;
            case 2:
                $class = "col-xs-6";
                break;
            case 3:
                $class = "col-xs-4";
                break;
            case 4:
                $class = "col-xs-3";
                break;
            case 5:
                $class ="col-xs-1-5";
                break;
            case 6:
                $class = "col-xs-2";
                break;
            default:
                $class = "col-xs-12";
                break;
        }
        switch ($col_sm) {
            case 1:
                $class .=" col-sm-12";
                break;
            case 2:
                $class .= " col-sm-6";
                break;
            case 3:
                $class .= " col-sm-4";
                break;
            case 4:
                $class .= " col-sm-12-3";
                break;
            case 5:
                $class .=" col-sm-1-5";
                break;
            case 6:
                $class .= " col-sm-2";
                break;
            default:
                $class .= " col-sm-12";
                break;
        }
        switch ($col_md) {
            case 1:
                $class .=" col-md-12";
                break;
            case 2:
                $class .= " col-md-6";
                break;
            case 3:
                $class .= " col-md-4";
                break;
            case 4:
                $class .= " col-md-3";
                break;
            case 5:
                $class .= " col-md-1-5";
                break;
            case 6:
                $class .= " col-md-2";
                break;
            default:
                $class .= " col-md-12";
                break;
        }
        return $class;
        
    }
}