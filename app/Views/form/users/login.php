<?= $this->extend('form/layout/body') ?>

<?= $this->section('content') ?>
<section class="vh-100 bg-secondary">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5">

            <h3 class="mb-4">Login Member</h3>
            <?= $this->include('messages/messages') ?>

            <form action="/login" method="post">
              <?= csrf_field() ?>
              <input type="hidden" name="_method" value="POST">

              <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control<?= $validation->hasError('email') ? " is-invalid" : "" ?>" id="floatingInput" placeholder="name@example.com" value="<?= old('email') ?>">
                <label for="floatingInput">Email address</label>
                <?php if($validation->hasError('email')) : ?>
                <div class="invalid-feedback">
                  <?= $validation->getError('email') ?>
                </div>
                <?php endif; ?>
              </div>
  
              <div class="form-floating mb-2">
                <input type="password" name="password" class="form-control<?= $validation->hasError('password') ? " is-invalid" : "" ?>" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
                <?php if($validation->hasError('password')) : ?>
                <div class="invalid-feedback">
                  <?= $validation->getError('password') ?>
                </div>
                <?php endif; ?>
              </div>
                <button class="mb-3 btn btn-primary px-5 btn-lg btn-block" type="submit">Login</button>

                <div class="d-flex justify-content-between align-items-center">
                  <div>Anda tidak memiliki akun? <a href="/register">Daftar</a></div>
                  <a href="/">Kembali ke beranda</a>
                </div>
              </div>
            </form>

          </div>

        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>