<?php  //Sexo
$app->get('/cSexos',function () {

    global $db;

    //Seleccionar Sexo 
    $q = "SELECT * FROM Sexo";

    $datos = $db->get_results($q);

    echo json_encode($datos);
       
});
$app->get('/cSexo/:id',function ($sexo_id) {
	global $db;
	//Seleccionar Sexo 
    $q = "SELECT * FROM Sexo WHERE sexo_id='$sexo_id'";
	$datos = $db->get_results($q);
	echo json_encode($datos);
});
?>