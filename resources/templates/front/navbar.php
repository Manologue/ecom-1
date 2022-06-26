<!-- navbar -->
<!-- navbar -->
<nav>
 <!-- adding burger menu -->
 <div class="menu-toggle">
  <span class="bar"></span>
  <span class="bar"></span>
  <span class="bar"></span>
 </div>
 <h2 class="logo">Jabea-<span>Store</span></h2>
 <div class="menu-list">
  <a href="index.php">Home</a>
  <a href="index.php#featured">selection</a>
  <a href="products.php">Products</a>
  <a href="index.php#contact">Contact</a>
 </div>
 <div class="menu-right">
  <div class="search">
   <button class="btn btn-menu">
    <i class="fas fa-search"></i>
   </button>
  </div>

  <div class="cart">
   <div class="cart-container">
    <a href="./cart.php">
     <button class="btn btn-menu">
      <i class="bx bx-shopping-bag"></i>
     </button>
    </a>
    <?php count_cart(); ?>
   </div>
   <!-- adding cart list-->
   <div class="cart-content">
    <?php cart_items(); ?>
   </div>
  </div>
 </div>
</nav>