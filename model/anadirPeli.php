<?php
// Se requiere las sesiones para los mensajes flash
if( !session_id() ) session_start();
// Requiere la clase de mensajes y se instancia el objeto de tipo Messages
require_once('../controller/class.messages.php');
$msg = new Messages();
// Se importan las funciones para comprobar u obtener datos
include_once("../functions/peliculas.php");

// Se comprueba si el anadir está definida
if(isset($_POST['anadir'])){

	// Si los campos están vacíos
	if($_POST['nombre']==NULL or $_POST['descripcion']==NULL or $_POST['duracion']==NULL or $_POST['reparto']==NULL){

		// Se establece el mensaje a mostrar
		$msg->add('e', 'ERROR: Los campos estan vac&iacute;os');
		// Redirecciona al anadirPeli
		header("location: ../views/anadirPeli.php");
		// Imprime un mensaje y termina el script actual
		exit();

	}
	else{ // Si los campos no están vacíos

		// Se comprueba si la pelicula existe
		if(peliculaExiste($_POST['nombre'])==="true"){

			// Se establece el mensaje a mostrar
			$msg->add('e', 'ERROR: El pel&iacute; ya existe');
			// Redirecciona al anadirPeli
			header("location: ../views/anadirPeli.php");
			// Imprime un mensaje y termina el script actual
			exit();

		}
		else{			

			// random ID
			$seed = str_split('abcdefghijklmnopqrstuvwxyz0123456789'); //caracteres
		    shuffle($seed); // probably optional since array_is randomized; this may be redundant
		    $rand = '';
		    foreach (array_rand($seed, 24) as $k) $rand .= $seed[$k];
		    
		    $tipoPeli='';
		    if($_POST['tipoPeli']=='boxOffice'){
		    	$tipoPeli='boxOffice';
		    } else {
		    	$tipoPeli='upcoming';
		    }
		    
		    /*$allowedExts = array("jpeg", "jpg", "png");
		    $temp = explode(".", $_FILES["file"]["name"]);
		    $extension = end($temp);
		    
		    if ((($_FILES["file"]["type"] == "image/jpeg")
				|| ($_FILES["file"]["type"] == "image/jpg")
				|| ($_FILES["file"]["type"] == "image/png"))
				&& ($_FILES["file"]["size"] < 10000000)
				&& in_array($extension, $allowedExts)){
				
				
			}*/
		    
		    //$image = $_FILES["file"]["name"]; 
		    //error_log(print_r($image,true));
		    //move_uploaded_file($_FILES["file"]["tmp_name"],"../upload/$image"); 
		    
		    /*
		    $target_dir = "admin/posters/";
		    $allowedExts = array("jpeg", "jpg", "png");
		    $target_file = $target_dir . basename($_FILES["subirImagen"]["name"]);
		    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		    
		    // Si existe el fichero
			if (file_exists($target_file)) {
			    echo "Lo siento, el fichero ya existe.";
			    //$uploadOk = 0;
			} else{
				if ((($_FILES["subirImagen"]["type"] == "image/jpeg")
				|| ($_FILES["subirImagen"]["type"] == "image/jpg")
				|| ($_FILES["subirImagen"]["type"] == "image/png"))
				&& ($_FILES["subirImagen"]["size"] < 10000000)
				&& in_array($extension, $allowedExts)){
				
				    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
								
				} else{
					if (move_uploaded_file($_FILES["subirImagen"]["tmp_name"], $target_file)) {
				        echo "The file ". basename( $_FILES["subirImagen"]["name"]). " has been uploaded.";
				        //move_uploaded_file($_FILES["subirImagen"]["tmp_name"],"../$target_dir");  error
				        error_log(print_r($target_file,true));
				    } else {
				        echo "Sorry, there was an error uploading your file.";
				    }
				}
			}*/
			 
			// Se crea un array para guardar los datos del formulario
			$document = array( 

				"_id" => $rand,
				"title" => $_POST['nombre'], 
				//"poster" => $target_file,
				"poster" => '',
				"year" => ($_POST['year']),
				$tipoPeli => ($_POST['tipoPeli']),
				"runtime" => ($_POST['duracion']),
				"trailer" => '',
				"synopsis" => $_POST['descripcion'],
				"abridged_cast" => ($_POST['reparto'])
	    	);

			//Se importa el archivo json de peliculas en String
		    $peliculas_str = file_get_contents("../collections/peliculas.json");
		    //Se convierte en un objeto JSON
		    $peliculas = json_decode($peliculas_str, true);
		    // Añadir los datos del usuario al array de json
		    array_push($peliculas['peliculas'], $document);
			// Se inserta el documento en la colección llamado peliculas
	    	file_put_contents("../collections/peliculas.json", json_encode($peliculas,TRUE));

			// Se crea el mensaje
			$msg->add('s', '¡FABULOSO! Pel&iacute;cula añadida');
			// Redirecciona al añadir pefil del administrador
			header("location: ../views/anadirPeli.php");

		} // Cierre del else porque la pelicula existe

	} // Cierre del else porque los campos no están vacíos

} // Cierre del if 

?>