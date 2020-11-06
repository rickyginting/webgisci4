<?=$this->extend('auth/BaseView');?>
<?=$this->section('content');?>
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Web GIS Sekolah</h1>
                                </div>
                                <?php if (session()->getFlashdata('pesan')) {
    echo session()->getFlashdata('pesan');}
;?>
                                <form action="/auth/ceklogin" method="POST" class="user">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user"
                                            id="exampleInputEmail" aria-describedby="emailHelp"
                                            placeholder="Enter Email Address..." name="email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password" name="password">
                                    </div>
                                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Login">
                                </form>
                                <hr>

                                <div class="text-center">
                                    <?=($data === 0 ? '<a class="small" href="/auth/register">Buat Akun</a>' : '');?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<?=$this->endSection();?>