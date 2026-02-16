const formulario=document.getElementById("formulario");
var nombres=document.getElementById("nombres");
const rfcInformacion=document.getElementById("rfcInformacion");
let registrate=document.getElementById("registrate");
const inputs=document.querySelectorAll("#formulario");


const campos={
	nombres: false,
	apellidos: false,
	correoElectronico: false,
	rfc: false,
	captcha:false,
	accept: false
}

//Funcion Validar formularios.

const validarFormulario = (e) => {

	switch (e.target.name) {
		case "nombres":
			validarCampo(expresiones.nombres,e.target,"nombres");
		break;
		case "apellidos":
			validarCampo(expresiones.apellidos,e.target,"apellidos");
		break;
		case "correoElectronico":
			validarCampo(expresiones.correo,e.target,"correoElectronico");
		break;
		case "rfc":
			validarCampo(expresiones.rfc,e.target,"rfc");
		break;
	}
}

const quitarFormato = (expresion, input, campo) => {
	document.getElementById(campo).classList.remove('is-invalid');
	document.getElementById(campo).classList.add('is-valid');
	document.getElementById(`formulario_informacion_${campo}`).classList.remove('formulario_input-error-activo');
	document.getElementById(`formulario_informacion_${campo}`).classList.add('formulario_input-error');
	document.getElementById(campo).classList.add('is-invalid');
	document.getElementById(`formulario_informacion_${campo}`).classList.add('formulario_input-error-activo');
}

const validarCampo = (expresion, input, campo) => {
	if(expresion.test(input.value)){
		document.getElementById(campo).classList.remove('is-invalid');
		document.getElementById(campo).classList.add('is-valid');
		document.getElementById(`formulario_informacion_${campo}`).classList.remove('formulario_input-error-activo');
		document.getElementById(`formulario_informacion_${campo}`).classList.add('formulario_input-error');
		campos[campo]=true;
	}else{
		document.getElementById(campo).classList.add('is-invalid');
		document.getElementById(`formulario_informacion_${campo}`).classList.add('formulario_input-error-activo');
		campos[campo]=false;
		registrate.disabled=true;
	}
}

//Funciones de validación de carácteres 
function validarNombres(e){
	if (e.charCode >= 65 && e.charCode <= 90 || e.charCode >= 97 && e.charCode <= 122 || e.charCode ==32 || e.charCode == 164 || e.charCode == 165){
		return true;
	}else{
		return false;
	}	
}

function validarApellidos(e){
	if (e.charCode >= 65 && e.charCode <= 90 || e.charCode >= 97 && e.charCode <= 122 || e.charCode ==32 || e.charCode == 164 || e.charCode == 165){
		return true;
	}else{
		return false;
	}	
}

function validarCorreo(e){
	if (e.charCode >= 48 && e.charCode <= 57 || e.charCode >= 64 && e.charCode <= 90 || e.charCode >= 97 && e.charCode <= 122 || e.charCode ==46 || e.charCode ==95 || e.charCode ==45){
		return true;
	}else{
		return false;
	}	
}

function validarRfc(e){
	if (e.charCode >= 48 && e.charCode <= 57 || e.charCode >= 65 && e.charCode <= 90 || e.charCode >= 97 && e.charCode <= 122){
		return true;
	}else{
		return false;
	}	
}

//Función para pasar minúsculas a mayúsculas.
function minusculaAMayuscula(e){
	//Guarda el valor de los input en un texto para hacerlo mayúscula.
	const texto=e.target.value;
	e.target.value=texto.toUpperCase();
}

//Listeners
//Listener para cambiar de minúscula a mayúscula.
inputs.forEach((input)=>{
	input.addEventListener("keyup",minusculaAMayuscula);
	input.addEventListener("keyup",validarFormulario);
});

function habilitarBoton() {
    if (campos.nombres && campos.apellidos && campos.correoElectronico && campos.rfc && campos.captcha && campos.accept) {
        registrate.disabled = false;
    } else {
        registrate.disabled = true;
    }
}


function validarCaptcha() {
    campos.captcha = true;
    campos.accept = document.getElementById('accept-checkbox').checked;
    habilitarBoton();
}


document.getElementById('accept-checkbox').addEventListener('change', function () {
    campos.accept = this.checked;
    validarCaptcha();  // Verifica el estado del captcha al cambiar el checkbox
});

formulario.addEventListener("keyup", (e) => {
    e.preventDefault();
    habilitarBoton();
});

document.getElementById('accept-checkbox').addEventListener('change', function () {
    campos.accept = this.checked;
    habilitarBoton();
});



//Expresiones regulares para comprobar la escritura de los formularios.
const expresiones = {
	//  nombres: /^[a-z-A-Z]\w*\s?[a-z-A-Z]{2,90}\w*$/, //Solo recibe Letras, un espacio opcional y letras. Ej. (Miguel Angel).
	//apellidos: /^[a-z-A-Z]\w*\s?[a-z-A-Z]{4,90}\w*$/,
	nombres:/^[a-z-A-ZñÑ]\w*(\s?[a-z-A-ZñÑ]{4,90}\w*){0,5}$/, //Solo recibe Letras, un espacio opcional y letras. Ej. (Miguel Angel).
	apellidos:/^[a-z-A-ZñÑ]\w*(\s?[a-z-A-ZñÑ]{4,90}\w*){0,5}$/, //Solo recibe Letras, un espacio opcional y letras. Ej. (Gonzales Pineda).
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/, //Recibe texto en formato correo. Ej. ejemplo@ejemplo.com
	rfc: /^.{5,30}$/ // 4 a 30 digitos.
}

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

//Aviso de privacidad emergente

  document.getElementById('privacy-link').addEventListener('click', function() {
	console.log('trigger!');
	document.getElementById('mascara-privacidad').style.opacity = 1;
	document.getElementById('mascara-privacidad').style.zIndex = 1;
	document.getElementById('privacy-notice').style.display = 'block';
	document.body.style.overflow = 'hidden';
  });
  
  document.getElementById('accept-btn').addEventListener('click', function() {
	// Marcar el checkbox al hacer clic en el botón "Aceptar"
	document.getElementById('accept-checkbox').checked = true;
  
	document.getElementById('mascara-privacidad').style.opacity = 0;
	document.getElementById('mascara-privacidad').style.zIndex = -1;
	document.getElementById('privacy-notice').style.display = 'none';
	document.body.style.overflow = 'auto';
  });
  
 