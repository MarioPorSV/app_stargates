function base_url(url) 
{
    return window.location.origin + "/app_starship/" + url;
}

function consulta_track() 
{
  var url = base_url("index.php/Consulta_track_Controller/consulta_track");
  $.get(url, function (data) 
  {
    $("#principal").html(data);
  });
}

// Funcion para buscar cualquier tipo de dato desde un formulario
function buscar_tracking() 
{
  var tracking = $("#tracking_numb").val();
 

  if (tracking) 
  {
    
  }
  else 
  {
    alertify.alert("", "Ingrese el Tracking", "");
    return false;
  }

  var url = base_url("index.php/Consulta_track_Controller/buscar_tracking_numb/" + tracking);
  $.get(url, function (data) 
  {
    $("#tabla_busqueda_track").html(data);  //$("Nombre segun el id del tbody").html(data);
  });
}

function lista_servicios_express3(id) 
{
    //console.log(id);
    var url = base_url("index.php/Consulta_track_Controller/departamentos");
    $.get(url, function(data) 
    {
        //console.log(data);
        //alert(data);
        $("#guia_express_modal2").modal("show");
        //$("#order_number").val(id);
        $("#listado_dpart").html(data);
        /*$("#servicio").change(function() {
        $('#nservi').val($("#servicio option:selected").text());
        });
        catalogos_pais();
        $('#lmunicipio').hide();*/
        $("#id_manifiesto").val(id);
    });
}


function historial1(tracking_number) 
{
    var formData;
    url_destino = "index.php/Consulta_track_Controller/historial1/" + tracking_number;
    formData = new FormData($(".historial")[0]);
 //alert(id);

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


function PDF_buscar_fecha_guia()
{
  var fecha_desde_guia = $("#fecha_desde_guia").val();
  var fecha_hasta_guia = $("#fecha_hasta_guia").val(); 
  var url = base_url("index.php/Comparativo_guias_Controller/PDF_buscar_fecha_guia/" + fecha_desde_guia +  "/" + fecha_hasta_guia);

  $.get(url, function (data) 
  {
      var datos = JSON.parse(data);
      var directorio = datos["destino"];
      var archivo = datos["nombre_archivo"];
      var documento = directorio + archivo;
      ver_report_fecha_guiaPDF(documento);
  });
}

function ver_report_fecha_guiaPDF(ruta) 
{
  var url = ruta;
  //alert("lo que trae el data" + ruta)
  window.open(base_url(url), "ventana1", "width=600,height=600,scrollbars=no,toolbar=no, titlebar=no, menubar=no"
  );
}