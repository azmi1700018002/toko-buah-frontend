<?php include('../helpers/token_session.php'); ?>
<?php include('../includes/header.php'); ?>

<main style="margin-top: 58px">
    <div class="container pt-4">
        <h3>Product Buah</h3>
        <p>data tampilan produk buah</p>
        <button type="button" class="btn btn-outline-primary ms-auto" data-mdb-ripple-color="dark"
            data-mdb-toggle="modal" data-mdb-target="#tambahProduk">
            <i class="fas fa-plus me-2"></i>
            Produk
        </button>
        <section>
            <div class="my-4 table-responsive">
                <table id="myTable">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Produk</th>
                            <th class="text-center">Deskripsi</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Stok</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include "../actions/produk/get_produk.php"; ?>
                    </tbody>
                </table>
            </div>
    </div>

    <!-- Modal Add -->
    <div class="modal fade" id="tambahProduk" tabindex="-1" aria-labelledby="tambahProduk" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../actions/produk/add_produk.php" method="POST">

                        <div class="mb-3">
                            <label class="form-label" for="Nama">Nama Produk : </label>
                            <div class="form-outline">
                                <input type="text" id="Nama" name="Nama" class="form-control" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="Deskripsi">Deskripsi : </label>
                            <div class="form-outline">
                                <textarea id="Deskripsi" name="Deskripsi" class="form-control"
                                    onkeyup="countChars(this)" maxlength="50" required></textarea>
                            </div>
                            <div id="charNum">0 dari 50 karakter</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="Harga">Harga : </label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" id="Harga" name="Harga" class="form-control" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="Stok">Stok : </label>
                            <div class="form-outline">
                                <input type="number" id="Stok" name="Stok" class="form-control" required />
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-mdb-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success" onclick="addSuccess()">Tambah</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    </section>
</main>

<script type="text/javascript" src="../assets/js/mdb.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<!-- Add SweetAlert script -->
<script>
function addSuccess() {
    Swal.fire({
        icon: 'success',
        title: 'Produk Berhasil Ditambahkan',
        showConfirmButton: false,
        timer: 8000
    });
}
</script>


<script>
$(document).ready(function() {
    $("#myTable").DataTable();
});
</script>
</body>

</html>