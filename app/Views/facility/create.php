<?= $this->include('layout/header') ?>

<div class="container mt-4">

<h2>Tambah Fasilitas</h2>

<hr>

<form method="post"
      action="<?= base_url('facilities/store') ?>">

<div class="mb-3">

<label>Kode Fasilitas</label>

<input type="text"
       name="facility_code"
       class="form-control">

</div>


<div class="mb-3">

<label>Nama Fasilitas</label>

<input type="text"
       name="facility_name"
       class="form-control">

</div>


<div class="mb-3">

<label>Kategori</label>

<input type="text"
       name="category"
       class="form-control">

</div>


<div class="mb-3">

<label>Harga</label>

<input type="number"
       name="price"
       class="form-control">

</div>


<div class="mb-3">

<label>Kapasitas</label>

<input type="number"
       name="capacity"
       class="form-control">

</div>


<div class="mb-3">

<label>Deskripsi</label>

<textarea name="description"
          class="form-control"></textarea>

</div>


<div class="mb-3">

<label>Status Sistem</label>

<select name="status"
        class="form-select">

    <option value="available">

        Available

    </option>

    <option value="maintenance">

        Maintenance

    </option>

    <option value="unavailable">

        Unavailable

    </option>

</select>

</div>


<button class="btn btn-success">

    Simpan

</button>


<a href="/facilities"
   class="btn btn-secondary">

    Kembali

</a>

</form>

</div>

<?= $this->include('layout/footer') ?>