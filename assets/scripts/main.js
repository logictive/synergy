/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
        // Inline SVG import
        jQuery('img').filter(function() {
          return this.src.match(/.*\.svg$/);
        }).each(function(){
          var $img = jQuery(this);
          var imgID = $img.attr('id');
          var imgClass = $img.attr('class');
          var imgURL = $img.attr('src');

          jQuery.get(imgURL, function(data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');

            // Add replaced image's ID to the new SVG
            if(typeof imgID !== 'undefined') {
              $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if(typeof imgClass !== 'undefined') {
              $svg = $svg.attr('class', imgClass+' replaced-svg');
            }
            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');
            // Replace image with new SVG
            $img.replaceWith($svg);

          }, 'xml');
        });

        // Mobile only script
        function checkWidth() {
          if (document.documentElement.clientWidth < 768) {
            $('.nav-toggle').unbind('click').click(function() {
              $(this).toggleClass('nav-toggle--show');
              $('.nav-primary').toggleClass('nav-primary--show');
            });
          } else {
            $('.nav-toggle').removeClass('nav-toggle--show');
            $('.nav-primary').removeClass('nav-primary--show');
          }
        }
        // Execute on load
        checkWidth();
        // Bind event listener to resize
        $(window).resize(checkWidth);

        $.fn.isOnScreen = function(){
          var win = $(window);
          var viewport = {
              top : window.pageYOffset,
              left : window.pageXOffset
          };
          viewport.right = viewport.left + win.width();
          viewport.bottom = viewport.top + win.height();
          var bounds = this.offset();
          bounds.right = bounds.left + this.outerWidth();
          bounds.bottom = bounds.top + this.outerHeight();
          return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
        };

        var scroll = window.requestAnimationFrame ||
             window.webkitRequestAnimationFrame ||
             window.mozRequestAnimationFrame ||
             window.msRequestAnimationFrame ||
             window.oRequestAnimationFrame ||
             // IE Fallback, you can even fallback to onscroll
             function(callback){ window.setTimeout(callback, 1000/60); };

        var lastPosition = -1;

        // Any scroll functionality
        function loop() {
          var y_scroll_pos = window.pageYOffset;

          if(lastPosition === y_scroll_pos) {
            scroll(loop);
            return false;
          } else lastPosition = y_scroll_pos;

          var banner_offset = $('.banner').offset();
          var banner_bottom = banner_offset.top + $('.banner').height();

          if(y_scroll_pos > 50) {
            $('.page-head').addClass('page-head--overlay');
          } else {
            $('.page-head').removeClass('page-head--overlay');
          }

          if(y_scroll_pos > banner_bottom) {
            $('.back-to-top').addClass('back-to-top--show');
          } else {
            $('.back-to-top').removeClass('back-to-top--show');
          }

          /*for (var i = 0; i < videoQuantity; i++) {
            var currentElement = videoElements.eq(i);

            if ( currentElement.isOnScreen() ) {
              currentElement.get(0).play();
            } else {
              currentElement.get(0).pause();
            }
          }*/

          scroll( loop );
        }
        // Execute on load
        loop();
        // Bind event listener to scroll
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // Videos
    'videos': {
      init: function() {
        // JavaScript to be fired on the videos page
        var currentVideo = 0;

        function replaceVideo(replacement) {
          var videoPanel = $('.video-panel .video');
          var videoId = replacement.attr('data-embed');

          replacement.addClass('video--loading');

          videoPanel.find('.video__embed iframe').remove();
          videoPanel.find('.video__embed__inner').html('<iframe frameborder="0" src=\"//www.youtube.com/embed/'+videoId+'?autoplay=1"></iframe>');

          videoPanel.find('.video__meta__title').html(replacement.find('.video__meta__title').html());
          videoPanel.find('.video__meta__desc').html(replacement.find('.video__meta__desc').html());

          currentVideo = parseInt(replacement.attr('class').split(' ')[1].substr(-1));
          console.log(currentVideo);

          replacement.removeClass('video--loading').addClass('video--playing').siblings().removeClass('video--playing');
        } 
        
        $('.video-playlist').on('click', '.video:not(.video--playing)', function() {
          replaceVideo($(this));
        });

        $('.video__meta__controls--prev').click(function(e) {
          var targetVideo = currentVideo - 1;
          var videoCount = $('.video-playlist .video').length;

          if (targetVideo < 0) {
            targetVideo = videoCount - 1;
          }

          replaceVideo( $('.video-playlist .video-' + targetVideo) );

          // TODO: jump to video in list
        });

        $('.video__meta__controls--next').click(function(e) {
          var targetVideo = currentVideo + 1;
          var videoCount = $('.video-playlist .video').length;
          console.log(targetVideo);

          if (targetVideo > videoCount - 1) {
            targetVideo = 0;
          }

          replaceVideo( $('.video-playlist .video-' + targetVideo) );

          // TODO: jump to video in list
        });
      },
      finalize: function() { 
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // News page
    'news': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {

      }
    },
  };



  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
