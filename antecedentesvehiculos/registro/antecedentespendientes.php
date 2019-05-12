<?php
require_once("../../login/check.php");
if(isset($_POST)){
    $CodVehiculo=$_POST['CodVehiculo'];


    include_once("../../class/antecedentevehiculo.php");
    $antecedentevehiculo=new antecedentevehiculo;
    $res=$antecedentevehiculo->mostrarTodoRegistro("Confirmado=0 and CodVehiculo=".$CodVehiculo,1,"FechaAntecedente");
    ?>
    <table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th width="10">N</th>
            <th>Fecha</th>
            <th>Detalle</th>
            <th>Celular</th>
            <th>Nombre</th>
        </tr>
    </thead>
    <?php
    $i=0;
    foreach ($res as $av) {$i++;
        ?>
        <tr>
            <td width="10"><?=$i;?></td>
            <td><?=$av['FechaAntecedente'];?></td>
            <td><?=$av['DetalleAntecedente'];?></td>
            <td><?=$av['CelularUsuario'];?></td>
            <td><?=$av['NombreUsuario'];?></td>
            <td><a href="#" class="btn btn-success btn-xs" id="verificar" rel="<?=$av['CodAntecedenteVehiculo'];?>"><i class="fa fa-check"></i></a></td>
        </tr>
        <?php
    }

    ?>
    </table>
    <?php


}
?>
