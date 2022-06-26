<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "navbar.php"); ?>


<?php
if (!isset($_SESSION['customer_name'])) {
    redirect("index.php");
    return;
}

?>

<!-- cart -->
<section class="cart-section">
    <div class="container">
        <h1>Rapports de la Commande</h1>
        <?php display_alert(); ?>
        <div class="cart">
            <div class="products">

                <?php
                reports();
                ?>

            </div>

            <div class="cart-total">
                <p>
                    <span>Price:</span>

                    <span><?php echo $_SESSION['item_total'] ?> FCFA</span>
                </p>

                <p>

                    <?php
                    //             if ($_SESSION['item_quantity'] > 0) {
                    //                 echo "
                    //   <span>frais:</span>

                    //   <span> {$_SESSION['frais']} FCFA</span>

                    //   ";
                    //             }
                    ?>
                </p>

                <p>
                    <span>Total Price:</span>

                    <span class="total"><?php echo $_SESSION['item_total_frais']; ?> FCFA</span>
                </p>




            </div>
        </div>
    </div>
</section>

<?php

unset($_SESSION['customer_name']);
empty_cart_sessions()
?>
<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>