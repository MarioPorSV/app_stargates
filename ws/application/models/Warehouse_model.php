<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Warehouse_model extends CI_Model
{
    public function get_warehouse($id)
    {
        $query = $this->db
         ->where('idwarehouse', $id)
         ->get('warehouse_detalle')
         ->row();
       // $row=$query->custom_row_object(0,'Casillero_model');
       
        return $query;
    }

    public function get_estatus($id)
    {
      

        $query = $this->db
        ->select('de.fecha, de.warehouse,de.id_estatus, es.nombre as descripcion, de.casillero')
        ->join('estatus es', 'es.id_estatus = de.id_estatus', 'inner')
        ->where('de.warehouse', $id)
        ->get('detalle de')
        ->result();
        return $query;

    }
}

/* End of file ModelName.php */
