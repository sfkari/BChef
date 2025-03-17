<?php
include './database/database.php';
include './database/header.php';
include './database/footer.php';

$connexion = connexion();
page_header();

function getRecettes($connexion) {
  try {
      $res = $connexion->prepare("SELECT * FROM recettes ");
      $res->execute();
      return $res->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
      return array();
  }
}
function getRecettesSlider($connexion) {
  try {
      $res = $connexion->prepare("SELECT * FROM recettes LIMIT 3");
      $res->execute();
      return $res->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
      return array();
  }
}

function getBlogs($connexion) {
  try {
      $res = $connexion->prepare("SELECT * FROM blogs  LIMIT 4");
      $res->execute();
      return $res->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
      return array();
  }
}

$recettes = getRecettes($connexion);
$sliderRecettes = getRecettesSlider($connexion);
$blogs = getBlogs($connexion);
$message ="";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ajouter_aux_favoris'])) {
    if (!isset($_SESSION['utilisateur'])) {
        header('Location: Login/login.php');
        exit;
    } else {
        $nom_utilisateur = $_SESSION['utilisateur'];
        
            $res = $connexion->prepare("SELECT id_utilisateur FROM utilisateurs WHERE nom_utilisateur = ?");
            $res->execute([$nom_utilisateur]);
            $utilisateur = $res->fetch(PDO::FETCH_ASSOC);
            $id_utilisateur = $utilisateur['id_utilisateur'];
            $id_recette = $_POST['id_recette']; 
            
            try {
                
                $stmt = $connexion->prepare("INSERT INTO favoris (id_utilisateur, id_recette) VALUES (:id_utilisateur, :id_recette)");
                $stmt->bindParam(':id_utilisateur', $id_utilisateur);
                $stmt->bindParam(':id_recette', $id_recette);
                $stmt->execute();
                
                $message ="Ajouté avec succès aux favoris";
                header("Location: {$_SERVER['HTTP_REFERER']}");
                
                exit();
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
    }
} 
?>

  <main>

    <section class="section_4">
      <div class="container block-blog" data-aos="fade-in" data-aos-duration="10000">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <h1 data-aos="fade-in" data-aos-duration="5000">Confidentialité et Conditions d'utilisation</h1>
            <h2 data-aos="fade-in" data-aos-duration="5000"><span>Confidentialité</span></h2>
            <p class="pt-4" data-aos="fade-in" data-aos-duration="9000">Votre confidentialité est importante pour nous. C'est pourquoi nous avons élaboré cette politique pour vous informer de la manière dont nous recueillons, utilisons, divulguons et protégeons vos informations. En utilisant notre site, vous consentez à cette politique de confidentialité.</p>
            
            <h3 data-aos="fade-in" data-aos-duration="5000"><span>Collecte et Utilisation des Informations</span></h3>
            <p class="pt-4" data-aos="fade-in" data-aos-duration="9000">Nous recueillons certaines informations lorsque vous utilisez notre site, y compris des données personnelles que vous nous fournissez volontairement, telles que votre nom, votre adresse e-mail et d'autres informations similaires. Nous utilisons ces informations pour améliorer votre expérience utilisateur et personnaliser le contenu et les offres qui vous sont présentés.</p>
            
            <h3 data-aos="fade-in" data-aos-duration="5000"><span>Divulgation des Informations</span></h3>
            <p class="pt-4" data-aos="fade-in" data-aos-duration="9000">Nous ne vendons, n'échangeons ni ne transférons vos informations personnelles à des tiers sans votre consentement, sauf si cela est nécessaire pour répondre à une demande que vous avez soumise ou pour se conformer à la loi.</p>
            
            <h3 data-aos="fade-in" data-aos-duration="5000"><span>Sécurité des Informations</span></h3>
            <p class="pt-4" data-aos="fade-in" data-aos-duration="9000">Nous mettons en place des mesures de sécurité appropriées pour protéger vos informations personnelles contre la perte, l'utilisation abusive, l'accès non autorisé, la divulgation, la modification ou la destruction.</p>
            
            <h2 data-aos="fade-in" data-aos-duration="5000"><span>Conditions d'Utilisation</span></h2>
            <p class="pt-4" data-aos="fade-in" data-aos-duration="9000">En accédant à ce site, vous acceptez d'être lié par ces conditions d'utilisation, toutes les lois et réglementations applicables, et vous acceptez d'être responsable du respect des lois locales en vigueur. Si vous n'êtes pas d'accord avec l'une de ces conditions, vous êtes interdit d'utiliser ou d'accéder à ce site.</p>

            <h3 data-aos="fade-in" data-aos-duration="5000"><span>Licence d'Utilisation</span></h3>
            <p class="pt-4" data-aos="fade-in" data-aos-duration="9000">Nous vous accordons une licence limitée pour accéder et utiliser ce site uniquement à des fins personnelles et non commerciales. Cette licence ne vous permet pas de modifier ou de télécharger tout ou partie du contenu, sauf autorisation expresse de notre part.</p>

            <h3 data-aos="fade-in" data-aos-duration="5000"><span>Limitations de Responsabilité</span></h3>
            <p class="pt-4" data-aos="fade-in" data-aos-duration="9000">Nous nous efforçons de fournir des informations précises et à jour sur ce site, mais nous ne pouvons garantir l'exactitude, l'exhaustivité ou la pertinence des informations fournies. En aucun cas, nous ne serons responsables des dommages directs, indirects, spéciaux, consécutifs ou accidentels résultant de l'utilisation ou de l'impossibilité d'utiliser ce site.</p>

            <h3 data-aos="fade-in" data-aos-duration="5000"><span>Modifications de la Politique</span></h3>
            <p class="pt-4" data-aos="fade-in" data-aos-duration="9000">Nous nous réservons le droit de mettre à jour ou de modifier cette politique de confidentialité et ces conditions d'utilisation à tout moment, sans préavis. Nous vous encourageons à consulter régulièrement cette page pour rester informé des modifications apportées.</p>
            <p class="pt-4" data-aos="fade-in" data-aos-duration="9000">Si vous avez des questions concernant cette politique de confidentialité ou ces conditions d'utilisation, veuillez nous contacter à <a href="mailTo:bchef@gmail.com">bchef@gmail.com</a>.</p>

          </div>
        </div>
    </section>

   
   
  </main>

<?php
page_footer();
?>