<?php
include './database/database.php';
include './database/header.php';
include './database/footer.php';

$connexion = connexion();
page_header();

function getBlogs($connexion) {
  try {
      $res = $connexion->prepare("SELECT * FROM blogs");
      $res->execute();
      return $res->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
      return array();
  }
}

$blogs = getBlogs($connexion);

?>
  <main>
    
    <section class="section_6">
      <div class="container ">
        <div class="row mt-3">
          <h1>Touts nos blogs</h1>
        <?php foreach ($blogs as $blog): ?>
          <div class="col-md-6 mt-4 card-blog d-flex p-0">
          <a href="blog.php?id_blog=<?php echo $blog['id_blog']; ?>">
            <div class="row">
              <div class="col-md-4">
                <img src="images/blog.png" alt="" class="card-img">
              </div>
              <div class="col-md-8">
                <div class="content text-start">
                  <h2 class="name"><?php echo $blog['titre']; ?> </h2>
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