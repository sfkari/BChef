<?php
include '../database/database.php';
include 'header_admin.php';

$connexion = connexion();
$page_message = '';
$message = "";

try 
{
    function getCommentaireById($connexion, $id_commentaire) {
        $res = $connexion->prepare("SELECT * FROM commentaires WHERE id_commentaire = ?");
        $res->execute([$id_commentaire]);
        return $res->fetch(PDO::FETCH_ASSOC);
    }

    function editCommentaire($connexion, $data) {
        $query = "UPDATE commentaires SET nom_utilisateur=?, email=?, commentaire=? WHERE id_commentaire = ?";
        $values = [$data['nom_utilisateur'], $data['email'], $data['commentaire'], $data['id_commentaire']];
        
        $res = $connexion->prepare($query);
        $stm = $res->execute($values);

        if ($stm) {
            return 'Commentaire modifié avec succès.';
        } else {
            return 'Erreur lors de la modification de l\'commentaire.';
        }
    }

    if (isset($_GET['id_commentaire'])) {
        $id_commentaire = $_GET['id_commentaire'];
        $commentaire = getCommentaireById($connexion, $id_commentaire);
        if (!$commentaire) {
            echo "L'commentaire demandé n'existe pas.";
            exit;
        }
    } else {
        echo "ID de l'commentaire non spécifié.";
        exit;
    }

    if (isset($_POST["submit_edit"])) {
        $data = [
            'id_commentaire' => $id_commentaire,
            'nom_utilisateur' => $_POST['nom_utilisateur'],
            'email' => $_POST['email'],
            'commentaire' => $_POST['commentaire']
        ];

        $page_message = editCommentaire($connexion, $data);
        header('Location: admin_commentaires.php');
        exit;
    }

} catch (PDOException $e) {
    $message = 'Erreur : ' . $e->getMessage();
}
page_header();
?>

<div class="box">
    <div class="form-content">
        <div class="row justify-content-center">
            <div class="col-10">
                <h1>Modifier l'commentaire</h1>
                
                <form action="" method="POST" class="modal-block">
                    <table class="w-100">
                        <tr>
                          <td colspan="2"><label for="id_recette">ID Recette :</label><br>
                            <input type="number" id="id_recette" name="id_recette" class="form-control" required value="<?php echo $commentaire['id_recette'];?>"><br>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2"><label for="nom_utilisateur">Nom Utilisateur :</label><br>
                            <input type="text" id="nom_utilisateur" name="nom_utilisateur" class="form-control" required value="<?php echo $commentaire['nom_utilisateur'];?>"><br>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2"><label for="email">Email :</label><br>
                            <input type="email" id="email" name="email" class="form-control" required value="<?php echo $commentaire['email'];?>"><br>
                          </td>
                        </tr>
                        
                        <tr>
                          <td colspan="2"><label for="commentaire">Commentaire :</label><br>
                            <textarea id="commentaire" name="commentaire" class="form-control" rows="5" cols="50" required><?php echo $commentaire['commentaire'];?></textarea><br>
                          </td>
                        </tr>
                      </table>
                      <div class="modal-footer">
                        <button type="submit" name="submit_edit" class="btn boutton">Modifier le commentaire</button>
                        <a href="admin_commentaires.php" class="btn btn-secondary boutton">Annuler</a>
                      </div>
                    </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
