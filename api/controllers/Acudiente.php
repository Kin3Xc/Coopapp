<?php 


//Consultar acudientes


$app->get('/cAcudientes',function () {

     global $db;
    //Seleccionar Ruta 
    $q = "SELECT * FROM Acudiente";
    $datos = $db->get_results($q);
    

    foreach ($datos as $key => $value) {
            
        $datos[$key]->acu_nombre = utf8_encode($value->acu_nombre);
        $datos[$key]->acu_direccion = utf8_encode($value->acu_direccion);
        $datos[$key]->acu_telfijo = utf8_encode($value->acu_telfijo);
        $datos[$key]->acu_telcelular = utf8_encode($value->acu_telcelular);
        $datos[$key]->acu_parentesco = utf8_encode($value->acu_parentesco);
    }


    echo json_encode($datos);



    });



$app->get('/cAcudiente/:id',function ($acu_id) {
         global $db;
//Seleccionar Por Id Acudiente
        $q     = "SELECT * FROM Acudiente WHERE acu_id = '$acu_id'";
        $datos = $db->get_row($q);
        echo json_encode($datos);
       
});






//INSERTAR ACUDIENTE

$app->post('/iAcudiente',function () {

        global $db;
        //Acudiente Campos   
        $acu_id         =$_REQUEST['acu_id'];
        $acu_nombre     =$_REQUEST['acu_nombre'];
        $acu_direccion  =$_REQUEST['acu_direccion'];
        $acu_telfijo    =$_REQUEST['acu_telfijo'];
        $acu_telcelular =$_REQUEST['acu_telcelular'];
        $acu_parentesco =$_REQUEST['acu_parentesco'];
        
        //insertar acudientes
        $q      =   "INSERT INTO `Acudiente` (
            `acu_id`,
            `acu_nombre`,
            `acu_direccion`,
            `acu_telfijo`,
            `acu_telcelular`,
            `acu_parentesco`) 
            VALUES ('$acu_id',
             '$acu_nombre',
             '$acu_direccion',
             '$acu_telfijo',
             '$acu_telcelular',
             '$acu_parentesco');";
        
        $datos   =   $db->query($q);

        //$db->debug();
 
        $mensaje = array('mensaje'=>'Inserto ok');

         echo json_encode($mensaje);

        });

//Eliminar

// DELETE route
$app->delete('/eAcudiente',function () {
        

        global $db;

        $q =    "DELETE FROM `Acudiente`
                 WHERE acu_id='$acu_id'";


        $Mensaje = array('mensaje' => 'Deletes ok' );
        echo json_encode($mensaje);

});


//  login acudiente 
$app->post('/login',function (){
    $user  =$_REQUEST['usuario'];
    $pass  =$_REQUEST['password'];

    global $db;
        $q     = "SELECT * FROM Acudiente WHERE acu_id = '$user' AND acu_password = '$pass'";
        $datos = $db->get_results($q);
        if ($datos < 1) {
            $datos = array('mensaje' => , 'Login incorrecto');
        }
        echo json_encode($datos);
});


 ?>