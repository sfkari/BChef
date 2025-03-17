<?php
function page_header(){ 
    session_start();
    if (!isset($_SESSION['admin'])) {
      if(!isset($_SESSION['utilisateur'])){
        header('Location: ../Login/login.php');
        exit;
      }else{
        header('Location: ../Espace_utilisateur.php');
        exit;
      }
      
    }
    $current_page = basename($_SERVER['PHP_SELF']);
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
  <link rel="stylesheet" href="../admin/style.css">
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-3">
        <div class="sidebar" style="width: 837px; height: 100vh; "></div>
        <div class="d-flex flex-column flex-shrink-0 p-3 sidebar-menu " style="width: 280px; height: 100vh; ">
          <a href="../index.php" class="d-inline-flex justify-content-center link-body-emphasis text-decoration-none">
            <img src="../images/logo22.png" alt="" width="200">
          </a>

          <hr>
          <ul class="nav nav-pills flex-column mb-auto">
            </li>
            <li>
              <a href="admin_recettes.php" class="nav-link text-white <?php if ($current_page == 'admin_recettes.php') echo 'active'; ?>">
                <svg class="bi pe-none me-2" width="16" height="16">
                  <use xlink:href="#speedometer2"></use>
                </svg>
                Recettes
              </a>
            </li>
            <li>
              <a href="admin_blogs.php" class="nav-link text-white <?php if ($current_page == 'admin_blogs.php') echo 'active'; ?>">
                <svg class="bi pe-none me-2" width="16" height="16">
                  <use xlink:href="#table"></use>
                </svg>
                Blogs
              </a>
            </li>
            <li>
              <a href="admin_utilisateurs.php" class="nav-link text-white <?php if ($current_page == 'admin_utilisateurs.php') echo 'active'; ?> " id="active">
                <svg class="bi pe-none me-2 " width="16" height="16">
                  <use xlink:href="#people-circle"></use>
                </svg>
                Utilisateurs
              </a>
            </li>
            <li>
              <a href="admin_commentaires.php" class="nav-link text-white <?php if ($current_page == 'admin_commentaires.php') echo 'active'; ?>">
                <svg class="bi pe-none me-2" width="16" height="16">
                  <use xlink:href="#people-circle"></use>
                </svg>
                Commentaires
              </a>
            </li>
            <li>
              <a href="admin_messages.php" class="nav-link text-white <?php if ($current_page == 'admin_messages.php') echo 'active'; ?>">
                <svg class="bi pe-none me-2" width="16" height="16">
                  <use xlink:href="#grid"></use>
                </svg>
                Messages
              </a>
            </li>
            <li>
              <a href="admin_FAQs.php" class="nav-link text-white <?php if ($current_page == 'admin_FAQs.php') echo 'active'; ?>">
                <svg class="bi pe-none me-2" width="16" height="16">
                  <use xlink:href="#people-circle"></use>
                </svg>
                FAQs
              </a>
            </li>
            
            
          </ul>
          <hr>

          <div class="dropdown dropup">
            <button class="btn text-white dropdown-toggle" type="button" id="dropdownMenuButton"
              data-bs-toggle="dropdown" aria-expanded="false">
              <svg class="rounded-circle me-2" xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                <path fill-rule="evenodd"
                  d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
              </svg>
              <strong><?php echo $_SESSION['admin'];?></strong>
            </button>
            <ul class="dropdown-menu" id="menu" aria-labelledby="dropdownMenuButton">
            <li class=""><a class="dropdown-item" href="../index.php">Aller sur le site</a></li>
              <li><a class="dropdown-item" href="../Login/logout.php">Déconnexion</a></li>
            </ul>
          </div>

        </div>
      </div>
      <div class="col-9">
      <form method="post" class="search-box" action="admin_recherche.php">
            <div class="form-group">
                <input type="text" class="form-control" id="searchTerm" name="searchTerm" onblur="if (this.placeholder == '') {this.placeholder = 'Entrez un terme de recherche';}"
                onfocus="if (this.placeholder == 'Entrez un terme de recherche') {this.placeholder = '';}"
                 placeholder="Entrez un terme de recherche">
            </div>
            <button type="submit" class="btn btn-white search-btn" name="search"><i class="bi bi-search"></i></button>
        </form>
        
        <script  src="js.js"></script>
<?php
}
?>
