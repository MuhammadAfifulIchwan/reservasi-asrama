<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserApiController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /*
    =====================================
    GET ALL USERS
    GET /api/users
    =====================================
    */

    public function index()
    {
        $users = $this->userModel->findAll();

        return $this->response->setJSON([

            'status' => 200,

            'message' => 'Data user berhasil diambil',

            'data' => $users

        ]);
    }

    /*
    =====================================
    POST USER
    POST /api/users
    =====================================
    */

    public function create()
    {
        $data = [

            'name' =>
                $this->request->getPost('name'),

            'email' =>
                $this->request->getPost('email'),

            'password' =>
                password_hash(
                    $this->request->getPost('password'),
                    PASSWORD_DEFAULT
                ),

            'phone' =>
                $this->request->getPost('phone'),

            'role' =>
                $this->request->getPost('role')

        ];

        $this->userModel->insert($data);

        return $this->response->setJSON([

            'status' => 201,

            'message' => 'User berhasil ditambahkan'

        ]);
    }

    /*
    =====================================
    UPDATE USER
    PUT /api/users/{id}
    =====================================
    */

    public function update($id = null)
    {
        $data = $this->request->getJSON(true);

        if (isset($data['password'])) {

            $data['password'] =
                password_hash(
                    $data['password'],
                    PASSWORD_DEFAULT
                );
        }

        $this->userModel->update($id, $data);

        return $this->response->setJSON([

            'status' => 200,

            'message' => 'User berhasil diupdate'

        ]);
    }

    /*
    =====================================
    DELETE USER
    DELETE /api/users/{id}
    =====================================
    */

    public function delete($id = null)
    {
        $this->userModel->delete($id);

        return $this->response->setJSON([

            'status' => 200,

            'message' => 'User berhasil dihapus'

        ]);
    }
}