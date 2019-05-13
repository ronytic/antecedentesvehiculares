<?php
include_once("bd.php");
define("CLASEMENU",1);
class menu extends bd{
	var $tabla="menu";
	function mostrar($Nivel,$Posicion=""){
		$this->campos=array('CodMenu','Nombre','Url','Icono');
		$Posicion=(!empty($Posicion))?" and Posicion='$Posicion'":"";
		switch($Nivel){
			case "1":{return $this->getRecords(" SuperAdmin=1 and Activo=1 $Posicion","Orden");}break;
			case "2":{return $this->getRecords(" Comandante=1 and Activo=1 $Posicion","Orden");}break;
			case "3":{return $this->getRecords(" Suboficial=1 and Activo=1 $Posicion","Orden");}break;
			case "4":{return $this->getRecords(" Encargadosindicato=1 and Activo=1 $Posicion","Orden");}break;
			case "5":{return $this->getRecords(" qw=1 and Activo=1 $Posicion","Orden");}break;
		}
	}
	function inicio($Nivel,$Posicion=""){
		$this->campos=array('CodMenu','Nombre','Url','Icono');
		$Posicion=(!empty($Posicion))?" and Posicion='$Posicion'":"";
		switch($Nivel){
			case "1":{return $this->getRecords("Inicio!=0 and SuperAdmin=1 and Activo=1 $Posicion","Inicio");}break;
			case "2":{return $this->getRecords("Inicio!=0 and Comandante=1 and Activo=1 $Posicion","Inicio");}break;
			case "3":{return $this->getRecords("Inicio!=0 and Suboficial=1 and Activo=1 $Posicion","Inicio");}break;
			case "4":{return $this->getRecords("Inicio!=0 and Encargadosindicato=1 and Activo=1 $Posicion","Inicio");}break;
		}
	}
	function verificar($Directorio,$Nivel){
		switch($Nivel){
			case "1":{return $this->getRecords("Url='$Directorio' and SuperAdmin=1 and Activo=1","Orden");}break;
			case "2":{return $this->getRecords("Url='$Directorio' and  Comandante=1 and Activo=1","Orden");}break;
			case "3":{return $this->getRecords("Url='$Directorio' and  Suboficial=1 and Activo=1","Orden");}break;
			case "4":{return $this->getRecords("Url='$Directorio' and  Encargadosindicato=1 and Activo=1","Orden");}break;
		}
	}
	function obtenerOpcion($Nombre){
		$r=$this->getRecords(" Nombre LIKE '%$Nombre%' and Activo=1 ","");
		$r=array_shift($r);
		return $r;
	}
	function mostrarMenuUrl($Url=""){
		$this->campos=array('CodMenu','Nombre','Url','SubMenu','Imagen');
		$Posicion=(!empty($Posicion))?" and Posicion='$Posicion'":"";
		return $this->getRecords(" Url='$Url' and Activo=1 $Posicion","Orden");

	}
}
?>