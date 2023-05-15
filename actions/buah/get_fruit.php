<?php
$url = "http://localhost:3000/auth/buah";
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
    foreach ($data["data"] as $buah) {
        echo "<tr>";
        echo "<td class='text-center'>" . $nomor . "</td>"; // add the number column
        echo "<td class='text-center'>" . $buah["Nama"] . "</td>";
        echo "<td class='text-center'>" . $buah["Deskripsi"] . "</td>";
        echo "<td class='text-center'>" . $buah["Harga"] . "</td>";
        echo "<td class='text-center'>" . $buah["Stok"] . "</td>";
        echo '<td>
        <div class="d-flex justify-content-center">
       
            <button type="submit" class="btn btn-link btn-rounded btn-sm fw-bold text-warning" data-mdb-ripple-color="dark" data-mdb-toggle="modal" data-mdb-target="#editBuah' .
            $buah["BuahID"] .
            '">  <i class="fas fa-edit"></i> </button>
            <div class="modal fade" id="editBuah' .
            $buah["BuahID"] .
            '" tabindex="-1" aria-labelledby="editBuah" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBuah">Edit Buah</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="../actions/buah/put_fruit.php">
                        <div class="mb-3" style="display:none;">
    <label class="form-label" for="BuahID">ID :</label>
    <div class="form-outline">
        <input type="hidden" id="BuahID" name="BuahID" class="form-control" value="' .
            $buah["BuahID"] .
            '">
    </div>
</div>
                            <div class="mb-3">
                                <label class="form-label" for="Nama">Nama Buah : </label>
                                <div class="form-outline">
                                    <input type="text" id="Nama" name="Nama" class="form-control"
                                    value="' .
            $buah["Nama"] .
            '">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="Deskripsi">Deskripsi : </label>
                                <div class="form-outline">
                                    <textarea id="Deskripsi" name="Deskripsi" class="form-control"
                                        onkeyup="countChars(this)" maxlength="50"
                                >' .
            $buah["Deskripsi"] .
            '</textarea>
                                </div>
                                <div id="charNum">0 dari 50 karakter</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="Harga">Harga : </label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" id="Harga" name="Harga" class="form-control"
                                    value="' .
            $buah["Harga"] .
            '">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="Stok">Stok : </label>
                                <div class="form-outline">
                                    <input type="number" id="Stok" name="Stok" class="form-control"
                                    value="' .
            $buah["Stok"] .
            '">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-mdb-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Edit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
            <button type="submit" class="btn btn-link btn-rounded btn-sm fw-bold text-danger" data-mdb-ripple-color="dark" data-mdb-toggle="modal" data-mdb-target="#deleteBuah' .
            $buah["BuahID"] .
            '"><i class="fas fa-trash"></i> </button>
          <div class="modal fade" id="deleteBuah' .
            $buah["BuahID"] .
            '" tabindex="-1" aria-labelledby="deleteBuah" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteBuah">Modal title</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">Apakah yakin ingin menghapus data buah ini ?</div>
     
      <div class="modal-footer">
      <button type="button" class="btn btn-warning" data-mdb-dismiss="modal">Batal</button>
      <form method="POST" action="../actions/buah/delete_fruit.php">
      <input type="hidden" name="BuahID" value="' .
            $buah["BuahID"] .
            '">
      <button type="submit" class="btn btn-danger">Hapus</button>
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
    echo '<div class="alert alert-warning" role="alert">Tidak ada data buah</div>';
}
?>