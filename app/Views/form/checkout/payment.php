<?= $this->extend('form/layout/body') ?>

<?= $this->section('content') ?>
<div class="d-lg-flex vh-100 justify-content-center align-items-center">
  <div>
    <div class="container d-lg-flex">
      <div class="box-1 bg-light user">
        <div class="box-inner-1 pb-3 mb-3 ">
          <div class="d-flex justify-content-between mb-3 userdetails">
            <p class="fw-bold">KAMAR <?= $order['no_kamar'] ?></p>
          </div>
          <div class="img-details">
            <img src="/images/kamar/<?= $order['gambar'] ?>" class="d-block w-100">
          </div>
          <div class="radiobtn">
            <label for="one" class="box py-2 first pointer-event-none">
              <div class="d-flex align-items-start">
                <div class="course">
                  <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="fw-bold">
                      No Rekening :
                    </span>
                    <span class="fas fa-dollar-sign">1</span>
                  </div>
                  <span>08152932058098</span>
                </div>
              </div>
            </label>
            <label for="two" class="box py-2 second pointer-event-none">
              <div class="d-flex">
                <div class="course">
                  <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="fw-bold">
                      Nama Rekening :
                    </span>
                    <span class="fas fa-dollar-sign">2</span>
                  </div>
                  <span>Dwi Elena S</span>
                </div>
              </div>
            </label>
            <label for="three" class="box py-2 third pointer-event-none">
              <div class="d-flex">
                <div class="course">
                  <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="fw-bold">
                      Jenis Bank :
                    </span>
                    <span class="fas fa-dollar-sign">3</span>
                  </div>
                  <span>BCA</span>
                </div>
              </div>
            </label>
            <label for="four" class="box py-2 third pointer-event-none">
              <div class="d-flex">
                <div class="course">
                  <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="fw-bold">
                      Harga Kost :
                    </span>
                    <span class="fas fa-dollar-sign">4</span>
                  </div>
                  <span>Rp. <?= $order['nominal_pembayaran']-$order['total_pembayaran_lunas'] ?></span>
                </div>
              </div>
            </label>
          </div>
        </div>
      </div>
      <div class="box-2 w-100">
        <div class="box-inner-2 w-100 d-lg-flex flex-column justify-content-center align-items-center h-100">
          <div class="w-100">
            <p class="fw-bold">Payment Details</p>
            <p class="dis mb-3">Complete your purchase by providing your payment details</p>
          </div>
          <form class="w-100" action="/member/order/bayar/<?= $order['id'] ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="POST">
            <input type="hidden" name="nominal_pembayaran" value="<?= $order['nominal_pembayaran'] ?>">

            <?php 
              $order_nominal = $order['nominal_pembayaran'];
              $sudah_terbayar = $order['total_pembayaran_lunas'] == NULL ? 0 : substr($order['total_pembayaran_lunas'],0,1);

              $nominal;
              if($order['durasi_sewa'] == 12) {
                $nominal = substr($order_nominal,0,2);
              }else {
                $nominal = substr($order_nominal,0,1);
              }
            ?>
            <div class="mb-3">
              <p class="dis fw-bold mb-2">Pembayaran</p>
              <select name="durasi_sewa" class="form-select<?= $validation->hasError("durasi_sewa") ? " is-invalid" : ""?>" id="durasi_sewa">
              <option value="" hidden selected>Pembayaran</option>
              <?php for($i=1; $i <= ($nominal-$sudah_terbayar); $i++) : ?>
                <option value="<?= $i ?>"><?= $i ?> Months</option>
              <?php endfor ?>
              </select>
            </div>
                
            <div class="mb-3">
              <p class="dis fw-bold mb-2">Nominal Pembayaran</p>
              <input id="nominal_pembayaran" class="form-control<?= $validation->hasError("pembayaran") ? " is-invalid" : ""?>" type="text"
                name="pembayaran" value="<?= old('pembayaran') ?>" readOnly>
            </div>


            <div>
              <div class="address">
                <div class="mb-3">
                  <p class="dis fw-bold mb-2">Nama Pengirim</p>
                  <input class="form-control<?= $validation->hasError("nama_pengirim") ? " is-invalid" : ""?>" type="text"
                    name="nama_pengirim" value="<?= old('nama_pengirim') ?>">
                </div>
                <div class="mb-3">
                  <p class="dis fw-bold mb-2">No Rekening</p>
                  <input class="form-control<?= $validation->hasError("nomor_rekening") ? " is-invalid" : ""?>" type="text"
                    name="nomor_rekening" value="<?= old('nomor_rekening') ?>">
                </div>
                <div class="mb-3">
                  <p class="dis fw-bold mb-2">Nama Bank</p>
                  <input class="form-control<?= $validation->hasError("nama_bank") ? " is-invalid" : ""?>" type="text"
                    name="nama_bank" value="<?= old('nama_bank') ?>">
                </div>
                <div class="mb-3">
                  <p class="dis fw-bold mb-2">Bukti Pembayaran</p>
                  <input class="form-control<?= $validation->hasError("bukti_pembayaran") ? " is-invalid" : ""?>" type="file"
                    name="bukti_pembayaran">
                </div>
                <div class="d-flex flex-column dis">
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
    let a = $('#durasi_sewa').val();

    $('#nominal_pembayaran').val((<?= $order['nominal_pembayaran'] ?>/<?= $order['durasi_sewa'] ?>)*a);
  });
</script>
<?= $this->endSection() ?>

<?= $this->section('head') ?>
<title>Mazasi's House | Pesan Kamar</title>
<link rel="stylesheet" href="/css/form.css">
<?= $this->endSection() ?>