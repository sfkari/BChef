<?php
include '../database/database.php';
include 'header_admin.php';

$connexion = connexion();
$page_message = '';
$message = "";

try 
{
    function getutilisateurById($connexion, $id_utilisateur) {
        $res = $connexion->prepare("SELECT * FROM utilisateurs WHERE id_utilisateur = ?");
        $res->execute([$id_utilisateur]);
        return $res->fetch(PDO::FETCH_ASSOC);
    }

    function editutilisateur($connexion, $data) {
        $query = "UPDATE utilisateurs SET nom_utilisateur=?, mot_de_passe=?, email=?, role=? WHERE id_utilisateur = ?";
        $hashed_password = password_hash($data['mot_de_passe'], PASSWORD_DEFAULT);
        $values = [$data['nom_utilisateur'], $hashed_password, $data['email'], $data['role'], $data['id_utilisateur']];
        
        $res = $connexion->prepare($query);
        $stm = $res->execute($values);

        if ($stm) {
            return 'Utilisateur modifié avec succès.';
        } else {
            return 'Erreur lors de la modification de l\'utilisateur.';
        }
    }

    if (isset($_GET['id_utilisateur'])) {
        $id_utilisateur = $_GET['id_utilisateur'];
        $utilisateur = getutilisateurById($connexion, $id_utilisateur);
        if (!$utilisateur) {
            echo "L'utilisateur demandé n'existe pas.";
            exit;
        }
    } else {
        echo "ID de l'utilisateur non spécifié.";
        exit;
    }

    if (isset($_POST["submit_edit"])) {
        $data = [
            'id_utilisateur' => $id_utilisateur,
            'nom_utilisateur' => $_POST['nom_utilisateur'],
            'mot_de_passe' => $_POST['mot_de_passe'],
            'email' => $_POST['email'],
            'role' => $_POST['role']
        ];

        $page_message = editutilisateur($connexion, $data);
        header('Location: admin_utilisateurs.php');
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
                <h1>Modifier l'utilisateur</h1>
                
                <form action="" method="POST" class="modal-block">
                    <table class="w-100">
                        <tr>
                          <td colspan="2"><label for="nom_utilisateur">Nom utilisateur :</label><br>
                            <input type="text" id="nom_utilisateur" name="nom_utilisateur" class="form-control" required value="<?php echo $utilisateur['nom_utilisateur'];?>"><br>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2"><label for="mot_de_passe">Mot de passe :</label><br>
                            <input type="text" id="mot_de_passe" name="mot_de_passe" class="form-control" required value="<?php echo $utilisateur['mot_de_passe'];?>"><br>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2"><label for="email">Email :</label><br>
                            <input type="email" id="email" name="email" class="form-control" required value="<?php echo $utilisateur['email'];?>"><br>
                          </td>
                        </tr>
                        <tr>
                          <td><label for="role">Rôle :</label><br>
                            <select id="role" name="role" class="form-select" required>
                              <option value="utilisateur" <?php if($utilisateur['role'] == 'utilisateur') echo 'selected'; ?>>Utilisateur</option>
                              <option value="admin" <?php if($utilisateur['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                            </select><br>
                          </td>
                        </tr>
                      </table>
                      <div class="modal-footer">
                        <button type="submit" name="submit_edit" class="btn boutton">Modifier l'utilisateur</button>
                        <a href="admin_utilisateurs.php" class="btn btn-secondary boutton">Annuler</a>
                      </div>
                    </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
