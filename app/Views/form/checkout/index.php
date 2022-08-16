<?= $this->extend('form/layout/body') ?>

<?= $this->section('content') ?>
<div class="d-lg-flex vh-100 justify-content-center align-items-center">
  <div>
    <div class="container d-lg-flex">
      <div class="box-1 bg-light user">
        <div class="box-inner-1 pb-3 mb-3 ">
          <div class="d-flex justify-content-between mb-3 userdetails">
            <p class="fw-bold">KAMAR <?= $kamar['no_kamar'] ?></p>
          </div>
          <div class="img-details">
            <img src="/images/kamar/<?= $kamar['gambar'] ?>" class="d-block w-100">
          </div>
          <div class="d-lg-flex my-3 justify-content-between">
            <p class="dis info">
              <?= $kamar['deskripsi'] ?>
            </p>
            <p class="dis info">Rp. <?= $kamar['harga_kamar'] ?></p>
          </div>
        </div>
      </div>
      <div class="box-2 w-100">
        <div class="box-inner-2 w-100 d-lg-flex flex-column justify-content-center align-items-center h-100">
          <div class="w-100">
            <p class="fw-bold">Order Details</p>
            <p class="dis mb-3">Complete your order by providing your payment</p>
          </div>
          <form class="w-100" action="/pesan/kamar" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="POST">
            <input type="hidden" name="id_kamar" value="<?= $kamar['id'] ?>">
            <input type="hidden" name="id_user" value="<?= session()->get('id') ?>">
            <input type="hidden" name="harga_kamar" value="<?= $kamar['harga_kamar'] ?>">

            <div class="mb-3">
              <p class="dis fw-bold mb-2">Tanggal Masuk</p>
              <input class="form-control<?= $validation->hasError("tanggal_masuk") ? " is-invalid" : ""?>" type="date" name="tanggal_masuk">
            </div>
            <div>
              <div class="address">
                <p class="dis fw-bold mb-3">Lama Tinggal</p>
                <select name="durasi_sewa" class="form-select mb-3<?= $validation->hasError("durasi_sewa") ? " is-invalid" : ""?>" id="durasi_sewa">
                  <option value="3">3 Months</option>
                  <option value="6">6 Months</option>
                  <option value="12">12 Months</option>
                </select>
                <div class="d-flex flex-column dis">
                  <div class="d-flex align-items-center justify-content-between mb-2">
                    <p>Subtotal</p>
                    <p class="subtotal" id="subtotal">
                      <?= $kamar['harga_kamar']*3 ?>
                    </p>
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-2">
                    <p class="fw-bold">Total</p>
                    <p class="fw-bold" id="total">
                      <?= $kamar['harga_kamar']*3 ?>
                    </p>
                  </div>
                  <button type="submit" class="btn btn-primary mt-2">
                    Order
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).on('change', '#durasi_sewa', function () {
    $('#subtotal').text(`${<?= $kamar['harga_kamar'] ?> * this.value }`);
    $('#total').text(`${<?= $kamar['harga_kamar'] ?> * this.value }`);
    $('#total-btn').text(`${<?= $kamar['harga_kamar'] ?> * this.value }`);
  });
</script>
<?= $this->endSection() ?>

<?= $this->section('head') ?>
<title>Mazasi's House | Pesan Kamar</title>
<link rel="stylesheet" href="/css/form.css">
<?= $this->endSection() ?>