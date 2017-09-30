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

        <!-- Tabla para listar los usuarios -->
        <div class="container" style="position:relative;top:50px;">
            <div class="panel panel-primary">
                <div class="panel-heading" style="background:#4D4D4D;border:none;">Usuarios</div>
                <table class="table table-striped table-hover table-bordered">
                    <!-- Cabecera -->
                    <tr class="info">
                        <th>Email</th>
                        <th>Usuario</th>
                        <th>Password</th>
                    </tr>
                    <!-- Datos de cada usuario -->
                    <?php
                        //Se importa el archivo json de usuarios en String
                        $usuarios_str = file_get_contents("../collections/usuarios.json");
                        //Se convierte en un objeto JSON
                        $usuarios = json_decode($usuarios_str, true);

                        //Se recorre el array json de las usuarios
                        foreach ($usuarios['usuarios'] as $key => $value) {
                            echo "<tr>";
                            foreach ($value as $campo => $valor) {
                                
                                $usuario;
                                $email;
                                $password;

                                if($campo==="email"){

                                    $email=$valor;
                                    echo "<td>" . $email . "</td>";
                                }
                                if($campo==="usuario"){

                                    $usuario=$valor;
                                    echo "<td>" . $usuario . "</td>";
                                }

                                if($campo==="password"){

                                    $password=$valor;
                                    echo "<td>" . $password . "</td>";
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