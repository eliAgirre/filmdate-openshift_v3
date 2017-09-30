<?php
// Se guarda la variable de sesión
$usuario=$_SESSION['nombreUsuario'];
//Se importa el archivo json de sigue_amigos en String
$sigueAmigos_str = file_get_contents("../collections/sigue_amigos.json");
//Se convierte en un objeto JSON
$sigueAmigos = json_decode($sigueAmigos_str,true);
$clave=array();
//Se recorre el array json de los amigos que sigue el usuario
foreach ($sigueAmigos['sigueAmigos'] as $key => $value) {
    
    foreach ($value as $campo => $valor) {

        if($campo==="usuario"){
            // Si coincide el usuario con algún valor del arrays
            if($usuario===$valor){
                // Se guarda la clave del documento
                array_push($clave, $key);
            }
        }
    }
}

$listaAmigos=array();

// Se vuelve a recorrer el array para obtener la lista de los amigos que sigue
foreach ($sigueAmigos['sigueAmigos'] as $key => $value) {

    foreach ($clave as $field => $dato) {

        if($dato===$key){

            foreach ($value as $campo => $valor) {

                if($campo==="_id"){
                    $id=$valor;
                }

                if($campo==="amigo"){
                    //Se añaden los ids y los usuario al array
                    array_push($listaAmigos, array('_id'=>$id,'usuario'=>$valor));
                }
            }
        }

    }
}

// Se recorre la lista de las pelis que el usuario sigue
foreach ($listaAmigos as $field => $dato) {

    foreach ($dato as $campos => $value) {

        if($campos==="_id"){
            $id_documento=$value;
            echo "<tr  id='fila_".$id_documento."' >";
                echo "<td>";
                    include("../includes/botonDejarSeguirAmigo.html");
                echo "</td>";
        }  


        if($campos==="usuario"){
            $dato=$value;
            echo "<td>"; 
                echo " <a class='apilink' href='../views/profileAmigo.php?usuario=$value'> $value</a>";
                echo"<br>";
            echo "</td>";
            echo "</tr>";
        }

    }

}
?>