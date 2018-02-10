<?php global $domain; ?>
<section class="hero is-primary is-medium">
  <!-- Hero head: will stick at the top -->
  <div class="hero-head">
    <nav class="navbar">
      <div class="container">
        <div class="navbar-brand">
          <img onclick="location.href='<?php echo get_site_url() ?>'" class="img-responsive elite-logo" src="<?php echo get_template_directory_uri() ?>/images/icon/logo1.png" alt="">
          <span class="navbar-burger burger" data-target="navbarMenuHeroA">
            <span></span>
            <span></span>
            <span></span>
          </span>
        </div>
         <div id="navbarMenuHeroA" class="navbar-menu">
          <div class="navbar-end">
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
          </div>
        </div>
    </nav>
  </div>
</section>

