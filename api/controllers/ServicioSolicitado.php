<?php
$app->post('/iServicioSolicitado',function(){
    global $db;
    $ssl_total  =$_REQUEST['ssl_total'];
    $ssl_pagado =0;
    $ssl_saldo  =0;
    $ssl_ano    =2015;
    $vsr_id     =$_REQUEST['vsr_id'];
    $alu_id     =$_REQUEST['alu_id'];
//Insercion ServicioSolicitado
    $q = "INSERT INTO `ServicioSolicitado`
        (`ssl_fecha`,
        `ssl_total`,
        `ssl_pagado`,
        `ssl_saldo`,
        `ssl_ano`,
        `vsr_id`,
        `alu_id`)
        VALUES
            (
            NOW(),
            $ssl_total,
            $ssl_pagado,
            $ssl_saldo,
            $ssl_ano,
            $vsr_id,
            $alu_id);";

$datos   =   $db->query($q);
$mensaje = array('mensaje'=>'Inserto ok');
echo json_encode($mensaje);
});



//Consulta
$app->get('/cServicioSolicitado',function () {
    global $db;
    //Seleccionar Servicio Solicitado
    $q = "SELECT * FROM ServicioSolicitado";
    $datos = $db->get_results($q);
    echo json_encode($datos);
});

//Consulta ultima matricula ingresada (servicio solicitado)
$app->get('/cServicioSolicitadoUltimaMatricula',function () {
    global $db;
    //Seleccionar Servicio Solicitado
    $q = "SELECT MAX(ssl_id) as id FROM ServicioSolicitado";
    $datos = $db->get_row($q);
    echo json_encode($datos);
});


//Consulta de los meses
$app->get('/cMeses',function () {
    global $db;
    //Seleccionar Servicio Solicitado
    $q = "SELECT * FROM Meses";
    $datos = $db->get_results($q);
    echo json_encode($datos);
});


//Actualizar Servicio Solicitado
$app->put('/uServicioSolicitado/:id',function ($ssl_id) {
    global $db;
    $ssl_pagado   =   $_REQUEST['ssl_pagado'];
    $ssl_saldo    =   $_REQUEST['ssl_saldo'];
    $ssl_ano      =   $_REQUEST['ssl_ano'];
    $ssl_id       =   $_REQUEST['ssl_id'];


    $q ="UPDATE ServicioSolicitado
      SET
          ssl_saldo     ='$ssl_saldo',
          ssl_pagado    ='$ssl_pagado',
          ssl_ano       ='$ssl_ano'
           WHERE ssl_id ='$ssl_id'";


    $datos   =   $db->query($q);
    $mensaje = array('mensaje'=>'Actualizado ok');
  echo json_encode($mensaje);
});


//Traer Alumno de ssl
  $app->get('/cAlumnossl/:alu_id',function ($alu_id) {

        global $db;

        $q = "SELECT ServicioSolicitado.*, ValorServicio.*
                FROM ServicioSolicitado
                INNER JOIN ValorServicio
                on ValorServicio.vsr_id = ServicioSolicitado.vsr_id
                WHERE alu_id = '$alu_id'

          ";
        $datos = $db->get_results($q);
        echo json_encode($datos);

    });



//Consulta los servicios solicitados por un alumno
$app->get('/cServicioSolicitado/:id',function ($idAlumno) {

        global $db;
        $q     = "SELECT * FROM ServicioSolicitado WHERE idAlumno = alu_id";
        $datos = $db->get_results($q);
        echo json_encode($datos);

    });


// ============================ TIPO DE SERVICIO ====================================


  //Consulta todos los tipos de servicio

  $app->get('/cTipoServicios/:id',function ($idColegio) {
      global $db;
      //Seleccionar Servicio Solicitado
      $q = "SELECT * FROM ValorServicio WHERE col_id=$idColegio";
      $datos = $db->get_results($q);
      echo json_encode($datos);
  });


  // ============================ MATRICULA DEL SERVICIO ====================================

  //Consulta los servicios matriculados por el alumno
  $app->get('/cMatriculasServicioAlumno/:id',function ($idAlumno) {
      global $db;
      //Seleccionar Servicio Solicitado
      $q = "SELECT * FROM ServicioSolicitado WHERE alu_id=$idAlumno";
      $datos = $db->get_results($q);
      echo json_encode($datos);
  });


 //Inserta la matricula del servicio seleccionado al alumno
  $app->post('/iMatriculaServicioAlumno',function(){

    global $db;
    
    $valorTotal      = $_REQUEST['servicioValor'];
    $anio            = $_REQUEST['anio'];
    $idValorServicio = $_REQUEST['idServicio'];
    $idAlumno        = $_REQUEST['id_Alumno'];
    $numCuotas       = $_REQUEST['numCuotas'];
    //$numCuotas++;
    $mesInicio       = $_REQUEST['mesInicio'];


    $q="INSERT INTO `ServicioSolicitado`(
      `ssl_total`,
      `ssl_pagado`,
      `ssl_saldo`,
      `ssl_ano`,
      `vsr_id`,
      `alu_id`,
      `ssl_ncuotas`,
      `ssl_mesinicio`
      )
    VALUES(
      '$valorTotal',
      '0',
      '$valorTotal',
      '$anio',
      '$idValorServicio',
      '$idAlumno',
      '$numCuotas',
      '$mesInicio'
      );";

    $db->query($q);


    $mensaje = array('mensaje' => 'insert ok' );

    echo json_encode($mensaje);
  });



  //Inserta la matricula del servicio seleccionado al alumno
  // $app->post('/iMatriculaServicioAlumno',function(){

  //   global $db;
    
  //   $idAlumno     = $_REQUEST['id_Alumno'];
  //   $idServicio   = $_REQUEST['idServicio'];
  //   $mValor       = $_REQUEST['servicioValor'];


  //   $q="INSERT INTO `Matriculas`(
  //     `idAlumno`,
  //     `idServicios`,
  //     `matriculaValor`
  //     )
  //   VALUES(
  //     '$idAlumno',
  //     '$idServicio',
  //     '$mValor'
  //     );";

  //   $db->query($q);


  //   $mensaje = array('mensaje' => 'insert ok' );

  //   echo json_encode($mensaje);
  // });
?>







