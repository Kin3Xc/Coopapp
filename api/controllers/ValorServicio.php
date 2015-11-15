<?php 
    //Servicio
    //POST route
    $app->get('/cValorServicio',function () {

        global $db;

        //SELECCIONAR ALUMNOS 
        $q = "SELECT * FROM ValorServicio";

        $datos  = $db->get_results($q);
        echo json_encode($datos);
           
    });


    //LISTAR EN EL SELECT O EN UNA TABLA TODOS LOS SERVICIOS DE UN COLEGIO
    // @icColegio
    // retorna listado de los serv.
    // JEYSON 25 MAYO 2015

    $app->get('/cValorServicioColegio/:idColegio',function ($idColegio) {

        global $db;

        //SELECCIONAR ALUMNOS 
        $q = "SELECT * FROM ValorServicio WHERE col_id = $idColegio";

        
        $datos  = $db->get_results($q);
        	
        if($datos){

        echo json_encode($datos);


        }else{

        	$response = array();
        	$response['error'] = true;
        	$response['message'] = "No hay datos";
        	
        echo json_encode($response);
        }


           
    });


    // TRAER VARIABLE DE PARAMETRIZACION Y COLEGIO
    // @NOMBRE VARIABLE
    // @ID COLEGIO
    // RETORNA UN VALOR
    // JEYSON 25 MAYO 2015

    $app->get('/cParametros/:variable/:idColegio',function ($variable, $idColegio) {

        global $db;

        //SELECCIONAR ALUMNOS 
        $q = "SELECT * FROM Parametros WHERE `pr_tipo` = '$variable' AND idColegio = $idColegio";

        $datos  = $db->get_results($q);
            
        if($datos){

        echo json_encode($datos);


        }else{

            $response = array();
            $response['error'] = true;
            $response['message'] = "No hay datos";
            
        echo json_encode($response);
        }       
    });

    //=========================================================== Insertar ================================================
    
    //Insertar un nuevo servicio
    $app->post('/iServicio',function (){

    global $db;

    $vsr_nombre = $_REQUEST['vsr_nombre'];
    $vsr_valor  = $_REQUEST['vsr_valor'];
    $vsr_anio   = $_REQUEST['vsr_anio'];
    $zon_id     = $_REQUEST['zon_id'];
    $col_id     = $_REQUEST['col_id'];
            
    $q      =   "INSERT INTO `ValorServicio`
        (
        
        `vsr_nombre`,
        `vsr_valor`,
        `vsr_anio`,
        `zon_id`,
        `col_id`

        ) 
        VALUES 
        (
            '$vsr_nombre',
            '$vsr_valor',
            '$vsr_anio',
            '$zon_id',
            '$col_id'
        );";
    
    $datos   =   $db->query($q);

    //$db->debug();

    $mensaje = array('mensaje'=>'Inserto ok');

     echo json_encode($mensaje);

    });
 ?>