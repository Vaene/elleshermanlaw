/* --------------------------------------------- 
* Filename:     custom.js
* Version:      1.0.0 (2019-03-09)
* Website:      http://www.zymphonies.com
* Description:  Global Script
* Author:       Zymphonies Team
                info@zymphonies.com
-----------------------------------------------*/

function theme_menu(){

	jQuery('#main-menu').addClass('').smartmenus({
		showOnClick:true,
	});
	
	//Mobile menu toggle
	jQuery('.navbar-toggle, .primary-menu .close-btn').click(function(){
		jQuery('.primary-menu').toggleClass('menu-slide-left');
		jQuery('.main-body').toggleClass('body-slide-left');
	});

	//Search toggle
	jQuery('.toggle-search').click(function(){
		jQuery('.search-static').show();
	});

	jQuery('.search-static .close-btn').click(function(){
		jQuery('.search-static').hide();
	});

	//Mobile dropdown menu
	if ( jQuery(window).width() < 767) {
		jQuery(".region-primary-menu li a:not(.has-submenu)").click(function () {
			jQuery('.region-primary-menu').hide();
	    });
	}

 	// primary-menu 
	jQuery('.primary-menu .region-primary-menu a').click(function() {
      if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
          var target = jQuery(this.hash);
          target = target.length ? target : jQuery('[name=' + this.hash.slice(1) + ']');
          if (target.length) {
              jQuery('html,body').animate({
                  scrollTop: target.offset().top
              }, 1000);
              return false;
          }
      	}
  	});

  	jQuery('.parallax-window').parallax({});

	wow = new WOW({
		boxClass:     'wow',      // default
		animateClass: 'animated', // default
		offset:       0,          // default
		mobile:       true,       // default
		live:         true        // default
    })
    wow.init();

}

function theme_home(){
	
	//flexslider
	jQuery('.flexslider').flexslider({
    	animation: "slide"	
    });

}

jQuery(document).ready(function($){
	theme_menu();
	theme_home();
});