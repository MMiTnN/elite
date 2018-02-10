<?php
class Profile_tab {
    function get_form($post){
            $post_id = $post->ID;
            $single = true;
            $profile = get_post_meta($post_id, 'profile', $single);
            $profile_title = '';
            $profile_content = '';
            $profile_img =  '';
            if(!empty($profile[0])){
                $profile_title = $profile[0]['profile_title'];
                $profile_content = $profile[0]['profile_content'];
                $profile_img =  $profile[0]['profile_img'];
            }
        ?>
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label >Profile Title</label>
                    </th>

                    <td>
                        <input type="text" value="<?php echo $profile_title; ?>"  name="profile_title" class="widefat">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label >Profile Content</label>
                    </th>

                    <td>
                        <?php wp_editor($profile_content, 'profile_content', array( 'editor_height' => '300','media_buttons'=>false)) ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label >Profile Image</label>
                    </th>

                    <td>
                        <?php
                        $upload_link = esc_url(get_upload_iframe_src('image', $post_id));
                        $your_img_src = wp_get_attachment_image_src($profile_img, 'full');
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
                                <a class="upload-about-img <?php echo $profile_img ? "hidden" : "" ?>"     href="<?php echo $upload_link ?>">
                                    <?php _e('Set custom image') ?>
                                </a>
                                <a class="delete-about-img <?php echo!$profile_img ? "hidden" : "" ?>"  href="#">
                                    <?php _e('Remove this image') ?>
                                </a>
                            </p>

                            <!-- A hidden input to set and post the chosen image id -->
                            <input class="about-img-id" name="profile_img" type="hidden" value="<?php echo esc_attr($your_img_id); ?>" >
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

            $profiles[] = array(
                'profile_title' => sanitize_text_field($_POST['profile_title']),
                'profile_content' => sanitize_text_field($_POST['profile_content']),
                'profile_img' => intval($_POST['profile_img']),
            );
            update_post_meta($post_id, 'profile', $profiles);

  }


}
