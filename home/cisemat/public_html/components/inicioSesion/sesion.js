const formulario=document.getElementById("formulario");
const inputs=document.querySelectorAll("#formulario");
//Inputs
var contrasena=document.getElementById("contrasena");
var correoElectronico=document.getElementById("correoElectronico");
//Botones 
var iniciaSesion=document.getElementById("iniciaSesion");
var mostrarContrasena=document.getElementById("mostrarContrasena");


const campos={
	correoElectronico: false,
	contrasena: false,
	contrasenaVisible: false
}


//Función para ver contraseña.
mostrarContrasena.addEventListener("click", function(){
	if(campos.contrasenaVisible){
		contrasena.type="password";
		campos.contrasenaVisible=false;
		document.getElementById("mostrarContrasena").src="../../src/eye_hide.png";
		
	}else{
		contrasena.type="text";
		campos.contrasenaVisible=true;
		document.getElementById("mostrarContrasena").src="../../src/eye_show.png";
	}
});

//Funcion Validar formularios.

const validarFormulario = (e) => {
	switch (e.target.name) {
		case "correoElectronico":
			validarCampo(expresiones.correo,e.target,"correoElectronico");
		break;
		case "contrasena":
			contrasenaLlena();
		break;
	}
}

//Funcion para que la contraseña no esté vacia

function contrasenaLlena(){
	if(contrasena.value.length>=4){
		campos.contrasena=true;
	}else{
		campos.contrasena=false;
		iniciaSesion.disabled=true;
	}
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
		iniciaSesion.disabled=true;
	}
}

//Funciones de validación de carácteres 

function validarCorreo(e){
	if (e.charCode >= 48 && e.charCode <= 57 || e.charCode >= 64 && e.charCode <= 90 || e.charCode >= 97 && e.charCode <= 122 || e.charCode ==46 || e.charCode ==95 || e.charCode ==45){
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
correoElectronico.addEventListener("keyup",minusculaAMayuscula);

inputs.forEach((input)=>{
	input.addEventListener("keyup",validarFormulario);
});

//Validación general del formulario.
formulario.addEventListener("keyup",(e)=>{
	e.preventDefault();
	if(campos.correoElectronico && campos.contrasena){
		iniciaSesion.disabled=false;
	}
});

//Expresiones regulares para comprobar la escritura de los formularios.
const expresiones = {
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/, //Recibe texto en formato correo. Ej. ejemplo@ejemplo.com
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