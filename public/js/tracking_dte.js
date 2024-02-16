function base_url(url) 
{
    return window.location.origin + "/app_starship/" + url;
}

function tracking_dte() 
{
  var url = base_url("index.php/Tracking_DTE_Controller/tracking");
  $.get(url, function(data) 
  {
    $("#principal").html(data);  
  });
}

function consulta_tracking() 
{
    var formData;
    var valido = "S";
    url_destino = "index.php/Tracking_DTE_Controller/consulta_tracking";
    formData = new FormData($(".qry_warehouse")[0]);
    if (valido == "S") {
        var message = "";
        //hacemos la petición ajax
        $.ajax({
            url: base_url(url_destino),
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                // Show image container
                $("#loader").css("display", "block");
            },
            success: function(data) {
                $("#tabla_estatus").html(data);
                //	document.getElementById("tabla_estatus").innerHTML = data;
            },
            complete: function() {
                // Show image container
                $("#loader").css("display", "none");
            },
            //si ha ocurrido un error
            error: function() {
                message = $("<span class='error'>Ha ocurrido un error.</span>");
                //showMessage(message);
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
                data: {
                    n_warehouse: warehouse,
                    n_casillero: casillero,
                    n_estatus: estatus,
                    nombreestatus: nombre_estatus,
                    n_retiro: nombre_retiro
                },
                beforeSend: function() {
                    // Show image container
                    $("#loader").css("display", "block");
                },
                success: function(data) {
                    alertify.set("notifier", "position", "top-right");
                    alertify.success("Estatus ha sido guardado correctamente");
                    $("#search").val("");
                    var elemento = document.getElementById("search");
                    elemento.focus();
                },
                complete: function() {
                    // Show image container
                    $("#loader").css("display", "none");
                }
            });
        })
        .done(function() {})
        .fail(function() {
            alertify.set("notifier", "position", "top-right");
            alertify.warning("!Número de warehouse no encontrado, favor verifique!");
            return false;
        });
}
