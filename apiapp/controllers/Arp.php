<?php 
//Consulta Arp
$app->get('/cArp',function () {

 global $db;
//SELECCIONAR Arp 
    $q = "SELECT * FROM Arp";

    $datos = $db->get_results($q);
    echo json_encode($datos);
       
});

//COnsultar POr Id Arp
$app->get('/cArp/:id',function ($arp_id) {

 global $db;
//SELECCIONAR Arp 
    $q = "SELECT * FROM Arp WHERE arp_id='arp_id'";

    $datos = $db->get_results($q);
    echo json_encode($datos);
       
});



//Insertar
$app->post('/iArp',function (){

        global $db;
    
        $arp_nombre = $_REQUEST['arp_nombre'];
                
        //insertar acudientes
        $q      =   "INSERT INTO `Arp`(
            
            `arp_nombre`
            ) 
            VALUES ('$arp_nombre');";
        
        $datos   =   $db->query($q);

        //$db->debug();
 
        $mensaje = array('mensaje'=>'Inserto ok');

         echo json_encode($mensaje);

        });

        // Modificar arp
        $app->post('/updateArp',function () {
                
            global $db;
            $arp_id     = $_REQUEST['idArp'];
            $arp_nombre = $_REQUEST['arp_nombre'];

            $q =    "UPDATE FROM `Arp` SET arp_nombre='$arp_nombre'
                     WHERE arp_id='$arp_id'";


            $Mensaje = array('mensaje' => 'Update ok' );
            echo json_encode($mensaje);

        });

// DELETE route
$app->delete('/eArp',function () {
        

        global $db;

        $q =    "DELETE FROM `Arp`
                 WHERE arp_id='$arp_id'";


        $Mensaje = array('mensaje' => 'Insert ok' );
        echo json_encode($mensaje);

});


 ?>