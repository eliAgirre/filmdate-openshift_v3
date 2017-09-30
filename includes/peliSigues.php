<?php
// Se guarda la variable de sesión
$id_usuario=$_SESSION['id_usuario'];
// Si no contiene valor
if(!(isset($id_usuario))){
    // Se guarda el valor de la variable GET
    $id_usuario=$_GET['id_usuario'];
}

//Se importa el archivo json de sigue_peli en String
$siguePeli_str = file_get_contents("../collections/sigue_peli.json");
//Se convierte en un objeto JSON
$siguePeli = json_decode($siguePeli_str,true);
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

$listaPelis=array();

// Se vuelve a recorrer el array para obtener la lista de las películas que sigue
foreach ($siguePeli['siguePeli'] as $key => $value) {

    foreach ($clave as $field => $dato) {

        if($dato===$key){

            foreach ($value as $campo => $valor) {

                if($campo==="_id"){
                    $id=$valor;
                }

                if($campo==="titulo"){
                    //Se añaden los ids y los títulos al array
                    array_push($listaPelis, array('_id'=>$id,'titulo'=>$valor));
                }
            }
        }

    }
}

// Se recorre la lista de las pelis que el usuario sigue
foreach ($listaPelis as $field => $dato) {

    foreach ($dato as $campos => $value) {

        if($campos==="_id"){
            $id_documento=$value;
            echo "<tr  id='fila_".$id_documento."' >"; 
                echo "<td>";
                    include("../includes/botonDejarSeguirPeli.html");
                echo "</td>";
        }  

        if($campos==="titulo"){
            $dato=$value;
                echo "<td>"; 
                    echo " <a class='apilink' href='../views/perfil-peli.php?peli=$dato'> $dato</a>";
                    echo"<br>";
                echo "</td>";
            echo "</tr>";
        }
    }

}

?>