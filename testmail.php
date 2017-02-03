<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

sendMail('kingkpono@gmail.com','Kpono','Akpabio','Lag','Lag','080404040','0000566');
echo 'here2 ';
  die;
public function sendMail($to,$fname,$lname,$street,$city,$phone,$orderNo){
    
  $from 'ask@yudala.com'
    $subject = 'Yudala Order Confirmation-'.$orderNo;

    $headers = "From: " . $from . "\r\n";
    $headers .= "Reply-To: ". $to . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
echo 'here 1';
  die;
    $body = '<html><body>';
    $body .= '<a href="http://yudala.com"><img src="http://staging.yudala.com/ee/pub/media/email/logo/default/yudala_logo.png" alt="Yudala Online" /></a>';
    $body .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
    $body .= '<tr style="background: #eee;"><td>Dear '.$fname.'  '.$lname.',<br/>Thank you for your order from www.Yudala.com. Once your package ships we will send you a tracking number.

If you have questions about your order, you can email us at ask@yudala.com.</td></tr>';
    $body .= '<tr><td><h3 style="font-weight:300;line-height:1.1;font-size:18px;margin-top:0;margin-bottom:10px">Billing Info</h3><p style="margin-top:0;margin-bottom:10px">'.$fname.'  '.$lname.'<br>'.$street.'<br>,'.$city.',<br>
Nigeria<br>
T: '.$phone.'</p> </td><td><h3 style="font-weight:300;line-height:1.1;font-size:18px;margin-top:0;margin-bottom:10px">Shipping Info</h3><p style="margin-top:0;margin-bottom:10px">'.$fname.'  '.$lname.'<br>'.$street.'<br>,
Nigeria<br>
T: '.$phone.'</p> </td></tr>';
   
    $body .= '</table>';
    $body .= '</body></html>';

    mail($to,$subject,$body,$headers);
}