<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Reservasi Asrama</title>

    <!-- Bootstrap 5 CDN (tetap sama, tidak diganti versi/framework) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons - dipakai buat ikon di navbar, sidebar, dan tombol chat -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Fonts "Poppins" - font pengganti font default browser -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CHART JS (tetap sama) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- ============================================= -->
    <!-- CSS KUSTOM GLOBAL - berlaku ke SEMUA halaman   -->
    <!-- karena diletakkan di header.php yang di-include -->
    <!-- di awal setiap View, termasuk menimpa tampilan   -->
    <!-- sidebar yang didefinisikan di file terpisah      -->
    <!-- ============================================= -->
    <style>
        :root {
            /* Variabel warna utama - ganti nilai ini saja untuk ubah tema warna seluruh web */
            --brand-primary: #2251CC;
            --brand-primary-dark: #173D99;
            --brand-accent: #F2A007;
            --bg-soft: #F4F6FB;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-soft);
        }

        /* Navbar: gradasi warna + bayangan halus, brand pakai ikon */
        .navbar.bg-primary {
            background: linear-gradient(90deg, var(--brand-primary), var(--brand-primary-dark)) !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.15);
        }
        .navbar-brand { font-weight: 600; letter-spacing: 0.3px; }

        /* Sidebar (list-group) - dipakai di admin_sidebar.php, user_sidebar.php, guest_sidebar.php
           Aturan ini otomatis berlaku ke file-file itu tanpa perlu diedit satu-satu */
        .list-group-item {
            border: none;
            border-radius: 8px !important;
            margin-bottom: 4px;
            font-weight: 500;
            transition: 0.2s;
        }
        .list-group-item.active {
            background-color: var(--brand-primary);
            border-color: var(--brand-primary);
        }
        .list-group-item:not(.active):hover {
            background-color: #E8EEFB;
        }

        /* Card - dipakai di kartu statistik dashboard, form, tabel pembungkus */
        .card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.06);
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.10);
        }

        /* Tombol - sudut lebih membulat dan transisi halus */
        .btn {
            border-radius: 8px;
            font-weight: 500;
            transition: 0.15s;
        }
        .btn-primary {
            background-color: var(--brand-primary);
            border-color: var(--brand-primary);
        }
        .btn-primary:hover {
            background-color: var(--brand-primary-dark);
            border-color: var(--brand-primary-dark);
        }

        /* Badge status (Tersedia/Sedang Digunakan/Lunas dsb) - sudut lebih membulat */
        .badge { border-radius: 6px; font-weight: 500; }

        /* Tabel - header lebih jelas */
        table thead { font-weight: 600; }

/* ============================================= */
    /* RESPONSIVE FIX - berlaku otomatis ke SEMUA halaman */
    /* tanpa perlu edit tabel/sidebar di tiap file View */
    /* ============================================= */

    /* Tabel: di layar < 768px (HP/tablet kecil), bikin tabel
       bisa di-scroll ke samping alih-alih memaksa seluruh
       halaman melebar/terpotong */
    @media (max-width: 767.98px) {
        table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        /* Widget chatbot: lebar menyesuaikan layar, tidak kaku 320px */
        #chatBox {
            width: min(320px, 90vw) !important;
            right: 5vw !important;
            height: min(420px, 70vh) !important;
        }
    }

    /* Tablet (768px - 991px): kurangi sedikit padding container
       supaya konten tidak terlalu mepet ke sidebar */
    @media (min-width: 768px) and (max-width: 991.98px) {
        .container { padding-left: 20px; padding-right: 20px; }
    }
    
    </style>
</head>

<body>

    <!-- Navbar utama - ikon bi-building ditambahkan sebelum teks -->
    <nav class="navbar navbar-dark bg-primary">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">
                <i class="bi bi-building me-2"></i>Sistem Reservasi Asrama
            </span>
        </div>
    </nav>

    <div class="container mt-4">