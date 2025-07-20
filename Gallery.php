<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>OUR SERVICES | Cambridge International School</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-eduwell-style.css">
    <link rel="stylesheet" href="assets/css/owl.css">
</head>

<body>
    <?php include 'include/header.php'; ?>

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

    <?php
    // Adjust pattern if your images have a different naming scheme!
    $images = glob("assets/photos/*.{jpg,jpeg,png,gif}", GLOB_BRACE);
    ?>

    <!-- Gallery Grid -->
    <div class="gallery">
        <?php foreach ($images as $index => $img): ?>
            <img src="<?= $img ?>"
                onclick="openLightbox(<?= $index + 1 ?>)"
                class="thumbnail"
                alt="Gallery Image <?= $index + 1 ?>">
        <?php endforeach; ?>
    </div>

    <!-- Lightbox Modal -->
    <div id="lightboxModal" class="lightbox" onclick="if(event.target==this)closeLightbox();">
        <span class="close" onclick="closeLightbox()">&times;</span>
        <?php foreach ($images as $img): ?>
            <div class="slide">
                <img src="<?= $img ?>" class="lightbox-img" alt="Large gallery image">
            </div>
        <?php endforeach; ?>
        <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
        <a class="next" onclick="changeSlide(1)">&#10095;</a>
    </div>

    <?php include 'include/footer.php'; ?>

    <!-- Bootstrap core JavaScript and dependencies -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Other site scripts can be loaded below -->

    <!-- Lightbox JS -->
    <script>
        let slideIndex = 1;

        function openLightbox(n) {
            document.getElementById('lightboxModal').classList.add('open');
            showSlide(n);
        }

        function closeLightbox() {
            document.getElementById('lightboxModal').classList.remove('open');
            // Hide all slides
            let slides = document.getElementsByClassName('slide');
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
        }

        function showSlide(n) {
            let slides = document.getElementsByClassName('slide');
            if (n > slides.length) {
                slideIndex = 1;
            } else if (n < 1) {
                slideIndex = slides.length;
            } else {
                slideIndex = n;
            }
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slides[slideIndex - 1].style.display = "block";
        }

        function changeSlide(n) {
            showSlide(slideIndex + n);
        }
        // Keyboard navigation and close on ESC
        document.addEventListener('keydown', function(e) {
            const modal = document.getElementById('lightboxModal');
            if (!modal.classList.contains('open')) return;
            if (e.key === "ArrowLeft") {
                changeSlide(-1);
            }
            if (e.key === "ArrowRight") {
                changeSlide(1);
            }
            if (e.key === "Escape") {
                closeLightbox();
            }
        });
    </script>
</body>

</html>