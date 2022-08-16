<nav class="navbar navbar-expand-lg bg-light">
  <div class="container d-flex align-items-center justify-content-between">
    <a class="navbar-brand" href="/">Mazasi's House</a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav justify-content-center w-100">
        <li class="nav-item">
          <a class="nav-link" href="/">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/seputar-kost">Seputar Kost</a>
        </li>
      </ul>
    </div>

    <?php if(!session()->get('isLoginedIn')) : ?>
      <a href="/login" class="btn btn-primary">Login</a>
      <?php else : ?>
        <?php if(session()->get('role') == 'admin') : ?>
          <a href="/admin/" class="btn btn-primary">Dashboard</a>
          <?php else : ?>
            <a href="/member" class="btn btn-primary">Dashboard</a>
        <?php endif ?>
    <?php endif ?>
  </div>
</nav>