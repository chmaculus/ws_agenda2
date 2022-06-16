<?php 


// if(!$_REQUEST){
// 	echo json_encode("Sin datos");
// }

date_default_timezone_set("America/Argentina/Buenos_Aires");


include_onnce("./includes/config.php");
include_onnce("./includes/conect.php");

$modulo="agenda_espacios";
$espacio_id="22";



switch ($modulo) {
    case "agenda_espacios":
        include("./agenda/espacios_consulta.php");
    case "c_debosancion":
        $C_DEBOSANCION = trim($tab[1]);
}



?>


