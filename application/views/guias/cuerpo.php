<?php $i = 1;
    
    foreach ($tracking as $row) : ?>
        <tr>
            <td style="font-size: 14px;"> <?php echo $i ?></td>
            <td style="font-size: 14px;"> <?php echo $row->awb ?></td>
            <td style="font-size: 14px;"> <?php echo $row->referencia ?></td>
            <td style="font-size: 14px;"> <?php echo $row->tracking_number ?></td>
            <td style="font-size: 14px;"> <?php echo $row->tracking_replace ?></td>
            <td style="font-size: 14px;"> <?php echo date("d-m-Y", strtotime($row->fecha_creacion)) ?></td>
            <td style="font-size: 14px;"> <?php echo $row->consignee ?> </td>
            <td style="font-size: 14px;"> <?php echo $row->departamento_name ?> </td>
            <td style="font-size: 14px;"> <?php echo $row->municipio_name ?> </td>
            <td style="font-size: 14px;"> <?php echo $row->tipo_entrega ?> </td>
            <td style="font-size: 14px;"> <?php echo $row->tipo_servicio ?> </td>
            <td style="font-size: 14px;"> <?php echo $row->estatus ?> </td>
            <td style="font-size: 14px;"> <?php echo $row->estado ?> </td>
            <td style="font-size: 14px;"> <?php echo $row->POD ?> </td>
            <td style="font-size: 14px;"> <?php echo '$'.number_format($row->cobro_final, 2) ?> </td>
        </tr>
<?php $i = $i + 1; endforeach ?>

<script>
     $(document).ready(function() 
    {
        $("#tbl_listadoguias").DataTable({
                "retrieve"     : true, 
                "paging"       : true,
                "searching"    : true,
                "ordering"     : true,
                "info"         : true,
                "language"     : 
            {
                "lengthMenu"   : "Mostrar _MENU_ registros por página",
                "zeroRecords"  : "No se encontraron datos que mostrar",
                "info"         : "Mostrando Página _PAGE_ de _PAGES_",
                "infoEmpty"    : "registros no disponibles",
                "infoFiltered" : "(filtered from _MAX_ total records)",
                "sSearch"      : "Buscar:",
                "oPaginate"    : 
              {
                "sFirst"       : "Primero",
                "sLast"        : "Último",
                "sNext"        : "Siguiente",
                "sPrevious"    : "Anterior",
              },
            },
                "lengthChange" : true,
                "buttons"      : ["copy", "csv", "excel", "print", "colvis"]
        }).buttons().container().appendTo('#tbl_listadoguias_wrapper .col-md-6:eq(0)');
    });
</script>