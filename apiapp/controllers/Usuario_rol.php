<?php 
 //Usuario Rol
$app->get('/cUsuarioRol',function () {

    global $db;

    //Seleccionar Usuario Rol 
    $q = "SELECT * FROM UsuarioRol";

    $datos = $db->get_results($q);

    echo json_encode($datos);
       
});


?>
    