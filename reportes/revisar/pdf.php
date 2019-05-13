<?php
include_once("../../login/check.php");

$CodVehiculo=$_GET['Cod'];

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
$av=$antecedentevehiculo->mostrarTodoRegistro("Confirmado=1 and CodVehiculo=".$CodVehiculo,1,"");

include_once("../../class/antecedentechofer.php");
$antecedentechofer=new antecedentechofer;
$ac=$antecedentechofer->mostrarTodoRegistro("Confirmado=1 and CodChofer=".$d['CodChofer'],1,"");



$titulo="Reporte de Antecedentes";
require_once("../../impresion/pdf.php");
$pdf=new PPDF("P","mm","letter");
$pdf->AddPage();
$pdf->ln(5);

$pdf->CuadroCuerpo(80,"Datos del Vehículo",1,"C",1,9,"B");
$pdf->ln();
$pdf->CuadroCuerpo(40,"Placa",0,"L",1,9,"B");
$pdf->CuadroCuerpo(40,$d['Placa'],0,"",1,9,"");

$pdf->ln();
$pdf->CuadroCuerpo(40,"Marca",0,"L",1,9,"B");
$pdf->CuadroCuerpo(40,$mar['Nombre'],0,"",1,9,"");

$pdf->ln();
$pdf->CuadroCuerpo(40,"NChasis",0,"L",1,9,"B");
$pdf->CuadroCuerpo(40,$d['NChasis'],0,"",1,9,"");

$pdf->ln();
$pdf->CuadroCuerpo(40,"NMotor",0,"L",1,9,"B");
$pdf->CuadroCuerpo(40,$d['NMotor'],0,"",1,9,"");

$pdf->ln();
$pdf->CuadroCuerpo(40,"Año",0,"L",1,9,"B");
$pdf->CuadroCuerpo(40,$d['Anio'],0,"",1,9,"");

$pdf->ln();
$pdf->CuadroCuerpo(40,"Tipo",0,"L",1,9,"B");
$pdf->CuadroCuerpo(40,$d['Tipo'],0,"",1,9,"");

$pdf->ln();
$pdf->CuadroCuerpo(40,"Servicio de Transporte",0,"L",1,9,"B");
$pdf->CuadroCuerpo(40,$st['Nombre'],0,"",1,9,"");

$pdf->ln();
$pdf->CuadroCuerpo(40,"Señas Particulares",0,"L",1,9,"B");
$pdf->CuadroCuerpoMulti(40,$d['SenasParticulares'],0,"",1,9,"");

$pdf->CuadroCuerpo(80,(count($av)>0?'CON ANTECEDENTES':'SIN ANTECEDENTES'),0,"C",1,9,"B");

$url="../../imagenes/vehiculo/".$d['Foto'];
if(file_exists($url) && $d['Foto']!=""){
    $pdf->Image($url,110,50,80,45);
}
$pdf->ln(15);

$pdf->CuadroCuerpo(80,"Datos del Taxista/Chofer",1,"C",1,9,"B");
$pdf->ln();
$pdf->CuadroCuerpo(40,"Nombres",0,"L",1,9,"B");
$pdf->CuadroCuerpo(40,$ch['Nombres'],0,"",1,9,"");
$pdf->ln();
$pdf->CuadroCuerpo(40,"Paterno",0,"L",1,9,"B");
$pdf->CuadroCuerpo(40,$ch['Paterno'],0,"",1,9,"");
$pdf->ln();
$pdf->CuadroCuerpo(40,"Materno",0,"L",1,9,"B");
$pdf->CuadroCuerpo(40,$ch['Materno'],0,"",1,9,"");
$pdf->ln();
$pdf->CuadroCuerpo(40,"Carnet",0,"L",1,9,"B");
$pdf->CuadroCuerpo(40,$ch['Ci'],0,"",1,9,"");
$pdf->ln();
$pdf->CuadroCuerpo(40,"Fecha de Nacimiento",0,"L",1,9,"B");
$pdf->CuadroCuerpo(40,$ch['FechaNac'],0,"",1,9,"");
$pdf->ln();
$pdf->CuadroCuerpo(40,"Ruta",0,"L",1,9,"B");
$pdf->CuadroCuerpo(40,$rut['Nombre'],0,"",1,9,"");
$pdf->ln();
$pdf->CuadroCuerpo(40,"Categoria Licencia",0,"L",1,9,"B");
$pdf->CuadroCuerpo(40,$cat['Nombre'],0,"",1,9,"");
$pdf->ln();
$pdf->CuadroCuerpo(80,(count($ac)>0?'CON ANTECEDENTES':'SIN ANTECEDENTES'),0,"C",1,9,"B");

$url="../../imagenes/chofer/".$ch['Foto'];
if(file_exists($url) && $d['Foto']!=""){
    $pdf->Image($url,110,110,45,45);
}
$pdf->Output();
?>