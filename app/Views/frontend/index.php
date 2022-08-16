<?= $this->extend('frontend/template/body') ?>

<?= $this->section('content') ?>
<!-- Jumbotron Carousel -->
<div class="relative">
  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
        aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
        aria-label="Slide 2"></button>

    </div>
    <div class="carousel-inner">
      <div class="carousel-item active jumbotron-home">
        <img src="/images/jumbotron/home_1.jpeg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block jumbotron-information">
          <h5 class="jumbotron-title">Selamat Datang di Mazasi's House</h5>
          <p class="jumbotron-subtitle">Komplek Setra Regency Blok B No. 40, Ciwaruga, Kabupaten Bandung Barat</p>
        </div>
      </div>
      <div class="carousel-item jumbotron-home">
        <img src="/images/jumbotron/home_2.jpeg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block jumbotron-information">
          <h5 class="jumbotron-title">Dapatkan Hunian Nyaman hanya di Kost Mazasi's House</h5>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>
<!-- End of Jumbotron Carousel -->
<?= $this->endSection() ?>

<?= $this->section('head') ?>
<title>Mazasi's House</title>
<?= $this->endSection() ?>