<?php
include_once("fpdf_protection.php");

	class PPDF extends FPDF_Protection{
		var $ancho=176;
		var $orientation="P";
		function Header(){
			global $idioma;
			$this->SetTitle(utf8_decode("Reporte"),true);
			$this->SetAuthor(utf8_decode("Sistema de Registro Antecedentes Vehiculares de la Policia Boliviana por Ronald Nina Layme. Cel: 73230568 - www.facebook.com/ronaldnina"),true);
			$this->SetSubject(utf8_decode("Sistema de Registro Antecedentes Vehiculares de la Policia Boliviana por Ronald Nina Layme. Cel: 73230568 - www.facebook.com/ronaldnina"),true);
			$this->SetCreator(utf8_decode("Sistema de Registro Antecedentes Vehiculares de la Policia Boliviana  Desarrollado por Ronald Nina Layme. Cel: 73230568 - www.facebook.com/ronaldnina"),true);
			$this->SetProtection(array('print'));
			if($this->CurOrientation=="P"){$this->ancho=$this->w-34;}else{$this->ancho=$this->w-40;}
			/*
			if($this->CurOrientation=="P"){
				$this->Line($this->w-16,46,$this->w-16,$this->h-15);
			}else{
				$this->Line($this->w-22,46,$this->w-22,$this->h-15);
			}*/

			$this->SetLeftMargin(18);
			$this->SetAutoPageBreak(true,15);
			global $title,$gestion,$titulo,$logo,$idioma;
			$fecha=capitalizar(strftime("%A, %d ")).$idioma['De'].capitalizar(strftime(" %B ")).$idioma['De'].strftime(" %Y");

			$logo="logo.png";
			$this->Image("../../imagenes/logo/".$logo,10,10,20,20);
			$this->Fuente("",10);
			$this->SetXY(34,12);
			$this->Cell(70,4,utf8_decode($title),0,0,"L");
			$this->Fuente("B",8);
			$this->SetXY(34,16);
			$this->Cell(70,4,utf8_decode($gestion),0,0,"L");
			$this->ln(10);
			$this->Fuente("B",18);
			$this->Cell($this->ancho,4,utf8_decode($titulo),0,5,"C");
			$this->ln(5);
			$this->CuadroCabecera(40,"Fecha del Reporte:",20,utf8_encode($fecha));
			$this->ln(5);
			if(in_array("Cabecera",get_class_methods($this))){
				$this->Cabecera();
			}
			$this->ln();

			$this->Cell($this->ancho,0,"",1,1);
			$this->Ln(0.1);
		}
		function Pagina(){
			global $idioma;
			$this->AliasNbPages();
			$this->CuadroCabecera(15,$idioma['Pagina'].":",20,$this->PageNo()." ".$idioma['De']." {nb}");
		}
		function Fuente($tipo="B",$tam=10){
			$this->SetFillColor(234,234,234);
			$this->SetFont("Arial",$tipo,$tam);
		}
		function CuadroCabecera($txt1Ancho,$txt1,$txt2Ancho,$txt2){
			$this->Fuente("B");
			$this->Cell($txt1Ancho,4,utf8_decode($txt1),0,0,"L");
			$this->Fuente("");
			$this->Cell($txt2Ancho,4,utf8_decode($txt2),0,0,"L");
		}
		function TituloCabecera($txtAncho,$txt,$tam=10,$borde=1,$align="C"){
			$this->Fuente("B",$tam);
			$this->Cell($txtAncho,4,utf8_decode($txt),$borde,0,$align);
		}
		function CuadroCuerpo($txtAncho,$txt,$relleno=0,$align="L",$borde=0,$tam=9,$tipo=""){
			$this->Fuente($tipo,$tam);
			$this->Cell($txtAncho,5,utf8_decode($txt),$borde,0,$align,$relleno);
		}
		function CuadroCuerpoMulti($txtAncho,$txt,$relleno=0,$align="L",$borde=0,$tam=9,$tipo=""){
			$this->Fuente($tipo,$tam);
			$this->MultiCell($txtAncho,5,utf8_decode($txt),$borde,$align,$relleno);
		}
		function CuadroCuerpoPersonalizado($txtAncho,$txt,$relleno=0,$align="L",$borde=0,$tipo="",$tam=10){
			$this->Fuente($tipo,$tam);
			$this->Cell($txtAncho,5,utf8_decode($txt),$borde,0,$align,$relleno);
		}
		function CuadroCuerpoResaltar($txtAncho,$txt,$relleno=0,$align="L",$borde=0,$resaltar=2){
			$this->Fuente("");
			switch($resaltar){
				//case 1:{$this->SetFillColor(179,179,179);}break;
				//case 2:{$this->SetFillColor(135,135,135);}break;
				case 2:{$this->SetFillColor(190,190,190);}break;
				case 1:{$this->SetFillColor(210,210,210);}break;
			}
			$this->Cell($txtAncho,5,utf8_decode($txt),$borde,0,$align,$relleno);
		}
		function CuadroNombre($txtAncho,$Paterno,$Materno,$Nombres,$Full=0,$relleno){
			if($Full){
				$this->CuadroCuerpo($txtAncho,ucwords($Paterno." ".$Materno." ".$Nombres),$relleno);
			}else{
				$Nombre=array_shift(explode(" ",$Nombres));
				$this->CuadroCuerpo($txtAncho,ucwords($Paterno." ".$Materno." ".$Nombre),$relleno);
			}
		}
		function CuadroNombreSeparado($txtAnchoP,$Paterno,$txtAnchoM,$Materno,$txtAnchoN,$Nombres,$Full,$relleno){
			if($Full){
				$this->CuadroCuerpo($txtAnchoP,ucwords($Paterno),$relleno);
				$this->CuadroCuerpo($txtAnchoM,ucwords($Materno),$relleno);
				$this->CuadroCuerpo($txtAnchoN,ucwords($Nombres),$relleno);
			}else{
				$Nombre=array_shift(explode(" ",$Nombres));
				$this->CuadroCuerpo($txtAnchoP,ucwords($Paterno),$relleno);
				$this->CuadroCuerpo($txtAnchoM,ucwords($Materno),$relleno);
				$this->CuadroCuerpo($txtAnchoN,ucwords($Nombre),$relleno);
			}
		}
		function Linea(){
			$this->Cell($this->ancho,0,"",1,1);
			$this->Ln();
		}
		function Mostrar($valores,$ancho1=50,$ancho2=70,$alto=6){
			foreach($valores as $k=>$v){
				$this->CuadroCuerpo($ancho1,$k,0,"",0,"","B");
				$this->CuadroCuerpo($ancho2,$v,0,"",0,"","");
				$this->ln($alto);
			}
		}
		function Footer()
		{	global $lema,$idioma;
			//$this->Cell($this->ancho,0,"",1,1);

			// Posición: a 1,5 cm del final
			$this->SetY(-15);
			// Arial italic 8

			// Número de página
			$this->Fuente("I",7.5);
			$this->Cell($this->ancho,0,"",1,1);
			$this->Cell(50,4,utf8_decode("Reporte Generado").": ".date('d-m-Y H:i:s'),0,0,"L");
			$this->Fuente("I",8);
			$this->Cell((round(($this->ancho-50)/2)-10),4,utf8_decode($lema),0,0,"C");
			$this->Fuente("I",7);


			if($this->CurOrientation=="P"){
				//$this->Cell((round(($this->ancho-50)/2)+10),3,utf8_decode($idioma['TituloSistema'].""),0,0,"R");
				//$this->ln();
				//$this->Cell((round(($this->ancho-50)/2)+40),3,"",0,0,"R");
				$this->Cell((round(($this->ancho-50)/2)+10),3,"",0,0,"R");
			}else{
				$this->Cell((round(($this->ancho-50)/2)+10),4,utf8_decode(" "),0,0,"R");
			}

			//$this->Cell(60,4,utf8_decode($idioma['ReporteGenerado']).": ".date('d-m-Y H:i:s'),0,0,"R");

			if(in_array("Pie",get_class_methods($this))){
				$this->Pie();
			}
		}
		///Tabla
		var $widths;
		var $aligns;

		function SetWidths($w)
		{
			//Set the array of column widths
			$this->widths=$w;
		}

		function SetAligns($a)
		{
			//Set the array of column alignments
			$this->aligns=$a;
		}
		function Borde($borde=true){
			$this->bordep=$borde;
		}
		function Row($data)
		{
			//Calculate the height of the row
			$nb=0;
			for($i=0;$i<count($data);$i++)
				$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
			$h=5*$nb;
			//Issue a page break first if needed
			$this->CheckPageBreak($h);
			//Draw the cells of the row
			for($i=0;$i<count($data);$i++)
			{
				$w=$this->widths[$i];
				$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
				//Save the current position
				$x=$this->GetX();
				$y=$this->GetY();
				if(true){
				//Draw the border
				$this->Rect($x,$y,$w,$h);
				}
				//Print the text
				$this->MultiCell($w,5,$data[$i],0,$a);
				//Put the position to the right of the cell
				$this->SetXY($x+$w,$y);
			}
			//Go to the next line
			$this->Ln($h);
		}

		function CheckPageBreak($h)
		{
			//If the height h would cause an overflow, add a new page immediately
			if($this->GetY()+$h>$this->PageBreakTrigger)
				$this->AddPage($this->CurOrientation);
		}

		function NbLines($w,$txt)
		{
			//Computes the number of lines a MultiCell of width w will take
			$cw=&$this->CurrentFont['cw'];
			if($w==0)
				$w=$this->w-$this->rMargin-$this->x;
			$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
			$s=str_replace("\r",'',$txt);
			$nb=strlen($s);
			if($nb>0 and $s[$nb-1]=="\n")
				$nb--;
			$sep=-1;
			$i=0;
			$j=0;
			$l=0;
			$nl=1;
			while($i<$nb)
			{
				$c=$s[$i];
				if($c=="\n")
				{
					$i++;
					$sep=-1;
					$j=$i;
					$l=0;
					$nl++;
					continue;
				}
				if($c==' ')
					$sep=$i;
				$l+=$cw[$c];
				if($l>$wmax)
				{
					if($sep==-1)
					{
						if($i==$j)
							$i++;
					}
					else
						$i=$sep+1;
					$sep=-1;
					$j=$i;
					$l=0;
					$nl++;
				}
				else
					$i++;
			}
			return $nl;
		}
		/// Fin Tabla
	}

?>