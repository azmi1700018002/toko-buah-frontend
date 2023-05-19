<?php include('../helpers/token_session.php'); ?>
<?php include('../includes/header.php'); ?>

<main style="margin-top: 58px">
    <div class="container pt-4">
        <h3>Form Tambah About</h3>
        <form method="POST" action="../actions/about/add_about.php">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name="Judul" placeholder="Masukkan Judul" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="Deskripsi" rows="3" placeholder="Masukkan Deskripsi"
                    required></textarea>
            </div>
            <button type="submit" class="btn btn-primary float-end"><i class="fas fa-plus me-2"></i>About</button>
        </form>
    </div>
    <div class="container pt-4" id="about-card">
        <h3>Review About</h3>
        <?php include "../actions/about/get_about.php"; ?>
    </div>
</main>

<script type="text/javascript" src="../assets/js/mdb.min.js"></script>
<script type="text/javascript">
// Mengecek apakah sudah ada data sebelumnya
document.addEventListener("DOMContentLoaded", function() {
    var aboutCards = document.querySelectorAll("#about-card .card");
    if (aboutCards.length > 0) {
        // Menampilkan alert jika sudah ada data
        // Show notification
        var alertMessage = document.createElement("div");
        alertMessage.classList.add("alert", "alert-warning", "d-flex", "align-items-center");

        var icon = document.createElement("i");
        icon.classList.add("fas", "fa-exclamation-circle", "me-2");

        var message = document.createElement("div");
        message.innerHTML =
            'Form aktif jika tidak ada data about, Silahkan <a href="#" class="alert-link">Edit</a> atau <a href="#" class="alert-link">Hapus</a> jika ingin menambahkan';

        alertMessage.appendChild(icon);
        alertMessage.appendChild(message);

        var container = document.querySelector(".container");
        container.insertBefore(alertMessage, container.firstChild);

        // Menonaktifkan form input
        var form = document.querySelector("form");
        var inputs = form.querySelectorAll("input, textarea, button");
        inputs.forEach(function(input) {
            input.disabled = true;
        });
    }
});
</script>
</body>

</html>