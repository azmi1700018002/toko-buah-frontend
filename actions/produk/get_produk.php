<?php
$url = "http://localhost:3000/auth/produk";
$token = $_SESSION["token"];
$headers = ["Authorization: Bearer " . $token];
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => $headers,
]);
$response = curl_exec($curl);
curl_close($curl);
$data = json_decode($response, true);
if (isset($data["data"])) {
    $nomor = 1; // initialize the variable
    foreach ($data["data"] as $produk) {
        echo "<tr>";
        echo "<td class='text-center'>" . $nomor . "</td>"; // add the number column
        echo "<td class='text-center'>" . $produk["Nama"] . "</td>";
        echo "<td class='text-center'>" . $produk["Deskripsi"] . "</td>";
        echo "<td class='text-center'>" . $produk["Harga"] . "</td>";
        echo "<td class='text-center'>" . $produk["Stok"] . "</td>";
        echo '<td>
        <div class="d-flex justify-content-center">
       
            <button type="submit" class="btn btn-link btn-rounded btn-sm fw-bold text-warning" data-mdb-ripple-color="dark" data-mdb-toggle="modal" data-mdb-target="#editProduk' .
            $produk["ProdukID"] .
            '">  <i class="fas fa-edit"></i> </button>
            <div class="modal fade" id="editProduk' .
            $produk["ProdukID"] .
            '" tabindex="-1" aria-labelledby="editProduk" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProduk">Edit Produk</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="../actions/produk/put_produk.php">
                        <div class="mb-3" style="display:none;">
    <label class="form-label" for="ProdukID">ID :</label>
    <div class="form-outline">
        <input type="hidden" id="ProdukID" name="ProdukID" class="form-control" value="' .
            $produk["ProdukID"] .
            '">
        </div>
    </div>
                                <div class="mb-3">
                                <label class="form-label" for="Nama">Nama Produk : </label>
                                <div class="form-outline">
                                    <input type="text" id="Nama" name="Nama" class="form-control"
                                    value="' .
            $produk["Nama"] .
            '">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="Deskripsi">Deskripsi : </label>
                                <div class="form-outline">
                                    <textarea id="Deskripsi" name="Deskripsi" class="form-control editDeskripsi" onkeyup="charLimit(this, 50)" maxlength="50"
                                >' .
            $produk["Deskripsi"] .
            '</textarea>
                                </div>
                                <div class="charNum">' .
            strlen($produk["Deskripsi"]) .
            ' dari 50 karakter </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="Harga">Harga : </label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" id="Harga" name="Harga" class="form-control"
                                    value="' .
            $produk["Harga"] .
            '">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="Stok">Stok : </label>
                                <div class="form-outline">
                                    <input type="number" id="Stok" name="Stok" class="form-control"
                                    value="' .
            $produk["Stok"] .
            '">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-mdb-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" onclick="editSuccess()">Edit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
            <button type="submit" class="btn btn-link btn-rounded btn-sm fw-bold text-danger" data-mdb-ripple-color="dark" data-mdb-toggle="modal" data-mdb-target="#deleteProduk' .
            $produk["ProdukID"] .
            '"><i class="fas fa-trash"></i> </button>
          <div class="modal fade" id="deleteProduk' .
            $produk["ProdukID"] .
            '" tabindex="-1" aria-labelledby="deleteProduk" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteProduk">Modal title</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">Apakah yakin ingin menghapus data produk ini?</div>
     
      <div class="modal-footer">
      <button type="button" class="btn btn-warning" data-mdb-dismiss="modal">Batal</button>
      <form method="POST" action="../actions/produk/delete_produk.php">
      <input type="hidden" name="ProdukID" value="' .
            $produk["ProdukID"] .
            '">
            <button type="submit" class="btn btn-danger" onclick="deleteSuccess()">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>  
        </div>
    </div>
    </td>';
        echo "</tr>";
        $nomor++; // increment the variable
    }
} else {
    echo '<div class="alert alert-warning" role="alert">Tidak ada data produk</div>';
}
?>