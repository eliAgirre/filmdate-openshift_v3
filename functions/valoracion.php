<?php
/*
* mediaValoracionIndex. Obtiene la media de la película desde el Index.
* parans --> $id_pelicula. Se obtiene el id de la película.
* return --> Devuelve un número en decimales.
*/
function mediaValoracionIndex($id_pelicula){

	//Se importa el archivo json de valoracion en String
    $valoracion_str = file_get_contents("collections/valoracion.json");
    //Se convierte en un objeto JSON
    $valoracion = json_decode($valoracion_str,true);
	$clave=array();
	// Se recorre el array las valoraciones
	foreach ($valoracion['valoracion'] as $key => $value) {

		foreach ($value as $campo => $valor) {
			// Si coinciden algun id de la película
			if($id_pelicula===$valor){
				// Se obtiene el id del documento
				array_push($clave, $key);

			}
			
		}

	}

	$valoraciones=array();
	// Se vuelve a recorrer el array de las valoraciones
	foreach ($clave as $field => $dato) {

		foreach ($valoracion['valoracion'] as $key => $value) {
			// Si coincide la clave del array
			if($dato===$key){

				foreach ($value as $campo => $valor) {
					// Se guarda el valor de la valoracion
					if($campo==="valoracion"){
						array_push($valoraciones, $valor);
					}

				}
			}
		}

	}

	$total=0;
	$media=0;
	$cant=0;

	foreach($valoraciones as $campos => $datos){

		$total=$total+$datos;
		$cant++;
	}

	if($cant!=0){

		$media=$total/$cant;
	}

	// Devuelve un número en decimales
	return $media;

} // Cierre de la función mediaValoracion

/*
* mediaValoracion. Obtiene la media de la película.
* parans --> $id_pelicula. Se obtiene el id de la película.
* return --> Devuelve un número en decimales.
*/
function mediaValoracion($id_pelicula){

	//Se importa el archivo json de valoracion en String
    $valoracion_str = file_get_contents("../collections/valoracion.json");
    //Se convierte en un objeto JSON
    $valoracion = json_decode($valoracion_str,true);
	$clave=array();
	// Se recorre el array las valoraciones
	foreach ($valoracion['valoracion'] as $key => $value) {

		foreach ($value as $campo => $valor) {
			// Si coinciden algun id de la película
			if($id_pelicula===$valor){
				// Se obtiene el id del documento
				array_push($clave, $key);

			}
			
		}

	}

	$valoraciones=array();
	// Se vuelve a recorrer el array de las valoraciones
	foreach ($clave as $field => $dato) {

		foreach ($valoracion['valoracion'] as $key => $value) {
			// Si coincide la clave del array
			if($dato===$key){

				foreach ($value as $campo => $valor) {
					// Se guarda el valor de la valoracion
					if($campo==="valoracion"){
						array_push($valoraciones, $valor);
					}

				}
			}
		}

	}

	$total=0;
	$media=0;
	$cant=0;

	foreach($valoraciones as $campos => $datos){

		$total=$total+$datos;
		$cant++;
	}

	if($cant!=0){

		$media=$total/$cant;
	}

	// Devuelve un número en decimales
	return $media;

} // Cierre de la función mediaValoracion

/*
* cantVotos. Muestra la cantidad de votos que contiene la película.
* parans --> $id_pelicula. Se obtiene el id de la película.
* return --> Devuelve un número entero.
*/
function cantVotos($id_pelicula){

	$cant=0;

	//Se importa el archivo json de valoracion en String
    $valoracion_str = file_get_contents("../collections/valoracion.json");
    //Se convierte en un objeto JSON
    $valoracion = json_decode($valoracion_str,true);

    $clave=array();
	// Se recorre el array las valoraciones
	foreach ($valoracion['valoracion'] as $key => $value) {

		foreach ($value as $campo => $valor) {
			// Si coinciden algun id de la película
			if($id_pelicula===$valor){
				
				$cant++;
			}
			
		} // Cierre del bucle foreach

	} // Cierre del bucle foreach

	// Devuelve un número entero
	return $cant;

} // Cierre de la función cantVotos


?>