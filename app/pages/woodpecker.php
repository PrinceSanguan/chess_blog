<?php
    include "./app/pages/includes/header.php";
?>

<div class="container mt-5 text-center">
    <h3 class="mx-2">The Woodpecker Method</h3>

    <!-- Books Dito yun! -->
    <img class="mb-2 shadow img-fluid border border-dark" id="image" style="max-height: 400px; max-width: 100%;" src="<?=ROOT?>/assets/woodpecker/TheWoodpeckerMethod_page-0001.jpg" alt="broken-image">
    <p id="pageNumber" class="mt-2">Page 1 of 394</p>
    
    <div class="d-flex justify-content-center">
        <button onclick="showPrevious()">Previous</button>
        <button onclick="showNext()">Next</button>
        <input type="number" id="jumpToPage" placeholder="Jump to page">
        <button onclick="jumpToPage()">Go</button>
    </div>

    <script>
        var images = [];
        <?php for ($i = 1; $i <= 394; $i++) : ?>
            images.push("<?=ROOT?>/assets/woodpecker/TheWoodpeckerMethod_page-<?= sprintf('%04d', $i) ?>.jpg");
        <?php endfor; ?>

        var currentIndex = 0;

        function showImage(index) {
            document.getElementById("image").src = images[index];
            document.getElementById("pageNumber").innerText = "Page " + (index + 1) + " of " + images.length;
        }

        function showNext() {
            currentIndex = (currentIndex + 1) % images.length;
            showImage(currentIndex);
        }

        function showPrevious() {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            showImage(currentIndex);
        }

        function jumpToPage() {
            var pageNumber = document.getElementById("jumpToPage").value;
            if (pageNumber >= 1 && pageNumber <= images.length) {
                currentIndex = pageNumber - 1;
                showImage(currentIndex);
            } else {
                alert("Invalid page number. Please enter a valid page number.");
            }
        }

        // Initial display
        showImage(currentIndex);
    </script>

    <!-- Books Dito yun! -->
</div>

<?php
    include "./app/pages/includes/footer.php";
?>

