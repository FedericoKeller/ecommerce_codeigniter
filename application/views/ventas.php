<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-user"></i> Información de Ventas

        </h1>
    </section>
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Listar ventas</h3>
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
                                <th>Apellido</th>
                                <th>DNIe</th>
                                <th>Télefono</th>
                                <th>Número de tarjeta</th>
                                <th>Tipo de tarjeta</th>
                                <th>Total</th>
                            </tr>
                  </thead>
                  <tbody>
                            <?php
                    if(!empty($salesRecords))
                    {
                        foreach($salesRecords as $s_record)
                        {
                    ?>
                                <tr>
                                    <td>
                                        <?php echo $s_record->id_cli ?>
                                    </td>
                                    <td>
                                        <?php echo $s_record->nombre_cli ?>
                                    </td>

                                    <td>
                                        <?php echo $s_record->apellido_cli ?>
                                    </td>
                                    <td>
                                        <?php echo $s_record->dni_cli ?>
                                    </td>
                                    <td>
                                        <?php echo $s_record->telefono_cli ?>
                                    </td>
                                    <td>
                                        <?php echo $s_record->card_num_p ?>
                                    </td>
                                    <td>
                                        <?php echo $s_record->card_name_p ?>
                                    </td>
                                    <td>
                                        <?php echo $s_record->total?>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
