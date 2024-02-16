 <?php

    defined('BASEPATH') or exit('No direct script access allowed');

    class WarehouseController extends CI_Controller
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
            //session_start();
        }

        public function warehouse()
        {
            //  $this->datos['maste'] = $this->ClientesModel->guia_master();
            $this->load->view("warehouse/vista_warehouse", $this->datos);
        }

        public function consulta_warehouse()
        {
            $wh = $_POST['search'];
            $this->datos['wareh'] =  $this->WarehouseModel->buscar_warehouse($wh);

            $this->load->view('warehouse/consulta_wh_estatus', $this->datos);
        }

        public function clasifica()
        {
            $this->datos['estatus'] = $this->Conf_model->estatus();
            $this->load->view("warehouse/vista_clasifica", $this->datos);
        }

        public function cambiar_estatus()
        {
            $this->datos['estatus'] = $this->Conf_model->estatus();
            $this->load->view("warehouse/vista_cambiar_estatus", $this->datos);
        }

        public function guardar_estatus()
        {     
            $date = date('Y-m-d H:i:s');
            $fecha_tmp = DateTime::createFromFormat('Y-m-d H:i:s', $date);
            $fecha_iso = $fecha_tmp->format(DateTime::ATOM);

            $data   =   array(
                                'item'          =>    1,
                                'fecha'         =>    date('Y-m-d H:i:s'),
                                'warehouse'     =>    $_POST['n_warehouse'],
                                'id_estatus'    =>    $_POST['n_estatus'],
                                'casillero'     =>    100,
                                'retirado_por'  =>    $_POST['n_retiro'],
                                'id_pais'       =>    $_SESSION['pais'],
                                'fechaiso'      =>    $fecha_iso
                        );

            $date       =   "Date: " . date('Y-m-d H:i:s');
            $wh         =   $_POST['n_warehouse'];
            $idestatus  =   $_POST['n_estatus'];

            /*actualizar wh*/
            $this->Traspaso_model->actualizar_estatus($wh, $idestatus);

            /*insert */
            $this->PreclasificacionModel->guardar_detalle($data);
            $this->PreclasificacionModel->update_estatus($wh, $idestatus);
            
            //bloque para actualizar en sistema MailAmericas
            $token_ma = $this->token_ma(); //obtiene el token
          
            //$token_ma = $this->token_ma(); //obtiene el token
            // echo    $token_ma;
            // exit;
            $header     =   array(
                                    'Host: tracking.mailamericas.com',
                                    'Content-Type: application/json',
                                    'Cache-Control: no-cache',
                                    'Authorization: Bearer ' . $token_ma
                            );

            $data   =   array(
                                "tracking"          =>  $wh, 
                                "date"              =>  $fecha_iso,
                                "description"       =>  $_POST['nombreestatus'], 
                                "city"              =>  "CCO", 
                                "received_by"       =>  "", 
                                "relationship"      =>  null, 
                                "delivery_proof"    =>  [" "],
                                "gcs"               =>  "",
                                "details"           =>  ""
                        );

        $url = "https://tracking.mailamericas.com/api/v1/providers/events";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        $resultStr = curl_exec($ch);

        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }
        curl_close($ch);
        //  echo  $error_msg;
        //   echo $resultStr;

        $data = array(
            "respuesta" => $resultStr,
            "tracking_number" =>  $wh,
            "descripcion" => $_POST['nombreestatus'], 
            "fecha" =>  date('Y-m-d H:i:s'),
            "fechaiso" =>  $fecha_iso

        );
        $this->PreclasificacionModel->guardar_logma($data);

        }


   function token_ma()
    {

        $header = array(
            'Host: tracking.mailamericas.com',
            'Content-Type: application/json',
            'Cache-Control: no-cache'
        );

        $data = array(
            "grant_type" => "client_credentials",
            "client_id" => 42,
            "client_secret" => "1CFIlE3pXo2QdJgcnlocoRIoXsJ1Dr3veM8pWKj4",
            "scope" => "*"
        );

        $url = "http://tracking.mailamericas.com/oauth/token";



        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://tracking.mailamericas.com/oauth/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                    "grant_type": "client_credentials",
                           "client_id" : 42,
                           "client_secret" : "1CFIlE3pXo2QdJgcnlocoRIoXsJ1Dr3veM8pWKj4",
                           "scope": "*"
               }',
            CURLOPT_HTTPHEADER => array(
                'Cache-Control: no-cache',
                'Content-Type: application/json',
                'Host: tracking.mailamericas.com'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        //   echo $response;
        $code = json_decode($response);
        // var_dump($code);
        $token = $code->access_token;
        return $token;
    }

        public function verificar_warehouse($id)
        {
            $warehouse = $this->WarehouseModel->verificar_warehouse($id);

            if ($warehouse) 
            {
                echo json_encode($warehouse);
            }
        }


        public function cargar_archivo()
        {
            $this->load->view("warehouse/cargar_archivo");
        }

        public function upload_file()
        {
            //  echo "nombre ".$_FILES["file"]["name"];
            if(isset($_FILES["file"]["name"])) 
            {
                $destino = getcwd() . "/public/uploads/file/";

                if (!is_dir($destino)) 
                {
                    mkdir($destino, 0777, true);
                }

                $extension = explode(".", $_FILES["file"]["name"]);
                $nombre = time() . "-plantilla." . $extension[1];

                if (move_uploaded_file($_FILES['file']['tmp_name'], $destino . "/" . $nombre)) 
                {
                    $link = $destino . "/" . $nombre;
                } 
                else 
                {
                
                }

                $object = PHPExcel_IOFactory::load($link);

                foreach ($object->getWorksheetIterator() as $worksheet) 
                {
                    $highestRow    = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();

                    for ($row = 2; $row <= $highestRow; $row++) 
                    {
                        $mawb                   = $worksheet->getCellByColumnAndRow(0,  $row)->getValue();
                        $bag_number             = $worksheet->getCellByColumnAndRow(1,  $row)->getValue();
                        $etd                    = $worksheet->getCellByColumnAndRow(2,  $row)->getValue();
                        $eta                    = $worksheet->getCellByColumnAndRow(3,  $row)->getValue();
                        $order_number           = $worksheet->getCellByColumnAndRow(4,  $row)->getValue();
                        $tracking_number        = $worksheet->getCellByColumnAndRow(5,  $row)->getValue();
                        $origin                 = $worksheet->getCellByColumnAndRow(6,  $row)->getValue();
                        $destination            = $worksheet->getCellByColumnAndRow(7,  $row)->getValue();
                        $consignee_account      = $worksheet->getCellByColumnAndRow(8,  $row)->getValue();
                        $consignee              = $worksheet->getCellByColumnAndRow(9,  $row)->getValue();
                        $consignee_address1     = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $consignee_address2     = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $consignee_address3     = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $consignee_neighborhood = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $consignee_city         = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        $consignee_state        = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                        $consignee_zip          = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                        $consignee_country      = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                        $consignee_email        = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                        $consignee_phone        = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                        $consignee_mobile       = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                        $consignee_taxid        = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                        $pieces                 = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
                        $gweight                = $worksheet->getCellByColumnAndRow(23, $row)->getValue();
                        $cweight                = $worksheet->getCellByColumnAndRow(24, $row)->getValue();
                        $weight_type            = $worksheet->getCellByColumnAndRow(25, $row)->getValue();
                        $height                 = $worksheet->getCellByColumnAndRow(26, $row)->getValue();
                        $length                 = $worksheet->getCellByColumnAndRow(27, $row)->getValue();
                        $width                  = $worksheet->getCellByColumnAndRow(28, $row)->getValue();
                        $commodity              = $worksheet->getCellByColumnAndRow(29, $row)->getValue();
                        $value                  = $worksheet->getCellByColumnAndRow(30, $row)->getValue();
                        $freight                = $worksheet->getCellByColumnAndRow(31, $row)->getValue();
                        $currency               = $worksheet->getCellByColumnAndRow(32, $row)->getValue();
                        $service_type           = $worksheet->getCellByColumnAndRow(33, $row)->getValue();
                        $service_level          = $worksheet->getCellByColumnAndRow(34, $row)->getValue();
                        $shipper_account        = $worksheet->getCellByColumnAndRow(35, $row)->getValue();
                        $shipper_name           = $worksheet->getCellByColumnAndRow(36, $row)->getValue();
                        $shipper_address1       = $worksheet->getCellByColumnAndRow(37, $row)->getValue();
                        $shipper_address2       = $worksheet->getCellByColumnAndRow(38, $row)->getValue();
                        $shipper_city           = $worksheet->getCellByColumnAndRow(39, $row)->getValue();
                        $shipper_state          = $worksheet->getCellByColumnAndRow(40, $row)->getValue();
                        $shipper_zip            = $worksheet->getCellByColumnAndRow(41, $row)->getValue();
                        $shipper_country        = $worksheet->getCellByColumnAndRow(42, $row)->getValue();
                        $shipper_email          = $worksheet->getCellByColumnAndRow(43, $row)->getValue();
                        $shipper_phone          = $worksheet->getCellByColumnAndRow(44, $row)->getValue();

                        $rate['tarifa'] = $this->WarehouseModel->tarifas(); // toma el valor de la guia para evaluacion de acuerdo al rango de tarifa (tabla tarifa)
                        //  var_dump( $rate['tarifa']);
                        $tarifa = 0;
                        foreach ($rate['tarifa'] as $f) 
                        {
                            if ($tarifa == 0) 
                            {
                                if ($value >= $f->desde && $value <= $f->hasta) 
                                {
                                    $tarifa = $f->tarifa;
                                }
                            }
                        }

                        $data = array(
                            'mawb'                   => $mawb,
                            'bag_number'             => $bag_number,
                            'etd'                    => $etd,
                            'eta'                    => $eta,
                            'order_number'           => $order_number,
                            'tracking_number'        => $tracking_number,
                            'origin'                 => $origin,
                            'destination'            => $destination,
                            'consignee_account'      => $consignee_account,
                            'consignee'              => $consignee,
                            'consignee_address1'     => $consignee_address1,
                            'consignee_address2'     => $consignee_address2,
                            'consignee_address3'     => $consignee_address3,
                            'consignee_neighborhood' => $consignee_neighborhood,
                            'consignee_city'         => $consignee_city,
                            'consignee_state'        => $consignee_state,
                            'consignee_zip'          => $consignee_zip,
                            'consignee_country'      => $consignee_country,
                            'consignee_email'        => $consignee_email,
                            'consignee_phone'        => $consignee_phone,
                            'consignee_mobile'       => $consignee_mobile,
                            'consignee_taxid'        => $consignee_taxid,
                            'pieces'                 => $pieces,
                            'gweight'                => $gweight,
                            'cweight'                => $cweight,
                            'weight_type'            => $weight_type,
                            'height'                 => $height,
                            'length'                 => $length,
                            'width'                  => $width,
                            'commodity'              => $commodity,
                            'value'                  => $value,
                            'freight'                => $freight,
                            'currency'               => $currency,
                            'service_type'           => $service_type,
                            'service_level'          => $service_level,
                            'shipper_account'        => $shipper_account,
                            'shipper_name'           => $shipper_name,
                            'shipper_address1'       => $shipper_address1,
                            'shipper_address2'       => $shipper_address2,
                            'shipper_city'           => $shipper_city,
                            'shipper_state'          => $shipper_state,
                            'shipper_zip'            => $shipper_zip,
                            'shipper_country'        => $shipper_country,
                            'shipper_email'          => $shipper_email,
                            'shipper_phone'          => $shipper_phone,
                            'id_pais'                => '2',
                            'tarifa'                 => $tarifa
                        );

                        $this->WarehouseModel->insertar($data);


                        $id = null;
                        $data = array(
                            'manifiesto' => $mawb,
                            'referencia' => "1001",
                            'numero_warehouse' => $order_number,
                            'cajas' => $pieces,
                            'casillero' => $consignee_account,
                            'id_pais' => 2,

                        );


                        $this->PreclasificacionModel->guardar_guia($data);




                        $data = array(
                            'manifiesto' => $mawb,
                            'fecha' => date("Y-m-d H:i:s"),
                            'descripcion' => "Escriba una dirección aqui",
                            'referencia' => "Referencia Aqui",
                            'paquetes' => "1",
                            'sacos' => "1",
                            'tipo' => "GMA",
                            'id_pais' => 2,
                        );
                        $this->PreclasificacionModel->guardar_manifiesto($id, $data);
                    }
                }
            }
        }




        public function upload_file_facturacion()
        {

            //  echo "nombre ".$_FILES["file"]["name"];
            if (isset($_FILES["file"]["name"])) {
                $destino = getcwd() . "/public/uploads/file/";

                if (!is_dir($destino)) {
                    mkdir($destino, 0777, true);
                }

                $extension = explode(".", $_FILES["file"]["name"]);
                $nombre = time() . "-plantilla." . $extension[1];

                if (move_uploaded_file($_FILES['file']['tmp_name'], $destino . "/" . $nombre)) {
                    $link = $destino . "/" . $nombre;
                } else {
                }


                $object = PHPExcel_IOFactory::load($link);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow    = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();


                    for ($row = 1; $row <= $highestRow; $row++) {

                        $guia            = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $codcliente      = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $nombre          = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $montofactura    = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $piezas          = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $ret_en_adn      = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $peso_neto       = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $peso_volumen    = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $pesotomar       = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $codtarifa       = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $cargobasico     = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $corte           = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $manejo_trans    = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $descuento       = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $sed             = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        $seguro          = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                        $entrega_local   = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                        $tramite_aduanal = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                        $rayosx          = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                        $iva_vta_propia  = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                        $imp             = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                        $cepa            = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                        $total           = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
                        $ot              = $worksheet->getCellByColumnAndRow(23, $row)->getValue();
                        $poliza          = $worksheet->getCellByColumnAndRow(24, $row)->getValue();
                        $permiso         = $worksheet->getCellByColumnAndRow(25, $row)->getValue();

                        $data = array(
                            'guia'            => $guia,
                            'codcliente'      => $codcliente,
                            'nombre'          => $nombre,
                            'montofactura'    => $montofactura,
                            'piezas'          => $piezas,
                            'ret_en_adn'      => $ret_en_adn,
                            'pesoneto'       => $peso_neto,
                            'pesovolumen'    => $peso_volumen,
                            'pesotomar'       => $pesotomar,
                            'codtarifa'       => $codtarifa,
                            'cargobasico'     => $cargobasico,
                            'corte'           => $corte,
                            'manejo_trans'    => $manejo_trans,
                            'descuento'       => $descuento,
                            'sed'             => $sed,
                            'seguro'          => $seguro,
                            'entrega_local'   => $entrega_local,
                            'tramite_aduanal' => $tramite_aduanal,
                            'rayosx'          => $rayosx,
                            'iva_vta_propia'  => $iva_vta_propia,
                            'imp'             => $imp,
                            'cepa'            => $cepa,
                            'total'           => $total,
                            'ot'              => $ot,
                            'poliza'          => $poliza,
                            'permiso'         => $permiso

                        );

                        $this->WarehouseModel->insertar_facturacion($data);
                        $this->WarehouseModel->update_precio_paquete($guia, $total);
                    }
                }
            }
        }
        
        //  funcion  para  hace un update  de precios  en los paquetes  02-10-2023
        public function upload_fileWH($idpreclasificacion)
        {
            //ECHO   'vALORE  RECIBIDO N PRECLASIFICACION' . $idpreclasificacion;

            //  echo "nombre ".$_FILES["file"]["name"];
            if (isset($_FILES["file"]["name"])) 
            {
                $destino = getcwd() . "/public/uploads/file/";

                if (!is_dir($destino)) 
                {
                    mkdir($destino, 0777, true);
                }

                $extension = explode(".", $_FILES["file"]["name"]);
                $nombre = time() . "-plantilla." . $extension[1];

                if (move_uploaded_file($_FILES['file']['tmp_name'], $destino . "/" . $nombre)) 
                {
                    $link = $destino . "/" . $nombre;
                } 
                else 
                {
                }

                $object = PHPExcel_IOFactory::load($link);               
                
                foreach ($object->getWorksheetIterator() as $worksheet) 
                {
                    
                    $DAI                    = 0;
                    $IVA                    = 0;
                    $MANEJO	                = 0;
                    $comision	                = 0;
                    $Cobro_final            = 0;

                    $highestRow    = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    $tracking_number ='';
                    for ($row = 2; $row <= $highestRow; $row++) 
                    {
                        $tracking_number        = $worksheet->getCellByColumnAndRow(0,  $row)->getValue();
                       // $Value                  = $worksheet->getCellByColumnAndRow(7,  $row)->getValue();
                        $DAI                    = $worksheet->getCellByColumnAndRow(7,  $row)->getValue();
                        $IVA                    = $worksheet->getCellByColumnAndRow(8,  $row)->getValue();
                        $total_imp              = $worksheet->getCellByColumnAndRow(9,  $row)->getValue(); 
                        $comision	           = $worksheet->getCellByColumnAndRow(10,  $row)->getValue();
                        $MANEJO	                = $worksheet->getCellByColumnAndRow(11,  $row)->getValue();
                      
                        $total_ivag    = $worksheet->getCellByColumnAndRow(14,  $row)->getValue();;
                        $Cobro_final            = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                         if($tracking_number!='' )
                         {
                           //echo   'los valores obtenidos son ' .  $tracking_number . ' ' . $Value .   ' ' .$DAI . ' ' .$MANEJO .' '. $Cobro_final .'<br>';

                            $this->WhModel->update_dm1($idpreclasificacion,$tracking_number, $DAI, $IVA, $comision,$MANEJO,$Cobro_final, $total_imp, $total_ivag);
                           

                         }else  {
                            exit;

                         }
                        
                    }
                }
            }
        }
        
        public function cargar_archivoMF()
        {
            $this->load->view("warehouse/cargar_archivoMF");
        }
        
        //  funcion para  cargar la modal  que obtendra los  datos para  actalizar el  DUI
        public function cargar_archivoDUI()
        {
            $this->load->view("warehouse/cargar_archivoDui");
        }

        //  funcion  para  hace un update  de DUI  en los paquetes  12-10-2023
        public function upload_fileDUI($idpreclasificacion)
        {
            // ECHO   'vALORE  RECIBIDO N PRECLASIFICACION' . $idpreclasificacion;
            
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);

            //  echo "nombre ".$_FILES["file"]["name"];
            if (isset($_FILES["file"]["name"])) 
            {
                $destino = getcwd() . "/public/uploads/file/";

                if (!is_dir($destino)) 
                {
                    mkdir($destino, 0777, true);
                }

                $extension = explode(".", $_FILES["file"]["name"]);
                $nombre = time() . "-plantilla." . $extension[1];

                if (move_uploaded_file($_FILES['file']['tmp_name'], $destino . "/" . $nombre)) 
                {
                    $link = $destino . "/" . $nombre;
                }
                else 
                {

                }

                $object = PHPExcel_IOFactory::load($link);               
                
                foreach ($object->getWorksheetIterator() as $worksheet) 
                {
                    
                    $DAI                    = 0;
                    $IVA                    = 0;
                    $MANEJO	                = 0;
                    $Cobro_final            = 0;
                    $DUI                    = '';

                    $highestRow         = $worksheet->getHighestRow();
                    $highestColumn      = $worksheet->getHighestColumn();
                    $tracking_number    = '';
                    for ($row = 2; $row <= $highestRow; $row++) 
                    {
                        //echo 'recorriendfo el ciclo';
                        $tracking_number        = $worksheet->getCellByColumnAndRow(1,  $row)->getValue();
                        $DUI                  = $worksheet->getCellByColumnAndRow(17,  $row)->getValue();
 
                        if($tracking_number != '')
                        {
                            $this->WhModel->update_DUI($idpreclasificacion,$tracking_number, $DUI);
                        }
                        else  
                        {
                            exit;
                        }                        
                    }
                }
            }
        }
        
         public function reemplazar_tracking($id, $tracking_number, $tracking_replace)
        {
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);   

            $data   =   array(
                                'tracking_number'    =>  $tracking_number,
                                'tracking_replace'   =>  $tracking_replace,
                                'id_item'            =>  $id,
                        );

            $this->WarehouseModel->reemplazar_tracking($data, $tracking_number);
            $this->WarehouseModel->actualizar_tracking($tracking_number, $tracking_replace);
        }

        public function historial($tracking_number)
        {
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);   

            $this->datos['historial'] = $this->WarehouseModel->historial($tracking_number);
            $this->load->view("preclasifica/historial", $this->datos);
        }
        

        public function cargar_referencia()
        {
            $this->load->view("awb/cargar_referencia");
        }
    
        public function upload_file_referencia($idpreclasificacion)
        {
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);

            //  echo "nombre ".$_FILES["file"]["name"];
            if (isset($_FILES["file"]["name"])) 
            {
                $destino = getcwd() . "/public/uploads/file/";

                if (!is_dir($destino)) 
                {
                    mkdir($destino, 0777, true);
                }

                $extension = explode(".", $_FILES["file"]["name"]);
                $nombre = time() . "-plantilla." . $extension[1];

                if (move_uploaded_file($_FILES['file']['tmp_name'], $destino . "/" . $nombre)) 
                {
                    $link = $destino . "/" . $nombre;
                } 
                else 
                {

                }

                $object = PHPExcel_IOFactory::load($link);               
            
                foreach ($object->getWorksheetIterator() as $worksheet) 
                {
                    $highestRow    = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();

             
                for ($row = 2; $row <= $highestRow; $row++) 
                {
                    $awb                = $worksheet->getCellByColumnAndRow(0,  $row)->getValue(); // Master
                    $tracking_number    = $worksheet->getCellByColumnAndRow(1,  $row)->getValue(); // Tracking
                    $referencia         = $worksheet->getCellByColumnAndRow(2,  $row)->getValue();
                    $invoice            = $worksheet->getCellByColumnAndRow(3,  $row)->getValue();
                    $consignee_id       = $worksheet->getCellByColumnAndRow(4,  $row)->getValue();
                    $consignee          = $worksheet->getCellByColumnAndRow(5,  $row)->getValue();
                    $phone              = $worksheet->getCellByColumnAndRow(6,  $row)->getValue();
                    $email              = $worksheet->getCellByColumnAndRow(7,  $row)->getValue(); // Referencia
                    //$referencia         = $worksheet->getCellByColumnAndRow(26,  $row)->getValue();
                    $id_manifiesto      = $idpreclasificacion;

                    $data   =   array(
                                    'awb'               => $awb,
                                    'tracking_number'   => $tracking_number,
                                    'referencia'        => $referencia,
                                    'id_manifiesto'     => $id_manifiesto,
                                );
                    // var_dump($data);
                    $this->WarehouseModel->guardar_referencia($awb, $tracking_number, $referencia, $id_manifiesto );
                }
            }
        }
    }
    
     public function lista_sobrantes()
        {
            $this->load->view("awb/lista");
        }
    
        public function upload_file_sobrante($idpreclasificacion)
        {
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);

            //  echo "nombre ".$_FILES["file"]["name"];
            if (isset($_FILES["file"]["name"])) 
            {
                $destino = getcwd() . "/public/uploads/file/";

                if (!is_dir($destino)) 
                {
                    mkdir($destino, 0777, true);
                }

                $extension = explode(".", $_FILES["file"]["name"]);
                $nombre = time() . "-plantilla." . $extension[1];

                if (move_uploaded_file($_FILES['file']['tmp_name'], $destino . "/" . $nombre)) 
                {
                    $link = $destino . "/" . $nombre;
                } 
                else 
                {

                }

                $object = PHPExcel_IOFactory::load($link);               

                foreach ($object->getWorksheetIterator() as $worksheet) 
                {
                    $highestRow    = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();

                    for ($row = 2; $row <= $highestRow; $row++) 
                    {
                        $tracking_number                = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $gweight                        = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $value                          = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $items                          = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $commodity                      = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $consignee_account              = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $consignee                      = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $buyer_company                  = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $consignee_address1             = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $buyer_address1_number          = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $consignee_address2             = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $consignee_address3             = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $buyer_district                 = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $consignee_city                 = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $consignee_state                = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        $consignee_country              = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                        $consignee_zip                  = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                        $consignee_phone                = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                        $consignee_email                = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                        $hts                            = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                        $id_pais                        = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                        $pieces                         = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                        $departamento                   = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
                        $municipio                      = $worksheet->getCellByColumnAndRow(23, $row)->getValue();
                        $wpounds                        = $worksheet->getCellByColumnAndRow(24, $row)->getValue();
                        $id_manifiesto                  = $idpreclasificacion;
                        $sobrante                       = 1;

                        $datas = array(
                                        'id_manifiesto'          =>       $id_manifiesto,
                                        'tracking_number'        =>       $tracking_number,
                                        'gweight'                =>       $gweight,
                                        'value'                  =>       $value,
                                        'items'                  =>       $items,
                                        'commodity'              =>       $commodity,
                                        'consignee_account'      =>       $consignee_account,
                                        'consignee'              =>       $consignee,
                                        'buyer_company'          =>       $buyer_company,
                                        'consignee_address1'     =>       $consignee_address1,
                                        'buyer_address1_number'  =>       $buyer_address1_number,
                                        'consignee_address2'     =>       $consignee_address2,
                                        'consignee_address3'     =>       $consignee_address3,
                                        'buyer_district'         =>       $buyer_district,
                                        'consignee_city'         =>       $consignee_city,
                                        'consignee_state'        =>       $consignee_state,
                                        'consignee_country'      =>       $consignee_country,
                                        'consignee_zip'          =>       $consignee_zip,
                                        'consignee_phone'        =>       $consignee_phone,
                                        'consignee_email'        =>       $consignee_email,
                                        'hts'                    =>       $hts,
                                        'id_pais'                =>       $id_pais,
                                        'pieces'                 =>       $pieces,
                                        'departamento'           =>       $departamento,
                                        'municipio'              =>       $municipio,
                                        'sobrante'               =>       $sobrante,
                                        'wpounds'                =>       $wpounds,    
                        );
                        //$dato = json_encode($datas);
                        //var_dump($dato);
                        $this->WhModel->guardar_listsobrante($tracking_number, $datas, $id_manifiesto);
                    }
                }
            }
    }
   
    public function asignar_ref($idpreclasificacion)
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);   
    
        $this->datos['refxbolsa']       = $this->WhModel->bolsa_ref($idpreclasificacion);
        $this->datos['manifiesto']      = $this->WhModel->crear_ref($idpreclasificacion);
        $this->load->view("catalogos/asg_ref", $this->datos);
    }
    
    public function update_ref_bolsa($referencia, $bolsas)
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);   
    
        $this->WhModel->update_ref_bolsa($referencia, $bolsas);
    }     
}