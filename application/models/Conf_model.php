<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Conf_model extends CI_Model
{
     public function guia_master()
     {
     }

     public function clientes()
     {
          $sts = $this->load->database('sts', true);
          $query = $sts->select('*')
               ->get('fichas_cliente')
               ->result();
          return $query;
     }

     public function estatus()
     {
          //  ->select('id_estatus,id_categoria, nombre, shortform, entrystandar')
          $query = $this->db
               ->select('id_estatus, nombre')
               ->get('estatus')
               ->result();
          return $query;
     }

     public function sucursales()
     {
          $query = $this->db
               ->select('*')
               ->get('sucursales')
               ->result();
          return $query;
     }

     public function courier()
     {
          $query = $this->db
               ->select('*')
               ->get('courier')
               ->result();
          return $query;
     }

     public function tipo_cuenta()
     {
          $query = $this->db
               ->select('*')
               ->get('tipo_cuenta')
               ->result();
          return $query;
     }
     public function tipo_documento()
     {
          $query = $this->db
               ->select('*')
               ->get('tipo_documento')
               ->result();
          return $query;
     }

     function opc_inventario()
     {
          $query = $this->db
               ->select('*')
               ->get('opc_inventario')
               ->result();
          return $query;
     }

     function get_servicios()
     {
          $query = $this->db
               ->select('*')
               ->get('servicios')
               ->result();
          return $query;
     }

     function get_departamentos()
     {
          $query = $this->db
               ->select('*')
               ->get('departamentos')
               ->result();
          return $query;
     }

     function get_municipios($id)
     {
          $query = $this->db
               ->select('*')
               ->where('id_departamento', $id)
               ->get('municipios')
               ->result();
          return $query;
     }

     function get_referencia($id)
     {
          $query = $this->db
               ->select('id,referencia')
               ->where('id_manifiesto', $id)
               ->get('referencia')
               ->result();
          return $query;
     }

     
     function get_paises()
     {
          $query = $this->db
               ->select('*')
               ->get('pais')
               ->result();
          return $query;
     }

     
    public function catalogo_permisos()
    {
        return $this->db->where("id_pais", $this->pais)
                        ->get("permiso")
                        ->result();
    }

     
    public function partidas()
    {
        return $this->db
        ->select('id,numero_partida, descripcion')
        ->where("id_pais", $this->pais)
                        ->get("partida_arancel")
                        ->result();
    }
    
     public function transportista_fast()
     {
          $query = $this->db
                        ->select('*')
                        ->get('transportista')
                        ->result();
          return $query;
     }
}
   /* End of file ModelName.php */