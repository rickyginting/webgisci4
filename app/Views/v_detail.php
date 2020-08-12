<!DOCTYPE html>
<html lang="en">
<?= $this->include('template/home/Head'); ?>

<body>
    <?= $this->include('template/home/Header'); ?>
    <main id="main">
        <div id="mapid" class="mapid"></div>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><?= $data['nama_sekolah']; ?></h4>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <?= $data['deskripsi']; ?>
                                    </div>
                                    <div class="col">
                                        <img src='<?= base_url('img/sekolah') . "/" . $data['foto_sekolah']; ?>' class='img-fluid'>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Informasi</h4>
                                <hr>
                                <table>
                                    <tr>
                                        <th>Nama Kepala Sekolah : </th>
                                        <td><?= $data['kepala_sekolah']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Status : </th>
                                        <td><?= $data['status']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Akreditas : </th>
                                        <td><?= $data['akreditas']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div id="btn">
                        </div>
                    </div>

                </div>

            </div>
            </div>
        </section><!-- End Counts Section -->

    </main><!-- End #main -->
    <?= $this->include('template/home/Footer'); ?>
    <?= $this->include('template/home/Js'); ?>

    <!-- Leaflet -->
    <link rel="stylesheet" href="<?= base_url('js/leaflet/leaflet.css'); ?>" />
    <script src="<?= base_url('js/leaflet/leaflet.js'); ?>"></script>
    <script async='async' type='text/javascript'>
        // var L = window.L;
        navigator.geolocation.getCurrentPosition(function(location) {

            var latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);
            var mymap = L.map('mapid').setView([<?= $data['latitude']; ?>, <?= $data['longitude']; ?>], 14);
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                maxZoom: 18,
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1
            }).addTo(mymap);

            L.marker([<?= $data['latitude']; ?>, <?= $data['longitude']; ?>]).bindPopup(
                "<img src='<?= base_url('img/sekolah') . "/" . $data['foto_sekolah']; ?>' class='img-fluid'>" +
                "<b><?= $data['nama_sekolah']; ?></b>" +
                "<br>Kepala Sekolah : <?= $data['kepala_sekolah']; ?>").addTo(mymap);

            var btn = document.getElementById('btn');
            btn.innerHTML = "<a href='https://www.google.com/maps/dir/?api=1&origin=" +
                location.coords.latitude + "," + location.coords.longitude + "&destination=<?= $data['latitude']; ?>,<?= $data['longitude']; ?>' class='btn btn-outline-primary mt-2' target='_blank'>Rute</a>" +
                "<a href='<?= $data['website']; ?>' class='btn btn-outline-primary mt-2' target='_blank'>Website</a>";


        });
    </script>

</body>

</html>