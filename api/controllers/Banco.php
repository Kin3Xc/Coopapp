<?php  
//Consultar Banco
$app->get('/cBanco',function () {

    global $db;

    //SELECCIONAR banco
    $q = <<<OE
            
            SELECT b.ban_id, b.ban_numero, b.ban_nombre, tc.tct_nombre
            FROM Banco as b
            INNER JOIN TipoCuenta as tc on tc.tct_id = b.tct_id
OE;
    
    $datos = $db->get_results($q);
    foreach ($datos as $key => $value) {

$datos[$key]->tct_nombre = utf8_encode($value->tct_nombre);
}


    echo json_encode($datos);
       
});


$app->get('/cBanco/:id',function ($ban_id) {

 global $db;
//SELECCIONAR Arp 
    $q = "SELECT * FROM Banco WHERE ban_id='ban_id'";

    $datos = $db->get_results($q);
    echo json_encode($datos);
       
});



//Insertar Banco

//Banco
$app->post('/iBanco',function (){

        global $db;
    
        $ban_numero     =$_REQUEST['ban_numero'];
        $ban_nombre     =$_REQUEST['ban_nombre'];
        $tct_id         =$_REQUEST['tct_id'];            
        //insertar Banco
        $q      =   <<<OE
                
                INSERT INTO `Banco`
            (
             `ban_numero`,
             `ban_nombre`,
             `tct_id`) VALUES
             (
              '$ban_numero',
              '$ban_nombre',
              '$tct_id')
                
             
OE;
        
        $datos   =   $db->query($q);

        //$db->debug();
 
        $mensaje = array('mensaje'=>'Inserto ok');

         echo json_encode($mensaje);

        });

//Eliminar

// DELETE route
$app->delete('/eBanco',function () {
        

        global $db;

        $q =    "DELETE FROM `Banco`
                 WHERE ban_id='$ban_id'";


        $Mensaje = array('mensaje' => 'delete ok' );
        echo json_encode($mensaje);

});
?>