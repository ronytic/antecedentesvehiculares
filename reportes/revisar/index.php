<?php
include_once("../../login/check.php");


include_once("../../class/marca.php");
$marca=new marca;
$cate=$marca->mostrarTodoRegistro("",1,"Nombre");
$mar=todoLista($cate,"CodMarca","Nombre");
$mar=array_unshift_assoc($mar,"%","Todos");
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




$titulo="Revisar Antecedentes";
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

		var Placa=$("[name=Placa]").val();
		var Ci=$("[name=Ci]").val();

		$.post("buscar.php",{Placa:Placa,Ci:Ci},function(data){
			$("#respuesta").html(data);
		});
	})
	.submit();
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
				                    <td>Placa <small>(ej: 342-NDO)</small><input type="text" name="Placa" class="form-control" value="" placeholder="342-NDO"></td>
				                    <td>Carnet de Chofer<input type="text" name="Ci" class="form-control"></td>


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
