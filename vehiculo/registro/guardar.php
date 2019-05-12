<?php
require_once("../../login/check.php");
if(isset($_POST)){
    $CodMarca=$_POST['CodMarca'];
    $Color=$_POST['Color'];
    $NChasis=$_POST['NChasis'];
    $NMotor=$_POST['NMotor'];
    $Anio=$_POST['Anio'];
    $Tipo=$_POST['Tipo'];
    $Placa=$_POST['Placa'];
    $CodServicioTransporte=$_POST['CodServicioTransporte'];
    $SenasParticulares=$_POST['SenasParticulares'];
    $CodChofer=$_POST['CodChofer'];


    if(isset($_FILES['Foto']['name'])){
        if($_FILES['Foto']['name']!=""){
        $Foto=date("Ymd_His").$_FILES['Foto']['name'];
        @copy($_FILES['Foto']['tmp_name'],"../../imagenes/vehiculo/".$Foto);
        }
    }
    else{
        $Foto="";
    }
    @$valores=array("CodMarca"=>"'$CodMarca'",
                    "Color"=>"'$Color'",
                    "NChasis"=>"'$NChasis'",
                    "NMotor"=>"'$NMotor'",
                    "Anio"=>"'$Anio'",
                    "Tipo"=>"'$Tipo'",
                    "Placa"=>"'$Placa'",
                    "CodServicioTransporte"=>"'$CodServicioTransporte'",
                    "SenasParticulares"=>"'$SenasParticulares'",
                    "CodChofer"=>"'$CodChofer'",
                    "Foto"=>"'$Foto'",

                    );

    include_once("../../class/vehiculo.php");
    $vehiculo=new vehiculo;
    $res=$vehiculo->insertarRegistro($valores);
    $CodVehiculo=$vehiculo->ultimo();
    if($res){
        $mensaje[]="El chofer fue registrado correctamente";
        $tipomensaje="success";
    }else{
        $mensaje[]="Error al registrar el chofer";
        $tipomensaje="danger";
    }
    include_once("mensaje.php");
}
?>