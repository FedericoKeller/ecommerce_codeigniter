<?php


$nombre_cli = '';
$apellido_cli = '';
$dni_cli = '';
$telefono_cli = '';

if(!empty($clienteInfo))
{
    foreach ($clienteInfo as $uf)
    {
        $nombre_cli = $uf->nombre_cli;
        $apellido_cli = $uf->apellido_cli;
        $dni_cli  = $uf->dni_cli;
        $telefono_cli  = $uf->telefono_cli;
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<?php
if (isset($this->session->userdata['logged_in'])) {
$username = ($this->session->userdata['logged_in']['username']);
$email = ($this->session->userdata['logged_in']['email']);
} else {
header("location: login_user");
}
?>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UAACompatible" content="ie=edge">
    <title>Responsive Sticky Navbar</title>
<?php include('links.php'); ?>
<style>
.error{
  color: red;
  font-weight: normal;
}

input.error{
  border-color: red;
}

}
</style>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets\css\user_page_style.css">

  </head>
  <body>
    <link rel="stylesheet" href="https://bootswatch.com/4/simplex/bootstrap.min.css"/>
    <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
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
                            <div class="card-title mb-4">
                                <div class="d-flex justify-content-start">

                                    <div class="userData ml-3">
                                        <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><?php echo $username ?></a></h2>
                                    </div>


                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">

                                        <li class="nav-item">
                                            <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Información básica</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="editarInformacion-tab" data-toggle="tab" href="#editarInformacion" role="tab" aria-controls="editarInformacion" aria-selected="false">Editar información</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content ml-1" id="myTabContent">
                                        <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">


                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label>Nombre</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                  <?php if(!empty($clienteInfo)): ?>
                                                  <?php echo $nombre_cli?>
                                                  <?php else: ?>
                                                      No establecido.
                                                      <?php endif; ?>
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label>Apellido</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                  <?php if(!empty($clienteInfo)): ?>
                                                  <?php echo $apellido_cli?>
                                                  <?php else: ?>
                                                      No establecido.
                                                      <?php endif; ?>
                                                </div>
                                            </div>
                                            <hr />


                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label>E-mail</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?php echo $email ?>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">DNI</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                  <?php if(!empty($clienteInfo)): ?>
                                                  <?php echo $dni_cli?>
                                                  <?php else: ?>
                                                      No establecido.
                                                      <?php endif; ?>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Télefono</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                  <?php if(!empty($clienteInfo)): ?>
                                                  <?php echo $telefono_cli?>
                                                  <?php else: ?>
                                                      No establecido.
                                                      <?php endif; ?>
                                                </div>
                                            </div>
                                            <hr />

                                        </div>
                                        <div class="tab-pane fade" id="editarInformacion" role="tabpanel" aria-labelledby="editarInformacion-tab">
                                                          <form role="form" id="addUserInfo" action="<?php echo base_url() ?>addUserInfo" method="post" role="form">

                                          <div class="row">
                                              <div class="col-md-6">
                                                  <div class="form-group">
                                                      <label for="name">Nombre</label>
                                                      <input type="text" class="form-control required" value="<?php echo set_value('nombre'); ?>" id="nombre" name="nombre">
                                                  </div>

                                              </div>
                                              <div class="col-md-6">
                                                  <div class="form-group">
                                                      <label for="apellido">Apellido</label>
                                                      <input type="text" class="form-control required" value="<?php echo set_value('apellido'); ?>" id="apellido" name="apellido">
                                                  </div>
                                              </div>
                                          </div>
                                            <hr />
                                             <div class="row">
                                                      <div class="col-md-6">
                                                  <div class="form-group">
                                                      <label for="dni">Documento de identidad</label>
                                                      <input type="text" class="form-control required digits" value="<?php echo set_value('dni'); ?>"  id="dni" name="dni" maxlength="9">
                                                  </div>
                                              </div>
                                                <div class="col-md-6">
                                                  <div class="form-group">
                                                      <label for="tel">Teléfono</label>
                                                      <input type="tel" class="form-control required digits" value="<?php echo set_value('tel'); ?>"  id="tel" name="tel" maxlength="10">
                                                  </div>
                                              </div>
                                              <div class="card-footer">
                                                  <input type="submit" class="btn btn-primary" value="Guardar" />
                                              </div>
                                          </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
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
        <div class="content_footer">
        </div>
   <?php include('footer.php'); ?>
        <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/addUserInfo.js" type="text/javascript"></script>
  </body>
</html>
