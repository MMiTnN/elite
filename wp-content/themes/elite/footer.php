</div>
<footer>
	<div class="container-fluid">
		<div class="row">
			<div class="title-footer"><?php _e('บริษัท เอลีท เอ็นจิเนียร์ส จำกัด',$elite); ?></div>
			<div class="col-lg-8 col-sm-7 col-xs-12 no-padding">
				<div class="menu-footer">
					<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container_class' => 'footer-list' ) ); ?>
				</div>
				<div class="footer-bottom">
					Elite Engineer 2018 &nbsp; |  &nbsp; Forum Tower &nbsp;  
				</div>
			</div>
			
		</div>
	</div>
</footer>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('.menu-footer .footer-list ul li').on('click', function(){
        	var href = $(this).find('a').attr('href');
        	window.location.href = href;
        });
    });
 </script>
<?php wp_footer(); ?>
</body>

</html>
