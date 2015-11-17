<?php  
//Paradas Ruta
$app->get('/cParadasRuta',function () {

    global $db;

    //Seleccionar Paradas Ruta
    $q = "SELECT * FROM ParadasRuta";

    $datos = $db->get_results($q);

    echo json_encode($datos);
       
});
$app->get('/cParadasRuta/:id',function ($par_id) {
    global $db;
   //Seleccionar Paradas Ruta
    $q = "SELECT * FROM ParadasRuta par_id='$par_id'";
	$datos = $db->get_results($q);
	echo json_encode($datos);
 });

$app->post('/iParadasRuta',function(){
	global $db;
	$par_id		=$_REQUEST['par_id'];
	$pru_id		=$_REQUEST['pru_id'];
	$alu_id		=$_REQUEST['alu_id'];
$q = ("INSERT INTO `ParadasRuta`
	(`par_id`,
	 `pru_id`,
	 `alu_id`)
VALUES(`$par_id`,`$pru_id`,`$alu_id`);

");
$mensaje = array('mensaje' => 'insert Ok' );
echo json_encode($mensaje);

});


//Delete
$app->delete('/eParadasRuta',function(){
global $db;

$q	=(
	"DELETE FROM ParadasRuta WHERE 
	par_id='$par_id'"
	);
$mensaje = array('mensaje' => 'delete ok' );
echo json_encode($mensaje);
});


?>
