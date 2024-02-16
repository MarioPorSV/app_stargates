<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Pw_model extends CI_Model {
    
        public function verificar_cuenta($nit)
        {
            $query = $this->db
             ->select('casillero,nit')
             ->where('nit', $nit)
             ->get('clientes')
             ->row();
           // $row=$query->custom_row_object(0,'Casillero_model');
           
            return $query;
        }
    
    
    }
    
    /* End of file ModelName.php */
    
?>
