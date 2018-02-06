<?php
$post_id = $_GET["post"];
    ob_start(); 
    ?>
<!--  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri().'/css/bootstrap.min.css' ?>" type="text/css"> -->
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri().'/includes/mpdf/mpdf.css' ?>" type="text/css">
  
    <section class="header-section">
        <div>
            <p class='text-white header-title text-center'><?php echo get_the_title($post_id ); ?></p>
        </div>
    </section>
<div class="gen-pdf">
    <section class="date-age">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-xs-12">
                    <div class="block column">
                        <div class="age padding-b-20"> 
                            <span class="glyphicon glyphicon-user"></span>
                            <strong> Age:</strong> 9-11 Years
                        </div>
                        <div class="price"> 
                            <span class="glyphicon glyphicon-tag"></span>
                            <strong> Price:</strong>  20,500 THB
                        </div>
                    </div>
                </div>   
               <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
                    <div class="block column date">
                         <div class="date"> 
                            <span class="glyphicon glyphicon-calendar"></span>
                            <strong> Dates:</strong> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6 col-sm-9 col-xs-7 flex-row text-around">
                    <div class="block column">
                        <h5>21-24 June</h5>
                        <h5>21-24 June</h5>
                        <h5>21-24 June</h5>
                    </div>
                    <div class="block column">
                        <h5>21-24 June</h5>
                        <h5>21-24 June</h5>
                        <h5>21-24 June</h5>
                    </div>
                    <div class="block column">
                        <h5>21-24 June</h5>
                        <h5>21-24 June</h5>
                        <h5>21-24 June</h5>
                    </div>
                </div>           
            </div>
        </div>
    </section>
    <?php 
    $post_content = get_post($post_id);
    $file_name = "Camp - ".$post_content->post_title;
    $content = $post_content->post_content;
     do_shortcode( $content );   
     ?>
    </div>
    <?php
    $html = ob_get_contents();
    ob_end_clean();
    require_once INCLUDES_DIR.'/mpdf/mpdf.php';
    $pdf = new mPDF();
    $stylesheet = file_get_contents(get_stylesheet_directory_uri().'/includes/mpdf/mpdf.css');
    $pdf->WriteHTML($stylesheet,1);
    $pdf->SetTitle($file_name);
    $pdf->SetDisplayMode('fullpage');
    $pdf->WriteHTML($html,2);
    $pdf->Output($file_name.".pdf","D");
    exit;
?>



