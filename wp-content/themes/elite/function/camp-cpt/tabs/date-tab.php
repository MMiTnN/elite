<?php

class Date_tab {

    function get_form($post) {

        $post_id = $post->ID;
        $_date = get_post_meta($post_id, '_date', true);
        ?>
        <style>
            #date_inputs{display: none;}
        </style>
        <button type="button" class="button" onclick="add_new_day();">Add Date</button>
        <table class="form-table" id="date-container" width="100%"  data-inputrows="<?php echo empty($_date) ? 0 : count($_date) ?>">
            <tbody>
                <?php if (!empty($_date)): ?>
                    <?php foreach ($_date as $_idx => $_p): ?>
                        <?php $this->date_input($_idx,$_p) ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <div id="date_inputs">
            <table>
                <?php 
                    echo $this->date_input('temp');
                 ?>
            </table>            
        </div>
        <script   src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"   integrity="sha256-xI/qyl9vpwWFOXz7+x/9WkG5j/SVnSw21viy8fWwbeE="   crossorigin="anonymous"></script>
        <script type="text/javascript">
             var $ = jQuery;
            $(document).ready(function(){
                $('table#date-container tbody .datepicker').datepicker({
                    dateFormat: "yy-mm-dd",
                    changeMonth: true,
                    changeYear: true
                });
            });
            function add_new_day() {
                var html = jQuery('#date_inputs').find("tr").clone();
                var idx = jQuery('#date-container').data('inputrows');
                idx = parseInt(idx);
                jQuery('#date-container').data('inputrows', (idx + 1));
                jQuery(html).each(function (i, v) {
                    if(i > 0){
                        $(v).removeClass('date_itemtemp');
                        $(v).addClass('date_item'+idx);
                        $(v).find('input').attr('name', '_date[' + idx + '][date_end]');
                        $(v).find('a').data('inputrows', idx );
                    }else{
                        $(v).removeClass('date_itemtemp');
                        $(v).addClass('date_item'+idx);                        
                        $(v).find('input').attr('name', '_date[' + idx + '][date_start]');
                    }
                });
                html.find('.datepicker').removeClass("hasDatepicker");
                jQuery("table#date-container tbody").append(html);
                jQuery('table#date-container tbody .datepicker').datepicker({
                    dateFormat: "yy-mm-dd",
                    changeMonth: true,
                    changeYear: true
                });

            }

            function remove_tr(elm){
                if( confirm("Please confirm") ){
                    var index = $(elm).data('inputrows');
                    jQuery(elm).parent().parent().parent().find('.date_item'+index).remove();
                }
            }
        </script>
        <?php
    }

    function save($post_id) {
        $_date = '';

        if (isset($_POST['_date'])) {
            $_p = $_POST['_date'];
            foreach ($_p as $p) {
                 if(!empty($p['date_start']) && !empty($p['date_end']) ){
                    $_date[] = array(
                        'date_start' => sanitize_text_field($p['date_start']),
                        'date_end' => sanitize_text_field($p['date_end']),
                    );
                }
            }
        }
        update_post_meta($post_id, '_date', $_date);
    }

    function date_input($_idx, $arr = array()) {
        $defaults = array(
            'date_start' => '',
            'date_end' => '',
        );
        $data = wp_parse_args($arr, $defaults);
        ?>
        <tr class="date_item<?php echo $_idx; ?>">
            <td><?php _e('Start Date')?></td>
            <td><input type="text"  name="_date[<?php echo $_idx; ?>][date_start]" value="<?php echo $data['date_start'] ?>" class="datepicker" /></td>
        </tr>
        <tr class="date_item<?php echo $_idx; ?>">
            <td><?php _e('End Date')?></td>
            <td><input type="text"  name="_date[<?php echo $_idx; ?>][date_end]" value="<?php echo $data['date_end'] ?>" class="datepicker" /></td>
            <td>
                <a href="#" data-inputrows="<?php echo $_idx; ?>" onclick="remove_tr(this);return false"><img src="<?php echo get_template_directory_uri()?>/images/delete-24.png"></a>
            </td>
        </tr>
        
        <?php
    }

}