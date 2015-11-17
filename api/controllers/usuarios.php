<?php 
//Consulta Usuarios
$app->get('/cUsuarios',function () {

 global $db;
//SELECCIONAR Arp 
    $q = "SELECT * FROM Usuario";

    $datos = $db->get_results($q);
    echo json_encode($datos);
       
});





//Insertar Usuarios
$app->post('/iUsuario',function (){

        global $db;
    
        $usu_nombre    = $_REQUEST['usu_nombre'];
        $usu_login     = $_REQUEST['usu_login'];
        $usu_password  = $_REQUEST['usu_password'];
        $usu_documento = $_REQUEST['usu_documento'];
                
        //insertar acudientes
        $q      =   "INSERT INTO `Usuario`(
            
            `usu_nombre`,
            `usu_login`,
            `usu_password`,
            `usu_documento`,
            `usu_estado`
            ) 
            VALUES (
                '$usu_nombre',
                '$usu_login',
                '$usu_password',
                '$usu_documento',
                '1'
            );";
        
        $datos   =   $db->query($q);

        //$db->debug();
 
        $mensaje = array('mensaje'=>'Inserto ok');

         echo json_encode($mensaje);

        });

        // Modificar arp
        $app->post('/upUsuario',function () {
                
            global $db;
            $usu_id       = $_REQUEST['usu_id'];
            $usu_password = $_REQUEST['usu_password'];

            $q =    "UPDATE FROM `Usuarios` 
                    SET usu_password='$usu_password'
                    WHERE Usuarios='$usu_id'";


            $Mensaje = array('mensaje' => 'Update ok' );
            echo json_encode($mensaje);

        });
 ?>