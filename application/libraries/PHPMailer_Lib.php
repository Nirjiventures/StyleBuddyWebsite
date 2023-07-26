<?php
defined('BASEPATH') OR exit('No direct script access allowed');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PHPMailer_Lib
{
    public function __construct(){
        log_message('Debug', 'PHPMailer class is loaded.');
    }

    public function load(){
        // Include PHPMailer library files
         require_once APPPATH.'third_party/PHPMailer/src/Exception.php';
         require_once APPPATH.'third_party/PHPMailer/src/PHPMailer.php';
         require_once APPPATH.'third_party/PHPMailer/src/SMTP.php';
        
        $mail = new PHPMailer(true);
        //$mail->isSMTP();
        
        // gmail
        // $mail->Host     = 'smtp.gmail.com';
        // $mail->SMTPAuth = true;
        // $mail->Username = 'testting4u@gmail.com';
        // $mail->Password = '********';
        // $mail->SMTPSecure = 'tls';
        // $mail->Port     = 587;
        
        //own server
        
        
        $mail->Host = 'dndtestserver.com/webmail';            
        $mail->SMTPAuth = true;                               
        $mail->Username = 'support@stylebuddy.in';             
        $mail->Password = 'developer@dndtestserver.com1';                        
        $mail->SMTPSecure = 'ssl';                           
        $mail->Port = 465;                                    
        
        //all forms mails will go to Will be support@stylebuddy.in and jyoti@stylebuddy.in
        //$mail->addBCC = 'jyoti@stylebuddy.in';
        //$mail->addCC = '';
        $mail->isHTML(true);
        
        return $mail;
    }
}