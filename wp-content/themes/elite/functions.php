<?php
define("FUNC_DIR", get_template_directory() . "/function");
define("INCLUDES_DIR", get_template_directory() . "/includes");
define("THEME_DIR", FUNC_DIR . "/theme");
define("TEMPLATE_URI",  get_template_directory_uri());
define("TEMPLATE_DIR",  get_template_directory());
require_once THEME_DIR . "/functions.php";
require_once FUNC_DIR.'/camp-cpt/camp-cpt.php';
require_once FUNC_DIR.'/activities-taxonomy/activities-taxonomy.php';
require_once FUNC_DIR.'/testimonials-cpt/testimonials-cpt.php';
require_once FUNC_DIR.'/condition-cpt/condition-cpt.php';
require_once FUNC_DIR.'/age-taxonomy/age-taxonomy.php';
require_once FUNC_DIR.'/project-cpt/project-cpt.php';
require_once FUNC_DIR.'/project-type-taxonomy/project-type-taxonomy.php';
require_once FUNC_DIR.'/front-page/front-page.php';


add_action('after_setup_theme', 'elite_setup');

function elite_setup() {
    load_theme_textdomain('elite', get_template_directory() . '/languages');
    add_theme_support('post-thumbnails');

// Image size
    add_image_size('testimonial_thmb_size', 118, 116, true);
    add_image_size('tours-thumbnail', 9999, 650, false);
    add_image_size('circle-logo', 150, 150, true);
    add_image_size('img300-crop', 300, 300, true);
    add_image_size('img200-crop', 200, 200, true);

}

add_action('wp_enqueue_scripts', 'elite_load_scripts');

function elite_load_scripts() {
    wp_enqueue_style('bootstrap-style', get_stylesheet_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style('bulma-css', get_stylesheet_directory_uri() . "/css/bulma.css", array());
     wp_enqueue_style('font-awesome-css', get_stylesheet_directory_uri() . '/css/font-awesome.min.css');
    wp_enqueue_style('chosen-css', get_stylesheet_directory_uri() . '/lib/chosen/chosen.min.css');



    wp_enqueue_style('bootstrap-dropdownhover-css', get_stylesheet_directory_uri() . '/css/bootstrap-dropdownhover.min.css');
    wp_enqueue_style('bootstrap-datetimepicker-css', get_stylesheet_directory_uri() . '/css/bootstrap-datetimepicker.min.css');
    wp_enqueue_style('bootstrap-select-css', get_stylesheet_directory_uri() . '/css/bootstrap-select.min.css');
    wp_enqueue_style('owlcarousel-css', get_stylesheet_directory_uri() . '/lib/owlcarousel/owl.carousel.min.css');
    wp_enqueue_style('owlcarousel-default-css', get_stylesheet_directory_uri() . '/lib/owlcarousel/owl.theme.default.min.css');
    wp_enqueue_style('lightbox-css', get_stylesheet_directory_uri() . '/lib/lightbox/lightbox2-master/dist/css/lightbox.min.css');

    wp_enqueue_style('main-css', get_stylesheet_directory_uri() . '/css/main.css',array('bootstrap-style'),filemtime(get_stylesheet_directory()."/css/main.css"));


// JS
    // wp_enqueue_script('jquery-js', get_stylesheet_directory_uri() . '/js/jquery-1.12.2.min.js');
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', get_stylesheet_directory_uri() .'/js/jquery-2.2.4.min.js', array(), null);

    wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri() . '/js/bootstrap.min.js',array('jquery'),null,true);
    wp_enqueue_script('moment-js', get_stylesheet_directory_uri() . '/js/moment.min.js',array('jquery'),null,true);
    wp_enqueue_script('classie-js', get_stylesheet_directory_uri() . '/js/classie.js',array('jquery'),null,true);
    wp_enqueue_script('modernizr.custom-js', get_stylesheet_directory_uri() . '/js/modernizr.custom.js',array('jquery'),null,true);
    wp_enqueue_script('bootstrap-dropdownhover-js', get_stylesheet_directory_uri() . '/js/bootstrap-dropdownhover.min.js',array('jquery'),null,true);
    wp_enqueue_script('bootstrap-datetimepicker-js', get_stylesheet_directory_uri() . '/js/bootstrap-datetimepicker.min.js',array('jquery'),null,true);
    wp_enqueue_script('bootstrap-formhelpers-js', get_stylesheet_directory_uri() . '/js/bootstrap-formhelpers.min.js',array('jquery'),null,true);
    wp_enqueue_script('intlTelInput-js', get_stylesheet_directory_uri() . '/js/intlTelInput.min.js',array('jquery'),null,true);
    wp_enqueue_script('bootstrap-select-js', get_stylesheet_directory_uri() . '/js/bootstrap-select.min.js',array('jquery'),null,true);
    wp_enqueue_script('validator-js', get_stylesheet_directory_uri() . '/js/validator.min.js',array('jquery'),null,true);
    wp_enqueue_script('owlcarousel-js', get_stylesheet_directory_uri() . '/lib/owlcarousel/owl.carousel.min.js',array('jquery'),null,true);
    wp_enqueue_script('set-height-block-js', get_stylesheet_directory_uri() . '/js/set-height-block.js',array('jquery'),null,true);
    wp_enqueue_script('chosen-js', get_stylesheet_directory_uri() . '/lib/chosen/chosen.jquery.js',array('jquery'),null,true);
    wp_enqueue_script('lightbox-js', get_stylesheet_directory_uri() . '/lib/lightbox/lightbox2-master/dist/js/lightbox.min.js',array('jquery'),null,true);
    wp_enqueue_script('nav-js', get_stylesheet_directory_uri() . '/js/nav.js');
    wp_enqueue_script('parallax-js', get_stylesheet_directory_uri() . '/js/parallax.min.js',array('jquery'),null,true);

}

function add_footer_styles_js() {

   
}


add_action('get_footer', 'add_footer_styles_js');

function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'footer-menu' => __( 'Footer Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );


function genPDF(){
    require_once INCLUDES_DIR.'/mpdf/mpdf.php';
    $pdf = new mPDF('th', 'A4-L', '0');
    $pdf->SetDisplayMode('fullpage');
    $pdf->WriteHTML('<h1>Hello world</h1>');
    $pdf->Output();
}

/* SMTP */
add_action('phpmailer_init', 'custom_phpmailer_init');

function custom_phpmailer_init(PHPMailer $phpmailer) {
    $phpmailer->Host = 'smtp.sendgrid.net';
    $phpmailer->Port = 587; // could be different
    $phpmailer->Username = 'apikey'; // if required
    $phpmailer->Password = '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'; // if required
    $phpmailer->SMTPAuth = true; // if required
    $phpmailer->SMTPSecure = 'tls'; // enable if required, 'tls' is another possible value
    $phpmailer->IsSMTP();
    $phpmailer->IsSMTP();

}


function get_taxonomy_list($taxonomy_name){
    global $wpdb;
        $term_tax_table = $wpdb->prefix . "term_taxonomy";
        $term_table = $wpdb->prefix . "terms";
        $sql_string = "SELECT * FROM {$term_tax_table} JOIN {$term_table} ON {$term_tax_table}.`term_id` = {$term_table}.`term_id` WHERE {$term_tax_table}.`taxonomy` = '{$taxonomy_name}'";
    return $wpdb->get_results($sql_string, OBJECT);
}

function wp_get_menu_array($current_menu) {
    $array_menu = wp_get_nav_menu_items($current_menu);
    $menu = array();
    foreach ($array_menu as $m) {
        if (empty($m->menu_item_parent)) {
            $menu[$m->ID] = array();
            $menu[$m->ID]['ID']      =   $m->ID;
            $menu[$m->ID]['title']       =   $m->title;
            $menu[$m->ID]['url']         =   $m->url;
            $menu[$m->ID]['children']    =   array();
        }
    }
    $submenu = array();
    foreach ($array_menu as $m) {
        if ($m->menu_item_parent) {
            $submenu[$m->ID] = array();
            $submenu[$m->ID]['ID']       =   $m->ID;
            $submenu[$m->ID]['title']    =   $m->title;
            $submenu[$m->ID]['url']  =   $m->url;
            $menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
        }
    }
    return $menu;
}