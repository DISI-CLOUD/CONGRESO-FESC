
let btncartel = document.getElementById('btn-cartel');
let btnponencia = document.getElementById('btn-ponencia');
let btntaller = document.getElementById('btn-taller');
let btnprototipo = document.getElementById('btn-prototipo');

let tipo=document.getElementById('tipo');


function selectCartel(){
    btncartel.style.backgroundColor='#FFCA64';
    btnponencia.style.backgroundColor='#fff';
    btntaller.style.backgroundColor='#fff';
    btnprototipo.style.backgroundColor='#fff';
    tipo.value="CARTEL";
}
function selectPonencia(){
    btncartel.style.backgroundColor='#fff';
    btnponencia.style.backgroundColor='#FFCA64';
    btntaller.style.backgroundColor='#fff';
    btnprototipo.style.backgroundColor='#fff';
    tipo.value="PONENCIA";
}

function selectTaller(){
    btncartel.style.backgroundColor='#fff';
    btnponencia.style.backgroundColor='#fff';
    btntaller.style.backgroundColor='#FFCA64';
    btnprototipo.style.backgroundColor='#fff';
    tipo.value="TALLER";
}


function selectPrototipo(){
    btncartel.style.backgroundColor='#fff';
    btnponencia.style.backgroundColor='#fff';
    btntaller.style.backgroundColor='#fff';
    btnprototipo.style.backgroundColor='#FFCA64';
    tipo.value="PROTOTIPO";
}

function selectNone(){
    btncartel.style.backgroundColor='#fff';
    btnponencia.style.backgroundColor='#fff';
    btntaller.style.backgroundColor='#fff';
    btnprototipo.style.backgroundColor='#fff';
    tipo.value="";
}


btncartel.addEventListener('click',selectCartel);
btnponencia.addEventListener('click',selectPonencia);
btntaller.addEventListener('click',selectTaller);
btnprototipo.addEventListener('click',selectPrototipo);
//////////////////////////////////////////////////////////////////////
const formulario=document.getElementById("formulario");
const inputs=document.querySelectorAll("#formulario");

//Contadores Span
var contadorTitulo=document.getElementById("contadorTitulo");
var contadorResumen=document.getElementById("contadorResumen");
var contadorReferencia=document.getElementById("contadorReferencia");

//Inputs
var titulo=document.getElementById("titulo");
var resumen=document.getElementById("resumen");
var referencia=document.getElementById("referencia");
var coautor=document.getElementById("coautor");

//Combo
var categoria=document.getElementById("categoria");

//Informacion error
var formulario_informacion_titulo=document.getElementById("formulario_informacion_titulo");
var formulario_informacion_resumen=document.getElementById("formulario_informacion_resumen");
var formulario_informacion_referencia=document.getElementById("formulario_informacion_referencia");

//Botones
var botonQuitarCoautor=document.getElementById("botonQuitarCoautor");
var botonParticipar=document.getElementById("botonParticipar");
var botonAgregarCoautor=document.getElementById("botonAgregarCoautor");


const campos={
	titulo: false,
	resumen: false,
	referencia: false,
	coautor:false
}


//Función para pasar minúsculas a mayúsculas.
function minusculaAMayuscula(e){
	const texto=e.target.value;
	e.target.value=texto.toUpperCase();
	//Guarda el valor de los input en un texto para hacerlo mayúscula.

}

//Funcion para contar las palabras
function contarPalabras(frase){
	if(frase.length>0){
		frase=frase.replace(/^\s*|\s*$/, '');
		frase=frase.replace(/[ ]{2,}/gi, ' ');
		frase=frase.replace(/\n /, '\n');
	
		return frase.split(' ').length;
	 }else{
		return 0;
	 }

}

//Validacion de los campos
//Validacion de titulo
titulo.addEventListener("keyup",(e) =>{
	minusculaAMayuscula(e);
	validarTitulo();
});
//Validacion de coautor
coautor.addEventListener("keyup",(e) =>{
	minusculaAMayuscula(e);
	validarFormulario();
});


//Validacion de resumen
resumen.addEventListener("keyup",(e) =>{
	validarResumen();
});

//Validacion de referencia
referencia.addEventListener("keyup",(e) =>{
	validarReferencia();
});

//Funciones de la validacion

function validarTitulo(){
    palabrasContadas=contarPalabras(titulo.value);
    contadorTitulo.textContent=palabrasContadas+" de 15";
	if(palabrasContadas>15 || palabrasContadas<1){
		titulo.classList.add('is-invalid');
		formulario_informacion_titulo.classList.add('formulario_input-error-activo');
		campos.titulo=false;
	}else{
		titulo.classList.remove('is-invalid');
		titulo.classList.add('is-valid');
		formulario_informacion_titulo.classList.remove('formulario_input-error-activo');
		formulario_informacion_titulo.classList.add('formulario_input-error');
		campos.titulo=true;
	}
	validarFormulario();
}

function validarResumen(){
	//palabrasContadas=correctorOrtografico(resumen.value);
    palabrasContadas=contarPalabras(resumen.value);
    contadorResumen.textContent=palabrasContadas+" de 250";
	if(palabrasContadas>250 || palabrasContadas<50){
		resumen.classList.add('is-invalid');
		formulario_informacion_resumen.classList.add('formulario_input-error-activo');
		campos.resumen=false;
	}else{
		resumen.classList.remove('is-invalid');
		resumen.classList.add('is-valid');
		formulario_informacion_resumen.classList.remove('formulario_input-error-activo');
		formulario_informacion_resumen.classList.add('formulario_input-error');
		campos.resumen=true;
	}
	validarFormulario();
}

function validarReferencia(){
		//minusculaAMayuscula(e);
		palabrasContadas=contarPalabras(referencia.value);
		contadorReferencia.textContent=palabrasContadas+" de 50";
		if(palabrasContadas>50 || palabrasContadas<1){
			referencia.classList.add('is-invalid');
			formulario_informacion_referencia.classList.add('formulario_input-error-activo');
			campos.referencia=false;
		}else{
			referencia.classList.remove('is-invalid');
			referencia.classList.add('is-valid');
			formulario_informacion_referencia.classList.remove('formulario_input-error-activo');
			formulario_informacion_referencia.classList.add('formulario_input-error');
			campos.referencia=true;
		}
		validarFormulario();
}

function validarFormularioGlobal(){
	validarTitulo();
	validarResumen();
	validarReferencia();
}


//Validación general del formulario.
formulario.addEventListener("keyup",(e)=>{
	e.preventDefault();

});

function validarFormulario(){
	if(campos.titulo && campos.resumen && campos.referencia){
		botonParticipar.disabled=false;
	}else{
		botonParticipar.disabled=true;
	}
}


function obtenerDatosGuardados(){
	// Recuperar datos de localStorage
	var tituloContenido = localStorage.getItem('titulo');
	var tipoContenido = localStorage.getItem('tipo');
	var categoriaContenido = localStorage.getItem('categoria');
	var resumenContenido = localStorage.getItem('resumen');
	var referenciaContenido = localStorage.getItem('referencia');
	
	titulo.value=tituloContenido;
	tipo.value=tipoContenido;
	resumen.value=resumenContenido;
	referencia.value=referenciaContenido;
	categoria.value=categoriaContenido;
}

function guardarDatos(){
	// Almacenar datos en localStorage
	localStorage.setItem('titulo', titulo.value);
	localStorage.setItem('tipo', tipo.value);
	localStorage.setItem('categoria',categoria.value);
	localStorage.setItem('resumen', resumen.value);
	localStorage.setItem('referencia', referencia.value);
}


function seleccionarTipoPonencia(){	
	switch (tipo.value) {
		case "CARTEL":
			selectCartel();
		break;
		case "PONENCIA":
			selectPonencia();
		break;
		case "TALLER":
			selectTaller();
		break;
		case "PROTOTIPO":
			selectPrototipo();
		break;

		default:
			selectNone();
			break;
	}
}

//Recargar

botonParticipar.addEventListener("click", (e)=>{
	
});

botonAgregarCoautor.addEventListener("click", (e)=>{

});

botonQuitarCoautor.addEventListener("click", (e)=>{
	
});






// Aquí puedes realizar las acciones necesarias antes de la recarga
//Llamar a la funcion para instanciar los campos que se perdieron

//obtenerDatosGuardados();
seleccionarTipoPonencia();
validarFormularioGlobal();