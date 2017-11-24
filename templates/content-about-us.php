<section class="about__background">
  <div class="row">
    <div class="col-12 col-md-8 col-lg-6">
      <?php the_content(); ?>
    </div>
    <div class="about__background__image col-12 col-md-4 col-lg-6">
      <?php
          $images = rwmb_meta( 'side__image', 'size=medium' );
          if ( !empty( $images ) ) :
            reset($images);
            $image = current($images);
        ?>
          <?php echo wp_get_attachment_image($image['ID'], 'medium'); ?>
        <?php endif; ?>
    </div>
  </div>
</section>

<section class="about__join">
  <div class="row">
    <div class="col-12 col-md-8 col-lg-6 push-md-4 push-lg-6">
      <?php echo rwmb_meta( 'join__text' ); ?>
    </div>
    <div class="about__join__image col-12 col-md-4 col-lg-6 pull-md-8 pull-lg-6">
      <?php
          $images = rwmb_meta( 'join__image', 'size=medium' );
          if ( !empty( $images ) ) :
            reset($images);
            $image = current($images);
        ?>
          <?php echo wp_get_attachment_image($image['ID'], 'medium'); ?>
        <?php endif; ?>
    </div>
  </div>
</section>

<section class="about__people">
  <div class="row justify-content-center">
 <?php

  $args = array(
    'post_type'      => 'people',
    'posts_per_page' => -1,
  );

  $people = get_posts($args);

  foreach ( $people as $post ) :
    setup_postdata( $post ); ?>
  
  <div class="person col-12 col-md-6">
    <h2 class="person__title"><?php echo rwmb_meta( 'people__role' ); ?></h2>
    <div class="row">
      <div class="person__image col-12 col-lg-4"><?php the_post_thumbnail('thumbnail'); ?></div>
      <div class="person__bio col-12 col-lg-8">
        <h3 class="person__title"><?php the_title(); ?></h3>
        <?php the_content(); ?>
      </div>
    </div>
  </div>

  <?php
    endforeach;
    wp_reset_postdata();
  ?>
  </div>
</section>
