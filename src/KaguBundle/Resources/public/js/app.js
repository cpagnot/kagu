$(document).foundation(
    //var elem = new Foundation.Sticky(element, options);

);




$(document).ready(function () {
    $(".menu-toggle").on('click', function () {
    $(this).toggleClass("on");
    $('.menu-section').toggleClass("on");
    $(".header-mobile nav ul").toggleClass('hidden');
});
     	var $menu = $('.menu-profil');
    
    $('.menu-profil a').on('click', function (e) {
        
      	var $element = $(this);
        
        $menu.find('a').removeClass('active');
        $element.addClass('active');
        
        var elOffset = $element.offset().left;
        var elWidth = $element.outerWidth(true);
        var menuScrollLeft = $menu.scrollLeft();
        var menuWidth = $menu.width();
        
        var myScrollPos = elOffset + (elWidth / 4) + menuScrollLeft - (menuWidth / 4);
        $menu.scrollLeft(myScrollPos);
        
         $('.menu-profil a.active').offset(myScrollPos);
    });
    
    

});