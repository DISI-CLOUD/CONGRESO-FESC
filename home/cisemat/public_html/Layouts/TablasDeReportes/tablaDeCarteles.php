<div id="tablaDeCarteles"  class="scroll table-responsive border border-success border-opacity-10 rounded pt-2 px-2 pb-5 mt-4">
<table class="table">
    <tr class="head-table">
        <th scope="col">Id Ponencia</th>
        <th scope="col">Congreso</th>
        <th scope="col">Titulo</th>
        <!--th scope="col">Fecha Registro</th-->
        <th scope="col">Autor</th>
        <th scope="col">Correo Autor</th>
        <th scope="col">Resumen</th>
        <th scope="col">Evaluador</th>
        <th scope="col">Correo Evaluador</th>
        <th scope="col">Fecha Ultima Revisión</th>
        <th scope="col">Etapa</th>
        <th scope="col">Estatus</th>
        <th scope="col">Cartel</th>
        <th scope="col">Link Video</th>      
    </tr>
    </thead>
    <tbody>
    <tr>
        <?php
            require "../../modelo/cartelesHistorico.php";

            while ($fetchCartelesHistorico=mysqli_fetch_assoc($resCartelesHistorico)){
                $idPonencia=$fetchCartelesHistorico['id_ponencia'];
                //Se da formato al id del trabajo, se debe modificar si el congreso excede los tres digitos
                $idPonenciaFormato=substr("$idPonencia", 0,-2);
                $nombreAutor=$fetchCartelesHistorico['Autor'];
                $emailAutor=$fetchCartelesHistorico['email_usuario'];
                $tituloPonencia=$fetchCartelesHistorico['titulo_ponencia'];
                $tipoPonencia=$fetchCartelesHistorico['categoria_ponencia'];
                $idCongreso=$fetchCartelesHistorico['id_congreso'];
                $categoriaPonencia=$fetchCartelesHistorico['categoria'];
                $fechaRegistroPonencia=$fetchCartelesHistorico['fecha_registro_ponencia'];
                $descargasemblanza=$fetchCartelesHistorico['semblanza'];
                $rutaCartel=$fetchCartelesHistorico['cartel'];
                $videoPonencia=$fetchCartelesHistorico['video_ponencia'];

                //Da formato de fecha
                $date = date_create($fechaRegistroPonencia);
                $fechaRegistroPonenciaFormato=date_format($date,"Y/m/d H:i");

                $idUsuarioRegistra=$fetchCartelesHistorico['id_usuario_registra'];
                $idUsuarioEvalua=$fetchCartelesHistorico['id_usuario_evalua'];

                //$consUsuarioRegistra = "SELECT * FROM usuario WHERE id_usuario='$idUsuarioRegistra'";
                //$resUsuarioRegistra = mysqli_query($conexion, $consUsuarioRegistra);
                //$fetchUsuarioRegistra=mysqli_fetch_assoc($resUsuarioRegistra);
                //$nombreUsuarioRegistra=$fetchUsuarioRegistra['nombres_usuario'];
                //$apellidosUsuarioRegistra=$fetchUsuarioRegistra['apellidos_usuario'];
                //$emailUsuarioRegistra=$fetchUsuarioRegistra['email_usuario'];
                //$nombreCompletoAutor=$nombreUsuarioRegistra." ".$apellidosUsuarioRegistra;
                

                if($idUsuarioEvalua!=''){
                    $consUsuarioEvalua = "SELECT * FROM usuario WHERE id_usuario='$idUsuarioEvalua'";
                    $resUsuarioEvalua = mysqli_query($conexion, $consUsuarioEvalua);
                    $fetchUsuarioEvalua=mysqli_fetch_assoc($resUsuarioEvalua);
                    $nombreUsuarioEvalua=$fetchUsuarioEvalua['nombres_usuario'];
                    $apellidoUsuarioEvalua=$fetchUsuarioEvalua['apellidos_usuario'];
                    $emailUsuarioEvalua=$fetchUsuarioEvalua['email_usuario'];

                    $nombreCompletoEvaluador=$nombreUsuarioEvalua." ".$apellidoUsuarioEvalua;

                    //Verifica que tenga revisiones
                    $consUsuarioRevisiones = "SELECT * FROM usuario_revision_ponencia WHERE id_ponencia='$idPonencia'";
                    
                    $resUsuarioRevisiones = mysqli_query($conexion, $consUsuarioRevisiones);
                    $fetchUsuarioRevisiones = mysqli_fetch_assoc($resUsuarioRevisiones);
                    if($fetchUsuarioRevisiones){
                        $consUsuarioRevisionPonencia = "SELECT * FROM revision WHERE revision.fecha_revision=(SELECT MAX(fecha_revision) FROM revision 
                        INNER JOIN usuario_revision_ponencia ON revision.id_revision=usuario_revision_ponencia.id_revision_ponencia
                        WHERE usuario_revision_ponencia.id_ponencia='$idPonencia')";
                        
                        $resUsuarioRevisionPonencia = mysqli_query($conexion, $consUsuarioRevisionPonencia);
                        $fetchUsuarioRevisionPonencia = mysqli_fetch_assoc($resUsuarioRevisionPonencia);
                        //Campos de la revision
                        $estadoRevisionPonencia=$fetchUsuarioRevisionPonencia['estatus_revision'];
                        $descripcionRevisionPonencia=$fetchUsuarioRevisionPonencia['descripcion_revision'];
                        $fechaRevisionPonencia=$fetchUsuarioRevisionPonencia['fecha_revision'];
                        //Da formato de fecha
                        $date = date_create($fechaRevisionPonencia);
                        $fechaRevisionPonenciaFormato=date_format($date,"Y/m/d H:i");
                        if($estadoRevisionPonencia==''){
                            $estadoRevisionPonencia='PENDIENTE DE EVALUAR';    
                        }
                        //Si el se le ha rechazado el resumen al usuario
                        if($estadoRevisionPonencia=='R' && $descripcionRevisionPonencia=='RESUMEN' && $rutaCartel==''){
                            $estadoRevisionPonencia='RECHAZADO';    
                            $descripcionRevisionPonencia='RESUMEN';
                        }
                        //Si el usuario no ha subido su CARTEL 
                        if($estadoRevisionPonencia=='A' && $descripcionRevisionPonencia=='RESUMEN' && $rutaCartel==''){
                            $estadoRevisionPonencia='CARTEL PENDIENTE POR SUBIR';    
                            $descripcionRevisionPonencia='RESUMEN';
                        } 
                        //Si el usuario ya subio su cartel
                        if($estadoRevisionPonencia=='A' && $descripcionRevisionPonencia=='CARTEL' && $rutaCartel!=''){
                            $estadoRevisionPonencia='FINALIZADO';    
                            $descripcionRevisionPonencia='CARTEL';
                        }                       
                    }else{
                        //Campos de la revision
                        $estadoRevisionPonencia="-";
                        $fechaRevisionPonenciaFormato="-";
                    }
                }else{
                    $nombreCompletoEvaluador='NO ASIGNADO';
                    $emailUsuarioEvalua='NO ASIGNADO';
                    $descripcionRevisionPonencia='SIN EVALUADOR ASIGNADO';
                    $estadoRevisionPonencia="ESPERANDO EVALUADOR";
                    $fechaRevisionPonenciaFormato="-";
                }
                
                
        ?>
            <td scope="col"><?php echo $idPonenciaFormato; ?></td>
            <td scope="col"><?php echo $idCongreso; ?></td>
            <td scope="col"><?php echo $tituloPonencia; ?></td>
            <!--td scope="col"><?php echo $fechaRegistroPonenciaFormato; ?></td-->
            <td scope="col"><?php echo $nombreAutor; ?></td>
            <td scope="col"><a href="mailto:<?php echo $emailAutor ?>"><?php echo $emailAutor ?></a></td>
            <td class="text-wrap text-uppercase">
                            <a id="boton-<?php echo $idPonencia; ?>" class="btn btn-secondary mt-3" href="../../components/VisualizacionResumen/visualizacionResumen.php?id=<?php echo $idPonencia; ?>&visualizacion=1" target="_blank">Resumen</a>
                        </td>
             <td class="text-wrap text-uppercase">
                            <a id="boton-<?php echo $idPonencia; ?>" class="btn btn-secondary mt-3" href="<?php echo $descargasemblanza; ?>" target="_blank">Semblanza</a>
                        </td>
            <td scope="col"><?php echo $nombreCompletoEvaluador; ?></td>
            <td scope="col"><a href="mailto:<?php echo $emailUsuarioEvalua ?>"><?php echo $emailUsuarioEvalua ?></a></td>
            <td scope="col"><?php echo $fechaRevisionPonenciaFormato; ?></td>
            <td scope="col"><?php echo $descripcionRevisionPonencia; ?></td>
            <td scope="col"><?php echo $estadoRevisionPonencia ; ?></td>
            
            <?php
            if($rutaCartel!=''){
                ?>
                <td scope="col"><a target='_blank' href="<?php echo $rutaCartel ?>">Descargar</a></td>
                <?php
            }else{
                ?>
                <td scope="col">-</td>
                <?php

            }
            
            ?>

            <?php
            if($videoPonencia!=''){
                ?>
                <td scope="col" ><a target="_blank" href='<?php echo $videoPonencia; ?>'>Link Video</a></td>
                <?php
            }else{
                ?>
                <td scope="col">-</td>
                <?php

            }
            ?>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>
</div>