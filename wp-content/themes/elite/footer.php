</div>
<?php wp_footer(); ?>
<footer>
	<div class="container-fluid">
		<div class="row">
			<div class="title-footer">Sunbare Co., Ltd.</div>
			<div class="col-lg-8 col-sm-7 col-xs-12 no-padding">
				<div class="menu-footer">
					<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container_class' => 'footer-list' ) ); ?>
				</div>
				<div class="footer-bottom">
					Sun Bare 2017 &nbsp; |  &nbsp; 1 Glass House Building &nbsp;  |  &nbsp;Celebrate the ourdoors
				</div>
			</div>
			<div class="col-lg-4 col-sm-5 col-xs-12 no-padding footer-right">
				<div class="buttom-footer">
					<div class="button-right">
						<input type="text"  name="sign-up" placeholder="sign up for our newsletter">
		                <a href="" class="btn btn-border" type="submit"> submit </a>	
		            </div>
	                 <img class="img-responsive" src="<?php echo get_template_directory_uri() ?>/images/icon/bear.png" alt="">                
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
