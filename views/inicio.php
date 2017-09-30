<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<!-- Cabecera de toda la página -->
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title> filmdate </title>
        <!--para el favicon-->
        <link rel="icon" type="image/png" href="../images/favicon.png" />
        <!-- El diseño está en un archivo externo -->
		<link rel="stylesheet" href="../css/main.css" />
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script> 
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> 
        <!-- jQuery de slider -->
        <script type="text/javascript" src="../js/slider.js"></script>
        <!--CSS bootstrap-->
        <link rel="stylesheet" type="text/css" href="../css/dist/css/bootstrap.css">
        <!-- jQuery para menu respontive -->
        <script type="text/javascript" src="../js/menu.js"></script>
        <!-- JavaScript para validar los campos -->
        <script type="text/javascript" src="../js/validacion.js"></script>
        <!-- Tipografia de google, para el mouseover -->
        <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
	</head> <!-- Cierre del encabezado de la página -->
	
	<!-- Cuerpo de toda la página -->
	<body>
		<!-- Engloba todas las etiquetas -->
		<div id="container">
            <!-- Encabezado de toda la página -->                    
            <?php include("includes/headerInicio.html"); ?>

            <!-- Representa el slider-->
            <div class="slider">  

                <!-- jQuery para mostrar las imagenes en el fondo del encabezado -->
                <div id="headerimgs">
                    <div id="headerimg1" class="headerimg"></div>
                    <div id="headerimg2" class="headerimg"></div>
                </div> <!-- Cierre de headerimgs -->

                <!-- Controles del slideshow -->
                <div id="headernav-outer">
                    <!-- Botones de navegador -->
                    <div id="headernav">
                        <div id="back" class="btn"></div>
                        <div id="next" class="btn"></div>
                    </div> <!-- Cierre de nav -->
                </div> <!-- Cierre de los controles del slideshow -->
            </div> <!-- Cierre del slider -->

            <!-- Representa el apartado de Cartelera -->
            <section id="cartelera">
                <!-- Boton para ir hacia abajo -->
                <div id="div_abajo">
                    <a href="#miancla"><center><span class="glyphicon-refresh-animate"><img src="../images/flecha-abajo.png"></span></center></a>
                </div> <!-- Cierre del btn_abajo -->

                <a name="miancla"></a>
                <h3> Cartelera </h3>

                <?php   
                    // Se importa el diseño mediante un css externo
                    echo "<link href=\"../css/main.css\" rel=\"stylesheet\" type=\"text/css\" >";
                    //Se importa el archivo json de peliculas en String
                    $peliculas_str = file_get_contents("collections/peliculas.json");
                    //Se convierte en un objeto JSON
                    $peliculas = json_decode($peliculas_str,true);
                    // Se crea un array vacío
                    $cartelera = array();
                    $upcoming = array();
                    //Se recorre el array json de las peliculas
                    foreach ($peliculas['peliculas'] as $key => $value) {

                        foreach ($value as $campo => $valor) {

                            if($campo==="boxOffice"){

                                // Se añaden los valores al array
                                array_push($cartelera,$key);

                            }

                            if($campo==="upcoming"){

                                // Se añaden los valores al array
                                array_push($upcoming,$key);

                            }
                        }
                    }

                    $i=0;
                    // Se recorre el array de cartelera y el array de películas bidimensional
                    foreach ($peliculas['peliculas'] as $field => $array) {

                        echo "<div class='peli'>";

                        foreach ($cartelera as $key => $value) {
                            
                            // Si el valor coincide, se guardan los datos de la película
                            if($value===$field){

                                foreach ($array as $campo => $valor) {

                                    $id_pelicula;
                                    $titulo;
                                    $year;
                                    $runtime;
                                    $poster;

                                    if($campo==="_id"){

                                        $id_pelicula=$valor;

                                    }

                                    if($campo==="title"){

                                        $titulo=$valor;
                                        $i=$i+1;

                                    }
                                    // Recorre el array hasta que el valor sea 5
                                    if($i==6){
                                        break;
                                    }

                                    if($campo==="poster"){
                                        echo "<div class='descrip'>";
                                        $poster=$valor;
                                        echo "<a href='views/perfil-peli.php?peli=$titulo'><span class='text'>";

                                            //Se importan las funciones de valoracion
                                            include_once("functions/valoracion.php");
                                            // Se obtiene la media de la película
                                            $media=mediaValoracionIndex($id_pelicula);

                                            $media=$media*2;
                                            // Se convierte a un número entero
                                            $media=round($media,2);
                                            echo "<span style='font-size:20px;'
                                            class='glyphicon glyphicon-star'></span><br/>";
                                            // Muestra el valor de la media
                                            echo $media;

                                        // Muestra el poster de la película
                                        echo"</span><img src=$poster></a><br/><br/>
                                        <h4><a href='views/perfil-peli.php?peli=$titulo'>" . $titulo. "</a></h4>";                      
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
                            }

                        }
                        echo "</div>";
                    }

                ?>  
                <!-- Muestra el signo + para ir a la lista de cartelera -->
                <div class="vermas" onclick="location.href='views/cartelera.php'">
                    <span><img src="../images/plus_azul.png"></span>
                </div>    
            </section> <!--Cierre de la Cartelera -->

            <!-- Representa el apartado de Próximamente -->
            <section id="proximamente">

                <h3> Próximamente </h3>

                <?php   

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
                                        echo "<a href='views/perfil-peli.php?peli=$titulo'><span class='text'>";

                                            //Se importan las funciones de valoracion
                                            include_once("functions/valoracion.php");
                                            // Se obtiene la media de la película
                                            $media=mediaValoracionIndex($id_pelicula2);

                                            $media=$media*2;
                                            // Se convierte a un número entero
                                            $media=round($media,2);
                                            echo "<span style='font-size:20px;'
                                            class='glyphicon glyphicon-star'></span><br/>";
                                            // Muestra el valor de la media
                                            echo $media;
                                            
                                        // Muestra el poster de la película
                                        echo"</span><img src=$poster></a><br/><br/>
                                        <h4><a href='views/perfil-peli.php?peli=$titulo'>" . $titulo. "</a></h4>";                      
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
                    }

                ?>
                <!-- Muestra el signo + para ir a la lista de próximamente -->
                <div class="vermas" onclick="location.href='views/proximamente.php'">
                    <span><img src="../images/plus_azul.png"></span>
                </div>
            </section> <!--Cierre de la Próximamente -->

            <!-- Representa el pie de toda la página -->
            <footer id="foot">
                <!-- Imágenes de las redes sociales -->
                <img class="red" style="padding-right:90px;" href="#" src="../images/red1.png"/>
                <img class="red" href="#" src="../images/red2.png"/>
                <img class="red" href="#" src="../images/red3.png"/>
                <img class="red"  href="#" src="../images/red4.png"/>
                <!-- Links -->
                <a href="views/apiTutorial.php"> API </a>
                <a href="#"> Política de privacidad </a>
                <a href="#"> © CopyRight 2014 </a>
            </footer>

            <!--Ventana Modal del Log In-->
            <?php include("includes/ventanaModalLogin.html"); ?>


            <!--Ventana Modal del Sign In-->
            <?php include("includes/ventanaModalSignin.html"); ?>
             
         </div> <!-- Cierre div del container -->

        <!-- Para las ventanas modales -->
        <script type="text/javascript" src="https://code.jquery.com/jquery.js"></script> <!-- jQuery -->
        <script type="text/javascript" src="../css/dist/js/bootstrap.min.js"></script>
	</body>	
</html>
