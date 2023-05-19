<?php include "../helpers/token_session.php"; ?>
<?php include "../includes/header.php"; ?>

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
                                <textarea id="limittambahDeskripsi" name="Deskripsi" class="form-control"
                                    required></textarea>
                            </div>
                            <div id="textCounterTambah">50 Karakter Tersisa</div>
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

<!-- data table  -->
<script>
$(document).ready(function() {
    $("#myTable").DataTable();
});
</script>


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

<!-- Edit SweetAlert script -->
<script>
function editSuccess() {
    Swal.fire({
        icon: 'success',
        title: 'Produk Berhasil Diedit',
        showConfirmButton: false,
        timer: 8000
    });
}

function deleteSuccess() {
    Swal.fire({
        icon: 'success',
        title: 'Produk Berhasil Dihapus',
        showConfirmButton: false,
        timer: 8000
    });
}
</script>

<!-- limit textarea form tambah -->
<script>
$(document).ready(function() {
    $('#limittambahDeskripsi').on('input propertychange', function() {
        charLimitTambah(this, 50);
    });
});

function charLimitTambah(input, maxChar) {
    var len = $(input).val().length;
    $('#textCounterTambah').text(len + ' dari ' + maxChar + ' karakter');

    if (len > maxChar) {
        $(input).val($(input).val().substring(0, maxChar));
        $('#textCounterTambah').text('0 karakter tersisa');
    } else {
        $('#textCounterTambah').text(maxChar - len + ' karakter tersisa');
    }
}
</script>

<!-- limit textarea form edit -->
<script>
$(document).ready(function() {
    $('.editDeskripsi').on('input propertychange', function() {
        charLimit(this, 50);
    });
});

function charLimit(input, maxChar) {
    var len = $(input).val().length;
    var counter = $(input).closest('.modal-body').find('.charNum');
    counter.text(len + ' dari ' + maxChar + ' karakter');

    if (len > maxChar) {
        $(input).val($(input).val().substring(0, maxChar));
        counter.text('0 karakter tersisa');
    } else {
        counter.text(maxChar - len + ' karakter tersisa');
    }
}
</script>


</body>

</html>