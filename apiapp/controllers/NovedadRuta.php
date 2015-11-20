<?php
$app->get('/cNovedadRuta',function () {

    global $db;

   //Seleccionar Novedad Ruta 
    $q = "SELECT * FROM NovedadRuta";

    $datos = $db->get_results($q);

    echo json_encode($datos);
       
});
$app->get('/cNovedadRuta/:id',function ($nru_id) {

    global $db;
	//Seleccionar Novedad Ruta 
    $q = "SELECT * FROM NovedadRuta WHERE nru_id='$nru_id'";
	$datos = $db->get_results($q);
    echo json_encode($datos);
 });


$app->post('/iNovedadRuta',function(){

//Insertos
global $db;
$nru_nombre		=$_REQUEST['nru_nombre'];
$q =	"INSERT INTO `NovedadRuta`(`nru_nombre`)
			VALUES($nru_nombre);";
			$mensaje = array('mensaje' => 'Insert Ok' );
			echo json_encode($mensaje);
});

//DEletes
$app->delete('/eNovedadRuta',function(){
global $db;

$q =  "DELETE FROM NovedadRuta WHERE nru_id='$nru_id'";
$mensaje = array('mensaje' => 'Borrado Ok' );
echo json_encode($mensaje);
});
?>