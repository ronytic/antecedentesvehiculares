<?php
require_once("../../login/check.php");
$Cod=$_GET['Cod'];
$CodChofer=isset($_GET['CodChofer'])?$_GET['CodChofer']:'';

include_once("../../class/marca.php");
$marca=new marca;
$cate=$marca->mostrarTodoRegistro("",1,"Nombre");
$mar=todoLista($cate,"CodMarca","Nombre");
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
$ch=$chofer->mostrarTodoRegistro("",1,"Paterno,Materno,Nombres");
$ch=todoLista($ch,"CodChofer","Paterno,Materno,Nombres,Ci"," ");





include_once("../../class/vehiculo.php");
$vehiculo=new vehiculo;
$v=$vehiculo->mostrarTodoRegistro("CodVehiculo=$Cod",1);
$v=array_shift($v);
$titulo="Modificar Datos de Vehiculo";
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
                    <td class="text-right middle">Foto</td>
                    <td><input type="file" name="Foto" id="" class="form-control">
                        <?php
                        $url="../../imagenes/vehiculo/".$v['Foto'];
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
                    <td class="text-right middle" width="30%">Marca</td>
                    <td><?=campo("CodMarca","select",$mar,"form-control",1,"",1,array(),$v['CodMarca'],1);?></td>
                </tr>
                <tr>
                    <td class="text-right middle">Color</td>
                    <td><input type="color" name="Color" id="" class="form-control" value="<?=$v['Color'];?>"  required></td>
                </tr>
                <tr>
                    <td class="text-right middle">Nº Chasis</td>
                    <td><input type="text" name="NChasis" id="" class="form-control" value="<?=$v['NChasis'];?>"  required></td>
                </tr>
                <tr>
                    <td class="text-right middle">Nº Motor</td>
                    <td><input type="text" name="NMotor" id="" class="form-control"  value="<?=$v['NMotor'];?>" required></td>
                </tr>
                <tr>
                    <td class="text-right middle">Año de Vehiculo</td>
                    <td><input type="number" name="Anio" id="" class="form-control"  value="<?=$v['Anio'];?>" required></td>
                </tr>
                <tr>
                    <td class="text-right middle">Tipo de Vehiculo</td>
                    <td><input type="text" name="Tipo" id="" class="form-control"  value="<?=$v['Tipo'];?>" required></td>
                </tr>


                <tr>
                    <td class="text-right middle">Placa</td>
                    <td><input type="text" name="Placa" id="" class="form-control" value="<?=$v['Placa'];?>"  required ></td>
                </tr>

                <tr>
                    <td class="text-right middle">Servicio de Transporte</td>
                    <td><?=campo("CodServicioTransporte","select",$st,"form-control",1,"",1,array(),$v['CodServicioTransporte'],1);?></td>
                </tr>

                <tr>
                    <td class="text-right middle">Señas Particulares</td>
                    <td><?=campo("SenasParticulares","textarea",$v['SenasParticulares'],"form-control",1,"",1,array(),0,1);?></td>
                </tr>
                <tr>
                    <td class="text-right middle">Chofer</td>
                    <td><?=campo("CodChofer","select",$ch,"form-control seleccionar",1,"",1,array(),$v['CodChofer'],1);?></td>
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
