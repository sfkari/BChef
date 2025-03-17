<?php
include '../database/database.php';
include 'header_admin.php';

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
    <div class="d-flex justify-content-end react p-1">
                      <div class="edit">
                        <a href="edit_blogs.php?id_blog=<?php echo $blog['id_blog'];?>&action=edit"
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
                        <a href="delete_blogs.php?id_blog=<?php echo $blog['id_blog'];?>"
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
        <div class="row justify-content-center ">
          <div class="col-md-9 ps-2 pe-5 blog" >
                      
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
          
        </div>
      </div>
    </section>
    
  </main>
