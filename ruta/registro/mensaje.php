<?php
include_once("../../login/check.php");
$CodDiario=isset($_GET['Cod'])?$_GET['Cod']:'';
$url="reporte.php?Cod=".$CodDiario;
$titulo="Registro de Ruta de Transporte";
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
        <a href="./" class="btn btn-primary">Registrar Nueva Ruta de Transporte</a>
        <a href="./listar.php" class="btn btn-warning">Listar de Rutas de Transporte</a>
    </div>
<?php include_once($folder."pie.php");?>
