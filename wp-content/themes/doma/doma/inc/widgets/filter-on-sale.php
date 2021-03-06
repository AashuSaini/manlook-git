<?php
/**
 * Widget API: WP_Widget_Text class
 *
 * @package    WordPress
 * @subpackage Widgets
 * @since      4.4.0
 */

/**
 * Core class used to implement a Text widget.
 *
 * @since 2.8.0
 *
 * @see   WP_Widget
 */
add_action( 'widgets_init', 'zoo_load_clever_filter_on_sale' );

function zoo_load_clever_filter_on_sale() {
    register_widget( 'clever_filter_on_sale' );
}
class clever_filter_on_sale extends WP_Widget {
	protected $defaults;

	function __construct() {
		$this->defaults = array(
			'title' => '',
		);
		add_action('pre_get_posts',array($this,'sale_items'));
		parent::__construct(
			'clever_filter_on_sale',
			esc_html__( 'Zoo: Filter by On Sale', 'doma' ),
			array(
				'classname'   => 'woocommerce widget_text clever-filter-on-sale',
				'description' => esc_html__( 'Filter On Sale', 'doma' ),
			)
		);
	}

	function sale_items($query) {

		    if (!is_admin() && ($query->is_post_type_archive( 'product' ) || $query->is_tax( get_object_taxonomies( 'product' )))) {

		    	if(isset($_GET['status']) && $_GET['status'] == 'sale')
		    	{

		    		$meta_query = WC()->query->get_meta_query();
					$meta_query[] = array (
					    'relation' => 'OR',
				        array( // Simple products type
				            'key'           => '_sale_price',
				            'value'         => 0,
				            'compare'       => '>',
				            'type'          => 'numeric'
				        ),
				        array( // Variable products type
				            'key'           => '_min_variation_sale_price',
				            'value'         => 0,
				            'compare'       => '>',
				            'type'          => 'numeric'
				        )
			        );

			        if(isset($_GET['availability']) && $_GET['availability'] == 'in_stock')
			        {
			        	$meta_query[] = array (
		                    'key' => '_stock_status',
		                    'value' => 'outofstock', //instock,outofstock
		                    'compare' => 'NOT IN',
		            	);
			        }

		        	$query->set('meta_query',$meta_query);

		    	}

		    }
		}

		/**
		 * widget function.
		 *
		 * @see WP_Widget
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {
			global $wp, $wp_the_query;

			extract( $args );

			if ( ! is_post_type_archive( 'product' ) && ! is_tax( get_object_taxonomies( 'product' ) ) ) {
				return;
			}

			if ( ! $wp_the_query->post_count ) {
				return;
			}

			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			
			if ( get_option( 'permalink_structure' ) == '' ) {
				$link = remove_query_arg( array( 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
			} else {
				$link = preg_replace( '%\/page/[0-9]+%', '', home_url( $wp->request ) );
			}
			
			if ( get_search_query() ) {
				$link = add_query_arg( 's', rawurlencode( htmlspecialchars_decode( get_search_query() ) ), $link );
			}

			// Min/Max
			if ( isset( $_GET['min_price'] ) ) {
				$link = add_query_arg( 'min_price', esc_attr($_GET['min_price']), $link );
			}

			if ( isset( $_GET['max_price'] ) ) {
				$link = add_query_arg( 'max_price', esc_attr($_GET['max_price']), $link );
			}

			if ( ! empty( $_GET['post_type'] ) ) {

				$link = add_query_arg( 'post_type', esc_attr( $_GET['post_type'] ), $link );
			}

			if ( ! empty ( $_GET['product_cat'] ) ) {
				$link = add_query_arg( 'product_cat', esc_attr( $_GET['product_cat'] ), $link );
			}

			if ( ! empty( $_GET['product_tag'] ) ) {
				$link = add_query_arg( 'product_tag', esc_attr( $_GET['product_tag'] ), $link );
			}

			if ( ! empty( $_GET['orderby'] ) ) {
				$link = add_query_arg( 'orderby', esc_attr( $_GET['orderby'] ), $link );
			}

			// Min Rating Arg
			if ( isset( $_GET['rating_filter'] ) ) {
				$link = add_query_arg( 'rating_filter', wc_clean( $_GET['rating_filter'] ), $link );
			}

			//Epico
			if ( ! empty( $_GET['availability'] ) ) {
				$link = add_query_arg( 'availability', esc_attr( $_GET['availability'] ), $link );
			}

			if ( $_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes() ) {
				foreach ( $_chosen_attributes as $attribute => $data ) {
					$taxonomy_filter = 'filter_' . str_replace( 'pa_', '', $attribute );
		
					$link = add_query_arg( esc_attr( $taxonomy_filter ), esc_attr( implode( ',', $data['terms'] ) ), $link );
					
					if ( 'or' == $data['query_type'] ) {
						$link = add_query_arg( esc_attr( str_replace( 'pa_', 'query_type_', $attribute ) ), 'or', $link );
					}
				}
			}

			//Echo wrapper of widget & title
			echo $before_widget;
			if ( $title )
				echo $before_title . $title . $after_title;
			
			
			$output = '<ul class="on-sale-filter">';
			        
			if ( isset($_GET['status']) && $_GET['status'] == 'sale' ) {
				$output .= '<li class="chosen"><a href="' . esc_url( $link ) . '"><span></span>' . esc_html__( 'Show only products on sale', 'doma' ) . '</a></li>';
			} else {
				$url = add_query_arg( array( 'status' => 'sale' ), $link );
				$output .= '<li><a href="' . esc_url( $url ) . '"><span></span>' . esc_html__( 'Show only products on sale', 'doma' ) . '</a></li>';

			}
		
			$output .= '</ul>';

			echo $output;
			echo $after_widget;
		}

	/**
	 * Deals with the settings when they are saved by the admin.
	 *
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	/**
	 * Displays the form for this widget on the Widgets page of the WP Admin area.
	 *
	 * @param array $instance
	 *
	 * @return array
	 */
	function form( $instance ) {
		$instance = wp_parse_args( $instance, $this->defaults );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'doma' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
		</p>
		<?php
	}
}