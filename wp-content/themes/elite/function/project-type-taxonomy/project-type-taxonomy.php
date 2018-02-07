<?php
/*
  Plugin Name: Project Type Taxonomy
  Description: Declares a plugin that will create a Project Type taxonomy.
  Version: 1.0
  Author: Mint Apirada Pumpan
 */


Class PJTYPE_TAXONOMY {
    var $domain;
    var $type_name;
    var $item_per_page;
    var $app_version;

	function __construct() {
        $this->domain = 'pjtype_taxonomy';
        $this->type_name = 'pjtype_taxonomy';
        $this->item_per_page = 3;
        $this->app_version = '1.1';

        add_action('init', array($this, 'create_pjtype_taxonomy'));
        
	}

	function create_pjtype_taxonomy() {
	    // Labels part for the GUI
	    $labels = array(
                'name' => 'Project Types',
                'singular_name' => 'Project Types',
                'search_items' => 'Search Project Types',
                'popular_items' => 'Popular Project Types',
                'all_items' => 'All Project Types',
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => 'Edit Project Type',
                'update_item' => 'Update Project Type',
                'add_new_item' => 'Add New Project Type',
                'new_item_name' => 'New Project Type Name',
                'add_or_remove_items' => __('Add or remove Project Type'),
                'choose_from_most_used' => __('Choose from the most Project Type'),
                'menu_name' => __('Project Types'),
	    );
	    // Now register the non-hierarchical taxonomy like tag
	     register_taxonomy($this->type_name, 'projects', array(
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

$pjtypeObj = new PJTYPE_TAXONOMY();