<?php

class Condition_tab {

    function get_form($post) {

        $post_id = $post->ID;
        $_conditions = get_post_meta($post_id, '_conditions', true);
        ?>
        <style>
            #_conditions_inputs{display: none;}
        </style>
        <button type="button" class="button" onclick="add_new_day();">Add New</button>
        <table class="form-table" id="conditions-container" width="100%"  data-inputrows="<?php echo empty($_conditions) ? 0 : count($_conditions) ?>">
            <tbody>
                <?php if (!empty($_conditions)): ?>
                    <?php foreach ($_conditions as $_idx => $_p): ?>
                        <?php $this->conditions_input($_idx,$_p) ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div id="_conditions_inputs">
            <table>
                <?php 
                    echo $this->conditions_input('temp');
                 ?>
            </table>            
        </div>
        <script type="text/javascript">
            function add_new_day() {
                var html = jQuery('#_conditions_inputs').find("tr").clone();
                var idx = jQuery('#conditions-container').data('inputrows');
                idx = parseInt(idx);
                jQuery('#conditions-container').data('inputrows', (idx + 1));
                jQuery(html).each(function (i, v) {
                    if(i > 0){
                        $(v).addClass('_conditions_item'+idx);
                        $(v).find('textarea').attr('name', '_conditions[' + idx + '][detail]');
                        $(v).find('textarea').attr('id', '_conditions_' + idx);
                    }else{
                        $(v).addClass('_conditions_item'+idx);
                        $(v).find('a').data('inputrows', idx );
                        $(v).find('input').attr('name', '_conditions[' + idx + '][title]');
                    }
                });
                jQuery("table#conditions-container tbody").append(html);
            }

            function remove_tr(elm){
                if( confirm("Please confirm") ){
                    var index = $(elm).data('inputrows');
                    jQuery(elm).parent().parent().parent().find('._conditions_item'+index).remove();
                }
            }
        </script>
        <?php
    }

    function save($post_id) {
        $activities = '';

        if (isset($_POST['_conditions'])) {
            $_p = $_POST['_conditions'];
            foreach ($_p as $p) {
                 if(!empty($p['title']) && !empty($p['detail']) ){
                    $activities[] = array(
                        'title' => sanitize_text_field($p['title']),
                        'detail' => sanitize_text_field($p['detail']),
                    );
                }
            }
        }
        update_post_meta($post_id, '_conditions', $activities);
    }

    function conditions_input($_idx, $arr = array()) {
        $defaults = array(
            'title' => '',
            'detail' => '',
        );
        $data = wp_parse_args($arr, $defaults);
        ?>
        <tr class="_conditions_item<?php echo $_idx; ?>">
            <th scope="row">
                <label >Title</label>
            </th>

            <td>
                <p>
                    <input type="text" name='_conditions[<?php echo $_idx; ?>][title]' class="widefat" value="<?php echo $data['title'] ?>">
                </p>
            </td>
            <td>
                <a href="#" data-inputrows="<?php echo $_idx; ?>" onclick="remove_tr(this);return false"><img src="<?php echo get_template_directory_uri()?>/images/delete-24.png"></a>
            </td>
        </tr>
        <tr class="_conditions_item<?php echo $_idx; ?>">
            <th scope="row">
                <label >Detail </label>
            </th>

            <td>
                <?php wp_editor($data['detail'], '_conditions_'.$_idx, array( 'textarea_name' => '_conditions['.$_idx.'][detail]', 'editor_height' => '300','media_buttons'=>false)) ?>
            </td>
        </tr>
        
        <?php
    }

}