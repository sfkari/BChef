<?php
include '../database/database.php';
include 'header_admin.php';

$connexion = connexion();
$page_message = '';

try {
    


    if(isset($_GET['id_recette'])) {
        $id_recette = $_GET['id_recette'];
    
       
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stmt_delete= $connexion->prepare("DELETE FROM recettes WHERE id_recette = ?");
            $stmt_delete->execute([$id_recette]);
    
          
            if($stmt_delete) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Produit supprimé avec succès
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                
                header('location:admin_recettes.php');
                exit(); 
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Erreur lors de la suppression du produit
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }
    } else {
        echo "ID de produit ou nom de produit non défini.";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
page_header();
?>

<div class="box">
    <div class="form-content">
        <div class="row justify-content-center">
            <div class="col-10">
                <h1>Supprimer la recette</h1>
                <form action="" method="POST" class="modal-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette recette ? Cette action est irréversible.');">
                    <div >
                        <button type="submit" name="submit_delete" class="btn boutton">Supprimer la recette</button>
                        <a href="admin_recettes.php" class="btn btn-secondary boutton">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
