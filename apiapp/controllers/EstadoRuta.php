<?php
    $app->get('/cEstadoRuta',function () {
        global $db;
        $q = "SELECT * FROM EstadoRuta";
        $datos = $db->get_results($q);
        echo json_encode($datos);
    });

    //Consultar Por ID
    $app->get('/cEstadoRuta/:id',function ($eds_id) {
        global $db;
        $q = "SELECT * FROM EstadoRuta WHERE eds_id='$eds_id'";
        $datos = $db->get_results($q);
        echo json_encode($datos);
    });

    //Insertar
    $app->post('/iEstadoRuta',function(){
        //$eru_id		=$_REQUEST['eru_id'];
        global $db;
        $eru_nombre	=$_REQUEST['nombreEstadoRuta'];
        
        //Estado Detalle Servicio
        $q = "INSERT INTO `EstadoRuta`
        (`eru_nombre`)
        VALUES
        ('$eru_nombre');";
        
        $datos   =   $db->query($q);
        $mensaje = array('mensaje'=>'Inserto ok');
        echo json_encode($mensaje);
    });

    //Eliminar
    $app->delete('/eEstadoRuta',function () {
            global $db;
            $q =    "DELETE FROM `EstadoRuta`
                     WHERE eru_id='$eru_id'";
            $Mensaje = array('mensaje' => 'delete ok' );
            echo json_encode($mensaje);
    });
?>