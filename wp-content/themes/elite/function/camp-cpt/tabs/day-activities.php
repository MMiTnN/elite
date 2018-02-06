<?php

class Day_activities_tab {

    function get_form($post) {

        $post_id = $post->ID;
        $_day_activities = get_post_meta($post_id, '_day_activities', true);
        ?>
        <style>
            #_day_activities_inputs{display: none;}
        </style>
        <button type="button" class="button" onclick="add_new_day();">Add New</button>
        <table class="form-table" id="day-activities-container" width="100%"  data-inputrows="<?php echo empty($_day_activities) ? 0 : count($_day_activities) ?>">
            <tbody>
                <tr>
                    <th scope="row">
                        <label >Short code</label>
                    </th>

                    <td>
                        <p>
                            [day_act_component id='<?php echo $post_id ?>']
                        </p>
                    </td>
                </tr>
                <?php if (!empty($_day_activities)): ?>
                    <?php foreach ($_day_activities as $_idx => $_p): ?>
                        <?php $this->day_activities_input($_idx,$_p) ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div id="_day_activities_inputs">
            <table>
                <?php 
                    echo $this->day_activities_input('temp');
                 ?>
            </table>            
        </div>
        <script type="text/javascript">
            function add_new_day() {
                var html = jQuery('#_day_activities_inputs').find("tr").clone();
                var idx = jQuery('#day-activities-container').data('inputrows');
                idx = parseInt(idx);
                jQuery('#day-activities-container').data('inputrows', (idx + 1));
                jQuery(html).each(function (i, v) {
                    if(i > 0){
                        $(v).addClass('_day_activities_item'+idx);
                        $(v).find('textarea').attr('name', '_day_activities[' + idx + '][detail]');
                        $(v).find('textarea').attr('id', '_day_activities_' + idx);
                    }else{
                        $(v).addClass('_day_activities_item'+idx);
                        $(v).find('a').data('inputrows', idx );
                        $(v).find('input').attr('name', '_day_activities[' + idx + '][day]');
                    }
                });
                jQuery("table#day-activities-container tbody").append(html);
            }

            function remove_tr(elm){
                if( confirm("Please confirm") ){
                    var index = $(elm).data('inputrows');
                    jQuery(elm).parent().parent().parent().find('._day_activities_item'+index).remove();
                }
            }
        </script>
        <?php
    }

    function save($post_id) {
        $activities = '';

        if (isset($_POST['_day_activities'])) {
            $_p = $_POST['_day_activities'];
            foreach ($_p as $p) {
                 if(!empty($p['day']) && !empty($p['detail']) ){
                    $activities[] = array(
                        'day' => sanitize_text_field($p['day']),
                        'detail' => sanitize_text_field($p['detail']),
                    );
                }
            }
        }
        update_post_meta($post_id, '_day_activities', $activities);
    }

    function day_activities_input($_idx, $arr = array()) {
        $defaults = array(
            'day' => '',
            'detail' => '',
        );
        $data = wp_parse_args($arr, $defaults);
        ?>
        <tr class="_day_activities_item<?php echo $_idx; ?>">
            <th scope="row">
                <label >Day</label>
            </th>

            <td>
                <p>
                    <input type="text" name='_day_activities[<?php echo $_idx; ?>][day]' class="widefat" value="<?php echo $data['day'] ?>">
                </p>
            </td>
            <td>
                <a href="#" data-inputrows="<?php echo $_idx; ?>" onclick="remove_tr(this);return false"><img src="<?php echo get_template_directory_uri()?>/images/delete-24.png"></a>
            </td>
        </tr>
        <tr class="_day_activities_item<?php echo $_idx; ?>">
            <th scope="row">
                <label >Detail </label>
            </th>

            <td>
                <?php wp_editor($data['detail'], '_day_activities_'.$_idx, array( 'textarea_name' => '_day_activities['.$_idx.'][detail]', 'editor_height' => '300','media_buttons'=>false)) ?>
            </td>
        </tr>
        
        <?php
    }

}