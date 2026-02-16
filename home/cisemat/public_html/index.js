window.addEventListener('load',function(){
    new Glider(document.querySelector('.carousel_lista'),{
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: '.carousel_indicadores',
    arrows: {
    prev: '.carousel_anterior',
    next: '.carousel_siguiente'
},
responsive: [
    { 
      // screens greater than >= 775px
      breakpoint: 450,
      settings: {
        // Set to `auto` and provide item width to adjust to viewport
        slidesToShow: '3',
        slidesToScroll: '3',
        itemWidth: 150,
        duration: 0.25
      }
    },{
      // screens greater than >= 1024px
      breakpoint: 800,
      settings: {
        slidesToShow: 5,
        slidesToScroll: 5,
        
      }
    }
  ]

});
});

window.addEventListener('load', function() {

  const cookie = "no_ff";

  var noffCookie = getCookie(cookie);

  const cflag = document.getElementById("close-flag");
  /*
  if (navigator.userAgent.includes('Chrome')) {
    if(!comprobarCookie()){
      mostrarMascara(true);
      mostrarModal(true);
    }

  } 
  else */if (navigator.userAgent.includes('Firefox')) {
    if(!comprobarCookie()){
      mostrarMascara(true);
      mostrarModal(true);
    }
  }
  else{
    mostrarMascara(false);
    mostrarModal(false);
  }

  cflag.onclick = function() {
    mostrarMascara(false);
    mostrarModal(false);

    if(!comprobarCookie()){
      setCookie(cookie, "hidden", 0.5);
    }
  };


  function comprobarCookie(){
    if (noffCookie !== null) {
      return true;
    } 
    else {
      return false;
    }
  }

  function getCookie(name) {
    const cookies = document.cookie.split('; ');
    for (let i = 0; i < cookies.length; i++) {
      const cookie = cookies[i].split('=');
      if (cookie[0] === name) {
        return cookie[1];
      }
    }
    return null;
  }

  function setCookie(name, value, int) { 
    const date = new Date();
    date.setTime(date.getTime() + (int * /*24  60 * 60 **/ 1000));  // 24 = horas por dia; 60 minutos x hora 
    const expires = "expires=" + date.toUTCString();
    document.cookie = name + "=" + value + "; " + expires;
  }
  function mostrarMascara(boolean){
    if(boolean){
      document.getElementById('mascara-blur').classList.add('mostrar');
    }
    else{
      document.getElementById('mascara-blur').classList.remove('mostrar');
    }
  }

  function mostrarModal(boolean){
    if(boolean){
      document.getElementById('content-flag').classList.add('mostrar');
    }
    else{
      document.getElementById('content-flag').classList.remove('mostrar');
    }
    
  }
});