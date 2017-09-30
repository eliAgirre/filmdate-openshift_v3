<?php
// Se guarda la variable de sesión
$id_usuario=$_SESSION['id_usuario'];
// Si no contiene valor
if(!(isset($id_usuario))){
    // Se guarda el valor de la variable GET
    $id_usuario=$_GET['id_usuario'];
}

//Se importa el archivo json de sigue_peli en String
$pelisComents_str = file_get_contents("../collections/criticas.json");
//Se convierte en un objeto JSON
$pelisComents = json_decode($pelisComents_str,true);
$clave=array();
//Se recorre el array json de las peliculas que sigue el usuario
foreach ($pelisComents['criticas'] as $key => $value) {

    foreach ($value as $campo => $valor) {
        // Si coincide el id_usuario con algún valor del array
        if($id_usuario===$valor){
            // Se guarda la clave del documento
            array_push($clave, $key);

        }
    }
}

$listaComents=array();

// Se vuelve a recorrer el array para obtener la lista de las películas que sigue
foreach ($pelisComents['criticas'] as $key => $value) {

    foreach ($clave as $field => $dato) {

        if($dato===$key){

            foreach ($value as $campo => $valor) {

                if($campo==="_id"){
                    $id=$valor;
                }

                if($campo==="comentario"){
                    //Se añaden los ids y los títulos al array
                    array_push($listaComents, array('_id'=>$id,'comentario'=>$valor));
                }
            }
        }

    }
}

// Se recorre la lista de los comentarios del usuario acerca de la pelicula
foreach ($listaComents as $field => $dato) {

    foreach ($dato as $campos => $value) {
        
        $coment;
        $id_documento;

        if($campos==="_id"){
            $id_documento=$value;
        }  

        if($campos==="comentario"){
            $dato=$value;
            $coment=$value;
            echo "<tr  id='fila_".$id_documento."' >"; 
                echo "<td>";
                    include("../includes/botonBorrarComentPeli.html");
                echo "</td>";
                echo "<td>";?>
                    <button class="btn btn-primary open-Modal" data-toggle="modal" data-target="#editComent" 
                    data-id="<?php echo htmlspecialchars($id_documento); ?>" data-coment="<?php echo htmlspecialchars($coment); ?>"
                    style="background-color:#66cccc;border:none;outline:none;margin-right:7px;margin-bottom:7px;">
                    <span class="glyphicon glyphicon-pencil"></span></button><br /> 
                <?php    
                echo "</td>";
                echo "<td>"; 
                    echo $dato;
                    echo"<br>";
                echo "</td>";
            echo "</tr>";
        }
    }

}

?>