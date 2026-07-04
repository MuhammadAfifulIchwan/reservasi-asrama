<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\ReservationModel;

class ReservationApiController extends BaseController
{
    protected $reservationModel;

    public function __construct()
    {
        $this->reservationModel = new ReservationModel();
    }

    /*
    =====================================
    GET ALL RESERVATIONS
    =====================================
    */

    public function index()
    {
        $reservations = $this->reservationModel->findAll();

        return $this->response->setJSON([
            'status' => 200,
            'message' => 'Data reservasi berhasil diambil',
            'data' => $reservations
        ]);
    }

    /*
    =====================================
    POST NEW RESERVATION
    =====================================
    */

    public function create()
    {
        $data = [

            'reservation_code' =>
                $this->request->getPost('reservation_code'),

            'user_id' =>
                $this->request->getPost('user_id'),

            'facility_id' =>
                $this->request->getPost('facility_id'),

            'purpose' =>
                $this->request->getPost('purpose'),

            'start_date' =>
                $this->request->getPost('start_date'),

            'end_date' =>
                $this->request->getPost('end_date'),

            'total_price' =>
                $this->request->getPost('total_price'),

            'status' =>
                $this->request->getPost('status')
        ];

        $this->reservationModel->insert($data);

        return $this->response->setJSON([
            'status' => 201,
            'message' => 'Reservasi berhasil ditambahkan'
        ]);
    }

    /*
    =====================================
    UPDATE RESERVATION
    =====================================
    */

    public function update($id = null)
    {
        $data = $this->request->getJSON(true);

        $this->reservationModel->update($id, $data);

        return $this->response->setJSON([
            'status' => 200,
            'message' => 'Reservasi berhasil diupdate'
        ]);
    }

    /*
    =====================================
    DELETE RESERVATION
    =====================================
    */

    public function delete($id = null)
    {
        $this->reservationModel->delete($id);

        return $this->response->setJSON([
            'status' => 200,
            'message' => 'Reservasi berhasil dihapus'
        ]);
    }
}