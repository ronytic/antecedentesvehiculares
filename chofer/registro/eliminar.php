<?php
include_once("../../login/check.php");
$Cod=$_POST['Cod'];
include_once("../../class/chofer.php");
$chofer=new chofer;

$chofer->eliminarRegistro("CodChofer=".$Cod);

?>
