<?php
define("FUNC_DIR", get_template_directory() . "/function");
Class Testimonials_Post_type {
    var $type_name;
    var $flush_option;
    var $postSlug;
    var $domain;

    function __construct() {
        $this->type_name = 'testimonials';
        $this->flush_option = $this->type_name . '_flush_1.0.3';
        $this->postSlug = 'testimonials';
        $this->domain = '';
        add_action('init', array($this, 'custom_post_type'));
        add_action('init', array($this, 'application_check'));
    }

    function custom_post_type() {
        $args = array(
            'label' => __('Testimonials', $this->domain),
            'description' => __('Testimonials', $this->domain),
            'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_in_admin_bar' => true,
            'menu_position' => 23,
            'can_export' => true,
            'has_archive' => false,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'rewrite' => array('slug' => $this->postSlug),
        );
        // Registering your Custom Post Type
        register_post_type($this->type_name, $args);
    }
    function application_check() {
        if (!get_option($this->flush_option)) {
            flush_rewrite_rules();
            update_option($this->flush_option, true);
        }
    }

}
$testObj = new Testimonials_Post_type();