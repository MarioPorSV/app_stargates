function base_url(url) {
    return window.location.origin + "/app_starship/" + url;
}

function lista_partidas() {
    var url = base_url("index.php/ArancelController/listado_partida/");
    $.get(url, function(data) {
        $("#principal").html(data);
    });
}

function agregar_partida(ID) {

    var url = base_url("index.php/ArancelController/agregar_partida/" + ID);
    $.get(url, function(data) {
        $("#principal").html(data);
        if (ID > 0) {
            $('#id_arancel').val(ID);

            document.getElementById("titulo").innerHTML = "Editar Partida";

        } else {
            document.getElementById("titulo").innerHTML = "Agregar Partida"
        }

    });
}


//Funcion para guardar las partidas creadas
function guardar_partidas() {

    url_destino = "index.php/ArancelController/insertar_partidas/";
    formData = new FormData($(".add_arancel")[0]);

    var message = "";
    $.ajax({
        url: base_url(url_destino),
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            // Show image container
            //  $("#loader").css("display", "block");
        },
        success: function(data) {
            regresaremos();

            alertify.set("notifier", "position", "top-right");
            alertify.success("El listado de partida ha sido actualizado correctamente");
            $("#id_arancel").val("");
            $("#numeroPartida").val("");
            $("#descripcion").val("");
            $("#origen").val("");
            $("#anulado").val("");

        },
        complete: function() {

        }
    });
}


//funcion para eliminar un item de la tabla
function eliminar_partida(ID) {
    //  var idPartida = $("#id").val();
    alertify
        .confirm(
            "¿Esta seguro de eliminar esta Partida?",
            function() {
                var url = base_url("index.php/ArancelController/eliminar_partida/" + ID);
                $.get(url, function(data) {
                    alertify.set("notifier", "position", "top-right");
                    alertify.success("La partida ha sido eliminada correctamente");
                    $(".modal-backdrop").remove();
                    $("#form .close").click();
                    regresaremos();
                });
            },
            function() {
                alertify.error("Cancel");
            }
        )
        .set({ title: "Eliminar  partida" })
        .set({ labels: { ok: "Aceptar", cancel: "Cancelar" } });
}


function regresaremos() {
    var url = base_url("index.php/ArancelController/listado_partida/");
    $.get(url, function(data) {
        $("#principal").html(data);
    });
}


function permisos_lista(id) {
    var url = base_url(
        "index.php/ArancelController/listado_permisos/" + id
    );

    $.get(url, function(data) {
        document.getElementById("contenidoLista").innerHTML = data;
    });
}

function mostrar_permisos(id, partida) {

    $("#contenedor-tbl").hide();
    $("#c-permisos").show();
    $("#p_import").val(id);
    $("#numero-partida").val(partida);
    permisos_lista(id);
}


function permisos_off() {
    $("#contenedor-tbl").show();
    $("#c-permisos").hide();
}

function addpermiso() {
    if ($("#p_import").val()) {
        permiso = $("#catalogopermisos").val();
        id = $("#p_import").val();
        var url = base_url(
            "index.php/ArancelController/agregar_permiso/" +
            permiso +
            "/" +
            id
        );
        $.post(url, function(data) {
            permisos_lista(id);
        });
    }
}


function eliminar_permiso(id) {
    //  var idPartida = $("#id").val();
    // alert(id);
    alertify
        .confirm(
            "¿Esta seguro de eliminar esta permiso?",
            function() {
                var url = base_url("index.php/ArancelController/eliminar_permiso/" + id);
                $.get(url, function(data) {
                    alertify.set("notifier", "position", "top-right");
                    alertify.success("El permiso ha sido eliminado ");
                    id = $("#p_import").val();
                    permisos_lista(id);


                });
            },
            function() {
                alertify.error("Cancel");
            }
        )
        .set({ title: "Eliminar  partida" })
        .set({ labels: { ok: "Aceptar", cancel: "Cancelar" } });
}