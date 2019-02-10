<?php
/**
 * RIT Core Plugin
 * @package     RIT Core
 * @version     2.3.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2015 Zootemplate
 * @license     GPL v2
 */

class RWMB_Font_Field extends RWMB_Field {
    /**
     * Get field HTML
     *
     * @param mixed $meta
     * @param array $field
     *
     * @return string
     */
    static function html( $meta, $field )
    {
        // Prepare meta value
        $meta = $meta == '' ? $field['std'] : $meta;

        // Print HTML
        ob_start();
        ?>
            <select name="<?php echo esc_attr( $field['id'] ); ?>" id="<?php echo esc_attr( $field['id'] ); ?>">
                <?php 
                    $options = meta_fonts();
                    foreach ( $options as $option ) { ?>
                        <option value="<?php echo esc_attr($option) ?>" <?php echo ( $meta == $option ) ? 'selected="selected"' : '' ?>><?php echo esc_attr( $option ); ?></option>
                    <?php }
                ?>
            </select>
            <script>
                ( function( $ ) {
                    "use strict";  
                        $( document ).ready( function() {
                            $( 'select#<?php echo esc_attr( $field['id'] ) ?>' ).on( 'change', function() {
                                var value = $( this ).val();
                                $( this ).parent().children( 'input[type="hidden"]' ).val( value );
                            } );
                        } )
                } ) ( jQuery )
            </script>
            <input type="hidden" id="<?php echo esc_attr( $field['id'] ); ?>" name="<?php echo esc_attr( $field['id'] ); ?>" value="<?php echo esc_attr( $meta ); ?>">
        <?php
        return ob_get_clean();
    }
}
