<div class="page-head">
  <div class="container page-head__inner">
    <a class="brand" href="<?= esc_url(home_url('/')); ?>"><img class="brand__logo" src="<?php echo get_stylesheet_directory_uri(); ?>/dist/images/synergy-logo.svg"></a>
    <div class="nav-toggle">
      <div class="nav-toggle__box">
        <div class="nav-toggle__inner"></div>
      </div><!-- /.nav-toggle__box -->
    </div><!-- /.nav-toggle -->
    <nav class="nav-primary">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'container' => false ]);
      endif;
      ?>
    </nav>
    <ul class="page-head__social">
      <li class="page-head__social--youtube">
        <a href="#" aria-label="YouTube">
          <i class="fa fa-youtube-play" aria-hidden="true"></i>
        </a>
      </li>
      <li class="page-head__social--facebook">
        <a href="#" aria-label="Facebook">
          <i class="fa fa-facebook" aria-hidden="true"></i>
        </a>
      </li>
      <li class="page-head__social--twitter">
        <a href="#" aria-label="Twitter">
          <i class="fa fa-twitter" aria-hidden="true"></i>
        </a>
      </li>
    </ul>
  </div>
</div>