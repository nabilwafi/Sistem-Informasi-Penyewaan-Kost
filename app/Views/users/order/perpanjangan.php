<?= $this->extend('admin/template/body') ?>

<?= $this->section('content') ?>
<div class="my-3">
  <?= $this->include('messages/messages') ?>
</div>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Perpanjangan Kost</h6>
  </div>
  <form action="/member/perpanjangan" method="POST">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="POST" />
    <input type="hidden" name="id_user" value="<?= $id_user ?>">
    <input type="hidden" name="id_kamar" value="<?= $id_kamar ?>">

    <div class="card-body">
      <div class="mb-3">
        <label for="select">Durasi</label>
        <select name="durasi_sewa" id="select"
          class="form-control<?= $validation->hasError('durasi_sewa') ? " is-invalid" : "" ?>">
          <option value="3">3</option>
          <option value="6">6</option>
          <option value="12">12</option>
        </select>
        <?php if($validation->hasError('durasi_sewa')) : ?>
        <div class="invalid-feedback">
          <?= $validation->getError('durasi_sewa') ?>
        </div>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <button class="btn btn-primary btn-lg py-1 px-5" type="submit">Perpanjangan</button>
      </div>
    </div>
  </form>
</div>

<?= $this->endSection() ?>

<?= $this->section('head') ?>
<title>Mazasi's House | Admin Dashboard - Perpanjangan Kost</title>
<?= $this->endSection() ?>