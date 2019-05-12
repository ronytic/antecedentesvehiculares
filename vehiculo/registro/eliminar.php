<?php
include_once("../../login/check.php");
$Cod=$_POST['Cod'];
include_once("../../class/vehiculo.php");
$vehiculo=new vehiculo;

$vehiculo->eliminarRegistro("CodVehiculo=".$Cod);

?>
