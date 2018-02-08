<?php
if (have_posts()) :
    get_header();
    the_post();
    $ID = get_the_ID();
    $title = get_the_title();
    /* Thumnail */
    $image_id = get_post_thumbnail_id($ID);
    $image_arr = wp_get_attachment_image_src($image_id, "custom-size-600");
    if (empty($image_arr)) {
        $image = get_stylesheet_directory_uri() . '/images/800x800.jpg';
    } else {
        $image = $image_arr[0];
    }
    $projectpic = get_post_meta($ID, 'projectpic', true);
    ?>
    <section class="header-section"  style="background-image: linear-gradient(rgba(0, 0, 0, 0.45),rgba(0, 0, 0, 0.45)), url(<?php echo $image ?>);">
        <div>
            <p class='text-white header-title text-center'><?php echo get_the_title(); ?></p>
        </div>
    </section>
    <?php if(!empty($projectpic)): ?>
        <section class="projects-list">
            <div class="container-fluid">
                <div class="row">
                    <?php foreach ($projectpic as $_idx => $data):
                        ?>
                         <a class="example-image-link" data-lightbox="example-set" data-title="Click the right half of the image to move forward." href="<?php echo wp_get_attachment_url($data) ?>">
                            <div class="col-md-3 col-sm-4 col-xs-12" style="margin-bottom: 20px;">
                                
                                <div class="block black" class="example-image"  style="background-image: url(<?php echo wp_get_attachment_url($data) ?>); background-size: cover;
                                                                                                              background-repeat: no-repeat;
                                                                                                              background-position: 55% 55%;" >
                                </div>
                            </div>
                         </a>
                        <?php
                    endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <!--END wrapper-->
    <?php
    get_footer();
else:
    show_404();
endif;


