<?php

    //Consultar todos los Grados
    
    $app->get('/cGrados',function () {
        global $db;
        //SELECCIONAR CURSO 
        $q = "SELECT * FROM Grado";
        $datos = $db->get_results($q);
        echo json_encode($datos);
    });

    //Insertar Grado
    $app->post('/iGrado',function (){

    global $db;

    $gra_nombre = $_REQUEST['gra_nombre'];
            
    $q      =   "INSERT INTO `Grado`(
        
        `gra_nombre`
        ) 
        VALUES ('$gra_nombre');";
    
    $datos   =   $db->query($q);

    //$db->debug();

    $mensaje = array('mensaje'=>'Inserto ok');

     echo json_encode($mensaje);

    });