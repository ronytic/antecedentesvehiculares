<?php
require_once("../../login/check.php");
if(isset($_POST)){
    $Cod=$_POST['Cod'];
    $Nombre=$_POST['Nombre'];
    $Detalle=$_POST['Detalle'];
    $valores=array("Nombre"=>"'$Nombre'",
                    "Detalle"=>"'$Detalle'",
                    );
    include_once("../../class/ruta.php");
    $ruta=new ruta;
    $res=$ruta->actualizarRegistro($valores,"CodRuta=$Cod");
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