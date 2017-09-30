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
        <style type="text/css">

            .contenido{
                text-align: center;
                margin-top: 250px;
            }
            .contenido p{
                color: #fff;
                font-size: 18px;
            }
            .contenido h2{
                color: #fff;
                font-size: 32px;
            }

        </style>
	</head>
	<body  background="../images/cine.jpg" no-repeat center center fixed>
        <!--MENU-->
        <?php include("../includes/menuAdmin.html"); ?>

        <div class="contenido"> 
            <h2> Parte Administración</h2>

            <p>En esta sección podrás Añadir, Listar y Eliminar Películas y Usuarios.</p>
        </div>   
            
        <script type="text/javascript" src="https://code.jquery.com/jquery.js"></script> <!-- jQuery -->
        <script type="text/javascript" src="../css/dist/js/bootstrap.min.js"></script>
	</body>	
</html>