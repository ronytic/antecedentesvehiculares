<?php
include_once("../../login/check.php");


$CodCategoria=$_POST['CodCategoria'];
$CodServicioTransporte=$_POST['CodServicioTransporte'];
$CodRuta=$_POST['CodRuta'];
$Nombres=$_POST['Nombres'];
$Paterno=$_POST['Paterno'];
$Materno=$_POST['Materno'];
$Ci=$_POST['Ci'];
$Estado=$_POST['Estado'];

if($Estado==1){
	$ConsultaAntecedentes="CodChofer IN(SELECT CodChofer FROM antecedentechofer WHERE Confirmado=0 and Activo=1 GROUP BY CodChofer) and";
}else{
	$ConsultaAntecedentes="";
}

include_once("../../class/chofer.php");
$chofer=new chofer;
$su=$chofer->mostrarTodoRegistro("$ConsultaAntecedentes CodCategoria LIKE '$CodCategoria' and CodServicioTransporte LIKE '$CodServicioTransporte'  and CodRuta LIKE '$CodRuta' and Nombres LIKE '%$Nombres%' and Paterno LIKE '%$Paterno%' and Materno LIKE '%$Materno%' and Ci LIKE '%$Ci%'",1,"Paterno,Materno,Nombres,Ci",1);
//print_r($di);


include_once("../../class/categoria.php");
$categoria=new categoria;
include_once("../../class/serviciotransporte.php");
$serviciotransporte=new serviciotransporte;
include_once("../../class/ruta.php");
$ruta=new ruta;
?>
<table class="table table-hover table-bordered table-striped table-table-condensed">
	<thead>
    	<tr>
        	<th width="10">N</th>
        	<th width="100">Datos</th>


        	<th width="100">Detalles</th>
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
		$c=$categoria->mostrarTodoRegistro("CodCategoria=".$d['CodCategoria']);
		$c=array_shift($c);

		$st=$serviciotransporte->mostrarTodoRegistro("CodServicioTransporte=".$d['CodServicioTransporte']);
		$st=array_shift($st);

		$r=$ruta->mostrarTodoRegistro("CodRuta=".$d['CodRuta']);
		$r=array_shift($r);
        ?>
        	<tr>
            	<td width="10"><?php echo $i;?></td>
            	<td class="small">
					<table class="table table-bordered">

						<tr>
							<td class=" resaltar" width="40%">Nombres: </td>
							<td class="" colspan="1"><?php echo ($d['Nombres'])?></td>
						</tr>
						<tr>
							<td class=" resaltar">Paterno: </td>
							<td class="" colspan="1"><?php echo ($d['Paterno'])?></td>
						</tr>
						<tr>
							<td class=" resaltar">Materno: </td>
							<td class="" colspan="1"><?php echo ($d['Materno'])?></td>
						</tr>
						<tr>
							<td class=" resaltar">Carnet: </td>
							<td class="" colspan="1"><?php echo ($d['Ci'])?></td>
						</tr>
						<tr>
							<td class=" resaltar">Fecha de Nacimiento: </td>
							<td class="" colspan="1"><?php echo ($d['FechaNac'])?></td>
						</tr>




					</table>


				</td>

				<td class="small">
					<table class="table table-bordered">
						<tr>
							<td class=" resaltar" width="40%">Categoria de la Licencia: </td>
							<td class=""><?php echo ($c['Nombre'])?></td>
						</tr>
						<tr>
							<td class=" resaltar">Servicio de Trnsporte: </td>
							<td class=""><?php echo ($st['Nombre'])?></td>
						</tr>
						<tr>
							<td class=" resaltar">Ruta: </td>
							<td class=""><?php echo ($r['Nombre'])?></td>
						</tr>
						<tr>
							<td class="der resaltar">Dirección: </td>
							<td><?php echo $d['Direccion']?></td>
						</tr>
						<tr>
							<td class="der resaltar">Foto: </td>
							<td>
								<?php
								$url="../../imagenes/chofer/".$d['Foto'];
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




				<?php
					if(in_array( $_SESSION['NivelAcceso'],array(1,2,3))){
				?>
                <td class="text-center">
                	<a href="index.php?CodChofer=<?php echo $d['CodChofer']?>" class="btn btn-danger btn-xs " title="Eliminar" rel="<?php echo $d['CodChofer']?>">
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
