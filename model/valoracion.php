<?php
// Se obtienen los datos mediante ajax
$valorEstrella=$_POST['clickEstrella'];
$pelicula_id=$_POST['pelicula_id'];
$usuario_id=$_POST['usuario_id'];
$exit;

//Se importa el archivo json de valoracion en String
$valoracion_str = file_get_contents("../collections/valoracion.json");
//Se convierte en un objeto JSON
$valoracion = json_decode($valoracion_str,true);
$clave=array();
//Se recorre el array json de valoracion
foreach ($valoracion['valoracion'] as $key => $value) {

    foreach ($value as $campo => $valor) {
        // Si coincide el id pelicula con algún valor del array
        if($pelicula_id===$valor){
            // Se guarda la clave del documento
            array_push($clave, $key);

        }
    }
}

$existe=array();
// Se vuelve a recorrer para que coincida con el usuario
foreach ($clave as $field => $dato) {

	foreach ($valoracion['valoracion'] as $key => $value) {
		// Si coinciden las id de los documentos
		if($dato==$key){

			foreach ($value as $campo => $valor) {
				// Se comprueba si el id del usuario coincide
				if($usuario_id===$valor){

					array_push($existe, $key);

				}

			}
		}

	}
}

// Se comprueba si existe el documento con esas condiciones
if (empty($existe)) { // Si no ha votado

	// Se crea el array para guardar en la bd
	$document = array( 

		"id_pelicula" => $pelicula_id, 
		"valoracion" => $valorEstrella,
		"id_usuario" => $usuario_id

	);

	//Se importa el archivo json de valoracion en String
	$valoracion_str = file_get_contents("../collections/valoracion.json");
	//Se convierte en un objeto JSON
	$valoracion = json_decode($valoracion_str,true);
	// Añadir el documento al array de json
    array_push($valoracion['valoracion'], $document);
    // Se inserta el documento en la colección llamado valoracion
	file_put_contents("../collections/valoracion.json", json_encode($valoracion,TRUE));

	// Establece la variable
	$exit=true;

}
else{

	// Guarda el booleano false
	$exit=false;

}

// Devuelve el objeto JSON
echo json_encode(array('exito'=>$exit));

?>