<?php 
$app->get('/cMonitorRuta',function () {

    global $db;

    //Seleccionar Monitor Ruta
    $q = <<<OE
            
            SELECT mr.mon_nombre, mr.mon_direccion, mr.mon_telfijo, mr.mon_telcelular,
                   c.col_nombre
            FROM MonitorRuta as mr
            INNER JOIN Colegio as c on c.col_id = mr.col_id

OE;
    
    
    $datos = $db->get_results($q);

    echo json_encode($datos);
       
});
$app->get('/cMonitorRuta/:id',function ($mon_id) {
	global $db;
	//Seleccionar Monitor Ruta
    $q = "SELECT * FROM MonitorRuta WHERE mon_id='$mon_id'";
	$datos = $db->get_results($q);
	 echo json_encode($datos);
 });

$app->post('/iMonitorRuta',function(){

global $db;


$mon_nombre		=$_REQUEST['mon_nombre'];
$mon_direccion	=$_REQUEST['mon_direccion'];
$mon_telfijo	=$_REQUEST['mon_telfijo'];
$mon_telcelular	=$_REQUEST['mon_telcelular'];
$col_id			=$_REQUEST['col_id'];

$q= <<<OE
        
                INSERT INTO `MonitorRuta`
        (
         `mon_nombre`,
         `mon_direccion`,
         `mon_telfijo`,
         `mon_telcelular`,
         `col_id`) VALUES
         (
          '$mon_nombre',
          '$mon_direccion',
          '$mon_telfijo',
          '$mon_telcelular',
          '$col_id')

OE;

//echo $q;
//return;
$datos = $db->query($q);
$mensaje = array('mensaje' => 'Insert Ok' );
echo json_encode($mensaje);
//Eliminar
});

$app->delete('/eMonitorRuta',function(){
global $db;
$q	= "DELETE FROM MonitorRuta WHERE mon_id=`$mon_id`";
$mensaje = array('mensaje' => 'delete Ok' );
echo json_encode($mensaje);
});
?>

