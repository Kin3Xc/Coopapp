<?php 
//Usuario Rol
$app->get('/cUsuarioRol',function () {

    global $db;

    //Seleccionar Usuario Rol 
    $q = "SELECT * FROM UsuarioRol";

    $datos = $db->get_results($q);

    echo json_encode($datos);
       
});

$app->get('/iUsuarioRol',function(){


	$usr_id 	=$_REQUEST['$usr_id'];
	$usu_id 	=$_REQUEST['$usu_id'];
	$rol_id 	=$_REQUEST['$rol_id'];



global $db;


$q	=	"INSERT INTO `UsuarioRol`
(`usr_id`,
`usu_id`,
`rol_id`)
VALUES
($usr_id,
$usu_id,
$rol_id);";

$mensaje = array('mensaje' => 'insertado' );
echo json_encode($mensaje);



});

?>