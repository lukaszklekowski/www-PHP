var is_open = false;
var mob_nav;
var drop_cont;
var nav;

function setUp(){

  mob_nav = document.getElementById("mob-menu-item");
  drop_cont = document.getElementById("mob-dropdown-content");
  nav = document.getElementById("nav");

  window.onscroll = changePos;

  window.onresize = resize;

  mob_nav.addEventListener("click", function(event){
    if(is_open == false){
      drop_cont.style.maxHeight = "200px";
      is_open = true;
    }else{
      drop_cont.style.maxHeight = "0px";
      is_open = false;
    }
  }, false);
}

function resize(){
  if(window.outerWidth > 640 && (window.pageYOffset<260 && window.pageYOffset>200)){
    nav.style.visibility = "hidden";
    nav.style.height = "0px";
  }
}

function changePos() {
  if (window.outerWidth>640){
    if (window.pageYOffset >= 260) {
      nav.style.visibility = "visible";
      nav.style.height = "100%";
      drop_cont.style.maxHeight = "0px";
      is_open = false;
    } else {
      nav.style.visibility = "hidden";
      nav.style.height = "0px";
    }
  }else{
    if (window.pageYOffset >= 200) {
      nav.style.visibility = "visible";
      nav.style.height = "100%";
      drop_cont.style.maxHeight = "0px";
      is_open = false;
    } else {
      nav.style.visibility = "hidden";
      nav.style.height = "0px";
    }
  }
}

setUp();
