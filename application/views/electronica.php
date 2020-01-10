<?php
 $count = 0;
 ?>
 <!DOCTYPE html>
 <html lang="en">
    <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <meta http-equiv="X-UAACompatible" content="ie=edge">
       <title>Responsive Sticky Navbar</title>
  <?php include('links.php'); ?>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets\css\footer_style.css">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets\css\catalogo_style.css">
    </head>

    <body>
        <div class="container">
            <br/>
            <h2>Tienda</h2>
            <hr/>
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
                <div class="col-md-9">
                    <h4>Productos</h4>
                    <div class="row">
                        <?php foreach ($piezas->result() as $row) : ?>
                            <div class="col-md-4">
                                <div id="thumb" class="img-thumbnail">

                                      <div class="img-box text-center">
                                        <img src="<?php echo base_url().'assets/images/'.$row->imagen_pie;?>" class="img-responsive img-fluid contain">
                                      </div>

                                    <div class="caption text-center">
                                        <h5><?php echo $row->nombre_pie;?></h5>
                                        <div class="row">
                                            <div class="col-md-7">
                                                <h4><?php echo number_format($row->precio_pie);?> $</h4>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="hidden" name="quantity" id="<?php echo $row->id_pie;?>" value="1" class="quantity form-control">
                                            </div>
                                        </div>
                                        <button class="add_cart btn btn-light btn-block" data-productid="<?php echo $row->id_pie;?>" data-productname="<?php echo $row->nombre_pie;?>" data-productprice="<?php echo $row->precio_pie;?>">Add To Cart</button>

                                    </div>
                                </div>

                            </div>
                            <?php endforeach;?>

                    </div>

                </div>
                <div class="col-md-3 text-center">
                    <br />
                    <h4>Carrito</h4>
                        <a href="<?php echo base_url(); ?>show_cart"><i class="fas fa-shopping-cart"></i></a>
                     <br />
                      <br />
                     <h4>Categorías</h4>
                     <p><a href="<?php echo base_url(); ?>cart">Todos los productos</a></p>
                     <p><a href="<?php echo base_url(); ?>electrica">Eléctrica</a></p>
                     <p><a href="<?php echo base_url(); ?>electronica">Electrónica</a></p>
                     <p><a href="<?php echo base_url(); ?>mecanica">Mecánica</a></p>
                </div>
            </div>
        </div>

        <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>

        <script type="text/javascript" src="<?php echo base_url().'assets/bootstrap/js/bootstrap.js'?>"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.add_cart').click(function() {
                  <?php if(isset($this->session->userdata['logged_in'])): ?>
                    var product_id = $(this).data("productid");
                    var product_name = $(this).data("productname");
                    var product_price = $(this).data("productprice");
                    var quantity = $('#' + product_id).val();
                    $.ajax({
                        async: true,
                        url: "<?php echo site_url('product/add_to_cart');?>",
                        method: "POST",
                        data: {
                            product_id: product_id,
                            product_name: product_name,
                            product_price: product_price,
                            quantity: quantity
                        },
                        success: function() {
                      window.location.href="cart";

                        }
                    });
                             <?php else: ?>
                        window.location.href="loginUser";
                             <?php endif; ?>
                });


            });
        </script>
        <div class="content_footer">
        </div>
   <?php include('footer.php'); ?>
    </body>

    </html>
