<?php
/*
Template Name: projects
*/
get_header();

$args = array(
    'post_type' => 'projects',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'order' => 'DESC',
);

$get_pjt = '';

if (isset($_GET['pjt'])) {
    $get_pjt = $_GET['pjt'];    
}
if (!empty($get_pjt)) {
     $args['meta_query'] = array(
        array(
            'key' => '_pjt',
            'value' => $get_pjt,
            'compare' => '=',
        ),
    );
}

/*
 * Query
 */
$posts = new WP_Query($args);
$projects = $posts->posts;
?>
<div class="hero-body main-header parallax-window" data-parallax="scroll" data-image-src="<?php echo get_template_directory_uri(); ?>/images/tower8.jpeg" >
    <div class="container has-text-centered">
      <div class="font-main-header white">
        <h1 class="title">
          <?php echo empty($get_pjt)? _e('โครงการทั้งหมด'): $get_pjt; ?>
        </h1>
      </div>
    </div>
  </div>


<?php
     if(!empty($projects)): ?>
        <section class="projects-list">
            <div class="container-fluid">
                <div class="row">
                    <?php foreach($projects as $pro): 
                    $post_id = $pro->ID;
                    /* Get post thumnail */
                    $image_id = get_post_thumbnail_id($post_id);
                    $image_arr = wp_get_attachment_image_src($image_id, "custom-size-600");
                    if (empty($image_arr)) {
                        $image = get_stylesheet_directory_uri() . '/images/1000x350.jpg';
                    } else {
                        $image = $image_arr[0];
                    }
                    ?>
                     <a class="img-pro" href="<?php echo get_permalink($post_id); ?>">
                        <div class="col-md-3 col-sm-4 col-xs-12" style="margin-bottom: 20px;">
                            
                            <div class="block black"  style="background-image: url(<?php echo $image ?>); background-size: cover;
                                                                                                          background-repeat: no-repeat;
                                                                                                          background-position: 55% 55%;" >
                            </div>
                            <h5> <?php echo $pro->post_title; ?></h5>
                        </div>
                     </a>
                    <?php
                    endforeach; ?>
                </div>
            </div>
        </section>
   <?php endif; ?>
<!--END Search filters-->

<?php
get_footer();
?>

