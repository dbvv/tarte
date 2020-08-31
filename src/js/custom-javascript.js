// Add your custom JS here.
(function ($) {
  $('body').on('added_to_cart', function (event, hash, e, a) {
    setTimeout(function () {
        $(a).removeClass('added');
    }, 3000)
  });

  $('.search a').on('click', function (e) {
    e.preventDefault();
    console.log('Search clicked');
    $('.search-area').toggleClass('open');
    document.getElementById("search-input").focus();
  });

  window.toggleSearch = function () {
    $('.search-area').toggleClass('open');
  }

  var $searchInput = $('#search-input');
  var searchInputIntervalTimer;
  $searchInput.on('keyup', function () {
    clearTimeout(searchInputIntervalTimer);
    var value = $searchInput.val();
    searchInputIntervalTimer = setTimeout(function() {
        search(value);
    }, 1000);
  });
  $searchInput.on('keydown', function () {
    clearTimeout(searchInputIntervalTimer);
  })
  function search(value) {
    console.log('value', value);
    $.ajax({
      url: '/wp-admin/admin-ajax.php',
      method: 'POST',
      data: {
        action: 'glossier_search',
        search: value,
      },
      success: function (response) {
        $('.search-results').html(response);
      },
    })
  }

  $('.frontpage-bestsellers ul.products').addClass('owl-carousel').owlCarousel({
    items: 4,
    nav: true,
    dots: false,
    arrows: true,
    responsive: {
      0: {
        items: 1,
      },
      560: {
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

$( "form.checkout" ).on( "change", "input.qty", function( e ) {
    updateCart();
  });
$( "form.checkout" ).on( "click", "input.qty", function( e ) {
    //updateCart();
  });

  function updateCart() {
    var data = {
      action: 'update_order_review',
      security: wc_checkout_params.update_order_review_nonce,
      post_data: $( 'form.checkout' ).serialize()
    };

    jQuery.post( '/wp-admin/admin-ajax.php', data, function( response )
      {
        $( 'body' ).trigger( 'update_checkout' );
      });

  }

})(jQuery);

