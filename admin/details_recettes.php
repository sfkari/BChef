<?php
include '../database/database.php';
include 'header_admin.php';

$connexion = connexion();
$page_message = '';

$id_recette = isset($_GET['id_recette']) ? $_GET['id_recette'] : null;

function getRecettes($connexion, $id_recette) {
    try {
        $res = $connexion->prepare("SELECT * FROM recettes WHERE id_recette = ?");
        $res->execute([$id_recette]);
        return $res->fetch();
    } catch (PDOException $e) {
        return array();
    }
}




$recette = getRecettes($connexion, $id_recette);
page_header();
?>
<main>
<section class="ingrédiant">
<div class="d-flex justify-content-end react p-1">
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
    <div class="container">
    <h1>Détails du recette</h1>
      <div class="row recette">
        <div class="col-md-6">
          
          <div class="d-flex  justify-content-between"><span><?php echo $recette['categorie']; ?></span><button type="submit" class=" btn boutton"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                </svg></button></div>
          <h2><?php echo $recette['titre']; ?></h2> 
          <div class="d-flex justify-content-between py-3">
            <div class="d-flex gap-3" >
              <svg width="18" height="21" viewBox="0 0 18 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.6176 4.968L16.0706 3.515L17.4846 4.929L16.0316 6.382C17.4673 8.17917 18.1605 10.4579 17.9687 12.7501C17.7768 15.0424 16.7146 17.1742 15.0001 18.7077C13.2856 20.2412 11.0489 21.0601 8.74956 20.9961C6.45018 20.9321 4.26258 19.9901 2.63604 18.3635C1.00951 16.737 0.0674995 14.5494 0.00348883 12.25C-0.0605218 9.95063 0.758322 7.71402 2.29185 5.99951C3.82538 4.285 5.95718 3.22275 8.24944 3.03092C10.5417 2.83909 12.8204 3.53223 14.6176 4.968ZM8.99957 19C9.91882 19 10.8291 18.8189 11.6784 18.4672C12.5276 18.1154 13.2993 17.5998 13.9493 16.9497C14.5993 16.2997 15.1149 15.5281 15.4667 14.6788C15.8185 13.8295 15.9996 12.9193 15.9996 12C15.9996 11.0807 15.8185 10.1705 15.4667 9.32122C15.1149 8.47194 14.5993 7.70026 13.9493 7.05025C13.2993 6.40024 12.5276 5.88463 11.6784 5.53284C10.8291 5.18106 9.91882 5 8.99957 5C7.14306 5 5.36258 5.7375 4.04982 7.05025C2.73707 8.36301 1.99957 10.1435 1.99957 12C1.99957 13.8565 2.73707 15.637 4.04982 16.9497C5.36258 18.2625 7.14306 19 8.99957 19ZM8 7.001C6.4087 7.001 4.88258 7.63314 3.75736 8.75836C2.63214 9.88358 2 11.4097 2 13.001C2 14.5923 2.63214 16.1184 3.75736 17.2436C4.88258 18.3689 6.4087 19.001 8 19.001C9.5913 19.001 11.1174 18.3689 12.2426 17.2436C13.3679 16.1184 14 14.5923 14 13.001C14 11.4097 13.3679 9.88358 12.2426 8.75836C11.1174 7.63314 9.5913 7.001 8 7.001ZM8 8.501L9.323 11.181L12.28 11.611L10.14 13.696L10.645 16.642L8 15.251L5.355 16.641L5.86 13.696L3.72 11.61L6.677 11.18L8 8.501ZM14 0.00100005V3.001L12.637 4.139C11.5059 3.54558 10.2711 3.17583 9 3.05V0.00100005H14ZM7 0V3.05C5.72935 3.17565 4.49482 3.54505 3.364 4.138L2 3.001V0.00100005L7 0Z" fill="#FDBD84"/>
              </svg>
              <p><?php echo $recette['temps']; ?> Minutes</p>                  
            </div>
            <div class="d-flex gap-3">
              <svg width="17" height="24" viewBox="0 0 17 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 9H17L7 24V15H0L9 0V9ZM7 11V7.22L3.532 13H9V17.394L13.263 11H7Z" fill="#FDBD84"/>
              </svg>                  
              <p><?php echo $recette['calorie']; ?> Calories</p>                  
            </div>
            <div class="d-flex gap-3">
              <svg width="16" height="21" viewBox="0 0 16 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 5.001C10.1217 5.001 12.1566 5.84385 13.6569 7.34415C15.1571 8.84444 16 10.8793 16 13.001C16 15.1227 15.1571 17.1576 13.6569 18.6579C12.1566 20.1581 10.1217 21.001 8 21.001C5.87827 21.001 3.84344 20.1581 2.34315 18.6579C0.842855 17.1576 0 15.1227 0 13.001C0 10.8793 0.842855 8.84444 2.34315 7.34415C3.84344 5.84385 5.87827 5.001 8 5.001ZM8 7.001C6.4087 7.001 4.88258 7.63314 3.75736 8.75836C2.63214 9.88358 2 11.4097 2 13.001C2 14.5923 2.63214 16.1184 3.75736 17.2436C4.88258 18.3689 6.4087 19.001 8 19.001C9.5913 19.001 11.1174 18.3689 12.2426 17.2436C13.3679 16.1184 14 14.5923 14 13.001C14 11.4097 13.3679 9.88358 12.2426 8.75836C11.1174 7.63314 9.5913 7.001 8 7.001ZM8 8.501L9.323 11.181L12.28 11.611L10.14 13.696L10.645 16.642L8 15.251L5.355 16.641L5.86 13.696L3.72 11.61L6.677 11.18L8 8.501ZM14 0.00100005V3.001L12.637 4.139C11.5059 3.54558 10.2711 3.17583 9 3.05V0.00100005H14ZM7 0V3.05C5.72935 3.17565 4.49482 3.54505 3.364 4.138L2 3.001V0.00100005L7 0Z" fill="#FDBD84"/>
              </svg>                  
              <p><?php echo $recette['difficulte']; ?></p>                  
            </div>
          </div>
          <h3>Ingrédients</h3>
          <div class="Ingrédients-card">
            
            <ul>
              <?php foreach(explode(",", $recette['ingredients']) as $ingredient) : ?>
                <li><?php echo $ingredient; ?></li>
              <?php endforeach; ?>
            </ul>

          </div>
        
        </div>
        <div class="col-md-6 text-end">
          <div class="image-recette">
            <div class="card-image-recette">
              <img src="../images/<?php echo $recette['url_image']; ?>" alt="" class="card-img-recette" width="400px">
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h3>Déscription</h3>
          <p class=""><?php echo $recette['description']; ?></p>
        </div>
      </div>
      <div class="row">
      <div class="col-md-12">
    <h3>Instructions</h3>
    <p class=""><?php echo $recette['instructions']; ?></p>
    <!-- <?php 
    $instructions = explode(".", $recette['instructions']); 
    $numInstruction = 1;
    foreach($instructions as $instruction) : 
       
        if (!empty(trim($instruction))) : ?>
            <p><?php echo $numInstruction; ?>- <?php echo $instruction; ?><br></p>
        <?php 
            $numInstruction++; 
        endif;
    endforeach; ?> -->
</div>


    </div>
  </section>



</main>

