
/*slicknav*/
$(function(){
  $('#menu').slicknav();
})

/*sticky navbar*/

window.onscroll = function() {myFunctionStycky()};

var navbar = document.getElementById("page-header");
var sticky = 50;

function myFunctionStycky() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
    navbar.classList.add("backwhite")
  } else {
    navbar.classList.remove("sticky");
    navbar.classList.remove("backwhite")
  }
}
