<style>
  .title {
    text-align: center;
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }

  table, th, td {
    border: 1px solid black;
  }

  th {
    background: #ccc;
  }

  td, th {
    padding: 5px;
  }
</style>
<h1 class="title">Data Pengeluaran</h1>
<table>
  <thead>
    <th>#</th>
    <th>Tanggal</th>
    <th>Jumlah</th>
    <th>Jenis Pengeluaran</th>
    <th>Keterangan</th>
  </thead>
  <tbody>
    <?php $i = 1 ?>
    <?php foreach($pengeluarans as $pengeluaran) : ?>
      <tr>
        <td><?= $i++ ?></td>
        <td><?= $pengeluaran['tanggal'] ?></td>
        <td><?= $pengeluaran['jumlah'] ?></td>
        <td><?= $pengeluaran['jenis_pengeluaran'] ?></td>
        <td><?= $pengeluaran['keterangan'] ?></td>
      </tr>
      <?php endforeach ?>
  </tbody>
</table>