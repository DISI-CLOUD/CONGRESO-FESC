<div id="menuReportes d-sm-none d-md-block">
    <div class="mt-3">
    <ul class="nav nav-tabs">
    <li class="nav-item">
        <a id="catalogoTrabajosNav" onclick="mostrarCatalogoTrabajos()" class="nav-link  navYPestaña" aria-current="page" href="#">Catálogo</a>
    </li>
    <li class="nav-item">
        <a id="extensosAprobadosNav"  onclick="mostrarExtensosAprobados()" class="nav-link navYPestaña" href="#"><?php echo $tipoReporte; ?> Aprobados</a>
    </li>
    <li class="nav-item">
        <a id="extensosPendientesCorregirNav" onclick="mostrarExtensosPendientesEvaluar()" class="nav-link navYPestaña"  href="#"><?php echo $tipoReporte; ?> Pendientes por Evaluar</a>
    </li>
    <li class="nav-item">
        <a id="extensosPendientesEvaluarNav" onclick="mostrarExtensosPendientesCorregir()" class="nav-link navYPestaña"  href="#"><?php echo $tipoReporte; ?> Pendientes por Corregir</a>
    </li>
    <li class="nav-item">
        <a id="asignacionesEvaluadores" onclick="mostrarTablaDeEvaluadores()" class="nav-link navYPestaña"  href="#">Evaluadores</a>
    </li>
    </ul>
    </div>  
    <div class="mt-2">
</div>