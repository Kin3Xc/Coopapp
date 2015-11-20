<?php

//Consulta los cursos con su grado respectivo
$app->get('/cCursos',function () {
    global $db;
    $q = "select * from Grado inner join Curso on Grado.gra_id = Curso.gra_id order by Grado.gra_id asc";
    $datos = $db->get_results($q);
    echo json_encode($datos);
});

//Consulta los cursos por Grado
$app->get('/cCursosGrado/:idGrado',function ($idGrado) {
    global $db;
    $q = "SELECT * FROM Curso WHERE gra_id=$idGrado";
    $datos = $db->get_results($q);
    echo json_encode($datos);
});


//Consultar Curso Por ID
$app->get('/cCurso',function ($cur_id) {
    global $db;
    $q = "SELECT * FROM Curso WHERE cur_id='$cur_id'";
    $datos = $db->get_results($q);
    echo json_encode($datos);
       
});
//Insertar Curso
//Curso
$app->post('/iCurso',function (){

        global $db;
    
        
        $cur_nombre     =$_REQUEST['cur_nombre'];
        $gra_id         =$_REQUEST['idGrado'];          
        //insertar Curso
        $q      =   "INSERT INTO `Curso` (
            
            `cur_nombre`,
            `gra_id`
            ) 
            VALUES (
                    '$cur_nombre',
                    '$gra_id'
             );";
        
        $datos   =   $db->query($q);

        //$db->debug();
 
        $mensaje = array('mensaje'=>'Inserto ok');

         echo json_encode($mensaje);

        });

//Eliminar

// DELETE route
$app->delete('/eCurso',function () {
        

        global $db;

        $q =    "DELETE FROM `Curso`
                 WHERE cur_id='$cur_id'";


        $Mensaje = array('mensaje' => 'Insert ok' );
        echo json_encode($mensaje);

});


?>