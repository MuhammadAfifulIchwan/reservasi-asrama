<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\FacilityModel;
use App\Models\ReservationModel;
use App\Models\PaymentModel;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DashboardController extends BaseController
{
    public function admin()
{

// hanya admin
    if (session()->get('role') != 'admin') {
        return redirect()->to('/login');
    }

    $userModel = new UserModel();
    $facilityModel = new FacilityModel();
    $reservationModel = new ReservationModel();
    $paymentModel = new PaymentModel();

    $data['totalUsers'] =
        $userModel->countAll();

    $data['totalFacilities'] =
        $facilityModel->countAll();

    $data['totalReservations'] =
        $reservationModel->countAll();

    $data['totalPayments'] =
        $paymentModel->countAll();
    
    $data['totalRevenue'] =
    $reservationModel
        ->selectSum('total_price')
        ->where('status', 'Selesai')
        ->first()['total_price'] ?? 0;

// GRAFIK JUMLAH RESERVASI PER BULAN
$reservationChart =
    $reservationModel
        ->select("
            MONTH(created_at) as month,
            COUNT(id) as total
        ")
        ->groupBy("MONTH(created_at)")
        ->findAll();

$data['reservationChart'] =
    $reservationChart;

// GRAFIK PENDAPATAN PER BULAN
$revenueChart =
    $reservationModel
        ->select("
            MONTH(created_at) as month,
            SUM(total_price) as total
        ")
        ->where('status', 'Selesai')
        ->groupBy("MONTH(created_at)")
        ->findAll();

$data['revenueChart'] =
    $revenueChart;

    return view('admin/dashboard', $data);
}

public function user()
{
    if (session()->get('role') != 'user') {
        return redirect()->to('/login');
    }

    $facilityModel = new FacilityModel();
    $reservationModel = new ReservationModel();

    $userId =
        session()->get('id');

// TOTAL FASILITAS
    $data['totalFacilities'] =
        $facilityModel->countAll();

// RESERVASI AKTIF (APPROVED)
    $data['activeReservations'] =
        $reservationModel
            ->where('user_id', $userId)
            ->where('status', 'Approved')
            ->countAllResults();

// MENUNGGU VERIFIKASI (PENDING)
    $data['pendingReservations'] =
        $reservationModel
            ->where('user_id', $userId)
            ->where('status', 'Pending')
            ->countAllResults();

// RESERVASI SELESAI
    $data['finishedReservations'] =
        $reservationModel
            ->where('user_id', $userId)
            ->where('status', 'Selesai')
            ->countAllResults();

// TOTAL PENGELUARAN
    $data['totalExpense'] =
        $reservationModel
            ->selectSum('total_price')
            ->where('user_id', $userId)
            ->where('status', 'Selesai')
            ->first()['total_price'] ?? 0;

    return view('dashboard/user', $data);
}

// ADMIN LIHAT DATA USER
    public function users()
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();

        $data['users'] = $userModel->findAll();

        return view('admin/users', $data);
    }

    public function guest()
{
    if (session()->get('role') != 'guest') {
        return redirect()->to('/login');
    }

    return view('dashboard/guest');
}

// USER PROFILE
public function profile()
{
    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }

    return view('dashboard/profile');
}

// ADMIN DELETE USER
public function deleteUser($id)
{
    // hanya admin boleh akses

    if (session()->get('role') != 'admin') {
        return redirect()->to('/login');
    }

    $userModel = new UserModel();

    $userModel->delete($id);

    return redirect()->to('/admin/users');
}


// ADMIN EDIT USER (FORM)
public function editUser($id)
{
    // hanya admin boleh akses

    if (session()->get('role') != 'admin') {
        return redirect()->to('/login');
    }

    $userModel = new UserModel();

    $data['user'] = $userModel->find($id);

    return view('admin/edit_user', $data);
}

// ADMIN UPDATE USER
public function updateUser($id)
{
    // hanya admin boleh akses

    if (session()->get('role') != 'admin') {
        return redirect()->to('/login');
    }

    $userModel = new UserModel();

    $userModel->update($id, [

        'name' =>
            $this->request->getPost('name'),

        'email' =>
            $this->request->getPost('email'),

        'role' =>
            $this->request->getPost('role')

    ]);

    return redirect()->to('/admin/users');
}

// ADMIN LAPORAN
public function report()
{
    if (session()->get('role') != 'admin') {
        return redirect()->to('/login');
    }

    $userModel = new UserModel();
    $facilityModel = new FacilityModel();
    $reservationModel = new ReservationModel();
    $paymentModel = new PaymentModel();

// AMBIL FILTER
    $filterType =
        $this->request->getGet('filter_type');

    $filterValue =
        $this->request->getGet('filter_value');

// QUERY DASAR
    $reservationQuery =
        $reservationModel;

    $paymentQuery =
        $paymentModel;

/*
FILTER HARIAN / BULANAN / TAHUNAN
*/
    if ($filterType == 'daily' && !empty($filterValue)) {

        $reservationQuery =
            $reservationModel
                ->where('DATE(created_at)', $filterValue);

        $paymentQuery =
            $paymentModel
                ->where('DATE(created_at)', $filterValue);
    }

    if ($filterType == 'monthly' && !empty($filterValue)) {

    $reservationQuery =
        $reservationModel
            ->where("DATE_FORMAT(created_at,'%Y-%m')", $filterValue);

    $paymentQuery =
        $paymentModel
            ->where("DATE_FORMAT(created_at,'%Y-%m')", $filterValue);
}

    if ($filterType == 'yearly' && !empty($filterValue)) {

        $reservationQuery =
            $reservationModel
                ->where("YEAR(created_at)", $filterValue);

        $paymentQuery =
            $paymentModel
                ->where("YEAR(created_at)", $filterValue);
    }

// DATA LAPORAN
    $data['totalUsers'] =
        $userModel->countAll();

    $data['totalFacilities'] =
        $facilityModel->countAll();

    $data['totalReservations'] =
        $reservationQuery->countAllResults(false);

// RESERVASI PENDING
$data['pendingReservations'] =
    (new ReservationModel())
        ->where('status', 'Pending')
        ->countAllResults();

// RESERVASI APPROVED
$data['approvedReservations'] =
    (new ReservationModel())
        ->where('status', 'Approved')
        ->countAllResults();

// PEMBAYARAN LUNAS
$data['paidPayments'] =
    $paymentQuery
        ->where('payment_status', 'Lunas')
        ->countAllResults(false);

// PEMBAYARAN DITOLAK
$data['rejectedPayments'] =
    (new PaymentModel())
        ->where('payment_status', 'Ditolak')
        ->countAllResults();

// TOTAL PENDAPATAN
$revenue =
    $reservationQuery
        ->where('status', 'Selesai')
        ->selectSum('total_price')
        ->first();

$data['totalRevenue'] =
    $revenue['total_price'] ?? 0;

// SIMPAN FILTER KE VIEW
    $data['filterType'] = $filterType;
    $data['filterValue'] = $filterValue;

// DETAIL TRANSAKSI RESERVASI
$transactionList =
    $reservationModel
        ->select('
            reservations.*,
            users.name as user_name,
            facilities.facility_name
        ')
        ->join('users', 'users.id = reservations.user_id')
        ->join('facilities', 'facilities.id = reservations.facility_id')
        ->orderBy('reservations.id', 'DESC')
        ->findAll();

$data['transactions'] =
    $transactionList;

    return view('admin/report', $data);
}

// eksport pdf
public function exportPdf()
{
    if (session()->get('role') != 'admin') {
        return redirect()->to('/login');
    }

    $reservationModel = new ReservationModel();

// AMBIL FILTER DARI URL
$filterType =
    $this->request->getGet('filter_type');

$filterValue =
    $this->request->getGet('filter_value');

/*
========================================
QUERY DASAR
========================================
*/

$reservationQuery =
    $reservationModel;

/*
========================================
FILTER DATA
========================================
*/

if ($filterType == 'daily' && !empty($filterValue)) {

    $reservationQuery =
        $reservationModel
            ->where('DATE(created_at)', $filterValue);
}

if ($filterType == 'monthly' && !empty($filterValue)) {

    $reservationQuery =
        $reservationModel
            ->where("DATE_FORMAT(created_at,'%Y-%m')", $filterValue);
}

if ($filterType == 'yearly' && !empty($filterValue)) {

    $reservationQuery =
        $reservationModel
            ->where("YEAR(created_at)", $filterValue);
}

    $transactions =
        $reservationQuery
            ->select('
                reservations.*,
                users.name as user_name,
                facilities.facility_name
            ')
            ->join('users', 'users.id = reservations.user_id')
            ->join('facilities', 'facilities.id = reservations.facility_id')
            ->orderBy('reservations.id', 'DESC')
            ->findAll();

    $html = '
    <h2 style="text-align:center;">Laporan Reservasi Asrama</h2>

    <table border="1" width="100%" cellpadding="5" cellspacing="0">

        <thead>

            <tr>

                <th>No</th>
                <th>Kode</th>
                <th>User</th>
                <th>Fasilitas</th>
                <th>Mulai</th>
                <th>Selesai</th>
                <th>Total</th>
                <th>Status</th>

            </tr>

        </thead>

        <tbody>
    ';

    $no = 1;

    foreach ($transactions as $trx) {

        $html .= '

        <tr>

            <td>'.$no++.'</td>
            <td>'.$trx['reservation_code'].'</td>
            <td>'.$trx['user_name'].'</td>
            <td>'.$trx['facility_name'].'</td>
            <td>'.$trx['start_date'].'</td>
            <td>'.$trx['end_date'].'</td>
            <td>Rp '.number_format($trx['total_price'],0,",",".").'</td>
            <td>'.$trx['status'].'</td>

        </tr>
        ';
    }

    $html .= '
        </tbody>
    </table>
    ';

    $dompdf = new Dompdf();

    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4', 'landscape');

    $dompdf->render();

    $dompdf->stream("laporan_reservasi.pdf", [
        "Attachment" => true
    ]);
    
}

/*eksport exel*/
public function exportExcel()
{
    if (session()->get('role') != 'admin') {
        return redirect()->to('/login');
    }

    $reservationModel = new ReservationModel();
    /*
========================================
AMBIL FILTER DARI URL
========================================
*/

$filterType =
    $this->request->getGet('filter_type');

$filterValue =
    $this->request->getGet('filter_value');

/*
========================================
QUERY DASAR
========================================
*/

$reservationQuery =
    $reservationModel;

/*
========================================
FILTER DATA
========================================
*/

if ($filterType == 'daily' && !empty($filterValue)) {

    $reservationQuery =
        $reservationModel
            ->where('DATE(created_at)', $filterValue);
}

if ($filterType == 'monthly' && !empty($filterValue)) {

    $reservationQuery =
        $reservationModel
            ->where("DATE_FORMAT(created_at,'%Y-%m')", $filterValue);
}

if ($filterType == 'yearly' && !empty($filterValue)) {

    $reservationQuery =
        $reservationModel
            ->where("YEAR(created_at)", $filterValue);
}

    $transactions =
        $reservationQuery
            ->select('
                reservations.*,
                users.name as user_name,
                facilities.facility_name
            ')
            ->join('users', 'users.id = reservations.user_id')
            ->join('facilities', 'facilities.id = reservations.facility_id')
            ->orderBy('reservations.id', 'DESC')
            ->findAll();

    $spreadsheet = new Spreadsheet();

    $sheet = $spreadsheet->getActiveSheet();

    /*
    HEADER
    */

    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Kode Reservasi');
    $sheet->setCellValue('C1', 'Nama User');
    $sheet->setCellValue('D1', 'Fasilitas');
    $sheet->setCellValue('E1', 'Tanggal Mulai');
    $sheet->setCellValue('F1', 'Tanggal Selesai');
    $sheet->setCellValue('G1', 'Total Harga');
    $sheet->setCellValue('H1', 'Status');

// DATA
    $row = 2;
    $no = 1;

    foreach ($transactions as $trx) {

        $sheet->setCellValue('A'.$row, $no++);
        $sheet->setCellValue('B'.$row, $trx['reservation_code']);
        $sheet->setCellValue('C'.$row, $trx['user_name']);
        $sheet->setCellValue('D'.$row, $trx['facility_name']);
        $sheet->setCellValue('E'.$row, $trx['start_date']);
        $sheet->setCellValue('F'.$row, $trx['end_date']);
        $sheet->setCellValue('G'.$row, $trx['total_price']);
        $sheet->setCellValue('H'.$row, $trx['status']);

        $row++;
    }

// DOWNLOAD
    $filename = "laporan_reservasi.xlsx";

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);

    $writer->save('php://output');

    exit;
}
}