<?php 
$color['ppl'] = $options['er_color_ppl']?$options['er_color_ppl']:'#008080';
$color['sec'] = $options['er_color_sec']?$options['er_color_sec']:'#8CF7FC';
$color['bg'] = $options['er_color_bg']?$options['er_color_bg']:'#2a2a2a';
$color['title'] = $options['er_color_title']?$options['er_color_title']:'#ffffff';
$correo = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>Correo de LaGuachafa.com.ve</title>
      
      <style type="text/css">
         /* Client-specific Styles */
         #outlook a {padding:0;} /* Force Outlook to provide a "view in browser" menu link. */
         body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
         /* Prevent Webkit and Windows Mobile platforms from changing default font sizes, while not breaking desktop design. */
         .ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */
         .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing.  */
         #backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
         img {outline:none; text-decoration:none;border:none; -ms-interpolation-mode: bicubic;}
         a img {border:none;}
         .image_fix {display:block;}
         p {margin: 0px 0px !important;}
         table td {border-collapse: collapse;}
         table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }
         a {color: #33b9ff;text-decoration: none;text-decoration:none!important;}
         /*STYLES*/
         table[class=full] { width: 100%; clear: both; }
         /*IPAD STYLES*/
         @media only screen and (max-width: 640px) {
         a[href^="tel"], a[href^="sms"] {
         text-decoration: none;
         color: #33b9ff; /* or whatever your want */
         pointer-events: none;
         cursor: default;
         }
         .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
         text-decoration: default;
         color: #33b9ff !important;
         pointer-events: auto;
         cursor: default;
         }
         table[class=devicewidth] {width: 440px!important;text-align:center!important;}
         table[class=devicewidthinner] {width: 420px!important;text-align:center!important;}
         img[class=banner] {width: 440px!important;height:220px!important;}
         img[class=colimg2] {width: 440px!important;height:220px!important;}
         
         
         }
         /*IPHONE STYLES*/
         @media only screen and (max-width: 480px) {
         a[href^="tel"], a[href^="sms"] {
         text-decoration: none;
         color: #ffffff; /* or whatever your want */
         pointer-events: none;
         cursor: default;
         }
         .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
         text-decoration: default;
         color: #ffffff !important; 
         pointer-events: auto;
         cursor: default;
         }
         table[class=devicewidth] {width: 280px!important;text-align:center!important;}
         table[class=devicewidthinner] {width: 260px!important;text-align:center!important;}
         img[class=banner] {width: 280px!important;height:140px!important;}
         img[class=colimg2] {width: 280px!important;height:140px!important;}
         td[class="padding-top15"]{padding-top:15px!important;}
         
        
         }
      </style>
   </head>
   <body>    
<!-- Start of seperator -->
<table width="100%" bgcolor="'.$color['bg'].'" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="seperator">
   <tbody>
      <tr>
         <td>
            <table width="600" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
               <tbody>
                  <tr>
                     <td align="center" height="30" style="font-size:1px; line-height:1px;">&nbsp;</td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
<!-- End of seperator -->  
<!-- Start of header -->
<table width="100%" bgcolor="'.$color['bg'].'" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="header">
   <tbody>
      <tr>
         <td>
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
               <tbody>
                  <tr>
                     <td width="100%">
                        <table bgcolor="#FFFFFF" width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                           <tbody>
                              <!-- Spacing -->
                              <tr>
                                 <td height="5" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td>
                                    <!-- logo -->
                                    <table width="140" align="left" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                       <tbody>
                                          <tr>
                                             <td width="140" height="60" align="center">
                                                <div class="imgpop">
                                                   <a target="_blank" href="'.$urlWeb.'">
                                                   <img src="'.$options['er_logo'].'" alt="" border="0" height="60" style="display:block; border:none; outline:none; text-decoration:none;">
                                                   </a>
                                                </div>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                    <!-- end of logo -->
                                    <!-- start of menu -->
                                    <table width="250" border="0" align="right" valign="middle" cellpadding="0" cellspacing="0" border="0" class="devicewidth">
                                       <tbody>
                                          <tr>
                                             <td align="center" style="font-family: Helvetica, arial, sans-serif; font-size: 20px;color: '.$color['ppl'].'" st-content="phone"  height="60">
                                                Tel: '.$options['er_tel'].'
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                    <!-- end of menu -->
                                 </td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td height="5" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                              </tr>
                              <!-- Spacing -->
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
<!-- End of Header -->';
if($options['er_banner']){
$correo .= '
<!-- Start of main-banner -->
<table width="100%" bgcolor="'.$color['bg'].'" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="banner">
   <tbody>
      <tr>
         <td>
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
               <tbody>
                  <tr>
                     <td width="100%">
                        <table width="600" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
                           <tbody>
                              <tr>
                                 <!-- start of image -->
                                 <td align="center" st-image="banner-image">
                                    <div class="imgpop">
                                       <a target="_blank" href="'.$urlWeb.'">
                                           <img width="600" border="0" height="300" alt="" border="0" style="display:block; border:none; outline:none; text-decoration:none;" src="'.$options['er_banner'].'" class="banner" />
                                       </a>
                                    </div>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                        <!-- end of image -->
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
<!-- End of main-banner -->  ';
}
$correo .= '
<!-- Start of seperator -->
<table width="100%" bgcolor="'.$color['bg'].'" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="seperator">
   <tbody>
      <tr>
         <td>
            <table width="600" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
               <tbody>
                  <tr>
                     <td align="center" height="30" style="font-size:1px; line-height:1px;">&nbsp;</td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
<!-- End of seperator -->
<!-- Start of heading -->
<table width="100%" bgcolor="'.$color['bg'].'" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="seperator">
   <tbody>
      <tr>
         <td>
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
               <tbody>
                  <tr>
                     <td width="100%">
                        <table bgcolor="'.$color['ppl'].'" width="600" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
                           <tbody>
                              <tr>
                                 <td align="center" style="font-family: Helvetica, arial, sans-serif; font-size: 24px; color: '.$color['title'].'; padding: 15px 0;" st-content="heading" bgcolor="'.$color['ppl'].'" align="center">
                                    ¡Gracias!
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
<!-- End of heading --> 
<!-- article -->
<table width="100%" bgcolor="'.$color['bg'].'" cellpadding="0" cellspacing="0" border="0" id="backgroundTable">
   <tbody>
      <tr>
         <td>
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
               <tbody>
                  <tr>
                     <td width="100%">
                        <table bgcolor="#ffffff" width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                           <tbody>
                              <!-- Spacing -->
                              <tr>
                                 <td height="20"></td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td>
                                     <table width="560" align="center" border="0" cellpadding="0" cellspacing="0" class="devicewidthinner">
                                         <tbody>
                                             <tr>
                                                 <td>Hola '.$cotiza->nombre.' '.$cotiza->apellido.', <br/>&nbsp;</td>
                                             </tr>
                                             <!-- Spacing -->
                                             <tr>
                                                 <td width="100%" height="10"></td>
                                             </tr>
                                             <!-- Spacing -->
                                             <!-- content -->
                                             <tr>
                                                 <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #4f5458; text-align:left; line-height: 20px;">
                                                    <p>Este correo es para confirmar su presupuesto #'.$cotiza->ID.' con <a href="'.$urlWeb.'" style="text-decoration: none; color: '.$color['ppl'].'">'.$options['er_name'].'</a>. para que pueda revisarlo y decidir si se ajusta a sus necesidades.<br/>&nbsp;</p>
                                                    <p>Si tienes alguna duda o pregunta sobre su presupuesto escríbenos a <a href="mailto:'.$options['er_mail'].'" style="text-decoration: none; color: '.$color['ppl'].'">'.$options['er_mail'].'</a><br/>&nbsp;</p>
                                                 </td>
                                             </tr>
                                         </tbody>
                                     </table>
                                 </td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td height="20"></td>
                              </tr>
                              <!-- Spacing -->
                              <!-- bottom-border -->
                              <tr>
                                 <td width="100%" bgcolor="'.$color['ppl'].'" height="3" style="font-size: 1px; line-height: 1px;">&nbsp;</td>
                              </tr>
                              <!-- /bottom-border -->
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
<!-- end of article -->
<!-- Start of seperator -->
<table width="100%" bgcolor="'.$color['bg'].'" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="seperator">
   <tbody>
      <tr>
         <td>
            <table width="600" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
               <tbody>
                  <tr>
                     <td align="center" height="30" style="font-size:1px; line-height:1px;">&nbsp;</td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
<!-- End of seperator --> 
<!-- Start of cabecera de presupuesto -->
<table width="100%" bgcolor="'.$color['bg'].'" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="seperator">
   <tbody>
      <tr>
         <td>
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
               <tbody>
                  <tr>
                     <td width="100%">
                        <table bgcolor="'.$color['ppl'].'" width="600" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
                           <tbody>
                              <tr>
                                 <td align="center" style="font-family: Helvetica, arial, sans-serif; font-size: 24px; color: '.$color['title'].'; padding: 15px 0;" st-content="heading" bgcolor="'.$color['ppl'].'" align="center">
                                    Su presupuesto #'.$cotiza->ID.'
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
<!-- End of cabecera de presupuesto --> 
<!-- Presupuesto -->
<table width="100%" bgcolor="'.$color['bg'].'" cellpadding="0" cellspacing="0" border="0" id="backgroundTable">
   <tbody>
      <tr>
         <td>
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
               <tbody>
                  <tr>
                     <td width="100%">
                        <table bgcolor="#ffffff" width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                           <tbody>
                              <!-- Spacing -->
                              <tr>
                                 <td height="20"></td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td>
                                     <table width="560" align="center" border="1" bordercolor="'.$color['sec'].'" cellpadding="0" cellspacing="0" class="devicewidthinner">
                                         
                                         <tbody>
                                             <!-- title -->
                                             <tr bgcolor="#F0F0F0" style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: '.$color['ppl'].'; text-align:center;">
                                                 <td style="padding: 10px;" width="200px">
                                                     Producto
                                                 </td>
                                                 <td style="padding: 10px;" width="110px">
                                                     Precio
                                                 </td>
                                                 <td style="padding: 10px;" width="60px">
                                                     Cant
                                                 </td>
                                                 <td style="padding: 10px;" width="70px">
                                                     IVA
                                                 </td>
                                                 <td style="padding: 10px;" width="120px">
                                                     SubTtl
                                                 </td>
                                             </tr>
                                             <!-- end of title -->
                                             <!-- content -->';
                                             $baseImponible = 0;
                                             $ivaTtl = 0;
                                             $totalGrl = 0;
                                             $descuento = 0;
                                             foreach($cotizaProd as $c=>$v){
                                                $precio = $v->precio*$v->cantidad;
                                                $iva = 0;
                                                if($v->iva == 1){
                                                   $iva = $precio*($ivaVal/100);
                                                   $baseImponible += $precio;
                                                   $ivaTtl += $iva;
                                                }
                                                $total = $precio+$iva;
                                                $totalGrl += $precio;
                                             $correo .= '<tr style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #4f5458; text-align:left; line-height: 20px;">
                                                 <td style="padding: 5px;">
                                                    '.$v->titulo.'
                                                 </td>
                                                 <td style="padding: 5px; text-align: right;">
                                                    '.number_format($precio, 2, ',', '.').'
                                                 </td>
                                                 <td style="padding: 5px; text-align: center;">
                                                     '.$v->cantidad.'
                                                 </td>
                                                 <td style="padding: 5px; text-align: right;">
                                                     '.number_format($iva, 2, ',', '.').'
                                                 </td>
                                                 <td style="padding: 5px; text-align: right;">
                                                     '.number_format($total, 2, ',', '.').'
                                                 </td>
                                             </tr>';
                                             }
                                             $correo .= '<tr bgcolor="#F0F0F0" style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #4f5458; text-align:left; line-height: 20px;">
                                                 <td colspan="4" style="padding: 5px; text-align: right;">
                                                     Base Imponible
                                                 </td>
                                                 <td style="padding: 5px; text-align: right;">
                                                     $ '.number_format($baseImponible, 2, ',', '.').'
                                                 </td>
                                             </tr>';
                                             $correo .= '<tr bgcolor="#F0F0F0" style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #4f5458; text-align:left; line-height: 20px;">
                                                 <td colspan="4" style="padding: 5px; text-align: right;">
                                                     Subtotal
                                                 </td>
                                                 <td style="padding: 5px; text-align: right;">
                                                     $ '.number_format($totalGrl, 2, ',', '.').'
                                                 </td>
                                             </tr>';
                                             $correo .= '<tr bgcolor="#F0F0F0" style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #4f5458; text-align:left; line-height: 20px;">
                                                 <td colspan="4" style="padding: 5px; text-align: right;">
                                                     Iva
                                                 </td>
                                                 <td style="padding: 5px; text-align: right;">
                                                     $ '.number_format($ivaTtl, 2, ',', '.').'
                                                 </td>
                                             </tr>';
                                             if($cotiza->pordesc > 0){
                                                $descuento = $totalGrl*($cotiza->pordesc/100);

                                             $correo .= '<tr bgcolor="#F0F0F0" style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #4f5458; text-align:left; line-height: 20px;">
                                                 <td colspan="4" style="padding: 5px; text-align: right;">
                                                     Descuento
                                                 </td>
                                                 <td style="padding: 5px; text-align: right;">
                                                     $ '.number_format($descuento, 2, ',', '.').'
                                                 </td>
                                             </tr>';
                                            }
                                             $precioTtl = $totalGrl + $ivaTtl - $descuento;
                                             $correo .= '<tr bgcolor="#F0F0F0" style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: '.$color['ppl'].'; text-align:left; line-height: 20px;">
                                                 <td colspan="4" style="padding: 5px; text-align: right;">
                                                     Total
                                                 </td>
                                                 <td style="padding: 5px; text-align: right;">
                                                     $ '.number_format($precioTtl, 2, ',', '.').'
                                                 </td>
                                             </tr>
                                             <!-- end of content -->
                                         </tbody>
                                         
                                     </table>
                                 </td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td height="20"></td>
                              </tr>
                              <!-- Spacing -->
                              <!-- bottom-border -->
                              <tr>
                                 <td width="100%" bgcolor="'.$color['ppl'].'" height="3" style="font-size: 1px; line-height: 1px;">&nbsp;</td>
                              </tr>
                              <!-- /bottom-border -->
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
<!-- end of Presupuesto -->
<!-- Start of seperator -->
<table width="100%" bgcolor="'.$color['bg'].'" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="seperator">
   <tbody>
      <tr>
         <td>
            <table width="600" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
               <tbody>
                  <tr>
                     <td align="center" height="30" style="font-size:1px; line-height:1px;">&nbsp;</td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
<!-- End of seperator --> 
<!-- footer -->
<table width="100%" bgcolor="'.$color['ppl'].'" cellpadding="0" cellspacing="0" border="0" id="backgroundTable">
   <tbody>
      <tr>
         <td>
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
               <tbody>
                  <tr>
                     <td width="100%">
                        <table bgcolor="'.$color['ppl'].'" width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                           <tbody>
                              <tr>
                                 <td>
                                    <table width="290" align="left" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                       <tbody>
                                          <!-- Spacing -->
                                          <tr>
                                             <td width="100%" height="20"></td>
                                          </tr>
                                          <!-- Spacing -->
                                          <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #ffffff; text-align:left;">
                                                
                                             </td>
                                          </tr>
                                          <!-- Spacing -->
                                          <tr>
                                             <td width="100%" height="10"></td>
                                          </tr>
                                          <!-- Spacing -->
                                          <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #ffffff; text-align:left;">
                                                
                                             </td>
                                          </tr>
                                          <!-- Spacing -->
                                          <tr>
                                             <td width="100%" height="10"></td>
                                          </tr>
                                          <!-- Spacing -->
                                       </tbody>
                                    </table>
                                    <!-- end of left column -->
                                    <!-- start of right column -->
                                    <table width="200" align="right" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                       <tbody>
                                          <!-- Spacing -->
                                          <tr>
                                             <td width="100%" height="20"></td>
                                          </tr>
                                          <!-- Spacing -->
                                          <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: '.$color['title'].'; text-align:left;">
                                                Contactos
                                             </td>
                                          </tr>
                                          <!-- Spacing -->
                                          <tr>
                                             <td width="100%" height="10"></td>
                                          </tr>
                                          <!-- Spacing -->
                                          <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: '.$color['title'].'; text-align:left;">
                                             '.$options['er_tel'].'<br />
                                             <a href="mailto:'.$options['er_mail'].'" style="text-decoration: none; color: '.$color['sec'].'">'.$options['er_mail'].'</a>
                                             </td>
                                          </tr>
                                          <!-- Spacing -->
                                          <tr>
                                             <td width="100%" height="20"></td>
                                          </tr>
                                          <!-- Spacing -->
                                       </tbody>
                                    </table>
                                    <!-- end of right column -->
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
<!-- end of footer -->
<!-- Start of Postfooter -->
<table width="100%" bgcolor="'.$color['bg'].'" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="postfooter" >
   <tbody>
      <tr>
         <td>
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
               <tbody>
                  <tr>
                     <td width="100%">
                        <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                           <tbody>
                              <!-- Spacing -->
                              <tr>
                                 <td width="100%" height="20"></td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <!--td align="center" valign="middle" style="font-family: Helvetica, arial, sans-serif; font-size: 13px;color: #ffffff" st-content="preheader">
                                    Dont want to receive email Updates? <a href="#" style="text-decoration: none; color: '.$color['ppl'].'">Unsubscribe here </a> 
                                 </td-->
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td width="100%" height="20"></td>
                              </tr>
                              <!-- Spacing -->
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
<!-- End of postfooter -->   
   </body>
   </html>

   ';
