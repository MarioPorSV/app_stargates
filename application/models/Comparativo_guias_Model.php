<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Comparativo_guias_Model extends CI_Model
{
    
    public function buscar_fecha_guia($fecha_desde_guia, $fecha_hasta_guia)
    {
        $rsl =	$this->db
                     ->select('preclasificacion.manifiesto as awb,
                               manifiesto.referencia,
                               manifiesto.tracking_number,
                               manifiesto.tracking_replace,
                               date_format(manifiesto.fecha_creacion, "%d-%m-%Y") AS fecha_creacion,
                               manifiesto.consignee,
                               manifiesto.departamento_name,
                               manifiesto.municipio_name,
                               manifiesto.tipo_entrega,
                               manifiesto.tipo_servicio,
                               estatus.nombre AS estatus,
                               (CASE
                                    WHEN manifiesto.facturado = 0 THEN "Pendiente"
                                    WHEN manifiesto.facturado = 1 THEN "Facturado"
                               END) AS estado,
                               (CASE
                                    WHEN manifiesto.id_estatus = 15 THEN "SI"
                                    WHEN manifiesto.id_estatus != 15 THEN "NO"
                               END) AS POD,
                               manifiesto.cobro_final')
                     ->JOIN('preclasificacion', 'preclasificacion.idpreclasificacion = manifiesto.id_manifiesto', 'INNER')    
                     ->JOIN('estatus', 'estatus.id_estatus =  manifiesto.id_estatus', 'LEFT')        
                    
                     ->WHERE("date_format(manifiesto.fecha_creacion, '%Y-%m-%d')>=", $fecha_desde_guia)
                     ->WHERE("date_format(manifiesto.fecha_creacion, '%Y-%m-%d')<=", $fecha_hasta_guia)
                     ->ORDER_BY('manifiesto.tracking_number')
                     ->get('manifiesto')
                     ->result();
        return $rsl;           
    }
}