<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class ClientesController extends CI_Controller {
            
        public function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->load->model('ClientesModel');
          
        }
        public function clientes()
        {
        
        $this->datos['cliente'] = $this->ClientesModel->clientes();
       

        $this->load->view("clientes/vista_clientes", $this->datos);

          
        }


        
    

}   /* End of file Controllername.php */
        

?>