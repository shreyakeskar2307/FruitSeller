<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <title>About Us - GREENVEG</title>
  <style>
    .about-section {
      padding: 50px 0;
    }
    .about-header {
      text-align: center;
      margin-bottom: 40px;
    }
    .about-text {
      font-size: 1.2rem;
      line-height: 1.6;
    }
    .about-values ul {
      list-style-type: none;
      padding-left: 0;
    }
    .about-values ul li {
      font-size: 1.2rem;
      margin-bottom: 10px;
    }
    .team-member {
      text-align: center;
      margin: 30px 0;
    }
    .team-member img {
      border-radius: 50%;
      max-width: 200px;
    }
    .testimonials {
      background-color: #f9f9f9;
      padding: 40px 0;
    }
    .testimonial-item {
      text-align: center;
      font-style: italic;
    }
    .testimonial-item h4 {
      font-weight: bold;
    }
  </style>
</head>
<body>

<?php include('header.php'); ?>

  <!-- About Us Section -->
  <div class="container about-section" style="margin-top:100px;">
    <h2 class="about-header">About Us</h2>
    <p class="about-text">
    <h4>  Welcome to</h4> <h3 style="color:darkorange">GREENVEG!</h3> <h5>We are passionate about bringing the freshest, healthiest, and most sustainable fruits and vegetables to your table. Our mission is to provide high-quality produce, sourced responsibly from local farmers and organic suppliers. Whether you’re looking for leafy greens, juicy fruits, or exotic vegetables, we have something for everyone!</h5>
    </p>

    
<!-- Carousel -->
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <ol class="carousel-indicators">
    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"></li>
    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4"></li>
    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="5"></li>
    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="6"></li>
    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="7"></li>
    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="8"></li>
    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="9"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="image/slide1.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="image/slide2.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="image/slide13.jpg" alt="Third slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="image/slide14.jpg" alt="Fourth slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="image/slide15.jpg" alt="Fifth slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="image/slide16.jpg" alt="Sixth slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="image/slide7.jpg" alt="Seventh slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="image/slide18.jpg" alt="Eighth slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="image/slide19.jpg" alt="Ninth slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="image/slide10.jpg" alt="Tenth slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </a>
</div>


    <!-- Our Mission & Vision -->
    <div class="mission-vision">
      <h3>Our Mission & Vision</h3>
      <p class="about-text">
        At GREENVEG, our mission is to offer farm-to-table fresh produce that enriches the lives of our customers. We envision a world where healthy food is accessible to all, and sustainability is at the core of everything we do.
      </p>
    </div>

    <!-- Our Values -->
    <div class="about-values">
      <h3>Our Values</h3>
      <ul>
        <li><strong>Freshness:</strong> We believe in providing the freshest produce directly from the farm to your home.</li>
        <li><strong>Sustainability:</strong> We are committed to environmentally friendly farming practices and reducing our carbon footprint.</li>
        <li><strong>Community:</strong> Supporting local farmers and building relationships with our community is at the heart of our business.</li>
        <li><strong>Integrity:</strong> We are transparent in our sourcing, pricing, and business practices, ensuring trust with our customers.</li>
      </ul>
    </div>

        <!-- Timeline/Milestones -->
        <div class="timeline">
      <h3>Our Milestones</h3>
      <ul class="timeline-list">
        <li><strong>2015:</strong> GREENVEG was founded with the goal of providing fresh, sustainable produce to local communities.</li>
        <li><strong>2017:</strong> Expanded to nationwide delivery and began working with organic farms.</li>
        <li><strong>2020:</strong> Launched our sustainable packaging initiative, reducing plastic usage by 80%.</li>
        <li><strong>2022:</strong> Partnered with over 200 local farms and became a leading supplier in the region.</li>
      </ul>
    </div>

    <!-- Meet the Team -->
    <div class="team-member">
      <h3>Meet Our Team</h3>
      <div class="row">
        <div class="col-md-4">
          <img src="images/stamp.png" alt="Team Member 1">
          <h4>Shreya Keskar</h4>
          <p>Founder & CEO</p>
        </div>
        <div class="col-md-4">
          <img src="images/stamp.png" alt="Team Member 2">
          <h4>Shrikant sir</h4>
          <p>Head of Operations</p>
        </div>
        <div class="col-md-4">
          <img src="images/stamp.png" alt="Team Member 3">
          <h4>Dream Technology</h4>
          <p>Marketing Manager</p>
        </div>
      </div>
    </div>

    <!-- Customer Testimonials -->
    <div class="testimonials">
      <h3 class="text-center">What Our Customers Say</h3>
      <div class="row">
        <div class="col-md-4">
          <div class="testimonial-item">
            <p>"GREENVEG offers the best quality vegetables I’ve ever tasted. Their produce is always fresh and arrives at my door on time. Highly recommend!"</p>
            <h4>- Gayatri K</h4>
          </div>
        </div>
        <div class="col-md-4">
          <div class="testimonial-item">
            <p>"I love the variety of fruits available on GREENVEG. It's so convenient to order online and know that I'm getting organic, local produce."</p>
            <h4>- Pravin Sadashiv.</h4>
          </div>
        </div>
        <div class="col-md-4">
          <div class="testimonial-item">
            <p>"Amazing service and the quality is unmatched. I'm a loyal customer for life!"</p>
            <h4>- Amitab Bacchan</h4>
          </div>
        </div>
      </div>
    </div>



  </div>

  <?php include('footer.php'); ?>
</body>
</html>
