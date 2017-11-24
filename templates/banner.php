<?php use Roots\Sage\Titles; ?>
<div class="container banner__content--wrapper">
  <div class="row">
    <?php if ( !empty( rwmb_meta( 'banner__headline' ) ) ) : ?>
      <h1 class="banner__headline col-12"><?php echo rwmb_meta( 'banner__headline' ); ?></h1>
    <?php else: ?>
      <h1 class="banner__headline col-12"><?= Titles\title(); ?></h1>
    <?php endif; ?>
    <div class="banner__content col-12 col-md-8 col-xl-6 offset-md-2 offset-xl-3">
    <?php if ( !empty( rwmb_meta( 'banner__text' ) ) ) : ?>
      <p class="banner__text"><?php echo rwmb_meta( 'banner__text' ); ?></p>
    <?php endif; ?>

    <?php if ( !empty( rwmb_meta( 'banner__button__text--primary' ) ) ) : ?>
      <div class="row">
        <div class="col-12 col-md-6">
          <a href="<?php echo rwmb_meta( 'banner__button__link--primary' ); ?>" class="btn btn-primary btn-lg banner__button btn-block banner__button--primary">
            <?php echo rwmb_meta( 'banner__button__text--primary' ); ?>
          </a>
        </div>
        <div class="col-12 col-md-6">
          <a href="<?php echo rwmb_meta( 'banner__button__link--secondary' ); ?>" class="btn btn-inverse btn-lg btn-block banner__button banner__button--secondary">
            <?php echo rwmb_meta( 'banner__button__text--secondary' ); ?>
          </a>
        </div>
      </div>
    <?php endif; ?>

    </div><!-- /.banner__content -->
  </div>
</div><!-- /.container -->