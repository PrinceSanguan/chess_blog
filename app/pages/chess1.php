<?php
    include "./app/pages/includes/header.php";
?>

<div class="mx-auto col-md-10">
    <h3 class="mx-2">The Woodpecker Method</h3>

    <!-- Books Dito yun! -->
    <img class="mb-4 shadow img-fluid border border-dark" id="image" src="<?=ROOT?>/assets/woodpecker/TheWoodpeckerMethod_page-0001.jpg" alt="broken-image">
    <button onclick="showPrevious()">Previous</button>
    <button onclick="showNext()">Next</button>

    <script>
        var images = [];
        <?php for ($i = 1; $i <= 300; $i++) : ?>
            images.push("<?=ROOT?>/assets/woodpecker/TheWoodpeckerMethod_page-<?= sprintf('%04d', $i) ?>.jpg");
        <?php endfor; ?>

        var currentIndex = 0;

        function showImage(index) {
            document.getElementById("image").src = images[index];
        }

        function showNext() {
            currentIndex = (currentIndex + 1) % images.length;
            showImage(currentIndex);
        }

        function showPrevious() {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            showImage(currentIndex);
        }

        // Initial display
        showImage(currentIndex);
    </script>

    <!-- Books Dito yun! -->
</div>

<?php
    include "./app/pages/includes/footer.php";
?>
