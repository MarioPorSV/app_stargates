<style>
    .group {
        width: 750px;
        height: 850px;
        top: 0%;
        margin-left: 15%;
    }

    .boton {
        top: 75%;
        margin-left: 35%;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <form enctype="multipart/form-data" class="add_referencia_md" id="add_referencia_md" action="javascript:update_ref_bolsa()">
                <div class="form-group">
                    <br>
                        
                    <br>

                    <h2> 
                        <?php 
                            if(isset($manifiesto)) 
                            {
                                foreach ($manifiesto as $row)
                                {
                                    echo $row->manifiesto;
                                }
                            }
                              
                            ?>
                    </h2>
                        
                           <br>
                    </div>

                    <div class="form-group">
                        <label for="dui">Sacos</label>
                            <select name="bolsas" id="bolsas" class="form-control">
                                <?php foreach ($refxbolsa as $row) : ?>
                                    <option value="<?php echo $row->bag_number; ?>">
                                        <?php echo $row->bag_number; ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                    </div>

                    <div class="form-group">
                        <label for="dui">Referencia</label>
                        <input type="text" class="form-control" placeholder=" " id="referencia" name="referencia">
                    </div>

                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-dark" onclick="lista_awb()">
                            <i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>

                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                    </div>
            </form>
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $("#bolsas").select2({
            theme: 'bootstrap4',
            placeholder: "Seleccione un saco",
            allowClear: true,
            width: 'resolve',
        });
    });
</script>