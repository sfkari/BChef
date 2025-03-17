<?php
include '../database/database.php';
include 'header_admin.php';

$connexion = connexion();

page_header();

$page_message = '';

try 
{
    function getRecettes($connexion) {
        $res = $connexion->prepare("SELECT * FROM recettes");
        $res->execute();
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    function createRecette($connexion, $data) {
        $query = "INSERT INTO recettes (titre, description, ingredients, instructions, url_image, categorie, temps, calorie, difficulte) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $values = [$data['titre'], $data['description'], $data['ingredients'], $data['instructions'], $data['url_image'], $data['categorie'], $data['temps'], $data['calorie'], $data['difficulte']];
        
        $res = $connexion->prepare($query);
        $stm = $res->execute($values);

        if ($stm) {
            return 'Recette ajoutée avec succès.';
        } else {
            return 'Erreur lors de l\'ajout de la recette.';
        }
    }

    if (isset($_POST["submit_create"])) {
        $data = [
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

        $page_message = createRecette($connexion, $data);
    }


    $recettes = getRecettes($connexion);

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

<div class="box">
  <div class="form-content">
    <div class="row">
      <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
          <h1>Toutes nos recettes</h1>
          <div class="modal-block">
            <button type="button" class="btn boutton" data-bs-toggle="modal" data-bs-target="#create_Modal"
              data-bs-whatever="@mdo">+ Nouvelle recette</button>

            <div class="modal fade custom-modal" id="create_Modal" tabindex="-1" aria-labelledby="create_Modal_Label"
              aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h2 class=" " id="create_Modal_Label">Nouvelle recette</h2>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                      aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="" method="POST">
                      <table>
                        <tr>
                          <td colspan="2"><label for="titre">Titre :</label><br>
                            <input type="text" id="titre" name="titre" class="form-control" required><br>
                          </td>
                        </tr>
                        <tr>
                          <td> <label for="description">Description :</label><br>
                            <textarea id="description" name="description" class="form-control" rows="1" cols="50"
                              required></textarea><br>
                          </td>
                          <td><label for="ingredients">Ingrédients :</label><br>
                            <textarea id="ingredients" name="ingredients" class="form-control" rows="1" cols="50"
                              required></textarea><br>
                          </td>
                        </tr>
                        <tr>
                          <td><label for="instructions">Instructions :</label><br>
                            <textarea id="instructions" name="instructions" class="form-control" rows="1" cols="50"
                              required></textarea><br>
                          </td>
                          <td><label for="categorie">Catégorie :</label><br>
                            <textarea id="categorie" name="categorie" class="form-control" rows="1" cols="50"
                              required></textarea><br>
                          </td>

                        </tr>
                        <tr>
                          <td> <label for="url_image">URL de l'image :</label><br>
                            <input type="file" id="url_image" name="url_image" class="form-control" required><br>
                          </td>
                          <td> <label for="temps">Temps de préparation :</label><br>
                            <input type="number" id="temps" name="temps" class="form-control" required><br>
                          </td>
                        </tr>
                        <tr>
                          <td><label for="calorie">Calories :</label><br>
                            <input type="number" id="calorie" name="calorie" class="form-control" required><br>
                          </td>
                          <td><label for="difficulte">Difficulté :</label><br>
                            <select id="difficulte" name="difficulte" class="form-select" required>
                              <option value="Facile">Facile</option>
                              <option value="Moyen">Moyen</option>
                              <option value="Difficile">Difficile</option>
                            </select><br>
                          </td>
                        </tr>
                      </table>
                      <div class="modal-footer">
                        <button type="submit" name="submit_create" class="btn boutton">Ajouter la recette</button>
                        <button type="button" class="btn btn-secondary boutton" data-bs-dismiss="modal">Fermer</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <main>
          <div class="container marketing">
            <div class="row">
              <?php foreach ($recettes as $recette): ?>
              <div class="col-md-6">

                <div class="card-block swiper-slide">
                  <div class="image-content">
                    <div class="card-image">
                      <img src="../images/<?php echo $recette['url_image']; ?>" alt="" class="card-img">
                    </div>
                  </div>

                  <div class="card-content text-center">
                    <h2 class="name">
                      <?php echo $recette['titre']; ?>
                    </h2>
                    <!-- Le reste du contenu de la carte -->
                    <div class="d-flex justify-content-between react p-1">
                      <div class="detail">
                      <a href="details_recettes.php?id_recette=<?php echo $recette['id_recette'];?>&action=edit"
                          class="btn btn-white">
                          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white"
                            class="bi bi-ticket-detailed" viewBox="0 0 16 16">
                            <path
                              d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M5 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2z" />
                            <path
                              d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6zM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5z" />
                          </svg>
                        </a>
                      </div>
                      <div class="edit">
                        <a href="edit_recettes.php?id_recette=<?php echo $recette['id_recette'];?>&action=edit"
                          class="btn btn-white">
                          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white"
                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path
                              d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                              d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                          </svg>
                        </a>
                      </div>
                      <div class="delete">
                        <a href="delete_recettes.php?id_recette=<?php echo $recette['id_recette'];?>"
                          class="btn btn-white">
                          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white"
                            class="bi bi-archive" viewBox="0 0 16 16">
                            <path
                              d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5zm13-3H1v2h14zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5" />
                          </svg>
                        </a>
                      </div>

                    </div>
                  </div>
                </div>
                </a>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </main>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>