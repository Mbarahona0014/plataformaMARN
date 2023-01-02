<?php 

include_once "../conexion/conexion.php";

use PHPMailer\PHPMailer\PHPMailer;

require ('mail/phpmailer/src/Exception.php');
require ('mail/phpmailer/src/PHPMailer.php');
require ('mail/phpmailer/src/SMTP.php');


//echo $_POST['cambiocontra'];
//echo $_POST['accion'];
//echo $_POST['correo'];
//echo $_POST['motivo'];

//exit();
if(isset($_POST['correo']))
{

    

    $c=conectar();
    $correo = $_POST['correo'];
    //$subject="RECUPERACION DE CLAVE";

    if($_POST['accion']=="1"){
        $subject="CLAVE RESTAURADA";
    }else if($_POST['accion']=="2"){
        $subject="CLAVE ASIGNADA";
    }else if($_POST['accion']=="3"){
        $subject="CAMBIO DE CLAVE";
    }else if($_POST['accion']=="4" || $_POST['accion']=="5"){
        $subject="ESTADO REGISTRO";
    }
    
    $c->set_charset('utf8');

    $sentencia = $c->prepare("select correo from usuarioexterno where correo='$correo';");
    $sentencia->execute();
    $resultado = $sentencia->get_result();
    $fila = $resultado->fetch_assoc();
    $correo=$fila["correo"];



     $comb = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
     $pass = array(); 
     $combLen = strlen($comb) - 1; 
     for ($i = 0; $i < 6; $i++) {
         $n = rand(0, $combLen);
         $pass[] = $comb[$n];
     }
         //print(implode($pass)); 
         //echo implode($pass);
         // Posted Inputs
     //ACCION 4 Y 5 NO MODIFICAN CONTRASEÑA
     if($_POST['accion']!="4" && $_POST['accion']!="5"){

        //SI ESTADO CAMBIO CONTRA =1 MOSTRAR EL ALERT PARA CAMBIO DE CONTRA

        $sql="update usuarioexterno set contra=md5('".implode($pass)."'), estadocambiocontra=1 where correo='$correo'";
        $c->query($sql);
        /*if(!$c->query($sql)){
            echo "-1";
        }else{
            echo "1";
        }*/

     }

        



        


        //init data
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->Username = "noreplay@marn.gob.sv"; // Replace with your mail id
        $mail->Password = "Joh61529"; //Replace with your mail pass
        $mail->SMTPAuth = true;  // authentication enabled
        $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
        $mail->SMTPAutoTLS = false;
        $mail->Host = 'smtp.office365.com';
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   




        //Recipients
        $mail->setFrom('noreplay@marn.gob.sv', 'RESTAURACIONES Y REFORESTACIONES');
        $mail->addAddress('$correo', 'Saiarlen'); 

         //add to email  
        //$mail->addReplyTo('receive@gmail.com', 'saiarlen');  //add replay to email





        // Content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = $subject;
        $body='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" style="width:100%;font-family:"Century Gothic";-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">
        <head>
            <meta charset="UTF-8">
            <meta content="width=device-width, initial-scale=1" name="viewport">
            <meta name="x-apple-disable-message-reformatting">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta content="telephone=no" name="format-detection">
            <title>Nueva plantilla de correo electrónico 2021-11-11</title>
            <!--[if (mso 16)]>
            <style type="text/css">
            a {text-decoration: none;}
            </style>
            <![endif]-->
            <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
            <!--[if gte mso 9]>
            <xml>
            <o:OfficeDocumentSettings>
            <o:AllowPNG></o:AllowPNG>
            <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
            </xml>
            <![endif]-->
            <!--[if !mso]><!-- -->
            <!--<![endif]-->
            <style type="text/css">
                #outlook a {
                    padding: 0;
                }

                .ExternalClass {
                    width: 100%;
                }

                    .ExternalClass,
                    .ExternalClass p,
                    .ExternalClass span,
                    .ExternalClass font,
                    .ExternalClass td,
                    .ExternalClass div {
                        line-height: 100%;
                    }

                .es-button {
                    mso-style-priority: 100 !important;
                    text-decoration: none !important;
                }

                a[x-apple-data-detectors] {
                    color: inherit !important;
                    text-decoration: none !important;
                    font-size: inherit !important;
                    font-family: inherit !important;
                    font-weight: inherit !important;
                    line-height: inherit !important;
                }

                .es-desk-hidden {
                    display: none;
                    float: left;
                    overflow: hidden;
                    width: 0;
                    max-height: 0;
                    line-height: 0;
                    mso-hide: all;
                }

                [data-ogsb] .es-button {
                    border-width: 0 !important;
                    padding: 15px 30px 15px 30px !important;
                    -webkit-user-select: none;
                    -moz-user-select: none;
                    -ms-user-select: none;
                    user-select: none;
                }

                @media only screen and (max-width:600px) {
                    p, ul li, ol li, a {
                        line-height: 150% !important
                    }

                    h1, h2, h3, h1 a, h2 a, h3 a {
                        line-height: 120% !important
                    }

                    h1 {
                        font-size: 32px !important;
                        text-align: center
                    }

                    h2 {
                        font-size: 26px !important;
                        text-align: center
                    }

                    h3 {
                        font-size: 20px !important;
                        text-align: center
                    }

                    .es-header-body h1 a, .es-content-body h1 a, .es-footer-body h1 a {
                        font-size: 32px !important
                    }

                    .es-header-body h2 a, .es-content-body h2 a, .es-footer-body h2 a {
                        font-size: 26px !important
                    }

                    .es-header-body h3 a, .es-content-body h3 a, .es-footer-body h3 a {
                        font-size: 20px !important
                    }

                    .es-menu td a {
                        font-size: 16px !important
                    }

                    .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a {
                        font-size: 16px !important
                    }

                    .es-content-body p, .es-content-body ul li, .es-content-body ol li, .es-content-body a {
                        font-size: 16px !important
                    }

                    .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a {
                        font-size: 16px !important
                    }

                    .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a {
                        font-size: 12px !important
                    }

                    *[class="gmail-fix"] {
                        display: none !important
                    }

                    .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 {
                        text-align: center !important
                    }

                    .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 {
                        text-align: right !important
                    }

                    .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 {
                        text-align: left !important
                    }

                        .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img {
                            display: inline !important
                        }

                    .es-button-border {
                        display: inline-block !important
                    }

                    a.es-button, button.es-button {
                        font-size: 16px !important;
                        display: inline-block !important;
                        border-width: 15px 30px 15px 30px !important
                    }

                    .es-btn-fw {
                        border-width: 10px 0px !important;
                        text-align: center !important
                    }

                    .es-adaptive table, .es-btn-fw, .es-btn-fw-brdr, .es-left, .es-right {
                        width: 100% !important
                    }

                    .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header {
                        width: 100% !important;
                        max-width: 600px !important
                    }

                    .es-adapt-td {
                        display: block !important;
                        width: 100% !important
                    }

                    .adapt-img {
                        width: 100% !important;
                        height: auto !important
                    }

                    .es-m-p0 {
                        padding: 0px !important
                    }

                    .es-m-p0r {
                        padding-right: 0px !important
                    }

                    .es-m-p0l {
                        padding-left: 0px !important
                    }

                    .es-m-p0t {
                        padding-top: 0px !important
                    }

                    .es-m-p0b {
                        padding-bottom: 0 !important
                    }

                    .es-m-p20b {
                        padding-bottom: 20px !important
                    }

                    .es-mobile-hidden, .es-hidden {
                        display: none !important
                    }

                    tr.es-desk-hidden, td.es-desk-hidden, table.es-desk-hidden {
                        width: auto !important;
                        overflow: visible !important;
                        float: none !important;
                        max-height: inherit !important;
                        line-height: inherit !important
                    }

                    tr.es-desk-hidden {
                        display: table-row !important
                    }

                    table.es-desk-hidden {
                        display: table !important
                    }

                    td.es-desk-menu-hidden {
                        display: table-cell !important
                    }

                    .es-menu td {
                        width: 1% !important
                    }

                    table.es-table-not-adapt, .esd-block-html table {
                        width: auto !important
                    }

                    table.es-social {
                        display: inline-block !important
                    }

                        table.es-social td {
                            display: inline-block !important
                        }
                }
            </style>
        </head>
        <body style="width:100%;font-family:"Museo 300";-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0;background-color:#EEEEEE">
            <div class="es-wrapper-color">
                <!--[if gte mso 9]>
                <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
                <v:fill type="tile" color="#eeeeee"></v:fill>
                </v:background>
                <![endif]-->
                <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top">
                    <tr style="border-collapse:collapse">
                        <td valign="top" style="padding:0;Margin:0">
                            <table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                                <tr style="border-collapse:collapse">
                                    <td align="center" style="padding:0;Margin:0">
                                        <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px" cellspacing="0" cellpadding="0" align="center">
                                            <tr style="border-collapse:collapse">
                                                <td align="left" style="Margin:0;padding-left:10px;padding-right:10px;padding-top:15px;padding-bottom:15px">
                                                    <!--[if mso]><table style="width:580px" cellpadding="0" cellspacing="0"><tr><td style="width:282px" valign="top"><![endif]-->
                                                    <table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                        <tr style="border-collapse:collapse">
                                                            <td align="left" style="padding:0;Margin:0;width:282px">
                                                                <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tr style="border-collapse:collapse">

                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <!--[if mso]></td><td style="width:20px"></td><td style="width:278px" valign="top"><![endif]-->
                                                    <table class="es-right" cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                    </table>
                                                    <!--[if mso]></td></tr></table><![endif]-->
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                                <tr style="border-collapse:collapse"></tr>
                                <tr style="border-collapse:collapse">
                                    <td align="center" style="padding:0;Margin:0">
                                        <table class="es-header-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#d2d2d2;width:600px" cellspacing="0" cellpadding="0" bgcolor="#044767" align="center">
                                            <tr style="border-collapse:collapse">
                                                <td align="left" style="Margin:0;padding-top:35px;padding-bottom:35px;padding-left:35px;padding-right:35px">
                                                    <!--[if mso]><table style="width:530px" cellpadding="0" cellspacing="0"><tr><td style="width:340px" valign="top"><![endif]-->
                                                    <table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                        <tr style="border-collapse:collapse">
                                                            <td class="es-m-p0r es-m-p20b" valign="top" align="center" style="padding:0;Margin:0;width:340px">
                                                                <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tr style="border-collapse:collapse">
                                                                        <td class="es-m-txt-c" align="left" style="padding:0;Margin:0"><h1 style="Margin:0;line-height:36px;mso-line-height-rule:exactly;font-family:"Museo 500";font-size:25px;font-style:normal;font-weight:bold;color:#313945 !important; text-transform: uppercase;">SISTEMA DE RESTAURACIONES Y REFORESTACIONES</h1></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <!--[if mso]></td><td style="width:20px"></td><td style="width:170px" valign="top"><![endif]-->
                                                    <table cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                        <tr class="es-hidden" style="border-collapse:collapse">
                                                            <td class="es-m-p20b" align="left" style="padding:0;Margin:0;width:170px">
                                                                <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tr style="border-collapse:collapse">
                                                                        <td style="padding:0;Margin:0">
                                                                            <table cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                <tr style="border-collapse:collapse">
                                                                                    <td align="center" style="padding:0;Margin:0;display:none"></td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <!--[if mso]></td></tr></table><![endif]-->
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <table class="es-content" cellspacing="0" cellpadding="0" align="justify" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                                <tr style="border-collapse:collapse">
                                    <td align="center" style="padding:0;Margin:0">
                                        <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#d2d2d2;width:600px" cellspacing="0" cellpadding="0" bgcolor="#1b9ba3" align="center">
                                            <tr style="border-collapse:collapse">
                                                <td align="left" style="Margin:0;padding-top:35px;padding-bottom:35px;padding-left:35px;padding-right:35px">
                                                    <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                        <tr style="border-collapse:collapse">
                                                            <td valign="top" align="center" style="padding:0;Margin:0;width:530px">
                                                                <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="justify" style="padding:0;Margin:0;padding-top:30px"><h2 style="Margin:0;line-height:29px;mso-line-height-rule:exactly;font-family:"Museo 300";font-size:18px;font-style:normal;font-weight:bold;color:#FFFFFF">#MENJE_ENVIAR</h2></td>
                                                                    </tr>

                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <table class="es-footer" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
                                <tr style="border-collapse:collapse">
                                    <td align="center" style="padding:0;Margin:0">
                                        <table class="es-footer-body" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#313945;width:600px">
                                            <tr style="border-collapse:collapse">
                                                <td align="left" style="Margin:0;padding-top:35px;padding-left:35px;padding-right:35px;padding-bottom:40px">
                                                    <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                        <tr style="border-collapse:collapse">
                                                            <td valign="top" align="center" style="padding:0;Margin:0;width:530px">
                                                                <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tr style="border-collapse:collapse">
                                                                        <td align="center" style="padding:0;Margin:0;padding-bottom:15px;font-size:0"><img src="http://amumas.marn.gob.sv/marnb.png" alt="Beretun logo" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" title="Beretun logo" width="250"></td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse">
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse">
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                                <tr style="border-collapse:collapse">
                                    <td align="center" style="padding:0;Margin:0">
                                        <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px" cellspacing="0" cellpadding="0" align="center">
                                            <tr style="border-collapse:collapse">
                                                <td align="left" style="Margin:0;padding-left:20px;padding-right:20px;padding-top:30px;padding-bottom:30px">
                                                    <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                        <tr style="border-collapse:collapse">
                                                            <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                                                                <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                    <tr style="border-collapse:collapse">
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </body>
        </html>';
        

    

    
    
    //valida si el correo esta en la base con la sentencia preparada
    if($correo!=null)
    {

        $sentencia = $c->prepare("select estado from usuarioexterno where correo='$correo';");
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        $fila = $resultado->fetch_assoc();
        $estado=$fila["estado"];

        if($estado==0){
            echo "-4";
            //USUARIO SUSPENDIDO

        }else{

            //Recipients
            $mail->setFrom('noreplay@marn.gob.sv', 'RESTAURACIONES Y REFORESTACIONES');
            //$mail->addAddress('saulrivera9999@gmail.com', 'Saiarlen'); 
            $mail->addAddress($correo, 'Saiarlen'); 

            //SI COMENTO ESTA LINEA PRUEBO EL ERROR AL ENVIAR EMAIL
            if($_POST['accion']=="1")
            {
                /*$message = "Correo de recuperación de contraseña, contraseña temporal: <br>".implode($pass);*/


                $message = "¡Hola!, hemos restaurado tu contraseña de inicio de sesión en SISTEMA DE RESTAURACIONES Y REFORESTACIONES.<br><br><center>Tu contraseña asignada es: ".implode($pass)."<br><br><a href='#'>Haz clic aquí para iniciar sesión</a></center>";

            }else if($_POST['accion']=="2")
            {

                /*$message = "Se creó un nuevo usuario en el SISTEMA DE RESTAURACIONES para iniciar sesión <a href='#'>haz clic aquí.</a> Ingresa con este correo electrónico y la siguiente contraseña: <br><br><center><b>".implode($pass)."</b></center>";*/

                $message = "¡Hola!, se te ha asignado una contraseña temporal para iniciar sesión en el SISTEMA DE RESTAURACIONES Y REFORESTACIONES.<br><br><center>Tu contraseña asignada es: ".implode($pass)."<br><br><a href='#'>Haz clic aquí para iniciar sesión</a></center>";




            }else if($_POST['accion']=="3")
            {
                /*$message = "Se realizó el cambio de contraseña exitosamente <a href='#'>haz clic aquí.</a>";*/
                
                $message = "¡Hola!, el cambió de contraseña se ha realizado exitosamente, recuerda que debes de iniciar sesión con la contraseña que estableciste.<br><br><center><a href='#'>Haz clic aquí para iniciar sesión</a></center>";

                //ACTUALIZANDO CONTRASEÑA EN LA BASE
                $sql="update usuarioexterno set contra=md5('".$_POST['cambiocontra']."'), estadocambiocontra=0 where correo='$correo'";
                $c->query($sql);


                
            }else if($_POST['accion']=="4")
            {
                //SI ACCION ES 4 ENVIA CORREO NOTIFICANDO QUE SE APROBO EL PUNTO DE RESTAURACION
                /*$message = "Se realizó el cambio de contraseña exitosamente <a href='#'>haz clic aquí.</a>";*/
                
                $message = "¡Hola!, tu registro en el sistema de RESTAURACIONES y REFORESTACIONES ha sido aprobado.<br><br><center><a href='#'>Haz clic aquí para iniciar sesión</a></center>";


                
            }else if($_POST['accion']=="5")
            {
                //SI ACCION ES 5 ENVIA CORREO NOTIFICANDO QUE SE RECHAZO EL PUNTO DE RESTAURACION
                /*$message = "Se realizó el cambio de contraseña exitosamente <a href='#'>haz clic aquí.</a>";*/
                
                $message = "¡Hola!, tu registro en el sistema de RESTAURACIONES y REFORESTACIONES ha sido RECHAZADO por el siguiente motivo: <b>".$_POST['motivo']."</b> (<u>Por favor modifica tu registro</u>).<br><br><center><a href='#'>Haz clic aquí para iniciar sesión</a></center>";


                
            }

            $mail->Body    =  str_replace("#MENJE_ENVIAR",$message,$body);


            //SI EL CORREO ESTA EN LA BASE PERO NO ENVIA EL CORREO IMPRIMIRA UN ERROR EN JSSESION CON RESP=-1
            //Info Message
            if (!$mail->send()) {
            //$error = "Mailer Error: " . $mail->ErrorInfo;
            //echo '<p id="res">'.$error.'</p>';
                echo "-1";
            }else {
                //echo '<p id="res">Thanks! Message Sent Successfully.</p>';
                //SI REALIZA LA ACCION 3 DE CAMBIAR CONTRASEÑA TEMPORAL IMPRIMIRA 3
                if($_POST['accion']=="3")
                {
                    echo "3";
                }else{
                   echo "1"; 
                }
            }

        }

        
        

    }else
    {
        //CORREO NO EXISTE EN LA BASE DE DATOS
        $correo = $_POST['correo'];
        $sentencia = $c->prepare("select correo from usuario where correo='$correo';");
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        $fila = $resultado->fetch_assoc();
        $correo_=$fila["correo"];
        if($correo_!=null){
            //-3 SIGNIFICA QUE EL USUARIO ES INTERNO POR LO QUE NO PUEDE CAMBIAR CONTRASEÑA
            echo "-3"; 
        }else{
            //-2 SIGNIFICA QUE EL CORREO NO ESTA EN NINGUNA TABLA DE LA BASE DE DATOS
            echo "-2"; 
        }
        
    }
    /*else{
    //echo '<p id="res">Please enter valid Inputs</p>';
    echo "-1";
    }*/

}

?>