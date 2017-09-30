<?php

/*
* usuarioExiste. Para comprobar si un usuario existe con un email.
* parans --> $email. Se obtiene del formulario.
* return --> Si el usuario existe retorna true, sino false.
*/
function usuarioExiste($email){

    //Se importa el archivo json de usuarios en String
    $usuarios_str = file_get_contents("../collections/usuarios.json");
    //Se convierte en un objeto JSON
    $usuarios = json_decode($usuarios_str, true);
    // Variable local 
    $existe="false"; // Se establece el valor false

    //Se recorre el array json de las usuarios
    foreach ($usuarios['usuarios'] as $key => $value) {

        foreach ($value as $campo => $valor) {

            if($email===$valor){

                $existe="true";

            }

            
        }
    }

    // Devuelve el valor de la variable local
    return $existe; 

} // Cierre de la función usuarioExiste


/*
* comprobarPassword. Para comprobar si un usuario existe.
* parans --> $email. Se obtiene del formulario.
*        --> $password. Se obtiene password cifrado del formulario.
* return --> Si el la contraseña coincide devolverá true, sino false.
*/
function comprobarPassword($email,$password){

    //Se importa el archivo json de usuarios en String
    $usuarios_str = file_get_contents("../collections/usuarios.json");
    //Se convierte en un objeto JSON
    $usuarios = json_decode($usuarios_str, true);
    // Variables locales
    $correcto="false"; // Se establece el valor false
    $clave; //vacío

    //Se recorre el array json de las usuarios
    foreach ($usuarios['usuarios'] as $key => $value) {

        foreach ($value as $campo => $valor) {

            if($email===$valor){
                // Se guardar el key del array
                $clave=$key;

            }

            
        }
    }

    //Se recorre el array json de las usuarios
    foreach ($usuarios['usuarios'] as $key => $value) {

        if($clave===$key){

            foreach ($value as $campo => $valor) {

                if($password===$valor){

                    $correcto="true";
                }
            }
        }
    }

    return $correcto;

} // Cierre de la función comprobarPassword

/*
* obtenerIdUsuario. Se obtiene el campo id de la bd.
* parans --> $email. Se obtiene del formulario.
* return --> El id en String.
*/
function obtenerIdUsuario($email){

    //Se importa el archivo json de usuarios en String
    $usuarios_str = file_get_contents("../collections/usuarios.json");
    //Se convierte en un objeto JSON
    $usuarios = json_decode($usuarios_str, true);

    // Variable local 
    $id; // Se establece el valor vacío

    //Se recorre el array json de las usuarios
    foreach ($usuarios['usuarios'] as $key => $value) {

        foreach ($value as $campo => $valor) {

            if($email===$valor){
                // Se guardar el key del array
                $clave=$key;

            }

            
        }
    }

    //Se recorre el array json de las usuarios
    foreach ($usuarios['usuarios'] as $key => $value) {

        if($clave===$key){

            foreach ($value as $campo => $valor) {

                if($campo==="_id"){
                    // Se guarda el valor del id_usuario
                    $id=$valor;

                }
            }
        }
    }

    // Devuelve la variable local en String
    return $id;

} // Cierre de la función obtenerIdUsuario


/*
* obtenerDatosUsuario. Se obtiene los datos del usuario.
* parans --> $id_usuario. Se obtiene desde la función obtenerIdUsuario.
* return --> Devuelve el array de datos del usuario.
*/
function obtenerDatosUsuario($id_usuario){

    //Se importa el archivo json de usuarios en String
    $usuarios_str = file_get_contents("../collections/usuarios.json");
    //Se convierte en un objeto JSON
    $usuarios = json_decode($usuarios_str, true);
    // Se crea un array vacío
    $datosUsuario=array();
    //Se recorre el array json de las usuarios
    foreach ($usuarios['usuarios'] as $key => $value) {

        foreach ($value as $campo => $valor) {

            if($id_usuario===$valor){
                // Se guardar el key del array
                $clave=$key;

            }
            
        }
    }

    //Se recorre el array json de las usuarios
    foreach ($usuarios['usuarios'] as $key => $value) {

        if($clave===$key){

            foreach ($value as $campo => $valor) {

                array_push($datosUsuario, $valor);
            }
        }
    }

    // Devuelve los datos del usuario en un
    return $datosUsuario;

} // Cierre de la función obtenerDatosUsuario

/*
* obtenerIdUser. Se obtiene el id del usuario a través del nombre del usuario.
* parans --> nombreUsuario. Parámetro para buscar el id del usuario.
* return --> Devuelve el id del usuario.
*/
function obtenerIdUser($nombreUsuario){

    //Se importa el archivo json de usuarios en String
    $usuarios_str = file_get_contents("../collections/usuarios.json");
    //Se convierte en un objeto JSON
    $usuarios = json_decode($usuarios_str, true);

    // Variable local vacio
    $clave;
    $id_usuario;
    //Se recorre el array json de usuarios
    foreach ($usuarios['usuarios'] as $key => $value) {

        foreach ($value as $campo => $valor) {
            // Si coincide el nombre del usuario con algún valor del array
            if($nombreUsuario===$valor){
                // Se guarda la clave
                $clave=$key;

            }            
        }
    }

    //Se vuvelve a recorrer el array json de usuarios
    foreach ($usuarios['usuarios'] as $key => $value) {

        // Si la clave coincide
        if($clave===$key){

            foreach ($value as $campo => $valor) {

                if($campo==="_id"){
                    // Guardamos el valor el id del usuario
                    $id_usuario=$valor;

                }
            }

        }
    }

    // Deveuvel el id del usuario
    return $id_usuario;

} // Cierre de la función obtenerIdUser

/*
* obtenerUsuario. Se obtiene el nombre del usuario a través del id del usuario.
* parans --> id_usuario. Parámetro para buscar el nombre del usuario.
* return --> Devuelve el nombre del usuario.
*/
function obtenerUsuario($id_usuario){

    //Se importa el archivo json de usuarios en String
    $usuarios_str = file_get_contents("../collections/usuarios.json");
    //Se convierte en un objeto JSON
    $usuarios = json_decode($usuarios_str, true);
    //Variable local vacio
    $clave;
    $usuario;
    //Se recorre el array json de usuarios
    foreach ($usuarios['usuarios'] as $key => $value) {

        foreach ($value as $campo => $valor) {

            // Si coincide el nombre del usuario con algún valor del array
            if($id_usuario===$valor){
                $clave=$key;
            }
        }
    }

    //Se vuvelve a recorrer el array json de usuarios
    foreach ($usuarios['usuarios'] as $key => $value) {

        // Si la clave coincide
        if($clave===$key){

            foreach ($value as $campo => $valor) {

                if($campo==="usuario"){
                    // Guardamos el valor el id del usuario
                    $usuario=$valor;

                }
            }

        }
    }

    return $usuario;

} // Cierre del obtenerUsuario

/*
* usernameExiste. Para comprobar si un usuario existe con un nombre de usuario.
* parans --> $email. Se obtiene del formulario.
* return --> Si el usuario existe retorna true, sino false.
*/
function usernameExiste($usuario){

    //Se importa el archivo json de usuarios en String
    $usuarios_str = file_get_contents("../collections/usuarios.json");
    //Se convierte en un objeto JSON
    $usuarios = json_decode($usuarios_str, true);
    // Variable local 
    $existe="false"; // Se establece el valor false

    //Se recorre el array json de las usuarios
    foreach ($usuarios['usuarios'] as $key => $value) {

        foreach ($value as $campo => $valor) {

            if($usuario===$valor){

                $existe="true";

            }

            
        }
    }

    // Devuelve el valor de la variable local
    return $existe;

} // Cierre de la función usuarioExiste

/*
* verificarPassword. Para comprobar si el usuario ha introducido la contraseña correcta.
* parans --> $usuario. Se obtiene del formulario.
*        --> $password. Se obtiene password cifrado del formulario.
* return --> Si el la contraseña coincide con la de bd devolverá true, sino false.
*/
function verificarPassword($usuario,$password){

    //Se importa el archivo json de usuarios en String
    $usuarios_str = file_get_contents("../collections/usuarios.json");
    //Se convierte en un objeto JSON
    $usuarios = json_decode($usuarios_str, true);
    // Variable local 
    $correcto="false"; // Se establece el valor false
    $clave;

     //Se recorre el array json de las usuarios
    foreach ($usuarios['usuarios'] as $key => $value) {

        foreach ($value as $campo => $valor) {

            // Si el username coincide con algún valor
            if($usuario===$valor){
                // Se obtiene el id del documento
                $clave=$key;

            }// Cierre del if

        }

    }// Cierre del bucle foreach

    // Se vuelve a recorrer para saber si coinciden con la contraseña
    foreach ($usuarios['usuarios'] as $key => $value) {

        if($clave===$key){

            foreach ($value as $campo => $valor) {
                // Si coincide la contraseña
                if($password===$valor){

                    // Se establece a la variable local el valor true
                    $correcto="true";

                }// Cierre del if

            }

        }

    }// Cierre del bucle foreach

    // Devuelve el valor de la variable local
    return $correcto;

} // Cierre de la función verificarPassword

/*
* obtenerEmail. Se obtiene el campo email de la bd.
* parans --> $usuario. Se obtiene del formulario.
* return --> El email en String.
*/
function obtenerEmail($id_usuario){

    //Se importa el archivo json de usuarios en String
    $usuarios_str = file_get_contents("../collections/usuarios.json");
    //Se convierte en un objeto JSON
    $usuarios = json_decode($usuarios_str, true);
    // Variable local 
    $email=''; // Se establece el valor vacío de String
    $clave; // Contiene un valor NULO

    //Se recorre el array json de las usuarios
    foreach ($usuarios['usuarios'] as $key => $value) {

        foreach ($value as $campo => $valor) {

            // Si el id del usuario coincide con algún valor
            if($id_usuario===$valor){
                // Se obtiene el id del documento
                $clave=$key;

            }// Cierre del if

        }

    }// Cierre del bucle foreach

    // Se vuelve a recorrer para saber si coinciden con la contraseña
    foreach ($usuarios['usuarios'] as $key => $value) {

        if($clave===$key){

            foreach ($value as $campo => $valor) {

                if($campo==="email"){

                    // Se guarda el email en la variable local
                    $email=$valor;

                }// Cierre del if

            }

        }

    }// Cierre del bucle foreach

    // Devuelve la variable local en String
    return $email;

} // Cierre de la función obtenerEmail

?>