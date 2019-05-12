<?php
require_once("../../login/check.php");
if(isset($_POST)){
    $Cod=$_GET['Cod'];





    @$valores=array(
                    "Modificar"=>"1"

                    );

    include_once("../../class/chofer.php");
    $chofer=new chofer;
    $res=$chofer->actualizarRegistro($valores,"CodChofer=$Cod");
    $CodChofer=$Cod;
    if($res){
        $mensaje[]="El chofer fue Autorizado para su modificación correctamente";
        $tipomensaje="success";
    }else{
        $mensaje[]="Error al autorizar modificación de datos del chofer";
        $tipomensaje="danger";
    }
    include_once("mensaje.php");
}
?>