<?php
$app->get('/cDocumentosVehiculo',function () {
    global $db;
    $q = "SELECT * FROM DocumentosVehiculo";
    $datos = $db->get_results($q);
    echo json_encode($datos);
});


//Consultar detalle Servicio SOlicitado por ID
// $app->get('/cDocumentosVehiculo/:id',function ($dve_id) {
//     global $db;
//     $q = "SELECT * FROM DetalleServicioSolicitado WHERE dve_id='$dve_id'";
//     $datos = $db->get_results($q);
//     echo json_encode($datos);
// });


//Insertar Documentos Vehiculo
$app->post('/iDocumentosVehiculo',function (){

        global $db;
    
        
        $dve_certgasesfecexp     =$_REQUEST['dve_certgasesfecexp'];
        $dve_certgasesfecven     =$_REQUEST['dve_certgasesfecven'];
        $dve_certgasesnumero     =$_REQUEST['dve_certgasesnumero'];
        $dve_soatfecexp          =$_REQUEST['dve_soatfecexp'];
        $dve_soatfecven          =$_REQUEST['dve_soatfecven'];
        $dve_soatnumero          =$_REQUEST['dve_soatnumero'];
        $dve_tpropiedadnumero    =$_REQUEST['dve_tpropiedadnumero'];
        $veh_id                  =$_REQUEST['veh_id'];

        //insertar Documentos Vehiculo
        $q      =   "INSERT INTO `DocumentosVehiculo` (
            `dve_certgasesfecexp`,
            `dve_certgasesfecven`,
            `dve_certgasesnumero`,
            `dve_soatfecexp`,
            `dve_soatfecven`,
            `dve_soatnumero`,
            `dve_tpropiedadnumero`,
            `veh_id`
            ) 
            VALUES (
                '$dve_certgasesfecexp',
                '$dve_certgasesfecven',
                '$dve_certgasesnumero',
                '$dve_soatfecexp',
                '$dve_soatfecven',
                '$dve_soatnumero',
                '$dve_tpropiedadnumero',
                '$veh_id'
            );";


        $datos   =   $db->query($q);

        //$db->debug();
 
        $mensaje = array('mensaje'=>'Inserto ok');

         echo json_encode($mensaje);

        });

//Eliminar

// DELETE route
$app->delete('/eDocumentosVehiculo',function () {
        

        global $db;

        $q =    "DELETE FROM `DocumentosVehiculo`
                 WHERE acu_id='$acu_id'";


        $Mensaje = array('mensaje' => 'Insert ok' );
        echo json_encode($mensaje);

});


?>