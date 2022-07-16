$("#closeBtn").click(() => {
  var menuChecked = $("nav input[name='toggle-nav']");
  (menuChecked).attr('checked', false)
})

// onscroll animate
wow = new WOW(
  {
    boxClass: 'wow',
    animateClass: 'animated',
    offset: 100
  }
);
wow.init();

//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () { scrollFunction() };

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

// sticky menu scrollspy
$('body').scrollspy({ target: '#navbar-example2' })


var nav = $('.stickyMenuSec');
if (nav.length) {
  var bottom = $('.stickyMenuSec').offset().top;
}

$(window).scroll(function () {
  if ($(this).scrollTop() > bottom) {
    $('.stickyMenuSec').addClass('fixed');
  }
  else {
    $('.stickyMenuSec').removeClass('fixed');
  }
});