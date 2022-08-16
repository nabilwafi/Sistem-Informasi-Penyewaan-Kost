<?= $this->extend('admin/template/body') ?>

<?= $this->section('content') ?>
<div class="my-3">
  <?= $this->include('messages/messages') ?>
</div>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Update Pengeluaran</h6>
  </div>
  
  <form action="/admin/data-pengeluaran/<?= $pengeluaran['id'] ?>" method="POST">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT">

    <div class="card-body">
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
        <input type="date" class="form-control<?= $validation->hasError('tanggal') ? " is-invalid" : "" ?>"
          id="exampleFormControlInput1" name="tanggal" placeholder="Angella S" value="<?= $pengeluaran['tanggal'] ?>">
        <?php if($validation->hasError('tanggal')) : ?>
        <div class="invalid-feedback">
          <?= $validation->getError('tanggal') ?>
        </div>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Jumlah Pengeluaran</label>
        <input type="text" class="form-control<?= $validation->hasError('jumlah') ? " is-invalid" : "" ?>"
          id="exampleFormControlInput1" name="jumlah" value="<?= $pengeluaran['jumlah'] ?>">
        <?php if($validation->hasError('jumlah')) : ?>
        <div class="invalid-feedback">
          <?= $validation->getError('jumlah') ?>
        </div>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <label for="select">Jenis Pengeluaran</label>
        <select name="jenis_pengeluaran" id="select"
          class="form-control<?= $validation->hasError('jenis_pengeluaran') ? " is-invalid" : "" ?>">
          <option <?= $pengeluaran['jumlah'] == "listrik" ? "selected" : "" ?> value="listrik">Listrik</option>
          <option <?= $pengeluaran['jumlah'] == "air" ? "selected" : "" ?> value="air">Air</option>
          <option <?= $pengeluaran['jumlah'] == "internet" ? "selected" : "" ?> value="internet">Internet</option>
          <option <?= $pengeluaran['jumlah'] == "kebersihan" ? "selected" : "" ?> value="kebersihan">Kebersihan</option>
          <option <?= $pengeluaran['jumlah'] == "lain-lain" ? "selected" : "" ?> value="lain-lain">Lain-Lain</option>
        </select>
        <?php if($validation->hasError('jenis_pengeluaran')) : ?>
        <div class="invalid-feedback">
          <?= $validation->getError('jenis_pengeluaran') ?>
        </div>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Keterangan</label>
        <textarea class="form-control<?= $validation->hasError('keterangan') ? " is-invalid" : "" ?>" name="keterangan"
          id="exampleFormControlTextarea1" rows="3"><?= $pengeluaran['keterangan'] ?></textarea>
        <?php if($validation->hasError('keterangan')) : ?>
        <div class="invalid-feedback">
          <?= $validation->getError('keterangan') ?>
        </div>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <button class="btn btn-primary btn-lg py-1 px-5" type="submit">Update</button>
      </div>
    </div>
  </form>
</div>

<?= $this->endSection() ?>

<?= $this->section('head') ?>
<title>Mazasi's House | Admin Dashboard - Update Member</title>
<?= $this->endSection() ?>