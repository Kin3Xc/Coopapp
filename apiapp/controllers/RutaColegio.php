
<?php  
//Ruta Colegio
$app->get('/cRutaColegio',function () {

    global $db;

    //Seleccionar Ruta Colegio
    $q = "SELECT * FROM RutaColegio";

    $datos = $db->get_results($q);

    echo json_encode($datos);
       
});
$app->get('/cRutaColegio/id',function ($rtc_id) {
	global $db;
	//Seleccionar Ruta Colegio
    $q = "SELECT * FROM RutaColegio WHERE rtc_id='$rtc_id'";
	$datos = $db->get_results($q);
	echo json_encode($datos);
       
});


$app->post('/iRutaColegio',function(){

global $db;
$rtc_id 		=$_REQUEST['rtc_id'];
$rut_id			=$_REQUEST['rut_id'];
$col_id			=$_REQUEST['col_id'];

$q ="INSERT INTO `RutaColegio`(
	`rtc_id`,
	`rut_id`,
	`col_id`)}
VALUES(`$rtc_id`,`$rut_id`,`$col_id`)";

$mensaje = array('mensaje' => 'insert ok');
echo json_encode($mensaje);

});

//Delete

$app->delete('/eRutaColegio',function(){

global $db;

$q	=	"DELETE FROM `RutaColegio` WHERE rtc_id=`$rtc_id`";
$mensaje = array('mensaje' => 'DElete ok' );

echo json_encode($mensaje);


});
?>