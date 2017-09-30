<?php
session_start();
//destruir sesion
session_destroy();
//establecer la fecha de expiración a una hora atrás
setcookie ("Usuario", "", time()-3600);
// Redirecciona a la página principal
header("location:".$_SERVER['HTTP_REFERER']);
?>