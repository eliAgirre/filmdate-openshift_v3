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
        <link rel="stylesheet" type="text/css" href="../css/dist/css/bootstrap.css">
	</head>
    
	<body  background="../images/cine.jpg" no-repeat center center fixed>	
        <!--MENU-->
        <?php include("../includes/menuAdmin.html"); ?>

        <!-- Tabla para listar las películas -->
        <div class="container" style="position:relative;top:50px;">
            <div class="panel panel-primary">
                <div class="panel-heading" style="background:#4D4D4D;border:none;">Películas</div>
                <table class="table table-striped table-hover table-bordered">
                    <!-- Cabecera -->
                    <tr class="info">
                        <th style='width:12.5%;'>Título</th>
                        <th style='width:8.5%;'>Año</th>
                        <th style='width:8.5%;'>Tipo</th>
                        <th style='width:8.5%;'>Duración</th>
                        <th style='width:40.5%;'>Sinopsis</th>
                        <th style='width:8.5%;'>Reparto</th>
                        
                    </tr>
                    <!-- Datos de cada película -->
                    <?php
                        //Se importa el archivo json de peliculas en String
                        $peliculas_str = file_get_contents("../collections/peliculas.json");
                        //Se convierte en un objeto JSON
                        $peliculas = json_decode($peliculas_str,true);
                        //Se recorre el array json de las peliculas
                        foreach ($peliculas['peliculas'] as $key => $value) {
                            echo "<tr>";
                            foreach ($value as $campo => $valor) {

                                $titulo;
                                $descripcion;
                                $year;
                                $runtime;
                                $tipo;
                                $cast;

                                if($campo==="title"){

                                    $titulo=$valor;
                                    echo "<td>" . $titulo . "</td>";
                                }
                                if($campo==="synopsis"){

                                    $descripcion=$valor;
                                    echo "<td><p align='justify'>" . $descripcion .  "</p></td>";
                                }
                                if($campo==="year"){
                                    $year=$valor;
                                    echo "<td><p align='justify'>" . $year . "</p></td>";
                                }
                                if($campo==="boxOffice"){
                                    $tipo="Box Office";
                                    echo "<td><p align='justify'>" . $tipo . "</p></td>";
                                } else if($campo==="upcoming"){
                                    $tipo="Upcoming";
                                    echo "<td><p align='justify'>" . $tipo . "</p></td>";
                                }
                                
                                if($campo==="runtime"){
                                    $runtime=$valor;
                                    echo "<td><p align='justify'>" . $runtime . " mins </p></td>";
                                }
                                
                                if($campo==="abridged_cast"){
                                    $cast=$valor;
                                    echo "<td>" . $cast . "</td>";
                                }
                                
                             
                            }
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