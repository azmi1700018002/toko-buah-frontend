<?php include('../helpers/token_session.php'); ?>
<?php include('../includes/header.php'); ?>

<?php if (isset($_SESSION["login_success"])) { ?>
<script>
Swal.fire({
    icon: 'success',
    title: '<?php echo $_SESSION['login_success']; ?>',
    showConfirmButton: false,
    timer: 8000
});
</script>
<?php unset($_SESSION["login_success"]); ?>
<?php } ?>

<main style="margin-top: 58px">
    <div class="container pt-4">
        <section>
            <div class="row">
                <div class="col-xl-6 col-md-12 mb-4">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <i class="fas fa-cart-plus fa-3x me-4"></i>
                                    </div>
                                    <div>
                                        <h4>Produk</h4>
                                        <p class="mb-0">Total produk yang ditampilkan pada website profile</p>
                                    </div>
                                </div>
                                <div class="align-self-center" id="count_produk">
                                    <!-- Jumlah produk akan ditampilkan di sini -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-12 mb-4">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <i class="fas fa-cart-plus fa-3x me-4"></i>
                                    </div>
                                    <div>
                                        <h4>New Arrival</h4>
                                        <p class="mb-0">Total New Arrival yang ditampilkan pada website profile</p>
                                    </div>
                                </div>
                                <div class="align-self-center" id="count_arrival">
                                    <!-- Jumlah arival akan ditampilkan di sini -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<script type="text/javascript" src="../assets/js/mdb.min.js"></script>
<script>
// Mengambil jumlah data produk dari API dan menampilkan di dalam card
fetch('http://localhost:3000/produk')
    .then(response => response.json())
    .then(data => {
        const totalProdukElement = document.getElementById('count_produk');
        totalProdukElement.innerHTML = `<h2 class="h1 mb-0">${data.count}</h2>`;
    })
    .catch(error => console.log(error));
</script>
<script>
// Mengambil jumlah data produk dari API dan menampilkan di dalam card
fetch('http://localhost:3000/newarrival')
    .then(response => response.json())
    .then(data => {
        const totalNewArivvalElement = document.getElementById('count_arrival');
        totalNewArivvalElement.innerHTML = `<h2 class="h1 mb-0">${data.count}</h2>`;
    })
    .catch(error => console.log(error));
</script>
</body>

</html>