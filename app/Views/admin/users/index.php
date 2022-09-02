<?= $this->extend('admin/template/body') ?>

<?= $this->section('content') ?>
<div class="my-3">
  <?= $this->include('messages/messages') ?>
</div>
<div class="card shadow mb-4">
  <div class="card-header py-3 d-flex justify-content-between align-items-center">
    <h6 class="m-0 font-weight-bold text-primary">Data Member</h6>
    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#tambahMember">
      <i class="fas fa-plus fa-sm fa-fw mr-2 text-gray-400"></i>
      Tambah Member
    </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No Telepon</th>
            <th>Alamat</th>
            <th>Foto KTP</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if($members) : ?>
          <?php $i = 0 + (5 * ($currentPage - 1)); ?>
          <?php foreach($members as $member) : ?>
          <tr>
            <td><?= ++$i ?></td>
            <td><?= $member['nama'] ?></td>
            <td><?= $member['email'] ?></td>
            <td><?= $member['handphone'] ?></td>
            <td><?= $member['alamat'] ?></td>
            <td>
              <?php if($member['ktp']) : ?>
                <img src="/images/kamar/<?= $member['ktp'] ?>" alt="" width="50" height="50" />
                <?php endif ?>
            </td>
            <td>
              <a class="btn btn-primary" href="/admin/data-user/update/<?= $member['id'] ?>">Update</a>

              <form class="d-inline-block" action="/admin/data-user/<?= $member['id'] ?>" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <button name="DELETE" type="submit" class="btn btn-danger">Delete</button>
              </form>
            </td>
          </tr>
          <?php endforeach ?>
          <?php else : ?>
          <tr>
            <td colspan="6" class="text-center">There's no user data</td>
          </tr>
          <?php endif ?>
        </tbody>
      </table>
            
      <?= $pager->links('members', 'bootstrap_pager') ?>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambahMember" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Member</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form action="/admin/data-user" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="POST">

        <div class="modal-body">
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nama</label>
            <input type="text" class="form-control<?= $validation->hasError('nama') ? " is-invalid" : "" ?>"
              id="exampleFormControlInput1" name="nama" placeholder="Angella S" value="<?= old('nama') ?>">
            <?php if($validation->hasError('nama')) : ?>
            <div class="invalid-feedback">
              <?= $validation->getError('nama') ?>
            </div>
            <?php endif; ?>
          </div>

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email Address</label>
            <input type="email" class="form-control<?= $validation->hasError('email') ? " is-invalid" : "" ?>"
              id="exampleFormControlInput1" name="email" placeholder="nama@example" value="<?= old('email') ?>">
            <?php if($validation->hasError('email')) : ?>
            <div class="invalid-feedback">
              <?= $validation->getError('email') ?>
            </div>
            <?php endif; ?>
          </div>

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Password</label>
            <input type="password" class="form-control<?= $validation->hasError('password') ? " is-invalid" : "" ?>"
              id="exampleFormControlInput1" name="password">
            <?php if($validation->hasError('password')) : ?>
            <div class="invalid-feedback">
              <?= $validation->getError('password') ?>
            </div>
            <?php endif; ?>
          </div>

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nomor Telepon</label>
            <input type="tel" class="form-control<?= $validation->hasError('handphone') ? " is-invalid" : "" ?>"
              id="exampleFormControlInput1" name="handphone" placeholder="Your Tel"  value="<?= old('handphone') ?>"
            >
            <?php if($validation->hasError('handphone')) : ?>
            <div class="invalid-feedback">
              <?= $validation->getError('handphone') ?>
            </div>
            <?php endif; ?>
          </div>

          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
            <textarea class="form-control<?= $validation->hasError('alamat') ? " is-invalid" : "" ?>" name="alamat"
              id="exampleFormControlTextarea1" rows="3"><?= old('alamat') ?></textarea>
            <?php if($validation->hasError('alamat')) : ?>
            <div class="invalid-feedback">
              <?= $validation->getError('alamat') ?>
            </div>
            <?php endif; ?>
          </div>
        </div>

        <div class="modal-footer">
          <button class="btn btn-primary" type="submit">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('head') ?>
<title>Mazasi's House | Admin Dashboard - Data Member</title>
<?= $this->endSection() ?>