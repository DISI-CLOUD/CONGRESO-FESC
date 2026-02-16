<?php

require "../../modelo/conexion.php";
require "../../modelo/traerCongresoActual.php";
$idPonencia=$_GET['id'];
if($idPonencia==''){
    print "<script>window.location='/cbb/index.php';</script>";

}
$consPonencias="SELECT * FROM ponencia WHERE id_ponencia='$idPonencia' and id_congreso='$idCongreso'";
//echo"<br> Layouts/TabladeEvluacion/evaluareExtensos.php : ".$consPonencias."<br>";
$resPonencias=mysqli_query($conexion,$consPonencias);

$fetchPonencias=mysqli_fetch_assoc($resPonencias);
$tituloPonencia=$fetchPonencias['titulo_ponencia'];
$idTipoPonencia=$fetchPonencias['id_tipo_ponencia'];
$idUsuarioEvalua=$fetchPonencias['id_usuario_evalua'];
$idUsuarioRegistra=$fetchPonencias['id_usuario_registra'];
$idCategoria=$fetchPonencias['id_categoria'];
//Hace consulta en la tabla oral
$consPonenciasOrales="SELECT * FROM oral WHERE id_ponencia='$idPonencia' and id_congreso='$idCongreso'";
$resPonenciasOrales=mysqli_query($conexion,$consPonenciasOrales);

$fetchPonenciasOrales=mysqli_fetch_assoc($resPonenciasOrales);
$pdfPonencia=$fetchPonenciasOrales['extenso_oral'];


require "../../modelo/evaluarExtenso.php"
?>

<form method="POST" id="formulario">
<?php 
    if(!empty($_SESSION['info'])){
        ?>
        <div id="informacionExito" class="alert alert-success alert-dismissible fade show mt-3">
            <?php echo $_SESSION['info']; ?>
            <a href='../../components/TrabajosAsignados/trabajosAsignados.php'>"> Ver mis evaluaciones asignadas</a>
        </div>
        <?php
    }
    ?>
    
    <?php
    if(count($errores) > 0){
        ?>
        <div id="informacionError" class="alert alert-danger alert-dismissible fade show mt-3">
            <?php
            foreach($errores as $showerror){
                echo $showerror;
            }
            ?>
            <a href='../../components/TrabajosAsignados/trabajosAsignados.php'> Ver mis trabajos asignados</a>
        </div>
        <?php
    }
?> 
<div class="row mt-5">
    <div class="col-12">
        <a href="<?php echo $pdfPonencia; ?>" target="_blank">Descargar el Extenso</a>
    </div>
</div>

<div class="row">
<div class="table-responsive col-xl-10 col-lg-10 col-md-12 col-sm-12 col-xs-12">
<table class="container table border-top border-end border-start mt-5 align-middle">
    <thead >
            <tr class=" d-flex text-center table-head">
                <th scope="col" class="col-xl-5 col-lg-5 col-md-4 d-none d-md-block d-none d-sm-block">Punto a Evaluar</th>
                <th scope="col" class="col-xl-1 col-lg-1 col-md-2 d-none d-md-block d-none d-sm-block">Si</th>
                <th scope="col" class="col-xl-1 col-lg-1 col-md-2 d-none d-md-block d-none d-sm-block">No</th>
                <th scope="col" class="col-xl-5 col-lg-5 col-md-4 d-none d-md-block d-none d-sm-block">Recomendaciones</th>
            </tr>
    </thead>
        <tbody >
            <!--PUNTO 1------------->
            <tr class="d-flex text-center">
                <th scope="row" class="col-xl-5 col-lg-5 col-md-4 col-sm-4  text-punto-evaluar">¿El trabajo se encuentra realizado en la plantilla de extenso?</th>
                <th class="col-xl-1 col-lg-1 col-md-2 col-sm-2 text-punto-evaluar">
                    <div class="form-check form-check-inline">
                        <input  class="form-check-input" type="radio" name="Option1" id="inlineRadio1" value="SI">
                        <label class="form-check-label" for="inlineRadio1">Si</label>
                    </div>
                </th>
                <th class="col-xl-1 col-lg-1 col-md-2 col-sm-2 text-punto-evaluar">
                    <div class="form-check form-check-inline d-inline-block">
                        <input class="form-check-input" type="radio" name="Option1" id="inlineRadio1" value="NO">
                        <label class="form-check-label" for="inlineRadio1">No</label>
                    </div>
                </th> 
                <th class="col-xl-5 col-lg-5 col-md-4 col-sm-4 text-punto-evaluar ">
                    <textarea onfocus="validarInputNo(event); validarFormulario();" name="comentarioPunto1" id="comentarioPunto1" rows="6" class="col-12 form-control text-punto-evaluar" onkeydown="return evitarEnter(event)"></textarea>
                    <div class="invalid-feedback">
                        Debes colocar un comentario si no cumple con este punto de la rubrica.
                    </div>
                </th>
            </tr>
            <!---PUNTO 2-->
            <tr class="d-flex text-center">
                <th scope="row" class="col-xl-5 col-lg-5 col-md-4 col-sm-4  text-punto-evaluar">¿El trabajo cumple con el formato solicitado(Tipo, tamaño de letra, márgenes, tamaño de hoja, datos, alineación, etc)?</th>
                <th class="col-xl-1 col-lg-1 col-md-2 col-sm-2  text-punto-evaluar">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="Option2" id="inlineRadio1" value="SI">
                        <label class="form-check-label" for="inlineRadio1">Si</label>
                    </div>
                </th>
                <th class="col-xl-1 col-lg-1 col-md-2 col-sm-2  text-punto-evaluar">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="Option2" id="inlineRadio1" value="NO">
                        <label class="form-check-label" for="inlineRadio1">No</label>
                    </div>
                </th>
                <th class="col-xl-5 col-lg-5 col-md-4 col-sm-4 text-punto-evaluar">
                    <textarea onfocus="validarInputNo(event); validarFormulario();"  class="col-12 form-control text-punto-evaluar" name="comentarioPunto2" id="comentarioPunto2" rows="6" class="col-12" onkeydown="return evitarEnter(event)"></textarea>
                    <div class="invalid-feedback">
                        Debes colocar un comentario si no cumple con este punto de la rubrica.
                    </div>
                </th>
            </tr>
            <!---PUNTO 3-->
            <tr class="d-flex text-center">
                <th scope="row" class="col-xl-5 col-lg-5 col-md-4 col-sm-4  text-punto-evaluar">¿El resumen cumple con un maximo de 250 palabras con la estructura requerida incluye palabras clave(Máximo 6)?</th>
                <th class="col-xl-1 col-lg-1 col-md-2 col-sm-2  text-punto-evaluar">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="Option3" id="inlineRadio1" value="SI">
                        <label class="form-check-label" for="inlineRadio1">Si</label>
                    </div>
                </th>
                <th class="col-xl-1 col-lg-1 col-md-2 col-sm-2  text-punto-evaluar">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="Option3" id="inlineRadio1" value="NO">
                        <label class="form-check-label" for="inlineRadio1">No</label>
                    </div>
                </th>
                <th class="col-xl-5 col-lg-5 col-md-4 col-sm-4  text-punto-evaluar">
                    <textarea onfocus="validarInputNo(event); validarFormulario();"  name="comentarioPunto3" id="comentarioPunto3" rows="6" class="col-12 form-control text-punto-evaluar" onkeydown="return evitarEnter(event)"></textarea>
                    <div class="invalid-feedback">
                        Debes colocar un comentario si no cumple con este punto de la rubrica.
                    </div>
                </th>
            </tr>
            <!---PUNTO 4-->
            <tr class="d-flex text-center">
                <th scope="row" class="col-xl-5 col-lg-5 col-md-4 col-sm-4  text-punto-evaluar">¿El trabajo esta descrito ordenadamente como corresponde a la categoría?</th>
                <th class="col-xl-1 col-lg-1 col-md-2 col-sm-2  text-punto-evaluar">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="Option4" id="inlineRadio1" value="SI">
                        <label class="form-check-label" for="inlineRadio1">Si</label>
                    </div>
                </th>
                <th class="col-xl-1 col-lg-1 col-md-2 col-sm-2 text-punto-evaluar">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="Option4" id="inlineRadio1" value="NO">
                        <label class="form-check-label" for="inlineRadio1">No</label>
                    </div>
                </th>
                <th class="col-xl-5 col-lg-5 col-md-4 col-sm-4  text-punto-evaluar">
                    <textarea onfocus="validarInputNo(event); validarFormulario();"  name="comentarioPunto4" id="comentarioPunto4" rows="6" class="col-12 form-control text-punto-evaluar" onkeydown="return evitarEnter(event)"></textarea>
                    <div class="invalid-feedback">
                        Debes colocar un comentario si no cumple con este punto de la rubrica.
                    </div>
                </th>
            </tr>
            <!---PUNTO 5-->
            <tr class="d-flex text-center">
                <th scope="row" class="col-xl-5 col-lg-5 col-md-4 col-sm-4  text-punto-evaluar">¿El trabajo lleva orden en la numeración de ecuaciones, tablas y figuras. Los títulos de figuras y tablas están correctamente?</th>
                <th class="col-xl-1 col-lg-1 col-md-2 col-sm-2  text-punto-evaluar">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="Option5" id="inlineRadio1" value="SI">
                        <label class="form-check-label" for="inlineRadio1">Si</label>
                    </div>
                </th>
                <th class="col-xl-1 col-lg-1 col-md-2 col-sm-2  text-punto-evaluar">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="Option5" id="inlineRadio1" value="NO">
                        <label class="form-check-label" for="inlineRadio1">No</label>
                    </div>
                </th>
                <th class="col-xl-5 col-lg-5 col-md-4 col-sm-4 text-punto-evaluar">
                    <textarea onfocus="validarInputNo(event); validarFormulario();"  name="comentarioPunto5" id="comentarioPunto5" rows="6" class="col-12 form-control text-punto-evaluar" onkeydown="return evitarEnter(event)"></textarea>
                    <div class="invalid-feedback">
                        Debes colocar un comentario si no cumple con este punto de la rubrica.
                    </div>
                </th>
            </tr>
            <!---PUNTO 6-->
            <tr class="d-flex text-center">
                <th scope="row" class="col-xl-5 col-lg-5 col-md-4 col-sm-4 text-punto-evaluar">¿Las referencias siguen el formato APA?</th>
                <th class="col-xl-1 col-lg-1 col-md-2 col-sm-2  text-punto-evaluar">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="Option6" id="inlineRadio1" value="SI">
                        <label class="form-check-label" for="inlineRadio1">Si</label>
                    </div>
                </th>
                <th class="col-xl-1 col-lg-1 col-md-2 col-sm-2  text-punto-evaluar">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="Option6" id="inlineRadio1" value="NO">
                        <label class="form-check-label" for="inlineRadio1">No</label>
                    </div>
                </th>
                <th class="col-xl-5 col-lg-5 col-md-4 col-sm-4  text-punto-evaluar">
                    <textarea onfocus="validarInputNo(event); validarFormulario();" name="comentarioPunto6" id="comentarioPunto6" rows="6" class="col-12 form-control text-punto-evaluar" onkeydown="return evitarEnter(event)"></textarea>
                    <div class="invalid-feedback">
                        Debes colocar un comentario si no cumple con este punto de la rubrica.
                    </div>
                </th>
            </tr>
            <!---PUNTO 7-->
            <tr class="d-flex text-center">
                <th scope="row" class="col-xl-5 col-lg-5 col-md-4 col-sm-4  text-punto-evaluar">¿Las referencias citadas en el texto corresponden a las reportadas al final del trabajo?</th>
                <th class="col-xl-1 col-lg-1 col-md-2 col-sm-2  text-punto-evaluar">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="Option7" id="inlineRadio1" value="SI">
                        <label class="form-check-label" for="inlineRadio1">Si</label>
                    </div>
                </th>
                <th class="col-xl-1 col-lg-1 col-md-2 col-sm-2  text-punto-evaluar">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="Option7" id="inlineRadio1" value="NO">
                        <label class="form-check-label" for="inlineRadio1">No</label>
                    </div>
                </th>
                <th class="col-xl-5 col-lg-5 col-md-4 col-sm-4  text-punto-evaluar">
                    <textarea onfocus="validarInputNo(event); validarFormulario();" name="comentarioPunto7" id="comentarioPunto7" rows="6" class="col-12 form-control text-punto-evaluar" onkeydown="return evitarEnter(event)"></textarea>
                    <div class="invalid-feedback">
                        Debes colocar un comentario si no cumple con este punto de la rubrica.
                    </div>
                </th>
            </tr>
            <!---PUNTO 8-->
            <tr class="d-flex text-center">
                <th scope="row" class="col-xl-5 col-lg-5 col-md-4 col-sm-4  text-punto-evaluar">¿La redacción es congruente?</th>
                <th class="col-xl-1 col-lg-1 col-md-2 col-sm-2 text-punto-evaluar">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="Option8" id="inlineRadio1" value="SI">
                        <label class="form-check-label" for="inlineRadio1">Si</label>
                    </div>
                </th>
                <th class="col-xl-1 col-lg-1 col-md-2 col-sm-2  text-punto-evaluar">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="Option8" id="inlineRadio1" value="NO">
                        <label class="form-check-label" for="inlineRadio1">No</label>
                    </div>
                </th>
                <th class="col-xl-5 col-lg-5 col-md-4 col-sm-4  text-punto-evaluar">
                    <textarea onfocus="validarInputNo(event); validarFormulario();"  name="comentarioPunto8" id="comentarioPunto8" rows="6" class="col-12 form-control text-punto-evaluar" onkeydown="return evitarEnter(event)"></textarea>
                    <div class="invalid-feedback">
                        Debes colocar un comentario si no cumple con este punto de la rubrica.
                    </div>
                </th>
            </tr>
            <!---PUNTO 9-->
            <tr class="d-flex text-center">
                <th scope="row" class="col-xl-5 col-lg-5 col-md-4 col-sm-4  text-punto-evaluar">¿Presentacion del trabajo general ortografía, lenguaje apropiado, etc?</th>
                <th class="col-xl-1 col-lg-1 col-md-2 col-sm-2  text-punto-evaluar">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="Option9" id="inlineRadio1" value="SI">
                        <label class="form-check-label" for="inlineRadio1">Si</label>
                    </div>
                </th>
                <th class="col-xl-1 col-lg-1 col-md-2 col-sm-2  text-punto-evaluar">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="Option9" id="inlineRadio1" value="NO">
                        <label class="form-check-label" for="inlineRadio1">No</label>
                    </div>
                </th>
                <th class="col-xl-5 col-lg-5 col-md-4 col-sm-4  text-punto-evaluar">
                    <textarea onfocus="validarInputNo(event); validarFormulario();"  name="comentarioPunto9" id="comentarioPunto9" rows="6" class="col-12 form-control text-punto-evaluar" onkeydown="return evitarEnter(event)"></textarea>
                    <div class="invalid-feedback">
                        Debes colocar un comentario si no cumple con este punto de la rubrica.
                    </div>
                </th>
            </tr>
            
        </tbody>
        
</table>
</div>
<div class="col-2"></div>
</div>


<div class="row">
    <div class="col-xl-10 col-lg-10 col-md-12 d-sm-block col-md-12">
    <table class="container table border-top border-end border-start mt-5">
        <thead>
            <tr class=" d-flex text-center table-head">
                <th scope="col" class="col-xl-12 col-lg-12 col-md-12">Observaciones Generales</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <th scope="row">
                <textarea name="comentarioGeneral" id="resultado" onkeyup="" rows="10" class="col-12" onkeydown="return evitarEnter(event)"></textarea>
            </th>
            </tr>
        </tbody>
    </table>
    </div>
    <div class="col-2"></div>
</div>

<div class="row">
    <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-xs-12">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-4 col-lg-4 col-md-6 d-sm-block col-sm-12 d-xs-block col-xs-12 mb-3">
                <div class="d-grid">
                    <!---------BOTON FINALIZAR---->
                    <input onclick="confirmar(event)" disabled class="btn btn-style" type="submit" id="finalizarEvaluacion" name="finalizarEvaluacion"  value="Finalizar Evaluacion">
                    
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 d-sm-block col-sm-12 d-xs-block col-xs-12 mb-3">
                <div class="d-grid ">
                    <!---------BOTON CANCELAR---->
                    <input class="btn btn-style" type="button"  value="Cancelar" onClick="history.back()">
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-lg-2 d-md-none d-lg-block d-sm-none d-md-block"></div>
</div>

</form>


<script>
const formulario=document.getElementById("formulario");
const radios=document.querySelectorAll("#formulario");
var finalizarEvaluacion=document.getElementById("finalizarEvaluacion");


const inputs=document.querySelectorAll("#formulario");



//Text areas
var comentarioPunto1=document.getElementById("comentarioPunto1");
var comentarioPunto2=document.getElementById("comentarioPunto2");
var comentarioPunto3=document.getElementById("comentarioPunto3");
var comentarioPunto4=document.getElementById("comentarioPunto4");
var comentarioPunto5=document.getElementById("comentarioPunto5");
var comentarioPunto6=document.getElementById("comentarioPunto6");
var comentarioPunto7=document.getElementById("comentarioPunto7");
var comentarioPunto8=document.getElementById("comentarioPunto8");
var comentarioPunto9=document.getElementById("comentarioPunto9");
var bandera=false;


//Campos para verificar
const campos={
	Option1: false,
	Option2: false,
	Option3: false,
	Option4: false,
    Option5: false,
	Option6: false,
	Option7: false,
	Option8: false,
    Option9: false,

    comentarioPunto1: true,
	comentarioPunto2: true,
	comentarioPunto3: true,
	comentarioPunto4: true,
    comentarioPunto5: true,
	comentarioPunto6: true,
	comentarioPunto7: true,
	comentarioPunto8: true,
    comentarioPunto9: true
}

//La continuacion
const validarCampo = (expresion, input, campo, option) => {
        if(expresion.test(input.value)){
            document.getElementById(input.name).classList.remove('is-invalid');
            //document.getElementById(campo).classList.add('is-valid');
            campos[campo]=true;
            campos[input.name]=true;
            //campos[campo]=true;
        }else{
            document.getElementById(input.name).classList.add('is-invalid');
            campos[campo]=false;
            campos[input.name]=false;
            /*
            document.getElementById(campo).classList.add('is-invalid');

            campos[campo]=false;*/
            //registrate.disabled=true;
        }
}

/********************************************************************/
//Funcion genera los radios hecha
const validarInputNo = (e) => {

	switch (e.target.name) {
		case "comentarioPunto1":
			validarCampo(expresiones.input,e.target,"Option1");
		break;
        case "comentarioPunto2":
			validarCampo(expresiones.input,e.target,"Option2");
		break;
        case "comentarioPunto3":
			validarCampo(expresiones.input,e.target,"Option3");
		break;
        case "comentarioPunto4":
			validarCampo(expresiones.input,e.target,"Option4");
		break;
        case "comentarioPunto5":
			validarCampo(expresiones.input,e.target,"Option5");
		break;
        case "comentarioPunto6":
			validarCampo(expresiones.input,e.target,"Option6");
		break;
        case "comentarioPunto7":
			validarCampo(expresiones.input,e.target,"Option7");
		break;
        case "comentarioPunto8":
			validarCampo(expresiones.input,e.target,"Option8");
		break;
        case "comentarioPunto9":
			validarCampo(expresiones.input,e.target,"Option9");
		break;

	}
}
//********************************************************************/
//Captura los radio y los hace variable a traves de la otra funcion
function verificarRadio(radios,nombre,radio,campo,input){
   radios = document.querySelector(`input[name="${nombre}"]:checked`).value;
   radio = document.querySelector(`input[name="${nombre}"]:checked`).value;
   if(radio=='SI') {
        campos[campo]=true;
        campos[input]=true;
        document.getElementById(input).classList.remove('is-invalid');
    }else{
        campos[campo]=false; 
        campos[input]=false;
        document.getElementById(input).classList.add('is-invalid');
    }

}
//Funcion genera los radios hecha por mi. Soy una riAta.
const generarRadio = (e) => {
	switch (e.target.name) {
		case "Option1":
			verificarRadio("radio1",e.target.name,"radio1Seleccion","Option1","comentarioPunto1");
		break;
        case "Option2":
			verificarRadio("radio2",e.target.name,"radio2Seleccion","Option2","comentarioPunto2");
		break;
        case "Option3":
			verificarRadio("radio3",e.target.name,"radio3Seleccion","Option3","comentarioPunto3");
		break;
        case "Option4":
			verificarRadio("radio4",e.target.name,"radio4Seleccion","Option4","comentarioPunto4");
		break;
        case "Option5":
			verificarRadio("radio5",e.target.name,"radio5Seleccion","Option5","comentarioPunto5");
		break;
        case "Option6":
			verificarRadio("radio6",e.target.name,"radio6Seleccion","Option6","comentarioPunto6");
		break;
        case "Option7":
			verificarRadio("radio7",e.target.name,"radio7Seleccion","Option7","comentarioPunto7");
		break;
        case "Option8":
			verificarRadio("radio8",e.target.name,"radio8Seleccion","Option8","comentarioPunto8");
		break;
        case "Option9":
			verificarRadio("radio9",e.target.name,"radio9Seleccion","Option9","comentarioPunto9");
		break;
	}
}



//********************************************************************/

function validarFormulario(){
    //if(){
        if(campos.Option1 && campos.Option2 && campos.Option3 && campos.Option4 && campos.Option5 && campos.Option6 && campos.Option7 && campos.Option8 && campos.Option9
        && comentarioPunto1 && comentarioPunto2 && comentarioPunto3 && comentarioPunto4 && comentarioPunto5 && comentarioPunto6 && comentarioPunto7 && comentarioPunto8 && comentarioPunto9
        ){
		    finalizarEvaluacion.disabled=false;
        }else{
            finalizarEvaluacion.disabled=true;
        } 

}

/**********************************************************************/
//Función para pasar minúsculas a mayúsculas.
function minusculaAMayuscula(e){
	//Guarda el valor de los input en un texto para hacerlo mayúscula.
	const texto=e.target.value;
	e.target.value=texto.toUpperCase();
}


//Listeners
//Listener para cambiar de minúscula a mayúscula.

inputs.forEach((input)=>{
	//input.addEventListener("keyup",minusculaAMayuscula);
    input.addEventListener("keyup",validarInputNo);
    //input.addEventListener("focus",validarInputNo);
	input.addEventListener("keyup",validarFormulario);
});

//Listener para cambiar de minúscula a mayúscula.
radios.forEach((radio)=>{
    //Aqui llamas la funcion de Dios
    radio.addEventListener("change",generarRadio);
	radio.addEventListener("change",validarFormulario);

});

//Expresiones regulares para comprobar la escritura de los formularios.
const expresiones = {
	input: /^.{10,200}$/ // 4 a 30 digitos.
}

//Valida que no se reenvie el formulario
if(window.history.replaceState){
    window.history.replaceState(null,null,window.location.href);
}

function evitarEnter(event) {
        // Si se presiona la tecla Enter (código 13), evita el salto de línea
        if (event.keyCode === 13) {
            event.preventDefault();
            return false;
        }
        return true;
    }

    function confirmar(event) {
        if (!confirm('¿Esta seguro de evaluar este extenso?')) {
            event.preventDefault();
        }
    }

</script>
