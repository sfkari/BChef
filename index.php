<?php
include './database/database.php';
include './database/header.php';
include './database/footer.php';

$connexion = connexion();
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
  session_start();
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
page_header()
?>

  <main>
    <section class="section_1">
      <div class="container mb-5">
        <div class="row intro justify-content-end">
          <div class="col-md-6 intro_cards">
            <h1 data-aos="fade-in" data-aos-duration="3000" ><span>BCHEF</span>, un univers dédié aux recettes et astuces écologiques du quotidien </h1>
            <div class="row mt-2 align-items-end p-0 " data-aos="fade-in" data-aos-duration="4000">
              <div class="col-6" >
                <div class="card-block" >
                  <div class="image-content">
                    <div class="card-image">
                      <img src="images/plat9.png" alt="" class="card-img img-fluid" width="20px">
                    </div>
                  </div>

                  <div class="card-content">
                    <h2 class="name">Back Ribs</h2>
                    <a href="./recettes.php" class="btn boutton">Voir plus </a>
                  </div>
                </div>
              </div>
              <div class="col-6 card-hori ">
                <div class="card-block  d-flex align-items-center">
                  <div class="image-content">
                    <div class="card-image">
                      <img src="images/plat3.png" alt="" class="card-img img-fluid" max-width="20px">
                    </div>
                  </div>

                  <div class="card-content">
                    <h2 class="name">Salade césar</h2>
                  </div>
                </div>
                <div class="card-block d-flex align-items-center mb-0">
                <div class="image-content">
                    <a href="./recettes.php" max-width="20px">
                      <svg width="112" height="112" viewBox="0 0 112 112" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="56" cy="56" r="56" fill="#D9D9D9" fill-opacity="0.15"/>
                        <path d="M78.0607 57.0607C78.6464 56.4749 78.6464 55.5251 78.0607 54.9393L68.5147 45.3934C67.9289 44.8076 66.9792 44.8076 66.3934 45.3934C65.8076 45.9792 65.8076 46.9289 66.3934 47.5147L74.8787 56L66.3934 64.4853C65.8076 65.0711 65.8076 66.0208 66.3934 66.6066C66.9792 67.1924 67.9289 67.1924 68.5147 66.6066L78.0607 57.0607ZM35 57.5H77V54.5H35V57.5Z" fill="white"/>
                        </svg>
                      </a>
                  </div>

                  <div class="card-content ">
                    <p class="text-start"> Découvres toutes nos recettes ici.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="slider " data-aos="fade-in" data-aos-duration="3000">
              <ul>
              <?php foreach ($sliderRecettes as $sliderRecette): ?>
                <li>
                <img src="images/<?php echo $sliderRecette['url_image']; ?>" alt="" class="img-fluid">
                  <div class="center-y">
                  <a href="recette.php?id_recette=<?php echo $sliderRecette['id_recette']; ?>" class="btn boutton">Voir plus </a>
                    <h3><?php echo $sliderRecette['titre']; ?></h3>
                    
                  </div>
                </li>
                <?php endforeach; ?>
                
              </ul>

              <ul>
                <nav>
                  <a href="#"></a>
                  <a href="#"></a>
                  <a href="#"></a>
                </nav>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>



    <section class="section_2">
      <div class="container titles ">
        <div class="row my-2">
          <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div>
              <h2  data-aos="fade-right" data-aos-duration="3000">Nos plats principaux du moment️</h2>
            </div>
            <a href="./recettes.php" data-aos="fade-left" data-aos-duration="3000">
              <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M5.83333 3V4.66667H1.66667V13.8333H10.8333V9.66667H12.5V14.6667C12.5 15.1269 12.1269 15.5 11.6667 15.5H0.833333C0.3731 15.5 0 15.1269 0 14.6667V3.83333C0 3.3731 0.3731 3 0.833333 3H5.83333ZM15 0.5V7.16667H13.3333L13.3333 3.34417L6.83925 9.83925L5.66074 8.66075L12.1541 2.16667H8.33333V0.5H15Z"
                  fill="#A2A8BA" />
              </svg>
              <span >Tout nos plats prcipaux</span>
            </a>
          </div>
        </div>
      </div>
    </section>

    <section class="section_3 pt-0 " >
     
      <div class="slide-container swiper" data-aos="fade-up" data-aos-duration="3000">
        <div class="slide-content">
          <div class="card-wrapper swiper-wrapper">

            <?php foreach ($recettes as $recette): ?>
            
            <div class="card-block swiper-slide" >
              <div class="image-content" data-aos="fade-in" data-aos-duration="9000">
                <div class="card-image">
                  <img src="images/<?php echo $recette['url_image']; ?>" alt="" class="card-img img-fluid">
                </div>
              </div>

              <div class="card-content" data-aos="fade-in" data-aos-duration="9000">
                <h2 class="name"><span><?php echo $recette['titre']; ?></span></h2>
              
            <div class="d-flex justify-content-center py-3 gap-4">
            <div class="d-flex gap-2" >
              <svg width="18" height="21" viewBox="0 0 18 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.6176 4.968L16.0706 3.515L17.4846 4.929L16.0316 6.382C17.4673 8.17917 18.1605 10.4579 17.9687 12.7501C17.7768 15.0424 16.7146 17.1742 15.0001 18.7077C13.2856 20.2412 11.0489 21.0601 8.74956 20.9961C6.45018 20.9321 4.26258 19.9901 2.63604 18.3635C1.00951 16.737 0.0674995 14.5494 0.00348883 12.25C-0.0605218 9.95063 0.758322 7.71402 2.29185 5.99951C3.82538 4.285 5.95718 3.22275 8.24944 3.03092C10.5417 2.83909 12.8204 3.53223 14.6176 4.968ZM8.99957 19C9.91882 19 10.8291 18.8189 11.6784 18.4672C12.5276 18.1154 13.2993 17.5998 13.9493 16.9497C14.5993 16.2997 15.1149 15.5281 15.4667 14.6788C15.8185 13.8295 15.9996 12.9193 15.9996 12C15.9996 11.0807 15.8185 10.1705 15.4667 9.32122C15.1149 8.47194 14.5993 7.70026 13.9493 7.05025C13.2993 6.40024 12.5276 5.88463 11.6784 5.53284C10.8291 5.18106 9.91882 5 8.99957 5C7.14306 5 5.36258 5.7375 4.04982 7.05025C2.73707 8.36301 1.99957 10.1435 1.99957 12C1.99957 13.8565 2.73707 15.637 4.04982 16.9497C5.36258 18.2625 7.14306 19 8.99957 19ZM8 7.001C6.4087 7.001 4.88258 7.63314 3.75736 8.75836C2.63214 9.88358 2 11.4097 2 13.001C2 14.5923 2.63214 16.1184 3.75736 17.2436C4.88258 18.3689 6.4087 19.001 8 19.001C9.5913 19.001 11.1174 18.3689 12.2426 17.2436C13.3679 16.1184 14 14.5923 14 13.001C14 11.4097 13.3679 9.88358 12.2426 8.75836C11.1174 7.63314 9.5913 7.001 8 7.001ZM8 8.501L9.323 11.181L12.28 11.611L10.14 13.696L10.645 16.642L8 15.251L5.355 16.641L5.86 13.696L3.72 11.61L6.677 11.18L8 8.501ZM14 0.00100005V3.001L12.637 4.139C11.5059 3.54558 10.2711 3.17583 9 3.05V0.00100005H14ZM7 0V3.05C5.72935 3.17565 4.49482 3.54505 3.364 4.138L2 3.001V0.00100005L7 0Z" fill="#f8df6d"/>
              </svg>
              <p><?php echo $recette['temps']; ?> Minutes</p>                  
            </div>
            
            <div class="d-flex gap-2">
              <svg width="16" height="21" viewBox="0 0 16 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 5.001C10.1217 5.001 12.1566 5.84385 13.6569 7.34415C15.1571 8.84444 16 10.8793 16 13.001C16 15.1227 15.1571 17.1576 13.6569 18.6579C12.1566 20.1581 10.1217 21.001 8 21.001C5.87827 21.001 3.84344 20.1581 2.34315 18.6579C0.842855 17.1576 0 15.1227 0 13.001C0 10.8793 0.842855 8.84444 2.34315 7.34415C3.84344 5.84385 5.87827 5.001 8 5.001ZM8 7.001C6.4087 7.001 4.88258 7.63314 3.75736 8.75836C2.63214 9.88358 2 11.4097 2 13.001C2 14.5923 2.63214 16.1184 3.75736 17.2436C4.88258 18.3689 6.4087 19.001 8 19.001C9.5913 19.001 11.1174 18.3689 12.2426 17.2436C13.3679 16.1184 14 14.5923 14 13.001C14 11.4097 13.3679 9.88358 12.2426 8.75836C11.1174 7.63314 9.5913 7.001 8 7.001ZM8 8.501L9.323 11.181L12.28 11.611L10.14 13.696L10.645 16.642L8 15.251L5.355 16.641L5.86 13.696L3.72 11.61L6.677 11.18L8 8.501ZM14 0.00100005V3.001L12.637 4.139C11.5059 3.54558 10.2711 3.17583 9 3.05V0.00100005H14ZM7 0V3.05C5.72935 3.17565 4.49482 3.54505 3.364 4.138L2 3.001V0.00100005L7 0Z" fill="#f8df6d"/>
              </svg>                  
              <p><?php echo $recette['difficulte']; ?></p>                  
            </div>
          </div>
                <a href="recette.php?id_recette=<?php echo $recette['id_recette']; ?>" class="btn boutton">Voir plus </a>

              </div>
              <div class="d-flex justify-content-between react p-1">
                <div class="stars">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <?php if ($i <= $recette['note']): ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#EAA90C" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                        </svg>
                                    <?php else: ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#EAA90C" class="bi bi-star" viewBox="0 0 16 16">
                                            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                                        </svg>
                                    <?php endif; ?>
                                <?php endfor; ?>
                </div>
                <div class="favorite">
                                <form method="post">
                                    <input type="hidden" name="id_recette" value="<?php echo $recette['id_recette']; ?>">
                                    <button type="submit" name="ajouter_aux_favoris" value="Ajouter aux favoris" class="btn  favoris-btn"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#EAA90C" class="bi bi-heart" viewBox="0 0 16 16"><path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/></svg></button>
                                </form>

                                <!-- <form method="post">
                                    <input type="hidden" name="id_recette" value="<?php echo $recette['id_recette']; ?>">
                                    <?php
                                        if ($recette['id_favorite'] != null) {
                                            echo '<button type="submit" name="ajouter_aux_favoris" value="Ajouter aux favoris" class="btn  favoris-btn"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#EAA90C" class="bi bi-heart" viewBox="0 0 16 16"><path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/></svg></button>';
                                        } else {
                                            echo '<button type="submit" name="ajouter_aux_favoris" value="Ajouter aux favoris" class="btn  favoris-btn"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red" class="bi bi-heart" viewBox="0 0 16 16"><path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/></svg></button>';
                                        }
                                    ?>
                                </form> -->
                            </div>
              </div>
            </div>
        <?php endforeach; ?>

          </div>
        </div>

        <div class="swiper-button-next swiper-navBtn"></div>
        <div class="swiper-button-prev swiper-navBtn"></div>
        <div class="swiper-pagination"></div>
      </div>
    </section>



    <section class="section_4">
      <div class="container block-blog" data-aos="fade-in" data-aos-duration="10000">
        <div class="row justify-content-center">
          <div class="col-md-12 text-center">
            <div>
              <span data-aos="fade-in" data-aos-duration="2000">A Propos</span>
              <h2 data-aos="fade-in" data-aos-duration="5000">Nos ambitions et nos valeurs</h2>
            </div>

            <p class="pt-4" data-aos="fade-in" data-aos-duration="9000">Notre blog de recettes écologiques et économiques est né de notre profond engagement envers
              une alimentation durable et abordable pour tous. Nous croyons fermement que l'écologie et le bien-être ne
              doivent pas être un luxe, mais accessibles à chacun. Notre mission est de partager des recettes
              délicieuses et nutritives qui respectent la planète tout en préservant votre portefeuille. Nous promouvons
              l'utilisation d'ingrédients biologiques, cultivés de manière responsable, et nous encourageons nos
              lecteurs à privilégier les produits locaux pour réduire leur empreinte carbone. En rejoignant notre
              communauté, vous découvrirez non seulement comment bien manger pour pas cher, mais aussi comment chaque
              petit geste compte dans la préservation de notre environnement. Ensemble, nous pouvons faire une
              différence significative tout en savourant des repas savoureux et bons pour la planète.</p>
            <div class="text-end">
              <svg width="168" height="138" viewBox="0 0 218 188" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M17.9157 109.019C21.3162 109.101 24.7158 109.228 28.1161 109.322C30.9502 109.401 33.7867 109.488 36.6184 109.632C36.9176 109.647 37.2383 109.584 37.5146 109.7C38.2661 110.016 35.9019 109.939 35.0975 110.072C28.6762 111.127 22.3561 112.772 16.0633 114.407C11.6187 115.561 6.25112 116.246 2.0701 118.239C1.74101 118.396 2.79774 118.383 3.15936 118.337C10.8752 117.351 18.5777 115.804 26.2602 114.657C75.5361 107.303 125.247 99.9604 175.013 96.9192C184.836 96.319 194.714 95.9917 204.557 96.1262C205.122 96.134 205.688 96.14 206.25 96.195C206.489 96.2184 205.841 96.4828 205.602 96.5138C202.983 96.854 200.334 96.9482 197.704 97.1519"
                  stroke="white" stroke-opacity="0.3" stroke-width="3" stroke-linecap="round" />
                <path
                  d="M80.3054 104.71C84.4185 94.9196 96.2145 65.3397 92.6666 75.3485C89.5272 84.2049 89.4097 94.3432 90.1255 103.594C90.24 105.073 92.0295 124.571 95.3783 123.991C96.8435 123.737 97.5412 118.921 97.6763 118.276C98.8922 112.471 99.1796 106.574 99.4226 100.667C99.6149 95.994 99.5455 91.207 100.009 86.5516C100.221 84.418 100.707 90.7832 101.096 92.8917C101.204 93.4757 102.773 100.157 103.522 99.4088C105.591 97.3428 106.592 92.8081 107.452 90.1155C108.104 88.0773 108.904 82.6674 109.718 87.7791C110.165 90.5848 112.141 96.0794 111.182 98.8501C110.72 100.183 107.555 98.8791 107.066 98.7396C99.3894 96.5498 91.8972 94.1892 83.9842 92.8959C77.4079 91.8211 70.7563 91.2536 64.0928 91.3214C60.8431 91.3545 59.1237 91.5013 56.0254 91.8115C54.898 91.9244 50.8733 92.521 55.0821 91.672C73.5953 87.9376 92.2059 84.6178 110.766 81.1283C135.102 76.5526 159.439 71.6898 184.006 68.4809C191.182 67.5436 198.504 66.6583 205.759 66.7266C207.578 66.7438 210.947 65.7942 211.146 67.6025C211.211 68.2002 210.387 68.5894 209.848 68.8558C208.041 69.7491 206.112 70.3742 204.206 71.0329C181.965 78.7224 158.899 84.1285 136.069 89.7552"
                  stroke="white" stroke-opacity="0.3" stroke-width="3" stroke-linecap="round" />
              </svg>
            </div>

          </div>
        </div>
    </section>

    <section class="section_5">
      <div class="container titles ">
        <div class="row my-2">
          <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div>
              <h2 data-aos="fade-right" data-aos-duration="3000">Nos recettes et astuces écologique</h2>
            </div>
            <a href="blogs.php" data-aos="fade-left" data-aos-duration="3000">
              <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M5.83333 3V4.66667H1.66667V13.8333H10.8333V9.66667H12.5V14.6667C12.5 15.1269 12.1269 15.5 11.6667 15.5H0.833333C0.3731 15.5 0 15.1269 0 14.6667V3.83333C0 3.3731 0.3731 3 0.833333 3H5.83333ZM15 0.5V7.16667H13.3333L13.3333 3.34417L6.83925 9.83925L5.66074 8.66075L12.1541 2.16667H8.33333V0.5H15Z"
                  fill="#A2A8BA" />
              </svg>
              <span >NOS ASTUCES ÉCOLOGIQUE</span>
            </a>
          </div>
        </div>
      </div>
    </section>

    <section class="section_6">
      <div class="container ">
        <div class="row ">
        <?php foreach ($blogs as $blog): ?>
          <div class="col-md-6 mt-4 card-blog d-flex p-0" data-aos="fade-up" data-aos-duration="3000">
          <a href="blog.php?id_blog=<?php echo $blog['id_blog']; ?>">
            <div class="row">
              <div class="col-md-4">
                <img src="images/blog.png" alt="" class="card-img img-fluid" width="100%">
              </div>
              <div class="col-md-8">
                <div class="content text-start">
                  <h3 class="name"><span><?php echo $blog['titre']; ?></span> </h3>
                  <p class="description"><?php echo $blog['objet']; ?></p>
                  <div class="author d-flex gap-2 ">
                    <div>
                      <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"
                        class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                        <path fill-rule="evenodd"
                          d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                      </svg>
                    </div>
                    <div>
                      <h6 class="m-0"><?php echo $blog['auteur']; ?></h6>
                      <p>Publié le : <?php echo $blog['date_creation']; ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </a>
          </div>
            <?php endforeach; ?>
        </div>
      </div>
    </section>
   
  </main>

<?php
page_footer();
?>