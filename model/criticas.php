<?php
// Se requiere las sesiones para los mensajes flash
if( !session_id() ) session_start();
// Requiere la clase de mensajes y se instancia el objeto de tipo Messages
require_once('../controller/class.messages.php');
$msg = new Messages();

// Se obtienen los datos mediante ajax
$id_usuario=$_POST['id_usuario'];
$id_pelicula=$_POST['id_pelicula'];
$comentario=$_POST['contenido'];

//$id_pelicula="549ef9d2ed8388f0588b456b";

//Se importa el archivo json de peliculas en String
$peliculas_str = file_get_contents("../collections/peliculas.json");
//Se convierte en un objeto JSON
$peliculas = json_decode($peliculas_str,true);
$clave;
$titulo;
//Se recorre el array json de las peliculas
foreach ($peliculas['peliculas'] as $key => $value) {

    foreach ($value as $campo => $valor) {

    	if($id_pelicula===$valor){
    		// Se guarda el id del documento del array
    		$clave=$key;
    	}

    }
}

foreach ($peliculas['peliculas'] as $key => $value) {
	// Si coincide el id del documento con el key
	if($clave===$key){

		foreach ($value as $campo => $valor) {

			if($campo==="title"){
				// Se guarda el título
				$titulo=$valor;

			}
		}

	}
}


// Se comprueba el valor de la cricia y si es null
if(isset($comentario) and $comentario==NULL){

	// Mensaje de error a mostrar
	$msg->add('e', 'ERROR: No has introducido el comentario');
	// Redirecciona al perfil de la película
	header('Location: ../views/perfil-peli.php?peli=' . $titulo);
	// Imprime un mensaje y termina el script actual
	exit();
	
}
else{ // Si el comentario no está vacío

	// random ID del comentario
	$seed = str_split('abcdefghijklmnopqrstuvwxyz0123456789'); //caracteres
    shuffle($seed); // probably optional since array_is randomized; this may be redundant
    $rand = '';
    foreach (array_rand($seed, 24) as $k) $rand .= $seed[$k];
	// Se crea un array para obtener los datos del formulario para guarda como un documento
	$document = array( 

		"_id" => $rand,
		"id_usuario" => $id_usuario, 
		"id_pelicula" => $id_pelicula,
		"comentario" => $comentario

	);

	//Se importa el archivo json de criticas en String
	$criticas_str = file_get_contents("../collections/criticas.json");
	//Se convierte en un objeto JSON
	$criticas = json_decode($criticas_str,true);
	// Añadir el documento al array de json
    array_push($criticas['criticas'], $document);
    // Se inserta el documento en la colección llamado criticas
	file_put_contents("../collections/criticas.json", json_encode($criticas,TRUE));
	// Se importa las funciones del archivo
	include_once("../functions/criticas.php");
	// Se guarda el array en una variable                    
	$criti=obtenerDatosCritics($id_pelicula);
	// Devuelve el objeto JSON bidimensional
	echo json_encode($criti);
} // Cierre del else
?>