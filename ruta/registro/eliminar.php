<?php
include_once("../../login/check.php");
$Cod=$_POST['Cod'];
include_once("../../class/serviciotransporte.php");
$serviciotransporte=new serviciotransporte;

$serviciotransporte->eliminarRegistro("CodServicioTransporte=".$Cod);

?>
