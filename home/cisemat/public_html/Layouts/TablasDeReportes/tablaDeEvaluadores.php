<div id="tablaDeEvaluadores"  class="tablaDeEvaluadores scroll table-responsive border border-success border-opacity-10 rounded pt-2 px-2 pb-5 mt-4">
<!-- <button class="btn btn-style block px-4 my-2 mx-2" onclick="exportTableToExcel('tableEvaluadores', 'Evaluadores Asignados')">Descargar Excel</button> -->
<table class="table" id="tableEvaluadores">
    <tr class="head-table">
        <th scope="col">Id Usuario</th>
        <th scope="col">Apellidos Evaluador</th>
        <th scope="col">Nombres Evaluador</th>
        <th scope="col">Email</th>
        <th scope="col">Trabajos Asignados</th>
        <th scope="col">Número Máximo de Trabajos Asignados</th>
    </tr>
    </thead>
    <tbody>
    
        <?php
            require "../../modelo/reporteEvaluadores.php";
            while ($fetchReporteEvaluadores=mysqli_fetch_assoc($resTraerReporteEvaluadores)) {
                //Guarda los datos en las variables
                $idEvalaluador=$fetchReporteEvaluadores['id_usuario_evalua'];
                $nombresEvaluador=$fetchReporteEvaluadores['nombres_usuario'];
                $apellidosEvaluador=$fetchReporteEvaluadores['apellidos_usuario'];
                $emailEvaluador=$fetchReporteEvaluadores['email_usuario'];
                $trabajosAsignados=$fetchReporteEvaluadores['ponencias_asignadas'];
                $numeroMaximoDeTrabajosAsignados=$fetchReporteEvaluadores['numero_ponencias'];        
               
                //Concatenacion de los nombres
                //$nombreCompletoEvaluador=$nombresEvaluador." ".$apellidosEvaluador;
        ?>
        <tr>
            <td scope="col"><?php echo $idEvalaluador; ?></td>
            <td scope="col"><?php echo $apellidosEvaluador; ?></td>
            <td scope="col"><?php echo $nombresEvaluador; ?></td>
            <td scope="col"><a href="mailto:<?php echo $emailEvaluador ?>"><?php echo $emailEvaluador ?></a></td>
            <td scope="col"><?php echo $trabajosAsignados; ?></td>
            <td scope="col"><?php echo $numeroMaximoDeTrabajosAsignados; ?></td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>


</div>

<div id="tablaDeEvaluadores2"  class="tablaDeEvaluadores scroll table-responsive border border-success border-opacity-10 rounded pt-2 px-2 pb-5 mt-4">
<h3 class="mt-5 mb-5">Evaluadores Sin Ponencias Asignadas</h3>
<button class="btn btn-style block px-4 my-2 mx-2" onclick="exportTableToExcel('tableEvaluadores2', 'Todos los evaluadores')">Descargar Excel</button>
<table class="table" id="tableEvaluadores2">
    <tr class="head-table">
        <th scope="col">Id Usuario</th>
        <th scope="col">Apellidos Evaluador</th>
        <th scope="col">Nombres Evaluador</th>
        <th scope="col">Email</th>
        <th scope="col">Trabajos Asignados</th>
        <th scope="col">Número Máximo de Trabajos Asignados</th>
    </tr>
    </thead>
    <tbody>
    
        <?php
            require "../../modelo/reporteEvaluadoresSinAsignacion.php";
            while ($fetchReporteEvaluadoresSinAsignacion=mysqli_fetch_assoc($resTraerReporteEvaluadoresSinAsignacion)) {
                //Guarda los datos en las variables
                $idEvalaluador=$fetchReporteEvaluadoresSinAsignacion['id_usuario'];
                $nombresEvaluador=$fetchReporteEvaluadoresSinAsignacion['nombres_usuario'];
                $apellidosEvaluador=$fetchReporteEvaluadoresSinAsignacion['apellidos_usuario'];
                $emailEvaluador=$fetchReporteEvaluadoresSinAsignacion['email_usuario'];
                $numeroMaximoDeTrabajosAsignados=$fetchReporteEvaluadoresSinAsignacion['numero_ponencias'];        
               
                //Concatenacion de los nombres
                //$nombreCompletoEvaluador=$nombresEvaluador." ".$apellidosEvaluador;
        ?>
        <tr>
            <td scope="col"><?php echo $idEvalaluador; ?></td>
            <td scope="col"><?php echo $apellidosEvaluador; ?></td>
            <td scope="col"><?php echo $nombresEvaluador; ?></td>
            <td scope="col"><a href="mailto:<?php echo $emailEvaluador ?>"><?php echo $emailEvaluador ?></a></td>
            <td scope="col"><?php echo "0"; ?></td>
            <td scope="col"><?php echo $numeroMaximoDeTrabajosAsignados; ?></td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>
</div>
