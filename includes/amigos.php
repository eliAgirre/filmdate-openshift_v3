<?php
$usuario=$_SESSION['nombreUsuario'];
if(!(isset($usuario))){
    // Se guarda el valor de la variable GET
    $usuario=$_GET['nUsuario'];
}
$amigo_usu=$_GET['usuario'];

//Se importa el archivo json de sigue_amigos en String
$sigueAmigos_str = file_get_contents("../collections/sigue_amigos.json");
//Se convierte en un objeto JSON
$sigueAmigos = json_decode($sigueAmigos_str,true);
$clave=array();
$id=array();

foreach ($sigueAmigos['sigueAmigos'] as $key => $value) {

    foreach ($value as $campo => $valor) {
        // Si el usuario coincide se guarda la id del documento
        if($_SESSION['nombreUsuario']===$valor){

            // Se guarda la id del documento
            array_push($id, $key);
        }
    }
}

$somosAmigos=array();

foreach ($sigueAmigos['sigueAmigos'] as $key => $value) {

    foreach ($id as $field => $dato) {

        if($dato===$key){

            foreach ($value as $campo => $valor) {

                if($amigo_usu===$valor){
                    //Se añaden los títulos al array
                    array_push($somosAmigos, $valor);
                }
            }
        }

    }
}

// Si el array está vacío, no son amigos
if(empty($somosAmigos)){
    // Aparecerá el botón de añadir amigo
    echo "<button class='btn btn-info' id='anadirAmigo' name='$usuario' value='$amigo_usu'
        style='background-color:#66cccc; color:#fff; border:none; opacity:0.7; padding-left:5px;
        margin-right:10px;
        outline:none;'><span><img src='../images/masIcono.png'></span> Añadir amigo</button>";
}
else{ 

    echo "<button class='btn btn-info' id='anadirAmigo' name='$usuario' value='$amigo_usu'
        style='background-color:#66cccc; color:#fff; border:none; opacity:0.7; padding-left:5px;
        margin-right:10px;
        outline:none;'>Amigo <span><img src='../images/check.png'></span></button>";
}


//Se recorre el array json de los amigos que sigue el usuario
foreach ($sigueAmigos['sigueAmigos'] as $key => $value) {

	foreach ($value as $campo => $valor) {

		if($campo==="usuario"){

			if($amigo_usu===$valor){
				// Se guarda la clave del documento
                array_push($clave, $key);
			}

		}
	}
}

$listaAmigos=array();

// Se vuelve a recorrer el array para obtener la lista de los amigos que sigue el amigo
foreach ($sigueAmigos['sigueAmigos'] as $key => $value) {

    foreach ($clave as $field => $dato) {

        if($dato===$key){

            foreach ($value as $campo => $valor) {

                if($campo==="amigo"){
                    //Se añaden los títulos al array
                    array_push($listaAmigos, $valor);
                }
            }
        }

    }
}

foreach ($listaAmigos as $field => $dato) {
    if($_SESSION["nombreUsuario"]!=$dato){
        echo '<h2 class="pelisquesigues">Amigos de '. $_GET["usuario"]. ': </h2>';
        break;
    }
}
// Muestra la lista de amigos del amigo
foreach ($listaAmigos as $field => $dato) {

    if($field===0){
         echo "<tr id='fila_".$dato."'>";
         $id_documento=$dato;
    }
    // Si es distinto el nombre del usuario logueado mostrará
    if($_SESSION["nombreUsuario"]!=$dato){

        echo "<td>"; 
            echo " <a class='apilink' href='../views/profileAmigo.php?usuario=$dato'> <span class='glyphicon glyphicon-user'></span> $dato</a>";
            echo"<br>";
        echo "</td>";
        echo "</tr>";

    }
}

?>