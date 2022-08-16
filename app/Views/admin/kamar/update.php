<?= $this->extend('admin/template/body') ?>

<?= $this->section('content') ?>
<div class="my-3">
  <?= $this->include('messages/messages') ?>
</div>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Update Member</h6>
  </div>
  <form action="/admin/data-kamar/<?= $kamar['id'] ?>" method="POST" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="old_gambar" value="<?= $kamar['gambar'] ?>" />

    <div class="card-body">
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">No Kamar</label>
        <input type="text" class="form-control<?= $validation->hasError('no_kamar') ? " is-invalid" : "" ?>"
          id="exampleFormControlInput1" name="no_kamar" placeholder="1" value="<?= $kamar['no_kamar'] ?>">
        <?php if($validation->hasError('no_kamar')) : ?>
        <div class="invalid-feedback">
          <?= $validation->getError('no_kamar') ?>
        </div>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <label for="formFile" class="form-label">Gambar Kamar</label>
        <input class="form-control<?= $validation->hasError('gambar') ? " is-invalid" : "" ?>" type="file" name="gambar"
          id="formFile">
        <?php if($validation->hasError('gambar')) : ?>
        <div class="invalid-feedback">
          <?= $validation->getError('gambar') ?>
        </div>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Harga Kamar</label>
        <input type="text" class="form-control<?= $validation->hasError('harga_kamar') ? " is-invalid" : "" ?>"
          id="exampleFormControlInput1" name="harga_kamar" placeholder="Angella S" value="<?= $kamar['harga_kamar'] ?>">
        <?php if($validation->hasError('harga_kamar')) : ?>
        <div class="invalid-feedback">
          <?= $validation->getError('harga_kamar') ?>
        </div>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <label for="select">Status Kamar</label>
        <select name="status_kamar" id="select"
          class="form-control<?= $validation->hasError('status_kamar') ? " is-invalid" : "" ?>">
          <option <?= $kamar['status_kamar'] == "tidak terisi" ? "selected" : "" ?> value="tidak terisi">Tidak Terisi</option>
          <option <?= $kamar['status_kamar'] == "terisi" ? "selected" : "" ?> value="terisi">Terisi</option>
        </select>
        <?php if($validation->hasError('status_kamar')) : ?>
        <div class="invalid-feedback">
          <?= $validation->getError('status_kamar') ?>
        </div>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
        <textarea class="form-control<?= $validation->hasError('deskripsi') ? " is-invalid" : "" ?>" name="deskripsi"
          id="exampleFormControlTextarea1" rows="3"><?= $kamar['deskripsi'] ?></textarea>
        <?php if($validation->hasError('deskripsi')) : ?>
        <div class="invalid-feedback">
          <?= $validation->getError('deskripsi') ?>
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
<title>Mazasi's House | Admin Dashboard - Update kamar</title>
<?= $this->endSection() ?>