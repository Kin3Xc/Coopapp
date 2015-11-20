<?php
$app->get('/cEstadoVehiculo',function () {

    global $db;
    //Seleccionar Estado Vehiculo
    $q = "SELECT * FROM EstadoVehiculo";
    $datos = $db->get_results($q);
    echo json_encode($datos);
});
//Consultar Por Id
$app->get('/cEstadoVehiculo/:id',function ($eve_id) {

    global $db;
    //Seleccionar Estado Vehiculo
    $q = "SELECT * FROM EstadoVehiculo WHERE eve_id=$eve_id";
    $datos = $db->get_results($q);
    echo json_encode($datos);
});

//Estado Vehiculo
$app->post('/iEstadoVehiculo',function(){
        $eve_nombre=$_REQUEST['eve_nombre'];
        global $db;
        $q = "INSERT INTO `EstadoVehiculo`
        (`eve_nombre`)
        VALUES
        ('$eve_nombre');";
        $datos   =   $db->query($q);
        //$db->debug();
         $mensaje = array('mensaje'=>'Inserto ok');
        echo json_encode($mensaje);
});
// DELETE route
$app->delete('/eEstadoVehiculo',function () {
        global $db;
        $q =    "DELETE FROM `EstadoVehiculo`
                 WHERE eve_id='$eve_id'";
        $Mensaje = array('mensaje' => 'delete ok' );
        echo json_encode($mensaje);
});
?>