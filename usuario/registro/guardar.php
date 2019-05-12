<?php
require_once("../../login/check.php");
if(isset($_POST)){

    $NivelAcceso=$_POST['NivelAcceso'];
    $Nombres=$_POST['Nombres'];
    $Apellidos=$_POST['Apellidos'];
    $Ci=$_POST['Ci'];
    $Rango=$_POST['Rango'];
    $Cargo=$_POST['Cargo'];
    $Usuario=$_POST['Usuario'];
    $Contrasena=$_POST['Contrasena'];



    @$valores=array(
                    "NivelAcceso"=>"'$NivelAcceso'",
                    "Nombres"=>"'$Nombres'",
                    "Apellidos"=>"'$Apellidos'",

                    "Ci"=>"'$Ci'",
                    "Rango"=>"'$Rango'",
                    "Cargo"=>"'$Cargo'",
                    "Usuario"=>"'$Usuario'",
                    "Contrasena"=>"SHA1('$Contrasena')",
                    );

    include_once("../../class/usuario.php");
    $usuario=new usuario;
    $res=$usuario->insertarRegistro($valores);
    if($res){
        $mensaje[]="El usuario fue registrado correctamente";
        $tipomensaje="success";
    }else{
        $mensaje[]="Error al registrar el usuario";
        $tipomensaje="danger";
    }
    include_once("mensaje.php");
}
?>