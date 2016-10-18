(function($, Drupal) {

  'use strict';

  function hideOrShowMenu(context, settings, toggle) {
    var menu = $(context).find('.block-menu.menu--main ul.menu');
    if (menu.length) {
      var mobileScreen = window.matchMedia('(max-width: 760px)');
      if (mobileScreen.matches) {
        // Make sure the menu is hidden if mobile menu toggle doesn't
        // have the active class.
        if (!toggle) {
          toggle = $('.mobile-menu-icon');
        }
        if (toggle.hasClass('active')) {
          // Ensure the menu isn't hidden when the toggle is active.
          menu.removeClass('hidden');
        } else {
          menu.addClass('hidden');
        }
      } else {
        // Where the screen is wider then the maximum breakpoint make sure
        // menu menu shows.
        menu.removeClass('hidden');
      }
    }
  }

  /**
   * Initialise the menu JS.
   */
  Drupal.behaviors.menu = {
    attach: function (context, settings) {
      hideOrShowMenu(context, settings);
      $(window).resize(function() {
        hideOrShowMenu(context, settings);
      });
      $('.mobile-menu-icon').click(function() {
        if (!$(this).hasClass('active')) {
          $(this).addClass('active');
        } else {
          $(this).removeClass('active');
        }
        hideOrShowMenu(context, settings);
      });
    }
  };
})(jQuery, Drupal);
