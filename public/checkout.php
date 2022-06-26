<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "navbar.php"); ?>
<!-- cart -->
<?php

if (!isset($_SESSION['item_quantity'])) {
    redirect("index.php");
    return;
}

?>

<section class="cart-section">
    <div class="container">
        <h1>Info Commande</h1>
        <?php display_alert(); ?>

        <?php checkout(); ?>
        <div class="cart-checkout-form">

            <div class="container">
                <div class="title">Formulaire</div>
                <div class="content">
                    <form method="post">
                        <div class="user-details">
                            <div class="input-box">
                                <span class="details">Nom</span>
                                <input type="text" name="customer_name" placeholder="Entrer votre nom" required>
                            </div>
                            <div class="input-box">
                                <span class="details">Email</span>
                                <input type="email" name="customer_email" placeholder="Entrer votre email">
                            </div>
                            <div class="input-box">
                                <span class="details">Tel</span>
                                <input type="text" name="customer_tel" placeholder="Entrer votre numero" required>
                            </div>
                            <div class="input-box">
                                <span class="details">Ville</span>
                                <input type="text" name="customer_town" placeholder="Entrer votre ville" required>
                            </div>
                            <div class="input-box">
                                <span class="details">Quartier</span>
                                <input type="text" name="customer_quarter" placeholder="Entrer votre quartier" required>
                            </div>
                        </div>

                        <div class="button">
                            <input name="checkout" type="submit" value="Continue">
                        </div>
                    </form>
                </div>
            </div>

            <div class="cart-total">
                <p>
                    <span>Price:</span>

                    <span><?php echo $_SESSION['item_total'] ?> FCFA</span>
                </p>

                <p>

                    <!-- <?php
                            //              if ($_SESSION['item_quantity'] > 0) {
                            //                         echo "
                            //   <span>frais:</span>

                            //   <span> {$_SESSION['frais']} FCFA</span>

                            //   ";
                            //                     }
                            ?> -->
                </p>

                <p>
                    <span>Total Price:</span>

                    <span class="total"><?php echo $_SESSION['item_total_frais']; ?> FCFA</span>
                </p>


            </div>
        </div>
    </div>
</section>
<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>