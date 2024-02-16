<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Consulta_track_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('PHPEXCEL/PHPExcel.php');
        $this->load->database();
        $this->load->model('Conf_model');
        $this->load->model('WarehouseModel');
        $this->load->model('SendModel');
        $this->load->model('Traspaso_model');
        $this->load->model('PreclasificacionModel');
        $this->load->model('WhModel');
        $this->load->helper('path');
    }

    public function consulta_track()
    {
        $this->load->view("consulta_track/form");
    }

    public function buscar_tracking_numb($tracking)
    {
        $this->datos['tracking_numb'] = $this->WhModel->buscar_tracking_numb($tracking);
        $this->load->view("consulta_track/cuerpo",  $this->datos);
    }
}