<?php
include_once("../../login/check.php");


include_once("../../class/categoria.php");
$categoria=new categoria;
$cate=$categoria->mostrarTodoRegistro("",1,"Nombre");
$cat=todoLista($cate,"CodCategoria","Nombre");
$cat=array_unshift_assoc($cat,"%","Todos");
// echo "<pre>";
// print_r($cat);
// echo "</pre>";
include_once("../../class/serviciotransporte.php");
$serviciotransporte=new serviciotransporte;
$st=$serviciotransporte->mostrarTodoRegistro("",1,"Nombre");
$st=todoLista($st,"CodServicioTransporte","Nombre,Caracteristica"," - ");
$st=array_unshift_assoc($st,"%","Todos");

include_once("../../class/ruta.php");
$ruta=new ruta;
$rut=$ruta->mostrarTodoRegistro("",1,"Nombre");
$rut=todoLista($rut,"CodRuta","Nombre,Detalle"," - ");
$rut=array_unshift_assoc($rut,"%","Todos");

$estado=array("%"=>"Todos","1"=>"Por Revisar");


$titulo="Registrar Antecedente de Taxista/Choferes";
$folder="../../";



?>
<?php include_once($folder."cabecerahtml.php");?>
<script>
$(document).ready(function(){
	$(document).ajaxStart(function() {
		$("#respuesta").html('Cargando...');
	});
	$("#formulario").submit(function(e) {
        e.preventDefault();
		// var valores=($("#formulario").serialize());
		var CodCategoria=$("[name=CodCategoria]").val();
		var CodServicioTransporte=$("[name=CodServicioTransporte]").val();
		var CodRuta=$("[name=CodRuta]").val();
		var Nombres=$("[name=Nombres]").val();
		var Paterno=$("[name=Paterno]").val();
		var Materno=$("[name=Materno]").val();
		var Ci=$("[name=Ci]").val();
		var Estado=$("[name=Estado]").val();
		$.post("buscar.php",{CodCategoria:CodCategoria,CodServicioTransporte:CodServicioTransporte,CodRuta:CodRuta,Nombres:Nombres,Paterno:Paterno,Materno:Materno,Ci:Ci,Estado:Estado},function(data){
			$("#respuesta").html(data);
		});
	})
	// .submit();
	$(document).on("click",".eliminarDatos",function(e){
		e.preventDefault();
		swal("¿Esta Seguro de Eliminar este Registro?",{
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
					var Cod=$(this).attr("rel");
					$.post("eliminar.php",{"Cod":Cod},function(data){
						$("#formulario").submit();
					});
				}break;
			}
		});
	});

});
</script>
<?php include_once($folder."cabecera.php");?>
<div class="panel">
	<div class="panel-body">
		<form action="buscar.php" method="post" id="formulario">

        	<div class="table-responsive">
				<table class="table">
					<tr>
						<td>Categoria<?=campo("CodCategoria","select",$cat,"form-control",1,"",1,array(),0,0);?></td>
						<td>Servicio de Transporte<?=campo("CodServicioTransporte","select",$st,"form-control",0,"",1,array(),0,0);?></td>
						<td>Ruta<?=campo("CodRuta","select",$rut,"form-control",0,"",1,array(),0,0);?></td>
						<td>Estado<?=campo("Estado","select",$estado,"form-control",0,"",1,array(),0,0);?></td>
					</tr>
					<tr>
						<td>Nombres<input type="text" name="Nombres" class="form-control"></td>
						<td>Paterno<input type="text" name="Paterno" class="form-control"></td>
						<td>Materno<input type="text" name="Materno" class="form-control"></td>
						<td>Carnet<input type="text" name="Ci" class="form-control"></td>

					</tr>
					<tr>
					<td><input type="submit" value="Buscar" class="btn btn-primary"></td>
					</tr>
				</table>
			</div>


        </form>

	</div>
</div>
<div class="panel">
	<div class="panel-body table-responsive" id="respuesta">
	</div>
</div>
<?php include_once($folder."pie.php");?>
