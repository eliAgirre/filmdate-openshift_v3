<?php
// Se obtienen los datos mediante ajax
$titulo=$_POST['titulo'];
$usuario_id=$_POST['usuario_id'];
// Variable para booleano para devolver un JSON
$exit;

//Se importa el archivo json de sigue_peli en String
$sigue_peli_str = file_get_contents("../collections/sigue_peli.json");
//Se convierte en un objeto JSON
$sigue_peli = json_decode($sigue_peli_str,true);
$clave=array();
// Se recorre el array bidireccional de sigue_peli
foreach ($sigue_peli['siguePeli'] as $key => $value) {

    foreach ($value as $campo => $valor) {
    	// Si el título coincide se guarda la id del documento
        if($titulo===$valor){
            
            array_push($clave, $key);
        }
                                    
    }
}
$existe=array();
// Se vuelve a recorrer para que coincida con el usuario
foreach ($clave as $field => $dato) {

	foreach ($sigue_peli['siguePeli'] as $key => $value) {
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

	// random ID
	$seed = str_split('abcdefghijklmnopqrstuvwxyz0123456789'); //caracteres
    shuffle($seed); // probably optional since array_is randomized; this may be redundant
    $rand = '';
    foreach (array_rand($seed, 24) as $k) $rand .= $seed[$k];

	// Se crea el array para guardar en la bd
	$document = array( 

		"_id" => $rand,
		"titulo" => $titulo,
		"id_usuario" => $usuario_id

	);

	//Se importa el archivo json de sigue_peli en String
	$sigue_peli_str = file_get_contents("../collections/sigue_peli.json");
	//Se convierte en un objeto JSON
	$sigue_peli = json_decode($sigue_peli_str,true);

	// Añadir el documento al array de json
    array_push($sigue_peli['siguePeli'], $document);

    // Se inserta el documento en la colección llamado valoracion
	file_put_contents("../collections/sigue_peli.json", json_encode($sigue_peli,TRUE));

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