<?php
require_once("../../login/check.php");
if(isset($_POST)){
    $Nombre=$_POST['Nombre'];
    $Caracteristica=$_POST['Caracteristica'];
    $valores=array("Nombre"=>"'$Nombre'",
                    "Caracteristica"=>"'$Caracteristica'",
                    );
    include_once("../../class/serviciotransporte.php");
    $serviciotransporte=new serviciotransporte;
    $res=$serviciotransporte->insertarRegistro($valores);
    if($res){
        $mensaje[]="El servicio de transporte fue registrado correctamente";
        $tipomensaje="success";
    }else{
        $mensaje[]="Error al registrar el servicio de transporte";
        $tipomensaje="danger";
    }
    include_once("mensaje.php");
}
?>