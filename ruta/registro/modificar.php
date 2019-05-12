<?php
require_once("../../login/check.php");
$Cod=$_GET['Cod'];
include_once("../../class/ruta.php");
$ruta=new ruta;
$st=$ruta->mostrarTodoRegistro("CodRuta=$Cod",1);
$st=array_shift($st);
$titulo="Modificar datos de Ruta de Transporte";
$folder="../../";
?>
<?php require_once($folder."cabecerahtml.php");?>
<?php require_once($folder."cabecera.php");?>
<div class="panel">
    <div class="panel-heading"><h3></h3></div>
    <div class="panel-body">
        <form action="actualizar.php" method="post">
            <input type="hidden" name="Cod" value="<?=$Cod;?>">
            <table class="table">
                <tr>
                    <td class="text-right middle">Nombre</td>
                    <td><input type="text" name="Nombre" id="" class="form-control" required autofocus value="<?=$st['Nombre'];?>"></td>
                </tr>
                <tr>
                    <td class="text-right middle">Detalle</td>
                    <td><textarea name="Detalle" id="" class="form-control"><?=$st['Detalle'];?></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="middle"><input type="submit" value="Guardar" class="btn btn-primary"></td>
                </tr>

            </table>
        </form>
    </div>
</div>
<?php require_once($folder."pie.php");?>
