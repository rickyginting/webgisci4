<!DOCTYPE html>
<html lang="en">
<?= $this->include('template/home/Head'); ?>

<body>
    <?= $this->include('template/home/Header'); ?>
    <main id="main">
        <section class="counts section-bg">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
                        <div class="count-box">
                            <span data-toggle="counter-up"><?= $sd; ?></span>
                            <p>Total Sekolah Dasar</p>
                            <a href="<?= base_url('?jenjang=sd') ?>">Cek Di Peta &raquo;</a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
                        <div class="count-box">
                            <span data-toggle="counter-up"><?= $smp; ?></span>
                            <p>Total Sekolah Menengah Pertama</p>
                            <a href="<?= base_url('?jenjang=smp') ?>">Cek Di Peta &raquo;</a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
                        <div class="count-box">
                            <span data-toggle="counter-up"><?= $sma; ?></span>
                            <p>Total Sekolah Menengah Atas</p>
                            <a href="<?= base_url('?jenjang=sma') ?>">Cek Di Peta &raquo;</a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
                        <div class="count-box">
                            <span data-toggle="counter-up"><?= $smk; ?></span>
                            <p>Total Sekolah Menengah Kejuruan</p>
                            <a href="<?= base_url('?jenjang=smk') ?>">Cek Di Peta &raquo;</a>
                        </div>
                    </div>

                </div>
            </div>
        </section><!-- End Counts Section -->
        <div id="mapid" class="mapid"></div>
    </main><!-- End #main -->
    <?= $this->include('template/home/Footer'); ?>
    <?= $this->include('template/home/Js'); ?>


    <!-- Leaflet -->
    <link rel="stylesheet" href="<?= base_url('js/leaflet/leaflet.css'); ?>" />
    <script src="<?= base_url('js/leaflet/leaflet.js'); ?>" type='text/javascript'></script>
    <script type='text/javascript'>
        navigator.geolocation.getCurrentPosition(function(location) {
            var latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);

            //map view
            console.log("Lokasi Saat Ini :" + location.coords.latitude, location.coords.longitude);
            // var L = window.L;
            var mymap = L.map('mapid').setView([3.299208, 98.932210], 14);
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                maxZoom: 18,
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1
            }).addTo(mymap);


            <?php foreach ($data as $i) { ?>
                L.marker([<?= $i['latitude']; ?>, <?= $i['longitude']; ?>]).bindPopup(
                    "<img src='<?= base_url('img/sekolah') . "/" . $i['foto_sekolah']; ?>' class='img-fluid'>" +
                    "<b><?= $i['nama_sekolah']; ?></b>" +
                    "<br>Kepala Sekolah : <?= $i['kepala_sekolah']; ?>" +
                    "<hr>" +
                    "<a href='<?= base_url($i['slug']); ?>' class='btn btn-outline-primary btn-sm'>Detail</a><a href='https://www.google.com/maps/dir/?api=1&origin=" +
                    location.coords.latitude + "," + location.coords.longitude + "&destination=<?= $i['latitude']; ?>,<?= $i['longitude']; ?>' class='btn btn-outline-primary btn-sm' target='_blank'>Rute</a>").addTo(mymap);
            <?php } ?>
        });
    </script>
</body>

</html>