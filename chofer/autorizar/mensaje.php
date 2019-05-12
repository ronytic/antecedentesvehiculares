<?php
include_once("../../login/check.php");
$CodDiario=isset($_GET['Cod'])?$_GET['Cod']:'';
$url="reporte.php?Cod=".$CodDiario;
$titulo="Autorización de Modificación de Datos de Taxista/chofer";
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

        <a href="./" class="btn btn-danger">Listado  de  Choferes</a>


    </div>
<?php include_once($folder."pie.php");?>
