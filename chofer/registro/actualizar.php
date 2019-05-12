<?php
require_once("../../login/check.php");
if(isset($_POST)){
    $Cod=$_POST['Cod'];
    $Nombres=$_POST['Nombres'];
    $Paterno=$_POST['Paterno'];
    $Materno=$_POST['Materno'];
    $Ci=$_POST['Ci'];
    $FechaNac=$_POST['FechaNac'];
    $CodCategoria=$_POST['CodCategoria'];
    $Direccion=$_POST['Direccion'];
    $CodServicioTransporte=$_POST['CodServicioTransporte'];
    $CodRuta=$_POST['CodRuta'];




    @$valores=array("Nombres"=>"'$Nombres'",
                    "Paterno"=>"'$Paterno'",
                    "Materno"=>"'$Materno'",
                    "Ci"=>"'$Ci'",
                    "FechaNac"=>"'$FechaNac'",
                    "CodCategoria"=>"'$CodCategoria'",
                    "Direccion"=>"'$Direccion'",
                    "CodServicioTransporte"=>"'$CodServicioTransporte'",
                    "CodRuta"=>"'$CodRuta'",
                    "Modificar"=>"0"

                    );
    if(isset($_FILES['Foto']['name'])){
        if($_FILES['Foto']['name']!=""){
        $Foto=date("Ymd_His").$_FILES['Foto']['name'];
        @copy($_FILES['Foto']['tmp_name'],"../../imagenes/chofer/".$Foto);
        $valores['Foto']="'$Foto'";
        }
    }
    else{
        $Foto="";
    }
    include_once("../../class/chofer.php");
    $chofer=new chofer;
    $res=$chofer->actualizarRegistro($valores,"CodChofer=$Cod");
    $CodChofer=$Cod;
    if($res){
        $mensaje[]="El chofer fue modificado correctamente";
        $tipomensaje="success";
    }else{
        $mensaje[]="Error al modificar la chofer";
        $tipomensaje="danger";
    }
    include_once("mensaje.php");
}
?>