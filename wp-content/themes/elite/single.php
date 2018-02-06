<?php
/*
  Single Post Template:Blog
 */

get_header();

if (have_posts()) {
    the_post();

    
    if ($post->post_content != "") { ?>
        <section class="padding-t-35 padding-b-35 bg-white" >
            <div class="container">
                <div class="row">
                    <div class="col-xs-12  col-md-8 col-md-offset-2" style="position: initial;">
                        <p class='p-textpage'>
                            <?php the_content(); ?>
                        </p>
                    </div>

                </div>
            </div>
        </section>
    <?php } ?>
    <footer>
        <?php get_template_part("pagefooter"); ?>
    </footer>
    <?php
    get_footer();
    ?>
    <?php
} else {
    //Show 404
}
?>
