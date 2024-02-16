function base_url(url) 
{
    return window.location.origin + "/app_starship/" + url;
}

function cargar_manifiesto() 
{
	var url = base_url("index.php/Cargar_ManAduanaController/cargar_archivo_fast/");
	$.get(url, function (data) 
    {
        $("#principal").html(data);
		$("#upfileModal").modal("show");
	});
}

function upload_fast()
{
    var formData;
    var url = base_url("index.php/Cargar_ManAduanaController/upload_fast/");
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
            lista_aduana();
        },
        complete: function() 
        {
            // Show image container
            $("#loader").css("display", "none");

        }
    });
}

function modal_add_master()
{
    $("#modal_crear_master").modal("show");
}

function guardar_master_fast()
{
    var formData;
    var master          =  $("#master_fast").val();
    var transportista   =  $("#transportista_fast").val();

   // alert(master + "-" + transportista);
    var url = base_url("index.php/Cargar_ManAduanaController/guardar_master_fast/" + master + "/" + transportista);
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
            $("#modal_crear_master").modal("hide");
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