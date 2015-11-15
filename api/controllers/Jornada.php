<?php
$app->get('/cJornada',function () {
	global $db;
    //SELECCIONAR Detalle Servicio Solicitado 
    $q = "SELECT * FROM  `Jornada` LIMIT 0 , 30";
	$datos = $db->get_results($q);
   echo json_encode($datos);
	
});

$app->get('/prueba',function () {
    
    echo "algo";
    
});

$app->get('/cJornada/:id',function () {
    global $db;
    //SELECCIONAR Detalle Servicio Solicitado 
    $q = "SELECT * FROM  `Jornada` WHERE jor_id='$jor_id' LIMIT 0 , 30";
    $datos = $db->get_results($q);
    echo json_encode($datos);
});

$app->post('/iJornada',function () {
    global $db;
    $jor_id		=$_REQUEST['jor_id'];
    $jor_nombre	=$_REQUEST['jor_nombre'];
    //SELECCIONAR Detalle Servicio Solicitado 
    $q = "INSERT INTO `Jornada` 
    ('jor_id',
    'jor_nombre')
	Values('$jor_id','$jor_nombre')";
  	$datos   =   $db->query($q);
	$mensaje = array('mensaje' => 'insertado' );
    echo json_encode($mensaje);
});
?>