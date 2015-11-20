<?php  
//Programacion Ruta
$app->get('/cProgramacionRuta',function () {

    global $db;

    //Seleccionar Programacion Ruta 
    $q = "SELECT * FROM ProgramacionRuta";

    $datos = $db->get_results($q);

    echo json_encode($datos);
       
});
$app->get('/cProgramacionRuta/:id',function ($pru_id) {
	global $db;
	//Seleccionar Programacion Ruta 
    $q = "SELECT * FROM ProgramacionRuta WHERE pru_id='$pru_id'";
	$datos = $db->get_results($q);
	echo json_encode($datos);
 });
//Insertar ProgramacionRuta 

$app->post('/iProgramacionRuta',function(){
global $db;

$pru_id		=$_REQUEST['pru_id'];
$pru_fecha	=$_REQUEST['pru_fecha'];
$pru_hora	=$_REQUEST['pru_hora'];
$rtc_id		=$_REQUEST['rtc_id'];
$eru_id		=$_REQUEST['eru_id'];
$cve_id		=$_REQUEST['cve_id'];

$q		= 	("INSERT INTO ProgramacionRuta(
		`pru_id`,
		`pru_fecha`,
		`pru_hora`,
		`rtc_id`,
		`eru_id`,
		`cve_id`)
VALUES(`$pru_id`,
		`$pru_fecha`,
		`$pru_hora`,
		`$rtc_id`,
		`$eru_id`,
		`$cve_id`);");
$mensaje = array('mensaje' => 'Insert Ok' );
echo json_encode($mensaje);

});


//Delete
$app->delete('/eProgramacionRuta',function(){

global $db;


$q=("DELETE FROM `ProgramacionRuta`  WHERE pru_id=`$pru_id`");

$mensaje1 = array('mensaje1' => 'Borrado ok' );

echo json_encode($mensaje1);

});



?>