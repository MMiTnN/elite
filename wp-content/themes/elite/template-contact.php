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
<section class="map">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-xs-12">
               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.81046767872!2d100.53915021483023!3d13.72992189036165!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29f26ed4bb01b%3A0xac01b20801f96936!2sLumphini+Park!5e0!3m2!1sen!2sth!4v1517847145084" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <div class="col-sm-6 col-xs-12">
                <div class="block content">
                    <?php echo get_the_content(); ?>
                </div>
            </div>
            
        </div>
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
                                    <p class="color-white download" >
                                        <input type="text" placeholder="Phone" id="txtPhone" name="txtPhone" class="searchbox-input phone-client" required> 
                                    </p>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <p class="color-white textqa">
                                        <textarea placeholder="Ask a question" id="txtQA" name="txtQA" class="searchbox-input qa-client" required></textarea> 
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
    <script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/jquery.validate.js"></script>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
       $(function () {
            var formbro = $('#frmDownload').validate({
            rules: {
                txtFirstName: {required: true},
                txtLastName: {required: true},
                txtEmail: {required: true, email: true},
                txtPhone: {required: true},
                txtQA: {required: true}
            },
            highlight: function (element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            messages: {
                txtFirstName: 'Please enter your first name',
                txtLastName: 'Please enter your last name',
                txtEmail: 'Please enter a valid email address',
                txtPhone: 'Please enter your phone number',
                txtQA: 'Please enter your question'
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function (error, element) {
                if (element.prop("id") === 'txtFirstName') {
                    element.parents(".form-group").find(".help-block").append(error);
                } else if (element.prop("id") === 'txtLastName') {
                    element.parents(".form-group").find(".help-block").append(error);
                } else if (element.prop("id") === 'txtEmail') {
                    element.parents(".form-group").find(".help-block").append(error);
                }  else if (element.prop("id") === 'txtPhone') {
                    element.parents(".form-group").find(".help-block").append(error);
                }   else if (element.prop("id") === 'txtQA') {
                    element.parents(".form-group").find(".help-block").append(error);
                }  
            },
              /*submitHandler: function (frm) {
                    var data = $(frm).serialize();
                    data += "&action=send_brochure&_ajax_nonce=<?php echo wp_create_nonce( "send-contact-nonce" ); ?>"
                    var submitButton = $(frm).find(".submit-question");
                    submitButton.button('loading');
                    $.ajax({
                        type: 'POST',
                        data: data,
                        url: '<?php echo admin_url('admin-ajax.php')?>',
                        success: function (result, frm) {
                            submitButton.button('reset');
                           $('#confirmModal').modal('show');
                           $('#txtFirstName').val('');
                           $('#txtLastName').val('');
                           $('#txtEmail').val('');
                           $('#txtPhone').val('');
                        }
                    });
                }*/
            });
        });
    });
    
</script>

<?php get_footer(); ?>