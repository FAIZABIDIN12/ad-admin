<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        $username = session()->get('username');
        $userModel = new UserModel();

        $data['users'] = '';

        if ($username) {
            $userData = $userModel->where('username', $username)->first();
            if ($userData['role'] === 'super_admin') {
                $data['users'] = $userModel->findAll();
            }
        }

        return view('admin/user/list_users', $data);
    }

    public function profile()
    {
        $username = $_SESSION['username'];
        $userModel = new UserModel();

        if ($username) {
            $data['user'] = $userModel->where('username', $username)->first();
        }

        return view('admin/user/profile', $data);
    }

    public function changeProfile()
    {
        $id = $this->request->getPost('id');
        $nama = $this->request->getPost('nama');
        $password = $this->request->getVar('password');
        $newPassword = password_hash($this->request->getVar('new_password'), PASSWORD_DEFAULT);

        $userModel = new UserModel();
        $user = $userModel->find($id);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $query = $userModel->update($id, ['nama' => $nama, 'password' => $newPassword]);
                if ($query) {
                    return redirect()->to(base_url('admin/profile'))->with('message', 'Password berhasil diganti.');
                }
                return redirect()->back()->withInput()->with('error', 'Gagal mengubah password!');
            } else {
                return redirect()->back()->withInput()->with('error', 'Password lama salah!');
            }
        }
    }
}
