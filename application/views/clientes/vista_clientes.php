<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">


<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script-->


<!--script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script-->
    
    <style>

body {
    /* el tamaño por defecto es 14px */
    font-size: 14px;
        font-family: 'Roboto',  Sans-serif, Helvetica;
}
    .color {
        background: #ef7f1b;
    }

    .ch-titulo {
        color: #f05b2a;
        
    }
/*
    table th {

        background: #808080;
        color: #FFF;

    }

    .table-hover tbody tr:hover td {
        background: #778899;
    }
*/
    body {
        background: #343d46;
    }


    .box {
        margin: 5px auto;

    }

    .container-1 {

        vertical-align: middle;
        white-space: nowrap;
        position: relative;
    }

    .container-1 input#search {
        width: 100%;
        height: 50px;


        font-size: 10pt;
        float: left;
        color: #63717f;
        padding-left: 45px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
    }

    .container-1 input#search::-webkit-input-placeholder {
        color: #65737e;
    }

    .container-1 input#search:-moz-placeholder {
        /* Firefox 18- */
        color: #65737e;
    }

    .container-1 input#search::-moz-placeholder {
        /* Firefox 19+ */
        color: #65737e;
    }

    .container-1 input#search:-ms-input-placeholder {
        color: #65737e;
    }

    .container-1 .icon {
        position: absolute;
        top: 50%;
        margin-left: 17px;
        margin-top: 17px;
        z-index: 1;
        color: #4f5b66;
    }

    .container-1 input#search:hover,
    .container-1 input#search:focus,
    .container-1 input#search:active {
        outline: none;
        background: #ffffff;
    }
    .table td, .table th {
        font-size: 12px;
        
    }
    </style>
</head>

<body>




    
        <!--div class="card-header">
            <div class="row">
                <div class="col">
                    <h1 class="ch-titulo"> Clientes </h1>
                </div>
                <div class="col">
                    <div class="box">
                        <div class="container-1">
                            <span class="icon"><i class="fa fa-search"></i></span>
                            <input type="search" id="search" placeholder="Search..." class="form-control" />
                        </div>
                    </div>
                </div>
            </div>


        </div-->
    <nav class="navbar navbar-default navbar-fixed-top w-100">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#" style="color:#565656;">Cliente </a>
        </div>     
    </div>
    </nav>
        <div class="container m-top">
        <div class="table-responsive">
        
            <table id="cliente_" class="table table-hover">
                <thead>   
                    <tr>
                        <th>#</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Tipo Cuenta</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        <th>Casillero</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody >
                    <?php foreach ($cliente as $row): ?>
                    <tr>
                        <td><?php echo $row->id; ?></td>
                        <td><?php echo $row->nombres; ?></td>
                        <td><?php echo $row->apellidos; ?></td>
                        <td><?php echo $row->tipocuenta; ?></td>
                        <td><?php echo $row->telefono; ?></td>
                        <td><?php echo $row->correo; ?></td>
                        <td><?php echo $row->casillero; ?></td>
                        <td>
                        <a href='#ver_ficha' onclick="ficha_cliente()" class=" btn-default btn-xs "
                                title="Información de Cliente" data-id="" data-toggle="modal"
                                data-book-id="<?php  echo $row->nombres;?>"
                                data-book-id1="<?php echo $row->apellidos;?>"
                                data-book-id2="<?php echo $row->tipocuenta;?>"
                                data-book-id3="<?php echo $f;?>"
                                data-book-id4="<?php echo $row->tipodocumento;?>"
                                data-book-id5="<?php echo $row->pais;?>"
                                data-book-id6="<?php echo $row->numerodocumento;?>"
                                data-book-id7="<?php echo $row->nit;?>"
                                data-book-id8="<?php echo $row->nrc; ?> "
                                data-book-id9="<?php echo $row->rasonsocial; ?> "
                                data-book-id10="<?php echo $row->representantelegal; ?>"
                                data-book-id11="<?php echo $row->correo; ?>"
                                data-book-id12="<?php echo $row->telefono; ?>"
                                data-book-id13="<?php echo $row->contactoaut; ?>"
                                data-book-id14="<?php echo $row->opcionentrega; ?>"
                                data-book-id15="<?php echo  $row->lugarretiro ?>"
                                data-book-id16="<?php echo  $row->departamento ?>"
                                data-book-id17="<?php echo  $row->municipio ?>"
                                data-book-id18="<?php echo  $row->direccion ?>"
                                data-book-id19="<?php echo  $row->casillero ?>">
                                <i class="fa fa-search"></i> </a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        
        </div>
        </div>
    




    <div class="modal fade" id="ver_ficha" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header ">
                    <h4 class="modal-title">Información de Cliente</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>


                </div>

                <div class="modal-body">

                    <form enctype="multipart/form-data" method='$_GET' class="add_producto" id="add_producto" action="">

                        <div class="container fluid">
                            <div class="row ">
                                <div class="col-6">

                                    <div class="input-group input-group-sm mb-3">
                                        <label class="col-sm-3 control-label">Casillero</label>
                                        <input type="text" class="form-control" name="casillero" id="casillero">
                                    </div>

                                    <div class="input-group input-group-sm mb-3">
                                        <label class="col-sm-3 control-label">Email</label>
                                        <input type="text" class="form-control" name="email" id="imail">
                                    </div>

                                    <div class="input-group input-group-sm mb-3">
                                        <label class="col-sm-3 control-label">Teléfono</label>
                                        <input type="text" class="form-control" name="telefono" id="telefono">
                                    </div>

                                    <div class="input-group input-group-sm mb-3">
                                        <label class="col-sm-3 control-label">T.Doc</label>
                                        <input type="text" class="form-control" name="tipodoc" id="tipodoc">
                                    </div>

                                    <div class="input-group input-group-sm mb-3">
                                        <label class="col-sm-3 control-label">Fecha</label>
                                        <input type="text" class="form-control" name="fecha" id="fecha">
                                    </div>

                                    <div class="input-group input-group-sm mb-3">
                                        <label class="col-sm-3 control-label">NIT</label>
                                        <input type="text" class="form-control" name="nit" id="nit">
                                    </div>



                                    <div class="input-group input-group-sm mb-3">
                                        <label class="col-sm-3 control-label">Contacto</label>
                                        <input type="text" class="form-control" name="contacto" id="contacto">
                                    </div>
                                    <div class="input-group input-group-sm mb-3">
                                        <label class="col-sm-3 control-label">L.Retiro</label>
                                        <input type="text" class="form-control" name="lretiro" id="lretiro">
                                    </div>

                                    <div class="input-group input-group-sm mb-3">
                                        <label class="col-sm-3 control-label">Depto</label>
                                        <input type="text" class="form-control" name="departamento" id="departamento">
                                    </div>



                                </div>

                                <div class="col-6">

                                    <div class="input-group input-group-sm mb-3">
                                        <label class="col-sm-3 control-label">Nombres</label>
                                        <input type="text" class="form-control" name="nombres" id="nombres">
                                    </div>

                                    <div class="input-group input-group-sm mb-3">
                                        <label class="col-sm-3 control-label">Appelidos</label>
                                        <input type="text" class="form-control" name="telefono" id="telefono">
                                    </div>

                                    <div class="input-group input-group-sm mb-3">
                                        <label class="col-sm-3 control-label">T.Cuenta</label>
                                        <input type="text" class="form-control" name="tipocuenta" id="tipocuenta">
                                    </div>

                                    <div class="input-group input-group-sm mb-3">
                                        <label class="col-sm-3 control-label">No.Doc</label>
                                        <input type="text" class="form-control" name="numdoc" id="numdoc">
                                    </div>

                                    <div class="input-group input-group-sm mb-3">
                                        <label class="col-sm-3 control-label">Pais</label>
                                        <input type="text" class="form-control" name="pais" id="pais">
                                    </div>

                                    <div class="input-group input-group-sm mb-3">
                                        <label class="col-sm-3 control-label">NRC</label>
                                        <input type="text" class="form-control" name="nrc" id="nrc">
                                    </div>

                                    <div class="input-group input-group-sm mb-3">
                                        <label class="col-sm-3 control-label">R.Legal</label>
                                        <input type="text" class="form-control" name="rlegal" id="rlegal">
                                    </div>

                                    <div class="input-group input-group-sm mb-3">
                                        <label class="col-sm-3 control-label">O.Entrega</label>
                                        <input type="text" class="form-control" name="oentrega" id="oentrega ">

                                    </div>

                                    <div class="input-group input-group-sm mb-3">
                                        <label class="col-sm-3 control-label">Municipio</label>
                                        <input type="text" class="form-control" name="municipio" id="municipio">
                                    </div>


                                </div>

                            </div>
                            <div class="row">
                                <div class="input-group input-group-sm mb-3">
                                    <label class="col-sm-2 control-label">R.Social</label>
                                    <input type="text" class="form-control" name="rsocial" id="rsocial">
                                </div>

                                <div class="input-group input-group-sm mb-3">
                                    <label class="col-sm-2 control-label">Dirección</label>
                                    <input type="text" class="form-control" name="direccion" id="direccion">
                                </div>
                            </div>
                        </div>



                    </form>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-arrow-left">
                            Cerrar</i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Fin Modal ficha cliente -->

    <!--script>
    $(document).ready(function() {

        $("#search").on("keyup", function() {

            var value = $(this).val().toLowerCase();

            $("#myTable tr").filter(function() {

                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)

            });

        });

    });
    </script-->
    
    <script>
$(document).ready(function() {    
    $('#cliente_').DataTable({
    //para cambiar el lenguaje a español
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });     
});
</script>

</body>

</html>