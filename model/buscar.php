<?php
///Se importa el archivo json de peliculas en String
$peliculas_str = file_get_contents("../collections/peliculas.json");
//Se convierte en un objeto JSON
$peliculas = json_decode($peliculas_str,true);
// Se requiere las sesiones para los mensajes flash
if( !session_id() ) session_start();
// Requiere la clase de mensajes y se instancia el objeto de tipo Messages
require_once('../controller/class.messages.php');
$msg = new Messages();
// Se importa los archivos css
echo "<link href=\"../css/mensajes.css\" rel=\"stylesheet\" type=\"text/css\" >";
echo "<link href=\"../css/buscar.css\" rel=\"stylesheet\" type=\"text/css\" >";

// Se comprueba si la variable POST de pelicula contiene un valor
if(isset($_POST['pelicula'])){

	// Se convierte a minúsculas
	$peliculaUsuario=strtolower($_POST['pelicula']);
	// Se eliminan los espacios del inicio y final
	$peliculaUsuario=trim($peliculaUsuario);
	// Se crea un array vacío
	$array=array();
	// Variable local
	$titulo;
	$titulo_min;
	$encontrado;
	// Se recorre el array bidimensional de peliculas
	foreach ($peliculas['peliculas'] as $key => $value) {

        foreach ($value as $campo => $valor) {	

			if($campo==="title"){
				// Se guarda el titulo de cada película
				$titulo=$valor;
				// Se convierte a minúsculas
				$titulo_min=strtolower($valor);
				// Encuentra la posición de la película del usuario en el título convertido a minúsculas
				$encontrado = strpos($titulo_min, $peliculaUsuario);
				// Si coincide
				if($encontrado !== FALSE){
					// Si son iguales
					if(strtolower($titulo)==$titulo_min){
						// Se guarda el titulo en el array
						array_push($array,$titulo);

					}

				}	

			}

		}

	} // Cierre del foreach de peliculas

	// Si el array está vacío
	if(count($array)==0){
		
		// Mensaje de error a mostrar
		$msg->add('e', 'ERROR: No existe pel&iacute;cula con la b&uacute;squeda');
		// Muestra el mensaje por pantalla
		echo $msg->display();
		// Imprime un mensaje y termina el script actual
		exit();
	}
	else{

		// Variables locales
		$titulo;
		$year;
		$runtime;
		$poster;
		$synopsis;
		$clave=array();

		// Se recorre el array  y el array de películas bidimensional
        foreach ($peliculas['peliculas'] as $field => $array2) {

        	foreach ($array as $key => $value) {

        		foreach ($array2 as $campo => $valor) {

        			if($campo==="title"){

        				if($value===$valor){

        					array_push($clave,$field);
        				}

        			}        			
        		}
        	}
        }

        foreach ($peliculas['peliculas'] as $field => $array2) {

        	foreach ($clave as $key => $value) {

        		if($value===$field){

        			foreach ($array2 as $campo => $valor) {

		        		if($campo==="poster"){

							$poster=$valor;	
							// Muestra el poster de la película
							echo "<div class='primary'>";
							echo "<a href='../views/perfil-peli.php?peli=$titulo'><img src=$poster></a>";
							echo "</div>";					
						}

						if($campo==="title"){

							$titulo=$valor;
						}

						if($campo==="year"){

							$year=$valor;
						}

						if($campo==="runtime"){

							$runtime=$valor;
						}

						if($campo==="synopsis"){

		                    $synopsis=$valor;
		                }
					}
					// Muestra el título y la descripción de cada película encontrada
				echo "<div class='secondary'>";
					echo "<h4><a href='../views/perfil-peli.php?peli=$titulo'>" . $titulo. "</a></h4>";
					echo "<p>Ano: $year </p>";
					echo "<p>Duracion: $runtime mins </p>";
					echo "<p>Sinopsis: $synopsis </p>";
				echo "</div>";

        		}

	        	
				
			}
        } // Cierre del array

	}
} // Cierre del POST	
?>