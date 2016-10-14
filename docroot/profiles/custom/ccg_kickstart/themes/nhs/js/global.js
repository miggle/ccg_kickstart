// Global JS

(function($){ 

  $(function() {

    $('body').addClass('hasJS');

    // Check we have items to build an accordion
    if( $('ul.accordion li').length > 0 ) {

      // Wrap our LI & hide it
      $('ul.accordion li').each(function() {
        $(this).contents(':not(strong:first-child)').wrapAll('<div class="inner-data hidden" />');
      });

      // Toggle LI content display
      $('ul.accordion li strong:first-child').bind('click', function() {
        $(this).parent().siblings('li').removeClass('expand').children('.inner-data').slideUp(300);
        $(this).parent().toggleClass('expand');
        $(this).next('.inner-data').slideToggle(300);
      });
    }

    /*
     * Pull in FS widget
     */
    if( $.fsNHSWidget ) {
      $('#block-boxes-fs-widget-home-block').fsNHSWidget([1,2,4]);
    }

  });
 
})(jQuery);