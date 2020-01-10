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
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets\css\style_home.css">
      <style>
       /* Make the image fully responsive */
       .carousel-inner img {
           width: 100%;
           height: 100%;
       }
       </style>

   </head>
   <body>
      <div class="wrapper">
         <header>
            <nav>
               <div class="menu-icon">
                  <i class="fa fa-bars fa-2x"></i>
               </div>

               <div class="menu">
                  <ul>
                     <li><a href="<?php echo base_url(); ?>home"><i class="fas fa-home"></i></a></li>
                     <li><a href="cart"><i class="fas fa-store"></i></a></li>
                     <?php if(isset($this->session->userdata['logged_in'])): ?>
                     <li><a href="<?php echo base_url(); ?>show_cart"><i class="fas fa-shopping-cart"></i></a></li>
                     <li><a href="<?php echo base_url(); ?>userPage"<i class="fas fa-user-cog"></i></a></li>
                    <?php endif; ?>

<?php if(isset($this->session->userdata['logged_in'])): ?>
                           <li><a href="<?php echo base_url(); ?>userLogout"<i class="fas fa-sign-out-alt"></i></a></li>
                           <?php else: ?>
                          <li><a href="<?php echo base_url(); ?>loginUser"><i class="fas fa-sign-in-alt"></i></a></li>
                          <?php endif; ?>
                  </ul>
               </div>
            </nav>
<br>
<br>
<br>
<br>
<br>
<br>
<br>



 <div class="container text-center banner" >
               <img class="animated rubberBand" src="<?php echo base_url(); ?>assets\images\Electronica.png" width="75%" alt="Electronica">

							     </div>


         </header>
         <div id="demo" class="carousel slide" data-ride="carousel">


           <!-- The slideshow -->
           <div class="carousel-inner">
             <div class="carousel-item active">
               <img src="<?php echo base_url(); ?>assets\images\banner_1.jpg" style="width:100%;">
             </div>
             <div class="carousel-item">
               <img src="<?php echo base_url(); ?>assets\images\banner_2.jpg"  style="width:100%;">
             </div>
             <div class="carousel-item">
               <img src="<?php echo base_url(); ?>assets\images\banner_3.jpg" style="width:100%;">
             </div>
           </div>

           <!-- Left and right controls -->
           <a class="carousel-control-prev" href="#demo" data-slide="prev">
             <span class="carousel-control-prev-icon"></span>
           </a>
           <a class="carousel-control-next" href="#demo" data-slide="next">
             <span class="carousel-control-next-icon"></span>
           </a>

         </div>



         <div class="container">
	<div class="row">
    		<h2>Productos <b>recomendados</b></h2>
		<div class="col-md-12" style="background-color:#fff">
			<div class="carousel">


			<!-- Wrapper for carousel items -->

				<div class="item carousel-item active">
					<div class="row">
                <?php foreach ($data->result() as $row) : ?>

						<div class="col-sm-3">
							<div class="thumb-wrapper">
								<div class="img-box">
									<img src="<?php echo base_url().'assets/images/'.$row->imagen_pie;?>" class="img-responsive img-fluid contain">
								</div>
								<div class="thumb-content">
									<h4><?php echo $row->nombre_pie;?></h4>
									<p class="item-price"><?php echo number_format($row->precio_pie);?></p>
                  <input type="hidden" name="quantity" id="<?php echo $row->id_pie;?>" value="1" class="quantity form-control">
									  <button class="add_cart btn btn-primary" data-productid="<?php echo $row->id_pie;?>" data-productname="<?php echo $row->nombre_pie;?>" data-productprice="<?php echo $row->precio_pie;?>">Add To Cart</button>
								</div>
							</div>
						</div>
            <?php
            $count++;
            if($count == 4){
              break;
            }
            ?>
              <?php endforeach;?>
					</div>
				</div>


		</div>
		</div>
	</div>
</div>


      </div>
      <div class="content_footer">
      </div>
 <?php include('footer.php'); ?>

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
                      window.location.href="show_cart";
                 }
             });
                      <?php else: ?>
                 window.location.href="loginUser";
                      <?php endif; ?>
         });


     });
 </script>


      <script type="text/javascript">
      $(document).ready(function() {
           $(".menu-icon").on("click", function() {
                 $("nav ul").toggleClass("showing");
           });

          window.onbeforeunload = function(){
            window.scrollTo(0,0);
          }
     });

     // Scrolling Effect

     $(window).on("scroll", function() {
           if($(window).scrollTop()) {
                 $('nav').addClass('black');

           }

           else {
                 $('nav').removeClass('black');
           }
     })




      </script>





   </body>
</html>
