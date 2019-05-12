<?php
require_once("../../login/check.php");
if(isset($_POST)){
    $Nombres=$_POST['Nombres'];
    $Paterno=$_POST['Paterno'];
    $Materno=$_POST['Materno'];
    $Ci=$_POST['Ci'];
    $FechaNac=$_POST['FechaNac'];
    $CodCategoria=$_POST['CodCategoria'];
    $Direccion=$_POST['Direccion'];
    $CodServicioTransporte=$_POST['CodServicioTransporte'];
    $CodRuta=$_POST['CodRuta'];


    if(isset($_FILES['Foto']['name'])){
        if($_FILES['Foto']['name']!=""){
        $Foto=date("Ymd_His").$_FILES['Foto']['name'];
        @copy($_FILES['Foto']['tmp_name'],"../../imagenes/chofer/".$Foto);
        }
    }
    else{
        $Foto="";
    }
    @$valores=array("Nombres"=>"'$Nombres'",
                    "Paterno"=>"'$Paterno'",
                    "Materno"=>"'$Materno'",
                    "Ci"=>"'$Ci'",
                    "FechaNac"=>"'$FechaNac'",
                    "CodCategoria"=>"'$CodCategoria'",
                    "Direccion"=>"'$Direccion'",
                    "CodServicioTransporte"=>"'$CodServicioTransporte'",
                    "CodRuta"=>"'$CodRuta'",
                    "Foto"=>"'$Foto'",

                    );

    include_once("../../class/chofer.php");
    $chofer=new chofer;
    $res=$chofer->insertarRegistro($valores);
    $CodChofer=$chofer->ultimo();
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