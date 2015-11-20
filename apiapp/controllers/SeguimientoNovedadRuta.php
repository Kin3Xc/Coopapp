<?php 
//SeguimientoNovedadRuta
$app->get('/cSeguimientoNovedadRuta',function () {

    global $db;

    //Seleccionar Seguimiento Novedad Ruta
    $q = "SELECT * FROM SeguimientoNovedadRuta";

    $datos = $db->get_results($q);

    echo json_encode($datos);
       
});
//Consultar Seguimiento Novedad Ruta
$app->get('/cSeguimientoNovedadRuta/:id',function ($snr_id) {
	global $db;
	//Seleccionar Seguimiento Novedad Ruta
    $q = "SELECT * FROM SeguimientoNovedadRuta WHERE snr_id='$snr_id'";
	$datos = $db->get_results($q);
	echo json_encode($datos);
 });
//INSERTAR
$app->post('/iSeguimientoNovedadRuta',function(){
global $db;
$snr_id			=$_REQUEST['snr_id'];
$snr_fecha		=$_REQUEST['snr_fecha'];	
$snr_hora		=$_REQUEST['snr_hora'];
$pru_id			=$_REQUEST['pru_id'];		
$nru_id			=$_REQUEST['nru_id'];
$q ="INSERT INTO `rutas`.`SeguimientoNovedadRuta`
(`snr_id`,
`snr_fecha`,
`snr_hora`,
`pru_id`,
`nru_id`)
VALUES
(`$snr_id`,
`$snr_fecha`,
`$snr_hora: `,
`$pru_id`,
`$nru_id`);";
$mensaje = array('mensaje' => 'insert ok' );
echo json_encode($mensaje);

});

//delete

$app->delete('/eSeguimientoNovedadRuta',function(){

global $db;


$q="DELETE FROM `SeguimientoNovedadRuta` WHERE snr_id=`$snr_id`";

$mensaje = array('mensaje' => 'Borrado' );
echo json_encode($mensaje);

});





 ?>