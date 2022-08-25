<?= $this->extend('admin/template/body') ?>

<?= $this->section('content') ?>
<div class="my-3">
  <?= $this->include('messages/messages') ?>
</div>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Update Order</h6>
  </div>
  <form action="/admin/data-order/<?= $order['id'] ?>" method="POST">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT" />

    <div class="card-body">
      <div class="mb-3">
        <label for="select">Status Transaksi</label>
        <select name="status_pembayaran" id="select"
          class="form-control<?= $validation->hasError('status_pembayaran') ? " is-invalid" : "" ?>">
          <option <?= $order['status_pembayaran'] == "menyicil" ? "selected" : "" ?> value="menyicil">Menyicil</option>
          <option <?= $order['status_pembayaran'] == "lunas" ? "selected" : "" ?> value="lunas">Lunas</option>
          <option <?= $order['status_pembayaran'] == "ditolak" ? "selected" : "" ?> value="ditolak">Ditolak</option>
        </select>
        <?php if($validation->hasError('status_pembayaran')) : ?>
        <div class="invalid-feedback">
          <?= $validation->getError('status_pembayaran') ?>
        </div>
        <?php endif; ?>
      </div>

      <div id="keterangan" class="d-none mb-3">
        <label for="select">Keterangan</label>
        <textarea name="keterangan" class="form-control" id="" cols="30" rows="10"></textarea>
        <?php if($validation->hasError('status_pembayaran')) : ?>
        <div class="invalid-feedback">
          <?= $validation->getError('status_pembayaran') ?>
        </div>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <button class="btn btn-primary btn-lg py-1 px-5" type="submit">Update</button>
      </div>
    </div>
  </form>
</div>

<script>
  $('#select').on('change', function() {
    if($('#select').val() == 'ditolak') {
      $('#keterangan').removeClass('d-none');
    }else {
      $('#keterangan').addClass('d-none');
    }
  });
</script>
<?= $this->endSection() ?>

<?= $this->section('head') ?>
<title>Mazasi's House | Admin Dashboard - Update Order</title>
<?= $this->endSection() ?>