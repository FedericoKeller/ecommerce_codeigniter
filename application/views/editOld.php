<?php

$CI =& get_instance();


$userId = '';
$name = '';
$email = '';
$mobile = '';
$roleId = '';


$empleado[0]['estado_civil_emp'] = "";
$empleado[0]['experiencia_emp'] = "";
$empleado[0]['direccion_emp'] = "";
$empleado[0]['salario_emp'] = "";
$empleado[0]['estudios_emp'] = "";
$empleado[0]['horas_sem_emp'] = "";



if(!empty($userInfo))
{
    foreach ($userInfo as $uf)
    {
        $userId = $uf->userId;
        $name = $uf->name;
        $email = $uf->email;
        $mobile = $uf->mobile;
        $roleId = $uf->roleId;
    }
}
$var = $this->uri->segment(2);

$CI->db->where('user_emp_fk', $var);
$empleado = $CI->db->get('empleado')->result_array();



?>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <i class="fa fa-users"></i> Gestión de usuarios
                <small>Añadir / Editar</small>
            </h1>
        </section>

        <section class="content">

            <div class="row">
                <!-- left column -->
                <div class="col-md-8">
                    <!-- general form elements -->



                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Ingrese la información del usuario</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->

                        <form role="form" action="<?php echo base_url() ?>editUser" method="post" id="editUser" role="form">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Nombre y Apellido</label>
                                            <input type="text" class="form-control" id="fname" placeholder="Full Name" name="fname" value="<?php echo $name; ?>" maxlength="128">
                                            <input type="hidden" value="<?php echo $userId; ?>" name="userId" id="userId" />
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo $email; ?>"
                                                maxlength="128">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Contraseña</label>
                                            <input type="password" class="form-control" id="password" placeholder="Password" name="password" maxlength="20">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cpassword">Verificar contraseña</label>
                                            <input type="password" class="form-control" id="cpassword" placeholder="Verificar contraseña" name="cpassword" maxlength="20">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mobile">Teléfono</label>
                                            <input type="text" class="form-control" id="mobile" placeholder="Mobile Number" name="mobile" value="<?php echo $mobile; ?>"
                                                maxlength="10">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="role">Rol</label>
                                            <select class="form-control" id="role" name="role" onchange="Select(this);">
                                                <option value="0">Elige un rol</option>
                                                <?php
                                            if(!empty($roles))
                                            {
                                                foreach ($roles as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->roleId; ?>" <?php if($rl->roleId == $roleId) {echo "selected=selected";} ?>>
                                                        <?php echo $rl->role ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row sh" style='display: none;'>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="civil">Estado Civil</label>
                                            <input type="text" class="form-control required" <?php if($roleId == 3) {echo "value={$empleado[0]['estado_civil_emp']}";} ?>  id="civil" name="civil" maxlength="128">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exp">Experiencia previa</label>

                                                  <select class="form-control required" name="exp">
                                                      <option value="0">¿Tuvo experiencia?</option>
                                                      <option value="1">Sí</option>
                                                      <option value="2">No</option>
                                                                  </select>
                                                </div>
                                            </div>
                                        </div>


                                <div class="row sh" style='display: none;'>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="dir">Dirección</label>
                                          <input type="text" class="form-control required" <?php if($roleId == 3) {echo "value='{$empleado[0]['direccion_emp']}'";} ?> id="dir" name="dir" maxlength="128">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="money">Salario</label>
                                          <input type="text" class="form-control required" <?php if($roleId == 3) {echo "value='{$empleado[0]['salario_emp']}'";} ?> id="money" name="money" maxlength="128">
                                      </div>
                                  </div>
                                </div>
                                <div class="row sh" style='display: none;'>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="studies">Estudios</label>
                                          <input type="text" class="form-control required" <?php if($roleId == 3) {echo "value='{$empleado[0]['estudios_emp']}'";} ?> id="studies" name="studies" maxlength="128">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="hours">Horas</label>
                                          <input type="text" class="form-control required" <?php if($roleId == 3) {echo "value='{$empleado[0]['horas_sem_emp']}'";} ?> id="hours" name="hours" maxlength="128">
                                      </div>
                                  </div>
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
    <script>
  window.onload = function loading()
{
var elems =   document.getElementsByClassName("sh");
var e = document.getElementById('role').value;
for(var x = 0; x < elems.length; x++){
if(e == 3){
elems[x].style.display = "block";
}
}

}

function Select(nameSelect){
  var elems =   document.getElementsByClassName("sh");

  for(var x = 0; x < elems.length; x++){
  if(nameSelect.value == 3){
  elems[x].style.display = "block";
  }else{
  elems[x].style.display = "none";
  }


  }
}

    </script>
    <script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>
