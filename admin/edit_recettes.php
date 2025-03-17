<?php
include '../database/database.php';
include 'header_admin.php';

$connexion = connexion();
$page_message = '';

try 
{
    function getRecetteById($connexion, $id_recette) {
        $res = $connexion->prepare("SELECT * FROM recettes WHERE id_recette = ?");
        $res->execute([$id_recette]);
        return $res->fetch(PDO::FETCH_ASSOC);
    }

    function editRecette($connexion, $data) {
        $query = "UPDATE recettes SET titre=?, description=?, ingredients=?, instructions=?, url_image=?, categorie=?, temps=?, calorie=?, difficulte=? WHERE id_recette = ?";
        $values = [$data['titre'], $data['description'], $data['ingredients'], $data['instructions'], $data['url_image'], $data['categorie'], $data['temps'], $data['calorie'], $data['difficulte'], $data['id_recette']];
        
        $res = $connexion->prepare($query);
        $stm = $res->execute($values);

        if ($stm) {
            return 'Recette modifiée avec succès.';
        } else {
            return 'Erreur lors de la modification de la recette.';
        }
    }

    if (isset($_GET['id_recette'])) {
        $id_recette = $_GET['id_recette'];
        $recette = getRecetteById($connexion, $id_recette);
        if (!$recette) {
            echo "La recette demandée n'existe pas.";
            exit;
        }
    } else {
        echo "ID de recette non spécifié.";
        exit;
    }

    if (isset($_POST["submit_edit"])) {
        $data = [
            'id_recette' => $id_recette,
            'titre' => $_POST['titre'],
            'description' => $_POST['description'],
            'ingredients' => $_POST['ingredients'],
            'instructions' => $_POST['instructions'],
            'url_image' => $_POST['url_image'],
            'categorie' => $_POST['categorie'],
            'temps' => $_POST['temps'],
            'calorie' => $_POST['calorie'],
            'difficulte' => $_POST['difficulte']
        ];

        $page_message = editRecette($connexion, $data);
        header('Location: admin_recettes.php');
        exit;
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
                <h1>Modifier la recette</h1>
                <form action="" method="POST" class="modal-block ">
                    <table >
                        <tr>
                            <td colspan="2">
                                <label for="titre">Titre :</label><br>
                                <input type="text" id="titre" name="titre" class="form-control" value="<?= $recette['titre']; ?>" required><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="description">Description :</label><br>
                                <textarea id="description" name="description" class="form-control" rows="3" cols="50" required><?= $recette['description']; ?></textarea><br>
                            </td>
                            <td>
                                <label for="ingredients">Ingrédients :</label><br>
                                <textarea id="ingredients" name="ingredients" class="form-control" rows="3" cols="50" required><?= $recette['ingredients']; ?></textarea><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="instructions">Instructions :</label><br>
                                <textarea id="instructions" name="instructions" class="form-control" rows="3" cols="50" required><?= $recette['instructions']; ?></textarea><br>
                            </td>
                            <td>
                                <label for="categorie">Catégorie :</label><br>
                                <textarea id="categorie" name="categorie" class="form-control" rows="1" cols="50" required><?= $recette['categorie']; ?></textarea><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="url_image">URL de l'image :</label><br>
                                <input type="text" id="url_image" name="url_image" class="form-control" value="<?= $recette['url_image']; ?>" required><br>
                            </td>
                            <td>
                                <label for="temps">Temps de préparation :</label><br>
                                <input type="number" id="temps" name="temps" class="form-control" value="<?= $recette['temps']; ?>" required><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="calorie">Calories :</label><br>
                                <input type="number" id="calorie" name="calorie" class="form-control" value="<?= $recette['calorie']; ?>" required><br>
                            </td>
                            <td>
                                <label for="difficulte">Difficulté :</label><br>
                                <select id="difficulte" name="difficulte" class="form-select" required>
                                    <option value="Facile" <?= ($recette['difficulte'] == 'Facile') ? 'selected' : ''; ?>>Facile</option>
                                    <option value="Moyen" <?= ($recette['difficulte'] == 'Moyen') ? 'selected' : ''; ?>>Moyen</option>
                                    <option value="Difficile" <?= ($recette['difficulte'] == 'Difficile') ? 'selected' : ''; ?>>Difficile</option>
                                </select><br>
                            </td>
                        </tr>
                    </table>
                    <div class="modal-footer">
                        <button type="submit" name="submit_edit" class="btn boutton">Modifier la recette</button>
                        <a href="admin_recettes.php" class="btn btn-secondary boutton" >Fermer</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
