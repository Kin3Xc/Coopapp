<?php 

$app->get('/cTipoCuenta',function () {
    global $db;


    //Seleccionar Tipo Sangre
    $q = <<<OE
            
            SELECT * FROM TipoCuenta
            
OE;
    
     $datos = $db->get_results($q);
foreach ($datos as $key => $value) {

$datos[$key]->tct_nombre = utf8_encode($value->tct_nombre);
}

    echo json_encode($datos);
       
});



?>