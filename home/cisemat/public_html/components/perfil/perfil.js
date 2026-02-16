
var botonCambiarDatos = document.getElementById('botonCambiarDatos');
var botonCambiarCorreo = document.getElementById('botonCambiarCorreo'); //se asigna una variable a el boton de html
var botonCambiarFoto = document.getElementById('botonCambiarFoto');
var botonGuardar = document.getElementById('botonGuardar');
var botonGuardarCorreo=document.getElementById('botonGuardarCorreo');
var botonGuardarFoto=document.getElementById('botonGuardarFoto');
var myDIV = document.getElementById('myDIV');
const formulario=document.getElementById("formulario");
const inputs=document.querySelectorAll("#formulario");   

    const campos={
        nombres: true,
        apellidos: true,
        correoElectronico: true,
        rfc: true,
        telefono: true
    } 

    //Expresiones regulares para comprobar la escritura de los formularios.
    const expresiones = {
       nombres: /^[a-z-A-Z]\w*\s?[a-z-A-Z]{4,90}\w*$/, //Solo recibe Letras, un espacio opcional y letras. Ej. (Miguel Angel).
       apellidos: /^[a-z-A-Z]\w*\s?[a-z-A-Z]{4,90}\w*$/, //Solo recibe Letras, un espacio opcional y letras. Ej. (Gonzales Pineda).
       correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/, //Recibe texto en formato correo. Ej. ejemplo@ejemplo.com
       rfc: /^.{4,30}$/, // 4 a 30 digitos.
       telefono: /^\d{7,12}$/ // 7 a 14 numeros.  
    }
    

    contador=0; //contador de cambiar datos
    contador1=0; //contador de correo
    contador2=0; //contador cambiar foto

    botonCambiarDatos.addEventListener('click',botonCambiarDatosClick); //agrega evento, agrega la funcion 
    botonCambiarCorreo.addEventListener('click',botonCambiarDatosClickCorreo);
    botonCambiarFoto.addEventListener('click',botonCambiarFotoClick);

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
       case "telefono":
			validarCampo(expresiones.telefono,e.target,"telefono");
		break;
        
	}
    
}




const validarCampo = (expresion, input, campo) => {
	if(expresion.test(input.value)){
		document.getElementById(campo).classList.remove('is-invalid');
		document.getElementById(campo).classList.add('is-valid');
		document.getElementById(`formulario_informacion_${campo}`).classList.remove('formulario_input-error-activo');
		document.getElementById(`formulario_informacion_${campo}`).classList.add('formulario_input-error');
		campos[campo]=true;
        console.log(campos.telefono);
	}else{
		document.getElementById(campo).classList.add('is-invalid');
		document.getElementById(`formulario_informacion_${campo}`).classList.add('formulario_input-error-activo');
		campos[campo]=false;
        botonGuardar.disabled=true;
        console.log(campos.telefono.value);
        botonGuardarCorreo.disabled=true;
	}
}


    //Listeners
//Listener para cambiar de minúscula a mayúscula.
inputs.forEach((input)=>{
	input.addEventListener("keyup",minusculaAMayuscula);
	input.addEventListener("keyup",validarFormulario);

});


//Validación general del formulario.
formulario.addEventListener("keyup",(e)=>{
	e.preventDefault(); //bloquea el envio por boton
	if(campos.nombres && campos.apellidos && campos.telefono && campos.rfc ){
		botonGuardar.disabled=false;
    }
	if(campos.correoElectronico){
        botonGuardarCorreo.disabled=false;
    }
    
});



    //Función para pasar minúsculas a mayúsculas.
function minusculaAMayuscula(e){
	//Guarda el valor de los input en un texto para hacerlo mayúscula.
	const texto=e.target.value;
	e.target.value=texto.toUpperCase();
}

//Funciones de validación de carácteres 
function validarNombres(e){
	if (e.charCode >= 65 && e.charCode <= 90 || e.charCode >= 97 && e.charCode <= 122 || e.charCode ==32){
		return true;
	}else{
		return false;
	}	
}

function validarApellidos(e){
	if (e.charCode >= 65 && e.charCode <= 90 || e.charCode >= 97 && e.charCode <= 122 || e.charCode ==32){
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
function validarTelefono(e){
	if (e.charCode >= 48 && e.charCode <= 57){
		return true;
	}else{
		return false;
	}	
}


    //cambiar boton general
    function botonCambiarDatosClick(){
        if(contador==0){
            inputs.forEach(validarFormulario);
           botonCancelar();
           activarCaja();
           aparecerBotonGuardar();
           contador=1;
        }else{
            desactivarCaja();
            botonCancelar();
            desaparecerBotonGuardar();
            contador=0;
        }
    }
    //cambiar boton general
    function botonCancelar(){
        if(contador==0){
            botonCambiarDatos.value="Cancelar";
            botonCambiarDatos.name="botonCancelar";
        }else{
            botonCambiarDatos.value="Cambiar Datos";
            botonCambiarDatos.name="botonCambiarDatos";
        }
    }
        //cambiar correo
    function botonCambiarDatosClickCorreo(){
        if(contador1==0){
            botonCancelarCorreo();
            activarCajaCorreo();
            aparecerBotonGuardarCorreo();
            contador1=1;
          
        }else{
            desactivarCajaCorreo();
            botonCancelarCorreo();
            desaparecerBotonGuardarCorreo();
            contador1=0;
           
        }
    }
    //cambiar correo
    function botonCancelarCorreo(){
        if(contador1==0){
            botonCambiarCorreo.value="Cancelar";  //accede al boton y le da valor
            botonCambiarCorreo.name="botonCancelar";
        }else{
            botonCambiarCorreo.value="Cambiar Datos";
            botonCambiarCorreo.name="botonCambiarDatosCorreo";
        }
    }

    //Activar modificacion de perfil
    function activarCaja(){
        document.getElementById('nombres').disabled=false; //activa y desactiva text
        document.getElementById('apellidos').disabled=false;
        document.getElementById('rfc').disabled=false;
        document.getElementById('telefono').disabled=false;
        }

    function desactivarCaja(){
        document.getElementById('nombres').disabled=true;
        document.getElementById('apellidos').disabled=true;
        document.getElementById('rfc').disabled=true;
       // document.getElementById('correoElectronico').disabled=true;
        document.getElementById('telefono').disabled=true;
        }
                       
     //<!--Activa modificacion perfil-->
                            
    function activarCajaCorreo(){
        document.getElementById('correoElectronico').disabled=false;
        }

        function desactivarCajaCorreo(){
            document.getElementById('correoElectronico').disabled=true;
            }
                    
    // <!--activa y desativa caaja de seleccion archivos-->
                          
    function botonCambiarFotoClick(){
        if(contador2==0){
            aparecerCambiarFoto();
            botonCancelarFoto();
            aparecerBotonGuardarFoto();
            contador2=1;
        }else{
            desaparecerCambiarFoto();
            botonCancelarFoto();
            desaparecerBotonGuardarFoto();
            contador2=0;

        }

    }
    function aparecerCambiarFoto(){
        myDIV.style.display = "block";
    }

    function desaparecerCambiarFoto(){
        myDIV.style.display = "none";
    }

    //Funciones para aparecer y desaparecer botones
    //Boton de guardar
    function aparecerBotonGuardar(){
        botonGuardar.style.display = "inline";
    }

    function desaparecerBotonGuardar(){
        botonGuardar.style.display = "none";
    }
    //Boton de guardar correo
    function aparecerBotonGuardarCorreo(){
        botonGuardarCorreo.style.display = "inline";
    }

    function desaparecerBotonGuardarCorreo(){
        botonGuardarCorreo.style.display = "none";
    }
     //Boton de cambiar foto
     function aparecerBotonGuardarFoto(){
        botonGuardarFoto.style.display = "inline";
    }

    function desaparecerBotonGuardarFoto(){
        botonGuardarFoto.style.display = "none";
    }

    //para guardar archivos de foto
    function botonCancelarFoto(){
        if(contador2==0){
            botonCambiarFoto.value="Cancelar";  //accede al boton y le da valor
           
        }else{
            botonCambiarFoto.value="Cambiar foto";
         
        }
    }



  //Valida que no se reenvie el formulario
if(window.history.replaceState){
    window.history.replaceState(null,null,window.location.href);
}
