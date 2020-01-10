<?php

$id_pie = '';
$nombre_pie = '';
$precio_pie = '';
$cantidad_pie = '';
$descuento_pie = '';
$imagen_pie = '';
$nombre_cat = '';
$id_cat = '';
$descripcion_pie = '';


if(!empty($piezaInfo))
{
    foreach ($piezaInfo as $uf)
    {
        $id_pie = $uf->id_pie;
        $nombre_pie = $uf->nombre_pie;
        $precio_pie = $uf->precio_pie;
        $cantidad_pie = $uf->cantidad_pie;
        $descuento_pie = $uf->descuento_pie;
        $imagen_pie = $uf->imagen_pie;
        $nombre_cat = $uf->nombre_cat;
        $id_cat = $uf->id_cat_fk;
        $descripcion_pie  = $uf->descripcion_pie;

    }
}


?>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <i class="fa fa-users"></i> Gestión de piezas
                <small>Añadir / Editar piezas</small>
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Ingrese la información de la pieza</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <?php $this->load->helper("form"); ?>
                        <form role="form" id="editPieza" action="<?php echo base_url() ?>editPieza" method="post" role="form">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Nombre de la pieza</label>
                                            <input type="hidden" name="piezaId" id="piezaId" value="<?php echo $id_pie; ?>">
                                            <input type="text" class="form-control required" value="<?php echo $nombre_pie; ?>" id="name" name="name">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price">Precio de la pieza</label>
                                            <input type="text" class="form-control required" value="<?php echo $precio_pie; ?>" id="price" name="price">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="discount">Descuento (porcentaje)</label>
                                        <input type="number" min="1" max="100" class="form-control required" value="<?php echo $descuento_pie; ?>" id="discount" name="discount">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Imagen (ubicación)</label>
                                         <input type="text" class="form-control required" value="<?php echo $imagen_pie; ?>" id="image" name="image">
                                    </div>
                                </div>

                            </div>

                                        <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label for="amount">Cantidad de piezas</label>
                                                  <input type="number" class="form-control required" value="<?php echo $cantidad_pie; ?>" id="amount" name="amount">
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                <label for="type">Categoría de la pieza</label>
                                                <select class="form-control required" id="type" name="type">
                                                    <option value="0">Escoja categoría de pieza</option>
                                                    <?php
                                                    if(!empty($categoria))
                                                    {
                                                        foreach ($categoria as $rl)
                                                        {
                                                            ?>
                                                        <option id="manOption" value="<?php echo $rl->id_cat ?>" <?php if($rl->id_cat == $id_cat) {echo "selected=selected";} ?>>
                                                            <?php echo $rl->nombre_cat ?>
                                                        </option>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                              </div>
                                          </div>
                                          </div>
                                          <div class="row">
                                              <div class="col-md-12">
                                                  <div class="form-group">
                                                      <label for="comment">Descripción de la pieza</label>
                                                      <textarea class="form-control" id="comment" name="comment" rows="4">
                                                            <?php echo $descripcion_pie; ?>
                                                      </textarea>
                                                  </div>
                                              </div>
                                            <!-- /.box-body -->

                                            <div class="box-footer">
                                                <input type="submit" class="btn btn-primary" value="Guardar" />
                                                <input type="reset" class="btn btn-default" value="Reiniciar" />
                                            </div>
                                        </div>
                                    </div>
                        </form>
                        </div>
                        </div>
                        <div class="col-md-4">
                            <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <?php echo $this->session->flashdata('error'); ?>
                                </div>
                                <?php } ?>
                                <?php
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <?php echo $this->session->flashdata('success'); ?>
                                </div>
                                <?php } ?>

                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                                    </div>
                                </div>
                        </div>
                    </div>
        </section>

        </div>
