<?= $this->extend('frontend/template/body') ?>

<?= $this->section('content') ?>
<div class="container py-5">
  <div class="row my-3">
    <?php foreach($kamars as $kamar) : ?>
    <div class="card card-kostan col-md-4" style="width: 25rem;">
      <img src="/images/kamar/<?= $kamar['gambar'] ?>" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title"><?= $kamar['no_kamar'] ?></h5>
        <p class="card-text"><?= $kamar['deskripsi'] ?></p>
        <?php if($kamar['status_kamar'] == "terisi") : ?>
          <span class="btn btn-secondary pointer-event-none">Telah Terisi</span>
        <?php else : ?>
          <a href="/pesan/kamar/<?= $kamar['id'] ?>" class="btn btn-primary">Pesan</a>
        <?php endif ?>
      </div>
    </div>
    <?php endforeach ?>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('head') ?>
<title>Mazasi's Houser | Seputar Kost</title>
<?= $this->endSection() ?>