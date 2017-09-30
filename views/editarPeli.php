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
// Se importa la clase de mensajes y se instancia
require_once('../controller/class.messages.php');
$msg = new Messages();
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
        <!-- Mensajes flash -->
        <link rel="stylesheet" type="text/css" href="../css/mensajes.css">
	</head>
    
	<body  background="../images/cine.jpg" no-repeat center center fixed>	
        <!--MENU-->
        <?php include("../includes/menuAdmin.html"); ?>

        <div class="container">
            <?php
                // Muestra el mensaje flash
                echo $msg->display();
            ?>
            <!-- Tabla para listar las películas -->
            <div style="position:relative;top:50px;">
            <div class="panel panel-primary">
                <div class="panel-heading" style="background:#4D4D4D;border:none;">Películas</div>
                <table class="table table-striped table-hover table-bordered">
                    <!-- Cabecera -->
                    <tr class="info">
                        <th style='width:12.5%;'>Título</th>
                        <th style='width:8.5%;'>Año</th>
                        <th style='width:8.5%;'>Duración</th>
                        <th style='width:65.5%;'>Sinopsis</th>
                        <th style='width:10.5%;'>Reparto</th>
                        <th></th>
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

                                $id;
                                $titulo;
                                $descripcion;
                                $year;
                                $runtime;
                                $cast;

                                if($campo==="_id"){

                                    $id=$valor;
                                    echo "<tr id=fila_" . $id .">";
                                }

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
                                if($campo==="runtime"){
                                    $runtime=$valor;
                                    echo "<td><p align='justify'>" . $runtime . " mins </p></td>";
                                }
                                
                                if($campo==="abridged_cast"){
                                    $cast=$valor;
                                    echo "<td>" . $cast . "</td>";
                                }
                                                         
                            }
                            // Botón para que aparezca la ventana modal modificar los datos de la pelicula 
                            echo "<td>" ?><button class="btn btn-primary open-Modal" data-toggle="modal" data-target="#editPeli" 
                            data-id="<?php echo htmlspecialchars($id); ?>" data-titulo="<?php echo htmlspecialchars($titulo); ?>" 
                            data-synopsis="<?php echo htmlspecialchars($descripcion); ?>" data-year="<?php echo htmlspecialchars($year); ?>"
                            data-runtime="<?php echo htmlspecialchars($runtime); ?>" data-reparto="<?php echo htmlspecialchars($cast); ?>"
                            style="background-color:#00B8E6;border:none;outline: none;"><span class="glyphicon glyphicon-pencil"></span></button><br /> <?php "</td>";
                            echo "</tr>";
                        } // Cierre del foreach
                    ?>  
                </table>
            </div>
            </div>
        </div>
        
                <!---------------------------tgt---------------------------------->    

        <!--Ventana Modal del Editar nombre-->
        <div class="modal fade" id="editPeli" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="height:850px;margin-top:30px;">
                    
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4>Editar la pelicula</h4>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="panel-body">
                                <form name="editarPeli" role="form" method="post" action="../model/editarPeli.php" 
                                onSubmit="return revisarEditarPeli();">
                                    <div class="form-group">
                                        <label for="exampleInputTitle">Titulo</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-film"></span></span>
                                            <input type="hidden" id="id" name="id">
                                            <input type="text" id="title" name="title" class="form-control" placeholder="Nuevo titulo" maxlength="20" required>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="form-group">
                                        <label for="exampleInputSinopsis">Sinopsis</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></span>
                                            <textarea type="text" id="synopsis" name="synopsis" class="form-control input-md" placeholder="Nuevo sinopsis" maxlength="500" style="height:200px;" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputSinopsis">Reparto</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                            <textarea type="text" id="reparto" name="abridged_cast" class="form-control input-md" placeholder="Nuevo reparto" maxlength="500" style="height:100px;" required></textarea>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="form-group">
                                        <label for="exampleInputAnio">Año</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                            <input type="text" id="year" name="year" class="form-control" placeholder="Nuevo año" maxlength="4" required>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="form-group">
                                        <label for="exampleInputDuracion">Duración</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                            <input type="text" id="runtime" name="runtime" class="form-control" placeholder="Nuevo duración" maxlength="3" required>
                                        </div>
                                    </div>
                                    <br/>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" class="btn btn-success" 
                                        style="font-size:16px;margin-top:8px;">
                                        <span class="glyphicon glyphicon-arrow-left"></span> Atras
                                    </button>
                                    <button type="submit" name="editPeli" class="btn btn-primary" style="background:#66cccc;border:none;">
                                        <span class="glyphicon glyphicon-film"></span> Modificar</button>
                                    <p><br/></p>
                                </form>
                            </div>                           
                        </div>
                    </div> <!-- Cierre de la clase modal-body -->

                </div> <!-- modal-content -->
            </div>
        </div> <!-- Cierre de la Ventana Modal Editar nombre -->
            
        <script type="text/javascript" src="https://code.jquery.com/jquery.js"></script> <!-- jQuery -->
        <script type="text/javascript" src="../css/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/mensajes.js"></script>
        <script type="text/javascript">

	        $.noConflict();
	        jQuery( document ).ready(function( $ ){	
	            $(document).on("click", ".open-Modal", function () {

	                var id = $(this).data('id');
	                var titulo = $(this).data('titulo');
	                var year = $(this).data('year');
	                var runtime = $(this).data('runtime');
	                var synopsis = $(this).data('synopsis');
	                var reparto = $(this).data('reparto');
	                console.log(titulo);
	                
	                $('#id').val(id);
	                $('#title').val(titulo);
	                $('#year').val(year);
	                $('#runtime').val(runtime);
	                $('#synopsis').val(synopsis);
	                $('#reparto').val(reparto);
	                
                    $('.modal-content').css('width', '475px');
                    $('#title').css('width', '350px');
                    $('#year').css('width', '350px');
                    $('#runtime').css('width', '350px');
                    $('#synopsis').css('width', '350px');
                    $('#reparto').css('width', '350px');
	            });
	        });
	    </script>
	</body>	
</html>