<?php
// Inicia sesión o reanudar la sesión	
session_start();
    // Se guarda la variable de sesión
    $nombreUsuario = $_SESSION["nombreUsuario"];
    // Si la variable no tiene valor se obtiene desde la variable GET
    if(!isset($nombreUsuario)){
    	$nombreUsuario=$_GET('nombreUsuario');
    }
    //Se importa el archivo json de usuarios en String
    $usuarios_str = file_get_contents("../collections/usuarios.json");
    //Se convierte en un objeto JSON
    $usuarios = json_decode($usuarios_str, true);
    $doc;
    //Se recorre el array json de las usuarios
    foreach ($usuarios['usuarios'] as $key => $value) {

        foreach ($value as $campo => $valor) {

            if($nombreUsuario===$valor){
                // Se guarda la clave del documento
                $doc=$key;

            }

            
        }
    }

    //Se recorre el array json de las usuarios
    foreach ($usuarios['usuarios'] as $key => $value) {

        if($doc===$key){

            foreach ($value as $campo => $valor) {

                if($campo==="foto"){

                    echo "<img id='fotoUsuario' src='".$valor."' alt='Avatar'/><br /><br />";
                }
            }
        }
    }
?>