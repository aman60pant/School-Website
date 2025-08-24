<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <title>Contact-us | Cambridge International School</title>
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-eduwell-style.css">
  <link rel="stylesheet" href="assets/css/owl.css">
  <link rel="stylesheet" href="assets/css/lightbox.css">
</head>

<body>
  <!-- ***** Header Area Start ***** -->
  <?php
  include 'include/header.php'
  ?>
  <!-- ***** Header Area End ***** -->

  <section class="page-heading">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="header-text">
            <h4>Say Hello!</h4>
            <h1>Contact Us</h1>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="more-info">
    <div class="container">
      <div class="row">
        <div class="col-lg-5">
          <div class="section-heading">
            <h6>More Info</h6>
            <h4>Read More <em>About Us</em></h4>
          </div>
          <p>Cambridge International School's buildings and grounds are located at Shahpur Bus Stand, Talheri Buzurg, Saharanpur. Cambridge International School is from playground to C.B.S.E.(Class X). Cambridge International School is located in extremely quiet, open and healthy surroundings.<br><br>It is away from the hustle and bustle of the town. The School Campus is naturally landscaped and lush green with special care taken to create an atmosphere conductive for a child.<br><br>For all round development of personality of the students, our school is a plethora of Co-curricular activities. Facilities of Indoor games and outdoor sports, art-craft and cultural activities are offered. Cambridge International School has latest facilities and well equipped labs, well stocked air conditioned library.<br><br>we also provide stress free & a congenial learning environment further enriching their personalities to become future torch bearers. Many passout students today hold/adorn key/vital positions in various organizations. Their utmost sincerity, self dedication ,empathic & humane attitude of our students reflect their Alma-mater. We are proud of them.</p>
        </div>
        <div class="col-lg-6 offset-lg-1 align-self-center">
          <div class="row">
            <div class="col-6">
              <div class="count-area-content">
                <div class="count-digit">7825</div>
                <div class="count-title">Total Students Enrolled</div>
              </div>
            </div>
            <div class="col-6">
              <div class="count-area-content">
                <div class="count-digit">43</div>
                <div class="count-title">Experienced Facilities</div>
              </div>
            </div>
            <div class="col-6">
              <div class="count-area-content">
                <div class="count-digit">98</div>
                <div class="count-title">Average Passing Percentage</div>
              </div>
            </div>
            <div class="col-6">
              <div class="count-area-content">
                <div class="count-digit">2487</div>
                <div class="count-title">Total Awards Won</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer Section -->
  <?php
  include 'include/footer.php'
  ?>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/lightbox.js"></script>
  <script src="assets/js/tabs.js"></script>
  <script src="assets/js/video.js"></script>
  <script src="assets/js/slick-slider.js"></script>
  <script src="assets/js/custom.js"></script>
  <script>
    //according to loftblog tut
    $('.nav li:first').addClass('active');

    var showSection = function showSection(section, isAnimate) {
      var
        direction = section.replace(/#/, ''),
        reqSection = $('.section').filter('[data-section="' + direction + '"]'),
        reqSectionPos = reqSection.offset().top - 0;

      if (isAnimate) {
        $('body, html').animate({
            scrollTop: reqSectionPos
          },
          800);
      } else {
        $('body, html').scrollTop(reqSectionPos);
      }

    };

    var checkSection = function checkSection() {
      $('.section').each(function() {
        var
          $this = $(this),
          topEdge = $this.offset().top - 80,
          bottomEdge = topEdge + $this.height(),
          wScroll = $(window).scrollTop();
        if (topEdge < wScroll && bottomEdge > wScroll) {
          var
            currentId = $this.data('section'),
            reqLink = $('a').filter('[href*=\\#' + currentId + ']');
          reqLink.closest('li').addClass('active').
          siblings().removeClass('active');
        }
      });
    };

    $('.main-menu, .responsive-menu, .scroll-to-section').on('click', 'a', function(e) {
      e.preventDefault();
      showSection($(this).attr('href'), true);
    });

    $(window).scroll(function() {
      checkSection();
    });
    
  </script>

</body>

</html>