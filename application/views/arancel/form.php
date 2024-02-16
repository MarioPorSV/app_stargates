<!--Vista de Formulario para editar o eliminar campos de partidas-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
</head>


<body>

  <?php
  $id              = NULL;
  $numero_partida  =    "";
  $descripcion     =   '';
  $origen          =   '';
  $estado          =    0;
  $id_origen        = "";
  $codigo_producto = "";
  $tlc="";

  if (isset($datos_partida)) {
    $numero_partida = $datos_partida->numero_partida;
    $descripcion    = $datos_partida->descripcion;
    $id_origen         = $datos_partida->id_origen;
    $anulado        = $datos_partida->anulado;
    $codigo_producto        = $datos_partida->codigo_producto;
    $tlc        = $datos_partida->tlc;

    //echo($descripcion);
  }

  ?>
  <!--Vista de Formulario para editar o eliminar campos de partidas-->

  <div class="container">
    <div class="card">
      <div class="card-header">
        <h5 id="titulo"></h5>
      </div>
      <div class="card-body">

        <form enctype="multipart/form-data" class="add_arancel" id="add_arancel" action="javascript:guardar_partidas()">



          <input type="hidden" class="form-control w-100" id="id_arancel" name="id_arancel" readonly>

          <div class="form-group">

            <label class="control-label">Código Producto</label>
            <input type="text" class="form-control w-50" value="<?php echo $codigo_producto; ?>" name="codigo_producto" id="codigo_producto" required>
          </div>

          <div class="form-group">
            <label for="Input2">Descripción</label>
            <input type="text" class="form-control w-50" value="<?php echo $descripcion; ?>" name="descripcion" id="descripcion" required>

          </div>
          <div class="form-group">

            <label class="control-label">Numero Partida</label>
            <input type="text" class="form-control w-50" value="<?php echo $numero_partida; ?>" name="numeroPartida" id="numeroPartida" required>
          </div>



        <!--  <div class="form-group" style="display:none">
             <label class="control-label">TLC</label>
            <input type="hidden" id="id-tlc"  value="<?php //echo $tlc; ?>">
            <select class="form-control w-50" id="tlc" name="tlc" required>
            <option title="NO">NO</option> 
            <option value="SI">SI</option>
           
             
            </select>

          </div>
          -->

          <button onclick="regresaremos()" type="button" class="btn btn-secondary btn-lg">Atras</button>
          <button class="btn btn-primary btn-lg">Guardar</button>

        </form>
      </div>
    </div>

  </div>

  <script>
    $(document).ready(function() {
      $("#origen").val($("#id-pais").val());
      $("#origen").change();

      $("#tlc").val($("#id-tlc").val());
      $("#tlc").change();

     
    });
  </script>

</body>

</html>