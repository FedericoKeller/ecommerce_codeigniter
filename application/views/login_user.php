

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UAACompatible" content="ie=edge">
      <title>Responsive Sticky Navbar</title>
 <?php include('links.php'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets\css\login_style.css">


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

            <h2 class="sr-only">Ingresar</h2>
            <hr/>
            <?php echo form_open('user_authentication/user_login_process','autocomplete="off"'); ?>
            <?php
            echo "<div class='error_msg'>";
            if (isset($error_message)) {
            echo $error_message;
            }
            echo validation_errors();
            echo "</div>";
            ?>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group"><input class="form-control input-lg" type="UserName" name="username" placeholder="Nombre de usuario"></div>
            <div class="form-group"><input class="form-control input-lg" type="password" name="password" placeholder="Contraseña"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Ingresar</button></div>

        <a href="<?php echo base_url() ?>user_authentication/user_registration_show" class="forgot">Crear una cuenta</a>

          </form>
    </div>

        </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
     <?php include('footer.php'); ?>
  </body>
</html>
