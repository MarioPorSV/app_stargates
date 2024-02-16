<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods:GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, x-xsrf-token');

defined('BASEPATH') or exit('No direct script access allowed');
//include getcwd() . "/libraries/RestController.php";

require(APPPATH . '/libraries/REST_Controller.php');
//use Restserver\Libraries\RestController;
class Api extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Casillero_model');
        $this->load->model('Warehouse_model');
        $this->load->model('Usuario_model');
        $this->load->model('Manifiesto_model');
        $this->load->model('Cotizador_model');
    }

    public function casillero_get()
    {
        $id = $this->uri->segment(3);

        if (!isset($id)) {
            $respuesta = array(
                'err' => true,
                'mensaje' => 'Es necesario el número de casillero'
            );
            $this->response($respuesta, REST_Controller::HTTP_BAD_REQUEST);
            return;
        }

        if ($id == " ") {
        } else {
            $id = str_replace("%20", " ", $id);
        }
        $casillero = $this->Casillero_model->get_casillero($id);
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
                'mensaje' => 'El casillero con el número ' . $id . ', no existe ',
                'casillero' => null
            );
            $this->response($respuesta, REST_Controller::HTTP_NOT_FOUND);
        }
    }


    public function warehouse_get()
    {
        $id = $this->uri->segment(3);

        if (!isset($id)) {
            $respuesta = array(
                'err' => true,
                'mensaje' => 'Es necesario el número de warehouse'
            );
            $this->response($respuesta, REST_Controller::HTTP_BAD_REQUEST);
            return;
        }

        if ($id == " ") {
        } else {
            $id = str_replace("%20", " ", $id);
        }
        $warehouse = $this->Warehouse_model->get_warehouse($id);

        if (($warehouse)) {
            $respuesta = array(
                'err' => false,
                'mensaje' => 'Registro cargado correctamente',
                'cliente' => $warehouse
            );
            $this->response($respuesta);
        } else {
            $respuesta = array(
                'err' => true,
                'mensaje' => 'El warehouse ' . $id . ', no existe ',
                'warehouse' => null
            );
            $this->response($respuesta, REST_Controller::HTTP_NOT_FOUND);
        }
    }


    public function estatus_get()
    {
        $id = $this->uri->segment(3);

        if (!isset($id)) {
            $respuesta = array(
                'err' => true,
                'mensaje' => 'Es necesario el número de warehouse'
            );
            $this->response($respuesta, REST_Controller::HTTP_BAD_REQUEST);
            return;
        }

        if ($id == " ") {
        } else {
            $id = str_replace("%20", " ", $id);
        }
        $warehouse = $this->Warehouse_model->get_estatus($id);

        if (($warehouse)) {
            $respuesta = array(
                'err' => false,
                'mensaje' => 'Registro cargado correctamente',
                'cliente' => $warehouse
            );
            $this->response($respuesta);
        } else {
            $respuesta = array(
                'err' => true,
                'mensaje' => 'El warehouse ' . $id . ', no existe ',
                'warehouse' => null
            );
            $this->response($respuesta, REST_Controller::HTTP_NOT_FOUND);
        }
    }



    public function correo_get()
    {
        $id = $this->uri->segment(3);

        if (!isset($id)) {
            $respuesta = array(
                'err' => true,
                'mensaje' => 'Es necesario el número de warehouse'
            );
            $this->response($respuesta, REST_Controller::HTTP_BAD_REQUEST);
            return;
        }

        if ($id == " ") {
        } else {
            $id = str_replace("%20", " ", $id);
        }
        $warehouse = $this->Warehouse_model->get_estatus($id);

        if (($warehouse)) {
            $respuesta = array(
                'err' => false,
                'mensaje' => 'Registro cargado correctamente',
                'cliente' => $warehouse
            );
            $this->response($respuesta);
        } else {
            $respuesta = array(
                'err' => true,
                'mensaje' => 'El warehouse ' . $id . ', no existe ',
                'warehouse' => null
            );
            $this->response($respuesta, REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function login_get()
    {
        $email = $this->uri->segment(3);
        $pass = $this->uri->segment(4);


        $datosparm = array(

            'correo' => $email,

            'clave'   =>  $pass,

        );


        $credenciales = $this->Usuario_model->getLogin($datosparm);

        if (($credenciales)) {
            $respuesta = array(
                'err' => false,
                'mensaje' => 'las credenciales son correctas',
                'login' => $credenciales
            );
            $this->response($respuesta);
        } else {
            $respuesta = array(
                'err' => true,
                'mensaje' => 'Credenciales incorrectas ',
                'login' => null
            );
            $this->response($respuesta, REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function password_post()
    {
        $data = $this->post();

        $this->load->library('form_validation');

        $this->form_validation->set_data($data);


        if ($this->form_validation->run('password_post')) {

            $hecho = $this->Usuario_model->update_password($data);

            if ($hecho == true) {
                $respuesta = array(
                    'err' => FALSE,
                    'mensaje' => 'Registro actualizado correctamente',
                );

                $this->response($respuesta);
            } else {
                $respuesta = array(
                    'err' => TRUE,
                    'mensaje' => 'Error al actualizar',
                );

                $this->response($respuesta);
            }
        } else {
            $respuesta = array(
                'err' => TRUE,
                'mensaje' => 'Hay errores en el envio de informacion',
                'errores' => $this->form_validation->get_errores_arreglo()
            );

            $this->response($respuesta, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function mail_post()
    {
        $data = $this->post();

        $this->load->library('form_validation');

        $this->form_validation->set_data($data);
        // $casillero = $this->uri->segment(3);
        //$casillero = 'SAL 50005';
        //$data['casillero'] = $casillero;

        if ($this->form_validation->run('mail_post')) {

            $hecho = $this->Usuario_model->update_correo($data);

            if ($hecho == true) {
                $respuesta = array(
                    'err' => FALSE,
                    'mensaje' => 'Registro actualizado correctamente',
                );

                $this->response($respuesta);
            } else {
                $respuesta = array(
                    'err' => TRUE,
                    'mensaje' => 'Error al actualizar',
                );

                $this->response($respuesta);
            }
        } else {
            $respuesta = array(
                'err' => TRUE,
                'mensaje' => 'Hay errores en el envio de informacion',
                'errores' => $this->form_validation->get_errores_arreglo()
            );

            $this->response($respuesta, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function sucursal_post()
    {
        $data = $this->post();

        $this->load->library('form_validation');

        $this->form_validation->set_data($data);


        if ($this->form_validation->run('sucursal_post')) {

            $hecho = $this->Usuario_model->update_sucursal($data);

            if ($hecho == true) {
                $respuesta = array(
                    'err' => FALSE,
                    'mensaje' => 'Registro actualizado correctamente',
                );

                $this->response($respuesta);
            } else {
                $respuesta = array(
                    'err' => TRUE,
                    'mensaje' => 'Error al actualizar',
                );

                $this->response($respuesta);
            }
        } else {
            $respuesta = array(
                'err' => TRUE,
                'mensaje' => 'Hay errores en el envio de informacion',
                'errores' => $this->form_validation->get_errores_arreglo()
            );

            $this->response($respuesta, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function registro_put()
    {

        $data = $this->put();

        $this->load->library('form_validation');

        $this->form_validation->set_data($data);
        if ($this->form_validation->run('registro_put')) {

            $registro = array(
                'nombre' => $data['nombre'],
                'correo' => $data['correo'],
                'telefono' => $data['telefono'],


            );

            $hecho = $this->Manifiesto_model->guardar_ios($registro);
            if ($hecho) {
                $respuesta = array(
                    'err' => FALSE,
                    'mensaje' => 'Registro insertado correctamente',
                    'registro_id' => $this->db->insert_id()
                );
                $this->response($respuesta);
            } else {
            }
        } else {
            $respuesta = array(
                'err' => TRUE,
                'mensaje' => 'Hay errores en el envio de informacion',
                'errores' => $this->form_validation->get_errores_arreglo()
            );

            $this->response($respuesta, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function obtner_sucursales_get()
    {

        $sucursal = $this->Casillero_model->obtner_sucursales();


        if (($sucursal)) {
            $respuesta = array(
                'err' => false,
                'mensaje' => 'Consulta realizada correctamente',
                'sucursal' => $sucursal
            );
            $this->response($respuesta);
        } else {
            $respuesta = array(
                'err' => true,
                'mensaje' => 'No ha sipo posile obtener registros ',
                'sucursal' => null
            );
            $this->response($respuesta, REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function obtener_arancel_get()
    {

        $arancel = $this->Cotizador_model->obtner_arancel();

        //  var_dump( $arancel);
        if (($arancel)) {
            $respuesta = array(
                'err' => false,
                'mensaje' => 'Consulta realizada correctamente',
                'arancel' => $arancel
            );
            $this->response($respuesta);
        } else {
            $respuesta = array(
                'err' => true,
                'mensaje' => 'No ha sipo posile obtener registros ',
                'arancel' => null
            );
            $this->response($respuesta, REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function calcular_get()
    {
        $peso = $this->uri->segment(3);
        $valor = $this->uri->segment(4);
        $tipo_menrcancia = $this->uri->segment(5);

        $arancelcot = $this->Cotizador_model->get_arancel($tipo_menrcancia);
        $flete = $this->Cotizador_model->get_flete($peso);
        $tramite = $this->Cotizador_model->get_tramite($valor);
        $seguro = $this->Cotizador_model->get_seguro($valor);
        // $almacenaje = $this->Cotizador_model->get_almacenaje($peso);
        //var_dump($almacenaje);
        $tarifa_flete = $flete->valor_libra;
        $tarifa_tramite = $tramite->valor_tramite;
        $tarifa_seguro = $seguro->valor_seguro;
        $rango_almacenaje = 0; //$almacenaje->valor_almacenaje;
        $peso_cotizar = $peso;


        $costolibras = $tarifa_flete * $peso_cotizar;
        $costotramite = $tarifa_tramite;
        $costoseguro = $tarifa_seguro;
        $primaseguro = $valor * 0.015;

        $costototal = $costolibras + 0 + $valor;
        $totdai = ($costototal  + $costoseguro) * ($arancelcot->porcentaje / 100);
        $totiva = ($costototal + $costoseguro) * 0.13;
        $impuesto = 0;

        if ($valor < 200) {

            $impuesto = number_format(($totiva), 2);
        } else {
            $impuesto = number_format(($totdai + $totiva), 2);
        }
        $corteguia = 0;
        $transferenciaymanejo = 0;
        $cesc = 0;
        $inspeccionointrusiva = 0;
        $totalsts = 0;
        //Inspecci¨®n no intrusiva
        $inspeccionointrusiva = 0;
        //CESC
        if ($arancelcot->cesc == 1) {
            $cesc = ($costototal + $totdai) * ($arancelcot->porcentaje_cesc / 100);
        } else {
            $cesc = 0;
        }
        $totalsts = number_format($impuesto, 2) + number_format($costotramite, 2) + number_format($costolibras, 2) + number_format($corteguia, 2) + number_format($transferenciaymanejo, 2) + number_format($inspeccionointrusiva, 2)  + number_format($rango_almacenaje, 2);
        // +   +  + number_format($almacenaje,2)
        $total = 0;
        //Total
        //  echo $valor+$totalsts;
        $total = $totalsts + $valor + $costoseguro - $rango_almacenaje;
        // $total=number_format($total,2);

        if (($total)) {
            $respuesta = array(
                'err' => false,
                'mensaje' => 'Cálculo realizado correctamente',
                'calculo_estimado' => $total,
                'valor_articulo' => $valor,
                'envio' => $costolibras,
                'seguro' => $costoseguro,
                'impuesto' => $impuesto,
                'costo_tramite' => $costotramite


            );
            $this->response($respuesta);
        } else {
            $respuesta = array(
                'err' => true,
                'mensaje' => 'No ha sido posible calcular el producto ',
                'total' => null
            );
            $this->response($respuesta, REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function addmanifiesto_post()
    {

        $data = $this->post();
        $country = 2;
        $awb = $data['awb'];
        $pais=$data['country'];
        $enca = array(
            'manifiesto' => $data['awb'],
            'fecha' => $data['fecha'],
            'descripcion' => "Pruebas API",
            'referencia' => "Pendiente",
            'paquetes' => "0",
            'sacos' => $data['bag'],
            'tipo' => "ALL",
            'client_id' => $data['client_id'],
            'id_pais' => $country,
            'userid' => $data['client_id']

        );
        $id_manifiesto =  $this->Manifiesto_model->guardar_manifiesto($enca);
       
       
      
        if ($id_manifiesto) {

            foreach ($data['guias'] as $key => $detalle) {
             
               $deta = array(
                    'id_manifiesto'          => $id_manifiesto,
                    'tracking_number'        => $detalle['tracking_number'],
                    'weight'                 => $detalle['weight'],
                    'value'                  => $detalle['value'],
                    'items'                  => $detalle['items'],
                    'items_description'      => $detalle['items_description'],
                    'buyer_id'               => $detalle['buyer_id'],
                    'buyer'                  => $detalle['buyer'],
                    'buyer_company'          => $detalle['buyer_company'],
                    'buyer_address1'         => $detalle['buyer_address1'],
                    'buyer_address1_number'  => $detalle['buyer_address1_number'],
                    'buyer_address2'         => $detalle['buyer_address2'],
                    'buyer_address3'         => $detalle['buyer_address3'],
                    'buyer_district'         => $detalle['buyer_district'],
                    'buyer_city'             => $detalle['buyer_city'],
                    'buyer_state'            => $detalle['buyer_state'],
                    'buyer_location'         => $detalle['buyer_location'],
                    'buyer_zip'              => $detalle['buyer_zip'],
                    'buyer_phone'            => $detalle['buyer_phone'],
                    'buyer_email'            => $detalle['buyer_email'],
                    'hts'                    => $detalle['hts'],
                    'pieces'                 => $detalle['pieces'],  

                );
                $hecho = $this->Manifiesto_model->guardar_manifiesto_detalle($deta);
            }
           
            if ($hecho) {
                $respuesta = array(
                    'err' => FALSE,
                    'mensaje' => 'Registro insertado correctamente',
                    
                );
                $this->response($respuesta);
            }
        }
    }
    /* public function addmanifiesto_post()
    {

        $data = $this->post();

        $this->load->library('form_validation');

        $this->form_validation->set_data($data);
        if ($this->form_validation->run('addmanifiesto_post')) {



            $hecho = $this->Manifiesto_model->guardar_manifiesto($data);
            if ($hecho) {
                $respuesta = array(
                    'err' => FALSE,
                    'mensaje' => 'Registro insertado correctamente',
                    'registro_id' => $this->db->insert_id()
                );
                $this->response($respuesta);
            } else {
            }
        } else {
            $respuesta = array(
                'err' => TRUE,
                'mensaje' => 'Hay errores en el envio de informacion',
                'errores' => $this->form_validation->get_errores_arreglo()
            );

            $this->response($respuesta, REST_Controller::HTTP_BAD_REQUEST);
        }
    }*/
}

/* End of file Controllername.php */