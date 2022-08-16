<?= $this->extend('admin/template/body') ?>

<?= $this->section('content') ?>
<div class="my-3">
  <?= $this->include('messages/messages') ?>
</div>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Update Member</h6>
  </div>
  <form action="/admin/data-user/update/<?= $member['id'] ?>" method="POST">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT">

    <div class="card-body">
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Nama Member</label>
        <input type="text" class="form-control<?= $validation->hasError('nama') ? " is-invalid" : "" ?>"
          id="exampleFormControlInput1" name="nama" placeholder="1" value="<?= $member['nama'] ?>">
        <?php if($validation->hasError('nama')) : ?>
        <div class="invalid-feedback">
          <?= $validation->getError('nama') ?>
        </div>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">No Telepon Member</label>
        <input type="text" class="form-control<?= $validation->hasError('handphone') ? " is-invalid" : "" ?>"
          id="exampleFormControlInput1" name="handphone" placeholder="Angella S" value="<?= $member['handphone'] ?>">
        <?php if($validation->hasError('handphone')) : ?>
        <div class="invalid-feedback">
          <?= $validation->getError('handphone') ?>
        </div>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Email Address Member</label>
        <input type="text" class="form-control<?= $validation->hasError('email') ? " is-invalid" : "" ?>"
          id="exampleFormControlInput1" name="email" placeholder="Angella S" value="<?= $member['email'] ?>">
        <?php if($validation->hasError('email')) : ?>
        <div class="invalid-feedback">
          <?= $validation->getError('email') ?>
        </div>
        <?php endif; ?>
      </div>
      
      <div class="row">
        <div class="mb-3 col-md-6">
          <label for="exampleFormControlInput1" class="form-label">Old Password Member</label>
          <input type="password" readonly class="form-control<?= $validation->hasError('password') ? " is-invalid" : "" ?>"
            id="exampleFormControlInput1" name="password" placeholder="1" value="<?= $member['password'] ?>">
          <?php if($validation->hasError('password')) : ?>
          <div class="invalid-feedback">
            <?= $validation->getError('password') ?>
          </div>
          <?php endif; ?>
        </div>
  
        <div class="mb-3 col-md-6">
          <label for="exampleFormControlInput1" class="form-label">Password Member</label>
          <input type="password" class="form-control<?= $validation->hasError('password') ? " is-invalid" : "" ?>"
            id="exampleFormControlInput1" name="password" placeholder="1" value="<?= $member['password'] ?>">
          <?php if($validation->hasError('password')) : ?>
          <div class="invalid-feedback">
            <?= $validation->getError('password') ?>
          </div>
          <?php endif; ?>
        </div>
      </div>

      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
        <textarea class="form-control<?= $validation->hasError('alamat') ? " is-invalid" : "" ?>" name="alamat"
          id="exampleFormControlTextarea1" rows="3"><?= $member['alamat'] ?></textarea>
        <?php if($validation->hasError('alamat')) : ?>
        <div class="invalid-feedback">
          <?= $validation->getError('alamat') ?>
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