<?php
require_once("../config/server.php");

$url = $baseUrl . "auth/newarrival";
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
    foreach ($data["data"] as $newarrival) {
        echo "<tr>";
        echo "<td class='text-center'>" . $nomor . "</td>"; // add the number column
        echo "<td class='text-center'>" . $newarrival["Nama"] . "</td>";
        echo "<td class='text-center'>" . $newarrival["Deskripsi"] . "</td>";
        echo "<td class='text-center'>" . $newarrival["HargaAwal"] . "</td>";
        echo "<td class='text-center'>" . $newarrival["HargaPromo"] . "</td>";
        echo "<td style='text-align: center; vertical-align: middle;'>
        <div style='max-height: 200px; max-width:200px; overflow: hidden; display: inline-block;'>
        <img src='uploads/newarrival/" .
            $newarrival["Gambar"] .
            "' class='img-fluid'>
    </div> </td>";
        echo '<td>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-link btn-rounded btn-sm fw-bold text-warning" data-mdb-ripple-color="dark" data-mdb-toggle="modal" data-mdb-target="#editNewArrival' .
            $newarrival["NewArrivalID"] .
            '">  <i class="fas fa-edit"></i> </button>
            <div class="modal fade" id="editNewArrival' .
            $newarrival["NewArrivalID"] .
            '" tabindex="-1" aria-labelledby="editNewArrival" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editNewArrival">Edit NewArrival</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="../actions/new-arrival/put_new-arrival.php" enctype="multipart/form-data">
                        <div class="mb-3" style="display:none;">
    <label class="form-label" for="NewArrivalID">ID :</label>
    <div class="form-outline">
        <input type="hidden" id="NewArrivalID" name="NewArrivalID" class="form-control" value="' .
            $newarrival["NewArrivalID"] .
            '">
    </div>
</div>
                            <div class="mb-3">
                                <label class="form-label" for="Nama">Nama NewArrival : </label>
                                <div class="form-outline">
                                    <input type="text" id="Nama" name="Nama" class="form-control"
                                    value="' .
            $newarrival["Nama"] .
            '">
                                </div>
                            </div>
                            <div class="mb-3">
                            <label class="form-label" for="Deskripsi">Deskripsi : </label>
                            <div class="form-outline">
                                <textarea id="Deskripsi" name="Deskripsi" class="form-control editDeskripsi" onkeyup="charLimit(this, 50)" maxlength="50"
                            >' .
            $newarrival["Deskripsi"] .
            '</textarea>
                            </div>
                            <div class="charNum">' .
            strlen($newarrival["Deskripsi"]) .
            ' dari 50 karakter </div>
                        </div>
                            <div class="mb-3">
                                <label class="form-label" for="HargaAwal">Harga Awal: </label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" id="HargaAwal" name="HargaAwal" class="form-control"
                                    value="' .
            $newarrival["HargaAwal"] .
            '">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="HargaPromo">Harga Promo: </label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" id="HargaPromo" name="HargaPromo" class="form-control"
                                    value="' .
            $newarrival["HargaPromo"] .
            '">
                                </div>
                            </div>

                            <div class="mb-3">
                            <label class="form-label" for="Gambar">Upload Gambar : </label>
                            <div class="form-outline" style="text-align: center;">
                                ';

        if (!empty($newarrival["Gambar"])) {
            echo '<div style="max-height: 200px; max-width: 200px; overflow: hidden; display: inline-block;">
                                              <img src="uploads/newarrival/' .
                $newarrival["Gambar"] .
                '" class="img-fluid">
                                          </div>';
        }

        echo '
                                <input type="file" id="Gambar" name="gambar" class="form-control">
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
            <button type="submit" class="btn btn-link btn-rounded btn-sm fw-bold text-danger" data-mdb-ripple-color="dark" data-mdb-toggle="modal" data-mdb-target="#deleteNewArrival' .
            $newarrival["NewArrivalID"] .
            '"><i class="fas fa-trash"></i> </button>
          <div class="modal fade" id="deleteNewArrival' .
            $newarrival["NewArrivalID"] .
            '" tabindex="-1" aria-labelledby="deleteNewArrival" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteNewArrival">Modal title</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">Apakah yakin ingin menghapus data newarrival ini ?</div>
     
      <div class="modal-footer">
      <button type="button" class="btn btn-warning" data-mdb-dismiss="modal">Batal</button>
      <form method="POST" action="../actions/new-arrival/delete_new-arrival.php">
      <input type="hidden" name="NewArrivalID" value="' .
            $newarrival["NewArrivalID"] .
            '">
      <button type="submit" class="btn btn-danger" >Hapus</button>
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
    echo '<div class="alert alert-warning" role="alert">Tidak ada data newarrival</div>';
}
?>