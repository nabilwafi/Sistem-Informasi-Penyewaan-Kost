<style>
  .title {
    text-align: center;
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }

  table,
  th,
  td {
    border: 1px solid black;
  }

  th {
    background: #ccc;
  }

  td,
  th {
    padding: 5px;
  }
</style>
<h1 class="title">Data Order</h1>
<div class="d-flex justify-content-between align-items-center">
  <p>Tanggal Cetak : <?= date('Y-m-d') ?></p>
</div>
<table>
  <thead>
    <th>#</th>
    <th>Tanggal Masuk</th>
    <th>Tanggal Keluar</th>
    <th>Durasi</th>
    <th>Nominal Pembayaran</th>
    <th>Status Pembayaran</th>
  </thead>
  <tbody>
    <?php $i = 1 ?>
    <?php $total = 0 ?>
    <?php foreach($pengeluarans as $pengeluaran) : ?>
      <tr>
        <td><?= $i++ ?></td>
        <td><?= $pengeluaran['tanggal_masuk'] ?></td>
        <td><?= $pengeluaran['tanggal_keluar'] ?></td>
        <td><?= $pengeluaran['durasi_sewa'] ?> Bulan</td>
        <td>Rp.<?= $pengeluaran['nominal_pembayaran'] ?></td>
        <td><?= $pengeluaran['status_pembayaran'] ?></td>
      </tr>
      <?php $total += $pengeluaran['nominal_pembayaran'] ?>
    <?php endforeach ?>
    <tr>
      <td colspan="5" class="text-left">Total</td>
      <td>Rp.<?= $total ?></td>
    </tr>
  </tbody>
</table>