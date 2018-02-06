<?php
class Acitities_tab {
	function get_form($post){
        $post_id = $post->ID;
        $_activities =  get_post_meta( $post_id , '_order_idx_activities');
        ?>
       
        <style>
            .sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
            .sortable li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; height: 1.5em; }
            html>body .sortable li { height: 1.5em; line-height: 1.2em; background-color: #DCDCDC}
            .ui-state-highlight { height: 1.5em; line-height: 1.2em; }
            .ui-state-default{ position:relative; }
            .remove_item{ position: absolute; right: 5px; cursor: pointer; }
        </style>
        <p><?php echo 'Short code' ?>: [activities_component id='<?php echo $post_id ?>'] </p>
        <p><?php echo 'Search for Activities' ?>: <input type="text" name="_activities" id="_activities" style="width:300px"></p>
        <p class="description">Drag item to change order position</p>
        <ul class="sortable" id="sortable_activities" name="sortable_activities[]" data-rows="<?php echo empty($items_activities) ? 0 : count($items_activities) ?>">
            <?php
            if(!empty($_activities[0])):
                foreach ($_activities[0] as $activity):
                    $item = get_term_by('id', $activity, 'activities_taxonomy');
                        if($activity == $item->term_id):
                            ?>
                            <li class="ui-state-default"> 
                                <input type='hidden' name='_activities_id[]' class='_activities_id' value='<?php echo $item->term_id ?>' > <?php echo $item->name ?> 
                                <span class='remove_item activities dashicons dashicons-trash'></span>
                            </li>
                            <?php
                        endif;
                endforeach;
            endif;
            ?>
        </ul>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {

                $(document).on('click', '.remove_item', function () {
                    if (confirm('Please Confirm')) {
                        $(this).parent('li').remove();
                    }

                });
                
                $('#_activities').autocomplete({
                    source: function (request, response) {
                        var $_activities_list = [];
                        if ($('._activities_id').length) {
                            $('._activities_id').each(function (idx, elm) {
                                $_activities_list.push(parseInt($(elm).val()));
                            })
                        }
                        $.ajax({
                            type: 'POST',
                            url: "<?php echo admin_url('admin-ajax.php') ?>",
                            dataType: "json",
                            data: {
                                action: 'activities_search_autocomplete',
                                _activities: request.term,
                                _activities_list: $_activities_list,
                            },
                            success: function (data) {
                                response(data);
                            }
                        });
                    },
                    minLength: 0,
                    select: function (event, ui) {
                        $(this).val("").blur();
                        var idx = $('#sortable_activities').data('rows');
                        idx = parseInt(idx);
                        $('#_activities_id').data('rows', (idx + 1));

                        var itemHTML = "<li class=\"ui-state-default\"> <input type='hidden' name='_activities_id[]' class='_activities_id' value='" + ui.item.id + "' > " +
                                ui.item.value + " <span class='remove_item activities dashicons dashicons-trash'></span></li>";
                        $("#sortable_activities").append(itemHTML);
                        return false;
                    }
                }).focus(function () {
                    if (this.value == "") {
                        $(this).autocomplete("search");
                    }
                });

                $("#sortable_activities").sortable({
                    placeholder: "ui-state-highlight",
                });
            });

        </script>
        <?php
	}
    
    public static function activities_autocomplete_callback() {
        global $wpdb;
        $keyword = $_POST['_activities'];
        $q = $_POST['_activities_id'];
        $_posts_list = isset($_POST['_activities_list']) ? $_POST['_activities_list'] : array();
        $term_tax_table = $wpdb->prefix . "term_taxonomy";
        $term_table = $wpdb->prefix . "terms";

        $sql_string = "SELECT * FROM {$term_tax_table} JOIN {$term_table} ON {$term_tax_table}.`term_id` = {$term_table}.`term_id` WHERE {$term_tax_table}.`taxonomy` = 'activities_taxonomy'";

        if(!empty($_posts_list)){
            foreach($_posts_list as $p){
             $sql_string .= " AND {$term_tax_table}.`term_taxonomy_id` NOT IN ({$p})";
            }
        }

        if (!empty($keyword)) {
             if (trim($keyword)) {
                $key = trim($keyword);
                $sql_string .= " AND LCASE({$term_table}.`name`) LIKE '%{$key}%'";
            }
        }

        $activities = $wpdb->get_results($sql_string, OBJECT);

        $json = array();
        if (!empty($activities)) {
            foreach ($activities as $value) {
                $json[] = array('id' => $value->term_id, 'value' => $value->name);
            }
        }

        wp_send_json($json);
        exit;
    }

    
    function save($post_id){
        //upadate activities
        delete_post_meta($post_id, '_order_idx_activities');
        add_post_meta($post_id, '_order_idx_activities', $_POST['_activities_id']);
    }

}