jQuery('[data-slick]').slick();

jQuery('.resource-carousel-slider').slick({
slidesToShow: 5,
slidesToScroll: 1,
responsive: [
    {
    breakpoint: 1400,
    settings: {
        slidesToShow: 4,
    }
    },
    {
    breakpoint: 1200,
    settings: {
        slidesToShow: 3,
    }
    },
    {
    breakpoint: 900,
    settings: {
        slidesToShow: 2,
    }
    },
    {
    breakpoint: 600,
    settings: {
        slidesToShow: 1,
    }
    }
]
});