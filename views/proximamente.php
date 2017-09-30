<html>
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title> Próximamente </title>
		<!--para el favicon-->
        <link rel="icon" type="image/png" href="../images/favicon.png" />
		<link rel="stylesheet" href="../css/listaPelis.css" /> <!-- El diseño está en un archivo externo -->
		<!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>		
		<!--CSS bootstrap-->
        <link rel="stylesheet" type="text/css" href="../css/dist/css/bootstrap.css">
        <!-- jQuery para menu respontive -->
        <script type="text/javascript" src="../js/menu.js"></script>
        <!-- JavaScript para validar los campos -->
        <script type="text/javascript" src="../js/validacion.js"></script>  
        <!-- Tipografia de google, para el mouseover -->
        <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
	</head>

	<body>
		<!-- Engloba todas las etiquetas -->
		<div id="container">
			<!-- Encabezado de toda la página -->
			<?php include("../includes/headerListaPelis.html"); ?>
			<!-- Representa el apartado de Próximamente -->
        	<section id="proximamente">

				<h3> Próximamente </h3>

				<?php
					echo "<link href=\"../css/listaPelis.css\" rel=\"stylesheet\" type=\"text/css\" >";
					//Se importa el archivo json de peliculas en String
                    $peliculas_str = file_get_contents("../collections/peliculas.json");
                    //Se convierte en un objeto JSON
                    $peliculas = json_decode($peliculas_str,true);
                    // Se importa las funciones del archivo
                    include_once("../functions/peliculas.php");
                    // Se guarda el array en una variable                    
                    $upcoming=obtenerProximamente();
					// Se recorre el array de cartelera y el array de películas bidimensional
                    foreach ($peliculas['peliculas'] as $field => $array) {

                        foreach ($upcoming as $key => $value) {
                            
                            // Si el valor coincide, se guardan los datos de la película
                            if($value===$field){

                            	echo "<div class='peli'>";

                                foreach ($array as $campo => $valor) {

                                    $id_pelicula2;
                                    $titulo;
                                    $year;
                                    $runtime;
                                    $poster;

                                    if($campo==="_id"){

                                        $id_pelicula2=$valor;

                                    }

                                    if($campo==="title"){

                                        $titulo=$valor;

                                    }

                                    if($campo==="poster"){
                                        echo "<div class='descrip'>";
                                        $poster=$valor;
                                        echo "<a href='perfil-peli.php?peli=$titulo'><span class='text'>";

                                            //Se importan las funciones de valoracion
                                            include_once("../functions/valoracion.php");
                                            // Se obtiene la media de la película
                                            $media=mediaValoracion($id_pelicula2);

                                            $media=$media*2;
                                            // Se convierte a un número entero
                                            $media=round($media,2);
                                            echo "<span style='font-size:20px;'
                                            class='glyphicon glyphicon-star'></span><br/>";
                                            // Muestra el valor de la media
                                            echo $media;

                                        // Muestra el poster de la película
                                        echo"</span><img src=$poster></a><br/><br/>
                                        <h4><a href='perfil-peli.php?peli=$titulo'>" . $titulo. "</a></h4>";                      
                                        // Muestra el título y al hacer clic muestra la página de la película correspondiente
                                    }

                                    if($campo==="year"){

                                        $year=$valor;
                                        echo "<p>" . $year. "</p>";

                                    }

                                    if($campo==="runtime"){

                                        $runtime=$valor;
                                        echo "<p>" . $runtime. " mins </p>";
                                        echo "</div>";
                                    }
                                }

                                echo "</div>";

                            }

                        }
                    } // Se cierra el foreach

				?>
			</section> <!-- Cierre de la Próximamente -->

	        <!-- Pie de toda la página -->
	        <?php include("../includes/footer.html"); ?>
			<!--Ventana Modal del Log In-->
	        <?php include("../includes/ventanaModalLogin.html"); ?>
	        <!--Ventana Modal del Sign In-->
	        <?php include("../includes/ventanaModalSignin.html"); ?>
		</div> <!-- div de Container -->

		<!-- Para las ventanas modales -->
		<script type="text/javascript" src="https://code.jquery.com/jquery.js"></script> <!-- jQuery -->
        <script type="text/javascript" src="../css/dist/js/bootstrap.min.js"></script>
	</body>
</html>
