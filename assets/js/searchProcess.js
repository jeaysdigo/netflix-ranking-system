$(document).ready(function () {
    // Add hover effect to card
    $('.card').hover(function () {
      $(this).find('.card-body').removeClass('d-none');
      $(this).addClass('card-hovered');
    }, function () {
      $(this).find('.card-body').addClass('d-none')
      $(this).removeClass('card-hovered');
    });
    $('.card').hover(function () {
      $(this).find('.card-body').css('background-color', 'rgba(0, 0, 0, 0.7)');
    });
    $('.accordion-trigger').click(function () {
      $('.accordion-content').show();

    });
    $('#filter').click(function () {
      $('.displayCards').removeClass('col-md-12').addClass('col-md-4', 1000);
    });
    $('#filter2').click(function () {
      $('.displayCards').removeClass('col-md-4').addClass('col-md-12', 1000);
    });
  });