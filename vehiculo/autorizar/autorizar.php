<?php
require_once("../../login/check.php");
if(isset($_POST)){
    $Cod=$_GET['Cod'];





    @$valores=array(
                    "Modificar"=>"1"

                    );

    include_once("../../class/vehiculo.php");
    $vehiculo=new vehiculo;
    $res=$vehiculo->actualizarRegistro($valores,"CodVehiculo=$Cod");
    $CodChofer=$Cod;
    if($res){
        $mensaje[]="El vehiculo fue Autorizado para su modificación correctamente";
        $tipomensaje="success";
    }else{
        $mensaje[]="Error al autorizar modificación de datos del vehiculo";
        $tipomensaje="danger";
    }
    include_once("mensaje.php");
}
?>