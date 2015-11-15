<?php 
 //Ciudad




$app->get('/cCiudad',function(){

    global $db;
    //Seleccionar Ciudad
    $q = "SELECT * FROM Ciudad";

    $datos  =   $db->get_results($q);
    echo json_encode($datos);

});
$app->get('/cCiudad/:id',function ($ciu_id) {

 global $db;
//SELECCIONAR Arp 
    $q = "SELECT * FROM Ciudad WHERE ciu_id='ciu_id'";

    $datos = $db->get_results($q);
    echo json_encode($datos);
       
});




//Insert Ciudad

//Ciudad
$app->post('/iCiudad',function (){

        global $db;
 
        $ciu_nombre     =$_REQUEST['ciudad'];
                  
        //insertar Ciudad
        $q      =   "INSERT INTO `Ciudad` (
            
            `ciu_nombre`
            ) 
            VALUES (
             '$ciu_nombre'
             );";
        
        $datos   =   $db->query($q);

        $db->debug();
 
        $mensaje = array('mensaje'=>'Inserto ok');

         echo json_encode($mensaje);

        });

//Eliminar

// DELETE route
$app->delete('/eCiudad',function () {
        

        global $db;

        $q =    "DELETE FROM `Ciudad
        `
                 WHERE ciu_id='$ciu_id'";


        $Mensaje = array('mensaje' => 'Insert ok' );
        echo json_encode($mensaje);

});


?>