<?php  

//Colegio
$app->get('/cColegio',function () {

    global $db;

    //SELECCIONAR COLEGIOS
    $q = "SELECT * FROM Colegio";

    $datos = $db->get_results($q);

    echo json_encode($datos);
       
});


 $app->get('/cColegio/:idColegio',function ($col_id) {
        
        global $db;

//Seleccionar Por Id Alumnos 
        $q     = "SELECT * FROM Colegio WHERE col_id = '$col_id'";

       $datos = $db->get_row($q);
      

        echo json_encode($datos);
       
    });

//Insert Colegio
$app->post('/iColegio',function (){

        global $db;
        $col_nombre     =$_REQUEST['col_nombre'];
        $col_direccion  =$_REQUEST['col_direccion'];
        $col_telefonos  =$_REQUEST['col_telefonos'];
        $col_rector     =$_REQUEST['col_rector'];            
        //insertar Colegio
        $q      =   "INSERT INTO `Colegio` (
            
            `col_nombre`,
            `col_direccion`,
            `col_telefonos`,
            `col_rector`
            )
            VALUES (    
             '$col_nombre',
             '$col_direccion',
             '$col_telefonos',
             '$col_rector'
             );";
        
        $datos   =   $db->query($q);

        //$db->debug();
 
        $mensaje = array('mensaje'=>'Inserto ok');

         echo json_encode($mensaje);

        });

//Eliminar

// DELETE route
$app->delete('/eColegio',function () {
        

        global $db;

        $q =    "DELETE FROM `Colegio`
                 WHERE col_id='$col_id'";


        $Mensaje = array('mensaje' => 'Insert ok' );
        echo json_encode($mensaje);

});
?>