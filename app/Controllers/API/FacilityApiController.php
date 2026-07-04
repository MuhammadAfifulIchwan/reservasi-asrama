<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\FacilityModel;


class FacilityApiController extends BaseController
{
    protected $facilityModel;

    public function __construct()
    {
        $this->facilityModel = new FacilityModel();
    }

    /*
    =====================================
    GET ALL FACILITIES
    GET /api/facilities
    =====================================
    */

    public function index()
    {
        $facilities = $this->facilityModel->findAll();

        return $this->response->setJSON([

            'status' => 200,

            'message' => 'Data fasilitas berhasil diambil',

            'data' => $facilities

        ]);
    }

    /*
    =====================================
    POST NEW FACILITY
    POST /api/facilities
    =====================================
    */

    public function create()
    {
        $data = [

            'facility_code' =>
                $this->request->getPost('facility_code'),

            'facility_name' =>
                $this->request->getPost('facility_name'),

            'category' =>
                $this->request->getPost('category'),

            'price' =>
                $this->request->getPost('price'),

            'capacity' =>
                $this->request->getPost('capacity'),

            'description' =>
                $this->request->getPost('description'),

            'status' =>
                $this->request->getPost('status')
        ];

        $this->facilityModel->insert($data);

        return $this->response->setJSON([

            'status' => 201,

            'message' => 'Fasilitas berhasil ditambahkan'

        ]);
    }

    /*
    =====================================
    UPDATE FACILITY
    PUT /api/facilities/{id}
    =====================================
    */

public function update($id = null)
{
    $data = $this->request->getJSON(true);

    $this->facilityModel->update($id, $data);

    return $this->response->setJSON([

        'status' => 200,

        'message' => 'Fasilitas berhasil diupdate'

    ]);
}

    /*
    =====================================
    DELETE FACILITY
    DELETE /api/facilities/{id}
    =====================================
    */

    public function delete($id = null)
    {
        $this->facilityModel->delete($id);

        return $this->response->setJSON([

            'status' => 200,

            'message' => 'Fasilitas berhasil dihapus'

        ]);
    }
}