<?php
include_once("../../login/check.php");



$Placa=$_POST['Placa'];
$Ci=$_POST['Ci'];



include_once("../../class/vehiculo.php");
$vehiculo=new vehiculo;

$su=$vehiculo->mostrarTodoRegistro("Placa LIKE '$Placa' or CodChofer IN (SELECT CodChofer FROM chofer WHERE Ci LIKE '$Ci')",1,"Placa",1);
//print_r($di);


include_once("../../class/marca.php");
$marca=new marca;
include_once("../../class/serviciotransporte.php");
$serviciotransporte=new serviciotransporte;

include_once("../../class/chofer.php");
$chofer=new chofer;
include_once("../../class/ruta.php");
$ruta=new ruta;
?>
<table class="table table-hover table-bordered table-striped table-table-condensed">
	<thead>
    	<tr>
        	<th width="10">N</th>
        	<th width="100">Datos</th>


        	<th width="100">Chofer</th>
			<?php
					if(in_array( $_SESSION['NivelAcceso'],array(1,2,3))){
				?>
            <th width="40" colspan=""></th>
			<?php
			}
			?>
        </tr>
    </thead>
	<tbody>
	<?php
	if(count($su)==0){

		?>
		<tr>
			<td colspan="5">
			  No existen registros de los productos buscados
			</td>
		</tr>
	<?php
	}
	$i=0;
	foreach($su as $d){$i++;

		$m=$marca->mostrarTodoRegistro("CodMarca=".$d['CodMarca']);
		$m=array_shift($m);

		$st=$serviciotransporte->mostrarTodoRegistro("CodServicioTransporte=".$d['CodServicioTransporte']);
		$st=array_shift($st);



		$ch=$chofer->mostrarTodoRegistro("CodChofer=".$d['CodChofer']);
		$ch=array_shift($ch);

        ?>
        	<tr>
				<td><?php echo $i;?></td>
				<td class="small">
					<table class="table table-bordered">

						<tr>
							<td class=" resaltar" width="40%">Placa: </td>
							<td class="" colspan="1"><?php echo ($d['Placa'])?></td>
						</tr>
						<tr>
							<td class=" resaltar">Marca: </td>
							<td class="" colspan="1"><?php echo ($m['Nombre'])?></td>
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
									<a href="<?=$url;?>" class="btn btn-info btn-xs" target="_blank"> <i class="fa fa-image"></i></a>
									<?php
								}
								?>
							</td>
						</tr>



					</table>


				</td>
            	<td class="small">
					<table class="table table-bordered">

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




					</table>


				</td>






				<?php
					if(in_array( $_SESSION['NivelAcceso'],array(1,2))){
				?>
                <td class="text-center">
                	<a href="revisar.php?Cod=<?php echo $d['CodVehiculo']?>" class="btn btn-danger btn-xs " title="Eliminar" rel="<?php echo $d['CodVehiculo']?>">
                    	Revisar
                    </a>
                </td>
				<?php
					}
				?>
            </tr>
        <?php
    }?>
</tbody>
</table>
