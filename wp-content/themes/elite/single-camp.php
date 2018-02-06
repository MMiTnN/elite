<?php
get_header();
if (have_posts()) {
    the_post();
    $post_id = $post->ID;
    $image_id = get_post_thumbnail_id($post_id);
    $image_arr = wp_get_attachment_image_src($image_id, "custom-size-600");
    $image = '';
    if (!empty($image_arr)) {
        $image = $image_arr[0];
    } 
    $_age = get_post_meta($post_id, '_age', true);
    if(!empty($_age)){
        $_age_detail = get_term_by('id', $_age, 'age_taxonomy');
    }
    $_price_camp = get_post_meta($post_id, '_price_camp', true);
    $_date = get_post_meta($post_id, '_date', true);
    ?>
    <section class="header-section" style="background-image: linear-gradient(rgba(0, 0, 0, 0.45),rgba(0, 0, 0, 0.45)), url(<?php echo $image ?>);">
        <div>
            <p class='text-white header-title text-center'><?php echo get_the_title(); ?></p>
        </div>
    </section>

    <section class="download-bro">
        <div class="container-fluid">
            <div class="row">
                <div class="button-down">
                    <div class="col-sm-6  col-xs-12">
                        <a href="<?php echo get_site_url().'/download-pdf?post='.$post_id ?>" class="btn btn-border-gold margin-b-15">Download PDF</a>
                    </div>
                    <div class="col-sm-5 col-xs-12">
                        <a href="" class="btn btn-border-gold margin-b-15">Book now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="date-age">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-xs-12">
                    <div class="block column">
                        <div class="age padding-b-20"> 
                            <span class="glyphicon glyphicon-user"></span>
                            <strong> Age:</strong> <?php echo $_age_detail->name; ?> Years
                        </div>
                        <div class="price"> 
                            <span class="glyphicon glyphicon-tag"></span>
                            <strong> Price:</strong> <?php echo $_price_camp; ?> THB
                        </div>
                    </div>
                </div>   
               <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
                    <div class="block column date">
                         <div class="date"> 
                            <span class="glyphicon glyphicon-calendar"></span>
                            <strong> Dates:</strong> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6 col-sm-9 col-xs-7 flex-row text-around">
                    <?php if (!empty($_date)): 
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
                                $date_time = $_date_start.' '.$_month_start.'-'.$_date_end.' '.$_month_end.' '.$_year_end; 
                           if($_idx==0 || $_idx==3 || $_idx==6 ): ?>
                            <div class="block column">
                            <?php endif; ?>      
                                <h5><?php echo $date_time; ?></h5>
                             <?php if($_idx==2 || $_idx==5 || $_idx==8 ): ?>
                                </div>
                            <?php endif; 
                         endforeach; ?>
                        
                         <?php endif; ?>
                    
                </div>           
            </div>
        </div>
    </section>
    <?php the_content(); ?>    
    <?php related_camps($post_id); ?>
    <?php video_popup(); ?>
<?php

get_footer();

}else {
    //Show 404
}
