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
    
    <section class="header-section normal"  style="background-image: linear-gradient(rgba(0, 0, 0, 0.35),rgba(0, 0, 0, 0.35)), url(<?php echo $image ?>);">
        <div>
            <p class='text-white header-title text-center'><?php echo get_the_title(); ?></p>
        </div>
    </section>
    <div class="print-header">
        <div class="container-fulid has-text-centered">
         <img src="<?php echo $image ?>" />
          <div class="font-main-header white">
            <h1 class="title">
               <?php echo get_the_title(); ?>
            </h1>
          </div>
        </div>
      </div>
    <?php if(!empty($projectpic)): ?>
         <section class="hero section-box is-light projects-list">
          <div class="">
            <div class="container">
              <div class="columns is-multiline is-12">
                <?php foreach ($projectpic as $_idx => $data):
                        ?>
                          <div class="column is-4  is-4-desktop is-3-widescreen is-mobile has-text-centered box-content blog-img pro">
                          <a class="example-image-link img-pro" data-lightbox="example-set" data-title="Click the right half of the   image to move forward." href="<?php echo wp_get_attachment_url($data) ?>">
                                 <img class="block black"  class="example-image" src='<?php echo wp_get_attachment_url($data) ?>'>
                              </a>
                         </div>                        
                     <?php endforeach; ?>
              </div>
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


