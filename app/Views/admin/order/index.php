<?= $this->extend('admin/template/body') ?>

<?= $this->section('content') ?>
<div class="my-3">
  <?= $this->include('messages/messages') ?>
</div>
<div class="card shadow mb-4">
  <div class="card-header py-3 d-flex justify-content-between align-items-center">
    <h6 class="m-0 font-weight-bold text-primary">Data Order</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#</th>
            <th>Id Order</th>
            <th>No Kamar</th>
            <th>Nama Penyewa</th>
            <th>Tanggal Masuk</th>
            <th>Tanggal Keluar</th>
            <th>Durasi Tinggal</th>
            <th>Nominal Pembayaran</th>
            <th>Terbayar</th>
            <th>Status Transaksi</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if($orders[0]['id'] != NULL) : ?>
            <?php $i = 0 + (5 * ($currentPage - 1)); ?>
            <?php foreach($orders as $order) : ?>
            <tr>
              <td><?= ++$i ?></td>
              <td><?= $order['id'] ?></td>
              <td><?= $order['no_kamar'] ?></td>
              <td><?= $order['nama'] ?></td>
              <td><?= $order['tanggal_masuk'] ?></td>
              <td><?= $order['tanggal_keluar'] ?></td>
              <td><?= $order['durasi_sewa'] ?> Bulan</td>
              <td>Rp.<?= $order['nominal_pembayaran'] ?></td>
              <td>Rp.<?= $order['total_pembayaran_lunas'] ?></td>
              <td><?= $order['status_pembayaran'] ?></td>
              <td>
                <a class="btn btn-success" href="/admin/data-order/transaksi/user/<?= $order['id_user'] ?>/<?= $order['id'] ?>">
                  <i class="fas fa-search fa-sm fa-fw"></i>
                </a>
                <a class="btn btn-primary" href="/admin/data-order/<?= $order['id'] ?>">Update</a>
                </td>
            </tr>
            <?php endforeach ?>
          <?php else : ?>
          <tr>
            <td colspan="11" class="text-center">There's no order data</td>
          </tr>
          <?php endif ?>
        </tbody>
      </table>

      <?= $pager->links('orders', 'bootstrap_pager') ?>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('head') ?>
<title>Mazasi's House | Admin Dashboard - Data Member</title>
<?= $this->endSection() ?>