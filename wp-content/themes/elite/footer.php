</div>
<?php wp_footer(); ?>
<footer>
	<div class="container-fluid">
		<div class="row">
			<div class="title-footer">Elite Co., Ltd.</div>
			<div class="col-lg-8 col-sm-7 col-xs-12 no-padding">
				<div class="menu-footer">
					<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container_class' => 'footer-list' ) ); ?>
				</div>
				<div class="footer-bottom">
					Sun Bare 2017 &nbsp; |  &nbsp; 1 Glass House Building &nbsp;  |  &nbsp;Celebrate the ourdoors
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
</body>
</html>
