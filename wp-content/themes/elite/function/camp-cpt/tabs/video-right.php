<?php
class Video_right_tab {
	function get_form($post){
            $post_id = $post->ID;
            $single = true;
            $_video_right = get_post_meta($post_id, '_video_right', $single);
            $_video_right_title = '';
            $_video_right_content = '';
            $_video_right_link = '';
            $_video_right_img =  '';
            if(!empty($_video_right[0])){
                $_video_right_title = $_video_right[0]['_video_right_title'];
                $_video_right_content = $_video_right[0]['_video_right_content'];
                $_video_right_link = $_video_right[0]['_video_right_link'];
                $_video_right_img =  $_video_right[0]['_video_right_img'];
            }
        ?>
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label >Short code</label>
                    </th>

                    <td>
                        <p>
                            [video_component id='<?php echo $post_id ?>' left=false]
                        </p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label >Video Title</label>
                    </th>

                    <td>
                        <input type="text" value="<?php echo $_video_right_title; ?>"  name="_video_right_title" class="widefat">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label >Video Content</label>
                    </th>

                    <td>
                        <?php wp_editor($_video_right_content, '_video_right_content', array( 'editor_height' => '300','media_buttons'=>false)) ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label >Video URL</label>
                    </th>

                    <td>
                        <input type="text" value="<?php echo $_video_right_link; ?>"  name="_video_right_link" class="widefat">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label >Video Image</label>
                    </th>

                    <td>
                        <?php
                        $upload_link = esc_url(get_upload_iframe_src('image', $post_id));
                        $your_img_src = wp_get_attachment_image_src($_video_right_img, 'full');
                        $you_have_img = is_array($your_img_src);
                        ?>
                        <div class="custom-right-img">
                            <div class="about-right-img-container">
                                <?php if ($you_have_img) : ?>
                                    <img src="<?php echo $your_img_src[0] ?>" alt="" style="max-width:100%;width:300px;height:auto" />
                                <?php endif; ?>
                            </div>

                            <!-- Your add & remove image links -->
                            <p class="hide-if-no-js">
                                <a class="upload-right-about-img <?php echo $_video_right_img ? "hidden" : "" ?>"     href="<?php echo $upload_link ?>">
                                    <?php _e('Set custom image') ?>
                                </a>
                                <a class="delete-right-about-img <?php echo!$_video_right_img ? "hidden" : "" ?>"  href="#">
                                    <?php _e('Remove this image') ?>
                                </a>
                            </p>

                            <!-- A hidden input to set and post the chosen image id -->
                            <input class="about-right-img-id" name="_video_right_img" type="hidden" value="<?php echo esc_attr($_video_right_img); ?>" >
                        </div>
                    </td>
                </tr>
            </table>
            <script>
            jQuery(function ($) {

                var aboutusFrame,
                        addAboutImgLink = $('.upload-right-about-img'),
                        deAboutlImgLink = $('.delete-right-about-img');
                        imgAboutContainer = $('.about-right-img-container');
                        imgAboutIdInput = $('.about-right-img-id');

                // ADD IMAGE LINK
                addAboutImgLink.on('click', function (event) {

                    event.preventDefault();

                    var $parent = $(this).parent().parent();


                    aboutusFrame = wp.media({
                        title: 'Select or Upload Media Of Your Chosen Persuasion',
                        button: {
                            text: 'Use this media'
                        },
                        multiple: false  // Set to true to allow multiple files to be selected
                    });
                    aboutusFrame.currentParent = $parent;
                    //console.log(aboutusFrame);


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


                // DELETE IMAGE LINK
                deAboutlImgLink.on('click', function (event) {

                    event.preventDefault();

                    var itemParent = $(this).parent().parent();

                    itemParent.find(imgAboutContainer).html('');

                    itemParent.find(addAboutImgLink).removeClass('hidden');

                    itemParent.find(deAboutlImgLink).addClass('hidden');

                    itemParent.find(imgAboutIdInput).val('');

                });

            });
        </script>
        <?php
        }
        
	function save($post_id){

            $videos[] = array(
                '_video_right_title' => sanitize_text_field($_POST['_video_right_title']),
                '_video_right_content' => sanitize_text_field($_POST['_video_right_content']),
                '_video_right_link' => sanitize_text_field($_POST['_video_right_link']),
                '_video_right_img' => intval($_POST['_video_right_img']),
            );
            update_post_meta($post_id, '_video_right', $videos);

	}

}