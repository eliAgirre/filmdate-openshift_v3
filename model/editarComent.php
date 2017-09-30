<?php
// Se requiere las sesiones para los mensajes flash
if( !session_id() ) session_start();
// Requiere la clase de mensajes y se instancia el objeto de tipo Messages
require_once('../controller/class.messages.php');
$msg = new Messages();
// Iniciar una nueva sesión o reanudar una sesión
session_start();
//Se importa el archivo json de criticas en String
$criticas_str = file_get_contents("../collections/criticas.json");
//Se convierte en un objeto JSON
$criticas = json_decode($criticas_str,true);
$id;
$clave;
// Se comprueba si el editComent está definida (btn modificar)
if(isset($_POST['editComent'])){
	
	// Si los campos username o password están vacíos
	if($_POST['id']==NULL or $_POST['coment']==NULL ){

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
		//Se recorre el array json de las criticas
		foreach ($criticas['criticas'] as $key => $value) {
		
		    foreach ($value as $campo => $valor) {
		
				if($id===$valor){
					// Se obtiene el ID de documento
		            $clave=$key;
		
		        }
		    }
		}
		// Se vuelve a recorrer  array de json para modificar el documento asociado a esa ID
		foreach ($criticas['criticas'] as $key => $value) {
			if($clave===$key){
				foreach ($value as $campos => $dato) {
					if($campos==="comentario"){
						$criticas['criticas'][$key][$campos] = $_POST['coment'];
					}
				}
			}
		}
		
		// Se inserta el documento en la colección llamado criticas
		file_put_contents("../collections/criticas.json", json_encode($criticas,TRUE));
		
		// Muestra mensaje exitoso
		$msg->add('s', 'El cambio del comentario se ha realizado.');
		// Redirecciona al perfil del usuario
		header('Location: ../views/profile.php');
		// Imprime un mensaje y termina el script actual
		exit();
		
	} // Cierre del else
}
?>