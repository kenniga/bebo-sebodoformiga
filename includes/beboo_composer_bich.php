<?php
if(!class_exists('WPBakeryShortCode')) return;

//This slider for book
add_action( 'vc_before_init', 'bebostore_product_slide', 999999);
function bebostore_product_slide() {
  vc_map( array(
      "name" => esc_html__( "Show Beau Slide", "bebostore" ),
      "base" => "be_product_slide",
      'weight' => 91,
      'category' => esc_html__( 'Beau Theme', 'bebostore' ),
      'description' => esc_html__( 'This section show other book in here', 'bebostore' ),
      "params" => array(
        array(
          'type' => 'dropdown',
          'heading' => esc_html__( 'Style Slide', 'bebostore' ),
          'param_name' => 'option',
          'value' => array(
              'Select...'         => '',
              'Zoom slide'        => 'zoom',
              'Deflection slide'  => 'deflection',
              'Horizontal slide'  => 'horizontal',
              'Scroll slide'      => 'scroll',
              'Two line slide'    => 'two-line',
              'Normal product'    => 'normal'
            ),
          'admin_label' => true,
          'description' => esc_html__( 'Select style Slide.', 'bebostore' )
        ),
        array(
          'type' => 'dropdown',
          'heading' => esc_html__( 'Enabled wishlist', 'bebostore' ),
          'param_name' => 'enabled_wishlist',
          'value' => array(
            'Select...' => '',
            'Yes' => 'Yes',
            'No' => 'No',
            ),
          'admin_label' => true,
        ),
        array(
          'type' => 'dropdown',
          'heading' => esc_html__( 'Enabled add to cart', 'bebostore' ),
          'param_name' => 'enabled_add_cart',
          'value' => array(
            'Select...' => '',
            'Yes' => 'Yes',
            'No' => 'No',
            ),
          'admin_label' => true,
        ),
        array(
          'type' => 'dropdown',
          'heading' => esc_html__( 'Enabled price', 'bebostore' ),
          'param_name' => 'enabled_price',
          'value' => array(
            'Select...' => '',
            'Yes' => 'Yes',
            'No' => 'No',
            ),
          'admin_label' => true,
        ),
        //Number slide
        array(
          'type' => 'textfield',
          'heading' => esc_html__( 'Number slide', 'bebostore' ),
          'param_name' => 'slide_number',
        ),


        //Perview
        array(
          'type' => 'dropdown',
          'heading' => esc_html__( 'Perview slide', 'bebostore' ),
          'param_name' => 'perview_slide',
          'value' => array(
            '0' => '0',
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
            '6' => '6',
            '7' => '7',
            '8' => '8',
            '9' => '9',
            '10' => '10'
            ),
          'admin_label' => true,
          'dependency' => array(
              'element' => 'option',
               'value' => array( 'Select...', 'horizontal', 'deflection'),
            ),
        ),
        //Category
        array(
          'type' => 'dropdown',
          'heading' => esc_html__( 'Category', 'bebostore' ),
          'param_name' => 'category',
          'value' => bebostore_get_parent_category_product(),
          'admin_label' => true,
          'description' => esc_html__( 'Select category products.', 'bebostore' )
        ),
        // Need and image, select book, add more info
        array(
          'type' => 'textfield',
          'heading' => esc_html__( 'Title', 'bebostore' ),
          'param_name' => 'slide_title',
          // 'description' => esc_html__( 'Show title desc', 'bebostore' )
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Title center or not?', 'bebostore'),
            'param_name' => 'center_title',
            'value' => 'Yes, please',
            "description" => esc_html__("Show title center.", "bebostore"),
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Type slide black or none?', 'bebostore'),
            'param_name' => 'type_slide',
            'value' => 'Yes, please',
            "description" => esc_html__("Type slide black or none?", "bebostore"),
        ),
        array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => esc_html__( "Background color", "bebostore" ),
            "param_name" => "color",
            "value" => '#FF0000', //Default Red color
            "description" => esc_html__( "Choose text color", "bebostore" )
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Background color full row?', 'bebostore'),
            'param_name' => 'bg_color_full',
            'value' => 'Yes, please',
            "description" => esc_html__('Background color full row?', "bebostore"),
            'dependency' => array(
              'element' => 'option',
               'value' => array( 'Select...', 'normal', 'horizontal','deflection','zoom' ),
            ),
        ),
      ),
   ) );
}
class WPBakeryShortCode_be_product_slide extends WPBakeryShortCode {}

add_action( 'vc_before_init', 'bebostore_singer_book', 999999);
function bebostore_singer_book() {
  $allowed_html_array = '';
  vc_map( array(
      "name" => esc_html__( "Show single book", "bebostore" ),
      "base" => "be_singer_book",
      'weight' => 91,
      'category' => esc_html__( 'Beau Theme', 'bebostore' ),
      'description' => esc_html__( 'This section show other book in here', 'bebostore' ),
      "params" => array(
        array(
          'type' => 'textfield',
          'heading' => esc_html__( 'Title:', 'bebostore' ),
          'param_name' => 'title_single',
        ),
        array(
          'type' => 'dropdown',
          'heading' => esc_html__( 'Style Product', 'bebostore' ),
          'param_name' => 'option',
          'value' => array(
            'Select...' => '',
            'Best Saler' => 'best-sale',
            'Best Saler center' => 'best-sale-center',
            'Hightlight' => 'hightlight',
            'Hightlight big img' => 'hightlight-big'),
          'admin_label' => true,
          'description' => esc_html__( 'Select style product.', 'bebostore' )
        ),
        array(
          'type' => 'dropdown',
          'heading' => esc_html__( 'Enabled price', 'bebostore' ),
          'param_name' => 'enabled_price',
          'value' => array(
            'Select...' => '',
            'Yes' => 'Yes',
            'No' => 'No',
            ),
          'admin_label' => true,
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__("Don't show flip book?", 'bebostore'),
            'param_name' => 'flip',
            'value' => 'Yes, please',
        ),
        array(
          'type' => 'textfield',
          'heading' => esc_html__( 'ID product show:', 'bebostore' ),
          'param_name' => 'id_product',
        ),
        array(
          'type' => 'textarea_html',
          'holder' => 'div',
          'heading' => esc_html__( 'Single book description', 'bebostore' ),
          'param_name' => 'content',
          'value' => wp_kses(__( '<p>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>', 'bebostore' ), $allowed_html_array),
        ),
      ),
   ) );
}
class WPBakeryShortCode_be_singer_book extends WPBakeryShortCode {}


add_action( 'vc_before_init', 'bebostore_contact_book', 999999);
function bebostore_contact_book() {
  $allowed_html_array = '';
  vc_map( array(
      "name" => esc_html__( "Show contact", "bebostore" ),
      "base" => "be_contact_book",
      'weight' => 91,
      'category' => esc_html__( 'Beau Theme', 'bebostore' ),
      'description' => esc_html__( 'This section show contact in here', 'bebostore' ),
      "params" => array(
        array(
          'type' => 'dropdown',
          'heading' => esc_html__( 'Style Contact', 'bebostore' ),
          'param_name' => 'option',
          'value' => array(esc_html__( 'Select...', 'bebostore' ) => '',esc_html__( 'Style contact horizontal one column', 'bebostore' ) => 'horizontal-one',esc_html__( 'Style contact horizontal ', 'bebostore' ) => 'horizontal',esc_html__( 'Style contact vertical', 'bebostore' ) => 'vertical'),
          'admin_label' => true,
          'edit_field_class'  =>  'vc_col-xs-8',
          'description' => esc_html__( 'Select style product.', 'bebostore' )
        ),
        array(
          'type'      => 'checkbox',
          'heading'       =>  esc_html__('Use Contact Form 7', 'bebostore'),
          'param_name'    =>  'contact7',
          'value'     => array(
              esc_html__('Yes', 'bebostore')        =>  'yes',
          ),
            'std'     => '',
            'admin_label'   => true,
            'edit_field_class'  =>  'vc_col-xs-4 vc_rs_pdt',
        ),
        array(
          'type'          => 'autocomplete',
          'heading'       => esc_html__( 'Select Contact Form', 'bebostore' ),
          'param_name'    => 'contact_id',
          'settings'      => array(
              'multiple'          => false,
              'sortable'          => true,
              'max_length'        => 1,
              'no_hide'           => true,
              'groups'            => true,
              'unique_values'     => true,
              'display_inline'    => true,
              'values'            => bebostore_get_single_post('wpcf7_contact_form')
          ),
           'dependency'    => array(
              'element'       => 'contact7',
              'value'         => array('yes'),
          ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => esc_html__( 'Style google map', 'bebostore' ),
          'param_name' => 'style_map',
          'value' => array(
            'Select...' => '',
            'Default By Theme' => 'default',
            'Default By Google' => 'default-google',
            'Retro' => 'retro',
            'Light Monochrome' => 'light-mono',
            'Paper' => 'paper',
            'Blue Water' => 'blue-water',
            'Facebook style' => 'facebook',
          ),
          'admin_label' => true,
          'description' => esc_html__( 'Select style google map.', 'bebostore' )
        ),
        array(
          'type' => 'textfield',
          'heading' => esc_html__( 'Lat of map:', 'bebostore' ),
          'param_name' => 'lat',
        ),
        array(
          'type' => 'textfield',
          'heading' => esc_html__( 'Lng of map:', 'bebostore' ),
          'param_name' => 'lng',
        ),
        array(
          'type' => 'textfield',
          'heading' => esc_html__( 'Title contact:', 'bebostore' ),
          'param_name' => 'title_contact',
        ),
        array(
          'type' => 'textfield',
          'heading' => esc_html__( 'City of contact:', 'bebostore' ),
          'param_name' => 'city_contact',
        ),
        array(
          'type' => 'textfield',
          'heading' => esc_html__( 'Address of contact:', 'bebostore' ),
          'param_name' => 'address_contact',
        ),
        array(
          'type' => 'textfield',
          'heading' => esc_html__( 'Phone of contact:', 'bebostore' ),
          'param_name' => 'phone_contact',
        ),
        array(
          'type' => 'textfield',
          'heading' => esc_html__( 'Email of contact:', 'bebostore' ),
          'param_name' => 'email_contact',
        ),
        array(
          'type' => 'textfield',
          'heading' => esc_html__( 'Facebook link of contact:', 'bebostore' ),
          'param_name' => 'fb_contact',
          'group' => esc_html__( 'Social options', 'bebostore' ),
        ),
        array(
          'type' => 'textfield',
          'heading' => esc_html__( 'Twitter link of contact:', 'bebostore' ),
          'param_name' => 'twitter_contact',
          'group' => esc_html__( 'Social options', 'bebostore' ),
        ),
        array(
          'type' => 'textfield',
          'heading' => esc_html__( 'Rss link of contact:', 'bebostore' ),
          'param_name' => 'rss_contact',
          'group' => esc_html__( 'Social options', 'bebostore' ),
        ),
        array(
          'type' => 'textfield',
          'heading' => esc_html__( 'Google link of contact:', 'bebostore' ),
          'param_name' => 'google_contact',
          'group' => esc_html__( 'Social options', 'bebostore' ),
        ),
        array(
          'type' => 'textfield',
          'heading' => esc_html__( 'Flick link of contact:', 'bebostore' ),
          'param_name' => 'flick_contact',
          'group' => esc_html__( 'Social options', 'bebostore' ),
        ),
        array(
          'type' => 'textarea_html',
          'heading' => esc_html__( 'Contact book description', 'bebostore' ),
          'param_name' => 'content',
          'value' => wp_kses(__( '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis ...</p>', 'bebostore' ), $allowed_html_array),
        ),
      ),
   ) );
}
class WPBakeryShortCode_be_contact_book extends WPBakeryShortCode {}

add_action( 'vc_before_init', 'bebostore_store', 999999);
function bebostore_store() {
  vc_map( array(
      "name" => esc_html__( "Show store", "bebostore" ),
      "base" => "be_store",
      'weight' => 91,
      'category' => esc_html__( 'Beau Theme', 'bebostore' ),
      'description' => esc_html__( 'This section show other store in here', 'bebostore' ),
      "params" => array(
        array(
          'type' => 'textfield',
          'heading' => esc_html__( 'Title store:', 'bebostore' ),
          'param_name' => 'title_store',
        ),
        array(
          'type' => 'textfield',
          'heading' => esc_html__( 'Number store show:', 'bebostore' ),
          'param_name' => 'number_store',
        ),
        array(
          'type' => 'attach_image',
          'heading' => esc_html__( 'Image cover', 'bebostore' ),
          'param_name' => 'store_image',
          'value' => '',
          'description' => esc_html__( 'Select image from media library.', 'bebostore' ),
        ),
      ),
   ) );
}
class WPBakeryShortCode_be_store extends WPBakeryShortCode {}

add_action( 'vc_before_init', 'bebostore_our_team', 999999);
function bebostore_our_team() {
  vc_map( array(
      "name" => esc_html__( "Show our Team", "bebostore" ),
      "base" => 'be_our_team',
      'weight' => 91,
      'category' => esc_html__( 'Beau Theme', 'bebostore' ),
      'description' => esc_html__( 'This section show our Team.', 'bebostore' ),
      "params" => array(
        array(
          'type' => 'textfield',
          'heading' => esc_html__( 'Title team:', 'bebostore' ),
          'param_name' => 'title_team',
        ),
        array(
          'type' => 'textfield',
          'heading' => esc_html__( 'Number person show:', 'bebostore' ),
          'param_name' => 'number_team',
        ),
      ),
   ) );
}
class WPBakeryShortCode_be_our_team extends WPBakeryShortCode {}
?>