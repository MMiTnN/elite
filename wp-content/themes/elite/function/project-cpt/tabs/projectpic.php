<?php

class Projectpic_tab {

    function get_form($post) {

        $post_id = $post->ID;
        $projectpic = get_post_meta($post_id, 'projectpic', true);
        ?>
        <style>
            #projectpic_inputs{display: none;}
        </style>
        <style>
            .about-img-coe, .about-img-items{
                width: 60px;
            }
            .t-group{
                padding-bottom: 30px;
            }
            .t-table{
                display: table;
                width: 100%;
            }
            .t-row{
                display: table-row;
            }
            .t-cell{
                display: table-cell;
                padding: 5px 0;
            }            
            .t-cell:nth-child(1){
                width: 15%;
            }
            .t-cell:nth-child(2){
                width: 70%;
            }
            .t-cell:nth-child(3){
                width: 15%;
            }
            .font-bold{
                font-weight: bold;
            }
            .text-center{
                text-align: center;
            }
            .moveicon{
                width: 20px;
                height: auto;
                cursor: pointer;
            }
            .add_new_coe{
                padding: 20px 0px;
            }
            .t-table .editor_header{
                padding: 0px 0px !important;
            }
        </style>
        <button type="button" class="button" onclick="add_new_network();">Add New</button>
        <div class="form-table" id="projectpic-container" width="100%"  data-inputrows="<?php echo empty($projectpic) ? 0 : count($projectpic) ?>">
            <?php if (!empty($projectpic)): ?>
                <?php foreach ($projectpic as $_idx => $_p): ?>
                    <?php echo $this->projectpic_input($_idx,$_p) ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div id="projectpic_inputs">
            <?php 
                echo $this->projectpic_input('__temp__','');
             ?>
        </div>
        <script type="text/javascript">
            function add_new_network() {
               // var html = jQuery('#projectpic_inputs .projectpic-group').clone();
                var ccContainer = $('#projectpic-container');
                var idx = jQuery('#projectpic-container').data('inputrows');
                idx = parseInt(idx);
                jQuery('#projectpic-container').data('inputrows', (idx + 1));
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    data: {action: 'projectpic_new_hos', idx: idx},
                    type: 'post',
                    success: function (html) {
                        var temp_text = "__temp__";
                        ccContainer.append(html);
                        sort_projectpic_items();
                        jQuery(html).each(function (i, v) {
                            $(v).find('.title-main-hos').html('Project '+(idx + 1));
                            $(v).find('[name*="'+temp_text+'"]').each(function(){
                                $(this).prop("name", $(this).prop("name").replace(temp_text, idx));
                            });
                            $(v).find('[id*="'+temp_text+'"]').each(function(){
                                $(this).prop("id", $(this).prop("id").replace(temp_text, idx));
                            });
                        });
                    },
                }).done(function() { //use this
                    var imgpro_upload = $('.upload-img-pro');
                    var delopro_img = $('.delete-img-pro');
                    add_pro_item(imgpro_upload, delpro_img);
                 });
        
                
            }

            function remove_tr_projectpic(elm){
                if( confirm("Please confirm") ){
                    $(elm).parents('.projectpic-group').remove();
                    sort_projectpic_items();
                }
            }
            
            function sort_projectpic_items() {
                jQuery("#projectpic-container").find(".position").each(function (idx, elm) {
                    jQuery(this).val(idx);
                })
            }
            
            function add_pro_item(img_upload,del_img){
                // ADD IMAGE LINK
                    img_upload.each(function(){
                       $(this).on('click', function (event) {
                        event.preventDefault();

                        var $parent = $(this).parent().parent();
                        var itemParent = $(this).parents('.custom-img-pro');
                        var addAboutImgLink = itemParent.find('.upload-img-pro'),
                            deAboutlImgLink = itemParent.find('.delete-img-pro');
                            imgAboutContainer = itemParent.find('.about-img-pro');
                            imgAboutIdInput = itemParent.find('.img-pro-id');

                        aboutusFrame = wp.media({
                            title: 'Select or Upload Media Of Your Chosen Persuasion',
                            button: {
                                text: 'Use this media'
                            },
                            multiple: false  // Set to true to allow multiple files to be selected
                        });
                        aboutusFrame.currentParent = $parent;


                        // When an image is selected in the media aboutusFrame...
                        aboutusFrame.on('select', function () {

                            var itemParent = aboutusFrame.currentParent
                            var attachment = aboutusFrame.state().get('selection').first().toJSON();

                            itemParent.find(imgAboutContainer).append('<img src="' + attachment.url + '" alt="" style="max-width:100%;width:300px;height:auto"/>');

                            itemParent.find(imgAboutIdInput).val(attachment.id);

                            itemParent.find(addAboutImgLink).addClass('hidden');

                            itemParent.find(deAboutlImgLink).removeClass('hidden');
                        });

                        aboutusFrame.open();
                    }); 
                    });
    //

                    // DELETE IMAGE LINK
                    del_img.on('click', function (event) {

                        event.preventDefault();
                        var itemParent = $(this).parents('.custom-img-pro');
                        var addAboutImgLink = itemParent.find('.upload-img-pro'),
                            deAboutlImgLink = itemParent.find('.delete-img-pro');
                            imgAboutContainer = itemParent.find('.about-img-pro');
                            imgAboutIdInput = itemParent.find('.img-pro-id');



                        itemParent.find(imgAboutContainer).html('');

                        itemParent.find(addAboutImgLink).removeClass('hidden');

                        itemParent.find(deAboutlImgLink).addClass('hidden');

                        itemParent.find(imgAboutIdInput).val('');

                    });
            }
            
            jQuery(function ($) {
                jQuery(document).ready(function ($) {
                    $('#projectpic-container').sortable({
                        stop: function (event, ui) {
                            sort_projectpic_items();
                        }
                    });

                    sort_projectpic_items();
                    
                    var img_upload = $('.upload-img-pro');
                    var del_img = $('.delete-img-pro');
                    add_pro_item(img_upload, del_img);
                });
            });
        </script>
        <?php
    }

    function save($post_id) {
        $projectpic = '';
        if (isset($_POST['projectpic'])) {
            $_p = $_POST['projectpic'];
            unset($_p['temp']);
            foreach ($_p as $p) {
                 if(!empty($p['title']) && !empty($p['content']) ){
                    $projectpic[] = array(
                        'title' => sanitize_text_field($p['title']),
                        'content' => sanitize_text_field($p['content']),
                        'img' => intval($p['img']),
                        'position' => intval($p['position']),
                    );
                }
            }
        }
        update_post_meta($post_id, 'projectpic', $projectpic);
    }

    function projectpic_input($_idx, $arr = array()) {
        $full_id = 'projectpic_content_' . $_idx;
        ob_start();
        $defaults = array(
            'title' => '',
            'content' => '',
            'img' => '',
            'position' => ''
        );
        $data = wp_parse_args($arr, $defaults);
        ?>
         <div class="projectpic-group t-table">
             <div class="editor_header">
                <h3 class="title-main-hos">Project <?php echo $_idx + 1 ?></h3>
                <a href="#" onclick="remove_tr_projectpic(this);return false;" class="remove"><span class="dashicons dashicons-trash"></span></a>
                <button class="nav-toggle" type="button" onclick="toggle_content(this);"><span class="toggle_btn collapsed"></span></button>
            </div>
             <div class="collapsable" style="display:none;">
                <div class="t-table">
                    <input type="hidden" name="projectpic[<?php echo $_idx ?>][position]" class="widefat position" value="<?php echo $data['position'] ?>">
                   <div class="t-row">
                       <div class="t-cell font-bold">Title</div>
                       <div class="t-cell">
                          <input type="text" name='projectpic[<?php echo $_idx; ?>][title]' class="widefat" value="<?php echo $data['title'] ?>">
                       </div>
                   </div>
                    <div class="t-row">
                       <div class="t-cell font-bold">Image</div>
                       <div class="t-cell">
                          <?php
                           $your_img_id_nt = $data['img'];
                           $upload_link_nt = esc_url(get_upload_iframe_src('image', $data['img']));
                           $your_img_src_nt = wp_get_attachment_image_src($data['img'], 'full');
                           $you_have_img_nt = is_array($your_img_src_nt);
                           ?>
                           <div class="custom-img-pro">
                               <div class="about-img-projectpic-container<?php echo $_idx; ?> about-img-pro">
                                   <?php if ($you_have_img_nt) : ?>
                                       <img src="<?php echo $your_img_src_nt[0] ?>" alt="" style="max-width:100%;width:300px;height:auto" />
                                   <?php endif; ?>
                               </div>

                               <!-- Your add & remove image links -->
                               <p class="hide-if-no-js">
                                   <a class="upload-about-img-projectpic<?php echo $_idx; ?> upload-img-pro <?php echo $your_img_id_nt ? "hidden" : "" ?>"   href="<?php echo $upload_link_nt ?>">
                                       <?php _e('Set custom image') ?>
                                   </a>
                                   <a class="delete-about-img-projectpic<?php echo $_idx; ?> delete-img-pro <?php echo!$your_img_id_nt ? "hidden" : "" ?>"  data-rows="<?php echo $_idx; ?>" href="#">
                                       <?php _e('Remove this image') ?>
                                   </a>
                               </p>

                               <!-- A hidden input to set and post the chosen image id -->
                               <input class="about-img-projectpic-id<?php echo $_idx; ?> img-pro-id" name="projectpic[<?php echo $_idx; ?>][img]" type="hidden" value="<?php echo esc_attr($your_img_id_nt); ?>" >
                           </div>
                       </div>
                   </div>
                 </div>
             </div>
         </div>
        
        <?php
         return ob_get_clean();
    }
    
    function load_new_item_callback(){
        $idx = $_POST['idx'];

        echo $this->projectpic_input($idx);

        die();
    }

}