$(document).ready(function(){
    var case_carousel = $('.case-carousel').owlCarousel({
        loop:true,
        items: 1,
        margin:10,
        nav:false,
        dots: false
    });

    $('.cases-list .next-btn').click(function () {
        case_carousel.trigger('next.owl.carousel');
    });
    $('.cases-list .prev-btn').click(function () {
        case_carousel.trigger('prev.owl.carousel');
    });

    var review_carausel = $('.review-carousel').owlCarousel({
        loop:true,
        items: 1,
        margin:10,
        nav:false,
        dots: false
    });

    $('.reviews-list .next-btn').click(function () {
        review_carausel.trigger('next.owl.carousel');
    });
    $('.reviews-list .prev-btn').click(function () {
        review_carausel.trigger('prev.owl.carousel');
    });
});  
