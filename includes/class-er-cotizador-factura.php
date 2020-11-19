<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://erdesarrollo.com.ve
 * @since      1.0.0
 *
 * @package    Er_Cotizador
 * @subpackage Er_Cotizador/includes
 */

    include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/fpdf.php');

    class Factura extends FPDF {
        private $cabecera;
        private $tipoFactura = 0;
        
        function RoundedRect($x, $y, $w, $h, $r, $style = '')
        {
            $k = $this->k;
            $hp = $this->h;
            if($style=='F')
                $op='f';
            elseif($style=='FD' || $style=='DF')
                $op='B';
            else
                $op='S';
            $MyArc = 4/3 * (sqrt(2) - 1);
            $this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));
            $xc = $x+$w-$r ;
            $yc = $y+$r;
            $this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));
    
            $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
            $xc = $x+$w-$r ;
            $yc = $y+$h-$r;
            $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
            $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
            $xc = $x+$r ;
            $yc = $y+$h-$r;
            $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
            $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
            $xc = $x+$r ;
            $yc = $y+$r;
            $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
            $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
            $this->_out($op);
        }
        
        public function setCabecera($cabecera){
            $this->cabecera = $cabecera;
        }
        
        public function setTipoFactura($tipoFactura){
            $this->tipoFactura = $tipoFactura;
        }
    
        function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
        {
            $h = $this->h;
            $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
                $x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
        }
        
        function Header()
        {
            if($this->cabecera){
                if($this->tipoFactura == 0){
                    // Logo
                    //$this->Image($this->getDir().'images/logo.jpg',10,8,33);
                    // Marca de Agua
                    $this->SetAlpha(0.2);
                    //$this->Image($this->getDir().'images/logo_grande.png',40,140,110);
                    $this->SetAlpha(1);
                    // Arial bold 15
                    $this->SetFont('times','B',12);
                    $this->Ln(12);
                    $this->SetX(10);
                    // Titulo
                    $this->Cell(140,6,'MILAGROS LORANGEL DE LOS SANTOS PALACIOS',0,1,'L');
                    $this->SetFont('times','',8);
                    $this->Cell(140,3,'AV. PPAL BOLEITA NORTE',0,1,'L');
                    $this->Cell(140,3,'CASA NRO 11-68 BARRIO LA LUCHA',0,1,'L');
                    $this->SetFont('times','B',8);
                    $this->Cell(140,4,'04263150843',0,1,'L');
                }else if($this->tipoFactura == 1){
                    // Logo
                    //$this->Image($this->getDir().'images/logo_erdesarrollo_verde_grande.png',10,8,33);
                    // Marca de Agua
                    $this->SetAlpha(0.2);
                    //$this->Image($this->getDir().'images/logo_erdesarrollo_verde_grande.png',40,140,110);
                    $this->SetAlpha(1);
                    // Arial bold 15
                    $this->SetFont('times','B',12);
                    $this->Ln(12);
                    $this->SetX(10);
                    // Titulo
                    $this->Cell(140,6,'Erick Desarrollador Web, C.A.',0,1,'L');
                    $this->SetFont('times','',8);
                    $this->Cell(140,3,'EL LLANITO, MIRADOR DEL ESTE',0,1,'L');
                    $this->Cell(140,3,'CALLE SUCRE, CASA NRO 34',0,1,'L');
                    $this->SetFont('times','B',8);
                    $this->Cell(140,4,'0414-3168556',0,1,'L');
                }
                // Salto de linea
                $this->Ln(20);
            }
        }
            
        function nota(){
            $this->SetFont('ARIAL','',9);
            $this->SetXY(140, 30);
            $this->Cell(60,7,'PRESUPUESTO',0,1,'L');
            $this->SetX(140);
            if($this->tipoFactura == 0){
                $this->Cell(60,7,'RIF  V-16433517-4',0,1,'L');
            }else if($this->tipoFactura == 1){
                $this->Cell(60,7,'RIF  V-16134236-6',0,1,'L');
            }
            $this->SetFont('Arial','',8);
        }
            
        function presupuesto(){
            $this->SetFont('ARIAL','',9);
            $this->SetXY(140, 30);
            $this->Cell(60,7,'PRESUPUESTO',0,1,'L');
            $this->SetX(140);
            if($this->tipoFactura == 0){
                $this->Cell(60,7,'RIF  V-16433517-4',0,1,'L');
            }else if($this->tipoFactura == 1){
                $this->Cell(60,7,'RIF  V-16134236-6',0,1,'L');
            }
            
            $this->SetFont('Arial','',8);
        }
            
        function fiscal($numero){
            $this->RoundedRect(128, 15, 75, 20, 3, '');
            $this->SetXY(140, 17);
            $this->SetFont('Arial','',8);
            $this->Cell(35,5,' ');
            if($this->tipoFactura == 0){
                $this->Cell(60,5,'RIF  V-16433517-4',0,1,'L');
            }else if($this->tipoFactura == 1){
                $this->Cell(60,5,'RIF  V-16134236-6',0,1,'L');
            }
            $this->SetFont('ARIAL','',9);
            $this->SetXY(130, 22);
            $this->Cell(60,7,'FACTURA  '.str_pad($numero, 8, "0", STR_PAD_LEFT),0,1,'L');
            $this->SetXY(130, 27);
            $this->Cell(60,7,'No. DE CONTROL  00-'.str_pad($numero, 8, "0", STR_PAD_LEFT),0,1,'L');
            $this->SetX(140);
        }
        
        var $extgstates = array();
    
        // alpha: real value from 0 (transparent) to 1 (opaque)
        // bm:    blend mode, one of the following:
        //          Normal, Multiply, Screen, Overlay, Darken, Lighten, ColorDodge, ColorBurn,
        //          HardLight, SoftLight, Difference, Exclusion, Hue, Saturation, Color, Luminosity
        function SetAlpha($alpha, $bm='Normal')
        {
            // set alpha for stroking (CA) and non-stroking (ca) operations
            $gs = $this->AddExtGState(array('ca'=>$alpha, 'CA'=>$alpha, 'BM'=>'/'.$bm));
            $this->SetExtGState($gs);
        }
    
        function AddExtGState($parms)
        {
            $n = count($this->extgstates)+1;
            $this->extgstates[$n]['parms'] = $parms;
            return $n;
        }
    
        function SetExtGState($gs)
        {
            $this->_out(sprintf('/GS%d gs', $gs));
        }
    
        function _enddoc()
        {
            if(!empty($this->extgstates) && $this->PDFVersion<'1.4')
                $this->PDFVersion='1.4';
            parent::_enddoc();
        }
    
        function _putextgstates()
        {
            for ($i = 1; $i <= count($this->extgstates); $i++)
            {
                $this->_newobj();
                $this->extgstates[$i]['n'] = $this->n;
                $this->_out('<</Type /ExtGState');
                $parms = $this->extgstates[$i]['parms'];
                $this->_out(sprintf('/ca %.3F', $parms['ca']));
                $this->_out(sprintf('/CA %.3F', $parms['CA']));
                $this->_out('/BM '.$parms['BM']);
                $this->_out('>>');
                $this->_out('endobj');
            }
        }
    
        function _putresourcedict()
        {
            parent::_putresourcedict();
            $this->_out('/ExtGState <<');
            foreach($this->extgstates as $k=>$extgstate)
                $this->_out('/GS'.$k.' '.$extgstate['n'].' 0 R');
            $this->_out('>>');
        }
    
        function _putresources()
        {
            $this->_putextgstates();
            parent::_putresources();
        }
    }
 ?>