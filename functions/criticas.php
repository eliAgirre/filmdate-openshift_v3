<?php

/*
* obtenerCriticas. Devuelve un array bidireccional de comentarios sobre la película.
* param --> Id de la película.
* return --> Array de críticas.
*/

function obtenerCriticas($id_peli){

    //Se importa el archivo json de criticas en String
    $criticas_str = file_get_contents("../collections/criticas.json");
    //Se convierte en un objeto JSON
    $criticas = json_decode($criticas_str,true);
    $clave=array(); // Array vacio    
    // Se recorre el array bidireccional de criticas
    foreach ($criticas['criticas'] as $key => $value) {

        foreach ($value as $campo => $valor) {

            if($valor===$id_peli){
                // Se añaden los valores al array
                array_push($clave, $key);

            }
                                        
        }
    }
    $comentarios=array();

    foreach ($clave as $field => $dato) {

        foreach ($criticas['criticas'] as $key => $value) {

            if($dato===$key){

                foreach ($value as $campo => $valor) {

                    if($campo==="id_usuario"){

                        $id_usuario=$valor;

                    }

                    if($campo==="comentario"){
                        $comentario=$valor;
                        array_push($comentarios, array('id_usuario'=>$id_usuario,'comentario'=>$comentario));
                    }
                    
                    
                }

            }
        }

    }

    return $comentarios;    

} // Cierre de obtenerCriticas

/*
* obtenerDatosCritics. Devuelve un array bidireccional de comentarios sobre la película y su id.
* param --> Id de la película.
* return --> Array de críticas.
*/

function obtenerDatosCritics($id_peli){

    //Se importa el archivo json de criticas en String
    $criticas_str = file_get_contents("../collections/criticas.json");
    //Se convierte en un objeto JSON
    $criticas = json_decode($criticas_str,true);
    $clave=array(); // Array vacio    
    // Se recorre el array bidireccional de criticas
    foreach ($criticas['criticas'] as $key => $value) {

        foreach ($value as $campo => $valor) {

            if($valor===$id_peli){
                // Se añaden los valores al array
                array_push($clave, $key);

            }
                                        
        }
    }
    $comentarios=array();

    foreach ($clave as $field => $dato) {

        foreach ($criticas['criticas'] as $key => $value) {

            if($dato===$key){

                foreach ($value as $campo => $valor) {

                    if($campo==="id_pelicula"){

                        $id_pelicula=$valor;

                    }

                    if($campo==="id_usuario"){

                        $id_usuario=$valor;

                    }

                    if($campo==="comentario"){
                        $comentario=$valor;
                        array_push($comentarios, array('id_pelicula'=>$id_pelicula,'id_usuario'=>$id_usuario,'comentario'=>$comentario));
                    }
                    
                    
                }

            }
        }

    }

    return $comentarios;    

} // Cierre de obtenerCriticas

?>