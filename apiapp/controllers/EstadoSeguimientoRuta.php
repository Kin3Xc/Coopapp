<?php 
$app->get('/cEstadoSeguimientoRuta',function () {
    global $db;
    $q = "SELECT * FROM EstadoSeguimientoRuta";
    $datos = $db->get_results($q);
    echo json_encode($datos);
});
//Estado Seguimiento Ruta
$app->get('/cEstadoSeguimientoRuta/:id',function ($esr_id) {
    global $db;
    $q = "SELECT * FROM EstadoSeguimientoRuta WHERE esr_id='$esr_id'";
    $datos = $db->get_results($q);
    echo json_encode($datos);
});
//Insertar
$app->post('/EstadoSeguimientoRuta',function(){
$esr_nombre	=$_REQUEST['esr_nombre'];
global $db;

//Estado Detalle Servicio


$q = "INSERT INTO `EstadoSeguimientoRuta`
(`esr_id`,
`esr_nombre`)
VALUES
('$esr_id',
 '$esr_nombre');";

        $datos   =   $db->query($q);

        //$db->debug();
 
        $mensaje = array('mensaje'=>'Inserto ok');

         echo json_encode($mensaje);

        });
// DELETE route
$app->delete('/eEstadoSeguimientoRuta',function () {
        

        global $db;

        $q =    "DELETE FROM `EstadoSeguimientoRuta`
                 WHERE esr_id='$esr_id'";


        $Mensaje = array('mensaje' => 'delete ok' );
        echo json_encode($mensaje);

});


?>