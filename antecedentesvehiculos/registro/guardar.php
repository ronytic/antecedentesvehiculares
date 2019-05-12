<?php
require_once("../../login/check.php");
if(isset($_POST)){
    $CodVehiculo=$_POST['CodVehiculo'];
    $FechaAntecedente=$_POST['FechaAntecedente'];
    $DetalleAntecedente=$_POST['DetalleAntecedente'];
    $CodAntecedenteVehiculo=$_POST['CodAntecedenteVehiculo'];


    @$valores=array("CodVehiculo"=>"'$CodVehiculo'",
                    "FechaAntecedente"=>"'$FechaAntecedente'",
                    "DetalleAntecedente"=>"'$DetalleAntecedente'",
                    "Confirmado"=>"1"
                    );

    include_once("../../class/antecedentevehiculo.php");
    $antecedentevehiculo=new antecedentevehiculo;
    if($CodAntecedenteVehiculo!="" && $CodAntecedenteVehiculo!="0"){
        $res=$antecedentevehiculo->actualizarRegistro($valores,"CodAntecedenteVehiculo=$CodAntecedenteVehiculo");
    }else{
        $res=$antecedentevehiculo->insertarRegistro($valores);
    }

    if($res){
        $mensaje[]="correctamente";
        $tipomensaje="success";
    }else{
        $mensaje[]="Error ";
        $tipomensaje="danger";
    }

}
?>