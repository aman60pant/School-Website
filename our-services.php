<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">

  <title>OUR SERVICES | Cambridge International School</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-eduwell-style.css">
  <link rel="stylesheet" href="assets/css/owl.css">
  <link rel="stylesheet" href="assets/css/lightbox.css">
  <!--

-->
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
            <h4>What We Do</h4>
            <h1>Our Services</h1>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="services" id="services">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h4>Provided <em>Services</em></h4>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="owl-service-item owl-carousel">
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="assets/img/Playgroup & Nursery.png" alt="">
                </div>
                <h4>Playgroup & Nursery</h4>
                <p>Fostering early childhood development with interactive learning and caring environment.</p>

              </div>
            </div>
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="assets/img/Kindergarten.png" alt="">
                </div>
                <h4>Kindergarten</h4>
                <p>Focus on foundational skills through fun, phonics, storytelling, and basic math.</p>

              </div>
            </div>
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="assets/img/Primary Education.png" alt="">
                </div>
                <h4>Primary Education</h4>
                <p>Balanced focus on academics, values, and individual growth using international pedagogy.</p>

              </div>
            </div>
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="assets/img/Middle School.png" alt="">
                </div>
                <h4>Middle School</h4>
                <p>Inquiry-based curriculum, science labs, digital classrooms, and strong moral education.</p>

              </div>
            </div>
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="assets/img/Secondary Classes.png" alt="">
                </div>
                <h4>Secondary Classes</h4>
                <p>CBSE/ICSE/IGCSE-based curriculum with exam prep, career guidance & continuous evaluation.</p>

              </div>
            </div>
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="assets/img/Senior Secondary.png" alt="">
                </div>
                <h4>Senior Secondary</h4>
                <p>Streams: Science, Commerce, Humanities – with expert faculty and lab integration.</p>

              </div>
            </div>
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="assets/img/International Curriculum.png" alt="">
                </div>
                <h4>International Curriculum</h4>
                <p>Integration of international best practices with national board standards.</p>

              </div>
            </div>
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="assets/img/Smart Classrooms.jpg" alt="">
                </div>
                <h4>Smart Classrooms</h4>
                <p>Digital boards, AV aids, interactive lessons to enhance learning experience.</p>

              </div>
            </div>
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="assets/img/STEM Labs.png" alt="">
                </div>
                <h4>STEM Labs</h4>
                <p>Fully equipped Physics, Chemistry, Biology, and Computer Labs.</p>

              </div>
            </div>
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="assets/img/Co-Curricular Activities.png" alt="">
                </div>
                <h4>Art, Music & Sports</h4>
                <p>Holistic development through dance, drama, yoga, music and physical education.</p>

              </div>
            </div>
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="assets/img/Transportation Facility.png" alt="">
                </div>
                <h4>Safe Transport</h4>
                <p>GPS-enabled buses with trained staff to ensure safe pickup and drop.</p>

              </div>
            </div>
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="assets/img/Qualified Faculty.png" alt="">
                </div>
                <h4>Experienced Teachers</h4>
                <p>Dedicated and trained staff focusing on concept clarity and mentoring.</p>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer Start -->
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