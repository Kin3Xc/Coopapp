<?php 
//Vehiculo
$app->get('/cVehiculo',function () {

    global $db;

    //Seleccionar Vehiculo 
    $q = <<<OE
            SELECT v.veh_placa, v.veh_capacidad, v.veh_marca, v.veh_linea,
            v.veh_modelo, tv.tve_nombre, ev.eve_nombre
                FROM Vehiculo as v
            INNER JOIN TipoVehiculo as tv on tv.tve_id = v.tve_id
            INNER JOIN EstadoVehiculo as ev on ev.eve_id = v.eve_id
            
OE;

   $datos = $db->get_results($q);
    echo json_encode($datos);
       
});

$app->get('/cVeh',function () {

    global $db;

    //Seleccionar Vehiculo 
    $q = <<<OE
            SELECT * from Vehiculo
            
OE;

   $datos = $db->get_results($q);
    echo json_encode($datos);
       
});

$app->post('/iVehiculo', function() {

    global $db;
    
    $placa = $_REQUEST['veh_placa'];
    $capacidad = $_REQUEST['veh_capacidad'];
    $marca = $_REQUEST['veh_marca'];
    $linea = $_REQUEST['veh_linea'];
    $modelo = $_REQUEST['veh_modelo'];
    $estadoVeh = $_REQUEST['eve_id'];
    $tipoVeh = $_REQUEST['tve_id'];

    $str = <<<OE
                INSERT INTO `Vehiculo`
               (
                `veh_placa`,
                `veh_capacidad`, 
                `veh_marca`, 
                `veh_linea`, 
                `veh_modelo`,
                `tve_id`, 
                `eve_id`) VALUES 
                (
                 '$placa',
                 '$capacidad',
                 '$marca',
                 '$linea',
                 '$modelo',
                 '$tipoVeh',
                 '$estadoVeh')
OE;

    $datos = $db->query($str);
//    $db->debug();
    $mensaje = array('mensaje' => 'Inserto ok');
    echo json_encode($mensaje);
});



 ?>