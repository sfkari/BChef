<?php
function page_header(){ 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BChef</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="./css/swiper-bundle.min.css">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <header>
    <div class="container py-2">
      <div class="row justify-content-between align-items-center">
        <div class="col-md-2">
          <nav>
            <div class="navbar">
              <div class="container nav-container">
                <input class="checkbox" type="checkbox" name="" id="" />
                <div class="hamburger-lines">
                  <span class="line line1"></span>
                  <span class="line line2"></span>
                  <span class="line line3"></span>
                </div>

                <div class="menu-items">
                  <li><a href="index.php">Accueil</a></li>
                  <li><a href="recettes.php">Recettes</a></li>
                  <li><a href="blogs.php">Blogs</a></li>
                  <!-- <li><a href="Espace_utilisateur.php">Mon Espace</a></li> -->
                  <li><a href="contact.php">Contact</a></li>
                </div>

              </div>
            </div>
          </nav>
        </div>

        <div class="col-md-6 text-center">
          <a href="index.php" class="d-inline-flex link-body-emphasis text-decoration-none">
            <img src="./images/logo22.png" alt="" width="200">
          </a>
        </div>

        <div class="col-md-2 text-end">
  <?php if(isset($_SESSION['admin']) || isset($_SESSION['utilisateur'])) { ?>
    <div class="dropdown profil_user">
      <button class="btn text-white dropdown-toggle" type="button" id="dropdownMenuButton"
        data-bs-toggle="dropdown" aria-expanded="false">
        <svg class="rounded-circle me-2" xmlns="http://www.w3.org/2000/svg" width="35" height="35"
          fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
          <path fill-rule="evenodd"
            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
        </svg>
        <strong>
          <?php if(isset($_SESSION['admin'])) { echo $_SESSION['admin']; }
          else if(isset($_SESSION['utilisateur'])) { echo $_SESSION['utilisateur']; } ?>
        </strong>
      </button>
      <ul class="dropdown-menu bg-gray-200" id="menu" aria-labelledby="dropdownMenuButton">
        <?php if(isset($_SESSION['admin'])) { ?>
          <li class=""><a class="dropdown-item" href="./admin/admin_recettes.php">Mon profil</a></li>
        <?php } else if(isset($_SESSION['utilisateur'])) { ?>
          <li class=""><a class="dropdown-item" href="Espace_utilisateur.php">Mon profil</a></li>
        <?php } ?>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item" href="./Login/logout.php">Déconnexion</a></li>
      </ul>
    </div>
  <?php } else { ?>
    <a href="./Login/login.php">
    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-person-fill" viewBox="0 0 16 16">
  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
</svg>
    </a>
  <?php } ?>
</div>

      </div>
      <div class="row">
        <div class="col-md-12">
          <!-- <div id="searchBox" class="mobile-form">
            <form action="/search" class="search-form" id="searchform" method="get">
              
              <input id="sbox" name="q"
                onblur="if (this.placeholder == '') {this.placeholder = 'To search type + hit enter';}"
                onfocus="if (this.placeholder == 'To search type + hit enter') {this.placeholder = '';}"
                placeholder="To search type + hit enter" type="text" x-webkit-speech="">
                <span id="searchIcon"><input class="sb-search-submit" type="submit" value="">
                <span class="sb-icon-search"></span></span>
            </form>
          </div> -->
          <form method="post" class="search-box" action="recherche.php">
            <div class="form-group">
                <input type="text" class="form-control" id="searchTerm" name="searchTerm" onblur="if (this.placeholder == '') {this.placeholder = 'Entrez un terme de recherche';}"
                onfocus="if (this.placeholder == 'Entrez un terme de recherche') {this.placeholder = '';}"
                 placeholder="Entrez un terme de recherche">
            </div>
            <button type="submit" class="btn btn-white search-btn" name="search"><i class="bi bi-search"></i></button>
        </form>
        </div>
      </div>
    </div>
  </header>
  <?php
}
?>