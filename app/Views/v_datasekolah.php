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
            <?php if (session()->getFlashdata('pesan')) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses !</strong> <?= session()->getFlashdata('pesan'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Sekolah</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Nama Sekolah</th>
                                    <th>Kepala Sekolah</th>
                                    <th>Akreditas</th>
                                    <th>Status</th>
                                    <th>Website</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Foto</th>
                                    <th>Nama Sekolah</th>
                                    <th>Kepala Sekolah</th>
                                    <th>Akreditas</th>
                                    <th>Status</th>
                                    <th>Website</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach ($data as $i) { ?>
                                    <tr>
                                        <td><img src="<?= base_url('img/sekolah') . "/" . $i['foto_sekolah']; ?>" width="90px" height="90px" class="img-fluid" alt="<?= $i['nama_sekolah']; ?>" caption="<?= $i['nama_sekolah']; ?>"></td>
                                        <td><a href="<?= base_url($i['slug']); ?>" target="_blank"><?= $i['nama_sekolah']; ?></a></td>
                                        <td><?= $i['kepala_sekolah']; ?></td>
                                        <td><?= $i['akreditas']; ?></td>
                                        <?php if ($i['status'] == "Negeri") {
                                            echo '<td><span class="badge badge-primary">' . $i['status'] . '</span></td>';
                                        } else {
                                            echo '<td><span class="badge badge-success">' . $i['status'] . '</span></td>';
                                        }

                                        ?>
                                        <td><a href="<?= $i['website']; ?>" target="_blank"><?= $i['website']; ?></a></td>
                                        <td><a href="<?= base_url('form/update/') . "/" . $i['slug']; ?>" class="btn btn-warning mb-2 btn-sm">Update</a><br><a href="<?= base_url('form/hapus/') . "/" . $i['id']; ?>" class="btn btn-danger btn-sm">Hapus</a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>