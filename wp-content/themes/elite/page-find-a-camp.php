<?php
get_header();
the_post();
$post_id = get_the_ID();
$image_id = get_post_thumbnail_id($post_id);
$image_arr = wp_get_attachment_image_src($image_id, "custom-size-600");
$image = '';
    if (!empty($image_arr)) {
        $image = $image_arr[0];
    } 

$activities = get_taxonomy_list('activities_taxonomy');
$age = get_taxonomy_list('age_taxonomy');
$filter_age = '';
$filter_activity = '';
$filter_date = '';
if(isset($_GET['filter_age'])){
    $filter_age = $_GET['filter_age'];
} 
if(isset($_GET['filter_activity'])){
    $filter_activity = $_GET['filter_activity'];
}
if(isset($_GET['filter_date'])){
    $filter_date = $_GET['filter_date'];
}

 $args = array( 
    'post_type' => 'camp' ,
    'posts_per_page'  => -1,
    'post_status' => 'publish',
    'meta_key'     => '_date',

 ); 
  $query_camp = new WP_Query($args);

?>
<section class="header-section"  style="background-image: linear-gradient(rgba(0, 0, 0, 0.45),rgba(0, 0, 0, 0.45)), url(<?php echo $image ?>);">
    <div>
        <p class='text-white header-title text-center'>Find a camp</p>
    </div>
</section> 

<section class="search-result">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-xs-12 search">
                <div class="block black">
                    <h4>Select dates</h4>
                    <div class="select-box dropdown">
                         <select name="filter_date" id="filter_date" class="chosen">
                         <option value="">All period</option>
                        <?php foreach ($query_camp->posts as $key => $value) { 
                            $post_id = $value->ID;
                            $_date = get_post_meta($post_id, '_date', true);
                            foreach ($_date as $_idx => $_p): 
                                $date = new DateTime();
                                $month_now = $date->format('m');
                                $year  = $date->format('Y');
                                $_date_start = date("d", strtotime($_p['date_start']));
                                $_date_end = date("d", strtotime($_p['date_end']));
                                $_month_start = date("M", strtotime($_p['date_start']));
                                $_month_end = date("M", strtotime($_p['date_end']));
                                $_year_end = date("Y", strtotime($_p['date_end']));
                                if($_month_end == $_month_start)
                                    $date_time = $_date_start.'-'.$_date_end.' '.$_month_end.' '.$_year_end; 
                                else
                                    $date_time = $_date_start.' '.$_month_start.'-'.$_date_end.' '.$_month_end.' '.$_year_end; ?>
                                <option value="<?php echo $post_id; ?>"><?php echo $date_time; ?></option>
                         <?php endforeach; 
                         } ?>
                    </select>
                    </div>
                </div>
                <div class="block black">
                    <h4>Select age range</h4>
                    <div class="select-box multiple">
                        <?php foreach ($age as $key => $value) {?>
                         <label class="checkbox-inline"><?php echo $value->name ?> years
                          <input type="checkbox" name="age_child" <?php if($value->term_id == $filter_age) echo checked; ?> value="<?php echo $value->term_id ?>" > 
                          <span class="checkmark"></span>
                        </label>
                       <?php  } ?>
                    </div>
                </div>
                <div class="block black">
                    <h4>Select camp type</h4>
                    <div class="select-box multiple">
                        <?php foreach($activities as $key => $act): ?>
                        <label class="checkbox-inline"><?php echo $act->name; ?>
                          <input type="radio" name="acttype" <?php if($act->term_id == $filter_activity) echo checked; ?> value="<?php echo $act->term_id ?>">
                          <span class="checkmark circle"></span>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-xs-12 search camp-item" id="result-search-camp">
                <?php get_ajax_camps($filter_activity, $filter_age, $filter_date); ?>       
            </div>

        </div>
    </div>
</section>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('.chosen').chosen();

        var $select_age = $('input[name="age_child"]');
        var $select_act = $('input[name="acttype"]');
        var $select_date = $('select[name="filter_date"]');
         $select_age.on('change', function() {
            $select_age.not(this).prop('checked', false);  
        });
         
         console.log('mint');
        /* Onchange age */       
        $select_age.on('change',function () {
            get_list();
        });

        /* Onchange activity */       
        $select_act.on('change',function () {
            get_list();
        });

        /* Onchange date */       
        $select_date.on('change',function () {
            get_list();
        });

        function get_list(){
            var _age = $('input[name="age_child"]:checked').val();
            var _act = $('input[name="acttype"]:checked').val();
            var _date = $('select[name="filter_date"]').val();
            $.ajax({
                type: 'GET',
                url: "<?php echo admin_url('admin-ajax.php') ?>",
                data: {action: 'get_ajax_camps', filter_age: _age, filter_activity: _act, filter_date: _date},
                dataType: 'json',
                complete: function (data) {
                    // Handle the complete event
                    if(data.responseText !== ''){
                        $('#result-search-camp .item-camp').remove();
                        $('#result-search-camp').append(data.responseText);
                        $('#result-search-camp h1').remove();
                        var list_camp = $('.camp-item .item-camp'); 
                        $.each(list_camp, function(i, v){
                            var left_block = $(v).find('.left').height();
                            var right_block = $(v).find('.right').height();
                            if(left_block > right_block){
                                $(v).find('.right .block').css('height', left_block);
                            }else{
                                $(v).find('.left .block').css('height', right_block);
                            }
                        });
                    }else{
                        $('#result-search-camp h1').remove();
                        $('#result-search-camp .item-camp').remove();
                        $('#result-search-camp').append('<h1>Sorry your result not found.</h1>');
                    }                   
                }
            })
        }
    });
</script>
<?php get_footer(); ?>
