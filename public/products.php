<?php require_once("../resources/config.php"); ?>


<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "navbar.php"); ?>

<!-- products -->

<!-- usage of filter isotope.js on products -->
<section class="product" id="products">
  <h1 class="heading-title">Popular Products</h1>
  <!-- filter button -->
  <div class="filter-group" id="filter">
    <button class="product-filter is-checked" data-filter="*">All products</button>
    <?php categories(); ?>
  </div>

  <!-- product list -->
  <div class="product-wrapper">
    <?php products(); ?>
  </div>
</section>

<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>