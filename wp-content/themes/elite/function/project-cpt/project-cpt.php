<?php
define("FUNC_DIR_FRONT", get_template_directory() . "/function/project-cpt");

class Project_Functions {

    var $metabox_id = "projec_metabox";
    var $pic_tab;

    function __construct() {
        $this->type_name = 'projects';
        $this->flush_option = $this->type_name . '_flush_1.0.5';
        $this->postSlug = 'projects';
        $this->domain = 'elite';
        add_action('init', array($this, 'custom_post_type'));
        add_action('init', array($this, 'application_check'));

        if (is_admin()) {            
            require_once FUNC_DIR_FRONT . '/tabs/projectpic.php';
            
            $this->pic_tab = new Projectpic_tab();
        }

        add_action('add_meta_boxes', array($this, 'add_meta_box'));
        add_action('save_post', array($this, 'save_meta_box'));
    }

    function custom_post_type() {
        $args = array(
            'label' => __('Projects', $this->domain),
            'description' => __('Projects', $this->domain),
            'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_in_admin_bar' => true,
            'menu_position' => 23,
            'can_export' => true,
            'has_archive' => true,
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

    /**
     * Add metabox to specific template
     */
    function add_meta_box() {

        global $post;

        if (!empty($post)) {
              add_meta_box(
                $this->metabox_id, __('More Detail', ''), array($this, "meta_box_content"), $this->type_name, 'normal', 'high'
            );
            
        }
    }

    /**
     * Metabox Content
     */
    function meta_box_content($post) {
        /* Create nonce */
        wp_nonce_field(plugin_basename(__FILE__), $this->metabox_id . '_nonce');
        $post_id = $post->ID;
        $_pjt = get_post_meta($post_id, '_pjt', true);
        $pjt = get_taxonomy_list('pjtype_taxonomy');
        ?>
        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-ui.js"></script>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery-ui.css">
        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/wp_editor_custom.js"></script>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/admin.css">
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label ><?php _e('Project Type', 'elite'); ?></label>
                </th>

                <td>
                     <select name="filter_pjt" id="filter_pjt" class="select-box">
                        <?php foreach ($pjt as $key => $value) { ?>
                            <option value="<?php echo $value->name; ?>" <?php if($_pjt == $value->name) echo selected; ?> ><?php echo $value->name; ?></option>
                        <?php } ?> 
                    </select>
                </td>
            </tr>
        </table>

        <div id="tabs">
            <ul> 
                <li><a href="#tab-pic">Project picture</a></li>
            </ul>
            
            <div id="tab-pic">
                <?php $this->pic_tab->get_form($post); ?>
            </div>
        </div>

        <script type="text/javascript">
            (function ($) {
                $("#tabs").tabs(
                        {active: 0}
                );
            })(jQuery);
        </script>

        <?php
    }

    function save_meta_box($post_id) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return;

        if (!isset($_POST[$this->metabox_id . '_nonce']))
            return;

        if (!wp_verify_nonce($_POST[$this->metabox_id . '_nonce'], plugin_basename(__FILE__))) {
            return;
        }

        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id))
                return;
        }
        else {
            if (!current_user_can('edit_post', $post_id))
                return;
        }

        $_pjt = sanitize_text_field($_POST['filter_pjt']);
        update_post_meta($post_id, '_pjt', $_pjt);
       
        $this->pic_tab->save($post_id);
    }


}

new Project_Functions();
