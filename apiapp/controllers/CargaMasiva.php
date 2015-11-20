<?php
	$app->post('/cargaMasiva',function () {

	    global $db;
	    
	    $file = $_FILES['file']['tmp_name'];  	//Captura el archivo en la variable "file"
	    $tabla = "";  							//Inicia una variable donde se guardara el nombre de la tabla de la (BD)
	    $tablaActiva = false;					//Inicia la variable para validar en que momento se cambia de tabla

	    echo "Archivo ".$file."<br>";

	    $fp = fopen($file,'r');					//Abre el archivo
		if (!$fp) {echo 'ERROR: No ha sido posible abrir el archivo. Revisa su nombre y sus permisos.'; exit;}


		 // Recorre todo el archivo csv
		while ($data = fgetcsv ($fp, 1000, ";")){

			// ----------------------------------------------------------------------------------------------------------
			// Toma el primer registro y primer campo de la tabla del archivo CSV
			// Si el dato del campó corresponde a uno de los casos. Cambia la variable "$tablaActiva a true"
			// si no corresponde a ningun caso la cambia y/o deja en "false". Esto se hace con el fin de omitir
			// el registro o fila correspondiente al nombre de la tabla en la base de datos y almacenar el 
			// nombre de dicha tabla en la variable "$tabla"
			//
			// NOTA:
			// 		El nombre de los campos de las tablas del archivo CSV debe coincidir con los nombres de las tablas
			// 		de la Base de Datos.
			// -----------------------------------------------------------------------------------------------------------
			switch ($data[0]) 
			{
				case 'Arp':
					$tabla = $data[0];		// Guarda el nombre de la tabla (Nombre de la tabla del CSV y BD donde se guardaran los datos)
					$tablaActiva = true;	// indica que la tabla está activa (tabla "BD" donde se guardaran los datos del CSV)
					break;

				case 'Eps':
					$tabla = $data[0];
					$tablaActiva = true;
					break;

				case 'Colegio':
					$tabla = $data[0];
					$tablaActiva = true;
					break;

				default:
					$tablaActiva = false;	//indica que NO hay tabla activa
					break;
			}

			// --------------------------------------------------------------------------------
			// Si la $tabla contiene datos y la $tablaActiva es "false"
			// se validará un caso del "switch" con el nombre de $tabla
			// (nombre de la tabla en el que se insertaran los datos) 
			// --------------------------------------------------------------------------------

			if($tabla != "" && $tablaActiva==false) 
			{
				switch ($tabla) {
					case 'Arp':
						insertarArp($tabla,$db,$data[0]); // llama la funcion correspondiente para insertar los datos en dicha tabla (BaseDatos)
						break;
					
					case 'Eps':
						insertarEps($tabla,$db,$data[0]);
						break;

					case 'Colegio':
						insertarColegio($tabla,$db,$data[0],$data[1],$data[2],$data[3],$data[4],$data[5]);
						break;
				}
			}
		}

		fclose($fp);
    });



	// ======================================================================================================
	// ========================== FUNCIONES DE INSERCION EN LAS TABLAS ======================================
	// ======================================================================================================
	// 
	// Estas funciones reciben como parametros:
	// $tabla:		nombre de la tabla
	// $db:			la conexion de la base de datos
	// $campo1:		datos correspondientes a los campos del archivo capturados antes en data[0]
	// $campo..n: 	datos correspondientes a los campos del archivo capturados antes en data[0], data[1],data[2], etc...
	// 
	// ====================================================================================================== 
	
	
	// ---------  INSERTA DATOS EN LA TABLA => Arp
    function insertarArp($tabla, $db, $campo1)
    {
    	$insertar="INSERT INTO $tabla (
						arp_nombre
					)
					VALUES 
					(
						'$campo1'
					)";

		$datos = $db->get_row($insertar);
		mensajeOK($tabla);
		//echo json_encode($datos);
    };



    // ---------  INSERTA DATOS EN LA TABLA => Eps
    function insertarEps($tabla, $db, $campo1)
    {
    	$insertar="INSERT INTO $tabla (
						eps_nombre
					)
					VALUES 
					(
						'$campo1'
					)";

		$datos = $db->get_row($insertar);
		mensajeOK($tabla);
		//echo json_encode($datos);
    };



    // ---------  INSERTA DATOS EN LA TABLA => Colegio
    function insertarColegio($tabla, $db, $campo1,$campo2,$campo3,$campo4,$campo5,$campo6)
    {
    	$insertar="INSERT INTO $tabla (
						col_nombre,
						col_direccion,
						col_telefonos,
						col_rector,
						latitude,
						longitude
					)
					VALUES 
					(
						'$campo1',
						'$campo2',
						'$campo3',
						'$campo4',
						'$campo5',
						'$campo6'
					)";

		$datos = $db->get_row($insertar);
		mensajeOK($tabla);
		//echo json_encode($datos);
    };



   

   // ---------  INSERTA DATOS EN LA TABLA => Eps
    
   
   // =================== FIN DE LAS FUNCIONES DE INSERCION EN LAS TABLAS ================
   // ====================================================================================
    


    //==================================== FUNCION DE MENSAJE ===============================
    function mensajeOK($tabla)
    {
    	$mensaje = array("mensaje"=>"Inserto ok en la tabla '$tabla' ");
        echo json_encode($mensaje);
    } 
    //================================ FIN FUNCION DE MENSAJE ===============================
    
?>