<?php
    include "./app/pages/includes/header.php";
?>

<!------------------------------------------------- Books Dito yun! ------------------------------------------------------------->

<div class="container mt-5 text-center">
    <h3 class="mx-2">Garry Kasparov Greatest Games</h3>

    <img class="mb-2 shadow img-fluid border border-dark" id="image" style="max-height: 400px; max-width: 100%;" src="<?=ROOT?>/assets/woodpecker/TheWoodpeckerMethod_page-0001.jpg" alt="broken-image">
    <p id="pageNumber" class="mt-2">Page 1 of 322</p>
    
    <div class="d-flex justify-content-center">
        <button onclick="showPrevious()">Previous</button>
        <button onclick="showNext()">Next</button>
        <input type="number" id="jumpToPage" placeholder="Jump to page">
        <button onclick="jumpToPage()">Go</button>
    </div>

    <script>
    var images = [];
    <?php for ($i = 1; $i <= 322; $i++) : ?>
        images.push("<?=ROOT?>/assets/garrykasparov/GarryKasparov'sGreatestGame_page-<?= sprintf('%04d', $i) ?>.jpg");
    <?php endfor; ?>

    var currentIndex = 0;
    var totalImages = images.length;

    function showImage(index) {
        document.getElementById("image").src = images[index];
        document.getElementById("pageNumber").innerText = "Page " + (index + 1) + " of " + totalImages;

        // Disable or enable Previous and Next buttons based on the current index
        document.getElementById("previousButton").disabled = index === 0;
        document.getElementById("nextButton").disabled = index === totalImages - 1;
    }

    function showNext() {
        if (currentIndex < totalImages - 1) {
            currentIndex++;
            showImage(currentIndex);
        }
    }

    function showPrevious() {
        if (currentIndex > 0) {
            currentIndex--;
            showImage(currentIndex);
        }
    }

    function jumpToPage() {
        var pageNumber = document.getElementById("jumpToPage").value;
        if (pageNumber >= 1 && pageNumber <= totalImages) {
            currentIndex = pageNumber - 1;
            showImage(currentIndex);
        } else {
            alert("Invalid page number. Please enter a valid page number.");
        }
    }

    // Initial display
    showImage(currentIndex);
</script>

</div>

<!------------------------------------------------- Books Dito yun! ------------------------------------------------------------->

<?php
    include "./app/pages/includes/footer.php";
?>

