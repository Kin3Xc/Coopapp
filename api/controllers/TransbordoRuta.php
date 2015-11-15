<?php 
//Transbordo Ruta
$app->get('/cTransbordoRuta',function () {

    global $db;

    //Seleccionar Transbordo Ruta 
    $q = "SELECT * FROM TransbordoRuta";

    $datos = $db->get_results($q);

    echo json_encode($datos);
       
});

//Insertar Transbordo Ruta
$app->post('/iTransbordoRuta',function(){

global $db;


$q	="INSERT INTO `TransbordoRuta`
(`tru_id`,
`tru_fecha`,
`tru_hora`,
`veh_id`,
`con_id`,
`pru_id`)
VALUES
('$tru_id',
'$tru_fecha',
'$tru_hora',
'$veh_id',
'$con_id',
'$pru_id')";


$mensaje = array('mensaje' => 'Insertado' );
});
 ?>