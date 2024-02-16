<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "UTF-8">
    <meta http-equiv = "X-UA-Compatible" content="IE=edge">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "<?php echo base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel = "stylesheet" href = "<?php echo base_url(); ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel = "stylesheet" href = "<?php echo base_url(); ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <title>Consulta Tracking</title>
</head>

<body>
    <div class="container">
        <div class="row">

            <div class="col">
                <br>
                <h2>Consulta Tracking</h2>
            </div>

            <div class="col">
                <br>
                <button type="button" class="btn btn-dark btn-lg" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
                <i class="fa fa-filter" aria-hidden="true"></i> Filtrar</button>
             

            </div>

            <div class="container-fluid m-top " id="contenido-principal">

        <div class="table-responsive">
            <!-- verificar deptos y municipios -->
            <div class="row">
                <div class="col-sm-6">
             
                </div>


                <!--  <button type="button" class="btn btn-primary btn-sm  float-right" data-toggle="tooltip" data-placement="bottom" title="" onclick="ver_individual()">Individual</button> -->

            </div>


            <table class="table custom-table" id="tbl_detalle">
                <thead>

                    <tr>
                        <th scope="col" style="display:none">idguia</td>
                        <th scope="col"> # </td>
                        <th scope="col"> Master </td>
                        <th scope="col">Referencia</td>
                        <th scope="col">Tracking Number</td>
                        <th scope="col">Tracking Replace</td>
                        <th scope="col">Weight</td>
                        <th scope="col">Value</td>
                        <th scope="col">Items</td>
                        <th scope="col">Items Description</td>
                        <th scope="col">Partida</td>
                        <th scope="col">Buyer id</td>
                        <th scope="col">Buyer</td>
                        <th scope="col">Buyer address1</td>
                        <th scope="col">Buyer city </td>
                        <th scope="col">Buyer state</td>
                        <th scope="col">Buyer phone</td>
                        <th scope="col">Buyer email </td>
                        <th scope="col">HTS</td>
                        <th scope="col">Pieces</td>
                        <th scope="col" class="font-weight-bold">Partida</td>
                        <th scope="col" class="font-weight-bold">Producto</td>
                        <th scope="col" class="font-weight-bold">Departamento</td>
                        <th scope="col" class="font-weight-bold">Municipio</td>
                        <th scope="col" class="font-weight-bold">Tipo entrega</td>
                        <th scope="col" class="font-weight-bold">Tipo servicio</td>
                        <th scope="col" class="font-weight-bold">Cobro Final</td>
                        <th scope="col" class="font-weight-bold">Recolecta</td>
                        <th scope="col" class="font-weight-bold">Guia</td>
                        <th scope="col" class="font-weight-bold">POD</td>
                        <th scope="col" class="font-weight-bold">Estado</td>
                      

                    </tr>
                </thead>

                            <tbody id="tabla_busqueda_track">
                              
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Filtro de Busqueda Por Tracking</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <form method="$_POST" class="fecha_balance_general" id="fecha_balance_general">
                                    
                                                              
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Tracking</label>
                                        <input type="text" class="form-control" id="tracking_numb" name="tracking_numb">
                                    </div>
                                </form>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-dismiss="modal">
                                    <i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
                                <button type="submit" class="btn btn-primary" onclick="buscar_tracking();" data-dismiss="modal">
                                    <i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                            </div>

                        </div>
                    </div>
                </div>
    </div>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jszip/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    
</body>
</html>