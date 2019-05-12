<?php
include_once("../../login/check.php");


$CodVehiculo=$_GET['CodVehiculo'];






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


$titulo="Registro de Antecedentes de Vehiculos";
$folder="../../";



?>
<?php include_once($folder."cabecerahtml.php");?>
<script>
$(document).ready(function(){
	$(document).ajaxStart(function() {
		$("#respuesta").html('Cargando...');
	});

	listarAntecedentes();
	listarAntecedentesPendientes();
	$(document).on("click","#guardar",function(e){
		e.preventDefault();
		swal("¿Esta Seguro de Guardar Antecedente?",{
  			buttons: {
				cancel: true,
				confirm: {
					text:"Aceptar",
					value:'ok'
				}
  			}
		}).then((value)=>{
			switch (value) {
				case "ok":{

					var CodVehiculo=<?=$CodVehiculo;?>;
					var FechaAntecedente=$("[name=FechaAntecedente]").val();
					var DetalleAntecedente=$("[name=DetalleAntecedente]").val();
					var CodAntecedenteVehiculo=$("[name=CodAntecedenteVehiculo]").val();


					$.post("guardar.php",{"CodVehiculo":CodVehiculo,FechaAntecedente:FechaAntecedente,DetalleAntecedente:DetalleAntecedente,CodAntecedenteVehiculo:CodAntecedenteVehiculo},function(data){
						listarAntecedentes();
						listarAntecedentesPendientes();
					});
				}break;
			}
		});
	});
	$(document).on("click","#verificar",function(e){
		e.preventDefault();
		var obj=$(this).parent().parent();
		var CodAntecedenteVehiculo=$(this).attr("rel");
		var FechaV=''+obj.find("td:eq(1)").html()+'';
		var DetalleV=obj.find("td:eq(2)").html();
		var CelularV=obj.find("td:eq(3)").html();
		var NombreV=obj.find("td:eq(4)").html();

		$("[name=FechaAntecedente]").val(''+FechaV);
		$("[name=DetalleAntecedente]").val(DetalleV+" "+CelularV+" "+NombreV);
		$("[name=CodAntecedenteVehiculo]").val(CodAntecedenteVehiculo);
		// alert(FechaV);
	});

});
function listarAntecedentes(){
	var CodVehiculo=<?=$CodVehiculo;?>;
	$.post("listarantecedentes.php",{"CodVehiculo":CodVehiculo},function(data){
		$("#listadoantecedentesconfirmados").html(data);
	});

}
function listarAntecedentesPendientes(){
	var CodVehiculo=<?=$CodVehiculo;?>;
	$.post("antecedentespendientes.php",{"CodVehiculo":CodVehiculo},function(data){
		$("#listadoantecedentespendientes").html(data);
	});

}
</script>
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
									<a href="<?=$url;?>" class="btn btn-info btn-xs" target="_blank"> <i class="fa fa-image"></i></a>
									<?php
								}
								?>
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



					</table>

				</div>
			</div>


        </form>

	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<div class="panel">
			<div class="panel-body">
				<h3>Registro de Antecedentes</h3>
				<input type="hidden" name="CodAntecedenteVehiculo" value="">
				<table class="table">
					<tr>
						<td width="35%">Fecha Antecedente </td>
						<td><input type="date" name="FechaAntecedente" class="form-control" value="<?=date("Y-m-d");?>"></td>
					</tr>
					<tr>
						<td>Detalle del Antecedente</td>
						<td><textarea name="DetalleAntecedente" class="form-control" rows="5"></textarea></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="button" value="Guardar" class="btn btn-success" id="guardar"></td>
					</tr>
				</table>
				<h3>Antecedentes Pendientes de Confirmación</h3>
				<div id="listadoantecedentespendientes" class="small"></div>
			</div>
		</div>

	</div>
	<div class="col-lg-6">
		<div class="panel">
			<div class="panel-body table-responsive" >
				<h3>Antecedentes Confirmados</h3>
				<div id="listadoantecedentesconfirmados" class="small"></div>
			</div>
		</div>

	</div>

</div>

<?php include_once($folder."pie.php");?>
