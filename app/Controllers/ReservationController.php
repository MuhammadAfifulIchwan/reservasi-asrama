<?php

namespace App\Controllers;

use App\Models\ReservationModel;
use App\Models\FacilityModel;

class ReservationController extends BaseController
{
    protected $reservationModel;

    public function __construct()
    {
        $this->reservationModel = new ReservationModel();
    }

// halaman reservasi
public function index()
{

// guest tidak boleh akses
    if (session()->get('role') == 'guest') {
        return redirect()->to('/guest/dashboard');
    }

/*
JOIN RESERVATION + USER + FACILITY
*/
    $reservations =
        $this->reservationModel
            ->select('
                reservations.*,
                users.name,
                facilities.facility_name
            ')
            ->join(
                'users',
                'users.id = reservations.user_id'
            )
            ->join(
                'facilities',
                'facilities.id = reservations.facility_id'
            )
            ->findAll();

    $data['reservations'] =
        $reservations;

    return view('reservation/index', $data);
}

// simpan reservasi
public function store()
{

// guest tidak boleh membuat reservasi
    if (session()->get('role') == 'guest') {
        return redirect()->to('/guest/dashboard');
    }

$facility_id =
    $this->request->getPost('facility_id');
    $start_date =
        $this->request->getPost('start_date');
    $end_date =
        $this->request->getPost('end_date');

// CEK APAKAH ADA JADWAL BENTROK
$existingReservation =
    $this->reservationModel
        ->where('facility_id', $facility_id)

->groupStart()

    ->where('status', 'Pending')
    ->orWhere('status', 'Approved')

->groupEnd()

        ->where('start_date <=', $end_date)
        ->where('end_date >=', $start_date)
        ->first();

// jika bentrok → gagal simpan
    if ($existingReservation) {
        return redirect()
            ->back()

            ->with('error','FASILITAS SUDAH DIBOOKING PADA TANGGAL TERSEBUT, SILAHKAN PILIH FASILITAS KAMI YANG LAINNYA. TERIMAKASIH');
                }

/*
JIKA TIDAK BENTROK → SIMPAN
*/
/*
GENERATE KODE RESERVASI OTOMATIS
FORMAT:
RSV-20260618-001
*/
$today =
    date('Ymd');

$totalToday =
    $this->reservationModel
        ->like('reservation_code', 'RSV-' . $today)
        ->countAllResults();

$number =
    str_pad($totalToday + 1, 3, '0', STR_PAD_LEFT);

$reservationCode =
    'RSV-' . $today . '-' . $number;
    $data = [
        'reservation_code' =>
    $reservationCode,
        'user_id' =>
            session()->get('id'),

        'facility_id' =>
            $facility_id,

        'purpose' =>
            $this->request->getPost('purpose'),

        'start_date' =>
            $start_date,

        'end_date' =>
            $end_date,

        'total_price' =>
            $this->request->getPost('total_price'),

        'status' =>
            'Pending'
    ];

    $this->reservationModel->insert($data);
return redirect()->to('/my-reservation');
}

// USER LIHAT RESERVASI SENDIRI
public function myReservation()
{
    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }

// JOIN DENGAN FACILITIES
    $reservations =
        $this->reservationModel
            ->select('
                reservations.*,
                facilities.facility_name
            ')

            ->join(
                'facilities',
                'facilities.id = reservations.facility_id'
            )

            ->where(
                'user_id',
                session()->get('id')
            )

            ->findAll();

    $data['reservations'] =
        $reservations;
    return view('reservation/my_reservation', $data);
}

// ADMIN UPDATE STATUS RESERVASI
public function updateStatus($id, $status)
{
    if (session()->get('role') != 'admin') {
        return redirect()->to('/login');
    }
    $facilityModel = new FacilityModel();

// ambil data reservasi
    $reservation = $this->reservationModel->find($id);

// update status reservasi
    $this->reservationModel->update($id, [
        'status' => $status
    ]);

// UPDATE STATUS FASILITAS
    if ($status == 'Approved') {
        $facilityModel->update(
            $reservation['facility_id'],
            [
                'status' => 'Sedang Digunakan'
            ]
        );
    }

    if ($status == 'Checkout' || $status == 'Selesai') {
        $facilityModel->update(
            $reservation['facility_id'],
            [
                'status' => 'Tersedia'
            ]
        );
    }

    return redirect()->to('/reservations');
}

// FORM RESERVASI USER
public function create($facility_id)
{
// guest tidak boleh reservasi
    if (session()->get('role') == 'guest') {
        return redirect()->to('/guest/dashboard');
    }

// load model fasilitas
    $facilityModel = new \App\Models\FacilityModel();

// ambil data fasilitas
    $facility = $facilityModel->find($facility_id);

// kirim ke view
    $data = [
        'facility_id' => $facility_id,
        'price' => $facility['price'],
        'category' => $facility['category']
    ];

    return view('reservation/create', $data);
}

}
