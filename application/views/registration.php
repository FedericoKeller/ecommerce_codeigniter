

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UAACompatible" content="ie=edge">
      <title>Responsive Sticky Navbar</title>
 <?php include('links.php'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets\css\login_style.css">


   </head>
  <body>


    <?php
    if (isset($logout_message)) {
    echo "<div class='message'>";
    echo $logout_message;
    echo "</div>";
    }
    ?>
    <?php
    if (isset($message_display)) {
    echo "<div class='container'>";
    echo "<div class='alert alert-success alert-dismissible'>";
    echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
    echo $message_display;
    echo "<div><a href=home>Click here to go Home</div></a>";
    echo "</div>";
    echo "</div>";
    }
    ?>


      <div class= "container-fluid">

    <div class="login-dark">

            <h2 class="sr-only">Login</h2>
            <hr/>
            <?php


  echo form_open('user_authentication/new_user_registration','autocomplete="off" style="max-width: 500px;" id="addRegister" ');




           echo "<div class='illustration'>";
           echo "<i class='icon ion-ios-locked-outline'>";
           echo "</i>";
           echo "</div>";


                   $data_email = array(
                             'name'        => 'email',
                             'class'       => 'form-control input-lg',
                             'type'        => 'email',
                             'placeholder' => 'E-mail',
                             'max-width' => '128',
                            'id' => 'email',

                           );
                    echo "<div class='row'>";
            echo "<div class='col-md-12'>";
                 echo "<div class='form-group required'>";
               echo form_input($data_email);
               echo "</div>";
               echo "</div>";
               echo "</div>";
               $data_username = array(
                         'name'        => 'username',
                         'class'       => 'form-control input-lg',
                         'type'        => 'username',
                         'placeholder' => 'Nombre de usuario',
                         'max-width' => '128',
                          'id' => 'username',

                       );

                      echo "<div class='row'>";
            echo "<div class='col-md-6'>";
          echo "<div class='form-group required'>";
          echo form_input($data_username);
          echo "</div>";
          echo "</div>";


          $data_password = array(
                    'name'        => 'password',
                    'class'       => 'form-control input-lg',
                    'placeholder' => 'Password',
                    'max-width' => '128',
                      'id' => 'password',

                  );

               echo "<div class='col-md-6'>";
        echo "<div class='form-group required'>";
      echo form_password($data_password);
      echo "</div>";
         echo "</div>";
      echo "</div>";

      $data_submit = array(
                'value'       => $this->input->post('submit'),
                'class'       => 'btn btn-primary btn-block',
                'type'        => 'submit'
              );

              echo form_submit('submit', 'Regístrate',  $data_submit);

            echo "<a class='forgot' href='index' style='padding-top:10px'>";
            echo "¿Ya tienes una cuenta?";
            echo "</a>";

              echo form_close();

            ?>






    </div>

        </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/registration.js" type="text/javascript"></script>
     <?php include('footer.php'); ?>
  </body>
</html>
