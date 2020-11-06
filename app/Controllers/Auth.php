<?php
namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{

    protected $UserModel;
    public function __construct()
    {
        $this->UserModel = new UserModel();
    }

    public function index()
    {
        return view('auth/v_login', [
            'title' => 'Web Gis Sekolah - Login',
            'data' => $this->UserModel->countAllResults(),
        ]);
    }

    public function ceklogin()
    {
        $email = htmlspecialchars($this->request->getVar('email'));
        $password = htmlspecialchars($this->request->getVar('password'));

        $user = $this->UserModel->where('email', $email)->first();
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $session = [
                    'id' => $user['id'],
                    'nama' => $user['nama'],
                    'email' => $user['email'],
                ];
                session()->set($session);

                return redirect()->to('/dashboard');
            }
        } else {
            session()->setFlashdata('pesan', '<div class="alert alert-primary" role="alert">
                Email tidak ditemukan
            </div>');
            return redirect()->to('/auth/login');
        }
    }

    public function register()
    {
        return view('auth/v_register', [
            'title' => 'Web Gis Sekolah - Register',
        ]);
    }

    public function prosesregis()
    {
        // Validasi Data
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama wajib di isi',
                ],
            ],
            'email' => [
                'rules' => 'required|is_unique[tbl_users.email]',
                'errors' => [
                    'required' => 'Email wajib di isi',
                    'is_unique' => 'Email telah terdaftar di Web Gis Sekolah',
                ],
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password wajib di isi',
                ],
            ],
        ])) {
            return redirect()->to('/auth/register')->withInput();
        }

        // Input Data
        $data = [
            'nama' => htmlspecialchars($this->request->getVar('nama')),
            'email' => htmlspecialchars($this->request->getVar('email')),
            'password' => password_hash(htmlspecialchars($this->request->getVar('password')), PASSWORD_DEFAULT),
        ];

        $this->UserModel->save($data);
        session()->setFlashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat kamu berhasil mendaftar silahkan login
        </div>');
        return redirect()->to('/auth/login');
    }

    public function logout()
    {
        session()->destroy();
        session()->setFlashdata('pesan', '<div class="alert alert-primary" role="alert">
        Logout berhasil !!!
    </div>');

        return redirect()->to('/auth/login');
    }
}
