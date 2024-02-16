<div class="container-fluid m-top ">
    <div class="table-responsive">
        <table class="table custom-table" id="tbl-cuerpo">
            <thead>
                <tr>
                    <th scope="col"> # </td>
                    <th scope="col">Transportista</td>  
                    <th scope="col">Documento Transporte</td>
                    <th scope="col">Puerto Salida</td>
                    <th scope="col">Puerto Llegada</td>
                    <th scope="col">Fecha Salida</td>
                    <th scope="col">Viaje</td>
                    <th scope="col">Linea Master</td>
                    <th scope="col">Cantidad Tracking</td>
                    <th scope="col">Tracking Declaraciones</td>
                    <th scope="col">Num Reg Aduana</td>
                    <th scope="col">Fecha Registro</td>
                    <th scope="col">Usuario</td>
                    
                    <th scope="col" colspan="1">Acciones</td>

                </tr>
            </thead>
            <tbody>
                <div id="listaawb">
                    <?php
                        if (isset($lista)) 
                        {
                            $c = 1;
                            foreach ($lista as $row) 
                            { 
                    ?>
                            <tr class="rw">
                                <td scope="row" style="margin-left: 9px"><?php echo $c; ?></td>
                                <td scope="row"><?php echo $row->nombre_tra; ?></td>
                                <td scope="row"><?php echo $row->manifiesto; ?></td>
                                <td scope="row"><?php echo ''; ?></td>
                                <td scope="row"><?php echo ''; ?></td>
                                <td scope="row"><?php echo ''; ?></td>
                                <td scope="row"><?php echo ''; ?></td>
                                <td scope="row"><?php echo ''; ?></td>
                                <td scope="row"><?php echo ''; ?></td>
                                <td scope="row"><?php echo ''; ?></td>
                                <td scope="row"><?php echo ''; ?></td>
                                <td scope="row"><?php echo $row->fecha; ?></td>
                                <td scope="row"><?php echo $row->nombre; ?></td>
                                <td>
                                    <a href="#" class="btn btn-default btn-sm"  Onclick="lista_warehouse(<?php echo $row->idpreclasificacion ;?>,<?php echo "'$row->manifiesto'"; ?>, <?php echo 0; ?>)" title="Ver detalle..." style="margin:0px;">
                                        <i class="fas fa-search text-warning"></i></a>
                                </td>
                            </tr>
                    <?php
                            $c = $c + 1;
                        }
                    }
                    ?>
                </div>
            </tbody>
        </table>
    </div>
</div>
<script>
$(document).ready(function() 
    {
        $("#tbl-cuerpo").DataTable({
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
        }).buttons().container().appendTo('#tbl-cuerpo_wrapper .col-md-6:eq(0)');
    });

     $('#opciones').on('change', function() {
                opcion = this.value;
                if (opcion == 3 || opcion == 4 || opcion == 5) {
                    $("#f-ini").show();
                    $("#f-fin").show();
                    $("#b-buscar").show();
                    $("#buscar").hide();
                } else {
                    $("#f-ini").hide();
                    $("#f-fin").hide();
                    $("#b-buscar").hide();
                    $("#buscar").show();


                }
            });
</script>