<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "navbar.php"); ?>
<!-- home -->
<header id="home">
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      <?php
      slider_images();

      ?>

    </div>
    <div class="swiper-pagination"></div>
  </div>
</header>
<!-- product featured -->
<section class="product-featured" id="featured">
  <h2 class="product-category">best selling</h2>
  <button class="pre-btn"><img src="images/arrow.png" alt="" /></button>
  <button class="nxt-btn"><img src="images/arrow.png" alt="" /></button>
  <div class="product-container">
    <?php featured_products(); ?>
  </div>
  <div class="container-slider-circle">
    <div class="circle-slide circle-prev active"></div>
    <div class="circle-slide circle-next"></div>
  </div>
</section>
<!-- offer -->
<section class="offers" id="offers">
  <div class="offers-wrapper">
    <h2>Season Sales</h2>
    <h2>Up to 50% off All Products</h2>
    <a href="products.php">
      <button class="offers-button">voir nos produits</button>
    </a>
  </div>
</section>
<!-- collection -->
<?php
$query = query("SELECT * FROM collections");
confirm($query);
// check num of rows in collections table
if (mysqli_num_rows($query) > 0) {

  echo '
 
 <section class="collection">
   <h1 class="heading-title">Discover Collections</h1>
   <div class="collection-wrapper">
     <!-- left side -->
     <div class="collection-left">
 
 ';

  collections();

  echo '    </div>
      <!-- right side -->
      <div class="collection-right">';

  collection_products();
  echo '    
      </div>
    </div>
  </section>
';
}

?>
<!-- products -->


<!-- contact -->
<section class="contact" id="contact">
  <div class="content">
    <h2>Contact Us</h2>
    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam
      assumenda, perferendis laborum voluptate impedit sequi molestias
      doloribus asperiores? Expedita, illum!
    </p>
  </div>
  <div class="container">
    <div class="contactInfo">
      <div class="box">
        <div class="icon">
          <i class="fa-solid fa-location-dot"></i>
        </div>
        <div class="text">
          <h2>Address</h2>
          <p>465 road 13 yde route jouvence,<br />lake tokoss<br />56300</p>
        </div>
      </div>
      <div class="box">
        <div class="icon">
          <i class="fa-solid fa-envelope"></i>
        </div>
        <div class="text">
          <h2>Phone</h2>
          <p>652789621</p>
        </div>
      </div>
      <div class="box">
        <div class="icon">
          <i class="fa-solid fa-phone"></i>
        </div>
        <div class="text">
          <h2>Email</h2>
          <p>manologue@gmail.com</p>
        </div>
      </div>
    </div>
    <div class="contactForm">
      <!-- contact form -->
      <form>
        <!-- alert -->
        <div class="alert"></div>
        <h2>Send Message</h2>
        <div class="input-box">
          <input type="text" name="name" required />
          <span>Full Name</span>
        </div>
        <div class="input-box">
          <input type="text" name="tel" />
          <span>Tel</span>
        </div>
        <div class="input-box">
          <input type="text" name="email" />
          <span>Email</span>
        </div>
        <div class="input-box">
          <textarea name="message" required></textarea>
          <span>Type Your Message...</span>
        </div>
        <div class="input-box">
          <input type="submit" name="send" value="send" />
        </div>
      </form>
    </div>
  </div>
</section>


<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>