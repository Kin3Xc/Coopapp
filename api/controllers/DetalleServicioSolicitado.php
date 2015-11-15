<?php


    //Calcula los días entre la fecha a pagar y la fecha actual
    $app->get('/cDias/:fecha',function ($fecha) {

        global $db;
        $q = " SELECT DATEDIFF( NOW() , DATE_ADD( $fecha, INTERVAL 0 DAY)) AS dias ";
        $datos = $db->get_var($q);

        //echo "consulta dif: ".$datos;

        echo json_encode($datos);
    });




    $app->get('/cDetalleServicioSolicitado/:dias/:fechaInicio/:fechaFinal',function ($dias, $fechaInicio, $fechaFinal) {

    global $db;

    //$dias = 90;

    
    //SELECCIONAR Detalle Servicio Solicitado 
        $q = " SELECT * FROM DetalleServicioSolicitado
            INNER JOIN EstadoDetalleServicio ON EstadoDetalleServicio.eds_id = DetalleServicioSolicitado.eds_id
            INNER JOIN ServicioSolicitado ON ServicioSolicitado.ssl_id = DetalleServicioSolicitado.ssl_id
            INNER JOIN ValorServicio ON ValorServicio.vsr_id = ServicioSolicitado.vsr_id
            INNER JOIN Alumno ON Alumno.alu_id = ServicioSolicitado.alu_id
            INNER JOIN Acudiente ON Acudiente.acu_id = Alumno.acu_id
            WHERE ServicioSolicitado.ssl_id = DetalleServicioSolicitado.ssl_id 
            -- AND DATEDIFF( NOW() , DATE_ADD( DetalleServicioSolicitado.dsl_fechapagar, INTERVAL $dias DAY)) <($dias+30)
            -- AND DATEDIFF( NOW() , DATE_ADD( DetalleServicioSolicitado.dsl_fechapagar, INTERVAL $dias DAY)) >0
            -- AND DATEDIFF('2014-06-05','2014-08-05')  

            AND $dias = 0 
            OR (
                DATEDIFF( NOW() , DATE_ADD( DetalleServicioSolicitado.dsl_fechapagar, INTERVAL $dias DAY)) > $dias
                AND DATEDIFF( NOW() , DATE_ADD( DetalleServicioSolicitado.dsl_fechapagar, INTERVAL $dias DAY)) < $dias+30
                
            )

        ";
    $datos = $db->get_results($q);
    echo json_encode($datos);
});


//Actualizar 
$app->put('/uDetalleServicioSolicitado/:id', function ($id) {
  global $db;
 $dsl_fechapagar                =$_REQUEST['dsl_fechapagar'];
 $dsl_fechapago                 =$_REQUEST['dsl_fechapago'];
 $dsl_cuota                     =$_REQUEST['dsl_cuota'];
 $dsl_valorcuotanormal          =$_REQUEST['dsl_valorcuotanormal'];  
 $dsl_valorcuotadescuento       =$_REQUEST['dsl_valorcuotadescuento'];
 $dsl_aplicadescuento           =$_REQUEST['dsl_aplicadescuento'];
 $dsl_pordescuento              =$_REQUEST['dsl_pordescuento'];
 $dsl_valorcuotaincremento      =$_REQUEST['dsl_valorcuotaincremento'];
 $eds_id                        =$_REQUEST['eds_id'];
 $ssl_id                        =$_REQUEST['ssl_id'];
   $q ="UPDATE ServicioSolicitado 
  SET dsl_fechapagar        ='$dsl_fechapagar',
  dsl_fechapago             ='$dsl_fechapago',
  dsl_cuota                 ='$dsl_cuota',
  dsl_valorcuotanormal      ='$dsl_valorcuotanormal',
  dsl_valorcuotadescuento   ='$dsl_valorcuotadescuento',
  dsl_aplicadescuento       ='$dsl_aplicadescuento'
  dsl_pordescuento          ='$dsl_pordescuento'
  dsl_valorcuotaincremento  ='$dsl_valorcuotaincremento'
  dsl_valorcuotadescuento   ='$dsl_valorcuotadescuento'
  eds_id                    ='$eds_id'
  ssl_id                    ='$ssl_id'
  WHERE dsl_id='$dsl_id'";
});


//Consultar detalle Servicio SOlicitado por ID
$app->get('/cDetalleServicioSolicitado/:id',function ($dsl_id) {
    global $db;
    $q = "SELECT * FROM DetalleServicioSolicitado WHERE dsl_id='$dsl_id'";
    $datos = $db->get_results($q);
    echo json_encode($datos);
       
});



//Consultar Numero de cuotas del Servicio Solicitado por ID del Alumno
$app->get('/cDetalleServicioSolicitadoAlumno/:id',function ($idAlumno) {

    global $db;
    $q     = "SELECT * FROM DetalleServicioSolicitado AS dsl
      INNER JOIN ServicioSolicitado AS serv ON dsl.ssl_id = serv.ssl_id
      INNER JOIN Alumno ON Alumno.alu_id = serv.alu_id
      WHERE Alumno.alu_id = $idAlumno AND eds_id=2 limit 0,1
      ";

    $datos = $db->get_row($q);
    echo json_encode($datos);
       
});

$app->get('/DetalleServicioSolicitado',function(){
global $db;
$q ="SELECT 'SSL.alu_id', 
            'SSL.ssl_id',
            'SSL.acu_id' 
            'VSR.vsr_id'
             FROM ServicioSolicitado SSL, ValorServicio VSR WHERE 'SSL.alu_id'='SSL.ssl_id';";

$datos = $db->get_results($q);
echo json_encode($datos);

});

//Insertar Detalle Servicio Solicitado
//Detalle Servicio Solicitado
$app->post('/iDetalleServicioSolicitado',function (){
  global $db;

  // $valorTotal      = $_REQUEST['servicioValor'];
  $anio            = $_REQUEST['anio'];
  // $idValorServicio = $_REQUEST['idServicio'];
  // $idAlumno        = $_REQUEST['id_Alumno'];
  // $numCuotas       = $_REQUEST['numCuotas'];
  $mesInicio       = $_REQUEST['mesInicio'];
  
  
  
  //$dsl_id                  =$_REQUEST['dsl_id'];
  //$dsl_fechapagar          =$_REQUEST['dsl_fechapagar'];
  $dsl_fechapagar   =      $anio."-".str_pad($mesInicio, 2, "0", STR_PAD_LEFT)."-08";
  //$dsl_fechapago           =$_REQUEST['dsl_fechapago'];
  $dsl_cuota               =$_REQUEST['numCuotas'];
  $dsl_valorcuotanormal    =$_REQUEST['servicioValor'];
  //$dsl_valorcuotadescuento =$_REQUEST['dsl_valorcuotadescuento'];
  //$dsl_aplicadescuento     =$_REQUEST['dsl_aplicadescuento'];
  //$dsl_pordescuento        =$_REQUEST['dsl_pordescuento'];
  //$dsl_valorcuotaincremento=$_REQUEST['dsl_valorcuotaincremento'];
  //eds_id                  =$_REQUEST['eds_id'];
  $ssl_id                  = $_REQUEST['idServicioSolicitado']; 
  
  // $longitud = strlen($ssl_id);
  // $sustraida = substr($ssl_id,-4,3);
  // //$sustraida = substr($ssl_id,-1,1);
  // $ssl_id = $sustraida;  
  
  
  // $ssl_id = "SELECT MAX(ssl_id) FROM ServicioSolicitado";
  
  
  //$dato = $db->get_var($ssl_id);
  echo "==== ".$dsl_fechapagar."\n";
  echo "==== ".$dsl_cuota."\n";
  echo "==== ".$dsl_valorcuotanormal."\n";
  echo "====ll ".$ssl_id."\n";

  //generar(5,3);


  for ($i=0; $i <= $dsl_cuota ; $i++) 
  { 
    # code...
    //insertar DetalleServicioSolicitado
    $q      =   "INSERT INTO `DetalleServicioSolicitado` (
            
        `dsl_fechapagar`,
        `dsl_fechapago`,
        `dsl_cuota`,
        `dsl_valorcuotanormal`,
        `eds_id`,
        `ssl_id`,
        `dsl_mes`
        ) 
        VALUES (
                '$dsl_fechapagar',
                '0',
                '$dsl_cuota',
                '$dsl_valorcuotanormal',
                '2',
                '$ssl_id',
                '$mesInicio'
         );";
    
    $datos   =   $db->query($q);

    //echo $dsl_fechapagar."\n";
    $dsl_fechapagar = date("Y-m-d", strtotime("$dsl_fechapagar + 1 months"));

    if($mesInicio <12)
    {
      $mesInicio++;
    }
    if($mesInicio>12)
    {
      $mesInicio = 1;
    }
  }

  //$db->debug();

  $mensaje = array('mensaje'=>'Inserto ok');

  echo json_encode($mensaje);

});

// DELETE route
$app->delete('/eDetalleServicioSolicitado',function () {
        

        global $db;

        $q =    "DELETE FROM `DetalleServicioSolicitado`
                 WHERE dsl_id='$dsl_id'";

        $Mensaje = array('mensaje' => 'Insert ok' );
        echo json_encode($mensaje);
});




$app->get('/edsDetalleServicioSolicitado',function(){
global $db;
$q = "SELECT A.dsl_id , 
A.dsl_fechapagar ,
A.dsl_fechapago,
B.ssl_id ,
B.alu_id,
C.acu_id,
C.cur_cod ,
C.zon_id,
C.col_id,
D.gra_id,
H.acu_nombre,
F.col_nombre,
I.gra_nombre,
C.alu_nombre,
E.zon_nombre,
R.rut_nombre
FROM DetalleServicioSolicitado AS A
INNER JOIN ServicioSolicitado AS B ON A.ssl_id = B.ssl_id
INNER JOIN ValorServicio AS G ON B.vsr_id = G.vsr_id
INNER JOIN Alumno AS C ON B.alu_id = C.alu_id
INNER JOIN Acudiente as H ON C.acu_id = H.acu_id
INNER JOIN Curso AS D ON C.cur_cod = D.cur_cod
INNER JOIN Zona AS E ON C.zon_id = E.zon_id
INNER JOIN Colegio AS F ON C.col_id = F.col_id
INNER JOIN Grado AS I ON D.gra_id = I.gra_id
INNER JOIN RutaColegio AS RC ON C.col_id=RC.col_id
INNER JOIN Ruta AS R ON RC.rut_id=R.rut_id
WHERE A.eds_id =1 
LIMIT 0,1";
$datos = $db->get_results($q);
echo json_encode($datos);

});


$app->get('/prevDetalleServicioSolicitado',function(){
    global $db;
    $q ="SELECT alu_id,
    alu_nombre WHERE acu_id = '$acu_id'";

    $datos =$db->get_results($q);
    echo json_encode($datos);
});






?>

