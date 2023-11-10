<nav class="navbar navbar-expand-lg bg-warning">

    <div class="container-fluid">
        <a class="navbar-brand" href="#">MotaMorph</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse justify-content-center collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav text-end">
                <a class="nav-link {{ request()->is('admin') ? 'active' : '' }}" aria-current="page"
                    href="<?= '/admin' ?>">Dashboard</a>
                <a class="nav-link {{ request()->is('admin/transactions*') ? 'active' : '' }}"
                    href="<?= '/admin/transactions' ?>">Transaksi</a>
                <a class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}"
                    href="/admin/products">Produk</a>
                <a class="nav-link {{ request()->is('admin/customers*') ? 'active' : '' }}"
                    href="/admin/customers">Kelola Kostumer</a>
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-solid fa-user" style="color: #000000;"></i>
                        Hallo, Admin
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="/login">Logout</a></li>
                    </ul>
                </li>
            </div>
        </div>
    </div>

</nav>
