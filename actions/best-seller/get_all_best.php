<?php
require_once("../config/server.php");

$url = $baseUrl . "auth/bestseller";
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
    foreach ($data["data"] as $bestseller) {
        echo "<tr>";
        echo "<td class='text-center'>" . $nomor . "</td>"; // add the number column
        echo "<td class='text-center'>" . $bestseller["Nama"] . "</td>";
        echo "<td class='text-center'>" . $bestseller["Deskripsi"] . "</td>";
        echo "<td style='text-align: center; vertical-align: middle;'>
        <div style='max-height: 200px; max-width:200px; overflow: hidden; display: inline-block;'>
        <img src='uploads/bestseller/" .
            $bestseller["Gambar"] .
            "' class='img-fluid'>
    </div> </td>";
        echo '<td>
        <div class="d-flex justify-content-center">
       
            <button type="submit" class="btn btn-link btn-rounded btn-sm fw-bold text-warning" data-mdb-ripple-color="dark" data-mdb-toggle="modal" data-mdb-target="#editBestseller' .
            $bestseller["BestsellerID"] .
            '">  <i class="fas fa-edit"></i> </button>
            <div class="modal fade" id="editBestseller' .
            $bestseller["BestsellerID"] .
            '" tabindex="-1" aria-labelledby="editBestseller" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBestseller">Edit Bestseller</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="../actions/best-seller/put_bestseller.php" enctype="multipart/form-data">
                        <div class="mb-3" style="display:none;">
    <label class="form-label" for="BestsellerID">ID :</label>
    <div class="form-outline">
        <input type="hidden" id="BestsellerID" name="BestsellerID" class="form-control" value="' .
            $bestseller["BestsellerID"] .
            '">
        </div>
    </div>
                                <div class="mb-3">
                                <label class="form-label" for="Nama">Nama Bestseller : </label>
                                <div class="form-outline">
                                    <input type="text" id="Nama" name="Nama" class="form-control"
                                    value="' .
            $bestseller["Nama"] .
            '">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="Deskripsi">Deskripsi : </label>
                                <div class="form-outline">
                                    <textarea id="Deskripsi" name="Deskripsi" class="form-control editDeskripsi" onkeyup="charLimit(this, 50)" maxlength="50"
                                >' .
            $bestseller["Deskripsi"] .
            '</textarea>
                                </div>
                                <div class="charNum">' .
            strlen($bestseller["Deskripsi"]) .
            ' dari 50 karakter </div>
                            </div>
                            <div class="mb-3">
                            <label class="form-label" for="Gambar">Upload Gambar : </label>
                            <div class="form-outline" style="text-align: center;">
                                ';

        if (!empty($bestseller["Gambar"])) {
            echo '<div style="max-height: 200px; max-width: 200px; overflow: hidden; display: inline-block;">
                                              <img src="uploads/bestseller/' .
                $bestseller["Gambar"] .
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
            <button type="submit" class="btn btn-link btn-rounded btn-sm fw-bold text-danger" data-mdb-ripple-color="dark" data-mdb-toggle="modal" data-mdb-target="#deleteBestseller' .
            $bestseller["BestsellerID"] .
            '"><i class="fas fa-trash"></i> </button>
          <div class="modal fade" id="deleteBestseller' .
            $bestseller["BestsellerID"] .
            '" tabindex="-1" aria-labelledby="deleteBestseller" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteBestseller">Modal title</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">Apakah yakin ingin menghapus data bestseller ini?</div>
     
      <div class="modal-footer">
      <button type="button" class="btn btn-warning" data-mdb-dismiss="modal">Batal</button>
      <form method="POST" action="../actions/best-seller/delete_bestseller.php">
      <input type="hidden" name="BestsellerID" value="' .
            $bestseller["BestsellerID"] .
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
    echo '<div class="alert alert-warning" role="alert">Tidak ada data bestseller</div>';
}
?>