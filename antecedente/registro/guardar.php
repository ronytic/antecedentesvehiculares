<?php
require_once("../../login/check.php");
if(isset($_POST)){
    $CodChofer=$_POST['CodChofer'];
    $FechaAntecedente=$_POST['FechaAntecedente'];
    $DetalleAntecedente=$_POST['DetalleAntecedente'];
    $CodAntecedenteChofer=$_POST['CodAntecedenteChofer'];


    @$valores=array("CodChofer"=>"'$CodChofer'",
                    "FechaAntecedente"=>"'$FechaAntecedente'",
                    "DetalleAntecedente"=>"'$DetalleAntecedente'",
                    "Confirmado"=>"1"
                    );

    include_once("../../class/antecedentechofer.php");
    $antecedentechofer=new antecedentechofer;
    if($CodAntecedenteChofer!="" && $CodAntecedenteChofer!="0"){
        $res=$antecedentechofer->actualizarRegistro($valores,"CodAntecedenteChofer=$CodAntecedenteChofer");
    }else{
        $res=$antecedentechofer->insertarRegistro($valores);
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