<?php
    $id_pelicula;
    // Se comprueba si la variable GET tiene algún valor
    if(isset($_GET['id_pelicula'])){
        // Si no tiene valor, se guarda en la variable local
        $id_pelicula=$_GET['id_pelicula'];           
    }
    // Se importa las funciones del archivo
    include_once("../functions/criticas.php");
    include_once("../functions/usuarios.php");
    // Se guarda el array en una variable                    
    $comentarios=obtenerCriticas($id_pelicula);
    // Se recorren los comentarios
    foreach ($comentarios as $key => $value) {
        foreach ($value as $field => $valor) {

            if($field==="id_usuario"){

                $usuario=obtenerUsuario($valor);

                echo "<a class='linkUsu' href='../views/profileAmigo.php?usuario=$usuario'>
                <span class='glyphicon glyphicon-user'></span>". $usuario ."</a><br/>";

            }
            if($field==="comentario"){

                echo "<p align='justify'>".$valor."</p><br/><br/><br/>";
            }
        }                            
    }
?>