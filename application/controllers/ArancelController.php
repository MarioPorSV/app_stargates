<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ArancelController extends CI_Controller
{

  //Funcion Constructor en esta funcion se agregan todos los modelos que se usaran en el sitio
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->database();
    $this->load->model('Arancel_Model');
    $this->load->model('Conf_model');

    $_SESSION['pais_id'] = 2; //El Salvador
    //  $_SESSION['pais_id']=3;  //Honduras
    if (isset($_SESSION['pais_id'])) {
      $this->pais = $_SESSION['pais_id'];
    } else {
      $this->pais = 0;
    }
  }

  //En esta funcion muestra todos los datos de la tabla
  public function listado_partida()
  {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $this->datos['catalogopermisos'] = $this->Conf_model->catalogo_permisos();
    $datos['partidas'] = $this->Arancel_Model->partidas_creadas();
    $this->load->view("arancel/lista", $datos);
  }

  //Funcion para Ingresar al boton de Agregar 
  public function agregar_partida($id)
  {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $datos['origen'] = $this->Conf_model->get_paises();
   
    $datos['datos_partida'] = $this->Arancel_Model->editar_partidas($id);
    $this->load->view('arancel/form', $datos);
  }

  // Funcion para Guardar los registros del formulario de partidas
  public function insertar_partidas()
  {

    //Muestra Error en el Codigo
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $ID              =    $_POST["id_arancel"];

    //Enviamos los datos por medio del metodo POST

    //Variable             Nombre segun input
    $codigo_producto =    $_POST["codigo_producto"];
    $numeroPartida   =    $_POST["numeroPartida"]; //  indica que viene valor de  formularios 
    $descripcion     =    $_POST["descripcion"];
   
  


    //los datos son enviados por una cadena de datos
    //Los datos deben llamarse segun tabla 
    $data = array(
      'codigo_producto'  =>  $codigo_producto,
      'numero_partida'   =>  $numeroPartida,
      'descripcion'      =>  $descripcion,
    

    );

    // var_dump($data);
    $this->Arancel_Model->insertar_partidas($data, $ID);
  }

  //Funcion para guardar partidas editadas
  public function guardar_partida($ID)
  {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    $ID              =  NULL;
    $numeroPartida   =     0;
    $descripcion     =    '';
    $origen          =    '';
    $anulado         =     0;

    //Enviamos los datos por medio del metodo POST

    //Variable             Nombre segun input
    $numeroPartida   =    $_POST["numeroPartida"]; //  indica que viene valor de  formularios 
    $descripcion     =    $_POST["descripcion"];
    $origen          =    $_POST["origen"];
    $anulado         =    $_POST["anulado"];

    //los datos son enviados por una cadena de datos
    //Los datos deben llamarse segun tabla 
    $data = array(
      'numero_partida'   =>  $numeroPartida,
      'descripcion'      =>  $descripcion,
      'id_origen'        =>  $origen,
      'anulado'          =>  $anulado
    );

    $datos = $this->Arancel_Model->guardar_partidas($ID);
    $this->load->view("arancel/lista", $datos);
  }

  //Esta funcion se encarga de eliminar el campo de las partidas
  public function eliminar_partida($ID)
  {
    if ($this->Arancel_Model->eliminar_partida($ID)) {
    } else {
    }
  }
  public function listado_permisos($id)
  {
    $datos['lista_p']    = $this->Arancel_Model->listado_permisos($id);
    $this->load->view('arancel/cuerpo_permisos', $datos);
  }

  public function agregar_permiso($permiso, $id)
  {
    $data = array(

      'idpermiso'           => $permiso,

      'partida'              => $id

    );

    $result = $this->Arancel_Model->verificar_permiso($permiso, $id);
    if ($result) {
    } else {
      $result = $this->Arancel_Model->agregar_permiso($data);
      echo $result;
    }
  }


  public function eliminar_permiso($id)
  {
    $this->Arancel_Model->eliminar_permiso($id);
  }
}
