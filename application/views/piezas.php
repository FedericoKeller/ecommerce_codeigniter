<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-users"></i> Todas las piezas
      <small>Piezas almacenadas</small>
    </h1>
  </section>
  <section class="content">
    <div class="col-xs-12">
      <div class="text-right">
        <a class="btn btn-primary" href="<?php echo base_url(); ?>addNewPieza">
          <i class="fa fa-plus"></i>Agregar una pieza</a>
      </div>
      <div class="box">
        <div class="box-header">
          <div class="box-tools">
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
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
            <div class="panel-body">
              <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Descuento</th>
                    <th>Imagen (ubicación)</th>
                    <th>Tipo</th>
                    <th>Creación</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                      if(!empty($piezaRecords))
                      {
                          foreach($piezaRecords as $record)
                          {
                      ?>
                    <tr>
                      <td>
                        <?php echo $record->id_pie ?>
                      </td>
                      <td>
                        <?php echo $record->nombre_pie ?>
                      </td>
                      <td>
                        <?php echo $record->precio_pie ?>
                      </td>
                      <td>
                        <?php echo $record->descripcion_pie ?>
                      </td>
                      <td>
                        <?php echo $record->cantidad_pie ?>
                      </td>
                       <td>
                        <?php echo $record->descuento_pie ?>
                      </td>
                       <td>
                        <?php echo $record->imagen_pie ?>
                      </td>
                      <td>
                        <?php echo $record->nombre_cat ?>
                      </td>
                      <td>
                        <?php echo $record->creacion_pie ?>
                      </td>
                      <td class="text-center">
                        <a class="btn btn-sm btn-info" href="<?php echo base_url().'editOldPieza/'.$record->id_pie; ?>" title="Editar pieza">
                          <i class="fa fa-pencil"></i>
                        </a>
                        <a class="btn btn-sm btn-danger deleteUser" href="<?php echo base_url().'deletePieza/'.$record->id_pie; ?>" data-userid="<?php echo $record->id_pie; ?>"
                          title="Sil">
                          <i class="fa fa-trash"></i>
                        </a>
                      </td>

                    </tr>
                    <?php
                          }
                      }
                      ?>
                </tbody>
              </table>
            </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
</div>
</section>
</div>
