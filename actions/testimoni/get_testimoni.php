<?php
require_once("../config/server.php");

$url = $baseUrl . "auth/testimoni";
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
    foreach ($data["data"] as $testimoni) {
        echo "<tr>";
        echo "<td class='text-center'>" . $nomor . "</td>"; // add the number column
        echo "<td class='text-center'>" . $testimoni["Nama"] . "</td>";
        echo "<td class='text-center'>" . $testimoni["Deskripsi"] . "</td>";
        echo "<td style='text-align: center; vertical-align: middle;'>
        <div style='max-height: 200px; max-width:200px; overflow: hidden; display: inline-block;'>
        <img src='uploads/testimoni/" .
            $testimoni["Gambar"] .
            "' class='img-fluid'>
    </div> </td>";
        echo '<td>
        <div class="d-flex justify-content-center">
       
            <button type="submit" class="btn btn-link btn-rounded btn-sm fw-bold text-warning" data-mdb-ripple-color="dark" data-mdb-toggle="modal" data-mdb-target="#editTestimoni' .
            $testimoni["TestimoniID"] .
            '">  <i class="fas fa-edit"></i> </button>
            <div class="modal fade" id="editTestimoni' .
            $testimoni["TestimoniID"] .
            '" tabindex="-1" aria-labelledby="editTestimoni" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTestimoni">Edit Testimoni</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="../actions/testimoni/put_testimoni.php" enctype="multipart/form-data">
                        <div class="mb-3" style="display:none;">
    <label class="form-label" for="TestimoniID">ID :</label>
    <div class="form-outline">
        <input type="hidden" id="TestimoniID" name="TestimoniID" class="form-control" value="' .
            $testimoni["TestimoniID"] .
            '">
        </div>
    </div>
                                <div class="mb-3">
                                <label class="form-label" for="Nama">Nama Testimoni : </label>
                                <div class="form-outline">
                                    <input type="text" id="Nama" name="Nama" class="form-control"
                                    value="' .
            $testimoni["Nama"] .
            '">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="Deskripsi">Deskripsi : </label>
                                <div class="form-outline">
                                    <textarea id="Deskripsi" name="Deskripsi" class="form-control editDeskripsi" onkeyup="charLimit(this, 50)" maxlength="50"
                                >' .
            $testimoni["Deskripsi"] .
            '</textarea>
                                </div>
                                <div class="charNum">' .
            strlen($testimoni["Deskripsi"]) .
            ' dari 50 karakter </div>
                            </div>
                    
                            <div class="mb-3">
                            <label class="form-label" for="Gambar">Upload Gambar : </label>
                            <div class="form-outline" style="text-align: center;">
                                ';

        if (!empty($testimoni["Gambar"])) {
            echo '<div style="max-height: 200px; max-width: 200px; overflow: hidden; display: inline-block;">
                                              <img src="uploads/testimoni/' .
                $testimoni["Gambar"] .
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
            <button type="submit" class="btn btn-link btn-rounded btn-sm fw-bold text-danger" data-mdb-ripple-color="dark" data-mdb-toggle="modal" data-mdb-target="#deleteTestimoni' .
            $testimoni["TestimoniID"] .
            '"><i class="fas fa-trash"></i> </button>
          <div class="modal fade" id="deleteTestimoni' .
            $testimoni["TestimoniID"] .
            '" tabindex="-1" aria-labelledby="deleteTestimoni" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteTestimoni">Modal title</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">Apakah yakin ingin menghapus data testimoni ini?</div>
     
      <div class="modal-footer">
      <button type="button" class="btn btn-warning" data-mdb-dismiss="modal">Batal</button>
      <form method="POST" action="../actions/testimoni/delete_testimoni.php">
      <input type="hidden" name="TestimoniID" value="' .
            $testimoni["TestimoniID"] .
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
    echo '<div class="alert alert-warning" role="alert">Tidak ada data testimoni</div>';
}
?>