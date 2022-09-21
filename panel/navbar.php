<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="./">KariyerPanel v1.1</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?php if ($page == 'home') {echo "active";} ?> " href="./">Panel</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($page == 'new') {echo "active";} ?>" href="./new.php">Yeni Kayıt</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            İlan İşlemleri
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="../cron/cron.php" target="_blank">İlanları Al</a></li>
            <li><a class="dropdown-item" href="../cron/delete.php" target="_blank">İlanları Sil</a></li>
          </ul>
        </li>
      </ul>
      <div>
        <a href="./logout.php" class="btn btn-primary">Çıkış</a>
      </div>
    </div>
  </div>
</nav>