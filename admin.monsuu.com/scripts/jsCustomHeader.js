/* Set the width of the sidebar to 250*/
function openNav() {
    document.getElementById("mySidebar").style.width = "250px";
    document.getElementsByClassName("sidebar").style.backgroundImage = "url('../images/aquarelasmall.jpg')";
    document.getElementById("main").style.marginLeft = "250px";
    
  }
  
  /* Set the width of the sidebar to 0 */
  function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
   
  }
  function openoptions() {
    document.getElementById("collapse1").style.height = "50px";
    document.getElementById("collapse1").style.width = "50px";
   
  }
  
  /* Set the width of the sidebar to 0 */
  function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
   
  }

  
  // Add or remove transparency according to scrolltop

  var mainNav = document.querySelector('.navbar');
  window.onscroll = function() {
windowScroll();
};
function windowScroll() {
  mainNav.classList.toggle("scrolled", mainNav.scrollTop > 50 || document.documentElement.scrollTop > 50);
}
function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/" + "SameSite=None; Secure";
}

function init() {
if(getCookie("acceptCookies") === "yes"){
 
}
else {
  setTimeout(function(){  $(document).ready(function() {  
    $('#cookieModal').modal('show');
  }); }, 5000);
}
 
}

function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + "; " + expires;
}