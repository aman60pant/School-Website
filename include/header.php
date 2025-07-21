<header class="header-area header-sticky">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <nav class="main-nav">
          <!-- ***** Logo Start ***** -->
          <a href="index.php #top" class="logo mt-0">
            <img src="assets/img/logo with name without bg.png" alt="Cambridge Logo">
          </a>
          <!-- ***** Logo End ***** -->
          <!-- ***** Menu Start ***** -->
          <ul class="nav">
            <li><a href="index.php #top" class="active">Home</a></li>
            <li><a href="index.php #services">Services</a></li>
            <li><a href="index.php #why-we">Why we?</a></li>
            <li class="has-sub">
              <a href="javascript:void(0)">Pages</a>
              <ul class="sub-menu">
                <li><a href="about-us.php">About Us</a></li>
                <li><a href="our-services.php">Our Services</a></li>
                <li><a href="Gallery.php">Photo Gallery</a></li>
                <li><a href="staff-statement.php">Staff Details</a></li>
                <li><a href="fees-structure.php">Fees</a></li>

              </ul>
            </li>
            <li><a href="index.php #testimonials">Testimonials</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <ul class="navbar-nav ms-auto">
              <?php session_start(); ?>
              <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item">
                  <a class="nav-link" href="#">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="logout.php">Logout</a>
                </li>
              <?php else: ?>
                <li class="nav-item">
                  <a class="nav-link" href="login_form.php">Login</a>
                </li>
              <?php endif; ?>
              </ul>
            <a class='menu-trigger'>
              <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
        </nav>
      </div>
    </div>
  </div>
</header>