<?php

namespace App\Controllers;

use App\Models\PaymentModel;
use App\Models\ReservationModel;
use Dompdf\Dompdf;

class PaymentController extends BaseController
{
    protected $paymentModel;

    public function __construct()
    {
        $this->paymentModel = new PaymentModel();
    }

    // halaman pembayaran
public function index()
{
    // guest tidak boleh akses pembayaran
    if (session()->get('role') == 'guest') {
        return redirect()->to('/guest/dashboard');
    }

    $reservationModel = new ReservationModel();

    $paymentModel = new PaymentModel();


    /*
    =====================================
    AMBIL RESERVASI USER YANG APPROVED
    =====================================
    */

    $reservations =
        $reservationModel

            ->where('user_id', session()->get('id'))

            ->where('status', 'Approved')

            ->findAll();


    /*
    =====================================
    FILTER YANG BELUM ADA PEMBAYARAN
    =====================================
    */

    $availableReservations = [];


    foreach ($reservations as $reservation)
    {
        $existingPayment =
            $paymentModel

                ->where('reservation_id',
                        $reservation['id'])

                ->first();


        // jika belum ada pembayaran
        if (!$existingPayment)
        {
            $availableReservations[] =
                $reservation;
        }
    }


    $data['reservations'] =
        $availableReservations;

/*
=====================================
AMBIL RIWAYAT PEMBAYARAN USER
=====================================
*/

$userPayments =

    $paymentModel

        ->select('
            payments.*,
            reservations.reservation_code
        ')

        ->join(
            'reservations',
            'reservations.id = payments.reservation_id'
        )

        ->where(
            'reservations.user_id',
            session()->get('id')
        )

        ->findAll();


$data['payments'] =
    $userPayments;
    return view('payment/index', $data);
}

    // upload pembayaran
    public function store()
{
    // guest tidak boleh upload pembayaran
    if (session()->get('role') == 'guest') {
        return redirect()->to('/guest/dashboard');
    }

    $file = $this->request->getFile('payment_proof');

        $fileName = $file->getRandomName();

        $file->move('uploads/payment/', $fileName);

        $data = [

            'reservation_id' =>
                $this->request->getPost('reservation_id'),

            'invoice_number' =>
                'INV-' . rand(1000,9999),

            'payment_method' =>
                $this->request->getPost('payment_method'),

            'payment_proof' =>
                $fileName,

            'payment_status' =>
                'menunggu verifikasi'
        ];

        $this->paymentModel->insert($data);

        return redirect()

    ->to('/payments')

    ->with(
        'success',
        'Bukti pembayaran berhasil diupload. Silahkan menunggu verifikasi admin.'
    );
    }

    // =========================
// ADMIN LIHAT SEMUA PEMBAYARAN
// =========================

public function adminPayment()
{
    // hanya admin

    if (session()->get('role') != 'admin') {
        return redirect()->to('/login');
    }

    /*
    =====================================
    JOIN 4 TABEL
    payments
    reservations
    users
    facilities
    =====================================
    */

    $payments =

        $this->paymentModel

            ->select('
                payments.*,
                reservations.reservation_code,
                users.name,
                facilities.facility_name
            ')

            ->join(
                'reservations',
                'reservations.id = payments.reservation_id'
            )

            ->join(
                'users',
                'users.id = reservations.user_id'
            )

            ->join(
                'facilities',
                'facilities.id = reservations.facility_id'
            )

            ->findAll();

    $data['payments'] = $payments;

    return view('payment/admin_payment', $data);
}

// =========================
// ADMIN UPDATE STATUS PEMBAYARAN
// =========================
public function updateStatus($id, $status)
{
    // hanya admin boleh akses
    if (session()->get('role') != 'admin') {
        return redirect()->to('/login');
    }


    /*
    ============================
    UPDATE STATUS PEMBAYARAN
    ============================
    */

    $this->paymentModel->update($id, [

        'payment_status' => $status

    ]);


    /*
    ============================
    JIKA PEMBAYARAN LUNAS
    UPDATE STATUS RESERVASI
    ============================
    */

    if ($status == 'Lunas')
    {
        // ambil data payment

        $payment =
            $this->paymentModel->find($id);


        // model reservasi

        $reservationModel =
            new ReservationModel();


        // update reservasi jadi Paid
// update reservasi jadi Selesai

$reservationModel->update(
    $payment['reservation_id'],
    [
        'status' => 'Selesai'
    ]
);
    }

    return redirect()->to('/admin/payments');
}

// =========================
// DOWNLOAD INVOICE PDF USER
// =========================

public function downloadInvoice($id)
{
    // hanya user login
    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }

    /*
    =====================================
    JOIN PAYMENT + RESERVATION + USER + FACILITY
    =====================================
    */

    $payment =

        $this->paymentModel

            ->select('
                payments.*,
                reservations.reservation_code,
                reservations.start_date,
                reservations.end_date,
                reservations.total_price,
                users.name,
                facilities.facility_name
            ')

            ->join(
                'reservations',
                'reservations.id = payments.reservation_id'
            )

            ->join(
                'users',
                'users.id = reservations.user_id'
            )

            ->join(
                'facilities',
                'facilities.id = reservations.facility_id'
            )

            ->where('payments.id', $id)

            ->first();


    // jika invoice tidak ditemukan
    if (!$payment) {

        return redirect()->to('/payments');
    }


    /*
    =====================================
    HANYA YANG STATUS LUNAS
    =====================================
    */

    if ($payment['payment_status'] != 'Lunas') {

        return redirect()->to('/payments')
                         ->with(
                             'error',
                             'Invoice hanya tersedia setelah pembayaran lunas.'
                         );
    }


    /*
    =====================================
    TEMPLATE HTML PDF
    =====================================
    */

    $html = '

    <h2 style="text-align:center;">
        INVOICE PEMBAYARAN ASRAMA
    </h2>

    <hr>

    <table width="100%" cellpadding="6">

        <tr>
            <td><b>Nomor Invoice</b></td>
            <td>: '.$payment['invoice_number'].'</td>
        </tr>

        <tr>
            <td><b>Kode Reservasi</b></td>
            <td>: '.$payment['reservation_code'].'</td>
        </tr>

        <tr>
            <td><b>Nama Penyewa</b></td>
            <td>: '.$payment['name'].'</td>
        </tr>

        <tr>
            <td><b>Fasilitas</b></td>
            <td>: '.$payment['facility_name'].'</td>
        </tr>

        <tr>
            <td><b>Tanggal Mulai</b></td>
            <td>: '.$payment['start_date'].'</td>
        </tr>

        <tr>
            <td><b>Tanggal Selesai</b></td>
            <td>: '.$payment['end_date'].'</td>
        </tr>

        <tr>
            <td><b>Metode Pembayaran</b></td>
            <td>: '.$payment['payment_method'].'</td>
        </tr>

        <tr>
            <td><b>Total Biaya</b></td>
            <td>: Rp '.number_format($payment['total_price'],0,",",".").'</td>
        </tr>

        <tr>
            <td><b>Status Pembayaran</b></td>
            <td>: '.$payment['payment_status'].'</td>
        </tr>

        <tr>
            <td><b>Tanggal Invoice</b></td>
            <td>: '.date("Y-m-d").'</td>
        </tr>

    </table>

    <br><br>

    <p>
        Pembayaran telah diterima.
        Terima kasih telah menggunakan sistem reservasi asrama.
    </p>
    ';


    /*
    =====================================
    GENERATE PDF
    =====================================
    */

    $dompdf = new Dompdf();

    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4', 'portrait');

    $dompdf->render();

    $dompdf->stream(
        "invoice_".$payment['invoice_number'].".pdf",
        [
            "Attachment" => true
        ]
    );
}
}