<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "navbar.php"); ?>
<main class="main-single-product">
  <!-- single product -->
  <section class="single-product">
    <div class="container">
      <div class="single-product-container">
        <?php single_product_title(); ?>
        <div class="product-gallery">
          <!-- Slider main container -->
          <div class="swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
              <!-- Slides -->
              <?php single_product_picture() ?>
              <?php single_product_gallery() ?>
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>
          </div>
        </div>
        <?php single_product_details(); ?>
      </div>
    </div>
  </section>
  <!-- related products -->
  <?php related_products(); ?>
</main>
<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>