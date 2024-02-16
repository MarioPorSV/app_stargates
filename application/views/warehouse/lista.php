<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/newstyle.css') ?>">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    -->
    <!-- jsf
    <script src="https://demos.codexworld.com/convert-html-to-pdf-using-javascript-jspdf/js/html2canvas.min.js"></script>
    <script src="https://demos.codexworld.com/3rd-party/jsPDF-2.5.1/dist/jspdf.umd.js"></script>
 -->

    <style>
        .tooltip-inner {
            background-color: #0F4C5C !important;
            color: #0F4C5C;
        }

        .bs-tooltip-top .arrow::before,
        .bs-tooltip-auto[x-placement^="top"] .arrow::before {
            border-top-color: #0F4C5C !important;
        }

        .bs-tooltip-right .arrow::before,
        .bs-tooltip-auto[x-placement^="right"] .arrow::before {
            border-right-color: #0F4C5C !important;
        }


        .bs-tooltip-bottom .arrow::before,
        .bs-tooltip-auto[x-placement^="bottom"] .arrow::before {
            border-bottom-color: #0F4C5C !important;
        }


        .bs-tooltip-left .arrow::before,
        .bs-tooltip-auto[x-placement^="left"] .arrow::before {
            border-left-color: #0F4C5C !important;
        }

        .modal-text-header {
            color: #F15A29;

        }

        .dropdown-options {
            display: none;
            position: relative;
            overflow: auto;
        }

        .dropdown:hover .dropdown-options {
            display: block;
        }
    </style>

</head>

<body>

    <div class="container-fluid" id="enca">

        <div class="row mt-2 ml-5 ">
            <div class="form-group mt-3">
                <h2 id="master-number" name="master-number"></h2>
                <input type="hidden" id="id-master">
                <input type="hidden" id="name_master">
            </div>


            <div class=" mt-3  " style="margin-left: 7%;">
                <?php $this->load->view("catalogos/referencia", $this->datos); ?>
            </div>
            <div class="form-group ml-2 mt-3 ">
                <div class="search-box ml-8">
                    <!-- <button class="btn-search"><i class="fas fa-search"></i></button> -->
                    <input type="text" class="input-search form-control " placeholder="buscar..." id="buscar" name="buscar" data-toggle="tooltip" data-placement="bottom" title="Buscar...">
                </div>
            </div>
            <div class="form-group ml-2 mt-3 ">
                <button type="button" class="btn btn-primary btn-circle btn-xl mt-0" data-toggle="tooltip" data-placement="bottom" title="Crear referencia" onclick="modal_referencia()"><i class="fas fa-file"></i></button>

            </div>
            <div class="form-group ml-2 mt-3 ">
                <button type="button" class="btn btn-primary btn-circle btn-xl mt-0" data-toggle="tooltip" data-placement="bottom" title="Asignar referencia" onclick="modal_add_guias()"><i class=" fas fa-box-open"></i></button>

            </div>

            <div class="form-group ml-2 mt-3 ">
                <button type="button" class="btn btn-primary btn-circle btn-xl mt-0" data-toggle="tooltip" data-placement="bottom" title="Lista de referencias" onclick="reference_list()"><i class=" fas fa-list"></i></button>

            </div>
            <div class="form-group ml-2 mt-3 ">
                <button type="button" class="btn btn-primary btn-circle btn-xl mt-0" data-toggle="tooltip" data-placement="bottom" title="Asignar partida" onclick="mostrar_detalle_partida()"><i class=" fas fa-file-text"></i></button>

            </div>

            <div class="form-group ml-2 mt-3 ">
                <button type="button" class="btn btn-success btn-circle btn-xl mt-0" data-toggle="tooltip" data-placement="bottom" title="Manifiesto Fast" onclick="lista_warehouseexport()"><i class="fas fa-file-excel"></i></button>
            </div>
            <div class="form-group ml-2 mt-3 ">
                <button type="button" class="btn btn-danger btn-circle btn-xl mt-0" data-toggle="tooltip" data-placement="bottom" title="Imprimir facturas referencia" onclick="imprimir_referencia()"><i class="fa fa-file-pdf-o"></i></button>
            </div>
            <div class="form-group ml-2 mt-3 ">
                <button type="button" class="btn btn-primary btn-circle btn-xl mt-0" data-toggle="tooltip" data-placement="bottom" title="Refrescar formulario" onclick="refreshForm()"><i class="fas fa-sync-alt"></i></button>
            </div>



        </div>

        <hr class="borde-orange mt-0">

        <div class="container-fluid m-top " id="contenido-individual">
            <div class="row">
                <div class="col-sm-3 "></div>
                <div class="col-sm-6">
                    <input type="text" class="form-control " id="numero-guia" aria-describedby="" placeholder="Guia individual" value="<?php echo     $_SESSION['tnumber']; ?>">
                </div>
                <div class="col-sm-3 "></div>
                <!-- <div class="col-sm-6 text-right">
                 
                   <button type="button" class="btn btn-primary btn-sm mt-1"  onclick="ocultar_individual()" id="btn-back">Regresar</button>
                </div>  -->


            </div>
        </div>

    </div>


    <input type="hidden" id="opc-clasif">
    <div class="container" id="detalle-partida" style="display:none">

        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="form-group">
                    <?php $this->load->view("catalogos/partidas", $this->datos); ?>
                    <div class="text-center">
                        <button type="button" class="btn btn-primary btn-sm " data-toggle="tooltip" data-placement="bottom" title="" onclick="asignar_partida_paquete()">Guardar</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="bottom" title="" onclick="ocultar_detalle_partida()">Cancelar</button>

                    </div>

                </div>
            </div>
            <div class="col-sm-2"></div>

        </div>


    </div>



    <div class="container-fluid m-top " id="contenido-principal">

        <div class="table-responsive">
            <!-- verificar deptos y municipios -->
            <div class="row">
                <div class="col-sm-6">
                    <button type="button" class="btn btn-primary btn-sm " data-toggle="tooltip" data-placement="bottom" title="" onclick="verificar_lm()">Deptos / Municipios</button>
                </div>


                <!--  <button type="button" class="btn btn-primary btn-sm  float-right" data-toggle="tooltip" data-placement="bottom" title="" onclick="ver_individual()">Individual</button> -->

            </div>


            <table class="table custom-table" id="tbl_detalle">
                <thead>

                    <tr>
                        <th scope="col" style="display:none">idguia</td>
                        <th scope="col"> # </td>
                        <th scope="col">
                            <label class="control control--checkbox">
                                <input type="checkbox" class="js-check-all" />
                                <div class="control__indicator"></div>
                            </label>
                        </th>

                        <td scope="col" id="chk_select_e" style="display:none ; background: #0F4C5C;"></td>
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
                        <th scope="col" class="font-weight-bold">Sobrante</td>
                        <th scope="col" class="font-weight-bold">Bag Number</td>
                        <th scope="col" colspan="6">Acciones</td>

                    </tr>
                </thead>
                <tbody id="awb_detalle">
                    <?php
                    if (isset($lista)) {
                        $c = 1;
                        foreach ($lista as $row) { ?>
                            <tr class="rw ">
                                <td scope="row" style="display:none"><?php echo $row->id; ?></td>

                                <td style="margin-left: 9px ; "><?php echo $c; ?></td>
                                <th class="pt-3" style="width: 40px;background: rgba(0, 255, 255, 0.0);" class="ck" id="chk_select_e">
                                    <label class="control control--checkbox mt-0">
                                        <input type="checkbox" id="<?php echo 'chk' . $row->id ?>" <?php if ($row->seleccionado == 1) {
                                                                                                        echo 'checked';
                                                                                                    } ?> " onclick=" verificar_id(<?php echo $row->id; ?>)">
                                        <div class="control__indicator"></div>
                                    </label>
                                </th>
                                <!-- check para partidas asignacion -->
                                <td class="pt-3 " style="width: 40px;display:none;background: rgba(0, 255, 255, 0.0);" class="ck" id="chk_select_d">
                                    <label class="control control--checkbox mt-0">
                                        <input type="checkbox" id="<?php echo 'chk_d' .  $row->id ?>" <?php if ($row->clasificado == 1) {
                                                                                                            echo 'checked';
                                                                                                        } ?> ">
                                        <div class=" control__indicator">
        </div>
        </label>
        </td>

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
        <td scope="row"> <?php echo utf8_decode($row->consignee_address1); ?></td>
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
         <?php if($row->id_estatus=="15"){
           echo '<td scope="row" class="font-weight-bold text-success">SI</td>';
         }else{
         echo '<td scope="row" class="font-weight-bold text-danger">NO</td>';
         }?>
         
          <?php if($row->facturado=="1"){
           echo '<td scope="row" class="font-weight-bold text-success">FACTURADO</td>';
         }else{
         echo '<td scope="row" class="font-weight-bold text-danger">PENDIENTE</td>';
         }?>
             
         <?php if($row->sobrante == 1){
           echo '<td scope="row" class="font-weight-bold text-success">SI</td>';
         }else{
         echo '<td scope="row" class="font-weight-bold text-danger">NO</td>';
         }?>
         
        <td scope="row"><?php echo $row->bag_number; ?></td>
           
        <td>
            <a href="#" class="btn btn-secundary btn-md mt-0 " Onclick="lista_servicios_express2(<?php echo "'$row->id'"; ?>)" title="Departamento / Municipio" style="margin:0px;">
                <i class="fas fa-file-text  text-secondary"></i></a>
        </td>

        <td>
            <a href="#" class="btn btn-secundary btn-md mt-0 text-blue" Onclick="open_modal_multiplicar(<?php echo "'$row->id'"; ?>)" title="Multiplicar" style="margin:0px;">
                <i class="fas fa-cut text-secondary"></i></a>
        </td>

        <td>
            <a href="#" class="btn btn-secundary btn-md mt-0" Onclick="pdf_ticket(<?php echo "'$row->id'"; ?>,<?php echo "'$row->tracking_number'"; ?>)" title="Generar QR" style="margin:0px;">
                <i class="fas fa-qrcode text-secondary"></i>
            </a>
        </td>

        <!-- <td>
            <a href="#" class="btn btn-default btn-sm"  Onclick="pdf_ticket_bk(<?php echo "'$row->id'"; ?>,<?php echo "'$row->tracking_number'"; ?>)" title = "PDF" style="margin:0px;">
                <i class="fas fa-file-pdf text-red"></i>
            </a>
        </td> -->

          <td>
            <a href="#" class="btn btn-secundary btn-md mt-0" Onclick="ver_agencias(<?php echo "'$row->id'"; ?>, <?php echo "'$row->consignee_account'"; ?>,  <?php echo "'$row->consignee_email'"; ?>,  <?php echo "'$row->consignee_phone'"; ?>, <?php echo str_replace('"', '', "'$row->consignee_address1'"); ?>)" title="Asignar agencia" style="margin:0px;">
                <i class="fas fa-store text-secondary"></i>
            </a>
        </td>
        <?php
                            $string = preg_replace("[\n|\r|\n\r]", "", trim($row->consignee_address1));
                            $string = str_replace('"', '', $string);
                            $string = str_replace('"', '', $string);
                            $string = str_replace(",", '', $string);
                            $string = str_replace("#", '', $string);
                            $string = str_replace("-", '', $string);
                            $string = str_replace("'", '', $string);
                            $string = str_replace(".", '', $string);
                            $string = str_replace("'", '', $string);
                            $string = str_replace('\\', '', $string);
                            $string = str_replace('//', '', $string);

        ?>
        <td>
            <a href="#" class="btn btn-secundary btn-md mt-0 " Onclick="crear_guia_xpress(<?php echo "'$row->id'"; ?>,
                                    <?php echo "'$row->tracking_number'"; ?>,
                                    <?php echo trim("'$row->consignee'"); ?>,
                                    <?php echo "'$string'";         ?>,
                                    <?php echo $row->departamento_id; ?>,
                                    <?php echo $row->municipio_id; ?>)" title="Crear guia xpress" style="margin:0px;">
                <i class="fas fa-cog text-primary"></i></a>
        </td>


        <td>
            <div class="dropdown mt-2">
                <i class="fas fa-bars " aria-hidden="true"></i>
                <div class="dropdown-options ">
                    <a href="#" class="btn btn-default btn-md" Onclick="reemplazar(<?php echo "'$row->tracking_number'"; ?>)" title="Reemplazar" style="margin:0px;">
                        <i class="fas fa-retweet" aria-hidden="true"></i> Reemplazar</a>

                    <a href="#" class="btn btn-default btn-md" Onclick="historial(<?php echo "'$row->tracking_number'"; ?>)" title="Historial" style="margin:0px;">
                        <i class="fas fa-history" aria-hidden="true"></i> Actualizar</a>
                        
                    <a href="#" class="btn btn-default btn-md" Onclick="reemplazar23(<?php echo "'$row->tracking_number'"; ?>)" title="Asignar Referencia" style="margin:0px;">
                        <i class="fas fa-refresh" aria-hidden="true"></i> Asignar Referencia</a> 

                </div>
            </div>
        </td>
        </tr>
<?php
                            $c = $c + 1;
                        }
                    }
?>
</tbody>
</table>
    </div>
    </div>



    <!-- modal  para agregar manifiesto-->
    <div class="modal fade" id="ModalAdd_referencia" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-white modal-text-header ">
                    <h5 class="modal-title" id="" style="color: #F15A29">Crear referencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <form enctype="multipart/form-data" class="add_manifiesto" id="add_manifiesto" action="javascript:guardar_referencia()">

                        <input type="hidden" class="form-control" name="id-manifiesto" id="id-manifiesto">

                        <div class="form-group">
                            <label for="referencia">Referencia</label>
                            <input type="text" class="form-control" placeholder="Introduzca referencia" id="referencia" name="referencia">
                        </div>

                        <div class="form-group">
                            <label for="paquetes">Paquetes</label>
                            <input type="number" class="form-control" placeholder="Introduzca paquetes" id="paquetes" name="paquetes">
                        </div>

                        <div class="form-group">
                            <label for="sacos">Sacos</label>
                            <input type="number" class="form-control" placeholder="Introduzca Sacos" id="sacos" name="sacos">
                        </div>

                        <button type="button" class="btn btn-secondary float-md-right" onclick="cerrar_modal()">Cerrar
                        </button>
                        <button class="btn btn-primary float-md-right ">Guardar</button>

                    </form>


                </div>

            </div>
        </div>
    </div>

    <!-- modal  para agregar paquetes a referencia-->
    <div class="modal fade" id="ModalAdd_guias" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-white">
                    <h5 class="modal-title" id="" style="color: #F15A29">Asignar Gu穩as</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <form enctype="multipart/form-data" class="add_guia" id="add_guia" action="javascript:asignar_guia()">

                        <input type="hidden" class="form-control" name="manifiesto_id" id="manifiesto_id">

                        <div class="form-group">
                            <?php $this->load->view("catalogos/referencia", $this->datos); ?>


                        </div>
                        <button type="button" class="btn btn-secondary float-md-right" onclick="cerrar_modal()">Cerrar
                        </button>
                        <button class="btn btn-primary float-md-right ">Guardar</button>

                    </form>


                </div>

            </div>
        </div>
    </div>

    <!-- modal mostrar referencia referencia-->
    <div class="modal fade" id="list_reference_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-white">
                    <h5 class="modal-title" id="" style="color: #F15A29">Referencias</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="manifiesto_id_ref" id="manifiesto_id_ref">

                    <div class="form-group">
                        <div class="table-responsive">
                            <table class="table custom-table" id="tbl_detalle1">
                                <thead>
                                    <tr>
                                        <th scope="col"> # </td>
                                        <th scope="col">Referencia</td>
                                        <th scope="col">Paquetes</td>
                                        <th scope="col">Sacos</td>
                                        <th scope="col">Acciones</td>
                                    </tr>
                                </thead>
                                <tbody id="awb_detalle">
                                    <?php
                                    if (isset($lst_referencia)) {
                                        $c = 1;
                                        foreach ($lst_referencia as $row) { ?>
                                            <tr class="rw ">
                                                <td scope="row" style="margin-left: 9px"><?php echo $c; ?></td>
                                                <td scope="row"><?php echo $row->referencia; ?></td>
                                                <td scope="row"><?php echo $row->paquetes; ?></td>
                                                <td scope="row"><?php echo $row->sacos; ?></td>
                                                <td>
                                                    <a href="#" class="btn btn-default btn-sm" Onclick="lista_servicios_express(<?php echo "'$row->order_number'"; ?>)" title="Editar referencia" style="margin:0px;">
                                                        <i class="fas fa-trash"></i></a>
                                                    <a href="#" class="btn btn-default btn-sm" Onclick="lista_servicios_express(<?php echo "'$row->order_number'"; ?>)" title="Eliminar referencia" style="margin:0px;">
                                                        <i class="fas fa-edit"></i></a>
                                                </td>
                                            </tr>
                                    <?php
                                            $c = $c + 1;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary float-md-right" onclick="cerrar_modal()">Cerrar
                    </button>

                </div>

            </div>
        </div>
    </div>


    <!-- modal  para multiplicar  paquetes-->
    <div class="modal fade" id="Modal_multiplicar" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-white modal-text-header ">
                    <h5 class="modal-title" id="" style="color: #F15A29">Multiplicar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <form enctype="multipart/form-data" class="add_multi" id="add_multi" action="javascript:guardar_item_multi()">

                        <input type="text" class="form-control" name="id-item" id="id-item">
                        <div class="form-group">
                            <label for="sacos">Cantidad</label>
                            <input type="number" class="form-control" min="1" step="1" placeholder="Introduzca Cantidad" id="cant" name="cant">
                        </div>

                        <button type="button" class="btn btn-secondary float-md-right" onclick="cerrar_modal()">Cerrar
                        </button>
                        <button class="btn btn-primary float-md-right ">Guardar</button>

                    </form>


                </div>

            </div>
        </div>
    </div>

    <!-- actualizar manifiesto -->
    <div class="modal fade" id="guia_express_modal2" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">

                <div class="modal-header" style="background-color:white">
                    <h4 class="modal-title" style="color:#F15a29">Crear Guia C807 Express </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <input type="text" id="id-tracking01" name="id-tracking01">
                <form id="dm_list">
                    <div id="listado_dpart">
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" id="save_manifiesto_ups" class="btn btn-primary float-md-right">Guardar</button>
                    <button type="button" class="btn btn-secondary float-md-right" data-dismiss="modal">Cerrar
                    </button>
                </div>
            </div>


        </div>
    </div>



    <!-- modal  para asignar agencia-->
    <div class="modal fade" id="Modal_asignar_agencia" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-white modal-text-header ">
                    <h5 class="modal-title" id="" style="color: #F15A29">Cambiar datos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" class="add_agencia" id="add_agencia" action="javascript:update_info()">
                        <input type="hidden" id="id-paquete" name="id-paquete">
                        <input type="hidden" id="tipo_entrega" name="tipo_entrega">
                        <input type="hidden" id="tipo_servicio" name="tipo_servicio">

                        <div class="form-group">
                            <label for="dui">DUI</label>
                            <input type="text" class="form-control" placeholder=" " id="dui" name="dui">
                        </div>
                        
                        <div class="form-group">
                            <label for="dui">Correo</label>
                            <input type="text" class="form-control" placeholder=" " id="correo" name="correo">
                        </div>

                        <div class="form-group">
                            <label for="dui">Telefono</label>
                            <input type="text" class="form-control" placeholder=" " id="telefono" name="telefono">
                        </div>
                        
                        <div class="form-group">
                            <label for="">Direcci&oacuten</label>
                            <textarea class="form-control" id="direccion" name="direccion" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <?php $this->load->view("catalogos/agencias"); ?>
                        </div>
                        <button class="btn btn-primary float-md-right ">Guardar</button>

                    </form>


                </div>

            </div>
        </div>
    </div>


    <!-- Print referencia -->
    <div class="modal fade" id="modal_print_referencia" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:white">
                    <h4 class="modal-title" style="color:#F15a29">Imprimir referencia </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="conatainer">


                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" id="ref_number" placeholder="Referencia">
                            </div>
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary float-md-right" onclick="lista_warehouse1()">Aceptar</button>
                    <button type="button" class="btn btn-secondary float-md-right" data-dismiss="modal">Cerrar
                    </button>
                </div>
            </div>


        </div>
    </div>



    <div id="ContPDF" style="display: none;">
    </div>




    <!--- modal para mostrar guias en Express-->
    <div class="modal fade" id="guia_express_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:white">
                    <h6 class="modal-title" style="color:#F15a29">Crear guia Xpress </h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form enctype="multipart/form-data" class="guia_ex" id="guia_ex" action="javascript:crear_guia_express();">
                    <div class="modal-body">

                        <input type="hidden" id="order_number" name="order_number">
                        <input type="hidden" id="depto" name="depto">
                        <input type="hidden" id="munic" name="munic">
                        <h6 id="tracking-number" class="text-center font-weight-bold"></h6>
                        <div class="div" id="bloque-complemento" style="display:none">
                            <div class="form-group">
                                <label for="">Servicio:</label>
                                <div id="listado_servicios">

                                </div>

                                <label for="">Departamento :</label>
                                <div id="listado_departamentos">

                                </div>

                                <label for="" id="lmunicipio" name="lmunicipio">Municipio:</label>
                                <div id="listado_municipios">

                                </div>

                            </div>

                            <div class="form-group">
                                <label for="direccion">Dirección:</label>
                                <input type="text" class="form-control" id="direccion" placeholder="Introduzca Dirección" name="direccion">
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>



                        <button type="button" class="btn btn-secondary float-sm-right" data-dismiss="modal">Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary float-sm-right">Crear</button>

                    </div>
                </form>

            </div>
        </div>
    </div>


    <!--- RETORNO INFO guias en Express-->
    <div class="modal fade" id="info_modal_express" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:white">
                    <h4 class="modal-title" style="color:#F15a29">Confirmación </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="form-group tcenter">
                                    <h4 id="mensaje" name="mensaje"></h4>


                                </div>
                                <div class="form-group tcenter">
                                    <h5 id="numero-recolecta"></h5>
                                    <h5 id="numero-guia"></h5>

                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <p id="error_resp" class=" text-danger font-weight-bold"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary float-md-right" data-dismiss="modal">Cerrar
                    </button>
                </div>
            </div>


        </div>
    </div>


    <!-- Modal Para Reemplazar Numero de Guias -->
    <div class="modal fade" id="modal_reemplace" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:white">
                    <h4 class="modal-title" style="color:#F15a29">Reemplazar Guias</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="conatainer">
                        <div class="form-group">
                            <label for="tracking_number">Tracking Number</label>
                            <input type="text" class="form-control" placeholder=" " id="tracking_number" name="tracking_number" value="<?php echo $row->tracking_number; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="tracking_replace">Tracking Replace</label>
                            <input type="text" class="form-control" placeholder=" " id="tracking_replace" name="tracking_replace">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary float-md-right" onclick="reemplazar_tracking(<?php echo $row->id ?>)">Aceptar</button>
                    <button type="button" class="btn btn-secondary float-md-right" data-dismiss="modal">Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!--- modal para mostrar historial de cambios de guias -->
    <div class="modal fade " id="modal_historial" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered mimodal " role="document">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header" style="background-color:white">
                    <h4 class="modal-title" style="color:#F15a29">Historial de Cambios</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="row-fluid">
                    <div class="messageup" id='messageup'>
                    </div>
                </div>
                <form enctype="multipart/form-data" class="historial" id="historial" action="javascript:historial;">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div id="listado_historial">
                            <?php $this->load->view('preclasifica/historial'); ?>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
     <!-- Modal Para Reemplazar Numero de Referencia -->
    <div class="modal fade" id="ModalAsg_referencia" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:white">
                    <h4 class="modal-title" style="color:#F15a29">Cambiar Referencia</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="conatainer">
                        <div class="form-group">
                            <label for="tracking_number">Tracking Number</label>
                            <input type="text" class="form-control" placeholder=" " id="tracking_number" name="tracking_number" value="<?php echo $row->tracking_number; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="referencia">Referencia</label>
                            <input type="text" class="form-control" placeholder=" " id="no_referencia" name="no_referencia">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary float-md-right" onclick="add_reem_referencia(<?php echo $row->id ?>)"> Aceptar</button>
                    <button type="button" class="btn btn-secondary float-md-right" data-dismiss="modal"> Cerrar</button>
                </div>
            </div>
        </div>
    </div>


<!-- Modal Para Reemplazar Numero de Guias -->
<div class="modal fade" id="modal_reemplace1" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:white">
                    <h4 class="modal-title" style="color:#F15a29">Reemplazar Guias</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="conatainer">
                        <div class="form-group">
                            <label for="tracking_number">Tracking Number</label>
                            <input type="text" class="form-control" placeholder=" " id="tracking_number" name="tracking_number" value="<?php echo $row->tracking_number; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="tracking_replace">Tracking Replace</label>
                            <input type="text" class="form-control" placeholder=" " id="tracking_replace" name="tracking_replace">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary float-md-right" onclick="reemplazar_tracking(<?php echo $row->id ?>)">Aceptar</button>
                    <button type="button" class="btn btn-secondary float-md-right" data-dismiss="modal">Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {



            $('.js-check-all').on('click', function() {

                if ($(this).prop('checked')) {
                    $('th input[type="checkbox"]').each(function() {
                        $(this).prop('checked', true);
                        $(this).closest('tr').addClass('active');
                    })
                } else {
                    $('th input[type="checkbox"]').each(function() {
                        $(this).prop('checked', false);
                        $(this).closest('tr').removeClass('active');
                    })
                }

            });

            $('th[scope="row"] input[type="checkbox"]').on('click', function() {
                if ($(this).closest('tr').hasClass('active')) {
                    $(this).closest('tr').removeClass('active');
                } else {
                    $(this).closest('tr').addClass('active');
                }
            });

            $(document).ready(function() {
                $("#buscar").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#awb_detalle tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });

            });

            /** ara determinar si esta seleccinando checknox */
            //     var checkbox = document.getElementById('chk1');
            //      checkbox.addEventListener("change", validaCheckbox, false);

            //      function validaCheckbox() {
            //          var checked = checkbox.checked;
            //          if (checked) {
            //              alert('checkbox1 esta seleccionado');
            //           } else {
            //  alert('checkbox1 esta sin seleccionado');
            //          }
            //       }



        });


        /**Fin */
        function verificar_id(id) {

            nombre = "chk" + id;
            opc = 0;
            if ($('#' + nombre).is(':checked')) {
                $('#valor').val(1);
                //  alert(nombre+' esta Seleccionado');
                opc = 1;

            } else {
                $('#valor').val(0);
                //  alert(nombre+' esta off');
                opc = 0;

            }
            var url = base_url("index.php/WhController/seleccionar_item/" + id + "/" + opc);
            $.get(url, function(data) {

            });



        }
    </script>

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

        $('#catalogo_ref').on('change', function() {
            id = $("#id-master").val();
            master = $("#name_master").val();
            ref = this.value;

            if (ref == 'Todo') {
                lista_warehouse(id, master, 0)
            } else {
                if (ref == 'Pendiente') {
                    lista_referencia(id, master, ref)
                } else {
                    lista_referencia(id, master, ref)
                }


            }

        });


        $("#agencia").change(function() {
            if ($("#agencia").val() == 0) {
                $("#tipo_entrega").val("NRML");
                $("#tipo_servicio").val("CCE");
            } else {
                var texto = $(this).find('option:selected').text();
                $("textarea#direccion").text(texto);
                $("#tipo_entrega").val("ECON");
                $("#tipo_servicio").val("CCE");
            }
        });


        function refreshForm() {
            lista_warehouse($('#id-master').val(), $('#master-number').val());
        }

        function ver_individual() {
            $("#contenido-principal").hide();
            $("#enca").hide();
            $("#contenido-individual").show();


        }

        function ocultar_individual() {
            $("#contenido-principal").show();
            $("#enca").show();
            $("#contenido-individual").hide();

        }

        $("#numero-guia").blur(function() {
            lista_warehouse($("#id-master").val(), $("#name_master").val(), $("#numero-guia").val());
            //  $("#tracking01").val( $("#numero-guia").val());
        });

        // $("#numero-guia").val($("#master-number").val());
    </script>


</body>

</html>