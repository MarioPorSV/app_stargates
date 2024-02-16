<?php
 
 defined('BASEPATH') or exit('No direct script access allowed');
 
 class SendModel extends CI_Model
 {
    public function sendmail($body,$correo)
    {
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        $this->load->library('email');

        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'desarrollo@mistarship.com',
            'smtp_pass' => 'jJ2020$.005',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            
             );
             
        //$correo='desarrollosv@c807.com';
        $correo='desarrollo@mistarship.com';
        //$correo='juanobisp@gmail.com';

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('elmer.guardado@gmail.com', 'Starship Shopping');
        $this->email->to($correo);
        // $this->email->to('mavolevan@mistarship.com');
        $this->email->subject('Estatus');
        $filename = 'public/imagenes/logo.png';
        $this->email->attach($filename);
        $cid = $this->email->attachment_cid($filename);
        //   $this->email->message('<img src="cid:'. $cid .'" alt="photo1" />');
        $b =rawurldecode($body);
        $this->email->message('
            <img src="cid:'. $cid .'" alt="photo1"/>
            <br></br>
             '.$b.'
            <br></br>   
            <h2>CORREO DE PRUEBA</h2>');

        if ($this->email->send()) {
            //echo 'Your email was sent.';
        } else {
            echo $this->email->print_debugger();
        }
    }


 }