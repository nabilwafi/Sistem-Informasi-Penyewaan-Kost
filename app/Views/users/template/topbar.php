<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <?php if($deadlines) : ?>
        <button class="btn btn-danger pointer-event-none mr-3" type="button">
        Anda memiliki tenggat pembayaran<span class="badge"><?= count($deadlines) ?></span>
        </button>
    <?php endif ?>
    <?php if(isset($cicilan['nominal_pembayaran']) && isset($cicilan['total_pembayaran_lunas'])) : ?>
        <?php if($cicilan['nominal_pembayaran'] != $cicilan['total_pembayaran_lunas']) : ?>
            <div class="py-2 px-3 bg-secondary text-white rounded">
                Anda memiliki cicilan pembayaran sebesar Rp.<span><?= ($cicilan['nominal_pembayaran'] - $cicilan['total_pembayaran_lunas']) ?></span>
            </div>
        <?php endif ?>
    <?php endif ?>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= session()->get('nama') ?></span>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>