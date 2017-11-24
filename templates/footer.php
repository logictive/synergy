<p class="back-to-top"><a href="#header" class="btn btn-secondary" title="Back to Top">Back to Top</a></p>
<footer class="content-info">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-4 content-info__company">
        <img class="content-info__logo" src="<?php echo get_stylesheet_directory_uri(); ?>/dist/images/synergy-logo.svg">
        <ul class="content-info__social">
          <li class="social__icon social__icon--youtube"><a href="#" aria-label="YouTube"><i class="fa fa-youtube-play"></i></a></li>
          <li class="social__icon social__icon--facebook"><a href="#" aria-label="Facebook"><i class="fa fa-facebook"></i></a></li>
          <li class="social__icon social__icon--twitter"><a href="#" aria-label="Twitter"><i class="fa fa-twitter"></i></a></li>
        </ul>
      </div>
      <div class="col-12 col-md-8 nav-footer">
        <?php
            if (has_nav_menu('footer_navigation')) :
              wp_nav_menu(['theme_location' => 'footer_navigation', 'menu_class' => 'nav']);
            endif;
          ?>
      </div>
    </div>
    <div class="row">
      <p class="copyright col-12 col-md-6">&copy; Copyright Synergy <?php echo date("Y"); ?></p>
      <p class="logictive col-12 col-md-6">Website by <a href="http://www.logictive.co.uk">Logictive</a></p>
    </div>
  </div>
</footer>