<?php
$server="localhost";
$user="root";
$passwd="";
$base="agenda";

$id_connection=mysql_connect($server,$user,$passwd);
if(mysql_error()){
     echo json_encode("no se pudo conectar con el Servidor");
}

mysql_select_db($base);
if(mysql_error()){
  echo json_encode("No se pudo Abrir la Base de Datos");
}

?>
