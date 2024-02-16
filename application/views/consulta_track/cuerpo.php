<?php
    if (isset($tracking_numb)) 
    {
        $c = 1;
        foreach ($tracking_numb as $row) 
        { 
?>
            <tr class="rw ">
                <td scope="row" style="display:none"><?php echo $row->id; ?></td>
                <td style="margin-left: 9px ; "><?php echo $c; ?></td>
                <td scope="row"><?php echo $row->awb; ?></td>
                <td scope="row"><?php echo $row->referencia; ?></td>
                <td scope="row"><?php echo $row->tracking_number; ?></td>
                <td scope="row"><?php echo $row->tracking_replace; ?></td>
                <td scope="row"><?php echo $row->gweight . ' lb';  ?></td>
                <td scope="row"><?php echo $row->value; ?></td>
                <td scope="row"><?php echo $row->items; ?></td>
                <td scope="row" style="width:100px"><?php echo $row->commodity; ?></td>
                <td scope="row"><?php echo $row->id_partida; ?></td>
                <td scope="row"><?php echo $row->consignee_account; ?></td>
                <td scope="row"><?php echo utf8_decode($row->consignee); ?></td>
                <td scope=""> <?php echo utf8_decode($row->consignee_address1); ?></td>
                <td scope="row"><?php echo utf8_decode($row->consignee_city); ?></td>
                <td scope="row"><?php echo utf8_decode($row->consignee_state); ?></td>
                <td scope="row"><?php echo $row->consignee_phone; ?></td>
                <td scope="row"><?php echo $row->consignee_email; ?></td>
                <td scope="row"><?php echo $row->hts; ?></td>
                <td scope="row"><?php echo $row->pieces; ?></td>
                <td scope="row" class="font-weight-bold text-danger"><?php echo $row->numero_partida; ?></td>
                <td scope="row" class="font-weight-bold text-danger"><?php echo $row->descripcion_producto; ?></td>
                <td scope="row" class="font-weight-bold text-primary"><?php echo $row->departamento; ?></td>
                <td scope="row" class="font-weight-bold text-primary"><?php echo $row->municipio; ?></td>
                <td scope="row"><?php echo $row->tipo_entrega; ?></td>
                <td scope="row"><?php echo $row->tipo_servicio; ?></td>
                <td scope="row"><?php echo '$' . number_format($row->cobro_final,2); ?></td>
                <td scope="row"><?php echo $row->pickup_number; ?></td>
                <td scope="row"><?php echo $row->internal_tracking; ?></td>
                <?php if($row->id_estatus=="15")
                    {
                        echo '<td scope="row" class="font-weight-bold text-success">SI</td>';
                    }
                    else
                    {
                        echo '<td scope="row" class="font-weight-bold text-danger">NO</td>';
                    }
                ?>
         
                <?php 
                    if($row->facturado == "1")
                    {
                        echo '<td scope="row" class="font-weight-bold text-success">FACTURADO</td>';
                    }
                    else
                    {
                        echo '<td scope="row" class="font-weight-bold text-danger">PENDIENTE</td>';
                    }
                ?>
            </tr>



<?php
            $c = $c + 1;
        }
    }
?>
