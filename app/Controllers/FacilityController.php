<?php

namespace App\Controllers;

use App\Models\FacilityModel;
use App\Models\ReservationModel;


class FacilityController extends BaseController
{
    protected $facilityModel;

    public function __construct()
    {
        $this->facilityModel = new FacilityModel();
    }

    // menampilkan semua fasilitas
public function index()
{
    $reservationModel = new ReservationModel();

    /*
    ====================================
    AMBIL SEMUA FASILITAS
    ====================================
    */

    $facilities =
        $this->facilityModel->findAll();

    /*
    ====================================
    CEK APAKAH ADA RESERVASI AKTIF
    ====================================
    */

    foreach ($facilities as &$facility)
    {
$activeReservation =
    $reservationModel

        ->where('facility_id', $facility['id'])

->groupStart()

    ->where('status', 'Pending')

    ->orWhere('status', 'Approved')

    ->orWhere('status', 'Selesai')

->groupEnd()

        ->orderBy('id', 'DESC')

        ->first();

        /*
        JIKA DIPAKAI
        */

        if ($activeReservation)
        {
            $facility['occupancy_status'] =
                'Sedang Digunakan';

            $facility['start_date'] =
                $activeReservation['start_date'];

            $facility['end_date'] =
                $activeReservation['end_date'];

            $facility['reserved_by'] =
                $activeReservation['user_id'];
        }
        else
        {
            $facility['occupancy_status'] =
                'Kosong';

            $facility['start_date'] = '-';

            $facility['end_date'] = '-';

            $facility['reserved_by'] = '-';
        }
    }

    $data['facilities'] =
        $facilities;

    return view('facility/index', $data);
}

    // admin tambah fasilitas
    public function create()
    {
        return view('facility/create');
    }

    // simpan fasilitas
    public function store()
    {
        $data = [
            'facility_code' => $this->request->getPost('facility_code'),
            'facility_name' => $this->request->getPost('facility_name'),
            'category' => $this->request->getPost('category'),
            'price' => $this->request->getPost('price'),
            'capacity' => $this->request->getPost('capacity'),
            'description' => $this->request->getPost('description'),
            'status' => $this->request->getPost('status')
        ];

        $this->facilityModel->insert($data);

        return redirect()->to('/facilities');
    }
    // =========================
// FORM EDIT FASILITAS
// =========================

public function edit($id)
{
    $data['facility'] =
        $this->facilityModel->find($id);

    return view('facility/edit', $data);
}
// =========================
// UPDATE FASILITAS
// =========================

public function update($id)
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

    $this->facilityModel->update($id, $data);

    return redirect()->to('/facilities');
}

// =========================
// DELETE FASILITAS
// =========================

public function delete($id)
{
    $this->facilityModel->delete($id);

    return redirect()->to('/facilities');
}

// =========================
// USER LIHAT FASILITAS
// =========================
public function userFacilities()
{
    // hanya user
    if (session()->get('role') != 'user') {
        return redirect()->to('/login');
    }

    $reservationModel = new ReservationModel();

    /*
    ===============================
    AMBIL SEMUA FASILITAS
    ===============================
    */

    $facilities =
        $this->facilityModel->findAll();


    /*
    ===============================
    CEK RESERVASI AKTIF
    ===============================
    */

    foreach ($facilities as &$facility)
    {
$activeReservationCount =
    $reservationModel

        ->where('facility_id', $facility['id'])

->groupStart()

    ->where('status', 'Pending')

    ->orWhere('status', 'Approved')

    ->orWhere('status', 'Selesai')

->groupEnd()

        ->countAllResults();


        /*
        JIKA SEDANG DIPAKAI
        */
if ($activeReservationCount >= $facility['capacity'])
{
    $facility['occupancy_status'] =
        'Sedang Digunakan';
}
else
{
    $facility['occupancy_status'] =
        'Kosong';
}
    }


    $data['facilities'] =
        $facilities;

    return view('facility/user_index', $data);
}
}