<?php
/*
  Plugin Name: Contact Form for Elite
  Description: Contact form module for Elite
  Version: 1.0
  Author: Mint Apirada Pumpan
  License: GPLv2
 */

/**
 * PART 1. Defining Custom Database Table
 * ============================================================================
 *
 * In this part you are going to define custom database table,
 * create it, update, and fill with some dummy data
 *
 * http://codex.wordpress.org/Creating_Tables_with_Plugins
 *
 * In case your are developing and want to check plugin use:
 *
 * DROP TABLE IF EXISTS wp_cte;
 * DELETE FROM wp_options WHERE option_name = 'custom_hospitals_install_data';
 *
 * to drop table and option
 */
/**
 * $custom_contact_db_version - holds current database version
 * and used on plugin update to sync database tables
 */
global $contact_db_version;
$contact_db_version = '1.1'; // version changed from 1.0 to 1.1

/**
 * register_activation_hook implementation
 *
 * will be called when user activates plugin first time
 * must create needed database tables
 */
function contact_install() {
    global $wpdb;
    global $contact_db_version;

    $table_name = $wpdb->prefix . 'contact';
    $sql = "CREATE TABLE $table_name (
		          id mediumint(9) NOT NULL AUTO_INCREMENT,
              firstname varchar(100) NOT NULL,
              lastname varchar(100) NOT NULL,
              email varchar(30) NOT NULL,
              phone int(30) NOT NULL,
              message varchar(500) NOT NULL,
              created_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
                PRIMARY KEY (`id`),
		UNIQUE KEY id (id)
	) CHARACTER SET utf8 COLLATE utf8_general_ci;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
    add_option('contact_db_version', $contact_db_version);
}

register_activation_hook(__FILE__, 'contact_install');

/**
 * register_activation_hook implementation
 *
 * [OPTIONAL]
 * additional implementation of register_activation_hook
 * to insert some dummy data
 */

/**
 * Trick to update plugin database, see docs
 */
function contact_update_db_check() {
    global $contact_db_version;
    if (get_option('contact_db_version') != $contact_db_version) {
        contact_install();
    }
}

add_action('plugins_loaded', 'contact_update_db_check');

/**
 * PART 2. Defining Custom Table List
 * ============================================================================
 *
 * In this part you are going to define custom table list class,
 * that will display your database records in nice looking table
 *
 * http://codex.wordpress.org/Class_Reference/WP_List_Table
 * http://wordpress.org/extend/plugins/custom-list-table-example/
 */
if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

/**
 * custom_contact_List_Table class that will display our custom table
 * records in nice table
 */
class contact_List_Table extends WP_List_Table {

    /**
     * [REQUIRED] You must declare constructor and give some basic params
     */
    function __construct() {
        global $status, $page;

        parent::__construct(array(
            'singular' => 'contact',
            'plural' => 'contacts',
        ));
    }

    /**
     * [REQUIRED] this is a default column renderer
     *
     * @param $item - row (key, value array)
     * @param $column_name - string (key)
     * @return HTML
     */
    function column_default($item, $column_name) {
        return $item[$column_name];
    }

    /**
     * [OPTIONAL] this is example, how to render specific column
     *
     * method name must be like this: "column_[column_name]"
     *
     * @param $item - row (key, value array)
     * @return HTML
     */

    /**
     * [OPTIONAL] this is example, how to render column with actions,
     * when you hover row "Edit | Delete" links showed
     *
     * @param $item - row (key, value array)
     * @return HTML
     */
    function column_name($item) {
        // links going to /admin.php?page=[your_plugin_page][&other_params]
        // notice how we used $_REQUEST['page'], so action will be done on curren page
        // also notice how we use $this->_args['singular'] so in this example it will
        // be something like &person=2
        $actions = array(
            'edit' => sprintf('<a href="?page=contact_view&id=%s">%s</a>', $item['id'], 'View')
        );

        return sprintf('%s %s', $item['id'], $this->row_actions($actions)
        );
    }

    /**
     * [REQUIRED] this is how checkbox column renders
     *
     * @param $item - row (key, value array)
     * @return HTML
     */
    function column_cb($item) {
        return sprintf(
                '<input type="checkbox" name="id[]" value="%s" />', $item['id']
        );
    }

    /**
     * [REQUIRED] This method return columns to display in table
     * you can skip columns that you do not want to show
     * like content, or description
     *
     * @return array
     */
    function get_columns() {
        $columns = array(
            'cb' => '<input type="checkbox" />', //Render a checkbox instead of text
            'name' => 'No.',
            'firstname' => 'First name',
            'lastname' => 'Last name',
            'email' => 'Email',
            'phone' => 'Phone',
            'created_at' => 'Date',
        );
        return $columns;
    }

    /**
     * [OPTIONAL] This method return columns that may be used to sort table
     * all strings in array - is column names
     * notice that true on name column means that its default sort
     *
     * @return array
     */
    function get_sortable_columns() {
        $sortable_columns = array(
            'created_at' => array('created_at', true),
            'name' => array('id', true),
            'firstname' => array('firstname', true),
            'lastname' => array('lastname', true),
            'email' => array('email', true)
        );
        return $sortable_columns;
    }

    /**
     * [OPTIONAL] Return array of bult actions if has any
     *
     * @return array
     */
    function get_bulk_actions() {
        if (current_user_can('manage_network')) {
            $actions = array(
                'delete' => 'Delete'
            );
        }
        return $actions;
    }

    /**
     * [OPTIONAL] This method processes bulk actions
     * it can be outside of class
     * it can not use wp_redirect coz there is output already
     * in this example we are processing delete action
     * message about successful deletion will be shown on page in next part
     */
    function process_bulk_action() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'contact'; // do not forget about tables prefix

        if ('delete' === $this->current_action()) {
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids))
                $ids = implode(',', $ids);

            if (!empty($ids)) {
                $wpdb->query("DELETE FROM $table_name WHERE id IN($ids)");
            }
        }
    }

    /**
     * [REQUIRED] This is the most important method
     *
     * It will get rows from database and prepare them to be showed in table
     */
    function prepare_items() {

        global $wpdb;
        $table_name = $wpdb->prefix . 'contact'; // do not forget about tables prefix

        $per_page = 30; // constant, how much records will be shown per page

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();

        // here we configure table headers, defined in our methods
        $this->_column_headers = array($columns, $hidden, $sortable);

        // [OPTIONAL] process bulk action if any
        $this->process_bulk_action();

        // will be used in pagination settings
        $total_items = $wpdb->get_var("SELECT COUNT(id) FROM $table_name");
        // prepare query params, as usual current page, order by and order direction
        $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;
        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'created_at';
        $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'desc';

        // [REQUIRED] define $items array
        // notice that last argument is ARRAY_A, so we will retrieve array
        $this->items = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, $paged), ARRAY_A);

        // [REQUIRED] configure pagination
        $this->set_pagination_args(array(
            'total_items' => $total_items, // total items defined above
            'per_page' => $per_page, // per page constant defined at top of method
            'total_pages' => ceil($total_items / $per_page) // calculate pages count
        ));
    }

}

/**
 * PART 3. Admin page
 * ============================================================================
 *
 * In this part you are going to add admin page for custom table
 *
 * http://codex.wordpress.org/Administration_Menus
 */

/**
 * admin_menu hook implementation, will add pages to list persons and to add new one
 */
function contact_admin_menu() {
    add_menu_page(__('contacts'), __('Contacts'), 'activate_plugins', 'contact', 'contact_form_handler');
    add_submenu_page('contact', __('All Contacts'), __('All Contacts'), 'activate_plugins', 'contact', 'contact_form_handler');
    add_submenu_page('contact', __('View Contacts'), __('View Contacts'), 'activate_plugins', 'contact_view', 'contact_page_view_handler');
    add_submenu_page('contact', __('Settting'), __('Setting'), 'activate_plugins', 'contact_setting', 'custom_contact_setting_page_handler');
}

add_action('admin_menu', 'contact_admin_menu');

/**
 * List page handler
 *
 * This function renders our custom table
 * Notice how we display message about successfull deletion
 * Actualy this is very easy, and you can add as many features
 * as you want.
 *
 * Look into /wp-admin/includes/class-wp-*-list-table.php for examples
 */
function contact_form_handler() {
    global $wpdb;

    $table = new contact_List_Table();
    $table->prepare_items();

    $message = '';
    if ('delete' === $table->current_action()) {
        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d'), count($_REQUEST['id'])) . '</p></div>';
    }
    ?>
    <div class="wrap">
        <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
        <h2><?php _e('contacts') ?></h2>
    <?php echo $message; ?>

        <form id="inquiry-table" method="GET">
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
    <?php $table->display() ?>
        </form>
    </div>
    <?php
}

/**
 * PART 4. Form for adding andor editing row
 * ============================================================================
 *
 * In this part you are going to add admin page for adding andor editing items
 * You cant put all form into this function, but in this example form will
 * be placed into meta box, and if you want you can split your form into
 * as many meta boxes as you want
 *
 * http://codex.wordpress.org/Data_Validation
 * http://codex.wordpress.org/Function_Reference/selected
 */

/**
 * Form page handler checks is there some data posted and tries to save it
 * Also it renders basic wrapper in which we are callin meta box render
 */
function contact_page_view_handler() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'contact'; // do not forget about tables prefix

    $message = '';
    $notice = '';

    // this is default $item which will be used for new records
    $default = array(
        'id' => 0,
    );

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        $id = null;
    }

    $birthday = '';
    $item = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id", OBJECT);
    ?>
    <div class="wrap">
        <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
        <h2>
    <?php _e('Contact View') ?>
            <a class="add-new-h2" href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=contact'); ?>"><?php _e('back to list') ?></a>
        </h2>

    <?php if (!empty($notice)): ?>
            <div id="notice" class="error"><p><?php echo $notice ?></p></div>
    <?php endif; ?>
    <?php if (!empty($message)): ?>
            <div id="message" class="updated"><p><?php echo $message ?></p></div>
    <?php endif; ?>
    </div>
    <hr style="margin:25px 0;">
    <style>
        td {
            padding:15px 0 5px;
        }
    </style>
    <div style="background:#fff;padding:25px;margin-right:25px;">
    <?php if ($id != null): ?>
            <table>
                <tr>
                    <td colspan="5">
                        <h2 style="margin-bottom:5px;">Contact No. &nbsp;&nbsp;&nbsp; <?php echo $id; ?></h2>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h2>Details</h2>
                    </td>
                </tr>
                <tr>
                    <td width="170px" style="font-weight:bold;">Fullname</td>
                    <td width="330px" style="border-bottom:1px dotted #ccc;"><?php echo  $item->firstname . ' ' . $item->lastname ?></td>
                </tr>
                <tr>
                    <td style="font-weight:bold;">Phone</td>
                    <td style="border-bottom:1px dotted #ccc;"><?php echo $item->phone ?></td>
                </tr>
                <tr>
                    <td style="font-weight:bold;">Email</td>
                    <td style="border-bottom:1px dotted #ccc;"><?php echo $item->email ?></td>
                </tr>
                <tr>
                    <td style="font-weight:bold;">Message</td>
                    <td style="border-bottom:1px dotted #ccc;"><?php echo $item->message ?></td>
                </tr>
            </table>
            <br><br>
    <?php else: ?>
            <p style="text-align:center;">Please select contact form<a class="add-new-h2" href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=contact'); ?>"><?php _e('contact list') ?></a></p>
    <?php endif; ?>
    </div>

    <?php
}

add_action('admin_init', 'contact_register_settings');

function contact_register_settings() {
    register_setting('contact_register_settings', 'contact_register_settings', 'extra_post_contact_settings_validate');
}

function extra_post_contact_settings_validate($args) {

    if (!isset($args['main_email']) || !is_email($args['main_email'])) {
        //add a settings error because the email is invalid and make the form field blank, so that the user can enter again
        // $args['main_email'] = '';
        add_settings_error('contact_register_settings', 'main_email_invalid_email', 'Please enter a valid email!', $type = 'error');
    }

    //make sure you return the args
    return $args;
}

//Display the validation errors and update messages
/*
 * Admin notices
 */

function custom_contact_setting_page_handler() {
    global $wpdb;
    $options = get_option('contact_register_settings');
    ?>
    <div class="wrap">
        <h1>Contact Setting</h1>

        <form method="post" action="options.php">
    <?php settings_fields('contact_register_settings'); ?>
    <?php do_settings_sections('contact_register_settings'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Notification email:</th>
                    <td><input type="text" size="40" name="contact_register_settings[main_email]" value="<?php echo (isset($options['main_email']) && $options['main_email'] != '') ? $options['main_email'] : ''; ?>"/></td>
                </tr>
            </table>
    <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
