<?php
$app->get('/cMantenimientoVehiculo',function () {

    global $db;
//Seleccionar Manteniemiento Vehiculo
$q = "SELECT * FROM MantenimientoVehiculo";

    $datos = $db->get_results($q);

    echo json_encode($datos);
       
});
//Consultar MVE por ID
$app->get('/cMantenimientoVehiculo/:id',function ($mve_id) {

    global $db;
//Seleccionar Manteniemiento Vehiculo
$q = "SELECT * FROM MantenimientoVehiculo WHERE mve_id='$mve_id'";
	  $datos = $db->get_results($q);
       echo json_encode($datos);
 });
//Insercion
$app->post('/iMantenimientoVehiculo',function(){
$mve_id				=$_REQUEST['mve_id'];
$mve_taller			=$_REQUEST['mve_taller'];
$mve_fecha			=$_REQUEST['mve_fecha'];
$mve_taller			=$_REQUEST['mve_taller'];
$mve_descripcionact	=$_REQUEST['mve_descripcionact'];
$veh_id				=$_REQUEST['veh_id'];

global $db;
$q	=	"INSERT INTO `MantenimientoVehiculo`
	(`mve_id`,
	`mve_fecha`,
	`mve_taller`,
	`mve_descripcionact`,
	`veh_id`)
	VALUES
	('$mve_id',
	'$mve_fecha',
	'$mve_taller',
	'$mve_descripcionact',
	'$veh_id');";

$mensaje = array('mensaje' => 'Insert ok' );
echo json_encode ($mensaje);


});
// DELETE route
$app->delete('/eMantenimientoVehiculo',function () {
        

        global $db;

        $q =    "DELETE FROM `MantenimientoVehiculo`
                 WHERE mve_id='$mve_id'";


        $Mensaje = array('mensaje' => 'delete ok' );
        echo json_encode($mensaje);

    });
?>