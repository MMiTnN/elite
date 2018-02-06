<?php
class Video_left_tab {
	function get_form($post){
            $post_id = $post->ID;
            $single = true;
            $_video = get_post_meta($post_id, '_video_left', $single);
            $_video_title = '';
            $_video_content = '';
            $_video_link = '';
            $your_img_id =  '';
            if(!empty($_video[0])){
                $_video_title = $_video[0]['_video_left_title'];
                $_video_content = $_video[0]['_video_left_content'];
                $_video_link = $_video[0]['_video_left_link'];
                $your_img_id =  $_video[0]['_video_left_img'];
            }
        ?>
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label >Short code</label>
                    </th>

                    <td>
                        <p>
                            [video_component id='<?php echo $post_id ?>' left=true]
                        </p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label >Video Title</label>
                    </th>

                    <td>
                        <input type="text" value="<?php echo $_video_title; ?>"  name="_video_left_title" class="widefat">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label >Video Content</label>
                    </th>

                    <td>
                        <?php wp_editor($_video_content, '_video_left_content', array( 'editor_height' => '300','media_buttons'=>false)) ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label >Video URL</label>
                    </th>

                    <td>
                        <input type="text" value="<?php echo $_video_link; ?>"  name="_video_left_link" class="widefat">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label >Video Image</label>
                    </th>

                    <td>
                        <?php
                        $upload_link = esc_url(get_upload_iframe_src('image', $post_id));
                        $your_img_src = wp_get_attachment_image_src($your_img_id, 'full');
                        $you_have_img = is_array($your_img_src);
                        ?>
                        <div class="custom-img">
                            <div class="about-img-container">
                                <?php if ($you_have_img) : ?>
                                    <img src="<?php echo $your_img_src[0] ?>" alt="" style="max-width:100%;width:300px;height:auto" />
                                <?php endif; ?>
                            </div>

                            <!-- Your add & remove image links -->
                            <p class="hide-if-no-js">
                                <a class="upload-about-img <?php echo $your_img_id ? "hidden" : "" ?>"     href="<?php echo $upload_link ?>">
                                    <?php _e('Set custom image') ?>
                                </a>
                                <a class="delete-about-img <?php echo!$your_img_id ? "hidden" : "" ?>"  href="#">
                                    <?php _e('Remove this image') ?>
                                </a>
                            </p>

                            <!-- A hidden input to set and post the chosen image id -->
                            <input class="about-img-id" name="_video_left_img" type="hidden" value="<?php echo esc_attr($your_img_id); ?>" >
                        </div>
                    </td>
                </tr>
            </table>
            <script>
            jQuery(function ($) {

                var aboutusFrameLeft,
                        addAboutImgLinkLeft = $('.upload-about-img'),
                        deAboutlImgLinkLeft = $('.delete-about-img');
                        imgAboutContainerLeft = $('.about-img-container');
                        imgAboutIdInputLeft = $('.about-img-id');

                // ADD IMAGE LINK
                addAboutImgLinkLeft.on('click', function (event) {

                    event.preventDefault();

                    var $parent = $(this).parent().parent();


                    aboutusFrameLeft = wp.media({
                        title: 'Select or Upload Media Of Your Chosen Persuasion',
                        button: {
                            text: 'Use this media'
                        },
                        multiple: false  // Set to true to allow multiple files to be selected
                    });
                    aboutusFrameLeft.currentParent = $parent;
                    //console.log(aboutusFrame);


                    // When an image is selected in the media aboutusFrame...
                    aboutusFrameLeft.on('select', function () {

                        var itemParent = aboutusFrameLeft.currentParent
                        var attachment = aboutusFrameLeft.state().get('selection').first().toJSON();

                        itemParent.find(imgAboutContainerLeft).append('<img src="' + attachment.url + '" alt="" style="max-width:100%;width:300px;height:auto"/>');

                        itemParent.find(imgAboutIdInputLeft).val(attachment.id);

                        itemParent.find(addAboutImgLinkLeft).addClass('hidden');

                        itemParent.find(deAboutlImgLinkLeft).removeClass('hidden');
                    });

                    aboutusFrameLeft.open();
                });


                // DELETE IMAGE LINK
                deAboutlImgLinkLeft.on('click', function (event) {

                    event.preventDefault();

                    var itemParent = $(this).parent().parent();

                    itemParent.find(imgAboutContainerLeft).html('');

                    itemParent.find(addAboutImgLinkLeft).removeClass('hidden');

                    itemParent.find(deAboutlImgLinkLeft).addClass('hidden');

                    itemParent.find(imgAboutIdInputLeft).val('');

                });

            });
        </script>
        <?php
        }
        
	function save($post_id){

            $videos[] = array(
                '_video_left_title' => sanitize_text_field($_POST['_video_left_title']),
                '_video_left_content' => sanitize_text_field($_POST['_video_left_content']),
                '_video_left_link' => sanitize_text_field($_POST['_video_left_link']),
                '_video_left_img' => intval($_POST['_video_left_img']),
            );
            update_post_meta($post_id, '_video_left', $videos);

	}

}