<?php
/*
 * Template Name: Contact us
 */
?>
<?php get_header(); 
the_post();
$post_id = get_the_ID();
$image_id = get_post_thumbnail_id($post_id);
$image_arr = wp_get_attachment_image_src($image_id, "custom-size-600");
$image = '';
    if (!empty($image_arr)) {
        $image = $image_arr[0];
    } 
?>

<section class="header-section"  style="background-image: linear-gradient(rgba(0, 0, 0, 0.45),rgba(0, 0, 0, 0.45)), url(<?php echo $image ?>);">
    <div>
        <p class='text-white header-title text-center'><?php echo get_the_title(); ?></p>
    </div>
</section>
<section class="brochure">
        <div class="container">
            <div class="wrapper-download">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <form id="frmDownload" class="frmDownload" name="frmDownload" action="#" method="post">
                         <h1 class="text-center"> Download our brochure </h1>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <p class="color-white download">
                                        <input type="text" placeholder="First name" id="txtFirstName" name="txtFirstName" class="searchbox-input name-client" required>
                                    </p>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <p class="color-white download">
                                        <input type="text" placeholder="Last name" id="txtLastName" name="txtLastName" class="searchbox-input name-client" required>
                                    </p> 
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <p class="color-white download" >
                                        <input type="text" placeholder="Email address" id="txtEmail" name="txtEmail" class="searchbox-input email-client" required> 
                                    </p>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <p class="color-white download select-box" >
                                        <select name="campSelected" id="campSelected" class="select-box">
                                           <?php $query = new WP_Query( array( 
                                                'post_type' => 'camp' ,
                                                'posts_per_page'  => -1,
                                                'post_status' => 'publish',
                                                'orderby' => 'rand'
                                             )); 
                                            $camps_list = $query->posts; ?>
                                            <option value="" >Select camp</option>
                                            <?php foreach ($camps_list as $key => $value) { ?>
                                                <option value="<?php echo $value->ID ?>" ><?php echo $value->post_title ?></option>
                                           <?php } ?>
                                        </select>
                                    </p>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="items-push text-center margin-t-30">
                                <button class="btn btn-primary submit-question" type="submit" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Sending"><?php echo _e('Download now', $domain) ?></button>
                            </div>
                        </div>
                    </form>
               </div>

               <div class="clear"></div>    
             </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>