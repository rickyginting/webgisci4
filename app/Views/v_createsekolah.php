<?= $this->extend('template/BaseView'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $heading; ?></h1>
    </div>
    <?= $this->include('template/statusBar'); ?>
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Peta Sekolah</h6>
                </div>
                <div class="card-body">
                    <div id="mapid" style=" height: 400px;"></div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Create Sekolah</h6>
                </div>
                <div class="card-body">
                    <form action="/form/simpan" method="POST" enctype="multipart/form-data">
                        <?php if ($validation->hasError('checkbox')) { ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Silahkan Centang Kotak Di Bawah ! </strong>Untuk memastikan data yang kamu masukan sudah benar silahkan baca kembali inputan kamu
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <label>Nama Sekolah</label>
                            <input type="text" class="form-control <?= ($validation->hasError('nama_sekolah')) ? 'is-invalid' : ''; ?>" name="nama_sekolah" value="<?= old('nama_sekolah'); ?>" autofocus>
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_sekolah'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Kepala Sekolah</label>
                            <input type="text" class="form-control <?= ($validation->hasError('kepala_sekolah')) ? 'is-invalid' : ''; ?>" name="kepala_sekolah" value="<?= old('kepala_sekolah'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('kepala_sekolah'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jenjang</label>
                            <select class="form-control" name="jenjang">
                                <option value="SD" selected>SD - Sekolah Dasar</option>
                                <option value="SMP">SMP - Sekolah Menengah Pertama</option>
                                <option value="SMA">SMA - Sekolah Menengah Atas</option>
                                <option value="SMK">SMK - Sekolah Menengah Kejuruan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Foto Sekolah</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="foto_sekolah" name="foto_sekolah" onchange="img()">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea type="text" id="ckeditor" class="ckeditor form-control" name="deskripsi"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Staus Sekolah</label>
                            <select class="form-control" name="status">
                                <option value="Negeri" selected>Negeri</option>
                                <option value="Swasta">Swasta</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Akreditas</label>
                            <select class="form-control" name="akreditas">
                                <option value="A" selected>A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="Belum Terakreditas">Belum Terakreditas</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Website Sekolah</label>
                            <input type="url" class="form-control" name="website">
                        </div>
                        <div class="form-group">
                            <label>Latitude</label>
                            <input id="Latitude" type="text" class="form-control <?= ($validation->hasError('latitude')) ? 'is-invalid' : ''; ?>" name="latitude" value="<?= old('latitude'); ?>" readonly>
                            <div class="invalid-feedback">
                                <?= $validation->getError('latitude'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Longitude</label>
                            <input id="Longitude" type="text" class="form-control <?= ($validation->hasError('longitude')) ? 'is-invalid' : ''; ?>" name="longitude" value="<?= old('longitude'); ?>" readonly>
                            <div class="invalid-feedback">
                                <?= $validation->getError('longitude'); ?>
                            </div>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="checkbox">
                            <label class="form-check-label">Data Sudah Benar</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>

<script type='text/javascript'>
    var curLocation = [0, 0];
    if (curLocation[0] == 0 && curLocation[1] == 0) {
        curLocation = [3.299208, 98.932210];
    }

    var L = window.L;

    var mymap = L.map('mapid').setView([3.299208, 98.932210], 13);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11'
    }).addTo(mymap);

    mymap.attributionControl.setPrefix(false);
    var marker = new L.marker(curLocation, {
        draggable: 'true'
    });

    marker.on('dragend', function(event) {
        var position = marker.getLatLng();
        marker.setLatLng(position, {
            draggable: 'true'
        }).bindPopup(position).update();
        $("#Latitude").val(position.lat);
        $("#Longitude").val(position.lng).keyup();
    });

    
    document.addEventListener("DOMContentLoaded", function(event) { 
        $("#Latitude, #Longitude").change(function() {
        var position = [parseInt($("#Latitude").val()), parseInt($("#Longitude").val())];
        marker.setLatLng(position, {
            draggable: 'true'
        }).bindPopup(position).update();
        mymap.panTo(position);
    });
});
    mymap.addLayer(marker);
</script>
<script>
    function img() {
        const gambarLabel = document.querySelector('.custom-file-label');
        gambarLabel.textContent = foto_sekolah.files[0].name;
    }
</script>
<?= $this->endSection(); ?>