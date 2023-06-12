<?php
require_once("../config/server.php");

$url = $baseUrl . "auth/home";
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
    foreach ($data["data"] as $home) {
        echo '<div class="container">';
        echo '  <div class="mb-3">';
        echo '    <h6 class="card-title">Subtitle : </h6>';
        echo '    <div class="card">';
        echo '      <div class="card-body">';
        echo '        <p class="card-text">' . $home["Subtitle"] . "</p>";
        echo "      </div>";
        echo "    </div>";
        echo "  </div>";
        echo '  <div class="mb-3">';
        echo '    <h6 class="card-title">Title : </h6>';
        echo '    <div class="card">';
        echo '      <div class="card-body">';
        echo '        <p class="card-text">' . $home["Title"] . "</p>";
        echo "      </div>";
        echo "    </div>";
        echo "  </div>";
        echo '  <div class="mb-3">';
        echo '    <h6 class="card-title">Deskripsi : </h6>';
        echo '    <div class="card">';
        echo '      <div class="card-body">';
        echo '        <p class="card-text">' . $home["Deskripsi"] . "</p>";
        echo "      </div>";
        echo "    </div>";
        echo "  </div>";
        echo '  <div class="mb-3">';
        echo '  <div class="d-flex justify-content-end">';

        echo '    <button class="btn btn-primary me-2" data-mdb-toggle="modal" data-mdb-target="#edithome' .
            $home["HomeID"] .
            '">Edit</button>';
        echo '<div class="modal fade" id="edithome' .
            $home["HomeID"] .
            '" tabindex="-1" aria-labelledby="edithome" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edithome">Edit home</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="../actions/home/put_home.php">
                        <div class="mb-3" style="display:none;">
                        <label class="form-label" for="HomeID">HomeID :</label>
                        <div class="form-outline">
                            <input type="hidden" id="HomeID" name="HomeID" class="form-control" value="' .
            $home["HomeID"] .
            '">
                        </div>
                    </div>
                    <div class="mb-3">
                    <label class="form-label" for="Subtitle">Subtitle : </label>
                    <div class="form-outline">
                        <input type="text" id="Subtitle" name="Subtitle" class="form-control"
                        value="' .
            $home["Subtitle"] .
            '">
                                </div>
                            </div>            
                            <div class="mb-3">
                                <label class="form-label" for="Title">Title : </label>
                                <div class="form-outline">
                                    <input type="text" id="Title" name="Title" class="form-control"
                                    value="' .
            $home["Title"] .
            '">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="Deskripsi">Deskripsi : </label>
                                <div class="form-outline">
                                    <textarea id="Deskripsi" name="Deskripsi" class="form-control"
                                        onkeyup="countChars(this)" maxlength="250"
                                >' .
            $home["Deskripsi"] .
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
        echo '    <button class="btn btn-danger" data-mdb-toggle="modal" data-mdb-target="#deletehome' .
            $home["HomeID"] .
            '">Delete</button>';
        echo '<div class="modal fade" id="deletehome' .
            $home["HomeID"] .
            '" tabindex="-1" aria-labelledby="deletehome" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="deletehome">Hapus home</h5>
            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">Apakah yakin ingin menghapus data home ini ?</div>
        
        <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-mdb-dismiss="modal">Batal</button>
        <form method="POST" action="../actions/home/delete_home.php">
        <input type="hidden" name="HomeID" value="' .
            $home["HomeID"] .
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
    echo '<div class="alert alert-warning" role="alert">Tidak ada data home</div>';
}
?>