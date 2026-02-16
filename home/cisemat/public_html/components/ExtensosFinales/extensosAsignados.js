
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

console.log("fsdf");

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
}



