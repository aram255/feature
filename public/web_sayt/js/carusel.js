// Own Carousel
$("#customer-testimonals").owlCarousel({
   loop: true,
   center: true,
   items: 3,
   dots: true,
   nav: true,
   autoplayTimeout: 2000,
   smartSpeed: 450,
   margin: 35,
   nav: false,
   lazyLoad: true,
   responsiveClass: true,
   navigation: true,
   slideSpeed: 300,
   paginationSpeed: 200,
   singleItem: true,
   stopOnHover: true,
   responsive: {
      0: {
         items: 1,
      },
      600: {
         items: 2,
      },
      1000: {
         items: 2,
      },
      1200: {
         items: 3,
      }
   },
});