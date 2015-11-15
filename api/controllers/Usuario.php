<?php

  //Usuario
$app->get('/cUsuario',function () {

    global $db;

    //Seleccionar Usuario 
    $q = "SELECT * FROM Usuario";

    $datos = $db->get_results($q);

    echo json_encode($datos);
       
});

?>