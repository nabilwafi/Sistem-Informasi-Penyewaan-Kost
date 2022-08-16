<?= $this->extend('users/template/body') ?>

<?= $this->section('content') ?>
<div class="my-3">
  <?= $this->include('messages/messages') ?>
</div>
<div class="card shadow mb-4">
  <div class="card-header py-3 d-flex justify-content-between align-items-center">
    <h6 class="m-0 font-weight-bold text-primary">Data Pembayaran</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#</th>
            <th>Nama Kamar</th>
            <th>Nama Pengirim</th>
            <th>No Rekening</th>
            <th>Nama Bank</th>
            <th>Bukti Pembayaran</th>
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
            <td>Kamar <?= $pembayaran['no_kamar'] ?></td>
            <td><?= $pembayaran['nama_pengirim'] ?></td>
            <td><?= $pembayaran['nomor_rekening'] ?></td>
            <td><?= $pembayaran['nama_bank'] ?></td>
            <td>
              <img width="150" src="/images/bukti_pembayaran/<?= $pembayaran['bukti_pembayaran'] ?>" alt="">
            </td>
            <td>Rp. <?= $pembayaran['pembayaran'] ?></td>
            <td><?= $pembayaran['created_at'] ?></td>
          </tr>
          <?php endforeach ?>
          <?php else : ?>
          <tr>
            <td colspan="10" class="text-center">There's no pembayaran data</td>
          </tr>
          <?php endif ?>
        </tbody>
      </table>

      <?= $pager->links('pembayarans', 'bootstrap_pager') ?>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('head') ?>
<title>Mazasi's House | Data Transaksi - Member</title>
<?= $this->endSection() ?>