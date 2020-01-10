<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Gestion de usuarios
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
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addUser" action="<?php echo base_url() ?>addNewUser" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fname">Nombre y apellido</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('fname'); ?>" id="fname" name="fname" maxlength="128">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control required email" id="email" value="<?php echo set_value('email'); ?>" name="email"
                                            maxlength="128">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Contraseña</label>
                                        <input type="password" class="form-control required" id="password" name="password" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpassword">Verificar contraseña</label>
                                        <input type="password" class="form-control required equalTo" id="cpassword" name="cpassword" maxlength="20">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Teléfono</label>
                                        <input type="text" class="form-control required digits" id="mobile" value="<?php echo set_value('mobile'); ?>" name="mobile"
                                            maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Rol</label>
                                        <select class="form-control required" id="role" name="role" onchange="Select(this);">
                                            <option value="0">Elige un rol</option>
                                            <?php
                                            if(!empty($roles))
                                            {
                                                foreach ($roles as $rl)
                                                {
                                                    ?>
                                                <option id="admOption" value="<?php echo $rl->roleId ?>" <?php if($rl->roleId == set_value('role')) {echo "selected=selected";} ?>>
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
                                        <input type="text" class="form-control required" value="<?php echo set_value('civil'); ?>" id="civil" name="civil" maxlength="128">
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
                                      <input type="text" class="form-control required" value="<?php echo set_value('dir'); ?>" id="dir" name="dir" maxlength="128">
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="money">Salario</label>
                                      <input type="text" class="form-control required" value="<?php echo set_value('money'); ?>" id="money" name="money" maxlength="128">
                                  </div>
                              </div>
                            </div>
                            <div class="row sh" style='display: none;'>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="studies">Estudios</label>
                                      <input type="text" class="form-control required" value="<?php echo set_value('studies'); ?>" id="studies" name="studies" maxlength="128">
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="hours">Horas</label>
                                      <input type="text" class="form-control required" value="<?php echo set_value('hours'); ?>" id="hours" name="hours" maxlength="128">
                                  </div>
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
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                        </div>
                    </div>
            </div>
        </div>
    </section>



            <script>
            function Select(nameSelect)
{
  var elems =   document.getElementsByClassName("sh");
console.log(nameSelect.value);
  for(var x = 0; x < elems.length; x++){
if(nameSelect.value == 3){

    elems[x].style.display = "block";
  }else{
      elems[x].style.display = "none";
  }


}
}

            </script>
<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>
