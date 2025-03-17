<?php
session_start();
include '../database/database.php';

$connexion = connexion();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $utilisateur = $_POST['utilisateur'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $message ="";
    $requete = $connexion->prepare("SELECT * FROM utilisateurs WHERE email = ? OR nom_utilisateur = ?");
    $requete->execute([$utilisateur, $utilisateur]); 
    $result = $requete->fetch();
    
    if ($result && password_verify($mot_de_passe, $result['mot_de_passe'])) {
        $nom_utilisateur = $result['nom_utilisateur'];
        $_SESSION['utilisateur'] = $nom_utilisateur; 
        if ($result['role'] == "admin") {
            $_SESSION['admin'] = $nom_utilisateur; 
            header('location: ../admin/admin_recettes.php');
            exit;
        } else {
            $_SESSION['utilisateur'] = $nom_utilisateur; 
            header('location: ../index.php');
            exit;
        }
    } else {
        $message = '<div class="alert error-msg fs-5 alert-dismissible fade show position-absolute  top-0 start-50 translate-middle-x" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
        <div><i class="bi bi-x-circle me-3"></i>Email ou mot de passe incorrect.</div>
        </div>';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/swiper-bundle.min.css">
    <link rel="stylesheet" href="styleLog.css">
  <title>BChef</title>

</head>

<body>

    <main>
        <section class="section_login">
        <?php if(!empty($message)){ echo $message; }?>
            <div class="row">
                <div class="col-md-7 p-0 login">

                    <div class="login-box">
                        <div class="text-start mb-5 ">
                            <a href="../index.php" class="text-decoration-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                                </svg>
                                <span>Retour</span>
                            </a>
                        </div>
                        <h1>Connexion</h1>
                        <form method="post" action="">
                            <div class="user-box">
                                <input type="text" name="utilisateur" required>
                                <label>Email</label>
                            </div>
                            <div class="user-box">
                                <input type="password" name="mot_de_passe" required>
                                <label>Mot de passe</label>
                            </div>
                            <div class="d-flex gap-3">
                                <label for="squaredThree"><a href="../mdp_oublie.php">Mot de passe oublier ?</a></label>
                            </div>
                            <div class="my-5 pb-5">
                                <input type="submit" name="connecter" value="Se connecter" class="btn connecter ">
                                <a class="btn " href="signUp.php">Crée un compte</a>
                            </div>

                        </form>
                    </div>

                </div>
                <div class="col-md">
                    <div class="slideshow d-flex jjustify-content-end">

                        <ul>
                            <li><span></span></li>
                            <li><span>2</span></li>
                            <li><span></span></li>
                            <li><span></span></li>
                            <li><span></span></li>
                        </ul>

                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>
