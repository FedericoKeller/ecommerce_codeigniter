<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Gestión de piezas
            <small>Añadir / Editar pieza</small>
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
                    <form role="form" id="addNewPieza" action="<?php echo base_url() ?>addNewPiezas" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nombre de la pieza</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('name'); ?>" id="name" name="name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">Precio de la pieza</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('price'); ?>" id="price" name="price">
                                    </div>
                                </div>

                            </div>
                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="discount">Descuento (porcentaje)</label>
                                        <input type="number" min="1" max="100" class="form-control required" value="<?php echo set_value('discount'); ?>" id="discount" name="discount">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Imagen</label>
                                         <input type="text" class="form-control required" value="<?php echo set_value('image'); ?>" id="image" name="image">
                                    </div>
                                </div>

                            </div>
                                           <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="amount">Cantidad de piezas</label>
                                        <input type="number" min="1" class="form-control required" value="<?php echo set_value('amount'); ?>" id="amount" name="amount">
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
                                              <option id="manOption" value="<?php echo $rl->id_cat ?>" <?php if($rl->id_cat == set_value('type')) {echo "selected=selected";} ?>>
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
                                            <?php echo set_value('comment'); ?>
                                        </textarea>
                                    </div>
                                </div>

                                <div class="row">
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <input type="submit" class="btn btn-primary" value="Guardar" />
                                <input type="reset" class="btn btn-default" value="Reiniciar" />
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
<script src="<?php echo base_url(); ?>assets/js/addPieza.js" type="text/javascript"></script>
