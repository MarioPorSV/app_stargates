<?php
defined('BASEPATH') or exit('No direct script access allowed');
 include getcwd()."/application/libraries/fpdf/fpdf.php";

class Cargar_ManAduanaController extends CI_Controller
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
        $this->load->model('Aduana_Model');
        $this->load->helper('path');
        session_start();
    }

    public function cargar_archivo_fast()
    {
        $this->load->view("aduana/cargar_archivo_fast");
    }

    public function upload_fast()
    {
        if(isset($_FILES["file"]["name"])) 
        {
            $destino = getcwd() . "/public/uploads/file/";

            if (!is_dir($destino)) 
            {
                mkdir($destino, 0777, true);
            }

            $extension = explode(".", $_FILES["file"]["name"]);
            $nombre = time() . "-plantilla." . $extension[1];

            //echo $_FILES["file"]["name"];

            if (move_uploaded_file($_FILES['file']['tmp_name'], $destino . "/" . $nombre)) 
            {
                $link = $destino . "/" . $nombre;
            } 
            else 
            {
            
            }

            $object =   PHPExcel_IOFactory::load($link);
            $mawb   =   str_replace([' ','.xls'], '', $_FILES["file"]["name"]);
            $id     =   null;
            $data   =   array(
                                'manifiesto'      =>      $mawb,
                                'fecha'           =>      date("Y-m-d H:i:s"),
                                'descripcion'     =>      "Escriba una direccion aqui",
                                'referencia'      =>      "Referencia Aqui",
                                'paquetes'        =>      "1",
                                'sacos'           =>      "1",
                                'tipo'            =>      "GMA",
                                'id_pais'         =>      2,
                                'userid'          =>      $_SESSION["user_id"]
                        );

            $this->PreclasificacionModel->guardar_manifiesto($id, $data);

            foreach ($object->getWorksheetIterator() as $worksheet) 
            {
                $highestRow    = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();

                for($row = 2; $row <= $highestRow; $row++) 
                {
                   
                    $tracking_number        = $worksheet->getCellByColumnAndRow(2,  $row)->getValue();
                 
                    $consignee_account      = $worksheet->getCellByColumnAndRow(15,  $row)->getValue();
                    $consignee              = $worksheet->getCellByColumnAndRow(10,  $row)->getValue();
                    $consignee_address1     = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                    //$consignee_address2     = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                    //$consignee_address3     = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                    //$consignee_neighborhood = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                    $consignee_city         = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                    $consignee_state        = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                    $consignee_zip          = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                    $consignee_country      = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                    $consignee_email        = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                    $consignee_phone        = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                    $consignee_mobile       = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                    //$consignee_taxid        = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                    $pieces                 = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                    $gweight                = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                    $cweight                = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                    //$weight_type            = $worksheet->getCellByColumnAndRow(25, $row)->getValue();
                    //$height                 = $worksheet->getCellByColumnAndRow(26, $row)->getValue();
                    //$length                 = $worksheet->getCellByColumnAndRow(27, $row)->getValue();
                    //$width                  = $worksheet->getCellByColumnAndRow(28, $row)->getValue();
                    $commodity              = $worksheet->getCellByColumnAndRow(23, $row)->getValue();
                    //$value                  = $worksheet->getCellByColumnAndRow(30, $row)->getValue();
                    //$freight                = $worksheet->getCellByColumnAndRow(31, $row)->getValue();
                    //$currency               = $worksheet->getCellByColumnAndRow(32, $row)->getValue();
                    //$service_type           = $worksheet->getCellByColumnAndRow(33, $row)->getValue();
                    //$service_level          = $worksheet->getCellByColumnAndRow(34, $row)->getValue();
                    $shipper_account        = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $shipper_name           = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    //$shipper_address1       = $worksheet->getCellByColumnAndRow(37, $row)->getValue();
                    //$shipper_address2       = $worksheet->getCellByColumnAndRow(38, $row)->getValue();
                    //$shipper_city           = $worksheet->getCellByColumnAndRow(39, $row)->getValue();
                    //$shipper_state          = $worksheet->getCellByColumnAndRow(40, $row)->getValue();
                    //$shipper_zip            = $worksheet->getCellByColumnAndRow(41, $row)->getValue();
                    //$shipper_country        = $worksheet->getCellByColumnAndRow(42, $row)->getValue();
                    //$shipper_email          = $worksheet->getCellByColumnAndRow(43, $row)->getValue();
                    //$shipper_phone          = $worksheet->getCellByColumnAndRow(44, $row)->getValue();
                    
                    $manif['man'] = $this->Aduana_Model->preclasificacion($mawb);
                   
                    $id_manifiesto = 0;
                    foreach ($manif['man'] as $f) 
                    {
                        $id_manifiesto = $f->idpreclasificacion;
                    }
                   
                    //exit;
                    $data = array(
                                    //'mawb'                   => $mawb,
                                    //bag_number'             => $bag_number,
                                    //etd'                    => $etd,
                                    //eta'                    => $eta,
                                    //order_number'           => $order_number,
                                    'tracking_number'        => $tracking_number,
                                    //'origin'                 => $origin,
                                    //'destination'            => $destination,
                                    'consignee_account'      => $consignee_account,
                                    'consignee'              => $consignee,
                                    'consignee_address1'     => $consignee_address1,
                                    //'consignee_address2'     => $consignee_address2,
                                    //'consignee_address3'     => $consignee_address3,
                                    //'consignee_neighborhood' => $consignee_neighborhood,
                                    'consignee_city'         => $consignee_city,
                                    'consignee_state'        => $consignee_state,
                                    'consignee_zip'          => $consignee_zip,
                                    'consignee_country'      => $consignee_country,
                                    'consignee_email'        => $consignee_email,
                                    'consignee_phone'        => $consignee_phone,
                                    'consignee_mobile'       => $consignee_mobile,
                                    //'consignee_taxid'        => $consignee_taxid,
                                    'pieces'                 => $pieces,
                                    'gweight'                => $gweight,
                                    'cweight'                => $cweight,
                                    //'weight_type'            => $weight_type,
                                    //'height'                 => $height,
                                    //'length'                 => $length,
                                    //'width'                  => $width,
                                    'commodity'              => $commodity,
                                    //'value'                  => $value,
                                    //'freight'                => $freight,
                                    //'currency'               => $currency,
                                    //'service_type'           => $service_type,
                                    //'service_level'          => $service_level,
                                    'shipper_account'        => $shipper_account,
                                    'shipper_name'           => $shipper_name,
                                    //'shipper_address1'       => $shipper_address1,
                                    //'shipper_address2'       => $shipper_address2,
                                    //'shipper_city'           => $shipper_city,
                                    //'shipper_state'          => $shipper_state,
                                    //'shipper_zip'            => $shipper_zip,
                                    //'shipper_country'        => $shipper_country,
                                    //'shipper_email'          => $shipper_email,
                                    //'shipper_phone'          => $shipper_phone,
                                    'id_manifiesto'          => $id_manifiesto,
                                    'id_pais'                => '2',
                                    'tarifa'                 => $tarifa,
                                    'pakya'                  => 1,   
                    );

                    $this->WarehouseModel->insertar($data);

                    $id = null;
                    $data = array(
                                    'manifiesto'            => $mawb,
                                    'referencia'            => "1001",
                                    'numero_warehouse'      => $order_number,
                                    'cajas'                 => $pieces,
                                    'casillero'             => $consignee_account,
                                    'id_pais'               => 2,
                    );

                    $this->PreclasificacionModel->guardar_guia($data);
                }
            }
        }
    }

    public function guardar_master_fast($master, $transportista)
    {
        $manifiesto            =   $master;
        $id_transportista      =   $transportista;

        $data  = array(
                        'manifiesto'            =>   $manifiesto,
                        'id_transportista'      =>   $id_transportista,
        );
        
        $this->PreclasificacionModel->guardar_master_fast($data);
    }
}