<?php

  //Tipo Vehiculo
  $app->get('/cTipoVehiculo', function () {

      global $db;

      //Seleccionar Tipo Vehiculo
      $q = "SELECT * FROM TipoVehiculo";

      $datos = $db->get_results($q);

      echo json_encode($datos);
  });



//Insert un nuevo tipo de Vehiculo
  $app->post('/iTipoVehiculo',function (){
    
    global $db;
    $tve_nombre = $_REQUEST['tve_nombre'];
    
    
    $q      =   "INSERT INTO `TipoVehiculo` (
        
        `tve_nombre`
        )
        VALUES (    
         '$tve_nombre'
         );";
    
    $datos   =   $db->query($q);

    //$db->debug();

    $mensaje = array('mensaje'=>'Inserto ok');

     echo json_encode($mensaje);

    });
?>