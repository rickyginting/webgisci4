<?php

namespace App\Controllers;

use App\Models\DataModel;

class Form extends BaseController
{
    protected $DataModel;
    public function __construct()
    {
        $this->DataModel = new DataModel();
    }

    public function index()
    {
        return redirect()->to('/form/datasekolah');
    }

    public function datasekolah()
    {
        $data = [
            'title' => "Data Sekolah",
            'appname' => "WEBGIS - CI",
            'heading' => "Data Sekolah",
            'data' => $this->DataModel->getSekolah(),
            'sd' => $this->DataModel->countSekolah("SD"),
            'smp' => $this->DataModel->countSekolah("SMP"),
            'sma' => $this->DataModel->countSekolah("SMA"),
            'smk' => $this->DataModel->countSekolah("SMK")
        ];

        return view('v_datasekolah', $data);
    }
    public function createsekolah()
    {
        session();
        $data = [
            'title' => "Create Sekolah",
            'appname' => "WEBGIS - CI",
            'heading' => "Create Sekolah",
            'validation' => \Config\Services::validation(),
            'sd' => $this->DataModel->countSekolah("SD"),
            'smp' => $this->DataModel->countSekolah("SMP"),
            'sma' => $this->DataModel->countSekolah("SMA"),
            'smk' => $this->DataModel->countSekolah("SMK")
        ];

        return view('v_createsekolah', $data);
    }

    public function simpan()
    {
        if (!$this->validate([
            'nama_sekolah' => [
                'rules' => 'required|is_unique[tbl_sekolah.nama_sekolah]',
                'errors' => [
                    'required' => 'Nama Sekolah Wajib Di isi',
                    'is_unique' => 'Nama Sekolah Telah Terdaftar'
                ]
            ],
            'kepala_sekolah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Kepala Sekolah Wajib Di isi'
                ]
            ],
            'foto_sekolah' => [
                'rules' => 'max_size[foto_sekolah,1024]|is_image[foto_sekolah]|mime_in[foto_sekolah,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Gambar Tidak Boleh Diatas 1024 Kb',
                    'is_image' => 'Pastikan kamu upload gambar',
                    'mine_in' => 'Format gambar hanya .jpg .jpeg dan .png'
                ]
            ],
            'latitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Tentukan Lokasi Latitude Sekolah'
                ]
            ],
            'longitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Tentukan Lokasi Longitude Sekolah'
                ]
            ],
            'checkbox' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Centang Kolom Dan Pastikan Data Sudah Benar'
                ]
            ]
        ])) {
            return redirect()->to('/form/createsekolah')->withInput();
        }


        $FileFoto = $this->request->getFile('foto_sekolah');
        if ($FileFoto == "") {
            $NamaFile = "default.png";
        } else {
            $NamaFile = $FileFoto->getRandomName();
            $FileFoto->move('img/sekolah', $NamaFile);
        }

        $slug = url_title($this->request->getVar('nama_sekolah'), '-', TRUE);

        $this->DataModel->save([
            'nama_sekolah' => $this->request->getVar('nama_sekolah'),
            'slug' => $slug,
            'jenjang' => $this->request->getVar('jenjang'),
            'kepala_sekolah' => $this->request->getVar('kepala_sekolah'),
            'foto_sekolah' => $NamaFile,
            'deskripsi' => $this->request->getVar('deskripsi'),
            'status' => $this->request->getVar('status'),
            'akreditas' => $this->request->getVar('akreditas'),
            'website' => $this->request->getVar('website'),
            'latitude' =>  $this->request->getVar('latitude'),
            'longitude' =>  $this->request->getVar('longitude')
        ]);

        session()->setFlashdata('pesan', 'Data Sekolah Berhasil Di Simpan.');
        return redirect()->to('/form/datasekolah');
    }

    public function hapus($id)
    {
        $Sekolah = $this->DataModel->find($id);
        if ($Sekolah['foto_sekolah'] == "default.png") {
            $this->DataModel->delete($id);
        } else {
            // unlink('img/sekolah/' . $Sekolah['foto_sekolah']);
            $this->DataModel->delete($id);
        }

        session()->setFlashdata('pesan', 'Sekolah Berhasil DiHapus');
        return redirect()->to('/form/datasekolah');
    }

    public function update($slug)
    {
        session();
        $Sekolah = $this->DataModel->getSekolah($slug);
        $data = [
            'title' => "Update : " . $Sekolah['nama_sekolah'],
            'appname' => "WEBGIS - CI",
            'heading' => "Update Sekolah",
            'data' => $Sekolah,
            'validation' => \Config\Services::validation(),
            'sd' => $this->DataModel->countSekolah("SD"),
            'smp' => $this->DataModel->countSekolah("SMP"),
            'sma' => $this->DataModel->countSekolah("SMA"),
            'smk' => $this->DataModel->countSekolah("SMK")
        ];

        return view('v_updatesekolah', $data);
    }

    public function prosesupdate($slug)
    {
        if (!$this->validate([
            'nama_sekolah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Sekolah Wajib Di isi'
                ]
            ],
            'kepala_sekolah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Kepala Sekolah Wajib Di isi'
                ]
            ],
            'foto_sekolah' => [
                'rules' => 'max_size[foto_sekolah,1024]|is_image[foto_sekolah]|mime_in[foto_sekolah,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Gambar Tidak Boleh Diatas 1024 Kb',
                    'is_image' => 'Pastikan kamu upload gambar',
                    'mine_in' => 'Format gambar hanya .jpg .jpeg dan .png'
                ]
            ],
            'latitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Tentukan Lokasi Latitude Sekolah'
                ]
            ],
            'longitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Tentukan Lokasi Longitude Sekolah'
                ]
            ],
            'checkbox' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Centang Kolom Dan Pastikan Data Sudah Benar'
                ]
            ]
        ])) {
            return redirect()->to('/form/update/' . $slug)->withInput();
        }
        $datalama = $this->DataModel->getSekolah($slug);
        if ($this->request->getFile('foto_sekolah') == "") {
            $NamaFile = $datalama['foto_sekolah'];
        } else {
            if ($datalama['foto_sekolah'] == "default.png") {
                $getFile = $this->request->getFile('foto_sekolah');
                $NamaFile = $getFile->getRandomName();
                $getFile->move('img/sekolah/', $NamaFile);
            } else {
                unlink('img/sekolah/' . $datalama['foto_sekolah']);
                $getFile = $this->request->getFile('foto_sekolah');
                $NamaFile = $getFile->getRandomName();
                $getFile->move('img/sekolah/', $NamaFile);
            }
        }

        $this->DataModel->save([
            'id' => $this->request->getPost('id'),
            'nama_sekolah' => $this->request->getPost('nama_sekolah'),
            'kepala_sekolah' => $this->request->getPost('kepala_sekolah'),
            'jenjang' => $this->request->getPost('jenjang'),
            'foto_sekolah' => $NamaFile,
            'deskripsi' => $this->request->getPost('deskripsi'),
            'status' => $this->request->getPost('status'),
            'akreditas' => $this->request->getPost('akreditas'),
            'website' => $this->request->getPost('website'),
            'latitude' => $this->request->getPost('latitude'),
            'longitude' => $this->request->getPost('longitude')
        ]);
        session()->setFlashdata('pesan', 'Sekolah Berhasil Di Update');
        return redirect()->to(base_url('form/datasekolah'));
        d($this->request->getPost());
    }
}
