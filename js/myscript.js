(function($) {

	"use strict";

	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	$('#sidebarCollapse').on('click', function () {
      $('#sidebar').toggleClass('active');
  });

})(jQuery);


// ======================= NAV FIXED ON SCROLL ===========

function scrolldiv(){
	var header = document.getElementById('topnavid');
		header.classList.toggle("sticky", scrollY > 0);
	}

