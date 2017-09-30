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
        <style type="text/css">
            /*para el boton de carga de archivos*/
            #div_file{
              position:relative;
              width:141px;
              background-color: #BDBDBD;
              -webkit-border-radius:5px;
            }
            p#texto{
              padding: 6px;
              text-align: center;
              color:white;
              font-weight: bold;
            }
            input#subirImagen{
              position:absolute;
              top:0px;
              left:0px;
              right:0px;
              bottom:0px;
              width:100%;
              height:100%;
              opacity: 0;
            }
        </style>
	</head>

	<body  background="../images/cine.jpg" no-repeat center center fixed>	
        <!--MENU-->
        <?php include("../includes/menuAdmin.html"); ?>

        <!--Formulario-->
        <div class="container">
            <?php        
                // Muestra el mensaje flash
                echo $msg->display();
            ?>
            <!-- Añadir pelicula -->
            <div style="position:relative;top:30px;left:20px;">
                <form method="post" role="form" action="../model/anadirPeli.php" > <!-- enctype="multipart/form-data"-->
                <!--Input titulo -->
                    <div class="form-group">
                        <label for="usr" style="color:#fff;text-align: left;">Titulo de la película</label>
                        <div class="input-group"  style="width:330px;">
                            <input  style="border-radius: 5px;" type="text" class="form-control" id="usr" placeholder="Nombre" name="nombre" required>
                        </div>
                    </div>
                    <br/>
                    <!--Input descripcion -->
                    <div class="form-group">
                        <label for="usr" style="color:#fff">Descripción</label>
                        <div class="input-group"  style="width:330px;">
                            <textarea style="border-radius: 5px;" class="form-control" rows="3"  placeholder="Descripción" name="descripcion" required></textarea>
                        </div>
                    </div>
                    <br/>
                    <!--Input duracion -->
                    <div class="form-group">
                        <label for="usr" style="color:#fff">Duración</label>
                        <div class="input-group"  style="width:330px;">
                            <input  style="border-radius: 5px;" type="text" class="form-control" id="usr" placeholder="Duración" name="duracion" required>
                        </div>
                    </div>
                    <br/>
                    <!--Input reparto-->
                    <div class="form-group">
                        <label for="usr" style="color:#fff">Reparto</label>
                        <div class="input-group"  style="width:330px;">
                            <textarea  style="border-radius: 5px;" type="text" class="form-control" id="usr" placeholder="Reparto" name="reparto" required></textarea>
                        </div>
                    </div>
                    <br/>
                    <!--Input anio-->
                    <div class="form-group">
                        <label for="usr" style="color:#fff">Año</label>
                        <div class="input-group"  style="width:330px;">
                            <input  style="border-radius: 5px;" type="text" class="form-control" id="usr" placeholder="Año" name="year" required>
                        </div>
                    </div>
                    <br/>
                    <!--Radio tipo-->
                    <div class="form-group">
                        <label for="usr" style="color:#fff">Tipo de pelicula</label>
                        <div class="input-group"  style="width:330px;margin-left:25px;">
                            <label class="radio-inline"><input type="radio" name="tipoPeli" value="boxOffice" required><font color="#fff">Cartelera</font></label>
                            <label class="radio-inline"><input type="radio" name="tipoPeli" value="upcoming"><font color="#fff">Próximamente</font></label>
                        </div>
                    </div>
                    <!--Poster input
                    <div id="div_file">
                        <p id="texto"> Añade el poster</p>
                        <input type="file" id="subirImagen" name="subirImagen" accept="image/jpg, image/jpeg, image/png" src="<?php echo "admin/posters/".$image_name ?>" required>
                    </div>-->

                    <button name="anadir" type="submit" class="btn btn-primary" style="width:140px;background-color:#00B8E6;border:none;outline: none;"><span class="glyphicon glyphicon-plus"></span> Añadir película</button>
                    <br/>
                </form>
            </div>
        </div>
            
        <script type="text/javascript" src="https://code.jquery.com/jquery.js"></script> <!-- jQuery -->
        <script type="text/javascript" src="../css/dist/js/bootstrap.min.js"></script>
	</body>	
</html>