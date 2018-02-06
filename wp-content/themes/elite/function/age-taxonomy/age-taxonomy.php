<?php
/*
  Plugin Name: Age Taxonomy
  Description: Declares a plugin that will create a age taxonomy.
  Version: 1.0
  Author: Tenderhook
 */


Class AGE_TAXONOMY {
    var $domain;
    var $type_name;
    var $item_per_page;
    var $app_version;

	function __construct() {
        $this->domain = 'age_taxonomy';
        $this->type_name = 'age_taxonomy';
        $this->item_per_page = 3;
        $this->app_version = '1.0';

        add_action('init', array($this, 'create_age_taxonomy'));
        
	}

	function create_age_taxonomy() {
	    // Labels part for the GUI
	    $labels = array(
                'name' => 'Age',
                'singular_name' => 'Age',
                'search_items' => 'Search Age',
                'popular_items' => 'Popular Age',
                'all_items' => 'All Age',
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => 'Edit Age',
                'update_item' => 'Update Age',
                'add_new_item' => 'Add New Age',
                'new_item_name' => 'New Age Name',
                'add_or_remove_items' => __('Add or remove age'),
                'choose_from_most_used' => __('Choose from the most age'),
                'menu_name' => __('Age'),
	    );
            $array_post_type = apply_filters( 'activity_post_type_filter', array('camp'));
	    // Now register the non-hierarchical taxonomy like tag
	     register_taxonomy($this->type_name, $array_post_type, array(
                'hierarchical' => false,
                'labels' => $labels,
                'show_ui' => true,
                'show_tagcloud' => false,
                'show_in_nav_menus' => false,
                'query_var' => FALSE,
                'update_count_callback' => '_update_post_term_count',
                'show_in_quick_edit'         => false,
                'meta_box_cb'                => false,
            ));
	}
}

$ageObj = new AGE_TAXONOMY();