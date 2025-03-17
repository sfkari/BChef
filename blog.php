<?php
include './database/database.php';
include './database/header.php';
include './database/footer.php';

$connexion = connexion();
page_header();

$id_blog = isset($_GET['id_blog']) ? $_GET['id_blog'] : null;

function getBlogs($connexion, $id_blog) {
  try {
      $res = $connexion->prepare("SELECT * FROM blogs WHERE id_blog = ?");
      $res->execute([$id_blog]);
      return $res->fetch();
  } catch (PDOException $e) {
      return array();
  }
}

$blog = getBlogs($connexion, $id_blog);

?>
  <main>
    
    <section>
      <div class="container">
        <div class="row justify-content-between ">
          <div class="col-md-7 ps-2 pe-5 blog" >
            <span>BLOG</span>
            <h2><?php echo $blog['titre']; ?></h2>
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
            <div style="text-align: justify; ">
            <p><?php echo $blog['contenu']; ?></p>
            </div>
          </div>
          <div class="col-md-4 p-3" style="width=100%; height=5px; background-image: url(images/blog.png); background-size: cover; border-radius: 25px;">
         
          </div>
        </div>
      </div>
    </section>
    
  </main>
  <?php
page_footer();
?>