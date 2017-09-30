<?php

//Se importa el archivo json de usuarios en String
$usuarios_str = file_get_contents("../collections/usuarios.json");
//Se convierte en un objeto JSON
$usuarios = json_decode($usuarios_str, true);
// Se obtienen los datos desde POST Ajax
$image = $_POST['imgSrc'];
$id_usuario = $_POST['id_usuario'];
$usuario = $_POST['nombreUsuario'];

// Lee la imagen y convierte a base64
$imageData = base64_encode(file_get_contents($image));
// Formato de SRC:  data:{mime};base64,{data};
//{mime}--> El formato de la imagen, ej.:image/jpeg
$src = 'data: '.mime_content_type($image).';base64,'.$imageData;

$clave; // Declaración de una variable
// Se recorre el array de usuarios
foreach ($usuarios['usuarios'] as $key => $value) {
	
	foreach ($value as $campos => $dato) {

		if($id_usuario===$dato){
			// Se obtiene el ID de documento
			$clave=$key;

		}
		
	}
}

 // Se vuelve a recorrer para modificar el documento asociado a esa ID
foreach ($usuarios['usuarios'] as $key => $value) {

	if($clave===$key){

		foreach ($value as $campos => $dato) {

			if ($campos==="foto") {

				 $usuarios['usuarios'][$key][$campos] = $src;
			}
		}

	}
}

// Se inserta el documento en la colección llamado usuarios
file_put_contents("../collections/usuarios.json", json_encode($usuarios,TRUE));

// Se obtienen los datos del usuario mediante el id
//$datos=$collection->findOne(array('_id' => $id_usuario));

// Devuelve el objeto JSON
echo json_encode($usuarios);

?>