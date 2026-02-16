//Aqui estan las tablas de los reportes
var catalogoTrabajos=document.getElementById("catalogoTrabajos");
var extensosAprobados=document.getElementById("extensosAprobados");
var extensosPendientesCorregir=document.getElementById("extensosPendientesCorregir");
var extensosPendientesEvaluar=document.getElementById("extensosPendientesEvaluar");
var tablaDeEvaluadores=document.getElementsByClassName("tablaDeEvaluadores");


function mostrarCatalogoTrabajos(){
    catalogoTrabajos.style.display="block";
    extensosAprobados.style.display="none";
    extensosPendientesCorregir.style.display="none";
    extensosPendientesEvaluar.style.display="none";
    for (let i = 0; i < tablaDeEvaluadores.length; i++) {
        tablaDeEvaluadores[i].style.display="none";    
    }    
}
function mostrarExtensosAprobados(){
    catalogoTrabajos.style.display="none";
    extensosAprobados.style.display="block";
    extensosPendientesCorregir.style.display="none";
    extensosPendientesEvaluar.style.display="none";
    for (let i = 0; i < tablaDeEvaluadores.length; i++) {
        tablaDeEvaluadores[i].style.display="none";    
    }
}
function mostrarExtensosPendientesCorregir(){
    catalogoTrabajos.style.display="none";
    extensosAprobados.style.display="none";
    extensosPendientesCorregir.style.display="block";
    extensosPendientesEvaluar.style.display="none";
    for (let i = 0; i < tablaDeEvaluadores.length; i++) {
        tablaDeEvaluadores[i].style.display="none";    
    }
}
function mostrarExtensosPendientesEvaluar(){
    catalogoTrabajos.style.display="none";
    extensosAprobados.style.display="none";
    extensosPendientesCorregir.style.display="none";
    extensosPendientesEvaluar.style.display="block";
    for (let i = 0; i < tablaDeEvaluadores.length; i++) {
        tablaDeEvaluadores[i].style.display="none";    
    }
    
}

function mostrarTablaDeEvaluadores(){
    catalogoTrabajos.style.display="none";
    extensosAprobados.style.display="none";
    extensosPendientesCorregir.style.display="none";
    extensosPendientesEvaluar.style.display="none";
    for (let i = 0; i < tablaDeEvaluadores.length; i++) {
        tablaDeEvaluadores[i].style.display="block";    
    }
}


for (let i = 0; i < tablaDeEvaluadores.length; i++) {
    tablaDeEvaluadores[i].style.display="none";    
}
catalogoTrabajos.style.display="block";
extensosAprobados.style.display="none";
extensosPendientesCorregir.style.display="none";
extensosPendientesEvaluar.style.display="none";

