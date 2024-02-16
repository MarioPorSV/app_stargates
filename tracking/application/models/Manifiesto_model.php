<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Manifiesto_model extends CI_Model
{
    public function guardar_manifiesto($data){
         $this->db->insert('preclasificacion', $data);
         return $this->db->insert_id();
    }

    public function guardar_manifiesto_detalle($data){
     $this->db->insert('manifiesto', $data);
     return $this->db->insert_id();
}

    public function guardar_estatus($data){
         $this->db->insert('detalle', $data);
         return $this->db->insert_id();
    }
	
	public function guardar_ios($data){
         $this->db->insert('manifiesto', $data);
         return $this->db->insert_id();
    }

    
   
}


/* End of file ModelName.php */
