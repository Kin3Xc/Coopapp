<?php
//Consultar EPS
$app->get('/cEps',function () {
    global $db;
    $q = "SELECT * FROM Eps";
    $datos = $db->get_results($q);
    echo json_encode($datos);
});

//Consultar EPS por Id
$app->get('/cEps/:id',function ($eps_id) {
    global $db;
    $q = "SELECT * FROM Eps WHERE eps_i='$eps_id'";
    $datos = $db->get_results($q);
    echo json_encode($datos);
});

//Insertar EPS
$app->post('/iEps',function (){
        global $db;
//        $eps_id     =$_REQUEST['eps_id'];
        $eps_nombre =$_REQUEST['eps_nombre'];
        $q=  "INSERT INTO  `Eps` (
                            `eps_id` ,
                            `eps_nombre`
                            )
                            VALUES (
                            '',
                            '$eps_nombre'
                            );";
        $datos   =   $db->query($q);
        //$db->debug();
        $mensaje = array('mensaje'=>'Inserto ok');
         echo json_encode($mensaje);
});
//Eliminar
// DELETE route
$app->delete('/eEps',function () {
        global $db;
        $q =    "DELETE FROM `Eps`
         WHERE eps_id='$eps_id'";
        $Mensaje = array('mensaje' => 'Delete ok' );
        echo json_encode($mensaje);
});
?>