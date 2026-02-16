console.log("FUnciona");
//Aqui estan las tablas de los reportes historico
var tablaDeCarteles=document.getElementById("tablaDeCarteles");
var tablaDePonencias=document.getElementById("tablaDePonencias");
var tablaDeTalleres=document.getElementById("tablaDeTalleres");
var tablaDePrototipos=document.getElementById("tablaDePrototipos");


function mostrarTablaDeCarteles(){
    tablaDeCarteles.style.display="block";
    tablaDePonencias.style.display="none";
    tablaDeTalleres.style.display="none";
    tablaDePrototipos.style.display="none";
}
function mostrarTablaDePonencias(){
    tablaDeCarteles.style.display="none";
    tablaDePonencias.style.display="block";
    tablaDeTalleres.style.display="none";
    tablaDePrototipos.style.display="none";
}
function mostrarTablaDeTalleres(){
    tablaDeCarteles.style.display="none";
    tablaDePonencias.style.display="none";
    tablaDeTalleres.style.display="block";
    tablaDePrototipos.style.display="none";
}
function mostrarTablaDePrototipos(){
    tablaDeCarteles.style.display="none";
    tablaDePonencias.style.display="none";
    tablaDeTalleres.style.display="none";
    tablaDePrototipos.style.display="block";
}


tablaDeCarteles.style.display="none";
tablaDePonencias.style.display="block";
tablaDeTalleres.style.display="none";
tablaDePrototipos.style.display="none";