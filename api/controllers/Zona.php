<?php  
//Zona
$app->get('/cZona',function () {
     global $db;

    //Seleccionar Zona 
    $q = "SELECT * FROM Zona";

    $datos = $db->get_results($q);

    echo json_encode($datos);
       
});
?>