<?php
class Custom_WC_Widget_Music_Movie_Genres extends WC_Widget {

	/**
	 * Category ancestors.
	 *
	 * @var array
	 */
	public $cat_ancestors;

	/**
	 * Current Category.
	 *
	 * @var bool
	 */
	public $current_cat;

	/**
	 * Constructor.
	 */
	function __construct() {
		$this->widget_cssclass    = 'woocommerce widget_product_categories';
		$this->widget_description = __( 'A list or dropdown of product categories.', 'woocommerce' );
		$this->widget_id          = 'woocommerce_product_categories_new';
		$this->widget_name        = __( 'Product Categories New', 'woocommerce' );
		$this->settings           = array(
			'title'              => array(
				'type'  => 'text',
				'std'   => __( 'Product categories', 'woocommerce' ),
				'label' => __( 'Title', 'woocommerce' ),
			),
			'orderby'            => array(
				'type'    => 'select',
				'std'     => 'name',
				'label'   => __( 'Order by', 'woocommerce' ),
				'options' => array(
					'order' => __( 'Category order', 'woocommerce' ),
					'name'  => __( 'Name', 'woocommerce' ),
				),
			),
			'dropdown'           => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Show as dropdown', 'woocommerce' ),
			),
			'count'              => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Show product counts', 'woocommerce' ),
			),
			'hierarchical'       => array(
				'type'  => 'checkbox',
				'std'   => 1,
				'label' => __( 'Show hierarchy', 'woocommerce' ),
			),
			'show_children_only' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Only show children of the current category', 'woocommerce' ),
			),
			'hide_empty'         => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Hide empty categories', 'woocommerce' ),
			),
			'max_depth'          => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Maximum depth', 'woocommerce' ),
			),
		);

		parent::__construct();
	}

  function widget( $args, $instance ) {
		global $wp_query, $post;

		$this->widget_start( $args, $instance );

		echo '<ul class="product-categories new-product-categories">';
		$terms = get_terms( 'music_movie_genre', array(
			'hide_empty' => false,
	) );

		foreach ( $terms as $term ) {
			// The $term is an object, so we don't need to specify the $taxonomy.
			$term_link = get_term_link( $term );
			
			echo '<li class="cat-item"><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a></li>';

		}
		echo '</ul>';

		$this->widget_end( $args );
	}

}
