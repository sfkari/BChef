<?php
include '../database/database.php';
include 'header_admin.php';

$connexion = connexion();
$page_message = '';
$message = "";

try 
{
    function getblogById($connexion, $id_blog) {
        $res = $connexion->prepare("SELECT * FROM blogs WHERE id_blog = ?");
        $res->execute([$id_blog]);
        return $res->fetch(PDO::FETCH_ASSOC);
    }

    function editblog($connexion, $data) {
        $query = "UPDATE blogs SET titre=?, objet=?, contenu=?, auteur=? WHERE id_blog = ?";
        $values = [$data['titre'], $data['objet'], $data['contenu'], $data['auteur'], $data['id_blog']];
        
        $res = $connexion->prepare($query);
        $stm = $res->execute($values);

        if ($stm) {
            return 'blog modifiée avec succès.';
        } else {
            return 'Erreur lors de la modification de la blog.';
        }
    }

    if (isset($_GET['id_blog'])) {
        $id_blog = $_GET['id_blog'];
        $blog = getblogById($connexion, $id_blog);
        if (!$blog) {
            echo "La blog demandée n'existe pas.";
            exit;
        }
    } else {
        echo "ID de blog non spécifié.";
        exit;
    }

    if (isset($_POST["submit_edit"])) {
        $data = [
            'id_blog' => $id_blog,
            'titre' => $_POST['titre'],
            'objet' => $_POST['objet'],
            'contenu' => $_POST['contenu'],
            'auteur' => $_POST['auteur']
        ];

        $page_message = editblog($connexion, $data);
        header('Location: admin_blogs.php');
        exit;
    }

} catch (PDOException $e) {
    $message = " 'Erreur : ' . $e->getMessage()";
}
page_header();
?>

<div class="box">
    <div class="form-content">
        <div class="row justify-content-center">
            <div class="col-10">
                <h1>Modifier le blog</h1>
                <form action="" method="POST" class="modal-block ">
                      <table class="w-100">
                        <tr>
                          <td colspan="2"><label for="titre">Titre :</label><br>
                            <input type="text" id="titre" name="titre" class="form-control" required value="<?php echo $blog['titre']; ?>"><br>
                          </td>
                        </tr>
                        <tr>
                          <td> <label for="objet">objet :</label><br>
                            <textarea id="objet" name="objet" class="form-control" rows="2" cols="50"
                              required><?php echo $blog['objet']; ?></textarea><br>
                          </td>
                        </tr>
                        <tr>
                          <td><label for="contenu">Contenu :</label><br>
                            <textarea id="contenu" name="contenu" class="form-control" rows="4" cols="50"
                              required><?php echo $blog['contenu']; ?></textarea><br>
                          </td>
                        </tr>
                        <tr>
                          <td><label for="auteur">auteur :</label><br>
                          <input type="text" id="auteur" name="auteur" class="form-control" required value="<?php echo $blog['auteur']; ?>"><br>
                          </td>
                        </tr>
                        
                      </table>
                      <div class="modal-footer">
                        <button type="submit" name="submit_edit" class="btn boutton">Modifier le blog</button>
                        <a href="admin_blogs.php" class="btn btn-secondary boutton">Annuler</a>
                      </div>
                    </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
