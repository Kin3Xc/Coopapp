<?php

	include "generadorDeRecibo.php";

	$app->get('/generaRecibo/:idAlumno/:idRecibo/:ssl_id',function($idAlumno,$idRecibo,$ssl_id){
		
		generar($idAlumno,$idRecibo,$ssl_id);

		$mensaje= "Generando Recibo";
		echo json_encode($mensaje);
	});

?>