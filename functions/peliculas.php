<?php

/*
* obtenerCartelera. Devuelve un array de películas que están en Cartelera.
* return --> Array de Cartelera.
*/
function obtenerCartelera(){

    //Se importa el archivo json de peliculas en String
    $peliculas_str = file_get_contents("../collections/peliculas.json");
    //Se convierte en un objeto JSON
    $peliculas = json_decode($peliculas_str,true);
    // Se crea un array vacío
    $cartelera = array();
    //Se recorre el array json de las peliculas
    foreach ($peliculas['peliculas'] as $key => $value) {

        foreach ($value as $campo => $valor) {

            if($campo==="boxOffice"){

                // Se añaden los valores al array
                array_push($cartelera,$key);

            }
        }
    }

    return $cartelera;

} // Cierre de obtenerCartelera


/*
* obtenerProximamente. Devuelve un array de películas que están en Proximamente.
* return --> Array de Proximamente.
*/
function obtenerProximamente(){

    //Se importa el archivo json de peliculas en String
    $peliculas_str = file_get_contents("../collections/peliculas.json");
    //Se convierte en un objeto JSON
    $peliculas = json_decode($peliculas_str,true);
    // Se crea un array vacío
    $upcoming = array();
    //Se recorre el array json de las peliculas
    foreach ($peliculas['peliculas'] as $key => $value) {

        foreach ($value as $campo => $valor) {

            if($campo==="upcoming"){

                // Se añaden los valores al array
                array_push($upcoming,$key);

            }
        }
    }

    return $upcoming;

} // Cierre de obtenerProximamente

/*
* peliculaExiste. Comprueba si la película existe en un booleano.
* parans --> $nombre. Se obtiene el título de la película.
* return --> Devuelve un true si existe la película, sino un false.
*/
function peliculaExiste($nombre){

    //Se importa el archivo json de peliculas en String
    $peliculas_str = file_get_contents("../collections/peliculas.json");
    //Se convierte en un objeto JSON
    $peliculas = json_decode($peliculas_str,true);
    // Variable local 
    $existe="false"; // Se establece el valor false

    //Se recorre el array json de las peliculas
    foreach ($peliculas['peliculas'] as $key => $value) {

        foreach ($value as $campo => $valor) {

            if($nombre===$valor){

                // Se establece la variable local con el valor false.
                $existe="true";

            }
        }
    }

    // Devuelve el valor booleano
    return $peliculas;  


}  //Cierre de la función peliculaExiste

/*
* obtenerTitulo. Se obtiene el nombre del usuario a través del id de la pelicula.
* parans --> $id_pelicula. Parámetro para buscar el nombre de la pelicula.
* return --> Devuelve el titulo de la pelicula.
*/
function obtenerTitulo($id_pelicula){

    //Se importa el archivo json de peliculas en String
    $peliculas_str = file_get_contents("../collections/peliculas.json");
    //Se convierte en un objeto JSON
    $peliculas = json_decode($peliculas_str,true);
    //Variable local vacio
    $clave;
    $titulo;
    //Se recorre el array json de peliculas
    foreach ($peliculas['peliculas'] as $key => $value) {

        foreach ($value as $campo => $valor) {

            // Si coincide el id de la pelicula con algún valor del array
            if($campo==="_id"){
                if($id_pelicula===$valor){
                    $clave=$key;
                }
            }
        }
    }

    //Se vuvelve a recorrer el array json de $peliculas
    foreach ($peliculas['peliculas'] as $key => $value) {

        // Si la clave coincide
        if($clave===$key){

            foreach ($value as $campo => $valor) {

                if($campo==="title"){
                    // Guardamos el valor el titulo de la pelicula
                    $titulo=$valor;

                }
            }

        }
    }

    return $titulo;

} // Cierre del obtenerTitulo

?>