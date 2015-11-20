<?php  
//Conductor Vehiculo
$app->get('/cConductorVehiculo',function () {

    global $db;

    //SELECCIONAR Conductor Vehiculo
    $q = <<<OE
            
   SELECT v.veh_placa , c.con_nombre 
            FROM ConductorVehiculo as cv
            INNER JOIN Vehiculo as v on v.veh_id = cv.veh_id
            INNER JOIN Conductor as c on c.con_id = cv.con_id
OE;
    $datos = $db->get_results($q);

    echo json_encode($datos);
       
});
//Consultar Por Id
$app->get('/cConductorVehiculo/:id',function ($cve_id) {

    global $db;

    //SELECCIONAR Conductor Vehiculo
    $q = "SELECT * FROM ConductorVehiculo WHERE cve_id='$cve_id'";

    $datos = $db->get_results($q);

    echo json_encode($datos);
       
});

// NUEVO
//Consultar Por id de conductor
$app->get('/cConductorRuta/:id',function ($con_id) {

    global $db;

    $q = "SELECT * FROM ConductorVehiculo WHERE con_id='$con_id'";

    $datos = $db->get_results($q);

    echo json_encode($datos);  
});

// NUEVO
//Consultar el ID de la ruta del conductor por id de vehiculo
$app->get('/cIdRutaConductor/:id',function ($veh_id) {

    global $db;

    $q = "SELECT * FROM vehiculosRuta WHERE idVehiculo='$veh_id'";

    $datos = $db->get_results($q);

    echo json_encode($datos);  
});

// NUEVO
//Consultar la ruta del conductor por id de vehiculo
$app->get('/cRutaConductor/:id',function ($rut_id) {

    global $db;

    $q = "SELECT * FROM Ruta WHERE rut_id='$rut_id'";

    $datos = $db->get_results($q);

    echo json_encode($datos);  
});

// NUEVO
//Consultar los estudiantes de una ruta
$app->get('/cRutaConductorAlumnos/:id',function ($rut_id) {

    global $db;

    $q = "SELECT * FROM Ruta WHERE rut_id='$rut_id'";

    $datos = $db->get_results($q);

    echo json_encode($datos);  
});






//Insert Conductor Vehiculo

//Conductor Vehiculo
$app->post('/iConductorVehiculo',function (){

        global $db;
    
        $veh_id         =$_REQUEST['veh_id'];
        $con_id         =$_REQUEST['con_id'];          
        //insertar ConductorVehiculo
        $q      =   "INSERT INTO `ConductorVehiculo` (
            `veh_id`,
            `con_id`
            ) 
            VALUES (                
                '$veh_id',
                '$con_id'
             );";
        
        $datos   =   $db->query($q);

        //$db->debug();
 
        $mensaje = array('mensaje'=>'Inserto ok');

         echo json_encode($mensaje);

        });
//Eliminar

// DELETE route
$app->delete('/eConductorVehiculo',function () {
        

        global $db;

        $q =    "DELETE FROM `ConductorVehiculo`
                 WHERE cve_id='$cve_id'";


        $Mensaje = array('mensaje' => 'Insert ok' );
        echo json_encode($mensaje);

});
?>