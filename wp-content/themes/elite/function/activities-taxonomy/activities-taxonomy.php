<?php
/*
  Plugin Name: Activities Taxonomy
  Description: Declares a plugin that will create a activities taxonomy.
  Version: 1.0
  Author: Tenderhook
 */


Class ACTIVITIES_TAXONOMY {
    var $domain;
    var $type_name;
    var $item_per_page;
    var $app_version;

	function __construct() {
        $this->domain = 'activities_taxonomy';
        $this->type_name = 'activities_taxonomy';
        $this->item_per_page = 3;
        $this->app_version = '1.0';

        add_action('init', array($this, 'create_activities_taxonomy'));
        
        add_action('admin_enqueue_scripts', array($this, 'load_wp_media_files'));

        add_action('activities_taxonomy_add_form_fields', array($this, 'pt_taxonomy_add_new_meta_field'), 10, 2);
        
        add_action('activities_taxonomy_edit_form_fields', array($this, 'pt_taxonomy_edit_meta_field'), 10, 2);
        
        add_action('create_activities_taxonomy', array($this, 'pt_save_taxonomy_custom_meta'), 10, 2);
        add_action('edited_activities_taxonomy', array($this, 'update_feature_meta'), 10, 2);
        add_filter('manage_edit-activities_taxonomy_columns', array($this, 'add_feature_group_column'));
        add_filter('manage_activities_taxonomy_custom_column', array($this, 'add_feature_group_column_content'), 10, 3);
        
	}

	function create_activities_taxonomy() {
	    // Labels part for the GUI
	    $labels = array(
                'name' => 'Activity',
                'singular_name' => 'Activity',
                'search_items' => 'Search Activities',
                'popular_items' => 'Popular Activities',
                'all_items' => 'All Activities',
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => 'Edit Activity',
                'update_item' => 'Update Activity',
                'add_new_item' => 'Add New Activity',
                'new_item_name' => 'New Activity Name',
                'add_or_remove_items' => __('Add or remove activities'),
                'choose_from_most_used' => __('Choose from the most activities'),
                'menu_name' => __('Activities'),
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

    function load_wp_media_files() {
        wp_enqueue_media();
    }



    function pt_taxonomy_add_new_meta_field() {
        // this will add the custom meta field to the add new term page
        // this will add the custom meta field to the add new term page
        $city_taxonomy = get_terms('city_taxonomy', array(
            'orderby' => 'name',
            'hide_empty' => false
        ));
        ?>
        <style type="text/css">
            #picholder {
                display: none;
            }
            .display-webkit-inline{
                display: -webkit-inline-box;
             }
        </style>

        <div class="form-field">
            <label for="term_meta"><?php _e('Icon', 'pt'); ?></label>
            <div class="image_pre_load">
                <?php
                echo "<img src=\"" . get_template_directory_uri() . "/images/picholder.png\">";
                ?>
            </div>
            <input type="hidden" name="term_meta" class="meta-image" value="<?php echo $term_meta ? $term_meta : ''; ?> "/>
            <input type="button" id="" class="button meta-image-button" value="<?php echo _e('Choose or Upload an Image', '') ?>" />
        </div>
        <img src="<?php echo get_template_directory_uri() ?>/images/picholder.png" id="picholder" >
        
        <script type="text/javascript">
            var $ = jQuery;
            jQuery(document).ready(function ($) {
                // Choose media
                //            jQuery('.meta-image-button').on('click', function (event) {
                jQuery('.meta-image-button').live("click", function (event) {
                    var item_image_frame;
                    var $el = $(this);
                    var attachment_ids = $el.parent("td").find(".meta-image").val();//$('#meta-image').val();
                    event.preventDefault();
                    // If the media frame already exists, reopen it.
                    if (item_image_frame) {
                        item_image_frame.open();
                        return;
                    }
                    // Create the media frame.
                    item_image_frame = wp.media.frames.promotion_image = wp.media({
                        // Set the title of the modal.
                        title: $el.data('choose'),
                        button: {
                            text: $el.data('update'),
                        },
                        states: [
                            new wp.media.controller.Library({
                                title: $el.data('choose'),
                                filterable: 'all',
                                multiple: false,
                            })
                        ]
                    });
                    // When an image is selected, run a callback.
                    item_image_frame.on('select', function () {
                        var selection = item_image_frame.state().get('selection');
                        selection.map(function (attachment) {
                            attachment = attachment.toJSON();
                            if (attachment.id) {
                                attachment_ids = attachment.id;//attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;
                                attachment_image = attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;
                                $el.parent("div").find(".image_pre_load").html('\
                            <img src="' + attachment_image + '" />\
                            <p><a href="#" class="delete" title="Delete">Delete</a></p>');
                            }
                        });

                        $el.parent("div").find(".meta-image").val(attachment_ids);
                    });
                    // Finally, open the modal.
                    item_image_frame.open();
                    return false;
                });
                // Remove image
                $('.image_pre_load').on('click', 'a.delete', function () {
                    //event.preventDefault();
                    $(this).parent('p').parent(".image_pre_load").parent('div').find(".meta-image").val('');
                    // $(this).parent('p').parent(".image_pre_load").empty();
                    $(this).parent('p').parent(".image_pre_load").html("<img src='" + $("#picholder").attr('src') + "'>");
                    //alert("<img src='" + $("#picholder").attr('src') + "'>");
                    return false;
                });
            });

        </script>

        <?php
    }



    function pt_taxonomy_edit_meta_field($term, $taxonomy) {

        global $term_meta;
        $t_id = $term->term_id;
        //$term_meta = get_option( "travel_styles_$t_id" );
        $term_meta = get_term_meta($term->term_id, 'term_meta', true);
        $city_taxonomy = get_terms('city_taxonomy', array(
            'orderby' => 'name',
            'hide_empty' => false
        ));
        ?>
        <style type="text/css">
            .circle_desc{
                height: 4em;
                width: 100%;
            }
            #picholder {
                display: none;
            }
            .btn-add{
                margin-bottom: 10px !important;
            }
            #logos-list tbody tr td{
                padding: 10px 10px;
            }
            #logos-list tbody tr:nth-child(2n) td{
                background-color: #eff0f1;
            }

        </style>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="term_meta"><?php _e('Icon', 'pt'); ?></label></th>
            <td width="200px" valign="top">
                <div class="image_pre_load">
                    <?php
                    if ($term_meta != "") {
                        echo wp_get_attachment_image($term_meta, 'thumbnail');
                        echo "<p><a href=\"#\" class=\"delete\" title=\"Delete\">Delete</a></p>";
                    } else {
                        echo "<img src=\"" . get_template_directory_uri() . "/images/picholder.png\">";
                    }
                    ?>
                </div>
                <input type="hidden" name="term_meta" class="meta-image" value="<?php echo $term_meta ? $term_meta : ''; ?> " />
                <input type="button" id="" class="button meta-image-button" value="<?php echo _e('Choose or Upload an Image', '') ?>" />
            </td>
        </tr>
        <img src="<?php echo get_template_directory_uri() ?>/images/picholder.png" id="picholder" >
       
        <script type="text/javascript">
            var $ = jQuery;
            jQuery(document).ready(function ($) {
                // Choose media
                //            jQuery('.meta-image-button').on('click', function (event) {
                jQuery('.meta-image-button').live("click", function (event) {
                    var item_image_frame;
                    var $el = $(this);
                    var attachment_ids = $el.parent("td").find(".meta-image").val();//$('#meta-image').val();
                    event.preventDefault();
                    // If the media frame already exists, reopen it.
                    if (item_image_frame) {
                        item_image_frame.open();
                        return;
                    }
                    // Create the media frame.
                    item_image_frame = wp.media.frames.promotion_image = wp.media({
                        // Set the title of the modal.
                        title: $el.data('choose'),
                        button: {
                            text: $el.data('update'),
                        },
                        states: [
                            new wp.media.controller.Library({
                                title: $el.data('choose'),
                                filterable: 'all',
                                multiple: false,
                            })
                        ]
                    });
                    // When an image is selected, run a callback.
                    item_image_frame.on('select', function () {
                        var selection = item_image_frame.state().get('selection');
                        selection.map(function (attachment) {
                            attachment = attachment.toJSON();
                            if (attachment.id) {
                                attachment_ids = attachment.id;//attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;
                                attachment_image = attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;
                                $el.parent("td").parent("tr").find(".image_pre_load").html('\
                            <img src="' + attachment_image + '" />\
                            <p><a href="#" class="delete" title="Delete">Delete</a></p>');
                            }
                        });
                        $el.parent("td").find(".meta-image").val(attachment_ids);
                    });
                    // Finally, open the modal.
                    item_image_frame.open();
                });
                // Remove image
                $('.image_pre_load').on('click', 'a.delete', function () {
                    //event.preventDefault();
                    $(this).parent('p').parent(".image_pre_load").parent('td').find(".meta-image").val('');
                    // $(this).parent('p').parent(".image_pre_load").empty();
                    $(this).parent('p').parent(".image_pre_load").html("<img src='" + $("#picholder").attr('src') + "'>");
                    //alert($("#picholder").attr('src'));
                    return false;
                });
            });

        </script>
        <?php
    }

    function pt_save_taxonomy_custom_meta($term_id) {
        if (isset($_POST['term_meta']) && '' !== $_POST['term_meta']) {
            $group = sanitize_title($_POST['term_meta']);
            add_term_meta($term_id, 'term_meta', $group, true);
        }
        
    }



    function update_feature_meta($term_id, $tt_id) {
        if (isset($_POST['term_meta']) && '' !== $_POST['term_meta']) {
            $group = sanitize_title($_POST['term_meta']);
            update_term_meta($term_id, 'term_meta', $group);
        }
    }



    function add_feature_group_column($columns) {
        $columns['term_meta'] = __('Icon');
        return $columns;
    }



    function add_feature_group_column_content($content, $column_name, $term_id) {
        global $term_meta;

        if ($column_name !== 'term_meta') {
            return $content;
        }

        $term_id = absint($term_id);
        $term_meta = get_term_meta($term_id, 'term_meta', true);


        echo wp_get_attachment_image($term_meta, array('50', '50'), "", array("class" => "img-responsive"));
    }
   

}

$activitiesObj = new ACTIVITIES_TAXONOMY();