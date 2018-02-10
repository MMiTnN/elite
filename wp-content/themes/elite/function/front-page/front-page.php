<?php
define("FUNC_DIR_FRONT_PAGE", get_template_directory() . "/function/front-page");

class Front_Functions {

    var $metabox_id = "front_page_metabox";
    var $profile_tab;

    function __construct() {
        if (is_admin()) {            
            require_once FUNC_DIR_FRONT_PAGE . '/tabs/profile.php';
            $this->profile_tab = new Profile_tab();
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
            if($post->post_name == 'homepage'){
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
                <li><a href="#tab-profile">Profile</a></li>
            </ul>

            <div id="tab-profile">
                <?php $this->profile_tab->get_form($post); ?>
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

        $this->profile_tab->save($post_id);
    }


}

new Front_Functions();
