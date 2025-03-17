<?php
include '../database/database.php';
include 'header_admin.php';

$connexion = connexion();
$page_message = '';
$message = "";

try {
    function getMessageById($connexion, $id) {
        $res = $connexion->prepare("SELECT * FROM messages WHERE id = ?");
        $res->execute([$id]);
        return $res->fetch(PDO::FETCH_ASSOC);
    }

    function editMessage($connexion, $data) {
        $query = "UPDATE messages SET nom_expediteur=?, email_expediteur=?, contenu_message=? WHERE id = ?";
        $values = [$data['nom_expediteur'], $data['email_expediteur'], $data['contenu_message'], $data['id']];
        
        $res = $connexion->prepare($query);
        $stm = $res->execute($values);

        if ($stm) {
            return 'Message modifié avec succès.';
        } else {
            return 'Erreur lors de la modification du message.';
        }
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $message = getMessageById($connexion, $id);
        if (!$message) {
            echo "Le message demandé n'existe pas.";
            exit;
        }
    } else {
        echo "ID du message non spécifié.";
        exit;
    }

    if (isset($_POST["submit_edit"])) {
        $data = [
            'id' => $id,
            'nom_expediteur' => $_POST['nom_expediteur'],
            'email_expediteur' => $_POST['email_expediteur'],
            'contenu_message' => $_POST['contenu_message']
        ];

        $page_message = editMessage($connexion, $data);
        header('Location: admin_messages.php');
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
                <h1>Modifier le message</h1>
                
                <form action="" method="POST" class="modal-block">
                    <table class="w-100">
                        <tr>
                          <td colspan="2"><label for="nom_expediteur">Nom de l'expéditeur :</label><br>
                            <input type="text" id="nom_expediteur" name="nom_expediteur" class="form-control" required value="<?php echo $message['nom_expediteur'];?>"><br>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2"><label for="email_expediteur">Email de l'expéditeur :</label><br>
                            <input type="email" id="email_expediteur" name="email_expediteur" class="form-control" required value="<?php echo $message['email_expediteur'];?>"><br>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2"><label for="contenu_message">Contenu du message :</label><br>
                            <textarea id="contenu_message" name="contenu_message" class="form-control" rows="5" required><?php echo $message['contenu_message'];?></textarea><br>
                          </td>
                        </tr>
                      </table>
                      <div class="modal-footer">
                        <button type="submit" name="submit_edit" class="btn boutton">Modifier le message</button>
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
