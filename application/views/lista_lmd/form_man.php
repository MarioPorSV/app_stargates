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
                
                <?php
                    if (isset($listado_man)) 
                    {
                        foreach ($listado_man as $fila) 
                        { 
                ?>          
                            <h2> Manifiesto <?php echo $fila->id; ?> </h2> 
                <?php
                        }
                    }
                ?>
               
            </div>

            <div class="container-fluid m-top">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-10">
                            <br>

                            <h3>Guia</h3> 
                            <input class="form-control form-control-lg" type="text" id="no_guia" name="no_guia">
                        </div>
        
                        <div class="col-sm-8">
                            <button type="button" class="btn btn-success btn-lg" onclick="listado_lmd();">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar</button> 

                            <button type="button" class="btn btn-primary btn-lg" id = "guardar_guia"  onclick="guardar_guia(<?php echo $fila->id; ?>);">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>

                            <button type="button" class="btn btn-dark btn-lg" Onclick="generar_guia_pdf(<?php echo "'$fila->id'"; ?>, <?php echo "'$fila->fecha_manifiesto'"; ?>, <?php echo "'$fila->observaciones'"; ?>)">
                           
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF</button>   

      
                        </div>
                    </div>
                </div>
          
                <div class="table-responsive">
                    <table class="table table-hover table-light table-responsive-sm" id="tbl_guias_no_lmd">
                    <br>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>No Guia</th>
                                <th>Cliente</th>
                                <th>Tipo Servicio</th>
                                <th>Total</th>
                                <th colspan="1">Acciones</th>                         
                            </tr>
                        </thead>

                        <tbody id="tabla_no_guia">
                            <?php
                                $con = 1;
                                if (isset($ver_manifiesto)) 
                                {
                                    foreach ($ver_manifiesto as $row) 
                                    { 
                                      //   
                            ?>
                                        <tr>
                                            <td> <?php echo $con; ?> </td>
                                            <td> <?php echo $row->no_guia; ?> </td>
                                            <td> <?php echo $row->consignee; ?> </td>
                                            <td> <?php echo $row->tipo_entrega; ?> </td>
                                            <td> <?php echo '$'.($row->cobro_final); ?> </td>
                                            <td>
                                                <a href="#" class="btn btn-danger btn-sm" onclick="eliminar_guia_manifiesto(<?php echo ($row->id) ?>, <?php echo ($row->id_manifiesto); ?>)" title="Eliminar Guia" style="margin:0px;">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                            </td>
                                        </tr>
                            <?php
                                $con = $con + 1;
                                    }
                                }
                            ?>
                            <input type="email" class="form-control form-control-lg" id="exampleFormControlInput1" value="<?php echo ($con - 1). " Guias"; ?>" readonly>
                                <br><br>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <script>
        var input = document.getElementById("no_guia");

        // Execute a function when the user presses a key on the keyboard
        input.addEventListener("keypress", function(event) 
        {
            // If the user presses the "Enter" key on the keyboard
            if (event.key === "Enter") 
            {
                // Cancel the default action, if needed
                event.preventDefault();
                // Trigger the button element with a click
                document.getElementById("guardar_guia").click();
               //alert("estoy aqui");
            }
            document.getElementById('no_guia').addEventListener('focus');
            //document.getElementById("no_guia").focus();
        });
    </script>
</body>
</html>