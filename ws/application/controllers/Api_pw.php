<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods:GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, x-xsrf-token');

defined('BASEPATH') or exit('No direct script access allowed');
//include getcwd() . "/libraries/RestController.php";

require(APPPATH . '/libraries/REST_Controller.php');
//use Restserver\Libraries\RestController;
class Api_pw extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Pw_model');
       
    }

    public function verificar_cuenta_get()
    {
        $id = $this->uri->segment(3);
        if (!isset($id)) {
            $respuesta = array(
                'err' => true,
                'mensaje' => 'Es necesario el número de NIT'
            );
            $this->response($respuesta, REST_Controller::HTTP_BAD_REQUEST);
            return;
        }

        if ($id == " ") {
        } else {
            $id = str_replace("%20", " ", $id);
        }
        $casillero = $this->Pw_model->verificar_cuenta($id);
       //var_dump($casillero);
        if (($casillero)) {
            $respuesta = array(
                'err' => false,
                'mensaje' => 'Registro cargado correctamente',
                'cliente' => $casillero
            );
            $this->response($respuesta);
        } else {
            $respuesta = array(
                'err' => true,
                'mensaje' => 'NIT: ' . $id . ', no está asociado a ninguna cuenta ',
                'cuenta' => null
            );
            $this->response($respuesta, REST_Controller::HTTP_NOT_FOUND);
        }
    }

}

/* End of file Controllername.php */