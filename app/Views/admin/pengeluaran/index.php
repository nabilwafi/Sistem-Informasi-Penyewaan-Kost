<?= $this->extend('admin/template/body') ?>

<?= $this->section('content') ?>
<div class="my-3">
  <?= $this->include('messages/messages') ?>
</div>
<div class="card shadow mb-4">
  <div class="card-header py-3 d-flex justify-content-between align-items-center">
    <h6 class="m-0 font-weight-bold text-primary">Data Pengeluaran</h6>

    <form action="" method="GET">
      <div class="row align-items-center">
        <div class="col-lg-5">
          <div class="input-group">
            <input type="date" name="tanggal_awal" class="form-control">
          </div>
        </div>
        <div class="col-lg-5">
          <div class="input-group">
            <input type="date" name="tanggal_akhir" class="form-control">
          </div>
        </div>

        <div class="col-lg-2">
          <button class="btn btn-primary py-2" type="submit">
            <i class="fas fa-plus fa-md fa-search text-gray-400"></i>
          </button>
        </div>
      </div>
    </form>

    <div class="d-flex">
      <a class="btn btn-primary mr-2" href="#" data-toggle="modal" data-target="#tambahMember">
        <i class="fas fa-plus fa-sm fa-fw mr-2 text-gray-400"></i>
        Tambah Pengeluaran
      </a>
      <form action="/admin/data-pengeluaran/download" method="POST">
        <input type="hidden" name="tanggal_awal" value="<?= $tanggal_awal ?>">
        <input type="hidden" name="tanggal_akhir" value="<?= $tanggal_akhir ?>">

        <button type="submit" class="btn btn-danger">
          <i class="fas fa-download mr-2"></i>
          Download
        </button>
      </form>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#</th>
            <th>Tanggal</th>
            <th>Jumlah</th>
            <th>Jenis Pengeluaran</th>
            <th>Keterangan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if($pengeluarans) : ?>
          <?php $i = 0 + (5 * ($currentPage - 1)); ?>
          <?php foreach($pengeluarans as $pengeluaran) : ?>
          <tr>
            <td><?= ++$i ?></td>
            <td><?= $pengeluaran['tanggal'] ?></td>
            <td><?= $pengeluaran['jumlah'] ?></td>
            <td><?= $pengeluaran['jenis_pengeluaran'] ?></td>
            <td><?= $pengeluaran['keterangan'] ?></td>
            <td>
              <a class="btn btn-primary" href="/admin/data-pengeluaran/<?= $pengeluaran['id'] ?>">Update</a>

              <form class="d-inline-block" action="/admin/data-pengeluaran/<?= $pengeluaran['id'] ?>" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <button name="DELETE" type="submit" class="btn btn-danger">Delete</button>
              </form>
            </td>
          </tr>
          <?php endforeach ?>
          <?php else : ?>
          <tr>
            <td colspan="6" class="text-center">There's no pengeluaran data</td>
          </tr>
          <?php endif ?>
        </tbody>
      </table>

      <?= $pager->links('pengeluarans', 'bootstrap_pager') ?>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambahMember" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form action="/admin/data-pengeluaran" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="POST">

        <div class="modal-body">
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
            <input type="date" class="form-control<?= $validation->hasError('tanggal') ? " is-invalid" : "" ?>"
              id="exampleFormControlInput1" name="tanggal" placeholder="Angella S" value="<?= old('tanggal') ?>">
            <?php if($validation->hasError('tanggal')) : ?>
            <div class="invalid-feedback">
              <?= $validation->getError('tanggal') ?>
            </div>
            <?php endif; ?>
          </div>

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Jumlah Pengeluaran</label>
            <input type="text" class="form-control<?= $validation->hasError('jumlah') ? " is-invalid" : "" ?>"
              id="exampleFormControlInput1" name="jumlah" value="<?= old('jumlah') ?>">
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
              <option value="listrik">Listrik</option>
              <option value="air">Air</option>
              <option value="internet">Internet</option>
              <option value="kebersihan">Kebersihan</option>
              <option value="lain-lain">Lain-Lain</option>
            </select>
            <?php if($validation->hasError('jenis_pengeluaran')) : ?>
            <div class="invalid-feedback">
              <?= $validation->getError('jenis_pengeluaran') ?>
            </div>
            <?php endif; ?>
          </div>

          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Keterangan</label>
            <textarea class="form-control<?= $validation->hasError('keterangan') ? " is-invalid" : "" ?>"
              name="keterangan" id="exampleFormControlTextarea1" rows="3"><?= old('keterangan') ?></textarea>
            <?php if($validation->hasError('keterangan')) : ?>
            <div class="invalid-feedback">
              <?= $validation->getError('keterangan') ?>
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