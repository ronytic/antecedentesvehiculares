<?php
include_once("../../login/check.php");
$CodDiario=isset($_GET['Cod'])?$_GET['Cod']:'';
$url="reporte.php?Cod=".$CodDiario;
$titulo="Registro de Taxista/chofer";
$folder="../../";
?>
<?php include_once($folder."cabecerahtml.php");?>
<?php include_once($folder."cabecera.php");?>
	<div class="alert alert-<?=$tipomensaje;?>">
        <ul>
            <?php
            if (isset($mensaje)) {
                foreach($mensaje as $m){
                    ?>
                    <li>
                        <h3><?=$m;?></h3>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
        <a href="./" class="btn btn-primary">Registrar Nuevo Chofer</a>
        <br><br>
        <a href="./listar.php" class="btn btn-warning">Listado de Choferes</a>
        <br><br>
        <a href="<?=$folder;?>vehiculo/?CodChofer=<?=$CodChofer;?>" class="btn btn-info" target="_self">Registrar Nuevo Vehiculo</a>
        <br><br>
        <a href="<?=$folder;?>antecedentes/?CodChofer=<?=$CodChofer;?>" class="btn btn-danger"  target="_self">Registrar Antecedentes</a>

    </div>
<?php include_once($folder."pie.php");?>
