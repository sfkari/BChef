<?php
include '../database/database.php';
include 'header_admin.php';

$connexion = connexion();
$page_message = '';

try {
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
    
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stmt_delete = $connexion->prepare("DELETE FROM messages WHERE id = ?");
            $stmt_delete->execute([$id]);
    
            if($stmt_delete) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Message supprimé avec succès
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                
                header('location:admin_messages.php');
                exit(); 
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Erreur lors de la suppression du message
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }
    } else {
        echo "ID de message non défini.";
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
                <h1>Supprimer le message</h1>
                <form action="" method="POST" class="modal-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce message ? Cette action est irréversible.');">
                    <div >
                        <button type="submit" name="submit_delete" class="btn boutton">Supprimer le message</button>
                        <a href="admin_messages.php" class="btn btn-secondary boutton">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
