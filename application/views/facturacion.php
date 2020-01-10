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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UAACompatible" content="ie=edge">
    <title>Responsive Sticky Navbar</title>
    <?php include('links.php'); ?>
<style>
.error{
  color: red;
}

input.error{
  border-color: red;
}

}
</style>
</head>

<body>
      <link rel="stylesheet" href="https://bootswatch.com/4/simplex/bootstrap.min.css"/>
    <div class="container">

        <div class="col-12">
            <div class="card">
                <form role="form" id="addFacturacion" action="<?php echo base_url() ?>addFactura" method="post" role="form">
                <div class="card-body">
                  <div class="card-title mb-4">
                      <div class="d-flex justify-content-start">
                          <div class="ml-3">
                              <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold">Información de Facturación</a></h2>
                          </div>
                      </div>
                  </div>
                       <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label for="pago">Pagar con</label>
                                    <select class="form-control required" name="pago">
                                        <option value="0">Tarjeta de crédito o débito</option>
                                        <option value="1">Efectivo</option>
                                                    </select>
                                  </div>
                              </div>
                        </div>
                           <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                              <label for="pais">País</label>
                            <?php echo form_dropdown('pais', $country, '0', 'class="form-control required" id="pais"'); ?>
                          </div>
                              </div>
                        </div>
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="name">Nombre</label>
                              <input type="text" class="form-control required" <?php if(!empty($clienteInfo)) {echo "value={$nombre_cli}";}else{echo set_value('nombre');} ?> id="nombre" name="nombre">
                          </div>

                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="apellido">Apellido</label>
                              <input type="text" class="form-control required" <?php if(!empty($clienteInfo)) {echo "value={$apellido_cli}";}else{echo set_value('apellido');} ?> id="apellido" name="apellido">
                          </div>
                      </div>
                  </div>
                     <div class="row">
                              <div class="col-md-6">
                          <div class="form-group">
                              <label for="dni">Documento de identidad</label>
                              <input type="text" class="form-control required digits" <?php if(!empty($clienteInfo)) {echo "value={$dni_cli}";}else{echo set_value('dni');} ?>  id="dni" name="dni" maxlength="9">
                          </div>
                      </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label for="tel">Teléfono</label>
                              <input type="text" class="form-control required digits" <?php if(!empty($clienteInfo)) {echo "value={$telefono_cli}";}else{echo set_value('tel');} ?>  id="tel" name="tel" maxlength="10">
                          </div>
                      </div>

                  </div>
                  <div class="row">
                    <div class="col-md-6">
                          <div class="form-group">
                              <label for="region">Estado/Territorio/Región</label>
                              <input type="text" class="form-control required" value="<?php echo set_value('region'); ?>"  id="region" name="region">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="ciudad">Ciudad</label>
                              <input type="text" class="form-control required" value="<?php echo set_value('ciudad'); ?>"  id="ciudad" name="ciudad">
                          </div>
                      </div>
                  </div>
                  <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                              <label for="direccion">Dirección Postal</label>
                              <input type="text" class="form-control required" value="<?php echo set_value('direccion'); ?>"  id="direccion" name="direccion">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="postal">Código Postal</label>
                              <input type="text" class="form-control" value="<?php echo set_value('postal'); ?>"  id="postal" name="postal" maxlength="4">
                          </div>
                      </div>
                  </div>

                  </div>

                </div>
                <div class="card-footer">
                    <input type="submit" class="btn btn-primary" value="Proceder a pagar" />
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
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/app.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/addFacturacion.js" type="text/javascript"></script>
</body>

</html>
