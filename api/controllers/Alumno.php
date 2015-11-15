<?php



    $app->get('/cAlumno',function () {

    global $db;
    
    $q = "SELECT * FROM Alumno
        INNER JOIN Colegio ON Colegio.col_id = Alumno.col_id
        WHERE Colegio.col_id = Alumno.col_id";

    $datos = $db->get_results($q);

    // foreach ($datos as $key => $value) 
    // {        
    //     $datos[$key]->alu_nombre = utf8_encode($value->alu_nombre);
    // }
    echo json_encode($datos);
       });


//Consultas los alumnos de un acudiente
  $app->get('/cAlumnoAcudiente/:idAcudiente',function ($idAcudiente) {

        global $db;

        
        $q     = "SELECT Alumno.*, Colegio.col_nombre AS colegio, Jornada.jor_nombre AS jornada
        FROM Alumno
        INNER JOIN Colegio
        ON Colegio.col_id = Alumno.col_id

        INNER JOIN Jornada
        ON Jornada.jor_id = Alumno.jor_id
         
        WHERE Alumno.acu_id = '$idAcudiente'";

        $datos = $db->get_results($q);


        echo json_encode($datos);

    });



    //Consultas

    $app->get('/cAlumno/:alu_id',function ($alu_id) {

        global $db;

        $q     = "SELECT * FROM Alumno WHERE alu_id = '$alu_id'";
        
        $datos = $db->get_row($q);

        echo json_encode($datos);

    });

    //Consulta alumno por el numero de documento
    $app->get('/cDocAlumno/:alu_documento',function ($alu_documento) {

        global $db;

        $q     = "SELECT * FROM Alumno WHERE alu_documento = '$alu_documento'";
        
        $datos = $db->get_row($q);



        echo json_encode($datos);

    });


    //Consultaa todos los alumnos incluyendo los datos de las tablas relacionadas

    $app->get('/cAlumnoDetalle/:alu_id',function ($alu_id) {

        global $db;

        $q     = "SELECT * FROM Alumno 
                INNER JOIN Acudiente ON Acudiente.acu_id = Alumno.acu_id
                INNER JOIN Jornada ON Jornada.jor_id = Alumno.jor_id
                INNER JOIN Sexo ON Sexo.sex_id = Alumno.sex_id
                INNER JOIN TipoSangre ON TipoSangre.tsa_id = Alumno.tsa_id
                INNER JOIN Eps ON Eps.eps_id = Alumno.eps_id
                INNER JOIN Ciudad ON Ciudad.ciu_id = Alumno.ciu_id
                INNER JOIN Colegio ON Colegio.col_id = Alumno.col_id
                INNER JOIN Zona ON Zona.zon_id = Alumno.zon_id
                INNER JOIN Curso ON Curso.cur_cod = Alumno.cur_cod
                WHERE alu_id = '$alu_id'";
        
        $datos = $db->get_row($q);

        echo json_encode($datos);

    });


//consultas alumno por colegio

    $app->get('/colAlumnos/:col_id',function ($col_id) {

        global $db;

        $q = "SELECT * FROM `Alumno` WHERE `col_id` = $col_id";
        
        $datos = $db->get_results($q);

        // foreach ($datos as $key => $value) 
        // {        
        //     $datos[$key]->alu_nombre = utf8_encode($value->alu_nombre);
        // }
        
       echo json_encode($datos);
    });

    //Consulta todos los alumnos de un colegio que tienen un servicio matriuclado
    $app->get('/cAlumnosColegioMatricula/:col_id',function ($col_id) {

        global $db;

        // $q = "SELECT *, alu_nombre AS title FROM `Alumno` 
        //     INNER JOIN Matriculas ON `Matriculas`.`idAlumno` = `Alumno`.`alu_id`
        //     WHERE `col_id` = $col_id AND `Matriculas`.`idAlumno` NOT IN (SELECT `idAlumno` from `RutaAlumnos`)
        //     GROUP BY `Alumno`.`alu_id`";

        $q = "SELECT *, alu_nombre AS title FROM `Alumno` 
            INNER JOIN ServicioSolicitado ON `ServicioSolicitado`.`alu_id` = `Alumno`.`alu_id`
            WHERE `col_id` = $col_id AND `ServicioSolicitado`.`alu_id` NOT IN (SELECT `idAlumno` from `RutaAlumnos`)
            GROUP BY `Alumno`.`alu_id`";

        
        $datos = $db->get_results($q);
        //$db->debug();

       // function FuncionParaJson($datos){

       //  foreach ($datos as $key => $value) {
            
       //      $datos[$key]->n_hotel = utf8_encode($value->n_hotel);
       //  }

       //  return $datos;

    //} 
       //echo json_encode($datos,JSON_UNESCAPED_UNICODE);
       echo json_encode($datos);

    });

    /*
    SELECT column_name(s)
    FROM table1
    JOIN table2
    ON table1.column_name=table2.column_name;
    */




//Insertar

    $app->post('/iAlumno',function (){

        global $db;
 //Alumno Campos

        $alu_documento  =       $_REQUEST['alu_documento'];        
        $alu_nombre     =       $_REQUEST['alu_nombre'];
        $alu_anomat     =       $_REQUEST['alu_anomat'];
        $jor_id         =       $_REQUEST['jornada'];
        $sex_id         =       $_REQUEST['sexo'];
        $alu_dir        =       $_REQUEST['alu_dir'];
        $alu_dir_com    =       $_REQUEST['alu_dir_com'];
        $alu_telfijo    =       $_REQUEST['alu_telfijo'];
        $alu_telcelular =       $_REQUEST['alu_telcelular'];
        $alu_fechanac   =       $_REQUEST['alu_fechanac'];
        $tsa_id         =       $_REQUEST['tipoSangre'];
        $eps_id         =       $_REQUEST['tipoEps'];
        $alu_barrio     =       $_REQUEST['alu_barrio'];
        $ciu_id         =       $_REQUEST['ciudades'];
        $col_id         =       $_REQUEST['colegio'];
        $acu_id         =       $_REQUEST['acu_id'];
        $zon_id         =       $_REQUEST['zona'];
        $cur_cod        =       $_REQUEST['curso'];
        $latitude       =       $_REQUEST['latitude'];
        $longitude      =       $_REQUEST['longitude'];

        echo "latitude = ".$latitude;
        echo "longitude = ".$longitude;
        
        //insertar acudientes
        $q      =   "INSERT INTO `Alumno` (
            `alu_documento`,
            `alu_nombre`,
            `alu_anomat`,
            `jor_id`,
            `sex_id`,
            `alu_dir`,
            `alu_dir_com`,
            `alu_telfijo`,
            `alu_telcelular`,
            `alu_fechanac`,
            `tsa_id`,
            `eps_id`,
            `alu_barrio`,
            `ciu_id`,
            `col_id`,
            `acu_id`,
            `zon_id`,
            `cur_cod`,
            `latitude`,
            `longitude`)
            VALUES (
             '$alu_documento',
             '$alu_nombre',
             '$alu_anomat',
             '$jor_id',
             '$sex_id',
             '$alu_dir',
             '$alu_dir_com',
             '$alu_telfijo',
             '$alu_telcelular',
             '$alu_fechanac',
             '$tsa_id',
             '$eps_id',
             '$alu_barrio',
             '$ciu_id',
             '$col_id',
             '$acu_id',
             '$zon_id',
             '$cur_cod',
             '$latitude',
             '$longitude'
             );";

        $datos   =   $db->query($q);

        //$db->debug();

        $mensaje = array('mensaje'=>'Inserto ok');

         echo json_encode($mensaje);
        });

//=================== UPDATE (Modificaciones) ============================

$app->post('/upAlumno',function (){

        global $db;

        $alu_id         =       $_REQUEST['alu_id'];        
        $alu_documento  =       $_REQUEST['alu_documento'];        
        $alu_nombre     =       $_REQUEST['alu_nombre'];
        $alu_anomat     =       $_REQUEST['alu_anomat'];
        $jor_id         =       $_REQUEST['jor_id'];
        $sex_id         =       $_REQUEST['sex_id'];
        $alu_dir        =       $_REQUEST['alu_dir'];
        $alu_dir_com    =       $_REQUEST['alu_dir_com'];
        $alu_telfijo    =       $_REQUEST['alu_telfijo'];
        $alu_telcelular =       $_REQUEST['alu_telcelular'];
        $alu_fechanac   =       $_REQUEST['alu_fechanac'];
        $tsa_id         =       $_REQUEST['tsa_id'];
        $eps_id         =       $_REQUEST['eps_id'];
        $alu_barrio     =       $_REQUEST['alu_barrio'];
        $ciu_id         =       $_REQUEST['ciu_id'];
        $col_id         =       $_REQUEST['col_id'];
        $acu_id         =       $_REQUEST['acu_id'];
        $zon_id         =       $_REQUEST['zon_id'];
        $cur_cod        =       $_REQUEST['cur_cod'];
        $latitude       =       $_REQUEST['latitude'];
        $longitude      =       $_REQUEST['longitude'];


        $q      =   "UPDATE `Alumno` SET

            `alu_documento`  = '$alu_documento',
            `alu_nombre`     = '$alu_nombre',
            `alu_anomat`     = '$alu_anomat',
            `jor_id`         = '$jor_id',
            `sex_id`         = '$sex_id',
            `alu_dir`        = '$alu_dir',
            `alu_dir_com`    = '$alu_dir_com',
            `alu_telfijo`    = '$alu_telfijo',
            `alu_telcelular` = '$alu_telcelular',
            `alu_fechanac`   = '$alu_fechanac',
            `tsa_id`         = '$tsa_id',
            `eps_id`         = '$eps_id',
            `alu_barrio`     = '$alu_barrio',
            `ciu_id`         = '$ciu_id',
            `col_id`         = '$col_id',
            `acu_id`         = '$acu_id',
            `zon_id`         = '$zon_id',
            `cur_cod`        = '$cur_cod',
            `latitude`       = '$latitude',
            `longitude`      = '$longitude' 

            WHERE alu_id = '$alu_id'";

        $datos   =   $db->query($q);

        //$db->debug();

        $mensaje = array('mensaje'=>'Inserto ok');

         echo json_encode($mensaje);
        });

////=================== FIN UPDATE (Modificaciones) ============================


// DELETE route
$app->delete('/eAlumno',function () {


        global $db;

        $q =    "DELETE FROM `Alumno`
                 WHERE alu_id = '$alu_id'";


        $Mensaje = array('mensaje' => 'Insert ok' );
        echo json_encode($mensaje);

});

?>