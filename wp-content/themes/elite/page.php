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
<div class="hero-body main-header parallax-window" data-parallax="scroll" data-image-src="<?php echo  $image ?>" >
    <div class="container has-text-centered">
      <div class="font-main-header white">
        <h1 class="title">
          <?php echo get_the_title(); ?>
        </h1>
      </div>
    </div>
  </div>

<section class="condition">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="block content">
                    <div class="block-content">
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
