<?php
require_once("../../login/check.php");
if(isset($_POST)){
    $Nombre=$_POST['Nombre'];
    $Detalle=$_POST['Detalle'];
    $valores=array("Nombre"=>"'$Nombre'",
                    "Detalle"=>"'$Detalle'",
                    );
    include_once("../../class/ruta.php");
    $ruta=new ruta;
    $res=$ruta->insertarRegistro($valores);
    if($res){
        $mensaje[]="La Ruta de transporte fue registrado correctamente";
        $tipomensaje="success";
    }else{
        $mensaje[]="Error al registrar la Ruta de transporte";
        $tipomensaje="danger";
    }
    include_once("mensaje.php");
}
?>