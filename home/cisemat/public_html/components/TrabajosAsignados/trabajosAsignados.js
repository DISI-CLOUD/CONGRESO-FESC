var infoNoMasTrabajos=document.getElementById("infoNoMasTrabajos");

try {
    var cardTrabajoEvaluadoAprobado=document.getElementsByClassName("cardTrabajoEvaluadoAprobado");
} catch (error) {
    
}

try {
    var cardTrabajoEvaluadoRechazado=document.getElementsByClassName("cardTrabajoEvaluadoRechazado");
} catch (error) {
    
}

try {
    var cardPendientePorEvaluar=document.getElementsByClassName("cardPendientePorEvaluar");
} catch (error) {
    
}

try {
    var historialEvaluador=document.getElementsByClassName("historialEvaluador");
} catch (error) {
    
}


//Funciones para filtrar dependiente del estado de la tarjeta

function todos(){
    try {
        for (var i = 0; i < cardTrabajoEvaluadoAprobado.length; i++) {
            cardTrabajoEvaluadoAprobado[i].style.display= "block";
        }
    } catch (error) {
        
    }

    try {
        for (var i = 0; i < cardTrabajoEvaluadoRechazado.length; i++) {
            cardTrabajoEvaluadoRechazado[i].style.display= "block";
        }
    } catch (error) {
        
    }

    try {
        for (var i = 0; i < cardPendientePorEvaluar.length; i++) {
            cardPendientePorEvaluar[i].style.display= "block";
        }
    } catch (error) {
        
    }
    try {
        for (var i = 0; i < historialEvaluador.length; i++) {
            historialEvaluador[i].style.display= "none";
        }
    } catch (error) {
        
    }
    infoNoMasTrabajos.innerHTML ="Ya no tienes más trabajos por el momento.";
}

function trabajosEvaluados(){
    try {
        for (var i = 0; i < cardTrabajoEvaluadoAprobado.length; i++) {
            cardTrabajoEvaluadoAprobado[i].style.display= "block";
        }
    } catch (error) {
        
    }

    try {
        for (var i = 0; i < cardTrabajoEvaluadoRechazado.length; i++) {
            cardTrabajoEvaluadoRechazado[i].style.display= "block";
        }
    } catch (error) {
        
    }

    try {
        for (var i = 0; i < cardPendientePorEvaluar.length; i++) {
            cardPendientePorEvaluar[i].style.display= "none";
        }
    } catch (error) {
        
    }
    try {
        for (var i = 0; i < historialEvaluador.length; i++) {
            historialEvaluador[i].style.display= "none";
        }
    } catch (error) {
        
    }
    infoNoMasTrabajos.innerHTML ="Ya no tienes más trabajos evaluados por el momento.";
}

function trabajosPorEvaluar(){
    try {
        for (var i = 0; i < cardTrabajoEvaluadoAprobado.length; i++) {
            cardTrabajoEvaluadoAprobado[i].style.display= "none";
        }
    } catch (error) {
        
    }

    try {
        for (var i = 0; i < cardTrabajoEvaluadoRechazado.length; i++) {
            cardTrabajoEvaluadoRechazado[i].style.display= "none";
        }
    } catch (error) {
        
    }

    try {
        for (var i = 0; i < cardPendientePorEvaluar.length; i++) {
            cardPendientePorEvaluar[i].style.display= "block";
        }
    } catch (error) {
        
    }
    try {
        for (var i = 0; i < historialEvaluador.length; i++) {
            historialEvaluador[i].style.display= "none";
        }
    } catch (error) {
        
    }

    infoNoMasTrabajos.innerHTML ="Ya no tienes más trabajos por evaluar por el momento.";
}

function historial(){
    try {
        for (var i = 0; i < cardTrabajoEvaluadoAprobado.length; i++) {
            cardTrabajoEvaluadoAprobado[i].style.display= "none";
        }
    } catch (error) {
        
    }

    try {
        for (var i = 0; i < cardTrabajoEvaluadoRechazado.length; i++) {
            cardTrabajoEvaluadoRechazado[i].style.display= "none";
        }
    } catch (error) {
        
    }

    try {
        for (var i = 0; i < cardPendientePorEvaluar.length; i++) {
            cardPendientePorEvaluar[i].style.display= "none";
        }
    } catch (error) {
        
    }
    try {
        for (var i = 0; i < historialEvaluador.length; i++) {
            historialEvaluador[i].style.display= "block";
        }
    } catch (error) {
        
    }
}

