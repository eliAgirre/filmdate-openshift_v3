<?php
// Se requiere las sesiones para los mensajes flash
if( !session_id() ) session_start();
if(!(isset($_SESSION['id_usuario']) && $_SESSION['id_usuario']!='' && $_SESSION['id_usuario']=='54b39057721880ef1d8b4568')){
    // Redirecciona a la página principal si no es administrador
    header('Location: ../index.php');
}
/*if(!(isset($_SESSION['id_usuario']) && $_SESSION['id_usuario']!='' && $_SESSION['id_usuario']=='5624b7798351ef4a39fae266')){
    // Redirecciona a la página principal si no es administrador
    header('Location: ../index.php');
}*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
    <!-- Cabecera de toda la página -->
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title> filmdate </title>
        <!--para el favicon-->
        <link rel="icon" type="image/png" href="../images/favicon.png" />
        <script type="text/javascript" src="../js/borrarCritica.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/dist/css/bootstrap.css">
	</head>
    
	<body  background="../images/cine.jpg" no-repeat center center fixed>	
        <!--MENU-->
        <?php include("../includes/menuAdmin.html"); ?>

        <!-- Tabla para listar las criticas -->
        <div class="container" style="position:relative;top:50px;">
            <div class="panel panel-primary">
                <div class="panel-heading" style="background:#4D4D4D;border:none;">Críticas</div>
                <table class="table table-striped table-hover table-bordered">
                    <!-- Cabecera -->
                    <tr class="info">
                        <th style='width:5.5%;'>Usuario</th>
                        <th style='width:5.5%;'>Película</th>
                        <th style='width:82.5%;'>Crítica</th>
                        <th style='width:5%;'></th>
                    </tr>
                    <!-- Datos de cada critica -->
                    <?php
                        
                        //Se importa el archivo json de criticas en String
                        $criticas_str = file_get_contents("../collections/criticas.json");
                        //Se convierte en un objeto JSON
                        $criticas = json_decode($criticas_str,true);
                        // Se importa las funciones del archivo
                        include_once("../functions/usuarios.php");
                        include_once("../functions/peliculas.php");

                        // Se recorren los criticas
                        foreach ($criticas['criticas'] as $key => $value) {
                            echo "<tr>";
                            foreach ($value as $campo => $valor) {
                                $id;
                                if($campo==="_id"){
                                    $id=$valor;
                                }
                                if($campo==="id_usuario"){
                                    $usuario=obtenerUsuario($valor);
                                    echo "<td><p align='justify'>" . $usuario . "</p></td>";
                                }
                                if($campo==="id_pelicula"){
                                    $titulo=obtenerTitulo($valor);
                                    echo "<td><p align='justify'>" . $titulo . "</p></td>";
                                }
                                if($campo==="comentario"){
                                    echo "<td><p align='justify'>" . $valor . "</p></td>";
                                }
                            }
                            echo "<td>" ?><a id="eliminar" name="eliminar" onclick="eliminar('<?php echo htmlspecialchars($id); ?>')" class="btn btn-primary" style="background-color:#00B8E6;border:none;outline: none;"><span class="glyphicon glyphicon-trash"></span></a> <?php "</td>";
                            echo "</tr>";
                        } // Cierre del foreach
                    ?>  
                </table>
            </div>
        </div>
            
        <script type="text/javascript" src="https://code.jquery.com/jquery.js"></script> <!-- jQuery -->
        <script type="text/javascript" src="../css/dist/js/bootstrap.min.js"></script>
	</body>	
</html>