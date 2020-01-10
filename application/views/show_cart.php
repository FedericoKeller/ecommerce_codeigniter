
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UAACompatible" content="ie=edge">
    <title>Responsive Sticky Navbar</title>
<?php include('links.php'); ?>


<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets\css\show_cart_style.css">

  </head>
  <body>
      <div class="container">
        <div class="col-md-12">
            <h2 class="title">Carrito de compras</h2>
                <a href="<?php echo base_url(); ?>cart" class="continue">Continuar comprando</a>
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
            <table class="table table-responsive scrollableTable">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Items</th>
                        <th>Cantidad</th>
                        <th>Stock</th>
                        <th>Precio</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="detail_cart">
                  <?php
                $total = 0;
                  foreach($carrito->result() as $items)
                  {
                  $total = $total + $items->subtotal;
                      ?>
                      <tr>
                        <td class="img-box text-center">
                          <img src="<?php echo base_url().'assets/images/'.$items->imagen_pie;?>" class="img-responsive img-fluid contain">
                        </td>
                        <td>
                          <?php echo $items->nombre_cart ?>
                        </td>
                        <td>
                          <?php echo $items->cantidad ?>
                        </td>
                         <td>
                          <?php echo $items->cantidad_pie ?>
                        </td>
                        <td>
                          <?php echo number_format($items->precio_cart) ?> $
                        </td>
                        <td>
                          <?php echo number_format($items->subtotal) ?> $
                        </td>
                        <td>
                          <a class="btn btn-outline-primary mr-1" href="<?php echo base_url().'delete_cart/'.$items->id_pie_fk; ?>" data-userid="<?php echo $items->id_pie_fk; ?>"
                            title="Borrar todo">
                            <i class="fa fa-trash"></i>

                            <a class="btn btn-outline-primary" href="<?php echo base_url().'delete_element_cart/'.$items->id_pie_fk; ?>" data-userid="<?php echo $items->id_pie_fk; ?>"
                              title="Disminuir cantidad">
                             <i class="fa fa-arrow-down" aria-hidden="true"></i>
                        </td>
                </tr>
                <?php
                      }
                  ?>
                <tr>
                  <?php if($carrito->num_rows() > 0): ?>
                      <th colspan='5'>Total</th>
                      <th> <?php echo number_format($total) ?> $</th>
                      <?php
                        $session_data = $this->session->userdata('logged_in');
                        $session_data['total'] = $total;
                        $this->session->set_userdata("logged_in", $session_data);
                       ?>
                      <th style="padding-left: 35px;"> <a class="btn btn-outline-success"  href="<?php echo base_url() ?>facturacion"
                          title="Pago">
                        <i class="fas fa-check" aria-hidden="true"></i></th>
                       <?php else: ?>
                      <th>Actualmente el carrito se encuentra vacío. ¡Agregá los productos que quieras! </th>
                        <?php endif; ?>
                  </tr>

                </tbody>

            </table>
        </div>
      </div>
      <div class="content_footer">
      </div>
 <?php include('footer.php'); ?>
  </body>
</html>
