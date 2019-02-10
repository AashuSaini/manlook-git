<?php
/**
 * Content helpers
 *
 * @package  CVCA\Helpers
 */

/**
 * Correct WordPress excerpt
 *
 * @param  object  $post    \WP_Post
 * @param  int     $length  Expected excerpt length.
 * @param  string  $more    Read more string.
 *
 * @see https://developer.wordpress.org/reference/functions/get_post/
 *
 * @return  string
 */
function cvca_get_excerpt($length = 55)
{
    $post = get_post(null);
    $text = $post->post_excerpt ? : $post->post_content;
    $text = do_shortcode($text);
    $text = strip_shortcodes($text);
    $text = str_replace(']]>', ']]&gt;', $text);
    $text = wp_trim_words($text, $length, false);

    return $text.'...';
}

/**
 * Word limit
 *
 * @param  string  $text
 * @param  int     $length  Expected excerpt length.
 * @param  string  $end     End string for excerpt.
 *
 * @return  string
 */
function cvca_word_limit( $text = '', $length = 16, $end = '[&hellip;]' ) {

    $text = strip_shortcodes( $text );

    $text = str_replace(']]>', ']]&gt;', $text);

    $text = wp_trim_words( $text, $length, $end );

    return $text;
}

/**
 * Get course categories data for VC
 */
function get_course_categories_for_vc()
{
    $data = array();
    $tax_slug = esc_attr( apply_filters( 'sensei_course_category_slug', _x( 'course-category', 'taxonomy archive slug', 'cvca' ) ) );

    $query = new WP_Term_Query(array(
        'hide_empty' => true,
        'taxonomy'   => $tax_slug,
    ));

    if (!empty($query->terms)) {
        foreach ($query->terms as $cat) {
            $cat_data = array('label' => $cat->name, 'value' => $cat->slug);
            $data[] = $cat_data;
        }
    }

    return $data;
}

/**
 * Get sensei courses data for vc
 */
function get_sensei_courses_data_for_vc()
{
    $data = array();

    $query = new WP_Query(array(
        'post_type'           => 'course',
        'post_status'         => 'publish',
        'suppress_filters'    => true,
        'no_found_rows'       => true,
        'ignore_sticky_posts' => true
    ));

    if (!empty($query->posts)) {
        foreach ($query->posts as $course) {
            $course_data = array('label' => $course->post_title, 'value' => $course->post_name);
            $data[] = $course_data;
        }
    }

    return $data;
}

if ( ! function_exists( 'zoo_scrape_instagram' ) ) {
    // based on https://gist.github.com/cosmocatalano/4544576
    function zoo_scrape_instagram( $username ) {

        $username = trim( strtolower( $username ) );

        switch ( substr( $username, 0, 1 ) ) {
            case '#':
                $url              = 'https://instagram.com/explore/tags/' . str_replace( '#', '', $username );
                $transient_prefix = 'h';
                break;

            default:
                $url              = 'https://instagram.com/' . str_replace( '@', '', $username );
                $transient_prefix = 'u';
                break;
        }

        if ( false === ( $instagram = get_transient( 'insta-a10-' . $transient_prefix . '-' . sanitize_title_with_dashes( $username ) ) ) ) {

            $remote = wp_remote_get( $url );

            if ( is_wp_error( $remote ) ) {
                return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'wp-instagram-widget' ) );
            }

            if ( 200 !== wp_remote_retrieve_response_code( $remote ) ) {
                return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'wp-instagram-widget' ) );
            }

            $shards      = explode( 'window._sharedData = ', $remote['body'] );
            $insta_json  = explode( ';</script>', $shards[1] );
            $insta_array = json_decode( $insta_json[0], true );

            if ( ! $insta_array ) {
                return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'wp-instagram-widget' ) );
            }

            if ( isset( $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'] ) ) {
                $images = $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'];
            } elseif ( isset( $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'] ) ) {
                $images = $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'];
            } else {
                return new WP_Error( 'bad_json_2', esc_html__( 'Instagram has returned invalid data.', 'wp-instagram-widget' ) );
            }

            if ( ! is_array( $images ) ) {
                return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'wp-instagram-widget' ) );
            }

            $instagram = array();

            foreach ( $images as $image ) {
                if ( true === $image['node']['is_video'] ) {
                    $type = 'video';
                } else {
                    $type = 'image';
                }

                $caption = __( 'Instagram Image', 'wp-instagram-widget' );
                if ( ! empty( $image['node']['edge_media_to_caption']['edges'][0]['node']['text'] ) ) {
                    $caption = wp_kses( $image['node']['edge_media_to_caption']['edges'][0]['node']['text'], array() );
                }

                $instagram[] = array(
                    'description' => $caption,
                    'link'        => trailingslashit( '//instagram.com/p/' . $image['node']['shortcode'] ),
                    'time'        => $image['node']['taken_at_timestamp'],
                    'comments'    => $image['node']['edge_media_to_comment']['count'],
                    'likes'       => $image['node']['edge_liked_by']['count'],
                    'thumbnail'   => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][0]['src'] ),
                    'small'       => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][2]['src'] ),
                    'large'       => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][4]['src'] ),
                    'original'    => preg_replace( '/^https?\:/i', '', $image['node']['display_url'] ),
                    'type'        => $type,
                );
            } // End foreach().

            // do not set an empty transient - should help catch private or empty accounts.
            if ( ! empty( $instagram ) ) {
                $instagram = base64_encode( serialize( $instagram ) );
                set_transient( 'insta-a10-' . $transient_prefix . '-' . sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS * 2 ) );
            }
        }

        if ( ! empty( $instagram ) ) {

            return unserialize( base64_decode( $instagram ) );

        } else {

            return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'wp-instagram-widget' ) );

        }
    }
}

if ( ! function_exists( 'zoo_images_only' ) ) {
    function zoo_images_only( $media_item ) {

        if ( $media_item['type'] == 'image' )
            return true;

        return false;
    }
}

if ( ! function_exists( 'zoo_abbreviate_total_count' ) ) {
    function zoo_abbreviate_total_count( $value, $floor = 0 ) {
        if ( $value >= $floor ) {
            $abbreviations = array(12 => 'T', 9 => 'B', 6 => 'M', 3 => 'K', 0 => '');

            foreach ( $abbreviations as $exponent => $abbreviation ) {
                if ( $value >= pow(10, $exponent) ) {
                    return round(floatval($value / pow(10, $exponent)),1).$abbreviation;
                }
            }
        } else {
            return $value;
        }
    }
}

if ( ! function_exists( 'zoo_time_elapsed_string' ) ) {
    function zoo_time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}
