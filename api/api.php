<?php
// Se importa la libería Slim para crear la RESTful API
require '../library/Slim/Slim.php';
\Slim\Slim::registerAutoloader();

//Se importa el archivo json de peliculas en String
$peliculas_str = file_get_contents("../collections/peliculas.json");
//Se convierte en un objeto JSON
$peliculas = json_decode($peliculas_str,true);

// Se crea el objeto Slim
$app = new \Slim\Slim();

// Se crea un ruta para obtener las películas
$app->get('/getPeliculas', function () {

	//Se importa el archivo json de peliculas en String
	$peliculas_str = file_get_contents("../collections/peliculas.json");
	//Se convierte en un objeto JSON
	$peliculas = json_decode($peliculas_str,true);
	// Le indicamos que se le pasa un objeto JSON
	header('Content-Type: application/json');
	// Desciframos el objeto JSON para mostrarlo por pantalla todos los registro de la colección "pelicula"
	echo json_encode($peliculas);
});

// Se crea un ruta para obtener una película
$app->get('/getPelicula/:titulo', function ($titulo) {

	//Se importa el archivo json de peliculas en String
	$peliculas_str = file_get_contents("../collections/peliculas.json");
	//Se convierte en un objeto JSON
	$peliculas = json_decode($peliculas_str,true);
	$clave;
	$datosPelicula=array();
	//Se recorre el array json de las peliculas
    foreach ($peliculas['peliculas'] as $key => $value) {

        foreach ($value as $campo => $valor) {

            if($titulo===$valor){

                $clave=$key;

            }
        }
    }
    //Se recorre el array json de las peliculas
    foreach ($peliculas['peliculas'] as $key => $value) {

        if($clave===$key){

            foreach ($value as $campo => $valor) {

                array_push($datosPelicula, $valor);
            }
        }
    }
	// Le indicamos que se le pasa un objeto JSON
	header('Content-Type: application/json');
	// Desciframos el objeto JSON para mostrarlo por pantalla
	echo json_encode($datosPelicula);

});

// Se crea un ruta para mostrar las películas en cartelera
$app->get('/getCartelera', function () {

	//Se importa el archivo json de peliculas en String
	$peliculas_str = file_get_contents("../collections/peliculas.json");
	//Se convierte en un objeto JSON
	$peliculas = json_decode($peliculas_str,true);
    // Se crea un array vacío
    $claves = array();
    $cartelera = array();
    //Se recorre el array json de las peliculas
    foreach ($peliculas['peliculas'] as $key => $value) {

        foreach ($value as $campo => $valor) {

            if($campo==="boxOffice"){

                // Se añaden los valores al array
                array_push($claves,$key);

            }
        }
    }
    //Se recorre el array json de las peliculas
    foreach ($peliculas['peliculas'] as $key => $value) {

    	foreach ($claves as $campo => $dato) {

	        if($dato===$key){

	            foreach ($value as $field => $valor) {

	                array_push($cartelera, $valor);
	            }
	        }
    	}
    }

	// Le indicamos que se le pasa un objeto JSON
	header('Content-Type: application/json');
	// Desciframos el objeto JSON para mostrarlo por pantalla
	echo json_encode($cartelera);

});

// Se crea un ruta para mostrar las películas que se van a estrenar
$app->get('/getProximamente', function () {

		//Se importa el archivo json de peliculas en String
	$peliculas_str = file_get_contents("../collections/peliculas.json");
	//Se convierte en un objeto JSON
	$peliculas = json_decode($peliculas_str,true);
    // Se crea un array vacío
    $claves = array();
    $upcoming = array();
    //Se recorre el array json de las peliculas
    foreach ($peliculas['peliculas'] as $key => $value) {

        foreach ($value as $campo => $valor) {

            if($campo==="upcoming"){

                // Se añaden los valores al array
                array_push($claves,$key);

            }
        }
    }
    //Se recorre el array json de las peliculas
    foreach ($peliculas['peliculas'] as $key => $value) {

    	foreach ($claves as $campo => $dato) {

	        if($dato===$key){

	            foreach ($value as $field => $valor) {

	                array_push($upcoming, $valor);
	            }
	        }
    	}
    }
    
	// Le indicamos que se le pasa un objeto JSON
	header('Content-Type: application/json');
	// Desciframos el objeto JSON para mostrarlo por pantalla
	echo json_encode($upcoming);

});

// Se ejecuta cada ruta solicitada
$app->run();

?>