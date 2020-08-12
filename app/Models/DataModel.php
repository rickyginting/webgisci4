<?php

namespace App\Models;

use CodeIgniter\Model;

class DataModel extends Model
{
    protected $table = "tbl_sekolah";
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_sekolah', 'slug', 'kategori', 'kepala_sekolah', 'jenjang', 'foto_sekolah', 'deskripsi', 'status', 'akreditas', 'website', 'latitude', 'longitude'];
    protected $useTimestamps = TRUE;

    public function getSekolah($slug = "")
    {
        if ($slug == false) {
            return $this->findAll();
        }
        return $this->where(['slug' => $slug])->first();
    }

    public function countSekolah($jenjang = "")
    {
        return $this->where(['jenjang' => $jenjang])->countAllResults();
    }

    public function cariSekolah($key)
    {
        return $this->like(['nama_sekolah' => $key])->orLike(['kepala_sekolah' => $key]);
    }

    public function jenjangSekolah($jenjang = "")
    {
        if ($jenjang == false) {
            return $this->findAll();
        }
        return $this->where(['jenjang' => $jenjang])->get()->getResultArray();
    }
}
