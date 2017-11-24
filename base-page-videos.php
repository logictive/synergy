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
      <?php include Wrapper\template_path(); ?>
    </main><!-- /.content -->
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
    <script>

      var channelId = '<?php echo rwmb_meta( 'youtube-id' ); ?>';

      (function($) {
        $.get(
          'https://www.googleapis.com/youtube/v3/channels', {
            part: 'contentDetails',
            id: channelId,
            key: 'AIzaSyCXdYP0tFF2188e5VLOGBJsQ2sq7OalhVA'
          }, function(data) {
            $.each(data.items, function(i, item) {
              pid = item.contentDetails.relatedPlaylists.uploads;
              getVideos(pid);
            });
          }
        );
        function getVideos(pid) {
          $.get(
            'https://www.googleapis.com/youtube/v3/playlistItems', {
              part: 'snippet',
              maxResults: 25,
              playlistId: pid,
              key: 'AIzaSyCXdYP0tFF2188e5VLOGBJsQ2sq7OalhVA'
            }, function(data) {
              $.each(data.items, function(i, item) {
                console.log(item);
                videoTitle = item.snippet.title;
                videoDesc = item.snippet.description;
                videoThumb = item.snippet.thumbnails.medium.url;
                videoId = item.snippet.resourceId.videoId;
                videoHeight = item.snippet.thumbnails.medium.height;
                videoWidth = item.snippet.thumbnails.medium.width;

                if ( i === 0 ) {
                  var videoPanel = $('.video-panel .video');
                  videoPanel.find('.video__embed__inner').html('<iframe frameborder="0" src=\"//www.youtube.com/embed/'+videoId+'" height="'+videoHeight+'" width="'+videoWidth+'"></iframe>');
                  videoPanel.find('.video__meta__title').html(videoTitle);
                  videoPanel.find('.video__meta__desc').html(videoDesc);

                  output = '<div class="video video-0 video--playing" data-embed="'+videoId+'">';
                } else {
                  output = '<div class="video video-'+i+'" data-embed="'+videoId+'">';
                }

                output += '<img class="video__thumb" src="'+videoThumb+'">';
                output += '<div class="video__meta">';
                output += '<h3 class="video__meta__title">'+videoTitle+'</h3>';
                output += '<div class="video__meta__desc">'+videoDesc+'</div';
                output += '</div></div>';

                $('.video-playlist').append(output);

              });
            }
          );
        }
      })(jQuery);
    </script>
  </body>
</html>
