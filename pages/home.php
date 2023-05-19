<?php include "../helpers/token_session.php"; ?>
<?php include "../includes/header.php"; ?>

<main style="margin-top: 58px">
    <div class="container pt-4">
        <h3>Form Tambah Home</h3>
        <form method="POST" action="../actions/home/add_home.php">
            <div class="mb-3">
                <label for="subtitle" class="form-label">Subtitle</label>
                <input type="text" class="form-control" id="subtitle" name="Subtitle"
                    placeholder="Masukkan subtitle Singkat" required>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="Title" placeholder="Masukkan Title" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="Deskripsi" rows="3" placeholder="Masukkan Deskripsi"
                    required></textarea>
            </div>
            <button type="submit" class="btn btn-primary float-end"><i class="fas fa-plus me-2"></i>Home</button>

        </form>
    </div>
    <div class="container pt-4" id="home-card">
        <h3>Review Home</h3>
        <?php include "../actions/home/get_home.php"; ?>
    </div>
</main>

<script type="text/javascript">
var homeCards = document.querySelectorAll("#home-card .card");
if (homeCards.length > 0) {
    var alertMessage = document.createElement("div");
    alertMessage.classList.add("alert", "alert-warning", "d-flex", "align-items-center");

    var icon = document.createElement("i");
    icon.classList.add("fas", "fa-exclamation-circle", "me-2");

    var message = document.createElement("div");
    message.innerHTML =
        'Form aktif jika tidak ada data home, Silahkan <a href="#" class="alert-link">Edit</a> atau <a href="#" class="alert-link">Hapus</a> jika ingin menambahkan';

    alertMessage.appendChild(icon);
    alertMessage.appendChild(message);

    var container = document.querySelector(".container");
    container.insertBefore(alertMessage, container.firstChild);

    var form = document.querySelector("form");
    var inputs = form.querySelectorAll("input, textarea, button");
    inputs.forEach(function(input) {
        input.disabled = true;
    });
}
</script>
<script type="text/javascript" src="../assets/js/mdb.min.js"></script>
</body>


</html>