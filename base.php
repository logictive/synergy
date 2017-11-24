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
  <?php
    $images = rwmb_meta( 'banner__overlay', 'size=thumbnail' );
    if ( !empty( $images ) ) :
      $image = current($images);
    ?>

    @media (min-width:992px){
      .banner__overlay {
        background-image: url(<?php echo $image['full_url']; ?>);
      }
    }
  <?php endif; ?>
  </style>
  <?php endif; ?>
  <body <?php body_class(); ?>>
    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <header id="header" class="banner <?php if (! has_post_thumbnail() ) { echo 'banner--no-image'; } ?>">
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
        get_template_part('templates/banner', get_post_type() != 'post' ? get_post_type() : get_post_format());
      ?>
    </header>
    <main class="content" role="document">
      <div class="container">
        <?php include Wrapper\template_path(); ?>
      </div>
    </main><!-- /.content -->
    <section id="endorsements" class="endorsements">
      <div class="container">
        <div class="row justify-content-center">
        <?php

          $args = array(
            'post_type'      => 'endorsement',
            'posts_per_page' => 2,
            'orderby'        => 'rand',
          );

          $endorsements = get_posts($args);

          foreach ( $endorsements as $post ) :
            setup_postdata( $post ); ?>

            <blockquote class="endorsement col-12 col-md-6">
              <div class="endorsement__inner">
                <?php the_content(); ?>
                <footer>
                  <cite><?php echo rwmb_meta( 'endorsement__cite' ); ?></cite>
                </footer>
              </div>
            </blockquote>

        <?php
          endforeach;
          wp_reset_postdata();
        ?>
        </div>
      </div>
    </section>
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
