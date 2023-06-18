<?php 
    require_once '../controller/mainController.php';

    $id = dekripsi($_COOKIE['VRK21ZA']);

    $user = query("SELECT * FROM user WHERE iduser = $id") [0];

    $nama = $user['nama'];
    $kataPertama = explode(' ', $nama)[0];
?>

<!-- Membuat Navbar -->
<nav class="navbar navbar-expand navbar-light" style="background-color:#5075cc;">
    <div class="container">
        <a class="navbar-brand text-white fw-bold fs-3 " href="../index.php">VARK Model</a>
        
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav me-3 ">
                <li class="nav-item">
                    <a class="nav-link fw-bold text-white" href="../index.php">Home</a>
                </li>
            </ul>
            <div class="btn-group">
                <button type="button" class="btn btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: white;">
                    Hi, <b><?= $kataPertama; ?></b>
                </button>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
                    <li><a class="dropdown-item" href="../profile">Profile dan Riwayat Tes</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="../logout.php"><i class="bi bi-power"></i> Logout</a></li>
                </ul>
            </div>
        </div>    
    </div>
</nav>

<!-- Navbar Selesai -->

