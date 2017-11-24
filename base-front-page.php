<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <?php if ( has_post_thumbnail() ) : ?>
  <style>
    .banner::before {
      background-image: url(<?php the_post_thumbnail_url( 'medium' ); ?>);
    }
    @media (min-width:768px){
      .banner::before {
        background-image: url(<?php the_post_thumbnail_url( 'large' ); ?>);
      }
    }
    @media (min-width:992px){
      .banner::before {
        background-image: url(<?php the_post_thumbnail_url( 'full' ); ?>);
      }
    }
  </style>
  <?php endif; ?>
  <body <?php body_class(); ?>>
    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <header id="header" class="banner">
      <?php
        $videos = rwmb_meta( 'banner__video' );
        if ( !empty( $videos ) ) :
          $video = current($videos);
        ?>
        <div class="banner__video__wrap">
          <video playsinline autoplay muted loop poster="" class="banner__video">
            <source src="<?php echo $video['src']; ?>" type="video/mp4">
          </video>
        </div>
      <?php endif; ?>
      <?php
        do_action('get_header');
        get_template_part('templates/header');
        get_template_part('templates/banner', 'home');
      ?>
    </header>
    <main class="content" role="document">
      <?php include Wrapper\template_path(); ?>
    </main><!-- /.content -->
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
