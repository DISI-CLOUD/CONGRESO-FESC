const formulario=document.getElementById("formulario");
const inputs=document.querySelectorAll("#formulario");


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
	//input.addEventListener("keyup",validarFormulario);
});

