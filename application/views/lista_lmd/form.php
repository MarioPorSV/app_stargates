<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "UTF-8">
    <meta http-equiv = "X-UA-Compatible" content="IE=edge">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "<?php echo base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel = "stylesheet" href = "<?php echo base_url(); ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel = "stylesheet" href = "<?php echo base_url(); ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <title></title>
</head>

<body>
    <div class="container">
        <div class="row">

            <div class="col">
                <br>
                <h2>Listado Manifiesto</h2>
            </div>

            <div class="col">
                <br>
                <button type="button" class="btn btn-dark btn-lg" onclick="agregar_manifiesto(0);">
                    <i class="fa fa-plus" aria-hidden="true"> </i> Crear</button>
            </div>

            <div class="container-fluid m-top">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-hover table-light table-responsive-sm" id="tbl_tipo_entrega">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Observaciones</th>
                                    <th colspan="3">Acciones</th>                         
                                </tr>
                            </thead>

                            <tbody id="tabla_tipo_entrega">
                            <?php
                                if (isset($listado_lmd)) 
                                {
                                    foreach ($listado_lmd as $row) 
                                    { 
                            ?>
                                        <tr>
                                            <td><?php echo $row->id; ?></td>
                                            <td><?php echo $row->fecha_manifiesto; ?></td>
                                          
                                            <td><?php echo $row->observaciones; ?></td>
                                            <td>
                                                <a href="#" class="btn btn-success btn-sm" onclick="ver_manifiesto(<?php echo ($row->id); ?>)" title="Ver Manifiesto" style="margin:0px;">
                                                    <i class="fa fa-th-list" aria-hidden="true"></i>
                                            </td>
                
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm" onclick="agregar_manifiesto(<?php echo ($row->id); ?>)" title="Editar Manifiesto" style="margin:0px;">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </td>

                                            <td>
                                                <a href="#" class="btn btn-danger btn-sm" onclick="eliminar_manifiesto(<?php echo ($row->id); ?>)" title="Eliminar Manifiesto" style="margin:0px;">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                            </td>
                                        </tr>
                            <?php
                                    }
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
       
     
       
    </div>
</body>
</html>