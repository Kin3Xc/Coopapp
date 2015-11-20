<?php  
$app->post('/iTipoSangre',function(){

global $db;
//Insert 

$q	= "INSERT INTO `TipoSangre`
(`tsa_id`,
`tsa_nombre`)
VALUES
('$tsa_id',
'$tsa_nombre'>)";

$datos   =   $db->query($q);

$mensaje = array('mensaje'=>'Inserto ok');

echo json_encode($mensaje);

});

	//Tipo Sangre
	$app->get('/cTipoSangre',function () {

	    global $db;

	    //Seleccionar Tipo Sangre
	    $q = "SELECT * FROM TipoSangre";

	    $datos = $db->get_results($q);

	    echo json_encode($datos);

	       
	});
?>