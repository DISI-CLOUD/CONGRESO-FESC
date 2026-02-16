const formulario=document.getElementById("formulario");
const inputs=document.querySelectorAll("#formulario");

//Contadores Span
let contadorTitulo=document.getElementById("contadorTitulo");
let contadorResumen=document.getElementById("contadorResumen");
let contadorReferencia=document.getElementById("contadorReferencia");

//Inputs
let titulo=document.getElementById("titulo");
let resumen=document.getElementById("resumen");
let referencia=document.getElementById("referencia");
let categoria=document.getElementById("categoria");

//Informacion error
let formulario_informacion_titulo=document.getElementById("formulario_informacion_titulo");
let formulario_informacion_resumen=document.getElementById("formulario_informacion_resumen");
let formulario_informacion_referencia=document.getElementById("formulario_informacion_referencia");

//Botones

let botonGuardar=document.getElementById("botonGuardar");

const campos={
	titulo: false,
	resumen: false,
	referencia: false
}


//Función para pasar minúsculas a mayúsculas.
function minusculaAMayuscula(e){
	//Guarda el valor de los input en un texto para hacerlo mayúscula.
	const texto=e.target.value;
	e.target.value=texto.toUpperCase();
}

//Funcion para contar las palabras
function contarPalabras(frase){
    frase=frase.replace(/^\s*|\s*$/, '');
    frase=frase.replace(/[ ]{2,}/gi, ' ');
    frase=frase.replace(/\n /, '\n');

    return frase.split(' ').length;
}

//Listeners
//Listener para cambiar de minúscula a mayúscula.
inputs.forEach((input)=>{
	input.addEventListener("keyup",minusculaAMayuscula);
	//input.addEventListener("keyup",validarFormulario);
});

//Validacion de los campos funciones
function conteoTitulo(){
	palabrasContadas=contarPalabras(titulo.value);
    contadorTitulo.textContent=palabrasContadas+" de 15";
	if(palabrasContadas>15){
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
}

function conteoResumen(){
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
}

function conteoReferencias(){
	palabrasContadas=contarPalabras(referencia.value);
    contadorReferencia.textContent=palabrasContadas+" de 50";
	if(palabrasContadas>50){
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
}
//Validacion de titulo
titulo.addEventListener("keyup",(e) =>{
    conteoTitulo();
});
//Validacion de resumen
resumen.addEventListener("keyup",(e) =>{
	conteoResumen();
});
//Validacion de referencia
referencia.addEventListener("keyup",(e) =>{
	conteoReferencias();
});

//Validación general del formulario.
formulario.addEventListener("keyup",(e)=>{
	e.preventDefault();
	if(campos.titulo && campos.resumen && campos.referencia){
		botonGuardar.disabled=false;
	}else{
		botonGuardar.disabled=true;
	}
});

function conteoGeneral(){
	titulo.disabled=false;
	resumen.disabled=false;
	referencia.disabled=false;
	categoria.disabled=false;
	botonGuardar.disabled=false;

	conteoTitulo();
	conteoResumen();
	conteoReferencias();
}

//Confirma el borrado de archivos
function confirmar(event){
    if (!confirm('Una vez que guardas, se asigna una nueva revisión, no podrás editar de nuevo esta Ponencia hasta que se evalue. ¿Realmente deseas enviar el trabajo?')) {
        event.preventDefault();
      }
}