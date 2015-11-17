<?php  


//Consulta los vehiculos que tiene asignada una ruta --------------------------------

$app->get('/cVehiculosRuta/:rut_id',function ($rut_id) {
    global $db;
    //Seleccionar Ruta 
    $q = "SELECT Vehiculo.veh_placa, Vehiculo.veh_marca FROM vehiculosRuta
    INNER JOIN Ruta ON rut_id = '$rut_id'
    INNER JOIN Vehiculo ON Vehiculo.veh_id = vehiculosRuta.idVehiculo
    WHERE idRuta='$rut_id'";
    $datos = $db->get_results($q);
    echo json_encode($datos);
 });



//Asignar un vehiculo a una ruta
$app->post('/iVehiculoRuta',function (){

        global $db;

        $idRuta  =$_REQUEST['idRuta'];
        $veh_id     =$_REQUEST['veh_id'];
                     
        //insertar Colegio
        $q      =   "INSERT INTO `vehiculosRuta` (
            
            `idRuta`,
            `idVehiculo`
            )
            VALUES (    
             '$idRuta',
             '$veh_id'
             );";
        
        $datos   =   $db->query($q);

        //$db->debug();
 
        $mensaje = array('mensaje'=>'Inserto ok');

         echo json_encode($mensaje);

        });

//Eliminar

// DELETE route
$app->delete('/delvehiculosRuta',function () {
        

        global $db;

        $q =    "DELETE FROM `vehiculosRuta`
                 WHERE col_id='$col_id'";


        $Mensaje = array('mensaje' => 'Insert ok' );
        echo json_encode($mensaje);

});
?>