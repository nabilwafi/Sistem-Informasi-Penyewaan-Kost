<?php if(session()->getFlashdata('error')) : ?>
  <div class="alert alert-danger" role="alert">
    <?= session()->getFlashdata('error') ?>
  </div>
<?php endif; ?>

<?php if(session()->getFlashdata('success')) : ?>
  <div class="alert alert-success" role="alert">
    <?= session()->getFlashdata('success') ?>
  </div>
<?php endif; ?>