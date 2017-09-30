<?php
// Se obtienen los datos mediante ajax
$usuario=$_POST['usuario'];
$amigo=$_POST['usu_amigo'];
// Variable para booleano para devolver un JSON
$exit;

//Se importa el archivo json de sigue_amigos en String
$sigueAmigos_str = file_get_contents("../collections/sigue_amigos.json");
//Se convierte en un objeto JSON
$sigueAmigos = json_decode($sigueAmigos_str,true);
$clave=array();
// Se recorre el array bidireccional de sigue_amigos
foreach ($sigueAmigos['sigueAmigos'] as $key => $value) {

	foreach ($value as $campo => $valor) {

		// Si el usuario coincide se guarda la id del documento
        if($usuario===$valor){
            
            array_push($clave, $key);
        }
	}
}
$existe=array();
// Se vuelve a recorrer para que coincida con el usuario
foreach ($clave as $field => $dato) {

	foreach ($sigueAmigos['sigueAmigos'] as $key => $value) {
		// Si coinciden las id de los documentos
		if($dato==$key){

			foreach ($value as $campo => $valor) {
				// Se comprueba si el amigo coincide
				if($amigo===$valor){

					array_push($existe, $key);

				}

			}
		}

	}
}
// Si el array está vacío
if (empty($existe)) {

	// random ID
	$seed = str_split('abcdefghijklmnopqrstuvwxyz0123456789'); //caracteres
    shuffle($seed); // probably optional since array_is randomized; this may be redundant
    $rand = '';
    foreach (array_rand($seed, 24) as $k) $rand .= $seed[$k];

	// Se crea el array para guardar en la bd
	$document = array( 

		"_id" => $rand,
		"usuario" => $usuario,
		"amigo" => $amigo

	);

	//Se importa el archivo json de sigue_amigos en String
	$sigueAmigos_str = file_get_contents("../collections/sigue_amigos.json");
	//Se convierte en un objeto JSON
	$sigueAmigos = json_decode($sigueAmigos_str,true);

	// Añadir el documento al array de json
    array_push($sigueAmigos['sigueAmigos'], $document);

    // Se inserta el documento en la colección llamado valoracion
	file_put_contents("../collections/sigue_amigos.json", json_encode($sigueAmigos,TRUE));

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