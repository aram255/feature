// Own Carousel
$("#customer-testimonals").owlCarousel({
    loop: true,
    items: 2,
    dots: true,
    autoplayTimeout: 2000,
    smartSpeed: 450,
    margin: 50,
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
        768: {
            items: 2,
        }
    },
});
$(".service_carousel").owlCarousel({
    loop: true,
    items: 3,
    dots: true,
    autoplayTimeout: 2000,
    smartSpeed: 450,
    margin: 50,
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
        768: {
            items: 2,
        },
        1200: {
            items: 3,
        }
    },
});
