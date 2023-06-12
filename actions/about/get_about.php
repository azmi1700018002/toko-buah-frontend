<?php
require_once("../config/server.php");

$url = $baseUrl."auth/about";
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
    foreach ($data["data"] as $about) {
        echo '<div class="container">';
        echo '  <div class="mb-3">';
        echo '    <h6 class="card-title">Judul : </h6>';
        echo '    <div class="card">';
        echo '      <div class="card-body">';
        echo '        <p class="card-text">' . $about["Judul"] . "</p>";
        echo "      </div>";
        echo "    </div>";
        echo "  </div>";
        echo '  <div class="mb-3">';
        echo '    <h6 class="card-title">Deskripsi : </h6>';
        echo '    <div class="card">';
        echo '      <div class="card-body">';
        echo '        <p class="card-text">' . $about["Deskripsi"] . "</p>";
        echo "      </div>";
        echo "    </div>";
        echo "  </div>";
        echo '  <div class="mb-3">';
        echo '  <div class="d-flex justify-content-end">';

        echo '    <button class="btn btn-primary me-2" data-mdb-toggle="modal" data-mdb-target="#editAbout' .
            $about["AboutID"] .
            '">Edit</button>';
        echo '<div class="modal fade" id="editAbout' .
            $about["AboutID"] .
            '" tabindex="-1" aria-labelledby="editAbout" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAbout">Edit About</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="../actions/about/put_about.php">
                        <div class="mb-3" style="display:none;">
                        <label class="form-label" for="AboutID">AboutID :</label>
                        <div class="form-outline">
                            <input type="hidden" id="AboutID" name="AboutID" class="form-control" value="' .
            $about["AboutID"] .
            '">
                        </div>
                    </div>
                            <div class="mb-3">
                                <label class="form-label" for="Judul">Judul : </label>
                                <div class="form-outline">
                                    <input type="text" id="Judul" name="Judul" class="form-control"
                                    value="' .
            $about["Judul"] .
            '">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="Deskripsi">Deskripsi : </label>
                                <div class="form-outline">
                                    <textarea id="Deskripsi" name="Deskripsi" class="form-control"
                                       
                                >' .
            $about["Deskripsi"] .
            '</textarea>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-mdb-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" >Edit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>';
        echo '    <button class="btn btn-danger" data-mdb-toggle="modal" data-mdb-target="#deleteAbout' .
            $about["AboutID"] .
            '">Delete</button>';
        echo '<div class="modal fade" id="deleteAbout' .
            $about["AboutID"] .
            '" tabindex="-1" aria-labelledby="deleteAbout" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="deleteAbout">Hapus About</h5>
            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">Apakah yakin ingin menghapus data about ini ?</div>
        
        <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-mdb-dismiss="modal">Batal</button>
        <form method="POST" action="../actions/about/delete_about.php">
        <input type="hidden" name="AboutID" value="' .
            $about["AboutID"] .
            '">
        <button type="submit" class="btn btn-danger" >Hapus</button>
            </form>
        </div>
        </div>
        </div>';
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo '<div class="alert alert-warning" role="alert">Tidak ada data about</div>';
}
?>