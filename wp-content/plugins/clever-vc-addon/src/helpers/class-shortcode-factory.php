<?php namespace CVCA\Helpers;
/**
 * ShortcodeFactory
 *
 * A simple shortcode factory.
 */
class ShortcodeFactory
{
    /**
     * Shortcode name
     *
     * @var  string
     */
    protected $name;

    /**
     * Shortcode attributes
     *
     * @var  array
     */
    protected $atts;

    /**
     * Render callback
     *
     * @var  array|string
     */
    protected $callback;

    /**
     * Visual Composer arguments
     *
     * @var  array
     */
    protected $vc_args;

    /**
     * Constructor
     */
    function __construct($name, array $atts, callable $callback, $vc_args = array())
    {
        $this->name = $name;
        $this->atts = $atts;
        $this->vc_args = $vc_args;
        $this->callback = $callback;
    }

    /**
     * Create
     *
     * @see  https://developer.wordpress.org/reference/functions/remove_shortcode/
     */
    function create()
    {
        // If duplicate shortcode name, override it.
        remove_shortcode($this->name);
        add_shortcode( $this->name, array($this, '_add') );

        if ( !empty($this->vc_args) ) {
            add_action( 'vc_before_init', array( $this, '_integrateWithVC' ), 10, 0 );
        }
    }

    /**
     * Add a shortcode
     *
     * @param  array  $atts  User's defined attributes
     * @param  string  $content  Shortcode content.
     *
     * @internal    Used as a callback. PLEASE DO NOT RECALL THIS METHOD DIRECTLY!
     *
     * @see  https://developer.wordpress.org/reference/functions/add_shortcode/
     */
    function _add($atts, $content = null)
    {
        $atts = shortcode_atts($this->atts, $atts, $this->name);

        $html = call_user_func_array( $this->callback, array($atts, $content) );

        return $html;
    }

    /**
     * Integrate to Visual Composer
     *
     * @internal    Used as a callback. PLEASE DO NOT RECALL THIS METHOD DIRECTLY!
     */
    function _integrateWithVC()
    {
         /*
            Since PHP excecutes any function call immediately,
            error(s) will occur if we try to get contents registered at the `init` hook
            inside the params of the `clever_register_shortcode()` function before the `init` hook.
            We also can't call the `clever_register_shortcode()` function at the `init` hook
            because VC maps our shortcode at the `init` hook and we don't know about the priorities of
            the contents registered at the `init` hook.
         */
        foreach ($this->vc_args['params'] as $param_index => $param_value) {
            if (isset($param_value['settings']['values']) && is_callable($param_value['settings']['values'])) {
                $param_value['settings']['values'] = call_user_func($param_value['settings']['values']);
            }
            if (isset($param_value['value']) && is_callable($param_value['value'])) {
                $param_value['value'] = call_user_func($param_value['value']);
            }
            $this->vc_args['params'][$param_index] = $param_value;
        }

        vc_map($this->vc_args);
    }
}
