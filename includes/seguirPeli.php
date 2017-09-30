<?php 
// Se guarda la variable de sesión
$id_usuario=$_SESSION['id_usuario'];
$pelicula=$_GET['peli']; // Se obtiene del método GET

//Se importa el archivo json de sigue_peli en String
$sigue_peli_str = file_get_contents("../collections/sigue_peli.json");
//Se convierte en un objeto JSON
$sigue_peli = json_decode($sigue_peli_str,true);
$clave=array();
// Se recorre el array bidireccional de sigue_peli
foreach ($sigue_peli['siguePeli'] as $key => $value) {

    foreach ($value as $campo => $valor) {
    	// Si el título coincide se guarda la id del documento
        if($pelicula===$valor){
            
            array_push($clave, $key);
        }
                                    
    }
}

$sigue=array();
// Se vuelve a recorrer para que coincida con el usuario
foreach ($clave as $field => $dato) {

	foreach ($sigue_peli['siguePeli'] as $key => $value) {
		// Si coinciden las id de los documentos
		if($dato==$key){

			foreach ($value as $campo => $valor) {
				// Se comprueba si el id del usuario coincide
				if($id_usuario===$valor){

					array_push($sigue, $key);

				}

			}
		}

	}
}

// Si no coinciden --> no hay datos
if (empty($sigue)) {
    // Aparece el botón seguir
    include_once("../includes/botonSeguir.html");
}
else{
	// Muestra el botón siguiendo
	include_once("../includes/botonSiguiendo.html");
}

?>