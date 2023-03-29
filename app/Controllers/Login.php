<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Controller;
use App\Models\M_Login;

class Login extends BaseController
{

    public function __construct()
    {
        $this->M_Login = new M_Login();
        $this->session = \Config\Services::session();
    }
    public function index()
    {
        return view('login');
    }

    public function proses_login() 
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $data = $this->M_Login->cek_login($username, $password);

        if (!empty($data)) {
            $session_data = [
                'id_user' => $data['id_user'],
                'username' => $data['username'],
                'nama' => $data['nama'],
                'level' => $data['level'],
                'departemen' => $data['departemen'],
                'seksi' => $data['seksi'],
                'line' => $data['line'],
                'otorisasi' => $data['otorisasi'],
                'is_login' => true
            ];
            $this->session->set($session_data);

            if ($data['seksi'] == NULL) {
                if ($data['departemen'] == 'produksi1') {
                    return redirect()->to(base_url('grid'));
                } else {
                    return redirect()->to(base_url('lhp'));
                }
            } elseif ($data['seksi'] == 'grid') {
                return redirect()->to(base_url('grid'));
            } elseif ($data['seksi'] == 'amb') {
                return redirect()->to(base_url('lhp'));
            } elseif ($data['seksi'] == 'plate_cutting') {
                return redirect()->to(base_url('platecutting'));
            } elseif ($data['seksi'] == 'envelope') {
                return redirect()->to(base_url('envelope'));
            }
            
        } else {
            $this->session->setFlashdata('error', 'Username atau Password Salah');
            return redirect()->to(base_url('login'));
        }

    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url('login'));
    }
}