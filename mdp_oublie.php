<?php
session_start();
include './database/database.php';

$connexion = connexion();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Vérifier si l'e-mail existe dans la base de données
    $requete = $connexion->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $requete->execute([$email]); 
    $result = $requete->fetch();

    if ($result) {
        // Générer un token unique pour la réinitialisation du mot de passe
        $token = bin2hex(random_bytes(32));

        // Mettre à jour la base de données avec le token
        $update_token = $connexion->prepare("UPDATE utilisateurs SET reset_token = ? WHERE email = ?");
        $update_token->execute([$token, $email]);

        // Envoyer un e-mail à l'utilisateur avec un lien de réinitialisation du mot de passe
        $reset_link = "http://votre_site.com/reset_password.php?token=" . $token;

        // Code pour envoyer l'e-mail à l'utilisateur avec le lien de réinitialisation du mot de passe
        // Vous pouvez utiliser la fonction mail() ou un service d'e-mails transactionnels comme SendGrid, Mailgun, etc.

        $message = "Bonjour,\n\nPour réinitialiser votre mot de passe, veuillez cliquer sur le lien suivant :\n\n" . $reset_link . "\n\nSi vous n'avez pas demandé de réinitialisation de mot de passe, vous pouvez ignorer cet e-mail.\n\nCordialement,\nVotre site";

        // Envoi de l'e-mail
        // mail($email, "Réinitialisation du mot de passe", $message);

        // Afficher un message de succès
        $success_message = '<div class="alert alert-success" role="alert">Un e-mail avec les instructions pour réinitialiser votre mot de passe a été envoyé à votre adresse e-mail.</div>';
    } else {
        // Afficher un message d'erreur si l'e-mail n'existe pas dans la base de données
        $error_message = '<div class="alert alert-danger" role="alert">Aucun utilisateur trouvé avec cette adresse e-mail.</div>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Mot de passe oublié ?</h2>
        <?php
        if (isset($success_message)) {
            echo $success_message;
        } elseif (isset($error_message)) {
            echo $error_message;
        }
        ?>
        <form method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Adresse e-mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
</body>
</html>
