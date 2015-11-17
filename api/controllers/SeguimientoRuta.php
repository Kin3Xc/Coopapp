<?php  
//SeguimientoRuta
$app->get('/cSeguimientoRuta',function () {
	global $db;
	//Seleccionar Seguimiento Ruta 
    $q = "SELECT * FROM SeguimientoRuta";
	$datos = $db->get_results($q);
	echo json_encode($datos);
 });
$app->get('/cSeguimientoRuta/:id',function ($sru_id) {
	global $db;
	//Seleccionar Seguimiento Ruta 
    $q = "SELECT * FROM SeguimientoRuta sru_id='$sru_id'";
	$datos = $db->get_results($q);
	echo json_encode($datos);
});



//Insertar

$app->post('iSeguimientoRuta',function(){


global $db;
$sru_id=$_REQUEST['sru_id'];
$par_id=$_REQUEST['par_id'];
$esr_id=$_REQUEST['esr_id'];

$q =	"INSERT INTO `rutas`.`SeguimientoRuta`
(`sru_id`,
`par_id`,
`esr_id`)
VALUES
(`$sru_id`,
`par_id`,
`esr_id`);";

$mensaje = array('mensaje' => 'Insert Ok' );
echo json_encode($mensaje);

});
//Delete

$app->delete('/eSeguimientoRuta',function(){
global $db;

$q = "DELETE FROM SeguimientoRuta WHERE sru_id='$sru_id'";


$mensaje = array('mensaje' => 'eliminado' );
echo json_encode($mensaje);



});
?>