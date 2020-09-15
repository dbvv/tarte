// Add your custom JS here.
(function ($) {
  $('.frontpage-carousel-products ul.products').addClass('owl-carousel').owlCarousel({
    items: 4,
    nav: true,
    dots: false,
    arrows: true,
    responsive: {
      0: {
        items: 1,
      },
      576: {
        items: 2,
      },
      960: {
        items: 3,
      },
      1024: {
        items: 4,
      },
    },
  }); // end frontpage bestsellers carousel

  $( "form.checkout" ).on( "click", "input.qty", function( e ) {
    updateCart();
  });

  function updateCart() {
    var data = {
      action: 'update_order_review',
      security: wc_checkout_params.update_order_review_nonce,
      post_data: $( 'form.checkout' ).serialize(),
    };

    jQuery.post( '/wp-admin/admin-ajax.php', data, function( response )
      {
        $( 'body' ).trigger( 'update_checkout' );
      });

  }

  $('button.navbar-toggler, button.mobile-nav__close-button').on('click', function (e) {
    $('.mobile-nav').toggleClass('open');
    $('body').toggleClass('stop-scroll');
  });
})(jQuery);

