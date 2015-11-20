<?php 

//Consultar Parametros
$app->get('/cParametros',function ($tipo,$conse){
global $db;
$q ="SELECT * FROM Parametros WHERE pr_tipo = '$tipo' AND pr_conse='$conse'";

$datos =$db->get_results($q);
echo json_encode($datos);

});
$app->get('/cParametros/:tipo',function ($pr_tipo){
global $db;
$q ="SELECT * FROM Parametros WHERE pr_tipo = '$tipo'";
$datos =$db->get_results($q);
echo json_encode($datos);
});
//Insertar Parametros
$app->post('/iParametros',function(){
global $db;
$pr_tipo  	=$_REQUEST['pr_tipo'];
$pr_conse	=$_REQUEST['pr_conse'];
$pr_valor	=$_REQUEST['pr_valor'];
$pr_nombre	=$_REQUEST['pr_nombre'];

$q= "INSERT INTO `rutas`.`Parametros`
(`pr_tipo`,
`pr_conse`,
`pr_valor`,
`pr_nombre`)
VALUES
('$pr_tipo',
'$pr_conse',
'$pr_valor',
'$pr_nombre')";

 $datos=$db->query($q);

$mensaje = array('mensaje' =>  "Insercion Correcta" )	;
echo json_encode($mensaje);
});

$app->delete

?>