<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$correo= $_POST['correo'];
$nombre= $_POST['nombre'];
$telefono= $_POST['telefono'];
$consulta= $_POST['consulta'];

$cuerpo= "Nombre: "."$nombre"."<br>Mail:"."$correo"."<br>Telefono:"."$telefono"."<br>Consulta:"."$consulta";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'rejasargentinas@gmail.com';                     // SMTP username
    $mail->Password   = 'RArg2018';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($correo, $nombre);
    $mail->addAddress('rejasargentinas@gmail.com', 'Joe User');     // Add a recipient
    
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Consulta';
    $mail->Body    = $cuerpo;
    $mail->CharSet = 'utf-8';

    $mail->send();
    echo '<script>
            alert("El mensaje se envio correctamente");
            window.history.go(-1);
         </script>';
} catch (Exception $e) {
    echo "Error, no se envio el mansaje: {$mail->ErrorInfo}";
}
