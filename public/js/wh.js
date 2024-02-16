function base_url(url) 
{
    return window.location.origin + "/app_starship/" + url;
}

function consulta_warehouse() 
{
    var formData;
    var valido = "S";
    url_destino = "index.php/WarehouseController/consulta_warehouse";
    formData = new FormData($(".qry_warehouse")[0]);
    if (valido == "S") 
    {
        var message = "";
        //hacemos la petición ajax
        $.ajax({
            url: base_url(url_destino),
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() 
            {
                // Show image container
                $("#loader").css("display", "block");
            },
            success: function(data) 
            {
                $("#tabla_estatus").html(data);
            },
            complete: function() 
            {
                // Show image container
                $("#loader").css("display", "none");
            },

            //si ha ocurrido un error
            error: function() 
            {
                message = $("<span class='error'>Ha ocurrido un error.</span>");
            },
        });
    }
}
//verifica si exite warehouse en clasificacion de paquetes
function verificar_warehouse() 
{
    if ($("#estatus").val() == "") 
    {
        $("#msg").fadeIn("slow");
        $("#msg_alert").fadeIn("slow");

        document.getElementById("msg_alert").innerHTML = "Debe seleccionar un estatus, para poder continuar";
        cerrar_alert();
        return false;
    }

    if ($("#search").val() == "") 
    {
        $("#msg").fadeIn("slow");
        $("#msg_alert").fadeIn("slow");

        document.getElementById("msg_alert").innerHTML = "Debe ingresar un número de Warehouse, para poder continuar";
        cerrar_alert();
        return false;
    }

    var warehouse = $("#search").val();
    var estatus = $("#estatus").val();
    var nombre_retiro = $("#n_retiro").val();
    var url = base_url("index.php/WarehouseController/verificar_warehouse/" + warehouse);

    $.getJSON(url, 
    {
        wh: warehouse.value
    }, 
    function(data) 
    {
        var casillero = data.casillero;
        url_destino = "index.php/WarehouseController/guardar_estatus/";
        var str = $('select[name="estatus"] option:selected').text();
        str = str.trim();
        nombre_estatus = str.substring(4, str.length);
        $.ajax({
            url: base_url(url_destino),
            method: 'POST',
            /*dataType: 'json',*/
            data: 
            {
                n_warehouse: warehouse,
                n_casillero: casillero,
                n_estatus: estatus,
                nombreestatus: nombre_estatus,
                n_retiro: nombre_retiro
            },
            beforeSend: function() 
            {
                // Show image container
                $("#loader").css("display", "block");
            },
            success: function(data) 
            {
                alertify.set("notifier", "position", "top-right");
                alertify.success("Estatus ha sido guardado correctamente");
                $("#search").val("");
                var elemento = document.getElementById("search");
                elemento.focus();
            },
            complete: function() 
            {
                // Show image container
                $("#loader").css("display", "none");
            }
        });
    })
    
    .done(function() {})
    .fail(function() 
    {
        alertify.set("notifier", "position", "top-right");
        alertify.warning("!Número de warehouse no encontrado, favor verifique!");
        return false;
    });
}

/*Envio de correo DONDE ESTA LA PEPSI*/

function send_mail(body, mail) 
{
    var url = base_url("index.php/SendController/sendmail/" + body + "/" + mail);
    $.get(url, function(data) 
    {
        //$("#principal").html(data);
    });
}

/*End envio de correo*/


function enviar_email(id) 
{
    var formData;
    url_destino = "index.php/SaldosController/sendmail/" + id;
    formData = new FormData($(".up_saldos")[0]);

    $.ajax({
        url: base_url(url_destino),
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() 
        {
            // Show image container
            $("#loader").css("display", "block");
        },
        
        success: function(result) 
        {
            $("#message").html('<div class="alert alert-success alertgreen "><button type="button" class="close">x</button><strong>Correo electrónico ha sido enviado correctamente</strong></div>');

            window.setTimeout(function() 
            {
                $(".alert")
                    .fadeTo(500, 0)
                    .slideUp(500, function() 
                    {
                        $(this).remove();
                    });
            }, 5000);

            $(".alert .close").on("click", function(e) 
            {
                $(this).parent().fadeTo(500, 0).slideUp(500);
            });
        },

        complete: function() 
        {
            // Show image container
            $("#loader").css("display", "none");
        }
    });
}

function cerrar_alert() 
{
    window.setTimeout(function() 
    {
        $("#msg").hide();
        $("#msg_alert").hide();
    }, 2000);
}

function upload_fssile() 
{
    var url = base_url("index.php/WarehouseController/upload_file/");
    $.ajax({
        url: url,
        data: $("form").serialize(),
        type: "POST",
        success: function(response) 
        {
            if (response > 0) 
            {

            } 
            else 
            {

            }
        },
        error: function(error) 
        {
            //$.notify("Error al intentar guardar ", "warning");
        },
    });
}

function upload_file() 
{
    var formData;
    var url = base_url("index.php/WarehouseController/upload_file/");
    formData = new FormData($(".upwh")[0]);
    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() 
        {
            // Show image container
            $("#loader").css("display", "block");
        },
        success: function(response) 
        {
            console.log(response);
            $(".modal-backdrop").remove();
            $("#upfileModal").modal("hide");
            $("#msg").show();
            setTimeout(function() 
            {
                $("#msg").fadeTo("slow", 0.1, function() 
                {
                    $("#msg").alert("close");
                });
            }, 5000);
        },
        complete: function() 
        {
            // Show image container
            $("#loader").css("display", "none");
        }
    });
}

function upload_file_facturacion() 
{
    var formData;
    var url = base_url("index.php/WarehouseController/upload_file_facturacion/");
    formData = new FormData($(".upwh")[0]);
    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response) 
        {
            $(".modal-backdrop").remove();
            $("#upfileModal").modal("hide");
            $("#msg").show();
            setTimeout(function() 
            {
                $("#msg").fadeTo("slow", 0.1, function() 
                {
                    $("#msg").alert("close");
                });
            }, 5000);
        },
    });
}

function listado_warehouse() 
{
    var url = base_url("index.php/WhController/listado_warehouse");
    $.get(url, function(data) 
    {
        document.getElementById("contenidoLista").innerHTML = data;
    });
}

function consulta_wh() 
{
    var campo = "";
    var args = $("#qry_warehouse").val();
    args = args.trim();
    console.log(args);

    //args=args.replace("%20", " ");
    //args=utf8_encode(args);
    if ($("#qry_warehouse").val().length < 1) 
    {
        alertify.error("Introduzca patrón de busqueda");
    }

    cadena1 = $("#qry_warehouse").val();
    cadena = cadena1.toUpperCase().trim();
    if (cadena.substr(0, 3) == "SAL") 
    {
        campo = "cuenta";
    } 
    else 
    {
        campo = "idwarehouse";
    }

    var url = base_url("index.php/WhController/consulta_warehouse/" + campo + "/" + args);
    $.get(url, function(data) 
    {
        $("#table_wh").html(data);
        //document.getElementById("table_wh").innerHTML = data;
    });
}

function filtro_manifiesto() 
{
    $("#modal_filtro_manifiesto").modal("show");
}

function manifiesto_listado() 
{
    if (!$('#input_filtro').val().length) 
    {
        alertify.error("Introduzca patrón de busqueda");
        return false;
    }
    var opc = 0;
    if ($("#rb-guia").is(':checked')) 
    {
        opc = 1;
    } 
    else 
    {
        opc = 2;
    }

    //alert($("#input_filtro").val());
    $(".modal-backdrop").remove();
    $("#modal_filtro_manifiesto").modal("hide");
    var formData;
    url_destino = "index.php/WhController/manifiesto_listado" + "/" + $("#input_filtro").val() + "/" + opc;

    $.ajax({
        url: base_url(url_destino),
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() 
        {
            // Show image container
            $("#loader").css("display", "block");
        },
        success: function(data) 
        {
            $("#principal").html(data);
        },
        complete: function() 
        {
            $("#loader").css("display", "none");
        },
        error: function() 
        {
            message = $("<span class='error'>Ha ocurrido un error.</span>");
        },
    });

}

function consulta_awb() 
{
    /** busca en encabezados tabla preclasificacion */
    inicio = $("#fecha-inicio").val();
    fin = $("#fecha-fin").val();
    opcion = $("#opciones").val();
    buscar = $("#buscar-manifiesto").val();
    if (!inicio) 
    {
        inicio = "0";
    }
    if(!fin) 
    {
        fin = "0";
    }
    if(!buscar) 
    {
        buscar = "0";
    };

    var url = base_url("index.php/WhController/consulta_awb/" + inicio + "/" + fin + "/" + opcion + "/" + buscar);
    $.get(url, function(data) 
    {
        $("#awb_list").html(data);
    });
}

function lista_warehouse(id, master, correla) 
{
    master_number =  master;
    var url = base_url("index.php/WhController/manifiesto/" + id + "/" + master + "/" + correla);

    $.get(url, function(data) 
    {
        $("#principal").html(data);
        $("#master-number").val(master_number);
        $("#id-master").val(id);
        $("#name_master").val(master);
        document.getElementById("master-number").innerHTML = master_number;
    });
}

function lista_warehouse_confirma(id, master, correla) 
{
    master_number =  master;
    var url = base_url("index.php/WhController/manifiesto_confirma/" + id + "/" + master + "/" + correla);

    $.get(url, function(data) 
    {
        $("#principal").html(data);
        $("#master-number").val(master_number);
        $("#id-master").val(id);
        $("#name_master").val(master);
        document.getElementById("master-number").innerHTML = master_number;
    });
}

function lista_warehouseexport() 
{
    var id = 0;
	id = $("#id-master").val();

    var master = 0;
	var url = base_url("index.php/WhController/manifiesto_export/" + id + "/" + master);
	$.get(url, function (data) 
    {
		$("#principal").html(data);
	});
}


// SEGMENTO PARA LLAMAR LA  CREACION DEL  PDF  
function lista_warehouse1() 
{
    var id = 0;
    id = $("#id-master").val();
    referencia = $("#ref_number").val();
    
	var url = base_url("index.php/WhController/generar_manifiesto/" + id + "/"+ referencia);

	$.get(url, function (data) 
    {
        var datos = JSON.parse(data);
		var destino = datos["destino"];
		var nombre_archivo = datos["nombre_archivo"];
		var ruta_manifiesto = destino + nombre_archivo;

		ver_report_comprobantePDF(ruta_manifiesto);
	});
}

function lista_pendientes_confirmar() 
{

    var url = base_url("index.php/WhController/lista_pendientes_confirmar");
    $.get(url, function(data) 
    {
        $("#principal").html(data);
        $("#opcion").val(0);
        $('td:nth-child(20)').hide();
        document.getElementById("titulo").innerHTML = "Paquetes pendientes de confirmar entrega";
    });
}

function lista_confirmados() 
{    
    var url = base_url("index.php/WhController/lista_awb_confirma");
    $.get(url, function(data) 
    {
        $("#principal").html(data);
        var url = base_url("index.php/WhController/lista_awb_first_confirma");
        $.get(url, function(data) 
        {
            $("#awb_list").html(data);
        });

    });
}

function crear_guia_xpress_bk(id) 
{
    $("#info_modal_express").modal("show");
}

function crear_guia_xpress(id, tracking, consignee, addres, depto, munic) 
{
    //muestra formulario para crear guia
    var url = base_url("index.php/Customers/lista_servicios");
    $.get(url, function(data) 
    {
        $("#guia_express_modal").modal("show");
        $("#direccion").val(addres);
        document.getElementById("tracking-number").innerHTML = "Tracking number: " + tracking;

        $("#order_number").val(id);
        $("#depto").val(depto);
        $("#munic").val(munic);
        $("#listado_servicios").html(data);
        $("#servicio").change(function() 
        {
        
        });

        catalogos_pais_new();
        $('#lmunicipio').hide();
    });
}

function crear_guia_express() 
{
    id = $('#order_number').val();
    var formData;
    url_destino = "index.php/WhController/obtener_guia/" + id;
    formData = new FormData($(".guia_ex")[0]);

    var message = "";
    $.ajax({
        url: base_url(url_destino),
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,

        success: function(data) 
        {
            var obj = JSON.parse(data);
            mensaje = obj.mensaje;
            recolecta = obj.recolecta;
            guia = obj.guias[0].guia;
            
            $.each(obj, function(index, item) 
            {
            
            });

            $(".modal-backdrop").remove();
            $("#guia_express_modal").modal("hide");
            $("#info_modal_express").modal("show");
            $("#mensaje").text(mensaje);
            $("#numero-recolecta").text("RECOLECTA: " + recolecta);
            $("#numero-guia").text("GUIA: " + guia);

            update_tracking_id($("#order_number").val(), recolecta, guia);
        },
        error: function() 
        {
            message = $("<span class='error'>Ha ocurrido un error.</span>");
            showMessage(message);
        },
    });

}

function update_tracking_id(id, recolecta, guia) 
{
    var url = base_url("index.php/WhController/update_tracking_id/" + id + "/" + recolecta + "/" + guia);
    $.post(url, function(data) 
    {
        if (data == 1) 
        {

        } 
        else 
        {
            document.getElementById("error_resp").innerHTML = "Error: proceso no se completó correctamente. anote la recoleta y la guia para asociarla al siguinte ID: " + id;
        }
    });
}

function catalogos_pais_new() 
{
    var url = base_url("index.php/WhController/lista_departamentos");

    $.get(url, function(data) 
    {
        $("#listado_departamentos").html(data);
        $("#departamento").change(function() 
        {
            $('#depto').val($("#departamento").val());
            var url = base_url("index.php/WhController/lista_municipios/" + $('#departamento').val());

            $.get(url, function(data) 
            {
                $("#listado_municipios").html(data);
                $("#municipio").change(function() 
                {
                    $('#munic').val($("#municipio").val());
                });

                $('#lmunicipio').show();
            });
        });
    });
}

function get_municipio(id) 
{
    var url = base_url("index.php/WhController/lista_municipios/" + id);

    $.get(url, function(data) 
    {
        $("#listado_municipios").html(data);
        $('#lmunicipio').show();
    });
}

function lista_referencia(id, master, ref) 
{
    master_number =  master;

    var url = base_url("index.php/WhController/lista_referencia/" + id + "/" + ref);

    $.get(url, function(data) 
    {
        $("#principal").html(data);
        $("#master-number").val(master_number);
        $("#id-master").val(id);
        $("#name_master").val(master);
        document.getElementById("master-number").innerHTML = master_number;
        $("#catalogo_ref").val(ref);
    });
}

function cerrar_modal() 
{
    id = $("#id-master").val();
    master = $("#name_master").val();
    $(".modal-backdrop").remove();
    $("#ModalAdd_referencia").modal("hide");
    lista_warehouse(id, master,0);
}

function modal_referencia() 
{
    $("#ModalAdd_referencia").modal("show");
    $("#id-manifiesto").val($("#id-master").val());
}

function modal_add_guias() 
{
    $("#ModalAdd_guias").modal("show");
    $("#manifiesto_id").val($("#id-master").val());
}

function reference_list() 
{
    $("#list_reference_modal").modal("show");
    $("#manifiesto_id_ref").val($("#id-master").val());
}

function guardar_referencia() 
{
    var formData;
    url_destino = "index.php/WhController/guardar_referencia/";
    formData = new FormData($(".add_manifiesto")[0]);

    var message = "";
    $.ajax({
        url: base_url(url_destino),
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() 
        {
        
        },
        
        success: function(data)
        {
            alertify.set("notifier", "position", "top-right");
            alertify.success("Referencia ha sigo guardada correctamente");

            $("#descripcion").val("");
            $("#paquetes").val("");
            $("#sacos").val("");
            $("#referencia").val("");
        },

        complete: function() 
        {
        
        }
    });
}


function asignar_guia() 
{
    var formData;

    url_destino = "index.php/WhController/asignar_guia/";
    formData = new FormData($(".add_guia")[0]);

    var message = "";
    $.ajax({
        url: base_url(url_destino),
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() 
        {
        
        },
        success: function(data) 
        {
            id = $("#id-master").val();
            master = $("#name_master").val();
            $(".modal-backdrop").remove();
            $("#ModalAdd_guias").modal("hide");
            lista_warehouse(id, master,0);
            alertify.set("notifier", "position", "top-right");
            alertify.success("Guia ha sigo asignada correctamente");
        },
        complete: function() 
        {
            
        }
    });
}


function mostrar_conversacion(id, tracking, consignee) 
{
    var url = base_url("index.php/WhController/consulta_conversacion/" + id);

    $.get(url, function(data) 
    {
        $("#modal_conversacion").modal("show");
        $("#lconversacion").html(data);
        $("#id-tracking").val(id);
        document.getElementById("tracking-id").innerHTML = tracking + " - " + consignee;
    });
}

function add_comentario() 
{
    $("#form-datos").show();
    $("#chk_aceptado").prop('checked', false);
}

function guardar_comentario() 
{
    id = $("#id-tracking").val();
    aceptado = 0;
    if ($("#chk_aceptado").prop('checked', true)) 
    {
        aceptado = 1;
    }
    var formData;

    url_destino = "index.php/WhController/guardar_comentario/";
    formData = new FormData($(".add_comenta")[0]);

    var message = "";
    $.ajax({
        url: base_url(url_destino),
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() 
        {
        
        },
        success: function(data) 
        {
            alertify.set("notifier", "position", "top-right");
            alertify.success("Comentario ha sido agregado correctamente");

            $("#descripcion").val("");
            $("#paquetes").val("");
            $("#sacos").val("");
            $("#referencia").val("");
            $(".modal-backdrop").remove();
            $("#modal_conversacion").modal("hide");
            if(aceptado == 1) 
            {
                var url = base_url("index.php/WhController/update_aceptado/" + id);

                $.get(url, function(data) 
                {
                    lista_pendientes_confirmar();
                });
            }
        },
        complete: function() 
        {
        
        }
    });
}


function ocultar_detalle_partida() 
{
    $("#detalle-partida").hide();
    $("#opc-clasif").val("0");
    $('td:nth-child(3)').show();
    $('th:nth-child(3)').show();
    $('td:nth-child(4)').hide();
    $('th:nth-child(4)').hide();
}

function mostrar_detalle_partida() 
{
    $("#detalle-partida").show();
    $("#opc-clasif").val("1");
    $('td:nth-child(3)').hide();
    $('th:nth-child(3)').hide();
    $('td:nth-child(4)').show();
    $('th:nth-child(4)').show();
}

function open_modal_multiplicar(id) 
{
    $("#Modal_multiplicar").modal("show");
    $("#id-item").val(id);
}

function guardar_item_multi() 
{
    cantidad = $('#cant').val();
    if ($('#cant').val().length <= 0) 
    {
        alertify.set("notifier", "position", "top-right");
        alertify.error("Introduzca cantidad. debe ser un valor mayor que cero(0) ");
        return false;
    }

    id = $("#id-item").val();
    url_destino = "index.php/WhController/guardar_item_multi/" + id + "/" + cantidad;
    formData = new FormData($(".add_comenta")[0]);

    $.ajax({
        url: base_url(url_destino),
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() 
        {
            $("#loader").css("display", "block");
        },
        success: function(data) 
        {
            alertify.set("notifier", "position", "top-right");
            alertify.success("Comentario ha sido agregado correctamente");
        },
        complete: function() 
        {
            $("#loader").css("display", "none");
        }
    });
}


function asignar_partida_paquete() 
{
    partida = $("#partidas").val();
    var filas = $("#tbl_detalle").find("tr");

    for (i = 1; i <= filas.length - 1; i++) 
    {
        var celdas = $(filas[i]).find("td");
        var control = "#chk_d" + $(celdas[0]).text();
        var correla = $(celdas[0]).text();

        if ($("#chk_d" + correla).is(":checked")) 
        {
            asignar_partida($(celdas[0]).text(), partida);
        }
    }

    lista_warehouse($("#id-master").val(), $("#name_master").val(),0);
}

function asignar_partida(id, partida) 
{
    var url = base_url("index.php/WhController/asignar_partida/" + id + "/" + partida);
    $.get(url, function(data) 
    {

    });
}

/***update de servicio ***/
function pdf_wh(id,master)
{
    master_number =  master;
    var url = base_url("index.php/WhController/pdf_wh/" + id + "/" + master);

    $.get(url, function(data) 
    {
        $("#pdf_wh_manifiesto").html(data);
    });
    
    //muestra modal para creacion de referencia
    $("#modal_pdf").modal("show");
}

function cerrar_modal_pdf() 
{
    $(".modal-backdrop").remove();
    $("#modal_pdf").modal("hide");   
}

function pdf_ticket_bk(id,master)
{
    var url = base_url("index.php/WhController/pdf_wh2_bk/" + id + "/" + master);
    let name = master + '.pdf';
    $.get(url, function(data) 
    {
        $("#ContPDF").html(data);
        window.jsPDF = window.jspdf.jsPDF;
        var doc = new jsPDF('p','mm',[100.1,152.4]);
        var elementHTML = document.querySelector("#contentToPrint");
        doc.html(elementHTML, 
        {
            callback: function(doc) 
            {
                doc.output('save', name); //Try to save PDF as a file (not works on ie before 10, and some mobile devices)
                doc.output('dataurlnewwindow'); 
            },
            margin: [10, 10, 10, 10],
            autoPaging: 'text',
            x: 0,
            y: 0,
            width: 190, 
            windowWidth: 775 
        });
    });
}


function pdf_ticket(id,master)
{
    var url = base_url("index.php/WhController/pdf_wh2/" + id + "/" + master);
    $.get(url, function(data) 
    {
        var datos = JSON.parse(data);
        var directorio = datos["destino"];
        var archivo = datos["nombre_archivo"];
        var documento = directorio + archivo;
        ver_pdf_qr_master(documento);
    });
}

function ver_pdf_qr_master(ruta) 
{
    var url = ruta;
    window.open(base_url(url), "ventana1", "width=600,height=600,scrollbars=no,toolbar=no, titlebar=no, menubar=no");
}

function lista_servicios_express2(id) 
{
    var url = base_url("index.php/WhController/departamento");
    $.get(url, function(data) 
    {
        $("#guia_express_modal2").modal("show");
        $("#listado_dpart").html(data);
        $("#id_manifiesto").val(id);
    });
}

//  funcion para  mostrar el detalle del  manifiesto 
function ver_report_comprobantePDF(ruta) 
{
	var url = ruta;
	window.open(
		base_url(url),
		"ventana1",
		"width=600,height=600,scrollbars=no,toolbar=no, titlebar=no, menubar=no"
	);
}


function cerrar_info_modal_express() 
{
	$(".modal-backdrop").remove();
	$("#info_modal_express").modal("hide");
	lista_confirmados();
}


// función para aplicar estatus, que no fueron notificados por webhook en app.c807
function aplicar_estatus(guia) 
{
	guia = $("#guia").val();
	var url = base_url("index.php/WhController/aplicar_estatus/" + guia);
	$.get(url, function (data) 
    {
		$("#principal").html(data);
		if (!guia == 0) 
        {
			alert("Proceso finalizado")
		}
	});
}


function ver_agencias(id,dui,correo, telefono, direccion) 
{
    $("#Modal_asignar_agencia").modal("show");
    $("#id-paquete").val(id);
    $("#dui").val(dui);
    $("#correo").val(correo);
    $("#telefono").val(telefono);
    $("textarea#direccion").text(direccion);
    $("#tipo_entrega").val("NRML"); 
    $("#tipo_servicio").val("CCE");
}

// guarda DUI, direccion, y agencia
function update_info() 
{
    var id      = $("#id-paquete").val();
    url_destino = "index.php/WhController/update_info";
    formData    = new FormData($(".add_agencia")[0]);


    $.ajax({
        url: base_url(url_destino),
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() 
        {
            $("#loader").css("display", "block");
        },
        success: function(data) 
        {
        	$(".modal-backdrop").remove();
        	$("#Modal_asignar_agencia").modal("hide");
            lista_warehouse( $('#id-master').val(), $('#master-number').val(),$('#numero-guia').val());
            alertify.set("notifier", "position", "top-right");
            alertify.success("Los cambios han sido guardados correctamente");
        },
        complete: function() 
        {
            $("#loader").css("display", "none");
        }
    });
}


function imprimir_referencia() 
{
    $("#modal_print_referencia").modal("show");
}

//  funcion para  actualizar  datos del  manifiesto    13-10-2023
function upload_fileDUI() 
{
    var  idpreclasificacion = 0;
    idpreclasificacion  =  $("#idpreclasificacion").val();
	var formData;
	var url = base_url("index.php/WarehouseController/upload_fileDUI/" + idpreclasificacion);
	formData = new FormData($(".upwh")[0]);
	$.ajax({
		url: url,
		type: "POST",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		beforeSend: function () 
        {
			// Show image container
			$("#loader").css("display", "block");
		},
		
        success: function (response) 
        {
			console.log(response);
			$(".modal-backdrop").remove();
			$("#upfileModal").modal("hide");
			$("#msg").show();
			setTimeout(function () 
            {
				$("#msg").fadeTo("slow", 0.1, function () 
                {
					$("#msg").alert("close");
				});
			}, 5000);
		},
		complete: function () 
        {
			// Show image container
			$("#loader").css("display", "none");
		},
	});
}

//  funcion para  actualizar  datos del  manifiesto    02-102023
function upload_file1() 
{
    var  idpreclasificacion = 0;
    idpreclasificacion      =  $("#idpreclasificacion").val();
	var formData;
	var url = base_url("index.php/WarehouseController/upload_fileWH/" + idpreclasificacion);
	formData = new FormData($(".upwh")[0]);
	$.ajax({
		url: url,
		type: "POST",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		beforeSend: function () 
        {
			// Show image container
			$("#loader").css("display", "block");
		},
		success: function (response) 
        {
			console.log(response);
			$(".modal-backdrop").remove();
			$("#upfileModal").modal("hide");
			$("#msg").show();
			setTimeout(function () 
            {
				$("#msg").fadeTo("slow", 0.1, function () 
                {
					$("#msg").alert("close");
				});
			}, 5000);
		},
		complete: function () 
        {
			// Show image container
			$("#loader").css("display", "none");
		},
	});
}


function verificar_lm()
{
    id = $("#id-master").val();
    alertify.confirm("¿Esta seguro de ejecutar este proceso?",
    function() 
    {   
        var url = base_url("index.php/WhController/verificar_lm/" + id);

        $.get(url, function(data) 
        {
            lista_warehouse($("#id-master").val(), $("#name_master").val(),0);     
            alertify.set("notifier", "position", "top-right");
            alertify.success("Proceso finalizado");
        });
    },

    function() 
    {
        alertify.error("Cancel");
    })
    
    .set({title: "Verificar departamentos y municipios"})
    .set({
        labels: 
        {
            ok: "Aceptar",
            cancel: "Cancelar"
        }
    });
}
    
function reemplazar(tracking_number)
{
    $("#modal_reemplace").modal("show");
    $("#tracking_number").val(tracking_number);
}

function reemplazar_tracking(id) 
{  
    alert(id);
    var tracking_number = $("#tracking_number").val();  
    var tracking_replace = $("#tracking_replace").val(); 
	var formData;
	var url = base_url("index.php/WarehouseController/reemplazar_tracking/" + id + "/" + tracking_number + "/" + tracking_replace);
	formData = new FormData($(".reemplazar_tracking")[0]);
	$.ajax({
		url: url,
		type: "POST",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		beforeSend: function () 
        {
			// Show image container
			$("#loader").css("display", "block");
		},
		success: function (response) 
        {
            $(".modal-backdrop").remove();
        	$("#modal_reemplace").modal("hide");
            lista_warehouse( $("#id-master").val(),$("#master-number").val());
            alertify.set("notifier", "position", "top-right");
            alertify.success("Los cambios han sido guardados correctamente");
		},
		complete: function () 
        {
			// Show image container
			$("#loader").css("display", "none");
		},
	});
}

function historial(tracking_number) 
{
    var formData;
    url_destino = "index.php/WarehouseController/historial/" + tracking_number;
    formData = new FormData($(".historial")[0]);

    //hacemos la petición ajax
    $.ajax({
            url: base_url(url_destino),
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) 
            {
                $("#modal_historial").modal("show");
                $("#listado_historial").html(data);
            },
            error: function() 
            {

            },
    });
}

function cargar_referencia(idpreclasificacion) 
{
	var url = base_url("index.php/WarehouseController/cargar_referencia/");
	$.get(url, function (data) 
    {
		$("#upfileModal").modal("show");
        $("#idpreclasificacion").val(idpreclasificacion);
	});
}

function upload_file_referencia()
{
    var formData;
    var  idpreclasificacion =  0;
    idpreclasificacion      =  $("#idpreclasificacion").val();

    var url = base_url("index.php/WarehouseController/upload_file_referencia/" + idpreclasificacion);
    formData = new FormData($(".up_ref")[0]);
    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() 
        {
            // Show image container
            $("#loader").css("display", "block");
        },
        success: function(response) 
        {
            console.log(response);
            $(".modal-backdrop").remove();
            $("#upfileref").modal("hide");
            $("#msg").show();
            setTimeout(function() 
            {
                $("#msg").fadeTo("slow", 0.1, function() 
                {
                    $("#msg").alert("close");
                });
            }, 5000);
        },
        complete: function() 
        {
            // Show image container
            $("#loader").css("display", "none");
        }
    });
       
    $("#upfileModal").modal("hide");
    $("#msg").show();
}


function reporte_manifiesto(idpreclasificacion)
{
    var url = base_url("index.php/WhController/reporte_manifiesto/" + idpreclasificacion);
    $.get(url, function (data) 
    {
        $("#principal").html(data);
    });
}


function reporte_guias(idpreclasificacion)
{
   
  var url = base_url("index.php/WhController/reporte_guias/" + idpreclasificacion);
        
    $("#loader").css("display", "block");
    $.get(url, function (data) 
    {
        ver_report_rep_guiasPDF("/document/reporte_ventas/" + data);
        $("#loader").css("display", "none");
    });
    
 }
 
 function ver_report_rep_guiasPDF(ruta) 
 {
     var url = ruta;
     window.open(
         base_url(url),
         "ventana1",
         "width = 600, height = 600, scrollbars = no, toolbar = no, titlebar = no, menubar = no"
     );
 }
 
 function lista_sobrantes(idpreclasificacion) 
{
	var url = base_url("index.php/WarehouseController/lista_sobrantes/");
	$.get(url, function (data) 
    {
        console.log(idpreclasificacion);
		$("#upfileSoModal").modal("show");
        $("#idpreclasificacion").val(idpreclasificacion);
	});
}

function upload_file_sobrante()
{
    var formData;
    var  idpreclasificacion =  0;
    idpreclasificacion      =  $("#idpreclasificacion").val();

    //alert(idpreclasificacion);
    var url = base_url("index.php/WarehouseController/upload_file_sobrante/" + idpreclasificacion);
    formData = new FormData($(".up_sobras")[0]);
    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() 
        {
            // Show image container
            //$("#loader").css("display", "block");
        },
        success: function(response) 
        {
            console.log(response);
            $(".modal-backdrop").remove();
            $("#upfileSoModal").modal("hide");
            $("#msg").show();
            setTimeout(function() 
            {
                $("#msg").fadeTo("slow", 0.1, function() 
                {
                    $("#msg").alert("close");
                });
            }, 10000);
        }
    });
}

function agregar_manifiestoxref(idpreclasificacion) 
{
    var url = base_url("index.php/WarehouseController/asignar_ref/" + idpreclasificacion);
	$.get(url, function (data) 
    {
		$("#principal").html(data); 
  
        if(idpreclasificacion > 0)
        {
            $('#id').val(idpreclasificacion);
            document.getElementById("titulo").innerHTML = $("#id-master").val();
        }
        else
        {
            document.getElementById("titulo").innerHTML = $("#id-master").val()
        }
  
    });
}



function update_ref_bolsa() 
{ 
    var referencia = $("#referencia").val();  
    var bolsas      = $("#bolsas").val(); 

    url_destino = "index.php/WarehouseController/update_ref_bolsa/" + referencia + "/" + bolsas;
    formData = new FormData($(".add_referencia_bolsa")[0]);

    $.ajax({
        url: base_url(url_destino),
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() 
        {
           // $("#loader").css("display", "block");
        },

        success: function(data) 
        {
            lista_awb();
            alertify.set("notifier", "position", "top-right");
            alertify.success("Los cambios han sido guardados correctamente");
            console.log(response);
            $(".modal-backdrop").remove();
        	$("#add_referencia_bolsa").modal("hide");
            $("#msg").show();
            setTimeout(function() 
            {
                $("#msg").fadeTo("slow", 0.1, function() 
                {
                    $("#msg").alert("close");
                });
            }, 10000);
        },

        complete: function() 
        {
            $("#loader").css("display", "none");
        }
    });
}

function referencia_upd(tracking_number)
{
    var url = base_url("index.php/WarehouseController/referencia_upd/" + tracking_number);
	$.get(url, function(data) 
    {
        console.log(tracking_number);
        $("#ModalAsg_referencia").modal("show");
    });
}


function add_reem_referencia(tracking_number) 
{ 
    var referencia          = $("#no_referencia").val();  
	var formData;
	var url = base_url("index.php/WarehouseController/add_reem_referencia/"  + tracking_number + "/" + referencia);
    
	formData = new FormData($(".add_reem_referencia")[0]);
	$.ajax({
		url: url,
		type: "POST",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		beforeSend: function() 
        {
			// Show image container
			alert(url);
			$("#loader").css("display", "block");
		},
		success: function(response) 
        {
            $(".modal-backdrop").remove();
        	$("#ModalAsg_referencia").modal("hide");
            lista_warehouse($("#id-master").val(), $("#name_master").val(),0);
            alertify.set("notifier", "position", "top-right");
            alertify.success("Los cambios han sido guardados correctamente");
		},
		complete: function() 
        {
			// Show image container
			$("#loader").css("display", "none");
		},
	});
}