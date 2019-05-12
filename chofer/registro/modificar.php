<?php
require_once("../../login/check.php");
$Cod=$_GET['Cod'];

include_once("../../class/categoria.php");
$categoria=new categoria;
$cate=$categoria->mostrarTodoRegistro("",1,"Nombre");
$cat=todoLista($cate,"CodCategoria","Nombre");
include_once("../../class/serviciotransporte.php");
$serviciotransporte=new serviciotransporte;
$st=$serviciotransporte->mostrarTodoRegistro("",1,"Nombre");
$st=todoLista($st,"CodServicioTransporte","Nombre,Caracteristica"," - ");

include_once("../../class/ruta.php");
$ruta=new ruta;
$rut=$ruta->mostrarTodoRegistro("",1,"Nombre");
$rut=todoLista($rut,"CodRuta","Nombre,Detalle"," - ");


include_once("../../class/chofer.php");
$chofer=new chofer;
$ch=$chofer->mostrarTodoRegistro("CodChofer=$Cod",1);
$ch=array_shift($ch);
$titulo="Modificar Datos de Taxista/Chofer";
$folder="../../";
?>
<?php require_once($folder."cabecerahtml.php");?>
<?php require_once($folder."cabecera.php");?>
<div class="panel">
    <div class="panel-heading"><h3></h3></div>
    <div class="panel-body">
        <form action="actualizar.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="Cod" value="<?=$Cod;?>">
            <table class="table">
            <tr>
                    <td class="text-right middle">Nombres</td>
                    <td><input type="text" name="Nombres" id="" class="form-control"  autofocus required value="<?=$ch['Nombres'];?>"></td>
                </tr>
                <tr>
                    <td class="text-right middle">Apellido Paterno</td>
                    <td><input type="text" name="Paterno" id="" class="form-control"   required value="<?=$ch['Paterno'];?>"></td>
                </tr>
                <tr>
                    <td class="text-right middle">Apellido Materno</td>
                    <td><input type="text" name="Materno" id="" class="form-control"   required value="<?=$ch['Materno'];?>"></td>
                </tr>
                <tr>
                    <td class="text-right middle">Carnet de Identidad</td>
                    <td><input type="text" name="Ci" id="" class="form-control"   required value="<?=$ch['Ci'];?>"></td>
                </tr>
                <tr>
                    <td class="text-right middle">Fecha de Nacimiento</td>
                    <td><input type="date" name="FechaNac" id="" class="form-control"   required value="<?=$ch['FechaNac'];?>"></td>
                </tr>
                <tr>
                    <td class="text-right middle">Foto</td>
                    <td><input type="file" name="Foto" id="" class="form-control">
                        <?php
                        $url="../../imagenes/chofer/".$ch['Foto'];
                        if(file_exists($url)){
                        ?>
                        <a href="<?php echo $url?>" class="btn" target="_blank">
                            <img src="<?php echo $url?>" alt="" class="img-thumbnail">
                        </a>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="text-right middle" width="30%">Categoria de la Licencia</td>
                    <td><?=campo("CodCategoria","select",$cat,"form-control",1,"",1,array(),$ch['CodCategoria'],0);?></td>
                </tr>
                <tr>
                    <td class="text-right middle">Dirección</td>
                    <td><input type="text" name="Direccion" id="" class="form-control" required value="<?=$ch['Direccion'];?>"></td>
                </tr>

                <tr>
                    <td class="text-right middle">Servicio de Transporte</td>
                    <td><?=campo("CodServicioTransporte","select",$st,"form-control",1,"",1,array(),$ch['CodServicioTransporte'],0);?></td>
                </tr>
                <tr>
                    <td class="text-center middle" colspan="2">Localización del trabajo</td>

                </tr>
                <tr>
                    <td class="text-right middle">Ruta</td>
                    <td><?=campo("CodRuta","select",$rut,"form-control",1,"",1,array(),$ch['CodRuta'],0);?></td>
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
