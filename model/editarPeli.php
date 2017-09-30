<?php
// Se requiere las sesiones para los mensajes flash
if( !session_id() ) session_start();
// Requiere la clase de mensajes y se instancia el objeto de tipo Messages
require_once('../controller/class.messages.php');
$msg = new Messages();
// Iniciar una nueva sesión o reanudar una sesión
session_start();
//Se importa el archivo json de peliculas en String
$peliculas_str = file_get_contents("../collections/peliculas.json");
//Se convierte en un objeto JSON
$peliculas = json_decode($peliculas_str,true);
$id;
$clave;
// Se comprueba si el editPeli está definida (btn modificar)
if(isset($_POST['editPeli'])){
	
	// Si los campos username o password están vacíos
	if($_POST['id']==NULL or $_POST['title']==NULL or $_POST['synopsis']==NULL or $_POST['runtime']==NULL or $_POST['year']==NULL or $_POST['abridged_cast']==NULL){

		// Mensaje de error a mostrar
		$msg->add('e', 'ERROR: Los campos estan vacios');
		// Redirecciona al perfil del usuario
		header('Location: ../views/editarPeli.php');
		// Imprime un mensaje y termina el script actual
		exit();

	}
	else{ // Si los campos no están vacíos
		// Se comprueba si el id está definida
		if(isset($_POST['id'])){
			$id=$_POST['id'];
		}
		//Se recorre el array json de las peliculas
		foreach ($peliculas['peliculas'] as $key => $value) {
		
		    foreach ($value as $campo => $valor) {
		
				if($id===$valor){
					// Se obtiene el ID de documento
		            $clave=$key;
		
		        }
		    }
		}
		// Se vuelve a recorrer  array de json para modificar el documento asociado a esa ID
		foreach ($peliculas['peliculas'] as $key => $value) {
			if($clave===$key){
				foreach ($value as $campos => $dato) {
					if($campos==="title"){
						$peliculas['peliculas'][$key][$campos] = $_POST['title'];
					}
					if($campos==="synopsis"){
						$peliculas['peliculas'][$key][$campos] = $_POST['synopsis'];
					}
					if($campos==="runtime"){
						$peliculas['peliculas'][$key][$campos] = $_POST['runtime'];
					}
					if($campos==="year"){
						$peliculas['peliculas'][$key][$campos] = $_POST['year'];
					}
					if($campos==="abridged_cast"){
						$peliculas['peliculas'][$key][$campos] = $_POST['abridged_cast'];
					}
				}
			}
		}
		
		// Se inserta el documento en la colección llamado peliculas
		file_put_contents("../collections/peliculas.json", json_encode($peliculas,TRUE));
		
		// Muestra mensaje exitoso
		$msg->add('s', 'Cambio realizado');
		// Redirecciona al perfil del usuario
		header('Location: ../views/editarPeli.php');
		// Imprime un mensaje y termina el script actual
		exit();
		
	} // Cierre del else
}
?>