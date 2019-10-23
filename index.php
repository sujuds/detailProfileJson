<?php 
    $data = json_decode(file_get_contents('sujud1718082.json'), true);
    $kos = $data['dataKos'];
    $penghuni = $data['dataPenghuni'];
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <title><?= $kos['nama']; ?></title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href=""><b><?= $kos['nama']; ?></b></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="">Home <span class="sr-only">(current)</span></a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row mt-4">
            <?php foreach ($penghuni as $p): ?>
            <div class="card border-secondary mb-4 ml-3 mr-3" style="max-width: 20rem;">
                <div class="card-header"><b><?= $p['nama']; ?></b></div>
                <img src="img/<?= $p['foto'] ?>" class="card-img-top" alt="..." height="300">
                <div class="card-body text-dark">
                    <p class="card-text">Mahasiswa Jurusan <?= $p['jurusan']; ?>, dengan NIM <?= $p['nim']; ?> ini berasal dari <?= $p['asal']; ?>.</p> 
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary float-right edit" data-toggle="modal" data-target="#exampleModalScrollable" data-id="<?= $p['nim']; ?>">Lihat Profile</button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-2 mt-1 float-left" style="width: 10cm; height: 10cm" id="foto"></div>
                        </div>
                        <div class="col-md-6 mt-1" id="detail"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.edit').click(function(){
                var nim = $(this).attr("data-id");
                
                $.getJSON('sujud1718082.json', function (data) {
                    let dataPenghuni = data.dataPenghuni;
                    let nama = '';
                    let foto = '';
                    let detail = '';
                    $.each(dataPenghuni, function (i, data) {
                        if (data.nim == nim) {
                            nama += data.nama;
                            foto += '<img src="img/'+ data.foto +'" class="card-img-top" alt="..." >';
                            detail += '<p><b>Jurusan : </b><br>'+ data.jurusan +'</p> <p><b>NIM : </b><br>'+ data.nim +'</p> <p><b>Jenis Kelamin : </b><br>'+ data.jenisKelamin +'</p> <p><b>Asal : </b><br>'+ data.asal +'</p> <p><b>Agama : </b><br>'+ data.agama +'</p> <p><b>Hobi : </b><br>'+ data.hobi +'</p>';
                        }
                    });
                    $('#exampleModalScrollableTitle').html(nama);
                    $('#foto').html(foto);
                    $('#detail').html(detail);
                    $('#exampleModalScrollable').modal("show");
                });
            });
        });
    </script>
</body>
</html>