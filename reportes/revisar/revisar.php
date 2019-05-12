<?php
include_once("../../login/check.php");


$CodVehiculo=$_GET['Cod'];






include_once("../../class/ruta.php");
$ruta=new ruta;
$rut=$ruta->mostrarTodoRegistro("",1,"Nombre");
$rut=todoLista($rut,"CodRuta","Nombre,Detalle"," - ");
$rut=array_unshift_assoc($rut,"%","Todos");




include_once("../../class/vehiculo.php");
$vehiculo=new vehiculo;
$d=$vehiculo->mostrarTodoRegistro("CodVehiculo=$CodVehiculo",1,"");
$d=array_shift($d);

include_once("../../class/marca.php");
$marca=new marca;
$mar=$marca->mostrarTodoRegistro("CodMarca=".$d['CodMarca'],1,"Nombre");
$mar=array_shift($mar);

include_once("../../class/serviciotransporte.php");
$serviciotransporte=new serviciotransporte;
$st=$serviciotransporte->mostrarTodoRegistro("CodServicioTransporte=".$d['CodServicioTransporte'],1,"Nombre");
$st=array_shift($st);


include_once("../../class/chofer.php");
$chofer=new chofer;
$ch=$chofer->mostrarTodoRegistro("CodChofer=".$d['CodChofer'],1,"Nombres");
$ch=array_shift($ch);

include_once("../../class/categoria.php");
$categoria=new categoria;
$cat=$categoria->mostrarTodoRegistro("CodCategoria=".$ch['CodCategoria'],1,"Nombre");
$cat=array_shift($cat);

include_once("../../class/ruta.php");
$ruta=new ruta;
$rut=$ruta->mostrarTodoRegistro("CodRuta=".$ch['CodRuta'],1,"Nombre");
$rut=array_shift($rut);


include_once("../../class/antecedentevehiculo.php");
$antecedentevehiculo=new antecedentevehiculo;
$av=$antecedentevehiculo->mostrarTodoRegistro("CodVehiculo=".$CodVehiculo,1,"");

include_once("../../class/antecedentechofer.php");
$antecedentechofer=new antecedentechofer;
$ac=$antecedentechofer->mostrarTodoRegistro("CodChofer=".$d['CodChofer'],1,"");

$titulo="Revisión de Antecedentes";
$folder="../../";



?>
<?php include_once($folder."cabecerahtml.php");?>
<?php include_once($folder."cabecera.php");?>
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
							<td class=" resaltar">NChasis: </td>
							<td class="" colspan="1"><?php echo ($d['NChasis'])?></td>
						</tr>
						<tr>
							<td class=" resaltar">NMotor: </td>
							<td class="" colspan="1"><?php echo ($d['NMotor'])?></td>
						</tr>
						<tr>
							<td class=" resaltar">Anio: </td>
							<td class="" colspan="1"><?php echo ($d['Anio'])?></td>
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
								$url="../../imagenes/vehiculo/".$d['Foto'];
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
							<td class=" resaltar"  width="40%">Nombres: </td>
							<td class="" colspan="1"><?php echo ($ch['Nombres'])?></td>
						</tr>
						<tr>
							<td class=" resaltar">Paterno: </td>
							<td class="" colspan="1"><?php echo ($ch['Paterno'])?></td>
						</tr>
						<tr>
							<td class=" resaltar">Materno: </td>
							<td class="" colspan="1"><?php echo ($ch['Materno'])?></td>
						</tr>
						<tr>
							<td class=" resaltar">Carnet: </td>
							<td class="" colspan="1"><?php echo ($ch['Ci'])?></td>
						</tr>
						<tr>
							<td class=" resaltar">Fecha de Nacimiento: </td>
							<td class="" colspan="1"><?php echo ($ch['FechaNac'])?></td>
						</tr>
						<tr>
							<td class=" resaltar">Ruta : </td>
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
								$url="../../imagenes/chofer/".$ch['Foto'];
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


        </form>

	</div>
</div>


<?php include_once($folder."pie.php");?>
