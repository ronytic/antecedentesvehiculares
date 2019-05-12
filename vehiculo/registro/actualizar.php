<?php
require_once("../../login/check.php");
if(isset($_POST)){
    $Cod=$_POST['Cod'];
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
                    "Modificar"=>"0"

                    );
    if(isset($_FILES['Foto']['name'])){
        if($_FILES['Foto']['name']!=""){
        $Foto=date("Ymd_His").$_FILES['Foto']['name'];
        @copy($_FILES['Foto']['tmp_name'],"../../imagenes/vehiculo/".$Foto);
        $valores['Foto']="'$Foto'";
        }
    }
    else{
        $Foto="";
    }
    include_once("../../class/vehiculo.php");
    $vehiculo=new vehiculo;
    $res=$vehiculo->actualizarRegistro($valores,"CodVehiculo=$Cod");
    $CodVehiculo=$Cod;
    if($res){
        $mensaje[]="El Vehiculo fue modificado correctamente";
        $tipomensaje="success";
    }else{
        $mensaje[]="Error al modificar el Vehiculo";
        $tipomensaje="danger";
    }
    include_once("mensaje.php");
}
?>