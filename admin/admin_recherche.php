<?php
include '../database/database.php';
include 'header_admin.php';

$connexion = connexion();

page_header();

function getRecettes($connexion) {
    try {
        $res = $connexion->prepare("SELECT recettes.* FROM recettes ");
        $res->execute();
        return $res->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return array(); 
    }
}

function searchRecettes($connexion, $criteria) {
    try {
        $searchTerm = '%' . $criteria . '%';
        $query = "SELECT recettes.* FROM recettes 
                  WHERE titre LIKE ? 
                     OR description LIKE ? 
                     OR ingredients LIKE ? 
                     OR instructions LIKE ? 
                     OR url_image LIKE ? 
                     OR categorie LIKE ? 
                     OR temps LIKE ? 
                     OR calorie LIKE ? 
                     OR difficulte LIKE ?";
        $res = $connexion->prepare($query);
        $res->execute([$searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm]);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return array(); 
    }
}

$message ="";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $searchTerm = $_POST['searchTerm'];
    $recettes = searchRecettes($connexion, $searchTerm);
    if(empty($recettes)){
        $message ="Aucune résultat pour  : $searchTerm";
    }else{
        $message = "Résultats de la recherche pour : $searchTerm";
    }
} else {
    $recettes = getRecettes($connexion);
}

?>

<main>
    <div class="container marketing my-5">
        <h1><?php if(!empty($message)){echo $message;} ?></h1>
        
        <div class="row">
            
            <?php foreach ($recettes as $recette): ?>
            <div class="col-md-6">
                <a href="details_recettes.php?id_recette=<?php echo $recette['id_recette']; ?>">
                    <div class="card-block swiper-slide">
                        <div class="image-content">
                            <div class="card-image">
                                <img src="../images/<?php echo $recette['url_image']; ?>" alt="" class="card-img">
                            </div>
                        </div>
                        <div class="card-content text-center">
                            <h2 class="name"><span><?php echo $recette['titre']; ?></span></h2>
                            <div class="d-flex justify-content-between py-2 gap-3">
                                <div class="d-flex gap-1">
                                    <svg width="18" height="21" viewBox="0 0 18 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.6176 4.968L16.0706 3.515L17.4846 4.929L16.0316 6.382C17.4673 8.17917 18.1605 10.4579 17.9687 12.7501C17.7768 15.0424 16.7146 17.1742 15.0001 18.7077C13.2856 20.2412 11.0489 21.0601 8.74956 20.9961C6.45018 20.9321 4.26258 19.9901 2.63604 18.3635C1.00951 16.737 0.0674995 14.5494 0.00348883 12.25C-0.0605218 9.95063 0.758322 7.71402 2.29185 5.99951C3.82538 4.285 5.95718 3.22275 8.24944 3.03092C10.5417 2.83909 12.8204 3.53223 14.6176 4.968ZM8.99957 19C9.91882 19 10.8291 18.8189 11.6784 18.4672C12.5276 18.1154 13.2993 17.5998 13.9493 16.9497C14.5993 16.2997 15.1149 15.5281 15.4667 14.6788C15.8185 13.8295 15.9996 12.9193 15.9996 12C15.9996 11.0807 15.8185 10.1705 15.4667 9.32122C15.1149 8.47194 14.5993 7.70026 13.9493 7.05025C13.2993 6.40024 12.5276 5.88463 11.6784 5.53284C10.8291 5.18106 9.91882 5 8.99957 5C7.14306 5 5.36258 5.7375 4.04982 7.05025C2.73707 8.36301 1.99957 10.1435 1.99957 12C1.99957 13.8565 2.73707 15.637 4.04982 16.9497C5.36258 18.2625 7.14306 19 8.99957 19ZM8 7.001C6.4087 7.001 4.88258 7.63314 3.75736 8.75836C2.63214 9.88358 2 11.4097 2 13.001C2 14.5923 2.63214 16.1184 3.75736 17.2436C4.88258 18.3689 6.4087 19.001 8 19.001C9.5913 19.001 11.1174 18.3689 12.2426 17.2436C13.3679 16.1184 14 14.5923 14 13.001C14 11.4097 13.3679 9.88358 12.2426 8.75836C11.1174 7.63314 9.5913 7.001 8 7.001ZM8 8.501L9.323 11.181L12.28 11.611L10.14 13.696L10.645 16.642L8 15.251L5.355 16.641L5.86 13.696L3.72 11.61L6.677 11.18L8 8.501ZM14 0.001V3.001L12.637 4.139C11.5059 3.54558 10.2711 3.17583 9 3.05V0.001H14ZM7 0V3.05C5.72935 3.17565 4.49482 3.54505 3.364 4.138L2 3.001V0.001L7 0Z" fill="#FDBD84"/>
                                    </svg>
                                    <p><?php echo $recette['temps']; ?> Minutes</p>
                                </div>
                                <div class="d-flex gap-1">
                                    <svg width="17" height="24" viewBox="0 0 17 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 9H17L7 24V15H0L9 0V9ZM7 11V7.22L3.532 13H9V17.394L13.263 11H7Z" fill="#FDBD84"/>
                                    </svg>
                                    <p><?php echo $recette['calorie']; ?> Calories</p>
                                </div>
                                <div class="d-flex gap-1">
                                    <svg width="16" height="21" viewBox="0 0 16 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 5.001C10.1217 5.001 12.1566 5.84385 13.6569 7.34415C15.1571 8.84444 16 10.8793 16 13.001C16 15.1227 15.1571 17.1576 13.6569 18.6579C12.1566 20.1581 10.1217 21.001 8 21.001C5.87827 21.001 3.84344 20.1581 2.34315 18.6579C0.842855 17.1576 0 15.1227 0 13.001C0 10.8793 0.842855 8.84444 2.34315 7.34415C3.84344 5.84385 5.87827 5.001 8 5.001ZM8 7.001C6.4087 7.001 4.88258 7.63314 3.75736 8.75836C2.63214 9.88358 2 11.4097 2 13.001C2 14.5923 2.63214 16.1184 3.75736 17.2436C4.88258 18.3689 6.4087 19.001 8 19.001C9.5913 19.001 11.1174 18.3689 12.2426 17.2436C13.3679 16.1184 14 14.5923 14 13.001C14 11.4097 13.3679 9.88358 12.2426 8.75836C11.1174 7.63314 9.5913 7.001 8 7.001ZM8 8.501L9.323 11.181L12.28 11.611L10.14 13.696L10.645 16.642L8 15.251L5.355 16.641L5.86 13.696L3.72 11.61L6.677 11.18L8 8.501ZM14 0.001V3.001L12.637 4.139C11.5059 3.54558 10.2711 3.17583 9 3.05V0.001H14ZM7 0V3.05C5.72935 3.17565 4.49482 3.54505 3.364 4.138L2 3.001V0.001L7 0Z" fill="#FDBD84"/>
                                    </svg>
                                    <p><?php echo $recette['difficulte']; ?></p>
                                </div>
                            </div>
                            <a href="recette.php?id_recette=<?php echo $recette['id_recette']; ?>" class="btn boutton"> Voir plus </a>
                        </div>
                        <div class="d-flex justify-content-between react p-1">
                            <div class="stars">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <?php if ($i <= $recette['note']): ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                        </svg>
                                    <?php else: ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                                        </svg>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </div>
                            
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
