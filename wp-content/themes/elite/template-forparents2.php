<?php
/*
 * Template Name: For parents
 */
?>
<?php get_header(); 
the_post();
$post_id = get_the_ID();
$image_id = get_post_thumbnail_id($post_id);
$image_arr = wp_get_attachment_image_src($image_id, "custom-size-600");
$image = '';
    if (!empty($image_arr)) {
        $image = $image_arr[0];
    } 
$post_id =  get_the_ID();
$_conditions = get_post_meta($post_id, '_conditions', true);
?>


<section class="header-section"  style="background-image: linear-gradient(rgba(0, 0, 0, 0.45),rgba(0, 0, 0, 0.45)), url(<?php echo $image ?>);">
    <div>
        <p class='text-white header-title text-center'><?php echo get_the_title(); ?></p>
    </div>
</section>

<section class="condition">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-xs-12">
                <div class="block link">
                    <p class="title">Table of contents </p>   
                    <?php foreach ($_conditions as $_idx => $_p): ?>
                        <p><?php echo $_p['title']; ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-md-7 col-xs-12">
                <div class="block content">
                    <?php foreach ($_conditions as $_idx => $_p): ?>
                    <div class="block-content">
                        <div class="title-block"><?php echo $_p['title']; ?></div>
                        <p><?php echo $_p['detail']; ?></p>
                    </div>
                        <p></p>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-md-2 col-xs-12">
               <a href="" class="btn btn-border-gold margin-b-15">Contact</a>
            </div>
        </div>
    </div>
</section>