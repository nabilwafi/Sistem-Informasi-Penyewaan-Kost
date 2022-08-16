<?= $this->extend('admin/template/body') ?>

<?= $this->section('content') ?>
<div class="my-3">
  <?= $this->include('messages/messages') ?>
</div>
<div class="card shadow mb-4">
  <div class="card-header py-3 d-flex justify-content-between align-items-center">
    <h6 class="m-0 font-weight-bold text-primary">Data Kamar</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#</th>
            <th>No Kamar</th>
            <th>Nama Penyewa</th>
            <th>Nama Pengirim</th>
            <th>Nomor Rekening</th>
            <th>Nama Bank</th>
            <th>Nominal Pembayaran</th>
            <th>Tanggal Pembayaran</th>
          </tr>
        </thead>
        <tbody>
          <?php if($pembayarans) : ?>
          <?php $i = 0 + (5 * ($currentPage - 1)); ?>
          <?php foreach($pembayarans as $pembayaran) : ?>
          <tr>
            <td><?= ++$i ?></td>
            <td><?= $pembayaran['no_kamar'] ?></td>
            <td><?= $pembayaran['nama'] ?></td>
            <td><?= $pembayaran['nama_pengirim'] ?></td>
            <td><?= $pembayaran['nomor_rekening'] ?></td>
            <td><?= $pembayaran['nama_bank'] ?></td>
            <td>
              <img width="150" src="/images/bukti_pembayaran/<?= $pembayaran['bukti_pembayaran'] ?>" alt="">
            </td>
            <td><?= $pembayaran['created_at'] ?></td>
          <?php endforeach ?>
          <?php else : ?>
          <tr>
            <td colspan="8" class="text-center">There's no pembayaran data</td>
          </tr>
          <?php endif ?>
        </tbody>
      </table>

      <?= $pager->links('pembayarans', 'bootstrap_pager') ?>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambahMember" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kamar</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form action="/admin/data-kamar" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="POST">

        <div class="modal-body">
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">No Kamar</label>
            <input type="text" class="form-control<?= $validation->hasError('no_kamar') ? " is-invalid" : "" ?>"
              id="exampleFormControlInput1" name="no_kamar" placeholder="1" value="<?= old('no_kamar') ?>">
            <?php if($validation->hasError('no_kamar')) : ?>
            <div class="invalid-feedback">
              <?= $validation->getError('no_kamar') ?>
            </div>
            <?php endif; ?>
          </div>

          <div class="mb-3">
            <label for="formFile" class="form-label">Gambar Kamar</label>
            <input class="form-control<?= $validation->hasError('gambar') ? " is-invalid" : "" ?>" type="file"
              name="gambar" id="formFile">
            <?php if($validation->hasError('gambar')) : ?>
            <div class="invalid-feedback">
              <?= $validation->getError('gambar') ?>
            </div>
            <?php endif; ?>
          </div>

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Harga Kamar</label>
            <input type="text" class="form-control<?= $validation->hasError('harga_kamar') ? " is-invalid" : "" ?>"
              id="exampleFormControlInput1" name="harga_kamar" placeholder="Angella S"
              value="<?= old('harga_kamar') ?>">
            <?php if($validation->hasError('harga_kamar')) : ?>
            <div class="invalid-feedback">
              <?= $validation->getError('harga_kamar') ?>
            </div>
            <?php endif; ?>
          </div>

          <div class="mb-3">
            <label for="select">Status Kamar</label>
            <select name="status_kamar" id="select" class="form-control<?= $validation->hasError('status_kamar') ? " is-invalid" : "" ?>">
              <option value="tidak terisi">Tidak Terisi</option>
              <option value="terisi">Terisi</option>
            </select>
            <?php if($validation->hasError('status_kamar')) : ?>
            <div class="invalid-feedback">
              <?= $validation->getError('status_kamar') ?>
            </div>
            <?php endif; ?>
          </div>

          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
            <textarea class="form-control<?= $validation->hasError('deskripsi') ? " is-invalid" : "" ?>"
              name="deskripsi" id="exampleFormControlTextarea1" rows="3"><?= old('deskripsi') ?></textarea>
            <?php if($validation->hasError('deskripsi')) : ?>
            <div class="invalid-feedback">
              <?= $validation->getError('deskripsi') ?>
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