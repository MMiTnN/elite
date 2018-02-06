<?php
define("FUNC_DIR", get_template_directory() . "/function");
Class Camp_Post_type {
    var $type_name;
    var $flush_option;
    var $postSlug;
    var $domain;
    var $metabox_id = "camp_metabox";
    var $video_left_tab;
    var $video_right_tab;
    var $activities_tab;
    var $day_activities_tab;
    var $date_tab;

    function __construct() {
        $this->type_name = 'camp';
        $this->flush_option = $this->type_name . '_flush_1.0.3';
        $this->postSlug = 'camp';
        $this->domain = '';
        add_action('init', array($this, 'custom_post_type'));
        add_action('init', array($this, 'application_check'));
        if (is_admin()) {
            require_once FUNC_DIR . '/camp-cpt/tabs/video-left.php';
            require_once FUNC_DIR . '/camp-cpt/tabs/video-right.php';
            require_once FUNC_DIR . '/camp-cpt/tabs/activities-tab.php';
            require_once FUNC_DIR . '/camp-cpt/tabs/day-activities.php';
            require_once FUNC_DIR . '/camp-cpt/tabs/date-tab.php';

            $this->video_left_tab = new Video_left_tab();
            $this->video_right_tab = new Video_right_tab();
            $this->activities_tab = new Acitities_tab();
            $this->day_activities_tab = new Day_activities_tab();
            $this->date_tab = new Date_tab();
        }
        add_action('add_meta_boxes', array($this, 'add_meta_box'));
        add_action('save_post', array($this, 'save_meta_box'));

        add_action('wp_ajax_activities_search_autocomplete', array($this->activities_tab, 'activities_autocomplete_callback'));

    }
    function custom_post_type() {
        $args = array(
            'label' => __('Camps', $this->domain),
            'description' => __('Camps', $this->domain),
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

    /**
     * Add metabox to specific template
     */
    function add_meta_box() {
        add_meta_box(
                $this->metabox_id, __('More Detail', ''), array($this, "meta_box_content"), $this->type_name, 'normal', 'high'
        );
    }

    /**
     * Metabox Content
     */
    function meta_box_content($post) {
        /* Create nonce */
        wp_nonce_field(plugin_basename(__FILE__), $this->metabox_id . '_nonce');
        $post_id = $post->ID;
        $_age = get_post_meta($post_id, '_age', true);
        $_price_camp = get_post_meta($post_id, '_price_camp', true);
        $_content_search = get_post_meta($post_id, '_content_search', true);
        $age = get_taxonomy_list('age_taxonomy');
        
        ?>
        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-ui.js"></script>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery-ui.css">
         <table class="form-table">
            <tr>
                <th scope="row">
                    <label >Ages</label>
                </th>

                <td>
                     <select name="filter_age" id="filter_age" class="select-box">
                        <option value="-1">---Select age---</option>
                        <?php foreach ($age as $key => $value) { ?>
                            <option value="<?php echo $value->term_id; ?>" <?php if($_age == $value->term_id) echo selected; ?> ><?php echo $value->name; ?></option>
                        <?php } ?> 
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label >Price</label>
                </th>

                <td>
                     <input type="text" value="<?php echo $_price_camp; ?>" id="_price_camp" name="_price_camp">
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label >Content on find a camp page</label>
                </th>

                <td>
                    <?php wp_editor($_content_search, '_content_search', array( 'editor_height' => '300','media_buttons'=>false)) ?>
                </td>
            </tr>
        </table>
        <div id="tabs">
            <ul>
                <li><a href="#tab-video-left">Video left</a></li>
                <li><a href="#tab-day-activities">Day Activities</a></li>
                <li><a href="#tab-activites">Activities Overview</a></li>
                <li><a href="#tab-video-right">Video right</a></li>
                <li><a href="#tab-date">Date</a></li>
            </ul>
            <div id="tab-video-left">
                <?php $this->video_left_tab->get_form($post); ?>
            </div>
            <div id="tab-day-activities">
                <?php $this->day_activities_tab->get_form($post); ?>
            </div>
            <div id="tab-activites">
                <?php $this->activities_tab->get_form($post); ?>
            </div>
            <div id="tab-video-right">
                <?php $this->video_right_tab->get_form($post); ?>
            </div>
            <div id="tab-date">
                <?php $this->date_tab->get_form($post); ?>
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

        $_age = sanitize_text_field($_POST['filter_age']);
        update_post_meta($post_id, '_age', $_age);
        $_price_camp = sanitize_text_field($_POST['_price_camp']);
        update_post_meta($post_id, '_price_camp', $_price_camp);
        $_content_search = ($_POST['_content_search']);
        update_post_meta($post_id, '_content_search', $_content_search);

        $this->video_left_tab->save($post_id);
        $this->day_activities_tab->save($post_id);
        $this->activities_tab->save($post_id);
        $this->video_right_tab->save($post_id);
        $this->date_tab->save($post_id);
    }
}
$campObj = new Camp_Post_type();