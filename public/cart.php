<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "navbar.php"); ?>
<!-- cart -->
<section class="cart-section">
  <div class="container">
    <h1>Shopping Cart</h1>
    <?php display_alert(); ?>
    <div class="cart">
      <div class="products">

        <?php
        cart();
        ?>

      </div>

      <div class="cart-total">
        <p>
          <!-- <span>quantity:</span> -->

          <span><?php
                //  echo $_SESSION['item_total']
                ?> </span>
        </p>

        <p>

          <?php
          //  if ($_SESSION['item_quantity'] > 0) {
          //         echo "
          // <span>frais:</span>

          // <span> {$_SESSION['frais']} FCFA</span>

          // ";
          //       }
          ?>
        </p>

        <p>
          <span>Total Price:</span>

          <span class="total"><?php echo $_SESSION['item_total_frais']; ?> FCFA</span>
        </p>

        <?php if ($_SESSION['item_quantity'] > 0) {
          echo "
          
          <a href='./checkout.php'>Proceed to Checkout</a>
          ";
        }
        ?>


      </div>
    </div>
  </div>
</section>
<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>