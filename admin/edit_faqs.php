<?php
include '../database/database.php';
include 'header_admin.php';

$connexion = connexion();
$page_message = '';

try 
{
    function getFAQById($connexion, $id_faq) {
        $res = $connexion->prepare("SELECT * FROM faqs WHERE id_faq = ?");
        $res->execute([$id_faq]);
        return $res->fetch(PDO::FETCH_ASSOC);
    }

    function editFAQ($connexion, $data) {
        $query = "UPDATE faqs SET question=?, reponse=? WHERE id_faq = ?";
        $values = [$data['question'], $data['reponse'], $data['id_faq']];
        
        $res = $connexion->prepare($query);
        $stm = $res->execute($values);

        if ($stm) {
            return 'FAQ modifiée avec succès.';
        } else {
            return 'Erreur lors de la modification de la FAQ.';
        }
    }

    if (isset($_GET['id_faq'])) {
        $id_faq = $_GET['id_faq'];
        $faq = getFAQById($connexion, $id_faq);
        if (!$faq) {
            echo "La FAQ demandée n'existe pas.";
            exit;
        }
    } else {
        echo "ID de la FAQ non spécifié.";
        exit;
    }

    if (isset($_POST["submit_edit"])) {
        $data = [
            'id_faq' => $id_faq,
            'question' => $_POST['question'],
            'reponse' => $_POST['reponse']
        ];

        $page_message = editFAQ($connexion, $data);
        header('Location: admin_FaQs.php');
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
                <h1>Modifier la FAQ</h1>
                <form action="" method="POST">
                    <table class="w-100">
                        <tr>
                          <td colspan="2"><label for="question">Question :</label><br>
                            <input type="text" id="question" name="question" class="form-control" required value="<?php echo $faq['question'];?>"><br>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2"><label for="reponse">Réponse :</label><br>
                            <textarea id="reponse" name="reponse" class="form-control" rows="5" cols="50" required><?php echo $faq['reponse'];?></textarea><br>
                          </td>
                        </tr>
                      </table>
                      <div class="modal-footer">
                        <button type="submit" name="submit_edit" class="btn boutton">Modifier la FAQ</button>
                        <a href="admin_FaQs.php" class="btn btn-secondary boutton" >Fermer</a>
                      </div>
                    </form>
                  </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
