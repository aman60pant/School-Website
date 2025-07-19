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
                        <h4>Gallery</h4>
                        <h1>Our Gallery</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Thumbnails -->
    <?php
    $images = glob("assets/img/*.{jpg,jpeg,png,gif}", GLOB_BRACE);
    ?>

    <!-- Gallery Thumbnails -->
    <div class="gallery">
        <?php foreach ($images as $index => $img): ?>
            <img src="<?= $img ?>" onclick="openLightbox();showSlide(<?= $index + 1 ?>)" class="thumbnail">
        <?php endforeach; ?>
    </div>

    <!-- Lightbox Modal -->
    <div id="lightboxModal" class="lightbox">
        <span class="close" onclick="closeLightbox()">&times;</span>

        <!-- Slides -->
        <?php foreach ($images as $img): ?>
            <div class="slide"><img src="<?= $img ?>" class="lightbox-img"></div>
        <?php endforeach; ?>

        <!-- Navigation -->
        <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
        <a class="next" onclick="changeSlide(1)">&#10095;</a>
    </div>



    <!-- Navigation -->
    <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
    <a class="next" onclick="changeSlide(1)">&#10095;</a>
    </div>
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
        let currentSlideIndex = 1;

        function openLightbox() {
            document.getElementById("lightboxModal").style.display = "block";
        }

        function closeLightbox() {
            document.getElementById("lightboxModal").style.display = "none";
        }

        function showSlide(n) {
            let slides = document.getElementsByClassName("slide");
            if (n > slides.length) currentSlideIndex = 1;
            else if (n < 1) currentSlideIndex = slides.length;
            else currentSlideIndex = n;

            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }

            slides[currentSlideIndex - 1].style.display = "block";
        }

        function changeSlide(n) {
            showSlide(currentSlideIndex + n);
        }
    </script>
</body>

</html>