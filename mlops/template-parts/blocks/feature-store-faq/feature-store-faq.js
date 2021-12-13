jQuery('.accordion-ul li > h3').on('click', function(){
    jQuery(this).parents('li').toggleClass('open');
    jQuery(this).next('div').slideToggle();
});