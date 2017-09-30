<?php
// Se importan las funciones para obtener datos
include_once("../functions/usuarios.php");
// Se guarda el valor de la variable GET
$nombreUsuario=$_GET['usuario'];
//Se importa el archivo json de sigue_peli en String
$siguePeli_str = file_get_contents("../collections/sigue_peli.json");
//Se convierte en un objeto JSON
$siguePeli = json_decode($siguePeli_str,true);
// Utilizamos la función para obtener la id del usuario
$id_usuario=obtenerIdUser($nombreUsuario);
$clave=array(); 
//Se recorre el array json de las peliculas que sigue el usuario
foreach ($siguePeli['siguePeli'] as $key => $value) {

    foreach ($value as $campo => $valor) {
        // Si coincide el id_usuario con algún valor del array
        if($id_usuario===$valor){
            // Se guarda la clave del documento
            array_push($clave, $key);

        }
    }
}

$listaPelisAmigo=array();

// Se vuelve a recorrer el array para obtener la lista de las películas que sigue el Amigo
foreach ($siguePeli['siguePeli'] as $key => $value) {

    foreach ($clave as $field => $dato) {

        if($dato===$key){

            foreach ($value as $campo => $valor) {

                if($campo==="titulo"){
                    //Se añaden los títulos al array
                    array_push($listaPelisAmigo, $valor);
                }
            }
        }

    }
}

// Se recorre la lista de las pelis que el usuario sigue
foreach ($listaPelisAmigo as $field => $dato) {

    if($field===0){
         echo "<tr id='fila_".$dato."'>";
         $id_documento=$dato;
    }
    echo "<td>"; 
        echo " <a class='apilink' href='../views/perfil-peli.php?peli=$dato'><span class='glyphicon glyphicon-film'></span> $dato</a>";
        echo"<br>";
    echo "</td>";
    echo "</tr>";

}
?>