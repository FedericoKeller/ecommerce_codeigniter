<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-user"></i> Información de Empleados

        </h1>
    </section>
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Listar empleados</h3>
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
                                <th>Estado Civil</th>
                                <th>Experiencia</th>
                                <th>Dirección</th>
                                <th>Salario</th>
                                <th>Estudios</th>
                                <th>Horas semanales</th>
                                <th>Rol actual</th>
                            </tr>
                  </thead>
                  <tbody>
                            <?php
                    if(!empty($employeeRecords))
                    {
                        foreach($employeeRecords as $e_record)
                        {
                    ?>
                                <tr>
                                    <td>
                                        <?php echo $e_record->nro_legajo_emp ?>
                                    </td>
                                    <td>
                                        <?php echo $e_record->name ?>
                                    </td>

                                    <td>
                                        <?php echo $e_record->estado_civil_emp ?>
                                    </td>
                                    <td>
                                        <?php echo $e_record->experiencia_emp ?>
                                    </td>
                                    <td>
                                        <?php echo $e_record->direccion_emp ?>
                                    </td>
                                    <td>
                                        <?php echo $e_record->salario_emp ?>
                                    </td>
                                    <td>
                                        <?php echo $e_record->estudios_emp ?>
                                    </td>
                                    <td>
                                        <?php echo $e_record->horas_sem_emp ?>
                                    </td>
                                    <td>
                                        <?php echo $e_record->role ?>
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
