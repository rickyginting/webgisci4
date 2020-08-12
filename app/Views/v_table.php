<!DOCTYPE html>
<html lang="en">
<?= $this->include('template/home/Head'); ?>

<body>
    <?= $this->include('template/home/Header'); ?>
    <main id="main">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Nama Sekolah</th>
                                    <th>Kepala Sekolah</th>
                                    <th>Akreditas</th>
                                    <th>Jenjang</th>
                                    <th>Status</th>
                                    <th>Website</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Foto</th>
                                    <th>Nama Sekolah</th>
                                    <th>Kepala Sekolah</th>
                                    <th>Akreditas</th>
                                    <th>Jenjang</th>
                                    <th>Status</th>
                                    <th>Website</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach ($data as $i) { ?>
                                    <tr>
                                        <td><img src="<?= base_url('img/sekolah') . "/" . $i['foto_sekolah']; ?>" width="90px" height="90px" class="img-fluid" alt="<?= $i['nama_sekolah']; ?>" caption="<?= $i['nama_sekolah']; ?>"></td>
                                        <td><a href="<?= base_url($i['slug']); ?>" target="_blank"><?= $i['nama_sekolah']; ?></a></td>
                                        <td><?= $i['kepala_sekolah']; ?></td>
                                        <td><?= $i['akreditas']; ?></td>
                                        <td><?= $i['jenjang']; ?></td>
                                        <?php if ($i['status'] == "Negeri") {
                                            echo '<td><span class="badge badge-primary">' . $i['status'] . '</span></td>';
                                        } else {
                                            echo '<td><span class="badge badge-success">' . $i['status'] . '</span></td>';
                                        }

                                        ?>
                                        <td><a href="<?= $i['website']; ?>" target="_blank"><?= $i['website']; ?></a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section><!-- End Counts Section -->

    </main><!-- End #main -->
    <?= $this->include('template/home/Footer'); ?>
    <?= $this->include('template/home/Js'); ?>


</body>

</html>