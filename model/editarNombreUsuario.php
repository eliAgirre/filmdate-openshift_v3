<?php
// Se requiere las sesiones para los mensajes flash
if( !session_id() ) session_start();
// Requiere la clase de mensajes y se instancia el objeto de tipo Messages
require_once('../controller/class.messages.php');
$msg = new Messages();
// Se importan las funciones para comprobar u obtener datos
include_once("../functions/usuarios.php");
// Iniciar una nueva sesión o reanudar una sesión
session_start();

// Se comprueba si el editNombre está definida
if(isset($_POST['editNombre'])){
	
	// Si los campos username o password están vacíos
	if($_POST['nombre']==NULL or $_POST['password']==NULL){

		// Mensaje de error a mostrar
		$msg->add('e', 'ERROR: Los campos estan vacios');
		// Redirecciona al perfil del usuario
		header('Location: ../views/profile.php');
		// Imprime un mensaje y termina el script actual
		exit();

	}
	else{ // Si los campos no están vacíos

		// Se comprueba si la contraseña coincide
		if(verificarPassword($_SESSION["nombreUsuario"],md5($_POST['password']))==="true"){ //Si la contraseña coindice
			// Se establece la variable mediante el valor de la variable de sesión
			$id_usuario=$_SESSION["id_usuario"];
			// Si existe un usuario con el mismo nombre de usuario introducido
			if(usernameExiste($_POST['nombre'])==="true"){
				// Mensaje de error a mostrar
				$msg->add('e', 'ERROR: El nombre de usuario ya existe.');
				// Redirecciona al perfil del usuario
				header('Location: ../views/profile.php');
				// Imprime un mensaje y termina el script actual
				exit();

			}
			else{

				//Se importa el archivo json de usuarios en String
			    $usuarios_str = file_get_contents("../collections/usuarios.json");
			    //Se convierte en un objeto JSON
			    $usuarios = json_decode($usuarios_str, true);
			    $clave;
			    // Se recorre el array de usuarios
			    foreach ($usuarios['usuarios'] as $key => $value) {
			    	
			    	foreach ($value as $campos => $dato) {

			    		if($_SESSION["id_usuario"]===$dato){
			    			// Se obtiene el ID de documento
			    			$clave=$key;

			    		}
			    		
			    	}
			    }

			     // Se vuelve a recorrer para modificar el documento asociado a esa ID
			    foreach ($usuarios['usuarios'] as $key => $value) {

			    	if($clave===$key){

			    		foreach ($value as $campos => $dato) {

			    			if ($campos==="usuario") {

			    				 $usuarios['usuarios'][$key][$campos] = $_POST['nombre'];
			    			}
			    		}

			    	}
			    }

			    // Se inserta el documento en la colección llamado usuarios
				file_put_contents("../collections/usuarios.json", json_encode($usuarios,TRUE));

				// Se obtiene el nombre de usuario de la BD
				$nombreUsuario=obtenerUsuario($id_usuario);

				// Se establece la variable de sesión del nombre de usuario
				$_SESSION["nombreUsuario"]=$nombreUsuario;
	   			// Muestra mensaje exitoso
				$msg->add('s', 'Cambio realizado');
				// Redirecciona al perfil del usuario
				header('Location: ../views/profile.php');
				// Imprime un mensaje y termina el script actual
				exit();
				
			}
		
		}
		else{ // Si la contraseña no coincide

			// Mensaje de error a mostrar
			$msg->add('e', 'ERROR: La clave no es correcta');
			// Redirecciona al perfil del usuario
			header('Location: ../views/profile.php');
			// Imprime un mensaje y termina el script actual
			exit();

		} // Cierre del else porque la contraseña no coincide		
	} // Cierre del else si los campos no están vacíos
} // Cierre del if 

?>