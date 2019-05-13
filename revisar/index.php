<?php
session_start();
$_SESSION['LoginSistemaAntecedentes']=1;
$_SESSION['CodUsuarioLog']=0;
$_SESSION['NivelAcceso']=5;
$titulo="Antecedentes";

$Placa=$_POST['Placa'];
$Ci=$_POST['Ci'];

include_once("../class/vehiculo.php");
$vehiculo=new vehiculo;
$d=$vehiculo->mostrarTodoRegistro("Placa='$Placa'",1,"");


include_once("../class/chofer.php");
$chofer=new chofer;

if(count($d)==0){
    $ch=$chofer->mostrarTodoRegistro("Ci='$Ci'",1,"Nombres");
    if(count($ch)==0){
        header('Location:../login/?noci');
    }else{
        $ch=array_shift($ch);
        $d=$vehiculo->mostrarTodoRegistro("CodChofer=".$ch['CodChofer'],1,"");
        $d=array_shift($d);
    $CodVehiculo=$d['CodVehiculo'];
    }

}else{
    $d=array_shift($d);
    $CodVehiculo=$d['CodVehiculo'];
}









include_once("../class/marca.php");
$marca=new marca;
$mar=$marca->mostrarTodoRegistro("CodMarca=".$d['CodMarca'],1,"Nombre");
$mar=array_shift($mar);

include_once("../class/serviciotransporte.php");
$serviciotransporte=new serviciotransporte;
$st=$serviciotransporte->mostrarTodoRegistro("CodServicioTransporte=".$d['CodServicioTransporte'],1,"Nombre");
$st=array_shift($st);



$ch=$chofer->mostrarTodoRegistro("CodChofer=".$d['CodChofer'],1,"Nombres");
$ch=array_shift($ch);

include_once("../class/categoria.php");
$categoria=new categoria;
$cat=$categoria->mostrarTodoRegistro("CodCategoria=".$ch['CodCategoria'],1,"Nombre");
$cat=array_shift($cat);

include_once("../class/ruta.php");
$ruta=new ruta;
$rut=$ruta->mostrarTodoRegistro("CodRuta=".$ch['CodRuta'],1,"Nombre");
$rut=array_shift($rut);


include_once("../class/antecedentevehiculo.php");
$antecedentevehiculo=new antecedentevehiculo;
$av=$antecedentevehiculo->mostrarTodoRegistro("CodVehiculo=".$CodVehiculo,1,"");

include_once("../class/antecedentechofer.php");
$antecedentechofer=new antecedentechofer;
$ac=$antecedentechofer->mostrarTodoRegistro("CodChofer=".$d['CodChofer'],1,"");

$folder="../";
?>
<?php
include_once("../cabecerahtml.php");
?>
<?php
include_once("../cabecera.php");
?>

<div class="panel">
	<div class="panel-body">
        	<div class="row">
				<div class="col-lg-6">
					<h3 class="small">Datos del Vehiculo</h3>
					<table class=" small table table-bordered">
						<tr>
							<td class=" resaltar" width="40%">Placa: </td>
							<td class="" colspan="1"><?php echo ($d['Placa'])?></td>
						</tr>
						<tr>
							<td class=" resaltar">Marca: </td>
							<td class="" colspan="1"><?php echo ($mar['Nombre'])?></td>
						</tr>

						<tr>
							<td class=" resaltar">Tipo: </td>
							<td class="" colspan="1"><?php echo ($d['Tipo'])?></td>
						</tr>
						<tr>
							<td class=" resaltar">Señas Particulares: </td>
							<td class="" colspan="1"><?php echo ($d['SenasParticulares'])?></td>
						</tr>
						<tr>
							<td class=" resaltar">Servicio de Transporte: </td>
							<td class=""><?php echo ($st['Nombre'])?></td>
						</tr>
						<tr>
							<td class=" resaltar">Foto: </td>
							<td>
								<?php
								$url="../imagenes/vehiculo/".$d['Foto'];
								if(file_exists($url) && $d['Foto']!=""){
									?>
                                    <a href="<?=$url;?>" class="btn-xs" target="_blank">
                                        <img src="<?=$url;?>" class="img-thumbnail img-responsive">
                                    </a>
									<?php
								}
								?>
							</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center ">
                                <h2 class="resaltar"><?=count($av)>0?'CON ANTECEDENTES':'SIN ANTECEDENTES';?></h2>
                            </td>
                        </tr>
					</table>
				</div>
				<div class="col-lg-6">

					<h3 class="small">Datos del Chofer</h3>
					<table class="small table  table-bordered">

						<tr>
							<td class=" resaltar"  width="40%">Nombre: </td>
							<td class="" colspan="1"><?php echo ($ch['Paterno'])?>  <?php echo ($ch['Materno'])?> <?php echo ($ch['Nombres'])?></td>
						</tr>
						<tr>
							<td class=" resaltar">Carnet: </td>
							<td class="" colspan="1"><?php echo ($ch['Ci'])?></td>
						</tr>

						<tr>
							<td class=" resaltar">Ruta: </td>
							<td class="" colspan="1"><?php echo ($rut['Nombre'])?></td>
						</tr>
						<tr>
							<td class=" resaltar">Categoria Licencia: </td>
							<td class="" colspan="1"><?php echo ($cat['Nombre'])?></td>
						</tr>
                        <tr>
							<td class=" resaltar">Foto: </td>
							<td>
								<?php
								$url="../imagenes/chofer/".$ch['Foto'];
								if(file_exists($url) && $d['Foto']!=""){
									?>
                                    <a href="<?=$url;?>" class="btn-xs" target="_blank">
                                        <img src="<?=$url;?>" class="img-thumbnail img-responsive">
                                    </a>
									<?php
								}
								?>
							</td>
						</tr>
                        <tr>
                            <td colspan="2" class="text-center ">
                                <h2 class="resaltar"><?=count($ac)>0?'CON ANTECEDENTES':'SIN ANTECEDENTES';?></h2>
                            </td>
                        </tr>

					</table>

				</div>
			</div>




	</div>
</div>
<?php
include_once("../pie.php");
?>