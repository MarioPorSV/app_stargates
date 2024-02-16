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

    
    public function tarifas()
    {
        $query = $this->db->select('*')
        ->where('id_pais',2)
        ->get('tarifas')
        ->result();
        return $query;
    }
    
    //log Mail Americas
    public function guardar_logma( $data ) {

        $this->db->insert( 'log_ma', $data );
        return $this->db->insert_id();

    }
    
    public function guardar_json($datos){
         $this->db->insert( 'j_son', $datos );
        return $this->db->insert_id();
    }
    
    /* Bloque para valores, vienen desde c807xpress/servicios*/
     //log Mail Americas
    public function guardar_ticket( $data ) {

        $this->db->insert( 'gestiontickets.detalles', $data );
        return $this->db->insert_id();

    }
    
    public function consulta_tikets(){
              //obtiene los tikets de la empresa 3=c807xpress
        $rsl = $this->db
            ->select('de.*,de.fecha,em.nombre nombre_empresa,
              pr.nombre nombre_proceso,
              si.nombre nombre_sistema,
              es.nombre nombre_estado,
              co.nombre nombre_colaborador,
              ca.nombre nombre_categoria,
              pi.nombre nombre_prioridad')
            ->join('gestiontickets.empresas em'      , 'em.id = de.empresa_id')
            ->join('gestiontickets.procesos pr'      , 'pr.id = de.proceso_id')
            ->join('gestiontickets.sistemas si'      , 'si.id = de.sistema_id')
            ->join('gestiontickets.estados es'       , 'es.id = de.estado_id')
            ->join('gestiontickets.colaboradores co' , 'co.id = de.colaborador_id')
            ->join('gestiontickets.categorias ca'    , 'ca.id = de.categoria_id')
            ->join('gestiontickets.prioridades pi'   , 'pi.id = de.prioridad_id')
            ->where('de.empresa_id', 3)
            ->where('es.id <> ', 7)
            ->get('gestiontickets.detalles de')
            ->result();
        return $rsl;
    }

     public function guia_alternativa($guia){
          $query = $this->db->select('*')
        ->where('tracking_replace',$guia)
        ->get('reemplazo')
        ->result();
        return $query;
    }
    
      public function update_estatus($wh, $estatus) {
     	$this->db
        ->set('id_estatus', $estatus)
        ->where('tracking_number', $wh)
        ->update('manifiesto');

       
    }
   
}


/* End of file ModelName.php */
