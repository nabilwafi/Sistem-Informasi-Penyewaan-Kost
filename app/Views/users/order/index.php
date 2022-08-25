<?= $this->extend('users/template/body') ?>

<?= $this->section('content') ?>
<div class="my-3">
  <?= $this->include('messages/messages') ?>
</div>
<div class="card shadow mb-4">
  <div class="card-header py-3 d-flex justify-content-between align-items-center">
    <h6 class="m-0 font-weight-bold text-primary">Data Order</h6>
      <?php if(isset($order['tanggal_keluar']) && isset($order['status_pembayaran'])) : ?>
        <?php if(date('Y-m-d') >= $order['tanggal_keluar'] && $order['status_pembayaran'] == 'lunas') :  ?>
          <a href="/member/perpanjangan/<?= $order['id_user'] ?>/<?= $order['id_kamar'] ?>" class="btn btn-primary">Melakukan Perpanjangan</a>
          <?php endif  ?>
      <?php endif ?>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#</th>
            <th>Id Order</th>
            <th>Nama Kamar</th>
            <th>Nama Penyewa</th>
            <th>Tanggal Masuk</th>
            <th>Tanggal Keluar</th>
            <th>Durasi Sewa</th>
            <th>Nominal Pembayaran</th>
            <th>Tanggal Terakhir Pembayaran</th>
            <th>Status Pembayaran</th>
            <th>Jumlah yang sudah dibayar</th>
            <th>Keterangan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if($orders) : ?>
          <?php $i = 0 + (5 * ($currentPage - 1)); ?>
          <?php foreach($orders as $order) : ?>
          <tr class="<?= $order['terakhir_pembayaran'] >= date('Y-m-d H:i:s') && $order['status_pembayaran'] == "belum bayar" ? "border-bottom-danger" : "" ?>">
            <td><?= ++$i ?></td>
            <td><?= $order['id'] ?></td>
            <td>Kamar <?= $order['no_kamar'] ?></td>
            <td><?= $order['nama'] ?></td>
            <td><?= $order['tanggal_masuk'] ?></td>
            <td><?= $order['tanggal_keluar'] ?></td>
            <td><?= $order['durasi_sewa'] ?> Bulan</td>
            <td>Rp. <?= $order['nominal_pembayaran'] ?></td>
            <td>
                <div class="btn pointer-event-none <?= $order['status_pembayaran'] != 'lunas' ? "btn-danger" : 'btn-success' ?>">
                  <?= $order['terakhir_pembayaran'] ?>
                </div>
            </td>
            <td><?= $order['status_pembayaran'] ?></td>
            <td>
              <?php if($order['total_pembayaran_lunas']) : ?>
                Rp. <?= $order['total_pembayaran_lunas'] ?>
              <?php else : ?>
                -
              <?php endif ?>
            </td>
            <td>
              <?php if($order['keterangan']) : ?>
                <?= $order['keterangan'] ?>
              <?php else : ?>
                -
              <?php endif ?>
            </td>
            <td>
              <?php
                if( ($order['total_pembayaran_lunas'] != $order['nominal_pembayaran']) && ($order['status_pembayaran'] != 'menunggu verifikasi') ){
              ?>
              <a href="/member/order/bayar/<?= $order['id'] ?>" class="btn btn-primary">Bayar</a>
              <?php
                }
              ?>
            </td>
          </tr>
          <?php endforeach ?>
          <?php else : ?>
          <tr>
            <td colspan="12" class="text-center">There's no order data</td>
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
<title>Mazasi's House | Data Transaksi - Member</title>
<?= $this->endSection() ?>