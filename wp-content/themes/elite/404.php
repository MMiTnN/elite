<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
get_header();
?>
<?php $url = get_template_directory_uri() . '/images/header-images.jpg'; ?>
<style>
    a.red-link {color: #dc3536;}
    a.red-link:hover {text-decoration: underline !important;}
    .header-section{ background-image: url( <?php echo $url ?> );
    </style>
    <div class='header-section padding-b-50'>
        <div class="container no-padding">
            <div class="title text-dark-grey text-center">
                404 :(
                <h2>Page not found</h2>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="col-sm-8 col-sm-offset-2 padding-t-100 padding-b-100">
            We recently launched our new website and things may be in a different location as they used to be.
            <br><br>
            Please use the search field at the top or click on the following
            <a href="<?php echo home_url() ?>" class="red-link">link to return to the homepage</a>
        </div>
    </div>

    <footer class="bg-white">
        <div class='container-fluid no-padding bg-light-gray'>
        </div>
<?php get_template_part("pagefooter"); ?>
    </footer>

<?php get_footer(); ?>