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
            <a class="navbar-item is-active">
              Home
            </a>
            <a class="navbar-item">
              About
            </a>
            <a class="navbar-item">
              Our work
            </a>
            <a class="navbar-item">
              Corperation Clients
            </a>
            <a class="navbar-item">
              Contact
            </a>
          </div>
        </div>
      </div>
    </nav>
  </div>
</section>

