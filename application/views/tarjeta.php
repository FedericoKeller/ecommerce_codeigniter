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
              <form role="form" id="pagar" action="<?php echo base_url() ?>pagar" method="post" role="form">
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
               <div class="card-body">
                 <div class="card-title mb-4">
                      <div class="d-flex justify-content-start">
                          <div class="ml-3">
                              <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold">Información de tarjeta</a></h2>
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
                              <label for="tnum">Número de tarjeta (<span class="type">unknown</span>):</label>
                            <input type="tel" class="form-control required input-credit-card"  value="<?php echo set_value('tnum'); ?>" name="tnum" id="tnum" placeholder="**** **** **** ****">
                            <input type="hidden" class="type" name="card_name" id="card_name" />
                          </div>
                      </div>
                  </div>
                    <div class="row">
                              <div class="col-md-6">
                          <div class="form-group">
                              <label for="exp_date">Fecha de vencimiento</label>
                              <input type="tel" class="form-control required input-date" value="<?php echo set_value('exp_date'); ?>"  id="exp_date" name="exp_date" placeholder="MM/AA">
                          </div>
                      </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label for="sec_code">Código de seguridad</label>
                              <input type="text" class="form-control required digits" value="<?php echo set_value('sec_code'); ?>"  id="sec_code" name="sec_code" maxlength="3">
                          </div>
                      </div>

                  </div>
               </div>
            </div>
            <div class="card-footer">
                <input type="submit" class="btn btn-primary" value="Pagar" />
            </div>
          </form>
          </div>
          <div class="col-md-4">
                     <div class="row">
                         <div class="col-md-12">
                             <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                         </div>
                     </div>
             </div>
          <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
          <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
          <script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>
          <script src="<?php echo base_url(); ?>assets/js/pagar.js" type="text/javascript"></script>
          <script src="<?php echo base_url(); ?>assets/dist/js/cleave.min.js" type="text/javascript"></script>
          <script>
            var cleaveCreditCard = new Cleave('.input-credit-card', {
              creditCard: true,
              onCreditCardTypeChanged: function(type) {
        document.querySelector('.type').innerHTML = type;
        document.getElementById("card_name").value = type;
    }
          });

            var cleave = new Cleave('.input-date', {
              date: true,
              datePattern: ['m', 'y']
          });


            </script>
</body>

</html>
