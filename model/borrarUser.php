<?php
// Se guarda la variable GET id
$id=$_GET['id'];
//Se importa el archivo json de usuarios en String
$usuarios_str = file_get_contents("../collections/usuarios.json");
//Se convierte en un objeto JSON
$usuarios = json_decode($usuarios_str, true);
$clave;
//Se recorre el array json de las usuarios
foreach ($usuarios['usuarios'] as $key => $value) {

    foreach ($value as $campo => $valor) {

        if($id===$valor){

            $clave=$key;

        }        
    }
}

// Se recorre el array de json
foreach ($usuarios['usuarios'] as $key => $value) {

	if($clave===$key){
		// Se elimina el documento
		unset($usuarios['usuarios'][$key]);
	}
}

// Se borra el documento en la colección llamado usuarios
file_put_contents("../collections/usuarios.json", json_encode($usuarios,TRUE));

?>