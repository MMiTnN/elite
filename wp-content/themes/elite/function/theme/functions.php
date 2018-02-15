<?php
function video_component($atts){
    $post_id = $atts['id'];
    $_left = $atts['left'];
    $css_pull = '';
    $css_push = '';
    if($_left == 'true'){
        $_position = 'left';
    }else{
        $_position = 'right';
        $css_pull = 'col-sm-pull-6';
        $css_push = 'col-sm-push-6';
    }
    $_video = get_post_meta($post_id, '_video_'.$_position, true);
    $_video_title = '';
    $_video_content = '';
    $_video_link = '';
    $your_img_id = '';
    if (!empty($_video[0])) {
        $_video_title = $_video[0]['_video_'.$_position.'_title'];
        $_video_content = $_video[0]['_video_'.$_position.'_content'];
        $url = $_video[0]['_video_'.$_position.'_link'];
        $your_img_id = $_video[0]['_video_'.$_position.'_img'];
        $your_img_src = wp_get_attachment_image_src($your_img_id, 'full');
        $you_have_img = is_array($your_img_src);
        if(!empty(parse_url($url)['host'])){
            if (parse_url($url)['host'] == 'youtu.be') {
                $_video_link = substr(parse_url($url, PHP_URL_PATH), 1);
            } else {
                parse_str(parse_url($url, PHP_URL_QUERY), $_videourl);
                $_video_link = $_videourl['v'];
            }
        }else{
            $_video_link = $_video[0]['_video_'.$_position.'_link'];
        }
    }
    ?>
    <section class="block-about">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 col-xs-12 <?php echo $css_push; ?> img-about" style="<?php echo trim($your_img_src[0]) ? "background-image:url($your_img_src[0])" : "" ?>">
                    <?php if(!empty($_video_link)): ?>
                    <span  data-embed='<?php echo $_video_link; ?>' class="play-video trigger-overlay"></span>
                    <?php endif; ?>
                </div>
                <div class="col-sm-6 col-xs-12 <?php echo $css_pull; ?> ">
                    <div class="block-about-content">
                        <div class="title-about">
                            <h2><?php echo $_video_title; ?></h2>
                        </div>
                        <div class="content-about">
                           <p> <?php echo $_video_content; ?> </p>

                        </div>
                        <?php if(!empty($_video_link)): ?>
                         <a href="javascript:void(0)" data-embed='<?php echo $_video_link; ?>' class="btn btn-border-gold margin-b-15 trigger-overlay">watch camp video <span class="glyphicon glyphicon-triangle-right"></span></a>
                         <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
}
add_shortcode( 'video_component', 'video_component' );

function video_popup(){ ?>
     <div class="overlay-t overlay-hugeinc display-none close">
        <button type="button" class="overlay-close">Close</button>
        <h4 class="margin-top-70 color-white"></h4>
        <div class="col-md-12 col-sm-12">
            <div class="video-container">
                <!--<div data-configid="0/35473455" style="width:650px; height:455px;" class="issuuembed"></div>
                <script type="text/javascript" src="//e.issuu.com/embed.js" async="true"></script> -->
                <iframe class="video" type="text/html" width="1920" height="1080" src="" frameborder="0" allowfullscreen ></iframe>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        function set_height_img(){
            if($( this ).width() > 750) {
                var block_img = $('.block-about .img-about').height()+30;
                var block_content = $('.block-about .block-about-content').parent().height()+30;
                if(block_img < block_content){
                    $('.img-about').css('height',block_content);
                }
            }
            
        }
        set_height_img();
        $( window ).resize(function() {
            set_height_img();
        });
            // Video Control
        $(".trigger-overlay").click(function () {
                var vid = $(this).attr('data-embed');
                $('.video').attr('src', 'https://www.youtube.com/embed/' + vid + '?vq=hd1080&amp;rel=0&amp;showinfo=0&amp;autoplay=1');
                toggleOverlay();
        });
        $('.overlay-close').click(function () {
             $('.video').attr('src', '');
        });

        
        var triggerBttn = document.getElementsByClassName('trigger-overlay'),
                overlay = document.querySelector('div.overlay-t'),
                closeBttn = overlay.querySelector('button.overlay-close');
        transEndEventNames = {
        'WebkitTransition': 'webkitTransitionEnd',
                'MozTransition': 'transitionend',
                'OTransition': 'oTransitionEnd',
                'msTransition': 'MSTransitionEnd',
                'transition': 'transitionend'
        },
                transEndEventName = transEndEventNames[ Modernizr.prefixed('transition') ],
                support = {transitions: Modernizr.csstransitions};
        function toggleOverlay() {
                if (classie.has(overlay, 'open')) {
                    classie.remove(overlay, 'open');
                    classie.add(overlay, 'close');
                    classie.remove(overlay, 'overlay');
                    classie.add(overlay, 'display-none');
                var onEndTransitionFn = function (ev) {
                if (support.transitions) {
                    if (ev.propertyName !== 'visibility')
                        return;
                        this.removeEventListener(transEndEventName, onEndTransitionFn);
                    }
                        classie.add(overlay, 'close');
                        classie.remove(overlay, 'overlay');
                        classie.add(overlay, 'display-none');
                     };
                        if (support.transitions) {
                            overlay.addEventListener(transEndEventName, onEndTransitionFn);
                        } else {
                            onEndTransitionFn();
                        }
                    } else if (classie.has(overlay, 'close')) {
                        classie.add(overlay, 'open');
                        classie.add(overlay, 'overlay');
                        classie.remove(overlay, 'display-none');
                    }
                }

            closeBttn.addEventListener('click', toggleOverlay);
    });
</script>
<?php 
}

function contact_form(){
    ?>
    <section class="contact contact-page" >
        <div class="container">
            <div class="wrapper-download">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <form id="frmContact" class="frmContact" name="frmContact" action="#" method="post">
                         <h1 class="text-center" style="margin-bottom: 30px; color: #fff"> <?php _e('ติดต่อ', 'elite'); ?> </h1>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <p class="color-white download">
                                        <input type="text" placeholder="<?php _e('ชื่อจริง', 'elite'); ?>" id="txtFirstName" name="txtFirstName" class="searchbox-input name-client" required>
                                    </p>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <p class="color-white download">
                                        <input type="text" placeholder="<?php _e('นามสกุล', 'elite'); ?>" id="txtLastName" name="txtLastName" class="searchbox-input name-client" required>
                                    </p> 
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <p class="color-white download" >
                                        <input type="text" placeholder="<?php _e('อีเมล', 'elite'); ?>" id="txtEmail" name="txtEmail" class="searchbox-input email-client" required> 
                                    </p>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <p class="color-white download" >
                                        <input type="text" placeholder="<?php _e('เบอร์โทรศัพท์', 'elite'); ?>" id="txtPhone" name="txtPhone" class="searchbox-input phone-client" required> 
                                    </p>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <p class="color-white textqa">
                                        <textarea placeholder="<?php _e('ข้อความ', 'elite'); ?>" id="txtQA" name="txtQA" class="searchbox-input qa-client" required></textarea> 
                                    </p>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="items-push text-center margin-t-30">
                                <button class="btn btn-primary submit-question" type="submit" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Sending"><?php echo _e('ส่ง', 'elite') ?></button>
                            </div>
                        </div>
                    </form>
               </div>

               <div class="clear"></div>    
             </div>
            </div>
        </div>
    </section>
         <!-- Confirm Modal -->
    <div id="confirmModal" class="modal fade" tabindex="-1" role="dialog" style="z-index: 99999">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title"><?php  _e('ขอขอบคุณที่ติดต่อกับเรา', 'elite') ?></h5>
                </div>
                <div class="modal-body">
                    <p><?php _e('ข้อความของคุณถูกส่งเรียบร้อบแล้ว', 'elite') ?></p>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/jquery.validate.js"></script>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
       $(function () {
            var formbro = $('#frmContact').validate({
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
                txtFirstName: '<?php _e('กรุณาใส่ชื่อจริงของคุณ','elite') ?>',
                txtLastName: '<?php _e('กรุณาใส่นามสกุลของคุณ','elite') ?>',
                txtEmail: '<?php _e('กรุณาใส่อีเมลของคุณ','elite') ?>',
                txtPhone: '<?php _e('กรุณาใส่เบอร์โทรศัพท์ของคุณ','elite') ?>',
                txtQA: '<?php _e('กรุณาใส่ข้อความของคุณ','elite') ?>'
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
              submitHandler: function (frm) {
                    var data = $(frm).serialize();
                    data += "&action=send_contact&_ajax_nonce=<?php echo wp_create_nonce( "send-contact-nonce" ); ?>"
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
                           $('#txtQA').val('');
                        }
                    });
                }
            });
        });
    });
    
</script>
<?php
}

function activities_component($atts){
    $post_id = $atts['id'];
    $_activities =  get_post_meta( $post_id , '_order_idx_activities');
    if(!empty($_activities[0])):
    ?>
    <section class="activity-icon">
        <div class="container-fluid">
            <div class="flex-column">
                 <div class="title">
                    <h2>Activities overview</h2>
                </div>
               
                <div class="flex-row">
                     <?php
                    foreach ($_activities[0] as $activity):
                        $item = get_term_by('id', $activity, 'activities_taxonomy');
                            if($activity == $item->term_id):
                                $act_pic = get_term_meta($item->term_id, 'term_meta', true);
                                if ($act_pic != "") {
                                    echo wp_get_attachment_image($act_pic, $thumnail_img_size);
                                } else { ?>
                                    <img class="img-responsive" src="<?php echo get_template_directory_uri() ?>/images/icon/mou.png" alt="">
                                <?php }
                            endif;
                    endforeach;
                   ?>
                </div>
            </div>
        </div>
    </section>
<?php
  endif;
}
add_shortcode( 'activities_component', 'activities_component' );


function day_act_component($atts){
    $post_id = $atts['id'];
    $_day_activities = get_post_meta($post_id, '_day_activities', true);

     if (!empty($_day_activities)):
    ?>
    <section class="activity-day">
        <div class="container-fluid">
          <ul class="nav nav-tabs">
                <?php foreach ($_day_activities as $_idx => $_p): 
                       $class_active = '';
                       if($_idx == 0){
                        $class_active = 'active';
                    } ?>
                    <li class="<?php echo $class_active; ?>"><a data-toggle="tab" href="#<?php echo 'menu'.$_idx; ?>">Day <?php echo $_p['day']; ?></a></li>
                <?php endforeach; ?>
            </ul>
            <div class="tab-content">
                <?php foreach ($_day_activities as $_idx => $_p): 
                       $class_active = '';
                       if($_idx == 0){
                        $class_active = 'active';
                    } ?>
                    <div id="<?php echo 'menu'.$_idx; ?>" class="tab-pane fade in <?php echo $class_active; ?>">
                    <p><?php echo  $_p['detail']; ?></p>
                  </div>
                <?php endforeach; ?>              
            </div>
        </div>
    </section>
<?php
    endif;
}
add_shortcode( 'day_act_component', 'day_act_component' );


function related_camps($camp_id){
    $query = new WP_Query( array( 
        'post_type' => 'camp' ,
        'posts_per_page'  => 3,
        'post_status' => 'publish',
        'orderby' => 'rand',
        'post__not_in' => array($camp_id)
     )); 
    $camps_list = $query->posts;
    if(!empty($camps_list)):
     ?>
    <section id="camps">
        <div class="related-camp">
            <div class="row no-margin ">
                <div class="col-sm-6 col-xs-12 col-lg-3 no-padding bg-light-gray item-camps related ">
                    <div class="related-title">
                        <h2 class="margin-b-35">Other camps you might be interested in</h2>
                    </div>
                </div>
                <?php foreach ($camps_list as $key => $value):
                    $post_camp_id = $value->ID;
                    $image_id = get_post_thumbnail_id($post_camp_id);
                    $image_arr = wp_get_attachment_image_src($image_id, "custom-size-600");
                    $image = '';
                    $css_bot = '';
                    if (!empty($image_arr)) {
                        $image = $image_arr[0];
                    } 
                    if($key == 1){
                        $css_bot = 'bottom';
                    }
                ?>
                    <div class="col-sm-6 col-lg-3 col-xs-12 no-padding item-camps related" style="<?php echo trim($image) ? "background-image:url($image)" : "" ?>">
                        <a href="<?php echo get_the_permalink($post_camp_id); ?>" class="block-link <?php echo $css_bot; ?>">
                            <div class="text-white camp-block-title related">
                                <h3><?php echo $value->post_title; ?></h3>
                            </div>
                        </a>
                    </div>
                <?php  endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; 
}

function get_tesimonials(){
    $query = new WP_Query( array( 
        'post_type' => 'testimonials' ,
        'posts_per_page'  => 3,
        'post_status' => 'publish',
        'orderby' => 'rand'
     )); 
    $testimonials_list = $query->posts;
    if(!empty($testimonials_list)):
     ?>
     <section class="testimonials">
        <div class="container-fluid">
            <div class="row">
                    <div class="floating-text ">
                        <div class="text-inner text-center ">
                            <div class="owl-carousel owl-theme">
                                <?php foreach($testimonials_list as $item): ?>
                                    <h3 class="margin-b-35 block-testimonials">"<?php echo $item->post_content; ?>”
                                    </h3>
                                <?php endforeach; ?>
                             </div>
                        </div>
                    </div>
            </div>
        </div>    
    </section>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            var owl = $('.owl-carousel');
            owl.owlCarousel({
                items: 1,
                slideBy: 1,
                nav: false,
                loop: true,
                margin: 6,
                autoplay: false,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                responsiveClass: true,
                dots: true     
            });
        });
     </script>
<?php endif; 
}


function get_camps($limit=-1){
    $camps_list = get_camps_list($limit);
    if(!empty($camps_list)):
     ?>
     <section id="camps" class="padding-t-50">
        <div class="camps-container">
            <div class="row no-margin ">
                <div class="col-sm-6 col-xs-12 col-lg-3 no-padding bg-white item-camps ">
                    <div class="floating-text">
                        <div class="text-inner text-center ">
                            <h1 class="margin-b-35">Our outdoor education programs</h1>
                        </div>
                    </div>
                </div>
                <?php  
                foreach($camps_list as $key => $value):
                    $post_camp_id = $value->ID;
                    $image_id = get_post_thumbnail_id($post_camp_id);
                    $image_arr = wp_get_attachment_image_src($image_id, "custom-size-600");
                    $image = '';
                    if (!empty($image_arr)) {
                        $image = $image_arr[0];
                    } 
                    if($key == 1 || $key == 2){
                        $css_lg = '6';
                    }else{
                        $css_lg = '3';
                    }
                ?>
                 <div class="col-sm-6 col-lg-<?php echo $css_lg; ?> col-xs-12 no-padding item-camps " style="<?php echo trim($image) ? "background-image:url($image)" : "" ?>">
                    <a href="<?php echo get_the_permalink($post_camp_id); ?>" class="block-link">
                        <div class="text-white camp-block-title">
                            <h3><?php echo $value->post_title; ?></h3>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
             <div class="col-sm-6 col-xs-12 col-lg-3 no-padding bg-white item-camps ">
                <div class="floating-text">
                    <div class="text-inner text-center">
                        <h1 class="margin-b-35">Interested</h1>
                        <a href="<?php echo get_site_url().'/find-a-camp' ?>" class="btn btn-border-gold margin-b-15">find a camp</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; 
}

/* Send contact to into */
add_action('wp_ajax_nopriv_send_contact', 'send_contact');
add_action('wp_ajax_send_contact', 'send_contact');

function send_contact() {
   global $wpdb;
        $table = $wpdb->prefix . 'contact';
        //check_ajax_referer('send-brochure-nonce', '_ajax_nonce');
        $data = array_map('sanitize_text_field', $_POST);
        $data_list = array(
            'firstname' => $data['txtFirstName'],
            'lastname' => $data['txtLastName'],
            'email' => $data['txtEmail'],
            'phone' => $data['txtPhone'],
            'message' => $data['txtQA'],
            'created_at' => date('Y-m-d H:i:s')
        );
        if ($wpdb->insert($table, $data_list)) {
           // send_mail_contact_form( $data_list);
            echo 'SUCCESS';
        } else {
            echo 'FAIL';
        }
}

// Function send mail contact form
function send_mail_contact_form($data) {
    $reciepients = get_option('contact_register_settings');
    $to = $reciepients['main_email'];
    $site_name = get_bloginfo('name');                     
    $subject = 'Contact from Elite Website';
    ob_start();
    ?>
    <h1>Contact</h1>
    <br>
    <p>First name : <?php echo $data['firstname'] ?></p><br/>
    <p>Last name : <?php echo $data['lastname'] ?></p><br/>
    <p>Email : <?php echo $data['email'] ?></p><br/>
    <p>Phone : <?php echo $data['phone'] ?></p><br/>
    <p>Message : <?php echo $data['message'] ?></p><br/>
    <?php
    $html = ob_get_clean();
    $body = $html;

    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From: ' . $site_name . ' <info@elite.com>';
    if (wp_mail($to, $subject, $body, $headers)) {
        echo 'SUCCESS';
    } else {
        echo 'FAIL';
    }
    
    exit;
}


function get_camps_list($limit=-1){
    $query = new WP_Query( array( 
        'post_type' => 'camp' ,
        'posts_per_page'  => $limit,
        'post_status' => 'publish',
        'orderby' => 'rand',

     )); 
    $camps_list = $query->posts;
    return $camps_list;
}


function get_camps_filter(){
    $camp_list = get_camps_list();
    ?>
    <?php foreach ($camp_list as $key => $value) {
        $post_id = $value->ID;
        $_age = get_post_meta($post_id, '_age', true);
        if(!empty($_age)){
            $_age_detail = get_term_by('id', $_age, 'age_taxonomy');
        }
        $_price_camp = get_post_meta($post_id, '_price_camp', true);
        $_content_search = get_post_meta($post_id, '_content_search', true);
        ?>
        <div class="item-camp col-xs-12">
            <div class="col-sm-4 col-xs-12 camp-item-contrainer left">
                <div class="block bg-gold">
                    <h3 class="text-white"><?php echo $value->post_title; ?></h3>
                    <h4 class="text-white">Age: <?php echo $_age_detail->name; ?></h4>
                </div>
            </div>
            <div class="col-sm-8 col-xs-12 camp-item-contrainer right">
                <div class="block bg-gray">
                        <?php echo $_content_search; ?>
                    <div class="bottom-content">
                        <div class="content-bot">
                            <span class="glyphicon glyphicon-tag"> </span>
                             Price: <?php echo $_price_camp; ?> THB
                        </div>
                        <div class="content-bot">
                            <a href="<?php echo get_the_permalink($post_id); ?>">learn more</a>
                        </div>
                    </div>
                </div>
            </div>  
        </div>

    <?php }
    }


add_action('wp_ajax_get_ajax_camps', 'get_ajax_camps');
add_action('wp_ajax_nopriv_get_ajax_camps', 'get_ajax_camps');

function get_ajax_camps($_activity='', $_age='', $_date='') {
    $filter_age = (!isset($_GET['filter_age']) ? $_age : $_GET['filter_age']);
    $filter_activity = (!isset($_GET['filter_activity']) ? $_activity : $_GET['filter_activity']);
    $filter_date = (!isset($_GET['filter_date']) ? $_date : $_GET['filter_date']);
    $args = array( 
        'post_type' => 'camp' ,
        'posts_per_page'  => -1,
        'post_status' => 'publish',
        'orderby' => 'rand',
     ); 
    if (trim($filter_date)) {
        $filter_date = trim($filter_date);
        $args['post__in'] = array($filter_date);
    }
    if (trim($filter_age)) {
        $filter_age = trim($filter_age);
        $args['meta_query'][] = array(
            'key'     => '_age',
            'value'   => $filter_age,     
        );
    }
    if (trim($filter_activity)) {
        $filter_activity = trim($filter_activity);
        $args['meta_query'][] = array(
            'key'     => '_order_idx_activities',
            'value'   => $filter_activity,   
            'compare' => 'LIKE' 
        );
    }

    $query = new WP_Query($args);
    $camps_list = $query->posts;
    foreach ($camps_list as $key => $value) {
        $post_id = $value->ID;
        $_age = get_post_meta($post_id, '_age', true);
        if(!empty($_age)){
            $_age_detail = get_term_by('id', $_age, 'age_taxonomy');
        }
        $_price_camp = get_post_meta($post_id, '_price_camp', true);
        $_content_search = get_post_meta($post_id, '_content_search', true);

        ?>
        <div class="item-camp col-xs-12">
            <div class="col-sm-4 col-xs-12 camp-item-contrainer left">
                <div class="block bg-gold">
                    <h3 class="text-white"><?php echo $value->post_title; ?></h3>
                    <h4 class="text-white">Age: <?php echo $_age_detail->name; ?></h4>
                </div>
            </div>
            <div class="col-sm-8 col-xs-12 camp-item-contrainer right">
                <div class="block bg-gray">
                        <?php echo $_content_search; ?>
                    <div class="bottom-content">
                        <div class="content-bot">
                            <span class="glyphicon glyphicon-tag"> </span>
                             Price: <?php echo $_price_camp; ?> THB
                        </div>
                        <div class="content-bot">
                            <a href="<?php echo get_the_permalink($post_id); ?>">learn more</a>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    <?php }
     // IMPORTANT: don't forget to "exit"
    if (defined('DOING_AJAX') && DOING_AJAX) {
        exit;
    }

 }




