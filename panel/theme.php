<?php
   require_once "../ayar.php";
?>
<body id="page-top">
   <div id="container">
   <!-- Page Wrapper -->
   <div id="wrapper">
   <!-- Sidebar -->
   <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../panel/index.php">
         <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-smile"></i>
         </div>
         <div class="sidebar-brand-text mx-3">Hoş Geldin 
            <?php
            if (isset($_SESSION["ogr"])) {
                echo $_SESSION["ogrAd"] ." " . $_SESSION["ogrSoyad"];
            }
            if (isset($_SESSION["aka"])) {
                echo $_SESSION["akaAd"] . " " . $_SESSION["akaSoyad"];
            }
            ?>
         </div>
      </a>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
         <a class="nav-link" href="../panel/index.php">
         <i class="fas fa-home"></i>
         <span>Anasayfa</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <!--
         <div class="sidebar-heading">
           Blog Yönetimi
         </div>-->
      <!-- Nav Item - Pages Collapse Menu -->
      <?php
            if (isset($_SESSION["aka"])) { ?>
      <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
         <i class="far fa-clock"></i>
         <span>Oturum Yönetimi</span>
         </a>
         <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
               <!--<h6 class="collapse-header">İçerik</h6>-->
               <a class="collapse-item" href="../panel/oturum.php?islem=baslat">Oturum Başlat</a>
               <a class="collapse-item" href="../panel/oturum.php?islem=listele">Tüm Oturumlar</a>
            </div>
         </div>
      </li>
      <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseUsers">
         <i class="fas fa-fw fa-users"></i>
         <span>Öğrenci Yönetimi</span>
         </a>
         <div id="collapseUsers" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
               <!--<h6 class="collapse-header">Custom Utilities:</h6>-->
               <a class="collapse-item" href="../panel/ogrenci.php?islem=listele">Tüm Öğrenciler</a>
               <a class="collapse-item" href="../panel/ogrenci.php?islem=ekle">Öğrenci Ekle</a>
            </div>
         </div>
      </li>
      <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLessons" aria-expanded="true" aria-controls="collapseLessons">
         <i class="fas fa-fw fa-users"></i>
         <span>Ders Yönetimi</span>
         </a>
         <div id="collapseLessons" class="collapse" aria-labelledby="headingLessons" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
               <!--<h6 class="collapse-header">Custom Utilities:</h6>-->
               <a class="collapse-item" href="../panel/ders.php?islem=listele">Tüm Dersler</a>
               <a class="collapse-item" href="../panel/ders.php?islem=ekle">Ders Ekle</a>
            </div>
         </div>
      </li>
            <?php } ?>
            <?php
            if (isset($_SESSION["ogr"])) { ?>
      <li class="nav-item">
         <a class="nav-link" href="../panel/oturum.php">
         <i class="far fa-clock"></i>
         <span>Oturumlarım</span></a>
      </li>
            <?php } ?>
      <!--
      <li class="nav-item">
         <a class="nav-link" href="../panel/messages.php">
         <i class="fas fa-fw fa-envelope"></i>
         <span>Mesajlar</span></a>
      </li>
      -->
      <!-- Divider -->
      <hr class="sidebar-divider">
      <li class="nav-item">
         <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
         <i class="fas fa-fw fas fa-sign-out-alt"></i>
         <span>Oturumu Kapat</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
   </ul>
   <!-- End of Sidebar -->
   <!-- Content Wrapper -->
   <div id="content-wrapper" class="d-flex flex-column">
   <!-- Main Content -->
   <div id="content">
   <!-- Topbar -->
   <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
      <?php
         function title($title)
         {
             echo $title;
         }
      ?>
      <!-- Sidebar Toggle (Topbar) -->
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
      <i class="fa fa-bars"></i>
      </button>
      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">
         <div class="topbar-divider d-none d-sm-block"></div>
         <!-- Nav Item - User Information -->
         <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
               <?php
               if (isset($_SESSION["ogr"])) {
                   echo $_SESSION["ogrAd"] ." " . $_SESSION["ogrSoyad"];
               }
               if (isset($_SESSION["aka"])) {
                   echo $_SESSION["akaAd"] . " " . $_SESSION["akaSoyad"];
               }
               ?>
            </span>
            <img class="img-profile rounded-circle" src="../panel/img/user.png">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
               <!--
                  <a class="dropdown-item" href="../panel/profile.php">
                    <i class="fas fa-user-circle fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profil
                  </a>
                  
                  <div class="dropdown-divider"></div>
                  -->
               <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
               <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400">a</i> Çıkış
               </a>
            </div>
         </li>
      </ul>
   </nav>
   <!-- End of Topbar -->
   <!-- Begin Page Content -->
   <div class="container-fluid">