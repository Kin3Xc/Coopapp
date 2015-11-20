<?php
//Estado Detalle Servicio
$app->get('/cEstadoDetalleServicio',function () {

    global $db;
    $q = "SELECT * FROM EstadoDetalleServicio";
    $datos = $db->get_results($q);
    echo json_encode($datos);
});
//Consultar Por Id
$app->get('/cEstadoDetalleServicio/:id',function ($eds_id) {
    global $db;
    $q = "SELECT * FROM EstadoDetalleServicio WHERE eds_id='eds_id'";
    $datos = $db->get_results($q);
    echo json_encode($datos);
});


//Insertar
$app->post('/iEstadoDetalleServicio',function(){


$eds_id		=$_REQUEST['eds_id'];
$eds_nombre	=$_REQUEST['eds_nombre'];
global $db;

//Estado Detalle Servicio


$q = "INSERT INTO `EstadoDetalleServicio`
(`eds_id`,
`eds_nombre`)
VALUES
($'eds_id',
'$eds_nombre');";

        $datos   =   $db->query($q);

        //$db->debug();
 
        $mensaje = array('mensaje'=>'Inserto ok');

         echo json_encode($mensaje);

        });

//Eliminar

// DELETE route
$app->delete('/eEstadoDetalleServicio',function () {
        

        global $db;

        $q =    "DELETE FROM `Acudiente`
                 WHERE eds_id='$eds_id'";


        $Mensaje = array('mensaje' => 'Insert ok' );
        echo json_encode($mensaje);

});
?>