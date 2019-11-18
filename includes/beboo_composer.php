<?php
if(!class_exists('WPBakeryShortCode')) return;

$bebostore_perpage_global = $bebostore_book_listall = array();
// global $bebostore_perpage_global;
for($i=-1; $i<=50; $i++){
  $bebostore_perpage_global[] = $i;
}
// Global perpage number
$GLOBALS['bebostore_perpage_arr'] = $bebostore_perpage_global;

$bebostore_icons = array(
  'Cups'        => 'be-cup',
  'Cake'        => 'be-cache',
  'Piza'        => 'be-piza',
  'Grapes'      => 'be-grapes',
  'List'        => 'be-list',
  'Grid'        => 'be-grid',
  'Small list'  => 'be-small-list',
  'Small grid'  => 'be-small-grid',
  'Ink'         => 'be-ink',
  'Skirt'       => 'be-skirt',
  'Tools'       => 'be-tools',
  'Technology'  => 'be-technology',
  'Two heart'   => 'be-two-heart',
  'Swing heart' => 'be-swing-heart',
  'Star'        => 'be-star',
  'Planet'      => 'be-planet',
  'Bat'         => 'be-bat',
  'Bang'        => 'be-bang',
  'Shipping'    => 'be-shipping',
  'Box'         => 'be-box',
  'Heart o'     => 'be-heart-o',
  'Money'       => 'be-money',
);


$GLOBALS['bebostore_icons'] = $bebostore_icons;

$add_css_animation = array(
  'type' => 'dropdown',
  'heading' => __( 'CSS Animation', 'bebostore' ),
  'param_name' => 'css_animation',
  'admin_label' => true,
  'value' => array(
    __( 'No', 'bebostore' ) => '',
    __( 'Top to bottom', 'bebostore' ) => 'top-to-bottom',
    __( 'Bottom to top', 'bebostore' ) => 'bottom-to-top',
    __( 'Left to right', 'bebostore' ) => 'left-to-right',
    __( 'Right to left', 'bebostore' ) => 'right-to-left',
    __( 'Appear from center', 'bebostore' ) => "appear"
  ),
  'description' => __( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'bebostore' )
);
$GLOBALS['add_css_animation'] = $add_css_animation;
//Add more option for Vituarcomposer row
add_action( 'vc_before_init', 'bebostore_containerCenter', 999999);
function bebostore_containerCenter(){
  if(function_exists('vc_add_param')){
    vc_add_params(
      'vc_row',
      array(
        array(
            'type' => 'dropdown',
            'heading' => __( 'Row stretch', 'bebostore' ),
            'param_name' => 'full_width',
            'value' => array(
              __( 'Default', 'bebostore' ) => '',
              __( 'Stretch row', 'bebostore' ) => 'stretch_row',
              __( 'Stretch row and content', 'bebostore' ) => 'stretch_row_content',
              __( 'Stretch row and content (no paddings)', 'bebostore' ) => 'stretch_row_content_no_spaces',
              __( 'Stretch row and content (no paddings content in center)', 'bebostore' ) => 'stretch_row_content_no_spaces_content',
            ),
            'description' => __( 'Select stretching options for row and content (Note: stretched may not work properly if parent container has "overflow: hidden" CSS property).', 'bebostore' )
            // "group" => __( 'Design options', 'bebostore' ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Columns position', 'js_composer' ),
          'param_name' => 'columns_placement',
          'value' => array(
            __( 'Top', 'js_composer' ) => 'top',
            __( 'Bottom', 'js_composer' ) => 'bottom',
            __( 'This is Middle', 'js_composer' ) => 'middle',
            __( 'Stretch', 'js_composer' ) => 'stretch',
          ),
          'description' => __( 'Select columns position within row.', 'js_composer' ),
          'dependency' => array(
            'element' => 'full_height',
            'not_empty' => true,
          ),
        ),


      )
    );

  }
}
//Some function add for page builder

//This for section list social
add_action( 'vc_before_init', 'bebostore_SocialList', 999999);
function bebostore_SocialList() {
  vc_map( array(
      "name" => __( "Show social list", "bebostore" ),
      "base" => "be_sociallist",
      'weight' => 91,
      'category' => __( 'Beau Theme', 'bebostore' ),
      'description' => __( 'This section contain author info and some book', 'bebostore' ),
      "params" => array(
        // Need and image, select book, add more info
        array(
          'type' => 'textfield',
          'heading' => __( 'Title section', 'bebostore' ),
          'param_name' => 'title_box',
          // 'value' => __('Author facebook','bebostore'),
          'description' => __( 'This for title box.', 'bebostore' ),
        ),
      ),
   ) );
}
class WPBakeryShortCode_Be_sociallist extends WPBakeryShortCode {}

// Hero Slider
add_action( 'vc_before_init', 'jabarmasagi_HeroSlider', 999999);
function jabarmasagi_HeroSlider() {
  vc_map( array(
      "name" => __( "Show hero slider", "bebostore" ),
      "base" => "be_heroslider",
      'weight' => 91,
      'category' => __( 'Beau Theme', 'bebostore' ),
      "params" => array(
        array(
          'type' => 'dropdown',
          'heading' => esc_html__( 'Slider Select', 'bebostore' ),
          'param_name' => 'show_on_page',
          'value' => bebostore_get_home_slider(),
          'admin_label' => true,
        ),
      ),
   ) );
}
class WPBakeryShortCode_Be_heroslider extends WPBakeryShortCode {}

//This for popup modul jabarmasagi
add_action( 'vc_before_init', 'jabarmasagi_PopupRegister', 999999);
function jabarmasagi_PopupRegister() {
  global $bebostore_perpage_arr, $bebostore_book_listall;
  vc_map( array(
      "name" => __( "Jabar Masagi Popup Register", "bebostore" ),
      "base" => "be_popupregister",
      'weight' => 91,
      'category' => __( 'Beau Theme', 'bebostore' ),
      "params" => array(
      	// Need and image, select book, add more info
        array(
          'type' => 'textfield',
          'heading' => __( 'Popup Target Class Name', 'bebostore' ),
          'param_name' => 'popup_target',
          'description' => __( 'Classname of popup.', 'bebostore' ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Popup Title', 'bebostore' ),
          'param_name' => 'popup_title',
          'admin_label' => true,
          'description' => __( 'Title name of popup.', 'bebostore' ),
        ),
        array(
          'type' => 'attach_image',
          'heading' => __( 'Popup Image', 'bebostore' ),
          'param_name' => 'popup_image',
          'description' => __( 'This display image of popup.', 'bebostore' ),
        ),
      ),
   ) );
}
class WPBakeryShortCode_Be_popupregister extends WPBakeryShortCode {}

  //This for popup modul jabarmasagi
add_action( 'vc_before_init', 'jabarmasagi_CardItem', 999999);
function jabarmasagi_CardItem() {
  global $bebostore_perpage_arr, $bebostore_book_listall;
  vc_map( array(
      "name" => __( "Jabar Masagi Card Item", "bebostore" ),
      "base" => "be_carditem",
      'weight' => 91,
      'category' => __( 'Beau Theme', 'bebostore' ),
      "params" => array(
      	// Need and image, select book, add more info
        array(
          'type' => 'textfield',
          'heading' => __( 'Title Card', 'bebostore' ),
          'admin_label' => true,
          'param_name' => 'title_card',
        ),
        array(
          'type' => 'attach_image',
          'heading' => __( 'Card Image', 'bebostore' ),
          'param_name' => 'card_image',
        ),
        array(
          'type' => 'textarea',
          'heading' => __( 'Content', 'bebostore' ),
          'param_name' => 'text_content',
        ),
      ),
   ) );
}
class WPBakeryShortCode_Be_carditem extends WPBakeryShortCode {}

//This for popup modul jabarmasagi
add_action( 'vc_before_init', 'jabarmasagi_CardItemSlider', 999999);
function jabarmasagi_CardItemSlider() {
  global $bebostore_perpage_arr, $bebostore_book_listall;
  vc_map( array(
      "name" => __( "Jabar Masagi Card Item Slider", "bebostore" ),
      "base" => "be_carditemslider",
      'weight' => 91,
      'category' => __( 'Beau Theme', 'bebostore' ),
      "params" => array(
      	// Need and image, select book, add more info
        array(
          "type" => "param_group",
          "heading" => __( "Card Slider", "my-text-domain" ),
          "param_name" => "slider_attr",
          "params" => array(
            array(
              'type' => 'attach_image',
              'value' => '',
              'heading' => __( 'Upload Picture', 'pt-vc' ),
              'param_name' => 'upload_slider_picture',
            ),
            array(
              'type' => 'textfield',
              'value' => '',
              'heading' => __( 'Title', 'pt-vc' ),
              'param_name' => 'slider_title',
              'admin_label' => true
            ),
            array(
              'type' => 'textarea',
              'value' => '',
              'heading' => __( 'Description', 'pt-vc' ),
              'param_name' => 'slider_desc',
              'admin_label' => true
            ),
          )
        ),
      ),
   ) );
}
class WPBakeryShortCode_Be_carditemslider extends WPBakeryShortCode {}

//This for popup modul jabarmasagi
add_action( 'vc_before_init', 'jabarmasagi_FullCardItemSlider', 999999);
function jabarmasagi_FullCardItemSlider() {
  global $bebostore_perpage_arr, $bebostore_book_listall;
  vc_map( array(
      "name" => __( "Jabar Masagi Full Card Item Slider", "bebostore" ),
      "base" => "be_fullcarditemslider",
      'weight' => 91,
      'category' => __( 'Beau Theme', 'bebostore' ),
      "params" => array(
      	// Need and image, select book, add more info
        array(
          "type" => "param_group",
          "heading" => __( "Card Slider", "my-text-domain" ),
          "param_name" => "slider_attr",
          "params" => array(
            array(
              'type' => 'attach_image',
              'value' => '',
              'heading' => __( 'Upload Picture', 'pt-vc' ),
              'param_name' => 'upload_slider_picture',
            ),
            array(
              'type' => 'textfield',
              'value' => '',
              'heading' => __( 'Title', 'pt-vc' ),
              'param_name' => 'slider_title',
              'admin_label' => true
            ),
            array(
              'type' => 'textarea',
              'value' => '',
              'heading' => __( 'Description', 'pt-vc' ),
              'param_name' => 'slider_desc',
              'admin_label' => true
            ),
            array(
              'type' => 'vc_link',
              'heading' => __( 'Link Destination', 'pt-vc' ),
              'param_name' => 'link_destination',
            ),
            array(
              'type' => 'vc_link',
              'heading' => __( 'Link More Destination', 'pt-vc' ),
              'param_name' => 'link_more_destination',
            ),
          )
        ),
      ),
   ) );
}
class WPBakeryShortCode_Be_fullcarditemslider extends WPBakeryShortCode {}

//This for popup modul jabarmasagi
add_action( 'vc_before_init', 'jabarmasagi_SidedCardItemSlider', 999999);
function jabarmasagi_SidedCardItemSlider() {
  global $bebostore_perpage_arr, $bebostore_book_listall;
  vc_map( array(
      "name" => __( "Jabar Masagi Sided Card Item Slider", "bebostore" ),
      "base" => "be_sidedcarditemslider",
      'weight' => 91,
      'category' => __( 'Beau Theme', 'bebostore' ),
      "params" => array(
      	// Need and image, select book, add more info
        array(
          "type" => "param_group",
          "heading" => __( "Card Slider", "my-text-domain" ),
          "param_name" => "slider_attr",
          "params" => array(
            array(
              'type' => 'attach_image',
              'value' => '',
              'heading' => __( 'Upload Picture', 'pt-vc' ),
              'param_name' => 'upload_slider_picture',
            ),
            array(
              'type' => 'textfield',
              'value' => '',
              'heading' => __( 'Title', 'pt-vc' ),
              'param_name' => 'slider_title',
              'admin_label' => true
            ),
            array(
              'type' => 'textarea',
              'value' => '',
              'heading' => __( 'Description', 'pt-vc' ),
              'param_name' => 'slider_desc',
              'admin_label' => true
            ),
            array(
              'type' => 'vc_link',
              'heading' => __( 'Link More Destination', 'pt-vc' ),
              'param_name' => 'link_more_destination',
            ),
          )
        ),
      ),
   ) );
}
class WPBakeryShortCode_Be_sidedcarditemslider extends WPBakeryShortCode {}

//This for popup modul jabarmasagi
add_action( 'vc_before_init', 'jabarmasagi_UltimateForm', 999999);
function jabarmasagi_UltimateForm() {
  global $bebostore_perpage_arr, $bebostore_book_listall;
  vc_map( array(
      "name" => __( "Jabar Masagi Ultimate Form", "bebostore" ),
      "base" => "be_ultimateform",
      'weight' => 91,
      'category' => __( 'Beau Theme', 'bebostore' ),
      "params" => array(
      	// Need and image, select book, add more info
        array(
          'type' => 'textfield',
          'heading' => __( 'Form Class', 'bebostore' ),
          'param_name' => 'form_class',
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Form Title', 'bebostore' ),
          'param_name' => 'form_title',
        ),
        array(
          'type' => 'textarea_html',
          'heading' => __( 'Content', 'bebostore' ),
          'param_name' => 'content',
        ),
      ),
   ) );
}
class WPBakeryShortCode_Be_ultimateform extends WPBakeryShortCode {}

  //This for counter jabarmasagi
add_action( 'vc_before_init', 'jabarmasagi_LoggedInWidget', 999999);
function jabarmasagi_LoggedInWidget() {
  global $bebostore_perpage_arr, $bebostore_book_listall;
  vc_map( array(
      "name" => __( "Jabar Masagi Logged In Widget", "bebostore" ),
      "base" => "be_loggedinwidget",
      'weight' => 91,
      'category' => __( 'Beau Theme', 'bebostore' ),
      "params" => array(
      	// Need and image, select book, add more info
        array(
          'type' => 'textfield',
          'heading' => __( 'Counter Title Text', 'bebostore' ),
          'param_name' => 'title_text',
          'description' => __( 'Title for your counter.', 'bebostore' ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Date\'s Countdown', 'bebostore' ),
          'param_name' => 'date_countdown',
          'admin_label' => true,
          'description' => __( 'Date of your countdown deadline. Max: 31', 'bebostore' ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Month\'s Countdown', 'bebostore' ),
          'param_name' => 'month_countdown',
          'admin_label' => true,
          'value' => array(
            __( 'January', 'bebostore' ) => 'Jan',
            __( 'February', 'bebostore' ) => 'Feb',
            __( 'March', 'bebostore' ) => 'Mar',
            __( 'April', 'bebostore' ) => 'April',
            __( 'May', 'bebostore' ) => 'May',
            __( 'June', 'bebostore' ) => 'Jun',
            __( 'July', 'bebostore' ) => 'Jul',
            __( 'August', 'bebostore' ) => 'Aug',
            __( 'September', 'bebostore' ) => 'Sep',
            __( 'October', 'bebostore' ) => 'Oct',
            __( 'November', 'bebostore' ) => 'Nov',
            __( 'December', 'bebostore' ) => 'Dec',
          ),
          'description' => __( 'Mont of your countdown deadline.', 'bebostore' ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Year\'s Countdown', 'bebostore' ),
          'param_name' => 'year_countdown',
          'admin_label' => true,
          'description' => __( 'Date of your countdown deadline. Max: 31', 'bebostore' ),
        ),
        array(
          'type' => 'textarea_html',
          'heading' => __( 'Content', 'bebostore' ),
          'param_name' => 'content',
        ),
      ),
   ) );
}
class WPBakeryShortCode_Be_loggedinwidget extends WPBakeryShortCode {}

  //This for counter jabarmasagi
add_action( 'vc_before_init', 'jabarmasagi_GaleriKontes', 999999);
function jabarmasagi_GaleriKontes() {
  vc_map( array(
      "name" => __( "Jabar Masagi Galeri Kontes", "bebostore" ),
      "base" => "be_galerikontes",
      'weight' => 91,
      'category' => __( 'Beau Theme', 'bebostore' )
   ) );
}
class WPBakeryShortCode_Be_galerikontes extends WPBakeryShortCode {}

  //This for counter jabarmasagi
add_action( 'vc_before_init', 'jabarmasagi_GaleriKontesTerdahulu', 999999);
function jabarmasagi_GaleriKontesTerdahulu() {
  vc_map( array(
      "name" => __( "Jabar Masagi Galeri Kontes Sebelumnya", "bebostore" ),
      "base" => "be_galerikontesterdahulu",
      'weight' => 91,
      'category' => __( 'Beau Theme', 'bebostore' )
   ) );
}
class WPBakeryShortCode_Be_galerikontesterdahulu extends WPBakeryShortCode {}

//This for popup modul jabarmasagi
add_action( 'vc_before_init', 'jabarmasagi_PopupModul', 999999);
function jabarmasagi_PopupModul() {
  global $bebostore_perpage_arr, $bebostore_book_listall;
  vc_map( array(
      "name" => __( "Jabar Masagi Popup Modul", "bebostore" ),
      "base" => "be_popupmodul",
      'weight' => 91,
      'category' => __( 'Beau Theme', 'bebostore' ),
      "params" => array(
      	// Need and image, select book, add more info
        array(
          'type' => 'textfield',
          'heading' => __( 'Modul Target Class Name', 'bebostore' ),
          'param_name' => 'modul_target',
          'description' => __( 'Classname of modul.', 'bebostore' ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Modul Title', 'bebostore' ),
          'param_name' => 'modul_title',
          'admin_label' => true,
          'description' => __( 'Title name of modul.', 'bebostore' ),
        ),
        array(
          'type' => 'attach_image',
          'heading' => __( 'Modul Image', 'bebostore' ),
          'param_name' => 'modul_image',
          'description' => __( 'This display image of module.', 'bebostore' ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Modul Subtitle', 'bebostore' ),
          'param_name' => 'modul_subtitle',
          'description' => __( 'Subtitle name of modul.', 'bebostore' ),
        ),
        array(
          'type' => 'colorpicker',
          'heading' => __( 'Modul Background', 'bebostore' ),
          'param_name' => 'modul_background',
        ),
        array(
          'type' => 'file_picker',
          'heading' => __( 'Modul File', 'bebostore' ),
          'param_name' => 'modul_file',
        ),
      ),
   ) );
}
class WPBakeryShortCode_Be_popupmodul extends WPBakeryShortCode {}

//This for popup modul jabarmasagi
add_action( 'vc_before_init', 'jabarmasagi_ButtonDownload', 999999);
function jabarmasagi_ButtonDownload() {
  global $bebostore_perpage_arr, $bebostore_book_listall;
  vc_map( array(
      "name" => __( "Jabar Masagi Button Download", "bebostore" ),
      "base" => "be_buttondownload",
      'weight' => 91,
      'category' => __( 'Beau Theme', 'bebostore' ),
      "params" => array(
      	// Need and image, select book, add more info
        array(
          'type' => 'textfield',
          'heading' => __( 'Button Title', 'bebostore' ),
          'param_name' => 'button_title',
          'admin_label' => true,
          'description' => __( 'Title name of button.', 'bebostore' ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Button Font Size', 'bebostore' ),
          'param_name' => 'button_font_size',
          'description' => __( 'Font size in vw unit (will be added 1rem for responsive purposes).', 'bebostore' ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Button Width', 'bebostore' ),
          'param_name' => 'button_width',
          'description' => __( 'Without any unit, so you must include the unit.', 'bebostore' ),
        ),
        array(
          'type' => 'colorpicker',
          'heading' => __( 'Button Background', 'bebostore' ),
          'param_name' => 'button_background',
        ),
        array(
          'type' => 'colorpicker',
          'heading' => __( 'Button Font Color', 'bebostore' ),
          'param_name' => 'button_font_color',
        ),
        array(
          'type' => 'colorpicker',
          'heading' => __( 'Button Background Hover', 'bebostore' ),
          'param_name' => 'button_background_hover',
        ),
        array(
          'type' => 'colorpicker',
          'heading' => __( 'Button Font Color', 'bebostore' ),
          'param_name' => 'button_font_color_hover',
        ),
        array(
          'type' => 'file_picker',
          'heading' => __( 'Button File', 'bebostore' ),
          'param_name' => 'button_file',
        ),
      ),
   ) );
}
class WPBakeryShortCode_Be_buttondownload extends WPBakeryShortCode {}

//This for section author
add_action( 'vc_before_init', 'bebostore_Author', 999999);
function bebostore_Author() {
  global $bebostore_perpage_arr, $bebostore_book_listall;
  vc_map( array(
      "name" => __( "Author & book", "bebostore" ),
      "base" => "be_author",
      'weight' => 91,
      'category' => __( 'Beau Theme', 'bebostore' ),
      'description' => __( 'This section contain author info and some book', 'bebostore' ),
      "params" => array(
      	// Need and image, select book, add more info
        array(
          'type' => 'textfield',
          'heading' => __( 'Author name', 'bebostore' ),
          'param_name' => 'author_name',
          'value' => __('Author name','bebostore'),
          'description' => __( 'This display name of author.', 'bebostore' ),
          'group' => __('Author','bebostore')
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Author style', 'bebostore' ),
          'param_name' => 'author_style',
          'value' => __('Style 1, style 2, style 3','bebostore'),
          'description' => __( 'This display list style of author.', 'bebostore' ),
          'group' => __('Author','bebostore')
        ),
        array(
          'type' => 'textarea_html',
          'holder' => 'div',
          'heading' => __( 'Author description', 'bebostore' ),
          'param_name' => 'content',
          'value' => __( '<p>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>', 'bebostore' ),
          'group' => __('Author info','bebostore')
        ),
        
        array(
          'type' => 'attach_image',
          'heading' => __( 'Image', 'bebostore' ),
          'param_name' => 'author_image',
          'value' => '',
          'description' => __( 'Select image from media library.', 'bebostore' ),
          'group' => __('Author info','bebostore'),
        ),
        array(
            'type'        => 'textfield',
            'heading'     => __('Chose your books', 'bebostore'),
            'param_name'  => 'author_book',
            "description" => __("Show max 4 books min 2 books)", "bebostore"),
            "group"       => __( 'Book list', 'bebostore' ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Author facebook', 'bebostore' ),
          'param_name' => 'author_facebook',
          // 'value' => __('Author facebook','bebostore'),
          'description' => __( 'This author facebook link.', 'bebostore' ),
          'group' => __('Social','bebostore')
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Author twitter', 'bebostore' ),
          'param_name' => 'author_twitter',
          // 'value' => __('Author twitter','bebostore'),
          'description' => __( 'This author twitter link.', 'bebostore' ),
          'group' => __('Social','bebostore')
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Author Google', 'bebostore' ),
          'param_name' => 'author_google',
          // 'value' => __('Author Google','bebostore'),
          'description' => __( 'This author Google link.', 'bebostore' ),
          'group' => __('Social','bebostore')
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Author instagram', 'bebostore' ),
          'param_name' => 'author_instagram',
          // 'value' => __('Author instagram','bebostore'),
          'description' => __( 'This author instagram link.', 'bebostore' ),
          'group' => __('Social','bebostore')
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Author pinterest', 'bebostore' ),
          'param_name' => 'author_pinterest',
          // 'value' => __('Author pinterest','bebostore'),
          'description' => __( 'This author pinterest link.', 'bebostore' ),
          'group' => __('Social','bebostore')
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Author behance', 'bebostore' ),
          'param_name' => 'author_behance',
          // 'value' => __('Author behance','bebostore'),
          'description' => __( 'This author behance link.', 'bebostore' ),
          'group' => __('Social','bebostore')
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Author youtube', 'bebostore' ),
          'param_name' => 'author_youtube',
          // 'value' => __('Author youtube','bebostore'),
          'description' => __( 'This author youtube link.', 'bebostore' ),
          'group' => __('Social','bebostore')
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Author linkedin', 'bebostore' ),
          'param_name' => 'author_linkedin',
          // 'value' => __('Author linkedin','bebostore'),
          'description' => __( 'This author linkedin link.', 'bebostore' ),
          'group' => __('Social','bebostore')
        ),
      ),
   ) );
}
class WPBakeryShortCode_Be_author extends WPBakeryShortCode {}


//This for section blog
add_action( 'vc_before_init', 'jabarmasagi_BlogCardSlider', 999999);
function jabarmasagi_BlogCardSlider() {
  global $bebostore_perpage_arr;
  vc_map( array(
      "name" => __( "Jabar Masagi Blog Card Slider", "bebostore" ),
      "base" => "be_blogcardslider",
      'weight' => 91,
      'category' => __( 'Beau Theme', 'bebostore' ),
      'description' => __( 'This section contain blog list in jabar masagi version', 'bebostore' ),
      "params" => array(
        // Need and image, select book, add more info
        //Category
        array(
          'type' => 'dropdown',
          'heading' => esc_html__( 'Category', 'bebostore' ),
          'param_name' => 'category',
          'value' => bebostore_get_category_blog(),
          'admin_label' => true,
          'description' => esc_html__( 'Select category products.', 'bebostore' )
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Perpage', 'bebostore' ),
          'param_name' => 'blog_perpage',
          'value' => $bebostore_perpage_arr,
          'std' => 4,
          'admin_label' => true,
          'description' => __( 'Select columns count.', 'bebostore' )
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Blog Thumbnail Style', 'bebostore' ),
          'param_name' => 'blog_thumbnail_style',
          'value' => array(
            __( 'Standard', 'bebostore' ) => '',
            __( 'Full Thumbnail', 'bebostore' ) => 'full_thumbnail',
          ),
          'admin_label' => true,
          'description' => __( 'How thumbnail image displayed.', 'bebostore' )
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Blog Selection', 'bebostore' ),
          'param_name' => 'blog_selection',
          'value' => array(
            __( 'Recent Posts', 'bebostore' ) => '',
            __( 'Upcoming Program', 'bebostore' ) => 'upcoming_program',
          ),
          'admin_label' => true,
        ),
      ),
   ) );
}
class WPBakeryShortCode_Be_blogcardslider extends WPBakeryShortCode {}

  //This for section blog
add_action( 'vc_before_init', 'jabarmasagi_VideoPlayer', 999999);
function jabarmasagi_VideoPlayer() {
  global $bebostore_perpage_arr;
  vc_map( array(
      "name" => __( "Jabar Masagi Video Player", "bebostore" ),
      "base" => "be_videoplayer",
      'weight' => 91,
      'category' => __( 'Beau Theme', 'bebostore' ),
      'description' => __( 'This section contain video player in jabar masagi version', 'bebostore' ),
      "params" => array(
        // Need and image, select book, add more info
        //Category
        array(
          'type' => 'file_picker',
          'heading' => __( 'Video File', 'bebostore' ),
          'param_name' => 'video_file',
        ),
        array(
          'type' => 'attach_image',
          'heading' => __( 'Image Placeholder', 'bebostore' ),
          'param_name' => 'image_placeholder',
        ),
      ),
   ) );
}
class WPBakeryShortCode_Be_videoplayer extends WPBakeryShortCode {}

//This for section blog
add_action( 'vc_before_init', 'bebostore_Blog', 999999);
function bebostore_Blog() {
  global $bebostore_perpage_arr;
  vc_map( array(
      "name" => __( "Show blog items", "bebostore" ),
      "base" => "be_blog",
      'weight' => 91,
      'category' => __( 'Beau Theme', 'bebostore' ),
      'description' => __( 'This section contain author info and some book', 'bebostore' ),
      "params" => array(
        // Need and image, select book, add more info
        //Category
        array(
          'type' => 'dropdown',
          'heading' => esc_html__( 'Category', 'bebostore' ),
          'param_name' => 'category',
          'value' => bebostore_get_category_blog(),
          'admin_label' => true,
          'description' => esc_html__( 'Select category products.', 'bebostore' )
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Title section', 'bebostore' ),
          'param_name' => 'title_box',
          // 'value' => __('Author facebook','bebostore'),
          'description' => __( 'This for title box.', 'bebostore' ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Title center ?', 'bebostore' ),
          'param_name' => 'title_center',
          'value' => array('Chose your margin'=>'', 'Default' => 'title_default', 'Title center' => 'title_center'),
          'admin_label' => true,
          'description' => __( 'Select columns count.', 'bebostore' )
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Perpage', 'bebostore' ),
          'param_name' => 'blog_perpage',
          'value' => $bebostore_perpage_arr,
          'std' => 4,
          'admin_label' => true,
          'description' => __( 'Select columns count.', 'bebostore' )
        ),
      ),
   ) );
}
class WPBakeryShortCode_Be_blog extends WPBakeryShortCode {}


//This for link language
add_action( 'vc_before_init', 'bebostore_bookLanguage', 999999);
function bebostore_bookLanguage() {
  vc_map( array(
      "name" => __( "Book store agency", "bebostore" ),
      "base" => "be_agency",
      'weight' => 91,
      'category' => __( 'Beau Theme', 'bebostore' ),
      'description' => __( 'This section contain author info and some book', 'bebostore' ),
      "params" => array(
        array(
          'type' => 'textfield',
          'heading' => __( 'Title section', 'bebostore' ),
          'param_name' => 'title_box',
          // 'value' => __('Author facebook','bebostore'),
          'description' => __( 'This for title box.', 'bebostore' ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Link for Ipad', 'bebostore' ),
          'param_name' => 'ipad_link',
          // 'value' => __('Author facebook','bebostore'),
          'description' => __( 'Link for app ipad.', 'bebostore' ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Link for Iphone', 'bebostore' ),
          'param_name' => 'iphone_link',
          // 'value' => __('Author facebook','bebostore'),
          'description' => __( 'Link for app iphone.', 'bebostore' ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'United link', 'bebostore' ),
          'param_name' => 'united_link',
          // 'value' => __('Author facebook','bebostore'),
          'description' => __( 'United shop.', 'bebostore' ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'United kingdom', 'bebostore' ),
          'param_name' => 'united_kingdom',
          // 'value' => __('Author facebook','bebostore'),
          'description' => __( 'United kingdom link.', 'bebostore' ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Japan', 'bebostore' ),
          'param_name' => 'japan_link',
          // 'value' => __('Author facebook','bebostore'),
          'description' => __( 'Japan shop link.', 'bebostore' ),
        ),
      ),
   ) );
}
class WPBakeryShortCode_Be_agency extends WPBakeryShortCode {}


//This for section blog
add_action( 'vc_before_init', 'bebostore_LogoPublisher', 999999);
function bebostore_LogoPublisher() {
  global $bebostore_perpage_arr;
  vc_map( array(
      "name" => __( "Show logo publisher", "bebostore" ),
      "base" => "be_publisherlogo",
      'weight' => 91,
      'category' => __( 'Beau Theme', 'bebostore' ),
      'description' => __( 'This section contain list logo publisher', 'bebostore' ),
      "params" => array(
        // Need and image, select book, add more info
        array(
          'type' => 'dropdown',
          'heading' => __( 'Show logo limit', 'bebostore' ),
          'param_name' => 'perpage',
          'value' => $bebostore_perpage_arr,
          'std' => 30,
          'admin_label' => true,
          'description' => __( 'Limit logo load.', 'bebostore' )
        ),
         array(
          'type' => 'dropdown',
          'heading' => __( 'Number logo to show', 'bebostore' ),
          'param_name' => 'perslide',
          'value' => array(
            '1'=>'1',
            '2'=>'2',
            '3'=>'3',
            '4'=>'4',
            '5'=>'5',
            '6'=>'6',
            '7'=>'7',
            '8'=>'8',
            '9'=>'9',
            '10'=>'10',
          ),
          'admin_label' => true,
          'description' => __( 'Select columns count.', 'bebostore' )
        ),
      ),
   ) );
}
class WPBakeryShortCode_Be_publisherlogo   extends WPBakeryShortCode {}


//This for section categoies blog
add_action( 'vc_before_init', 'bebostore_proCategories', 999999);
function bebostore_proCategories() {
  vc_map( array(
      "name" => __( "Beau pro categories", "bebostore" ),
      "base" => "be_woocategory",
      'weight' => 91,
      'description' => __( 'Show categories products in masory layout', 'bebostore' ),
      "params" => array(
        // Need and image, select book, add more info
        array(
          'type' => 'dropdown',
          'heading' => __( 'Style Slide', 'bebostore' ),
          'param_name' => 'option',
          'value' => array('Select...' => '', 'Home 06' => 'home-06', 'Home 07' => 'home-07'),
          'admin_label' => true,
          'description' => __( 'Select style Slide.', 'bebostore' )
        ),
        array(
          'type'          => 'autocomplete',
          'heading'       => esc_html__( 'Select categoies show', 'bebostore' ),
          'param_name'    => 'product_cat',
          'admin_label' => true,
          'settings'      => array(
              'multiple'          => true,
              'sortable'          => true,
              'min_length'        => 1,
              'no_hide'           => true,
              'groups'            => true,
              'unique_values'     => true,
              'display_inline'    => true,
              'values'            => bebostore_get_list_taxonomy_by_name('product_cat')
          ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Number item:', 'bebostore' ),
          'param_name' => 'number',
        ),
      ),
   ) );
}
class WPBakeryShortCode_Be_woocategory extends WPBakeryShortCode {}

//This for author list
add_action( 'vc_before_init', 'bebostore_Authorlist', 999999);
function bebostore_Authorlist() {
  global $bebostore_perpage_arr;
  vc_map( array(
      "name" => __( "Show list author", "bebostore" ),
      "base" => "be_authorlist",
      'weight' => 91,
      'category' => __( 'Beau Theme', 'bebostore' ),
      'description' => __( 'This section contain author info and some book', 'bebostore' ),
      "params" => array(
        // Need and image, select book, add more info
        array(
          'type' => 'textfield',
          'heading' => __( 'Title section', 'bebostore' ),
          'param_name' => 'title_box',
          // 'value' => __('Author facebook','bebostore'),
          'description' => __( 'This for title box.', 'bebostore' ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Perpage', 'bebostore' ),
          'param_name' => 'perpage',
          'value' => $bebostore_perpage_arr,
          'std' => 4,
          'admin_label' => true,
          'description' => __( 'Select columns count.', 'bebostore' )
        ),
      ),
   ) );
}
class WPBakeryShortCode_Be_authorlist extends WPBakeryShortCode {}


//This for list feature
add_action( 'vc_before_init', 'bebostore_Listfeature', 999999);
function bebostore_Listfeature() {
  global $bebostore_perpage_arr, $bebostore_icons;
  vc_map( array(
      "name" => __( "Show a icon", "bebostore" ),
      "base" => "be_listfeature",
      'weight' => 91,
      'category' => __( 'Beau Theme', 'bebostore' ),
      'description' => __( 'This section show a icon with short description and title', 'bebostore' ),
      "params" => array(
      	// Need and image, select book, add more info
        array(
          'type' => 'textfield',
          'heading' => __( 'Title feature', 'bebostore' ),
          'param_name' => 'title_service',
          'value' => '',
          'description' => __( 'Your feature', 'bebostore' ),
          // "group" => __( 'Feature 1', 'bebostore' ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Chose your icon', 'bebostore' ),
          'param_name' => 'service_icon',
          'value' => $bebostore_icons,
          'std' => 3,
          'admin_label' => true,
          // 'description' => __( 'Select columns count.', 'bebostore' )
          // "group" => __( 'Feature', 'bebostore' ),
        ),
        array(
          'type' => 'textarea',
          'holder' => 'div',
          'heading' => __( 'Description', 'bebostore' ),
          'param_name' => 'desc_service',
          'value' => '',
          // "group" => __( 'Feature 1', 'bebostore' ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Chose your type', 'bebostore' ),
          'param_name' => 'service_type',
          'value' => array('Default' => 'default','Show only Icon & title' => 'show-only-icon'),
          'admin_label' => true,
          // 'description' => __( 'Select columns count.', 'bebostore' )
          // "group" => __( 'Feature', 'bebostore' ),
        ),
      ),
   ) );
}
class WPBakeryShortCode_Be_listfeature extends WPBakeryShortCode {}


//This for subcribe
add_action( 'vc_before_init', 'bebostore_Subscribeform', 999999);
function bebostore_Subscribeform() {
  global $bebostore_perpage_arr;
  vc_map( array(
      "name" => __( "Show subcribe form", "bebostore" ),
      "base" => "be_subcribeform",
      'weight' => 91,
      'category' => __( 'Beau Theme', 'bebostore' ),
      'description' => __( 'This section show subcribe form', 'bebostore' ),
      "params" => array(
      	// Need and image, select book, add more info
        array(
          'type' => 'textfield',
          'heading' => __( 'Title', 'bebostore' ),
          'param_name' => 'subcribe_title',
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Chose your type', 'bebostore' ),
          'param_name' => 'subcribe_type',
          'value' => array('Chose your layout'=>'0','Full layout' => 'full_layout', 'Small in column' => 'ahalf'),
          'admin_label' => true,
          'description' => __( 'Chose your layout you want to show', 'bebostore' )
        ),
        array(
          'type' => 'textarea',
          'heading' => __( 'Description', 'bebostore' ),
          'param_name' => 'subcribe_description',
        ),
      ),
   ) );
}
class WPBakeryShortCode_Be_subcribeform extends WPBakeryShortCode {}


//This for testimonial
add_action( 'vc_before_init', 'bebostore_Testimonial', 999999);
function bebostore_Testimonial() {
  global $bebostore_perpage_arr;
  vc_map( array(
      "name" => __( "Show testimonial", "bebostore" ),
      "base" => "be_testimonial",
      'weight' => 91,
      'category' => __( 'Beau Theme', 'bebostore' ),
      'description' => __( 'This section show testimonial', 'bebostore' ),
      "params" => array(
      	// Need and image, select book, add more info
        array(
          'type' => 'dropdown',
          'heading' => __( 'Testimonial type', 'bebostore' ),
          'param_name' => 'testi_type',
          'value' =>array('Chose your testimonial type' => '0', 'Full Width' => 'full_layout', '1/2 page'=>'ahalf'),
          'admin_label' => true,
          'description' => __( 'Number to show your testimonial', 'bebostore' )
        ),
        
        array(
          "type" => "checkbox",
          "holder" => "div",
          "class" => "",
          "heading" => __( "Show navigation", 'bebostore' ),
          "param_name" => "show_nav",
          "description" => __( "Show navigation?", 'bebostore' )
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Perpage', 'bebostore' ),
          'param_name' => 'perpage',
          'value' => $bebostore_perpage_arr,
          'std' => 3,
          'admin_label' => true,
          'description' => __( 'Number to show your testimonial', 'bebostore' )
        ),
      ),
   ) );
}
class WPBakeryShortCode_Be_testimonial extends WPBakeryShortCode {}



//Short paragraph
add_action( 'vc_before_init', 'bebostore_Shortparagraph', 999999);
function bebostore_Shortparagraph() {
  global $bebostore_perpage_arr;
  vc_map( array(
      "name" => __( "About paragraph", "bebostore" ),
      "base" => "be_shortparagraph",
      'weight' => 91,
      'category' => __( 'Beau Theme', 'bebostore' ),
      'description' => __( 'This section show video', 'bebostore' ),
      "params" => array(
        // Need and image, select book, add more info

        array(
          'type' => 'textfield',
          'heading' => __( 'Title paragraph', 'bebostore' ),
          'param_name' => 'title_paragraph',
        ),
        array(
          'type' => 'textarea_html',
          'holder' => 'div',
          'heading' => __( 'Content', 'bebostore' ),
          'param_name' => 'content',
          'value' => __( '<p>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>', 'bebostore' ),
          // 'group' => __('Author info','bebostore')
        ),

        array(
          'type' => 'attach_image',
          'heading' => __( 'Image 1', 'bebostore' ),
          'param_name' => 'small_image',
          'value' => '',
          'description' => __( 'Select image from media library.', 'bebostore' ),
          'group' => 'More setting',
        ),
        array(
          'type' => 'attach_image',
          'heading' => __( 'Image 2', 'bebostore' ),
          'param_name' => 'big_image',
          'value' => '',
          'description' => __( 'Select image from media library.', 'bebostore' ),
          'group' => 'More setting',
        ),

        array(
          'type' => 'textfield',
          'heading' => __( 'Max height', 'bebostore' ),
          'param_name' => 'maxheight',
          'group' => 'More setting',
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Chose your style', 'bebostore' ),
          'param_name' => 'style_padding',
          'value' => array('Default' =>'', 'No padding'=>'no-padding'),
          'admin_label' => true,
          'description' => __( 'Main book on landing page', 'bebostore' )
        ),
      ),
   ) );
}
class WPBakeryShortCode_Be_shortparagraph extends WPBakeryShortCode {}


















 ?>