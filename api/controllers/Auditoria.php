<?php  
$app->get('/cAuditoria',function () {

    global $db;

    //SELECCIONAR AUDITORIA 
    $q = "SELECT * FROM Auditoria";

    $datos = $db->get_results($q);

    echo json_encode($datos);
       
});
//Auditoria por id
$app->get('/cAuditoria/:id',function ($aud_id) {

 global $db;
//SELECCIONAR Arp 
    $q = "SELECT * FROM Auditoria WHERE aud_id='aud_id'";

    $datos = $db->get_results($q);
    echo json_encode($datos);
       
});


//Insertar Auditoria

//Auditoria

$app->post('/iAuditoria',function (){

        global $db;    
        $aud_fecha       =$_REQUEST['aud_fecha'];    
        $aud_hora       =$_REQUEST['aud_hora'];
        $aud_movimiento =$_REQUEST['aud_movimiento'];
        $aud_formulario =$_REQUEST['aud_formulario'];
        $usu_id         =$_REQUEST['usu_id'];


                
        //insertar Auditoria
        $q      =   "INSERT INTO `Auditoria`(
        
            `aud_fecha`,
            `aud_hora`,
            `aud_movimiento`,
            `aud_formulario`,
            `usu_id`
            ) 
            VALUES (
                    '$aud_fecha',
                    '$aud_hora',
                    '$aud_movimiento',
                    '$aud_formulario',
                    '$usu_id'
                    );";
        
        $datos   =   $db->query($q);

        //$db->debug();
 
        $mensaje = array('mensaje'=>'Inserto ok');

         echo json_encode($mensaje);

        });


//Eliminar

// DELETE route
$app->delete('/eAuditoria',function () {
        

        global $db;

        $q =    "DELETE FROM `Auditoria`
                 WHERE aud_id='$aud_id'";


        $Mensaje = array('mensaje' => 'Insert ok' );
        echo json_encode($mensaje);

});
?>