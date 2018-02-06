<?php
define("FUNC_DIR", get_template_directory() . "/function");
Class Condition_Post_type {
    public static $template_name = "template-forparents.php";
    var $type_name;
    var $flush_option;
    var $postSlug;
    var $domain;
    var $metabox_id = "condition_metabox";
    var $condition_tab;

    function __construct() {
        $this->type_name = 'page';
        $this->postSlug = 'page';
        $this->domain = '';
        if (is_admin()) {
            require_once FUNC_DIR . '/condition-cpt/tabs/condition-tab.php';

            $this->condition_tab = new Condition_tab();
        }
        add_action('add_meta_boxes', array($this, 'add_meta_box'));
        add_action('save_post', array($this, 'save_meta_box'));
    }

    /**
     * Add metabox to specific template
     */
    function add_meta_box() {
        global $post;

        if (!empty($post)) {
            $template_file = get_post_meta($post->ID, '_wp_page_template', TRUE);


            if ($template_file == self::$template_name) {
                add_meta_box(
                        $this->metabox_id, __('More Detail', ''), array($this, "meta_box_content"), 'page', 'normal', 'high'
                );
            }
        }
    }

    /**
     * Metabox Content
     */
    function meta_box_content($post) {
        /* Create nonce */
        wp_nonce_field(plugin_basename(__FILE__), $this->metabox_id . '_nonce');
        ?>
        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-ui.js"></script>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery-ui.css">
        <div id="tabs">
            <ul>
                <li><a href="#tab-condition">Table of contents </a></li>
            </ul>
            <div id="tab-condition">
                <?php $this->condition_tab->get_form($post); ?>
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

        $this->condition_tab->save($post_id);
    }
}
$conObj = new Condition_Post_type();