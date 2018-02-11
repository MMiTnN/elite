<?php
if (have_posts()) :

    get_header();

    the_post();
    $post_id = get_the_ID();
    $image_id = get_post_thumbnail_id($post_id);
    $image_arr = wp_get_attachment_image_src($image_id, "custom-size-600");
    $image = '';
    if (!empty($image_arr)) {
        $image = $image_arr[0];
    }else{
        $image = get_template_directory_uri().'/images/tower6.jpeg';
    }

    ?>
<section class="header-section"  style="background-image: linear-gradient(rgba(0, 0, 0, 0.45),rgba(0, 0, 0, 0.45)), url(<?php echo $image ?>);">
    <div>
        <p class='text-white header-title text-center'><?php echo get_the_title(); ?></p>
    </div>
</section>

<section class="condition">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="block content">
                    <div class="block-content">
                        <div class="title-block"><?php echo get_the_title(); ?></div>
                        <p><?php echo get_the_content(); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <!--END wrapper-->
    <?php
    get_footer();
else:
    show_404();
endif;
