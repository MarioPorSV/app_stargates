<?php
    
    defined('BASEPATH') or exit('No direct script access allowed');
    
    class ClientesModel extends CI_Model
    {
        public function clientes()
        {
           
            $otherdb = $this->load->database('sts', TRUE);
           
            $query = $otherdb->select('*')
            ->get('fichas_cliente')
            ->result();
            return $query;
      
            //var_dump($query);
        }
      

        
    } //fin
