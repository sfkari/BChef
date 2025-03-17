<?php
include '../database/database.php';
include 'header_admin.php';

$connexion = connexion();

page_header();

$page_message = '';

try 
{
    function getUtilisateurs($connexion) {
        $res = $connexion->prepare("SELECT * FROM utilisateurs");
        $res->execute();
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    function createUtilisateur($connexion, $data) {
        $query = "INSERT INTO utilisateurs (nom_utilisateur, mot_de_passe, email, role) VALUES (?, ?, ?, ?)";
        $hashed_password = password_hash($data['mot_de_passe'], PASSWORD_DEFAULT);
        $values = [$data['nom_utilisateur'], $hashed_password, $data['email'], $data['role']];
        
        $res = $connexion->prepare($query);
        $stm = $res->execute($values);

        if ($stm) {
            return 'Utilisateur ajouté avec succès.';
        } else {
            return 'Erreur lors de l\'ajout de l\'utilisateur.';
        }
    }

    if (isset($_POST["submit_create"])) {
        $data = [
            'nom_utilisateur' => $_POST['nom_utilisateur'],
            'mot_de_passe' => $_POST['mot_de_passe'],
            'email' => $_POST['email'],
            'role' => $_POST['role']
        ];

        $page_message = createUtilisateur($connexion, $data);
    }


    $utilisateurs = getUtilisateurs($connexion);

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

<div class="box">
  <div class="form-content">
    <div class="row">
      <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
          <h1>Tous les utilisateurs</h1>
          <div class="modal-block">
            <button type="button" class="btn boutton" data-bs-toggle="modal" data-bs-target="#create_Modal"
              data-bs-whatever="@mdo">+ Nouveau utilisateur</button>

            <div class="modal fade custom-modal" id="create_Modal" tabindex="-1" aria-labelledby="create_Modal_Label"
              aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h2 class=" " id="create_Modal_Label">Nouveau utilisateur</h2>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                      aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="" method="POST">
                      <div class="form-group">
                        <label for="nom_utilisateur">Nom d'utilisateur :</label>
                        <input type="text" id="nom_utilisateur" name="nom_utilisateur" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="mot_de_passe">Mot de passe :</label>
                        <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="email">Email :</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="role">Rôle :</label>
                        <select id="role" name="role" class="form-select" required>
                          <option value="utilisateur" selected>Utilisateur</option>
                          <option value="admin">Admin</option>
                        </select>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" name="submit_create" class="btn boutton">Ajouter l'utilisateur</button>
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
              <div class="col-md-12">
                <table class="w-100 p-3 main-table">
                  <tr class="text-center fs-5">
                    <th>Nom d'utilisateur</th>
                    <th>Mot de passe</th>
                    <th>Email</th>
                    <th>Rôle</th>
                        <th>Action</th>
                    </tr>
              <?php foreach ($utilisateurs as $utilisateur): ?>
              
                    <tr><td ><?php echo $utilisateur['nom_utilisateur'];?></td>
                        <td class="w-50"><?php echo $utilisateur['mot_de_passe'];?></td>
                        <td><?php echo $utilisateur['email'];?></td>
                        <td><?php echo $utilisateur['role'];?></td>
                        <td><div class="d-flex justify-content-center react p-1">
                      <!-- <div class="detail">
                        <a href="#" class="btn btn-white">
                          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white"
                            class="bi bi-ticket-detailed" viewBox="0 0 16 16">
                            <path
                              d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M5 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2z" />
                            <path
                              d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6zM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5z" />
                          </svg>
                        </a>
                      </div> -->
                      <div class="edit">
                        <a href="edit_utilisateurs.php?id_utilisateur=<?php echo $utilisateur['id_utilisateur'];?>&action=edit"
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
                        <a href="delete_utilisateurs.php?id_utilisateur=<?php echo $utilisateur['id_utilisateur'];?>"
                          class="btn btn-white">
                          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white"
                            class="bi bi-archive" viewBox="0 0 16 16">
                            <path
                              d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5zm13-3H1v2h14zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5" />
                          </svg>
                        </a>
                      </div>

                    </div></td>
                    </tr>
                  
              <?php endforeach; ?>
              <table>
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