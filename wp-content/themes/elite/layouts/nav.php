<?php global $domain; ?>
 <script>
      (function(){
        var msls = '<?php echo the_msls(); ?>';
        var currentUrl = '<?php echo !is_home()? get_permalink($post->ID) : get_home_url(); ?>';
        $('document').ready(function () {
            var href = $(msls).attr("href");
            $("#navbarMenuHeroA .navbar-end #lang-switcher").attr("href", href);
            $(".nav li#lang-switcher").on("click", function () {
                window.location.replace(href);
            });
            // console.log(href );
            <?php if (check_msls() === 'th'): ?>
                $("#xs-eng-lang").attr("href", href);
                $("#xs-th-lang").attr("href", currentUrl);
            <?php else: ?>
                $("#xs-eng-lang").attr("href", currentUrl);
                $("#xs-th-lang").attr("href", href);
            <?php endif; ?>
        });
      })(jQuery);
  </script>
<section class="hero is-primary is-medium">
  <!-- Hero head: will stick at the top -->
  <div class="hero-head">
    <nav class="navbar">
      <div class="container">
        <div class="navbar-brand">
          <img onclick="location.href='<?php echo get_site_url() ?>'" class="img-responsive elite-logo" src="<?php echo get_template_directory_uri() ?>/images/icon/logo1.png" alt="">
          
        </div>
         <div id="navbarMenuHeroA" class="navbar-menu">
          <div class="navbar-end is-hidden-touch">
            <?php $header_menu = wp_get_menu_array('Header Menu');?>
            <?php foreach ($header_menu as $menu): 
                if(!empty($menu['children'])): ?>
                <div class="navbar-item has-dropdown">
                  <a class="navbar-link" href="<?php echo $menu['url']?>" >
                    <?php echo $menu['title']?>
                  </a>

                  <div class="navbar-dropdown is-boxed">
                    <?php foreach ($menu['children'] as $key => $value): ?>
                      <a class="navbar-item" href="<?php echo $value['url'] ?>">
                        <?php echo $value['title'] ?>
                      </a>     
                     <?php endforeach; ?>  
                  </div>
                </div>
            <?php else: ?>
              <a class="navbar-item" href="<?php echo $menu['url']?>">
                <?php echo $menu['title']; ?>
              </a>
            <?php endif; 
            endforeach; ?>
            <a href="" id="lang-switcher"  style="cursor: pointer; cursor: hand;" class="navbar-item lang hidden-xs hidden-sm"><p><?php echo check_msls() == 'us' ? 'EN' : 'TH'; ?></p></a>
            <div class="line-solid"></div>
            <a id="xs-eng-lang" class="visible-xs visible-sm navbar-item" href="">English</a>
            <a id="xs-th-lang" class="visible-xs visible-sm navbar-item" href="">ภาษาไทย</a>
          </div>
          <div class="navbar-end is-hidden-desktop">
            <?php $header_menu = wp_get_menu_array('Footer Menu');?>
            <?php foreach ($header_menu as $menu): 
                if(!empty($menu['children'])): ?>
                <div class="navbar-item has-dropdown">
                  <a class="navbar-link" href="<?php echo $menu['url']?>" >
                    <?php echo $menu['title']?>
                  </a>

                  <div class="navbar-dropdown is-boxed">
                    <?php foreach ($menu['children'] as $key => $value): ?>
                      <a class="navbar-item" href="<?php echo $value['url'] ?>">
                        <?php echo $value['title'] ?>
                      </a>     
                     <?php endforeach; ?>  
                  </div>
                </div>
            <?php else: ?>
              <a class="navbar-item" href="<?php echo $menu['url']?>">
                <?php echo $menu['title']; ?>
              </a>
            <?php endif; 
            endforeach; ?>
            <a href="" id="lang-switcher"  style="cursor: pointer; cursor: hand;" class="navbar-item lang hidden-xs hidden-sm"><p><?php echo check_msls() == 'us' ? 'EN' : 'TH'; ?></p></a>
            <div class="line-solid"></div>
            <a id="xs-eng-lang" class="visible-xs visible-sm navbar-item" href="">English</a>
            <a id="xs-th-lang" class="visible-xs visible-sm navbar-item" href="">ภาษาไทย</a>
          </div>
        </div>
        <span class="navbar-burger burger" id='navbar-burger' data-target="navbarMenuHeroA">
            <span></span>
            <span></span>
            <span></span>
          </span>
    </nav>
  </div>
</section>