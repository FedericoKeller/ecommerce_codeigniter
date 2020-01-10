<?php
$CI =& get_instance();
$CI2 =& get_instance();
if($this->uri->segment(3) == 0){
$pieza[0]['id_pie'] = "";
$pieza[0]['nombre_pie'] = "";
$pieza[0]['precio_pie'] = "";
$pieza[0]['cantidad_pie'] = "";
$pieza[0]['descripcion_pie'] = "";
$pieza[0]['creacion_pie'] = "";
$pieza[0]['modificacion_pie'] = "";


}else{


  $CI->db->where('id_pie', $this->uri->segment(3));
  $pieza = $CI->db->get('piezas_electronicas')->result_array();



$seg = $this->uri->segment(3);
$CI2->db->select('*');
$CI2->db->from('piezas_electronicas');
$CI2->db->where('id_pie', $this->uri->segment(3));
$query = $CI2->db->get()->num_rows();



if($query != 1){

echo '
<script type="text/javascript">
window.location = "0"
</script>
';

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


<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets\css\crud_piezas_style.css">

  </head>
  <body>
    <div class ="container-fluid">
      <div clas="row">
        <div class="col-md-12 text-center">


          <br>
          <h1>Gestor de Piezas</h1>
          <br>

        </div>
      </div>

      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-header">Agregar pieza</div>
            <div class="card-body">
          <form action="<?php echo base_url(); ?>user_authentication/guardar" method="post" id="addPieza">

          <div class="col-md-12 form-group input-group">
<div class="input-group-prepend">
  <span class="input-group-text">Id</span>
</div>
<input id="noclick" type="text" name="id" class="form-control" value="<?=$pieza[0]['id_pie']  ?>">
</div>


            <div class="col-md-12 form-group input-group">
  <div class="input-group-prepend">
    <span class="input-group-text">Nombre</span>
  </div>
  <input type="text" name="nombre" class="form-control" value="<?=$pieza[0]['nombre_pie']  ?>">
</div>

<div class="col-md-12 form-group input-group">
<div class="input-group-prepend">
<span class="input-group-text">Precio</span>
</div>
<input type="value" name="precio" class="form-control" value="<?=$pieza[0]['precio_pie']  ?>">
</div>

<div class="col-md-12 form-group input-group">
<div class="input-group-prepend">
<span class="input-group-text">Cantidad</span>
</div>
<input type="value" name="cantidad" class="form-control" value="<?=$pieza[0]['cantidad_pie']  ?>">
</div>


<div class="col-md-12 form-group input-group">
<div class="input-group-prepend">
<span class="input-group-text">Descripción</span>
</div>
<textarea name="descripcion" rows="4">
<?=$pieza[0]['descripcion_pie']  ?>
</textarea>
</div>

<div class="col-md-12 form-group input-group">
<div class="input-group-prepend">
<span class="input-group-text">Creación</span>
</div>
<input id="noclick" type="text" name="creacion" class="form-control" value="<?=$pieza[0]['creacion_pie']  ?>">
</div>

<div class="col-md-12 form-group input-group">
<div class="input-group-prepend">
<span class="input-group-text">Modificación</span>
</div>
<input id="noclick" type="text" name="modificacion" class="form-control" value="<?=$pieza[0]['modificacion_pie']  ?>">
</div>

<div class = "col-md-12 text-center">
  <button class="btn btn-success" type="submit">Guardar</button>
  <a href="<?php echo base_url(); ?>user_authentication/guardar/0" class="btn btn-primary">Nueva pieza</a>
</div>


          </form>
            </div>
          </div>
        </div>

        <div class="col-md-8">
          <div class="card">
            <div class="card-header">Piezas agregadas</div>
            <div class="card-body">

            <table width="100%" class ="table table table-responsive table-fw-widget table-hover table-striped fixed_header scrollableTable">
              <thead>
                <th>Id</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Descripción</th>
                <th>Creación</th>
                <th>Modificación</th>
                <th>Opción</th>
              </thead>
              <tbody>
              <?php
                  $CI =& get_instance();
                  $piezas = $CI->db->get('piezas_electronicas')->result_array();

                  foreach ($piezas as $pieza) {
                    if($pieza['estaBorrado'] == 0){


                    $rutaEditar = base_url("user_authentication/guardar/{$pieza['id_pie']}");

                    echo "<tr>
                      <td>{$pieza['id_pie']}</td>
                      <td>{$pieza['nombre_pie']}</td>
                      <td>{$pieza['precio_pie']}</td>
                      <td>{$pieza['cantidad_pie']}</td>
                      <td>{$pieza['descripcion_pie']}</td>
                      <td>{$pieza['creacion_pie']}</td>
                      <td>{$pieza['modificacion_pie']}</td>

                      <td>
                      <a href='{$rutaEditar}' class='btn btn-info'><i class='far fa-edit'></i></a>

                      </td>
                        </tr>

                    ";
                  }
                        }
               ?>
              </tbody>
            </table>
            </div>
          </div>
        </div>

      </div>



    </div>
    <div class="content_footer">
    </div>
           <?php include('footer.php'); ?>
           <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
           <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
           <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
           <script src="<?php echo base_url(); ?>assets/js/crud_validation.js" type="text/javascript"></script>
  </body>

</html>
