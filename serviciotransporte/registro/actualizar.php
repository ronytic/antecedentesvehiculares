<?php
require_once("../../login/check.php");
if(isset($_POST)){
    $Cod=$_POST['Cod'];
    $Nombre=$_POST['Nombre'];
    $Caracteristica=$_POST['Caracteristica'];
    $valores=array("Nombre"=>"'$Nombre'",
                    "Caracteristica"=>"'$Caracteristica'",
                    );
    include_once("../../class/serviciotransporte.php");
    $serviciotransporte=new serviciotransporte;
    $res=$serviciotransporte->actualizarRegistro($valores,"CodServicioTransporte=$Cod");
    if($res){
        $mensaje[]="El servicio de transporte  fue modificado correctamente";
        $tipomensaje="success";
    }else{
        $mensaje[]="Error al modificar El servicio de transporte ";
        $tipomensaje="danger";
    }
    include_once("mensaje.php");
}
?>