var infoNoMasTrabajos=document.getElementById("infoNoMasTrabajos");

try {
    var cardTrabajoAprobado=document.getElementsByClassName("cardTrabajoAprobado");
} catch (error) {
    
}

try {
    var cardTrabajoNoAprobado=document.getElementsByClassName("cardTrabajoNoAprobado");
} catch (error) {
    
}

try {
    var cardTrabajoSinEvaluador=document.getElementsByClassName("cardTrabajoSinEvaluador");
} catch (error) {
    
}

try {
    var cardTrabajoPendiente=document.getElementsByClassName("cardPendientePorEvaluar");
} catch (error) {
    
}


//Funciones para filtrar dependiente del estado de la tarjeta

function trabajoAprobado(){
    try {
        for (var i = 0; i < cardTrabajoAprobado.length; i++) {
            cardTrabajoAprobado[i].style.display= "block";
        }
    } catch (error) {
        
    }

    try {
        for (var i = 0; i < cardTrabajoNoAprobado.length; i++) {
            cardTrabajoNoAprobado[i].style.display= "none";
        }
    } catch (error) {
        
    }

    try {
        for (var i = 0; i < cardTrabajoSinEvaluador.length; i++) {
            cardTrabajoSinEvaluador[i].style.display= "none";
        }
    } catch (error) {
        
    }

    try {
        for (var i = 0; i < cardTrabajoPendiente.length; i++) {
            cardTrabajoPendiente[i].style.display= "none";
        }
    } catch (error) {
        
    }
    infoNoMasTrabajos.innerHTML ="Ya no tienes más trabajos aprobados por el momento.";
}

function trabajoNoAprobado(){
    try {
        for (var i = 0; i < cardTrabajoAprobado.length; i++) {
            cardTrabajoAprobado[i].style.display= "none";
        }
    } catch (error) {
        
    }

    try {
        for (var i = 0; i < cardTrabajoNoAprobado.length; i++) {
            cardTrabajoNoAprobado[i].style.display= "block";
        }
    } catch (error) {
        
    }

    try {
        for (var i = 0; i < cardTrabajoSinEvaluador.length; i++) {
            cardTrabajoSinEvaluador[i].style.display= "none";
        }
    } catch (error) {
        
    }

    try {
        for (var i = 0; i < cardTrabajoPendiente.length; i++) {
            cardTrabajoPendiente[i].style.display= "none";
        }
    } catch (error) {
        
    }
    infoNoMasTrabajos.innerHTML ="Ya no tienes más trabajos rechazados por el momento.";
}

function trabajoSinEvaluador(){
    try {
        for (var i = 0; i < cardTrabajoAprobado.length; i++) {
            cardTrabajoAprobado[i].style.display= "none";
        }
    } catch (error) {
        
    }

    try {
        for (var i = 0; i < cardTrabajoNoAprobado.length; i++) {
            cardTrabajoNoAprobado[i].style.display= "none";
        }
    } catch (error) {
        
    }

    try {
        for (var i = 0; i < cardTrabajoSinEvaluador.length; i++) {
            cardTrabajoSinEvaluador[i].style.display= "block";
        }
    } catch (error) {
        
    }

    try {
        for (var i = 0; i < cardTrabajoPendiente.length; i++) {
            cardTrabajoPendiente[i].style.display= "none";
        }
    } catch (error) {
        
    }
    infoNoMasTrabajos.innerHTML ="Ya no tienes más trabajos sin evaluador por el momento.";
}

function trabajoPendiente(){
    try {
        for (var i = 0; i < cardTrabajoAprobado.length; i++) {
            cardTrabajoAprobado[i].style.display= "none";
        }
    } catch (error) {
        
    }

    try {
        for (var i = 0; i < cardTrabajoNoAprobado.length; i++) {
            cardTrabajoNoAprobado[i].style.display= "none";
        }
    } catch (error) {
        
    }

    try {
        for (var i = 0; i < cardTrabajoSinEvaluador.length; i++) {
            cardTrabajoSinEvaluador[i].style.display= "none";
        }
    } catch (error) {
        
    }

    try {
        for (var i = 0; i < cardTrabajoPendiente.length; i++) {
            cardTrabajoPendiente[i].style.display= "block";
        }
    } catch (error) {
        
    }
    infoNoMasTrabajos.innerHTML ="Ya no tienes más trabajos pendientes por el momento.";
}

function todos(){
    try {
        for (var i = 0; i < cardTrabajoAprobado.length; i++) {
            cardTrabajoAprobado[i].style.display= "block";
        }
    } catch (error) {
        
    }

    try {
        for (var i = 0; i < cardTrabajoNoAprobado.length; i++) {
            cardTrabajoNoAprobado[i].style.display= "block";
        }
    } catch (error) {
        
    }

    try {
        for (var i = 0; i < cardTrabajoSinEvaluador.length; i++) {
            cardTrabajoSinEvaluador[i].style.display= "block";
        }
    } catch (error) {
        
    }

    try {
        for (var i = 0; i < cardTrabajoPendiente.length; i++) {
            cardTrabajoPendiente[i].style.display= "block";
        }
    } catch (error) {
        
    }
    infoNoMasTrabajos.innerHTML ="Ya no tienes más trabajos por el momento.";
}
