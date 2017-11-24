<section id="events" class="events">
  <div class="container">
    <h2>Upcoming Events</h2>
    <div class="row">
    <?php
      $format_first = '<div class="event event--featured {no_image}event--no-image{/no_image} col-12 col-md-4 ">
          <a href="#_EVENTURL" class="event__inner">
            {has_image}
            <div class="event__image">#_EVENTIMAGE</div>
            {/has_image}
            <header class="event__meta">
              <div class="event__date">
                <span class="event__date--day">#_{j}</span>
                <span class="event__date--month">#_{M}</span>
              </div>
              <div class="event__time">#_12HSTARTTIME</div>
            </header>
            <h3 class="event__title">#_EVENTNAME</h3>
          </a>
        </div>';

      $format_rest = '<div class="event col-6 col-md-2">
          <a href="#_EVENTURL" class="event__inner">
            <header class="event__meta">
              <div class="event__date">
                <span class="event__date--day">#_{j}</span>
                <span class="event__date--month">#_{M}</span>
              </div>
              <div class="event__time">#_12HSTARTTIME</div>
            </header>
            <h3 class="event__title">#_EVENTNAME</h3>
          </a>
        </div>';

      if (class_exists('EM_Events')) {
        echo EM_Events::output( array('limit'=>1,'orderby'=>'event_start_date','format'=>$format_first) );
      }
      if (class_exists('EM_Events')) {
        echo EM_Events::output( array('limit'=>4,'offset'=>1,'orderby'=>'event_start_date','format'=>$format_rest) );
      }
    ?>
    </div>
    <a href="<?php echo home_url( '/events/' ); ?>" class="btn events__btn">More Events</a>
  </div>

</section>
<section id="about" class="about">
  <div class="container">
    <div class="row">
      <div class="about__info col-12 col-md-7">
        <?php echo rwmb_meta( 'about__text' ); ?>
      </div>
      <div class="col-12 col-md-5">
        <div class="about__join">
          <?php echo rwmb_meta( 'join__text' ); ?>
          <a class="btn btn-secondary" href="<?php echo rwmb_meta( 'join__button--url' ); ?>">
            <?php echo rwmb_meta( 'join__button--text' ); ?>
          </a>
        </div>
        <div class="about__sponsor">
          <h2>Our Sponsor</h2>
        <?php
          $images = rwmb_meta( 'sponsor__logo', 'size=thumbnail' );
          if ( !empty( $images ) ) :
            reset($images);
            $image = current($images);
        ?>
          <a href="<?php echo rwmb_meta( 'sponsor__link' ); ?>">
            <?php echo wp_get_attachment_image($image['ID'], 'medium'); ?>
          </a>
        <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="videos" class="videos">
  <div class="container">
    <div class="row">
      <div class="video col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2">
        <div class="video__inner">
          <?php echo rwmb_meta( 'video__embed', 'type=oembed' ); ?>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <a href="" class="btn">More Videos</a>
    </div>
  </div>
</section>
<section id="endorsements" class="endorsements">
  <div class="container">
    <h2>Endorsements</h2>
    <div class="row justify-content-center">
    <?php

      $args = array(
        'post_type'      => 'endorsement',
        'posts_per_page' => 3,
        'orderby'        => 'rand',
      );

      $endorsements = get_posts($args);

      foreach ( $endorsements as $post ) :
        setup_postdata( $post ); ?>

        <blockquote class="endorsement col-12 col-md-4">
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