<?php
require_once("../login/check.php");
if(isset($_POST)){
    $CodChofer=$_POST['CodChofer'];
    $FechaAntecedente=$_POST['FechaAntecedente'];
    $DetalleAntecedente=$_POST['DetalleAntecedente'];
    $CelularUsuario=$_POST['CelularUsuario'];
    $NombreUsuario=$_POST['NombreUsuario'];


    @$valores=array("CodChofer"=>"'$CodChofer'",
                    "FechaAntecedente"=>"'$FechaAntecedente'",
                    "DetalleAntecedente"=>"'$DetalleAntecedente'",
                    "CelularUsuario"=>"'$CelularUsuario'",
                    "NombreUsuario"=>"'$NombreUsuario'",
                    "Confirmado"=>"0"
                    );

    include_once("../class/antecedentechofer.php");
    $antecedentechofer=new antecedentechofer;

        $res=$antecedentechofer->insertarRegistro($valores);


    if($res){
        $mensaje[]="correctamente";
        $tipomensaje="success";
    }else{
        $mensaje[]="Error ";
        $tipomensaje="danger";
    }

}
?>