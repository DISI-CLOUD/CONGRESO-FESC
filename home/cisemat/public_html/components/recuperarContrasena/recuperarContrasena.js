const formulario=document.getElementById("formulario");
//let registrate=document.getElementById("registrate");
const inputs=document.querySelectorAll("#formulario");
var restablecerContrasena=document.getElementById("restablecerContrasena");

const campos={
	correoElectronico: false,
}

//Funcion Validar formularios.

const validarFormulario = (e) => {
	switch (e.target.name) {
		case "correoElectronico":
			validarCampo(expresiones.correo,e.target,"correoElectronico");
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
		restablecerContrasena.disabled=true;
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
inputs.forEach((input)=>{
	input.addEventListener("keyup",minusculaAMayuscula);
	input.addEventListener("keyup",validarFormulario);
});

//Validación general del formulario.
formulario.addEventListener("keyup",(e)=>{
	e.preventDefault();
	if(campos.correoElectronico){
		restablecerContrasena.disabled=false;
	}
});

//Expresiones regulares para comprobar la escritura de los formularios.
const expresiones = {
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/, //Recibe texto en formato correo. Ej. ejemplo@ejemplo.com
}



