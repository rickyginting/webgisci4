<?php

namespace App\Controllers;

use App\Models\DataModel;

class Home extends BaseController
{
    public function index()
    {

        $Query = new DataModel();

        $jenjang = $this->request->getGet('jenjang');
        if ($jenjang) {
            $result = $Query->jenjangSekolah($jenjang);
            $title = "Menampilkan Hasil Pencarian";
        } else {
            $result = $Query->jenjangSekolah();
            $title = "Website Gis Sekolah";
        }

        $data = [
            'appname' => "WEBGIS - CI",
            'title' => $title,
            'data' => $result,
            'sd' => $Query->countSekolah("SD"),
            'smp' => $Query->countSekolah("SMP"),
            'sma' => $Query->countSekolah("SMA"),
            'smk' => $Query->countSekolah("SMK")
        ];
        return view('v_home', $data);
    }

    public function detail($slug = "")
    {
        $Query = new DataModel();
        $Sekolah = $Query->getSekolah($slug);

        if (empty($Sekolah)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Halaman Tidak Ditemukan');
        }

        $data = [
            'appname' => "WEBGIS - CI",
            'title' => $Sekolah['nama_sekolah'],
            'data' => $Sekolah,
            'sd' => $Query->countSekolah("SD"),
            'smp' => $Query->countSekolah("SMP"),
            'sma' => $Query->countSekolah("SMA"),
            'smk' => $Query->countSekolah("SMK")
        ];

        return view('v_detail', $data);
    }

    public function table()
    {
        $Query = new DataModel();
        $data = [
            'appname' => "WEBGIS - CI",
            'title' => "Data Sekolah Terdaftar",
            'data' => $Query->findAll(),
            'sd' => $Query->countSekolah("SD"),
            'smp' => $Query->countSekolah("SMP"),
            'sma' => $Query->countSekolah("SMA"),
            'smk' => $Query->countSekolah("SMK")
        ];

        return view('v_table', $data);
    }
}
