<?php
get_header();

?>

<div class="title text-dark-grey text-center container no-padding">
    <?php printf(__('search results for: %s', ''), get_search_query()); ?>
</div>

<section class="">
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
        }
    }
    ?>
</section>
            
</footer>
    <?php get_footer(); ?>
