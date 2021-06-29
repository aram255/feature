$('.my-appointments__title-li').click(function () {
   $('.my-appointments__title-li').removeClass('active');
   $(this).addClass('active');
   if (!($('.my-appointments__complete-process')[0].classList[1] == 'd-none')) {
      $('.my-appointments__complete-process').first().addClass('d-none')
      $('.my-appointments__complete-process').last().removeClass('d-none')
   } else {
      $('.my-appointments__complete-process').last().addClass('d-none')
      $('.my-appointments__complete-process').first().removeClass('d-none')
   }
});