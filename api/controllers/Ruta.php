<?php  

//================ Consultas ==============================
//Ruta
$app->get('/cRuta',function () {
    global $db;
	//Seleccionar Ruta 
    $q = "SELECT * FROM Ruta";
	$datos = $db->get_results($q);
	echo json_encode($datos);
       
});

$app->get('/cRutaEspecifica/:idRuta',function ($rut_id) {
    global $db;
	//Seleccionar Ruta 
    $q = "SELECT * FROM Ruta WHERE rut_id='$rut_id'";
	$datos = $db->get_row($q);
	echo json_encode($datos);
 });


//Consultar las Rutas de un Colegio
$app->get('/cRutasColegio/:idColegio',function ($idColegio) {
    global $db;
	//Seleccionar Ruta 
    $q = "SELECT * FROM Ruta WHERE idColegio='$idColegio'";
	$datos = $db->get_results($q);
	echo json_encode($datos);
 });

//Consultar los alumnos pertenecientes a una ruta
$app->get('/cAlumnosRuta/:idColegio/:idRuta',function ($idColegio, $idRuta) {
    global $db;

	//Seleccionar alumnos
    $q = "SELECT `Alumno`.`alu_id`,`Alumno`.`alu_nombre`,`Alumno`.`latitude`,`Alumno`.`longitude`,`Alumno`.`col_id`,`RutaAlumnos`.`Orden`,`RutaAlumnos`.`Hora` from `RutaAlumnos`
    INNER JOIN `Alumno` ON alu_id = idAlumno
    INNER JOIN `Ruta` ON rut_id = idRuta
    WHERE `rut_id` = $idRuta and `col_id`=$idColegio 
    ORDER BY `Orden`";  
	$datos = $db->get_results($q);
	echo json_encode($datos);
 });



//Actualiza los datos (Orden, Hora) de los Alumnos pertenecientes a la Ruta seleccionada
// estos cambios se efectúan en la tabla RutaAlumnos
$app->post('/upAlumnosRuta',function(){

	global $db;
	
	$AluRut_idAlumno=$_REQUEST['idAlumno'];
	$AluRut_orden 	=$_REQUEST['ordenAlumno'];
	$AluRut_hora	=$_REQUEST['horaAlumno'];


	$q="UPDATE `RutaAlumnos` SET `Orden`='$AluRut_orden', `Hora`='$AluRut_hora' WHERE `idAlumno`='$AluRut_idAlumno';";

	$db->query($q);


	$mensaje = array('mensaje' => 'Update ok' );

	echo json_encode($mensaje);
});

//Elimibna el Alumno pertenecientes a la Ruta seleccionada
// estos cambios se efectúan en la tabla RutaAlumnos
$app->post('/delAlumnosRuta',function(){

	global $db;
	
	$AluRut_idAlumno=$_REQUEST['idAlumno'];


	$q="DELETE from `RutaAlumnos` WHERE `idAlumno`='$AluRut_idAlumno';";

	$db->query($q);


	$mensaje = array('mensaje' => 'Update ok' );

	echo json_encode($mensaje);
});


//Inserta una nueva ruta para el colegio
$app->post('/iRutaColegio',function(){

	global $db;
	
	$rut_nombre	=$_REQUEST['rut_nombre'];
	$rut_origen =$_REQUEST['rut_origen'];
	$rut_destino=$_REQUEST['rut_destino'];
	$idColegio=$_REQUEST['idColegio'];


	$q="INSERT INTO `Ruta`(
		`rut_nombre`,
		`rut_origen`,
		`rut_destino`,
		`idColegio`
		)
	VALUES('$rut_nombre','$rut_origen','$rut_destino','$idColegio');";

	$db->query($q);


	$mensaje = array('mensaje' => 'insert ok' );

	echo json_encode($mensaje);
});



//Inserta un listado de alumnos en la ruta actual

$app->post('/iAlumnosRutaColegio',function(){

	global $db;
	
	$idAlumno = $_REQUEST['alumnos'];
	$idRuta = $_REQUEST['ruta'];
	$Orden=0;
	$Hora=0;
	$Obs=0;

	if(count($idAlumno) >= 1)
	{
		for ($i=0; $i < count($idAlumno) ; $i++) { 
			$cAlumno = $idAlumno[$i];
			$q="INSERT INTO `RutaAlumnos`(
			`idAlumno`,
			`idRuta`,
			`Orden`,
			`Hora`,
			`Observaciones`
			)
		VALUES('$cAlumno','$idRuta','$Orden','$Hora','$Obs');";

		$db->query($q);
		}
	}

	


	$mensaje = array('mensaje' => 'insert ok' );

	echo json_encode($mensaje);
});




//Delete

$app->delete('/eRuta', function(){

global $db;
 $q =	"DELETE FROM `Ruta` WHERE rut_id=`$rut_id`";

$mensaje = array('mensaje' => 'borrado bien' );
echo json_encode($mensaje);

});
?>