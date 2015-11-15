<?php //Rol
$app->get('/cRol',function () {
    global $db;
	//Seleccionar Rol
    $q = "SELECT * FROM Rol";
	$datos = $db->get_results($q);
	echo json_encode($datos);
       
});
$app->get('/cRol/:id',function ($rol_id) {
    global $db;
    //Seleccionar Rol
    $q = "SELECT * FROM Rol WHERE rol_id='$rol_id'";
	$datos = $db->get_results($q);
	echo json_encode($datos);
});

//INsert
$app->post('/iRol',function(){

global $db;

$rol_id=['rol_id'];
$rol_nombre=['rol_nombre'];

	$q="INSERT INTO `Rol`(
	`rol_id`,
	`rol_nombre`)
VALUES(`$rol_id`,`$rol_nombre`);";

$mensaje = array('mensaje' => 'Insert Ok' );
echo json_encode($mensaje);


});


//DELETE
$app->delete('/eRol',function(){

global $db;

$q	= "DELETE FROM `Rol` WHERE rol_id=`$rol_id`";
$mensaje = array('mensaje' => 'delete ok' );
echo json_encode($mensaje);

});

?>