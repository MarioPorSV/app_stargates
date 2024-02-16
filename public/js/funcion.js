function base_url(url) {
    return window.location.origin + "/app_starship/" + url;
}

function cliente() {
    var url = base_url("index.php/ClientesController/clientes");
    $.get(url, function(data) {
        $("#principal").html(data);
    });
}

function warehouse() {

    var url = base_url("index.php/WarehouseController/warehouse");
    $.get(url, function(data) {
        $("#principal").html(data);
    });
}

function preclasifica() {
    var url = base_url("index.php/PreclasificacionController/pre_clasificacion");
    $.get(url, function(data) {

        $("#principal").html(data);
    });
}

function clasifica(id,manifiesto) {
   // alert(manifiesto);
    var url = base_url("index.php/WarehouseController/clasifica/" + id);
    $.get(url, function(data) {
        $("#principal").html(data);
        $('#id-master-awb').val(id);
        $('#manifiesto-number').val(manifiesto);

    });
}

function cambiar_estatus() {
    var url = base_url("index.php/WarehouseController/cambiar_estatus");
    $.get(url, function(data) {
        $("#principal").html(data);
    });
}

function cargar_archivo() {
    var url = base_url("index.php/WarehouseController/cargar_archivo");
    $.get(url, function(data) {
        $("#principal").html(data);
        $("#upfileModal").modal("show");
    });
}


// fucion  para  cargar  en modal  la acccion de cargar  archivps 02-10-2023
 function cargar_archivo1(idpreclasificacion) {
		console.log(
			"Cargando  la modal para  actualizar los   paquetes" + idpreclasificacion
		);
		var url = base_url(
			"index.php/WarehouseController/cargar_archivoMF" 
		);
		$.get(url, function (data) {
			$("#awb_update").html(data);
			$("#upfileModal").modal("show");
            $("#idpreclasificacion").val(idpreclasificacion);
            
		});
 }


function lista_awb() {

    var url = base_url("index.php/WhController/lista_awb");
    $.get(url, function(data) {
        $("#principal").html(data);
        var url = base_url("index.php/WhController/lista_awb_first");
        $.get(url, function(data) {
            $("#awb_list").html(data);
        });

    });
}



function customers() {
    var url = base_url("index.php/Customers/customers");
    $.get(url, function(data) {
        $("#principal").html(data);
    });
}

function contactanos() {
    var url = base_url("index.php/Customers/contactanos");
    $.get(url, function(data) {
        $("#principal").html(data);
    });
}
/*
function cambiar_clave() {
	var url = base_url("index.php/Customers/cambiar_clave");
	$.get(url, function (data) {
		$("#principal").html(data);
	//	$("#cambiar_clave_modal").modal("show");
	});
}

function cambiar_email() {
	var url = base_url("index.php/Customers/cambiar_email");
	$.get(url, function (data) {
		$("#principal").html(data);
		$("#cambiar_correo_modal").modal("show");
	});
}

function suc_entrega() {
	var url = base_url("index.php/Customers/suc_entrega");
	$.get(url, function (data) {
		$("#principal").html(data);
		$("#cambiar_sucursal_modal").modal("show");
	});
}
*/
function prealertas() {
    var url = base_url("index.php/Customers/prealertas");
    $.get(url, function(data) {
        $("#principal").html(data);
        //$("#prealerta_modal").modal("show");
    });
}

function info_cuenta() {
    var url = base_url("index.php/Customers/info_cuenta");
    $.get(url, function(data) {
        $("#principal").html(data);
        var op = $("#id_sucursal").val();
        $("#sucursal").val(op);
        $("#s_entrega").val($("#sucursal option:selected").text());

    });
}
/*
function datos_clientes() {
	var url = base_url("index.php/Sincronizar/datos_clientes_magic");
	$.get(url, function (data) {
		$("#principal").html(data);
		//$("#prealerta_modal").modal("show");
	});
}
*/
function crear_credenciales() {
    var url = base_url("index.php/Sincronizar/crear_credencial");
    $.get(url, function(data) {
        $("#principal").html(data);
        alertify.set("notifier", "position", "top-right");
        alertify.success("Proceso terminado correctamente");

    });
}

function lista_inventario() {
    var url = base_url("index.php/InventarioController/inventario");
    $.get(url, function(data) {
        $("#principal").html(data);

    });
}

function traspaso() {
    var url = base_url("index.php/Traspaso/pre_clasificacion");
    $.get(url, function(data) {
        $("#principal").html(data);
    });
}
/*end traspaso*/

/* send mail */
function send_mail(body, mail) {
    var url = base_url("index.php/SendController/sendmail/" + body + "/" + mail);
    $.get(url, function(data) {
        //$("#principal").html(data);
    });
}


function archivo_facturacion() {
    var url = base_url("index.php/WhController/archivo_facturacion");
    $.get(url, function(data) {
        $("#principal").html(data);
    });
}



function facturacion() {
    var url = base_url("index.php/FController/facturacion");
    $.get(url, function(data) {
        $("#principal").html(data);
    });
}

// funcion  para  actualizar el  dui  de los   manifiestos 12-10-2023
 function cargar_archivo2(idpreclasificacion) {
		console.log(
			"Cargando  la modal para  actualizar DATOS  DUI" + idpreclasificacion
		);
		var url = base_url(
			"index.php/WarehouseController/cargar_archivoDUI" 
		);
		$.get(url, function (data) {
			$("#dui_update").html(data);
			$("#upfileModalDui").modal("show");
            $("#idpreclasificacion").val(idpreclasificacion);
            
		});
 }